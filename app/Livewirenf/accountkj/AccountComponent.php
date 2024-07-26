<?php

namespace App\account\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AccountComponent extends Component
{
    protected $listeners =['accountCreated'=>'render'];
    public $accounts,$AccountCreate=false;

    public function showForm($account)
    {
        dd($account);
    }
    
    public function render()
    {
        $this->accounts = Auth::user()->accounts;
        dd($this->accounts);
        return view('livewire.account-component');
    }
}
