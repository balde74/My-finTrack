<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class WalletsComponent extends Component
{
    use WithPagination;

    public $name,$newName,$oldName,$editWalletId,$editFormShow = 0;

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
        $this->editFormShow = 1;
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

    public function render()
    {
        return view('livewire.wallet.wallets-component',[
            'wallets'=> Wallet::where('user_id', Auth::id())->paginate(2),
        ]);
    }
}
