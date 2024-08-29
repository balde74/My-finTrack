<?php

namespace App\Livewire;

use App\Models\Budget;
use App\Models\Category;
use App\Models\DefaultCategory;
use App\Models\DefaultCategoryBudget;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BudgetComponent extends Component
{

    public $budgets = [];
    public $fixedBudgetAmount = [];
    public $variableBudgetPercentage = [];
    public $variableBudgetPercentageAmount = [];
    public $categoryBudgets = [];
    public $submittedWalletId = null;
    public $walletId;
    public $position = 'settings';

    //pour les sous category
    public $fixedCategoryBudgetAmount = [];
    public $variableCategoryBudgetPercentage = [];

    // Méthode des règles de validation
    protected function validationRules($walletId)
    {
        return [
            'budgets.' . $walletId . '.*.amount' => 'nullable|numeric|min:0',
            'budgets.' . $walletId . '.*.percentage' => 'nullable|numeric|min:0|max:100',
            'categoryBudgets.' . $walletId . '.*.amount' => 'nullable|numeric|min:0',
            'categoryBudgets.' . $walletId . '.*.percentage' => 'nullable|numeric|min:0|max:100',
        ];
    }

    // Méthode des messages d'erreur personnalisés
    protected function validationMessages($walletId)
    {
        return [
            'budgets.' . $walletId . '.*.amount.numeric' => 'Le montant doit être un nombre valide.',
            'budgets.' . $walletId . '.*.amount.min' => 'Le montant doit être au moins 0.',
            'budgets.' . $walletId . '.*.percentage.numeric' => 'Le pourcentage doit être un nombre valide.',
            'budgets.' . $walletId . '.*.percentage.min' => 'Le pourcentage doit être au moins 0.',
            'budgets.' . $walletId . '.*.percentage.max' => 'Le pourcentage ne doit pas dépasser 100.',
            'categoryBudgets.' . $walletId . '.*.amount.numeric' => 'Le montant doit être un nombre.',
            'categoryBudgets.' . $walletId . '.*.amount.min' => 'Le montant doit être au moins 0.',
            'categoryBudgets.' . $walletId . '.*.percentage.numeric' => 'Le pourcentage doit être un nombre.',
            'categoryBudgets.' . $walletId . '.*.percentage.min' => 'Le pourcentage doit être au moins 0.',
            'categoryBudgets.' . $walletId . '.*.percentage.max' => 'Le pourcentage ne doit pas dépasser 100.',
        ];
    }

    public function mount()
    {
        // Charger les portefeuilles et les catégories par défaut
        $this->wallets = Wallet::with('defaultCategoryBudgets')->where('user_id', Auth::id())->get();
        $this->defaultCategories = DefaultCategory::all();

        // Initialiser les budgets des defaultCategory
        foreach ($this->wallets as $wallet) { //parcourir tous les wallets de l'utilisateur
            foreach ($this->defaultCategories as $category) {
                $budget = $wallet->defaultCategoryBudgets->firstWhere('default_category_id', $category->id);

                $this->budgets[$wallet->id][$category->id] = $budget ? [
                    'amount' => $budget->amount,
                    'percentage' => $budget->percentage,
                ] : [
                    'amount' => null,
                    'percentage' => null,
                ];
                // Budgets des sous-catégories
                foreach ($this->defaultCategories as $defaultCategory) {
                    foreach ($defaultCategory->categories as $category) {
                        $categoryBudget = $wallet->CategoryBudgets->firstWhere('category_id', $category->id);

                        $this->categoryBudgets[$wallet->id][$category->id] = $categoryBudget ? [
                            'amount' => $categoryBudget->amount,
                            'percentage' => $categoryBudget->percentage,
                        ] : [
                            'amount' => null,
                            'percentage' => null,
                        ];
                    }
                }
            }

        }
    }

    // a chaque mise a jour d'un champs de categoryBudget
    public function updatedCategoryBudgets()
    {
        $this->calculateCategoriesBudgetValues(); //on appel la fonction
    }

    // fonction de calcul des budgets des sous categories
    protected function calculateCategoriesBudgetValues()
    {
        $this->fixedCategoryBudgetAmount = [];
        $this->variableCategoryBudgetPercentage = [];

        foreach ($this->categoryBudgets as $walletId => $categories) {
            $this->fixedCategoryBudgetAmount[$walletId] = 0;
            $this->variableCategoryBudgetPercentage[$walletId] = 0;
            $wallet = Wallet::findOrFail($walletId);

            //validation des donnees saisies
            $this->validate(
                $this->validationRules($walletId),
                $this->validationMessages($walletId)
            );
            $totalAmount = $wallet->calculateTotalAmount(); //calcul du montant total attribuer du wallet

            // Parcours des sous-catégories pour calculer les budgets
            foreach ($categories as $categoryId => $budget) {
                // Détermine si la catégorie est fixe ou variable
                $isFixed = isset($budget['amount']) && !is_null($budget['amount']);

                if ($isFixed) {
                    // Calcul du montant fixe pour la catégorie
                    $this->fixedCategoryBudgetAmount[$walletId] += (100 * (floatval($budget['amount']) / $totalAmount));
                } else {
                    // Calcul du pourcentage variable pour la catégorie
                    $this->variableCategoryBudgetPercentage[$walletId] += floatval($budget['percentage']) ?? 0;
                }
            }
        }
    }
    // fonction qui enregistre les budgets des sous categories
    public function categoryBudgetAdd($walletId)
    {
        $this->validate(
            $this->validationRules($walletId),
            $this->validationMessages($walletId)
        );

        foreach ($this->categoryBudgets[$walletId] as $categoryId => $budgetValue) {
            $budget = Budget::where('wallet_id', $walletId)->where('category_id', $categoryId)->first();
            $category = Category::findOrFail($categoryId);

            if ($budget) {
                // Mise a jour du budget existant
                $amount = isset($budgetValue['amount']) && $budgetValue['amount'] !== '' ? floatval($budgetValue['amount']) : null;
                $percentage = isset($budgetValue['percentage']) && $budgetValue['percentage'] !== '' ? floatval($budgetValue['percentage']) : null;
                $budget->amount = $amount;
                $budget->percentage = $percentage;
                $budget->save();

            } else {
                //enregistrement
                $budget = Budget::create([
                    'wallet_id' => $walletId,
                    'default_category_id' => $category->default_category_id,
                    'category_id' => $category->id,
                    'amount' => $budgetValue['amount'] ?? null,
                    'percentage' => $budgetValue['percentage'] ?? null,
                    'user_id' => Auth::id(),
                ]);
            }

            if ($budget->amount == null && $budget->percentage == null) {
                $budget->delete();
            }

        }
    }

    // a chaque mise a jour d'un champs de Budget
    public function updatedBudgets($value, $key)
    {
        $this->calculateBudgetValues();
    }

    // fonction de calcul des budgets des sous categories
    protected function calculateBudgetValues()
    {
        $this->fixedBudgetAmount = [];
        $this->variableBudgetPercentage = [];

        foreach ($this->budgets as $walletId => $types) {
            $this->fixedBudgetAmount[$walletId] = 0;
            $this->variableBudgetPercentage[$walletId] = 0;
            $this->variableBudgetPercentageAmount[$walletId] = 0;
            $wallet = Wallet::findOrFail($walletId);
            //validation des donnees saisies
            $this->validate(
                $this->validationRules($walletId),
                $this->validationMessages($walletId)
            );
            $totalAmount = $wallet->calculateTotalAmount();
            foreach ($types as $defaultCategoryId => $budget) {
                $isFixed = $defaultCategoryId == 1; // 1 pour fixe'
                if ($isFixed) {
                    $this->fixedBudgetAmount[$walletId] = (100 * (floatval($budget['amount']) / $totalAmount));
                } else {
                    $this->variableBudgetPercentage[$walletId] = $budget['percentage'];
                    $this->variableBudgetPercentageAmount[$walletId] = $totalAmount * (floatval($budget['percentage']) / 100);
                }
            }
        }
        $this->submittedWalletId = null;
    }

    // fonction qui enregistre les budgets des categories par defaut
    public function DefaultCategoryBudgetAdd($walletId)
    {
        $this->validate(
            $this->validationRules($walletId),
            $this->validationMessages($walletId)
        );
        foreach ($this->budgets[$walletId] as $defaultCategoryId => $budgetData) {

            // Trouver le budget s'il existe
            $budget = DefaultCategoryBudget::where('wallet_id', $walletId)
                ->where('default_category_id', $defaultCategoryId)
                ->first();

            if ($budget) {
                // Mise à jour du budget existant
                $amount = isset($budgetData['amount']) && $budgetData['amount'] !== '' ? floatval($budgetData['amount']) : null;
                $percentage = isset($budgetData['percentage']) && $budgetData['percentage'] !== '' ? floatval($budgetData['percentage']) : null;

                $budget->amount = $amount;
                $budget->percentage = $percentage;
            } else {
                // Enregistrement
                $budget = new DefaultCategoryBudget([
                    'wallet_id' => $walletId,
                    'default_category_id' => $defaultCategoryId,
                    'amount' => $budgetData['amount'] ?? null,
                    'percentage' => $budgetData['percentage'] ?? null,
                    'user_id' => Auth::id(),
                ]);
            }
            $budget->save();
            if ($budget->amount == null && $budget->percentage == null) {
                $budget->delete();
            }
            $this->submittedWalletId = $walletId;
        }
    }

    public function render()
    {
        return view('livewire.budget.budget-component', [
            'defaultCategories' => DefaultCategory::all(),
            'wallets' => Wallet::where('user_id', Auth::id())->get(),
            // 'fixedBudgetAmount' => $this->fixedBudgetAmount,
            // 'variableBudgetPercentage' => $this->variableBudgetPercentage,
             // 'walletId' => $this->walletId,
        ]);
    }
}
