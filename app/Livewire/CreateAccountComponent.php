<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;

class CreateAccountComponent extends Component
{

    public $name, $balance;

    public function mount()
    {
        // $this->dispatch('accountCreated',[
        //     'message'=>'Compte creer avec succees',
        //     'type'=>'success'
        // ]);

        // notify()->success('Welcome to Laravel Notify ⚡️')  
        // connectify('Welcome to Laravel Notify ⚡️', 'My custom title');
        notify('warning', 'Connection Found', 'Success Message Here');

    }
    public function AccountCreate()
    {
        $this->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
        ]);


        // dd($validated);
        Account::create([
            'name' => $this->name,
            'balance' => $this->balance,
            'user_id' => Auth()->id(),
        ]);

        $this->dispatch('accountCreated');

        $this->resetFields();

    }

    public function resetFields()
    {
        $this->name = '';
        $this->balance = '';
    }
    public function render()
    {
        return view('livewire.create-account-component');
    }
}
