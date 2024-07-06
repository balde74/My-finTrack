<div>

    <h4 class="card-title mb-2">Ajouter un compte</h4>
    <form wire:submit.prevent="AccountCreate">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Nom </label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Compte epargne/ cash">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-xl-12">
                <label class="form-label">Montant initial </label>
                <input type="number" min="0" wire:model="balance"
                    class="form-control @error('balance') is-invalid @enderror" value="{{ old('balance') }}"
                    placeholder="10000">
                @error('balance')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center col-12">
                <button  class="btn btn-primary w-100">Ajouter</button>
            </div>
        </div>
    </form>

</div>
