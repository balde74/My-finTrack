<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseAllocation;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseComponent extends Component
{
    use WithPagination;
    public $amount, $account, $expense_category, $selectedWallet, $description;
    public $newAmount, $newAccount, $newExpense_category, $newSelectedWallet, $newDescription, $newSelectedWalletAccounts = [];
    public $showEditForm = false;
    public $expense;
    public $accounts = [];
    public $selectedAccounts = [];
    public $totalPercentage;
    public $accountAmounts = [];
    public $errorAccountsBalance = [];

    // Méthode pour calculer la somme des pourcentages
    public function calculateTotalPercentage()
    {
        $this->totalPercentage = array_sum($this->selectedAccounts);
    }

    // Méthode appelée automatiquement lorsqu'un élément de selectedAccounts est modifié
    public function updatedSelectedAccounts($value, $key)
    {
        // calcul du total des pourcentages
        $this->calculateTotalPercentage();
        //calcul des montants en fonction des %
        $this->calculateAccountAmounts();
    }

    // Méthode appelée automatiquement lorsqu'un élément de selectedAccounts est modifié
    public function updatedAmount($value, $key)
    {
        if ($value > 0) {
            // calcul du total des pourcentages
            $this->calculateTotalPercentage();
            //calcul des montants en fonction des %
            $this->calculateAccountAmounts();

        }

    }

    // Méthode pour calculer les montants pour chaque compte en fonction du pourcentage
    public function calculateAccountAmounts()
    {
        if ($this->showEditForm) {
            $amount = $this->newAmount;
        } else {
            $amount = $this->amount;
        }
        foreach ($this->selectedAccounts as $accountId => $percentage) {
            if ($percentage > 0) {
                // Calcul du montant pour chaque compte
                $this->accountAmounts[$accountId] = ($amount * $percentage) / 100;
            } else {
                $this->accountAmounts[$accountId] = 0;
            }
        }
    }

    public function updatedSelectedWallet($id)
    {
        if ($id > 0) {
            $wallet = Wallet::findOrFail($id);
            $this->accounts = $wallet->accounts;
            $this->selectedAccounts = [];
            $this->accountAmounts = null;
            $this->calculateTotalPercentage();
        }
    }

    public function debitAccount()
    {

        $this->validate([
            'amount' => 'required|numeric',
            'selectedAccounts' => 'required|array|min:1',
            'expense_category' => 'required',
            'selectedWallet' => 'required',
        ]);

        if ($this->totalPercentage > 100 || $this->totalPercentage < 100) {
            return back(); //ajout de message flash
        } else {

            foreach ($this->selectedAccounts as $accountId => $percentage) {
                if ($percentage > 0) {
                    // Calcul du montant pour chaque compte
                    $this->accountAmounts[$accountId] = ($this->amount * $percentage) / 100;

                    $wallet = Wallet::findOrFail($this->selectedWallet);
                    $wallet_account = $wallet->accounts()->wherePivot('account_id', $accountId)->first();
                    //pourcentage du compte allouer au portefeuille selectionner
                    $percentageAccountInWallet = $wallet_account->pivot->percentage;
                    //calcul du montant disponible en fonction du pourcentage du compte dans le portefeuille
                    $totalBalanceAvailable = ($wallet_account->balance * $percentageAccountInWallet) / 100;

                    if ($this->accountAmounts[$accountId] > $totalBalanceAvailable) {
                        $this->errorAccountsBalance[$accountId] = 'Le montant dépasse le solde disponible pour ce compte.';
                        return;
                        //il doit continuer mais
                    } else {
                        $this->errorAccountsBalance[$accountId] = '';

                        //enregistrement

                    }
                }

            }
            //enregistrement de la depense
            $expense = Expense::create([
                'amount' => $this->amount,
                'category_id' => $this->expense_category,
                'wallet_id' => $this->selectedWallet,
                'user_id' => Auth::id(),
                'description' => $this->description,
                'date' => now(),
            ]);

            //enregistrement des allocations
            foreach ($this->selectedAccounts as $accountId => $percentage) {
                if ($percentage > 0) {
                    $account = Account::findOrFail($accountId);
                    $account->balance -= $this->accountAmounts[$accountId];
                    $account->save();

                    ExpenseAllocation::create([
                        'expense_id' => $expense->id,
                        'account_id' => $accountId,
                        'allocation_percentage' => $percentage,
                        'amount' => $this->accountAmounts[$accountId],
                    ]);

                }
            }

        }

    }

    // methode pour afficher le formulaire d'edition
    public function showExpenseEditFormFunction($id)
    {
        $this->expense = Expense::findOrFail($id);
        $this->newAmount = $this->expense->amount;
        // $this->newAccount = $expense->account;
        $this->expense_category = $this->expense->category_id;
        $this->newSelectedWallet = $this->expense->wallet_id;
        $this->newDescription = $this->expense->description;
        $this->showEditForm = true;

        $this->loadWalletAccounts($id);
        // calcul du total des pourcentages
        $this->calculateTotalPercentage();

        //calcul des montants en fonction des %
        $this->calculateAccountAmounts($this->newAmount);
        $this->errorAccountsBalance = [];

    }
    public function loadWalletAccounts($id)
    {
        if ($this->newSelectedWallet) {
            $wallet = Wallet::with('accounts')->find($this->newSelectedWallet);
            $expense = Expense::findOrFail($id);
            $this->selectedAccounts = []; //reinitialisation des selectedAccounts

            if ($wallet) {
                $this->newSelectedWalletAccounts = $wallet->accounts->map(function ($account) use ($expense) {
                    $allocation = $expense->expenseAllocations->firstWhere('account_id', $account->id);
                    $percentage = $allocation ? $allocation->allocation_percentage : 0;
                    $this->selectedAccounts[$account->id] = $percentage;
                    return $account;
                })->all();
            }
        }
    }

    public function updateExpense()
    {
        $this->validate([
            'newAmount' => 'required|numeric|min:1',
            'expense_category' => 'required|exists:categories,id',
            'newSelectedWallet' => 'required|exists:wallets,id',
            'selectedAccounts.*' => 'nullable|numeric|min:0|max:100',
            'newDescription' => 'nullable|string|max:255',
        ]);

        if ($this->expense->wallet_id == $this->newSelectedWallet) {
            $errorFound = false;

            $wallet = Wallet::findOrFail($this->newSelectedWallet);
            foreach ($this->selectedAccounts as $accountId => $percentage) {
                if ($this->checkAllocationValidity($wallet,$accountId, $percentage)) {
                    $errorFound = true;
                    continue;
                }

                if ($errorFound) {
                    return;
                } else {
                    foreach ($this->selectedAccounts as $accountId => $percentage) {
                      
                        $allocation = ExpenseAllocation::firstOrNew([
                            'expense_id' => $this->expense->id,
                            'account_id' => $accountId,
                        ]);

                        $wallet_account = $wallet->accounts()->wherePivot('account_id', $accountId)->first();
                        $total_wallet_account_balance = $wallet_account->balance + $allocation->amount;
                        //pourcentage du compte allouer au portefeuille selectionner
                        $percentageAccountInWallet = $wallet_account->pivot->percentage;
                        //calcul du montant disponible en fonction du pourcentage du compte dans le portefeuille
                        $totalBalanceAvailable = ($total_wallet_account_balance * $percentageAccountInWallet) / 100;

                        $allocation->allocation_percentage = $percentage;
                        $allocation->amount = $this->accountAmounts[$accountId];
                        $allocation->save();

                        // Mettre à jour le solde du compte
                        $wallet_account = $wallet->accounts()->wherePivot('account_id', $accountId)->first();
                        $wallet_account->balance = $total_wallet_account_balance - $allocation->amount;
                        $wallet_account->save();

                        if ($allocation->allocation_percentage == 0) {
                            $allocation->delete();
                        }
                    }

                    $this->expense->description = $this->newDescription;
                    $this->expense->amount = $this->newAmount;
                    $this->expense->category_id = $this->newSelectedWallet;
                    $this->expense->save();

                    // message de success puis
                    $this->showEditForm = false;

                }
            }
        }


    }

    protected function checkAllocationValidity($wallet, $accountId, $percentage)
    {
        $allocation = ExpenseAllocation::firstOrNew([
            'expense_id' => $this->expense->id,
            'account_id' => $accountId,
        ]);

        $wallet_account = $wallet->accounts()->wherePivot('account_id', $accountId)->first();
        $total_wallet_account_balance = $wallet_account->balance + $allocation->amount;

        // pourcentage du compte allouer au portefeuille selectionner
        $percentageAccountInWallet = $wallet_account->pivot->percentage;

        // calcul du montant disponible en fonction du pourcentage du compte dans le portefeuille
        $totalBalanceAvailable = ($total_wallet_account_balance * $percentageAccountInWallet) / 100;

        if ($this->accountAmounts[$accountId] > $totalBalanceAvailable) {
            $this->errorAccountsBalance[$accountId] = 'Le montant dépasse le solde disponible pour ce compte.';
            return true;
        }

        $this->errorAccountsBalance[$accountId] = '';

        if (is_null($percentage) || $percentage === '') {
            $this->errorAccountsBalance[$accountId] = 'Entrez une valeur de 0 à 100';
            return true;
        }

        return false;
    }

    public function editFormHideFunction()
    {
        $this->showEditForm = false;
    }

    public function render()
    {
        $expense_categories = Category::where('user_id', Auth::id())->get();
        $expenses = Expense::where('user_id', Auth::id())->paginate(5);
        $wallets = Wallet::where('user_id', Auth::id())->get();
        return view('livewire.expense.expense-component', compact('expense_categories', 'wallets', 'expenses'));
    }
}
