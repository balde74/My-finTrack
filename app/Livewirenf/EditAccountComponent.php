<?php

namespace App\Livewire;

use Livewire\Component;

class EditAccountComponent extends Component
{
    protected $listeners =['showEditForm'];
    public function showEditForm($account)
    {

    }
    public function render()
    {
        return view('livewire.edit-account-component');
    }
}
