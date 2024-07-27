<div>

    <h4 class="card-title mb-2">Mise à jour de compte</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="AccountUpdate">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Nom </label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') ?? $name }}" placeholder="Compte epargne/ cash">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 col-xl-12">
                <label class="form-label">Montant initial </label>
                <input type="number" min="0" wire:model="balance"
                    class="form-control @error('balance') is-invalid @enderror" value="{{ old('balance') ?? $balance }}"
                    placeholder="10000">
                @error('balance')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="text-center row">
                <div class="col">
                    <button type="submit" class="btn  btn-info w-100">Mettre à jour <i
                            class="fi fi-rr-refresh ms-1"></i> </button>

                </div>
                <div class="col">
                    <button wire:click.prevent="editFormHideFunction" class="btn  btn-outline-primary w-100">Nouveau
                        compte <i class="fi fi-rr-add ms-0"></i></button>
                </div>
            </div>
        </div>
    </form>

</div>
