<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;
use MercurySeries\Flashy\Flashy;

class CreateAccountComponent extends Component
{

    protected $listeners = ['show'];
    public $name, $balance;

   

    public function mount()
    {
        // $this->dispatch('accountCreated',[
        //     'message'=>'Compte creer avec succees',
        //     'type'=>'success'
        // ]);

        // notify()->success("le compte $this->name  a été ajouté à votre profil.",'Ajout de compte') ;
        // Flashy::message("le compte $this->name  a été ajouté à votre profil.", 'llldldldl');
        // Flashy::error('Message', 'http://your-awesome-link.com','success');
        // flashy('Some message', 'http://your-awesome-link.com');
        // connectify('Welcome to Laravel Notify ⚡️', 'My custom title');
        // notify('success', 'Connection Found', 'Success Message Here');
        // notify('votre compte', 'Ajout de compte', 'Votre compte a été ajouté ');

        // Flashy::success("le compte  a été ajouté à votre profil.");

    }
    public function AccountCreate()
    {
        $this->validate([
            'name' => 'required',
            'balance' => 'required|numeric',
        ]);


        // Account::create([
        //     'name' => $this->name,
        //     'balance' => $this->balance,
        //     'user_id' => Auth()->id(),
        // ]);

        // Flashy::success("le compte $this->name  a été ajouté à votre profil.");
        // flashy()->message("le compte $this->name  a été ajouté à votre profil.");
      
        
        $this->dispatch('accountCreated');
        $this->resetFields();
        // notify()->success("le compte {{ $this->name }} a été ajouté à votre profil.","Ajout de compte") ;

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
