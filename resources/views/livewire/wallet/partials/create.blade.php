<div>

    <h4 class="card-title mb-2">Ajouter un portefeuille</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="walletCreate">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Nom du portefeuille </label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Mon portefeuille">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            

            <div class="text-center col-12">
                <button type="submit" class="btn btn-primary w-100 ">Ajouter <i class="fi fi-rr-add"></i> </button>
            </div>
        </div>
    </form>

</div>
