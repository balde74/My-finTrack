<?php

namespace App\Livewire\account;

use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AccountComponent extends Component
{
    use WithPagination;
    // protected $listeners = ['accountCreated' => 'render'];
    // public $accounts;
    public $editFormShow;
    public $name, $balance,$editAccountId;
    public $position = 'settings';

    public function accountCreate()
    {
        $this->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
        ]);
        Account::create([
            'name' => $this->name,
            'balance' => $this->balance,
            'user_id' => Auth()->id(),
        ]);
        $this->reset(['name', 'balance']);

    }

    public function AccountUpdate()
    {

        $this->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
        ]);
        $account = Account::findOrFail($this->editAccountId);
        $account->update([
            'name' => $this->name,
            'balance' => $this->balance,
        ]);
        $this->reset(['name', 'balance']);
        $this->editFormShow = false;

    }

    public function editFormShowFunction($id)
    {
        $account = Account::findOrFail($id);
        $this->name = $account->name;
        $this->balance = $account->balance;
        $this->editAccountId = $account->id;
        $this->editFormShow = 1;

    }

    public function editFormHideFunction()
    {
        $this->reset(['name', 'balance']);
        $this->editFormShow = false;
    }

    public function render()
    {
        if ($this->position === 'sidebar') {
            $accounts = Account::where('user_id', Auth::id())->get();
            // $this->currentMonthExpenses = $this->monthlyExpenses($walletId);
        } elseif ($this->position === 'settings') {
            $accounts = Account::where('user_id', Auth::id())->paginate(3);
        }
        // $this->accounts = Auth::user()->accounts->paginate(5);
        
        return view('livewire.account.account-component',[
            'accounts'=> $accounts
        ]);
    }
}
