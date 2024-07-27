<form wire:submit.prevent="walletUpdate">
    <div class="row">
        <div class="mb-3 col-xl-12">
            {{-- <label class="form-label">Nom du portefeuille </label> --}}
            <input type="text" wire:model="newName" class="form-control @error('newName') is-invalid @enderror"
                 placeholder="Mon portefeuille" autofocus>
                <small  class="form-text text-muted">Appuyer sur Entrer pour enregistrer.</small> <br>
            @error('newName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        

    </div>
</form>