<div>

    <h4 class="card-title mb-2">Ajouter un compte</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="accountCreate">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Nom </label>
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-sr-bank"></i>
                        </label>
                    </div>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Compte epargne/ cash">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3 col-xl-12">
                <label class="form-label">Montant initial </label>
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-ss-sack-dollar"></i>
                        </label>
                    </div>
                    <input type="number" min="0" wire:model="balance"
                        class="form-control @error('balance') is-invalid @enderror" value="{{ old('balance') }}"
                        placeholder="10000">
                    @error('balance')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="text-center col-12">
                <button type="submit" class="btn btn-primary w-100 ">Ajouter <i class="fi fi-rr-add"></i> </button>
            </div>
        </div>
    </form>

</div>
