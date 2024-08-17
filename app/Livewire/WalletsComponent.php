<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class WalletsComponent extends Component
{
    use WithPagination;

    public $name, $newName, $oldName, $editWalletId, $editFormShow = 0;
    public $manageWalletId;
    public $position = 'settings';
    public $currentMonthExpenses;

    public $selectedAccounts = [];

    public function manageWalletFormShow($walletId)
    {
        $wallet = Wallet::findOrFail($walletId);
        $userAccounts = Auth::user()->accounts;
        foreach ($userAccounts as $account) {
            $this->selectedAccounts[$account->id] = $wallet->accounts->contains($account->id)
            ? $wallet->accounts->find($account->id)->pivot->percentage
            : 0;
        }
        $this->manageWalletId = $walletId;
    }
    public function hideFormManagerFunction()
    {
        $this->manageWalletId = 0;
    }
    public function walletCreate()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Wallet::create([
            'name' => $this->name,
            'user_id' => Auth()->id(),
        ]);
        $this->reset(['name']);
    }

    public function editFormShowFunction($id)
    {
        $wallet = Wallet::findOrFail($id);

        $this->oldName = $wallet->name;
        $this->newName = $this->oldName;
        $this->editWalletId = $wallet->id;
        //reinitialisation des message d'erreur
        $this->resetErrorBag();
    }

    public function hideFormShowFunction()
    {
        $this->editWalletId = 0;
    }

    public function walletUpdate()
    {

        $this->validate([
            'newName' => 'required',
        ]);
        $wallet = Wallet::findOrFail($this->editWalletId);

        $wallet->update([
            'name' => $this->newName,
        ]);

        $this->editWalletId = 0;

    }

    public function addAccountPercentToWallet($accountId)
    {
        $account = Account::findOrFail($accountId);

        $newPercentage = $this->selectedAccounts[$accountId];
        $walletId = $this->manageWalletId;
        $wallet = Wallet::findOrFail($walletId);
        $associated = $wallet->accounts->firstWhere('pivot.account_id', $accountId);
        // pourcentage du compte associable

        $totalAssociatedPercentage = $account->wallets()->sum('percentage'); //total des pourcentage du compte associer
        if ($associated) //pourcentage associer a ce wallet
        {
            $associatedPercentage = $associated->pivot->percentage;
        } else {
            $associatedPercentage = 0;
        }
        $difference = 100 - $totalAssociatedPercentage; //difference avec 100
        $associablePercentage = $associatedPercentage + $difference; //pourcentage asssociable
        if ($newPercentage > 0) {
            if ($associablePercentage >= $newPercentage) {
                // dd($associated);
                if ($associated) {
                    if ($associated->pivot->percentage != $newPercentage) {
                        $wallet->accounts()->updateExistingPivot($accountId, ['percentage' => $newPercentage]);
                        $totalAssociatedPercentage = $account->wallets()->sum('percentage'); //total des pourcentage du compte associer

                        if ($totalAssociatedPercentage < 100) {
                            $account->is_associated = 1;
                        } else {
                            $account->is_associated = 2;
                        }
                        $account->save();
                    }
                } else {
                    $wallet->accounts()->attach($accountId, ['percentage' => $newPercentage]);

                    $totalAssociatedPercentage = $account->wallets()->sum('percentage'); //total des pourcentage du compte associer
                    if ($totalAssociatedPercentage < 100) {
                        $account->is_associated = 1;
                    } else {
                        $account->is_associated = 2;
                    }
                    $account->save();
                };
            } else {
                // si le pourcentage a associer est sup au pourcentage restant
                // return $this->selectedAccounts[$accountId] = $associated->pivot->percentage;
                //retour de l'alerte error
            
                return;
            }
        } else {
            $wallet->accounts()->detach($accountId);
        }

    }

    public function monthlyExpenses($walletId)
    {
        $wallet = Wallet::findOrFail($walletId);
        // dd($wallet);
    
        // Mois en cours
        $currentMonthExpenses = $wallet->expenses()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

             return $currentMonthExpenses;
    }
    // public function getMonthlyExpenses($walletId)
    // {
    //     $wallet = Wallet::findOrFail($walletId);
    
    //     // Mois en cours
    //     $currentMonthExpenses = $wallet->expenses()
    //         ->whereMonth('created_at', Carbon::now()->month)
    //         ->whereYear('created_at', Carbon::now()->year)
    //         ->sum('amount');
    
    //     // Mois précédent
    //     $lastMonthExpenses = $wallet->expenses()
    //         ->whereMonth('created_at', Carbon::now()->subMonth()->month)
    //         ->whereYear('created_at', Carbon::now()->subMonth()->year)
    //         ->sum('amount');
    
    //     return [
    //         'currentMonthExpenses' => $currentMonthExpenses,
    //         'lastMonthExpenses' => $lastMonthExpenses,
    //     ];
    // }
    public function render()
    {
        if ($this->position === 'sidebar') {
            $wallets = Wallet::where('user_id', Auth::id())->get();
            // $this->currentMonthExpenses = $this->monthlyExpenses($walletId);
        } elseif ($this->position === 'settings') {
            $wallets = Wallet::where('user_id', Auth::id())->paginate(4);
        }
        return view('livewire.wallet.wallets-component', [
            'wallets' => $wallets,
            'accounts' => Auth::user()->accounts,
        ]);
    }
}
