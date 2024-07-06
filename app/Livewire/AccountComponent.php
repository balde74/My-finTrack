<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AccountComponent extends Component
{
    protected $listeners =['accountCreated'=>'render'];
    public $accounts,$AccountCreate=false;

    public function render()
    {
        $this->accounts = Auth::user()->accounts;
        return view('livewire.account-component');
    }
}
