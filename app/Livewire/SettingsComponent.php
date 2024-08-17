<?php

namespace App\Livewire;

use Livewire\Component;

class SettingsComponent extends Component
{
    public $currentPage = 'accounts' ;   
    public $currentPageText = 'Comptes'; // Page par défaut
        // public $currentPage = 'expenses' ;   
        // public $currentPageText = 'Portefeuille'; 

    public function setPage($page,$text)
    {
        $this->currentPage = $page;
        $this->currentPageText = $text;
    }

    // public function mount()
    // {
    //     $this->setPage($this->currentPage,'Comptes');
    // }
    public function render()
    {
        return view('livewire.settings-component');
    }
}
