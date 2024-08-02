<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\Income;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IncomeComponent extends Component
{
    use WithPagination;
    public $amount, $account_id, $income_category_id, $description;
    public $newAmount, $newIncomeCategoryId, $newAccountId, $editIncomeId;
    public function creditAccount()
    {
        $this->validate([
            'amount' => 'required|numeric',
            'account_id' => 'required',
            'income_category_id' => 'required',
            // 'description' => 'required',
        ]);

        $account = Account::findOrFail($this->account_id);
        Income::create([
            'amount' => $this->amount,
            'account_id' => $this->account_id,
            'income_category_id' => $this->income_category_id,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);

        $account->balance += $this->amount;
        $account->save();

        $this->reset(['amount', 'account_id', 'income_category_id', 'description']);

    }

    public function editIncomeFormShowFunction($id)
    {
        $income = Income::findOrFail($id);

        // $oldAmount = $income->amount;
        $this->newAmount = $income->amount;
        $this->newIncomeCategoryId = $income->income_category_id;
        $this->newAccountId = $income->account_id;
        $this->editIncomeId = $income->id;
        //reinitialisation des message d'erreur
        $this->resetErrorBag();
    }

    public function hideIncomeFormShowFunction()
    {
        $this->editIncomeId = 0;
    }

    public function updateIncomeFunction()
    {
        $this->validate([
            'newAmount' => 'required|numeric',
            'newAccountId' => 'required',
            'newIncomeCategoryId' => 'required',
        ]);
        $income = Income::findOrFail($this->editIncomeId);
        //  si c'est le meme compte
        if ($income->account_id == $this->newAccountId) {
            // on teste si on a le montant a modifier dans le account

            $account = $income->account;
            if ($account->balance > $income->amount) {
                $difference = $income->account->balance - $income->amount;
                $newBalance = $difference + $this->newAmount;
                // mise a jour de balance de account
                $account->balance = $newBalance;
                $account->save();

            } else {
                dd('Montant deja utiliser');
            }
        } else {
            $newAccount = Account::findOrFail($this->newAccountId);
            $oldAccount = $income->account;
            // on teste si on a le montant a modifier dans le account
            if ($oldAccount->balance > $income->amount) {
                //retrait de la somme dans l'ancien compte
                $oldAccount->balance -= $income->amount;
                $oldAccount->save();
                //ajout du montant dans le nouveau compte
                $newAccount->balance += $this->newAmount;
                $newAccount->save();
            }
            else {
                dd('Montant deja utiliser');
            }
        }

        $income->update([
            'amount' => $this->newAmount,
            'account_id' => $this->newAccountId,
            'income_category_id' => $this->newIncomeCategoryId,
        ]);

        $this->editIncomeId = 0;
    }
    public function render()
    {
        return view('livewire.income.income-component', [
            'accounts' => Account::where('user_id', Auth::id())->get(),
            'income_categories' => IncomeCategory::all(),
            'incomes' => Income::where('user_id', Auth::id())->paginate(10),
        ]);
    }
}
