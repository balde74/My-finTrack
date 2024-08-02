<div>

    <h4 class="card-title mb-2" title="Créditer un compte">Ajouter un revenu</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="creditAccount">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Montant </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-ss-sack-dollar"></i>
                        </label>
                    </div>
                    <input type="number" wire:model="amount" class="form-control @error('amount') is-invalid @enderror"
                        value="{{ old('amount') }}" min="1">
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label mb-3">Catégorie du revenu </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-rs-coins"></i>
                        </label>
                    </div>
                    <select wire:model="income_category_id" class="form-select @error('income_category_id') is-invalid @enderror ">
                        <option>Sélectionner une categorie</option>
                        @foreach ($income_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('income_category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label mb-3">Compte à créditer </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-rr-bank"></i>
                        </label>
                    </div>
                    <select wire:model="account_id" class="form-select @error('account_id') is-invalid @enderror ">
                        <option>Sélectionner un compte</option>
                        @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                    </select>
                    @error('account_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>


            <div class="mb-3">
                <label class="form-label mb-3">Donner une description </label>
                <textarea cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
            <div class="text-center col-12">
                <button type="submit" class="btn btn-primary w-100 ">Créditer <i class="fi fi-rr-add"></i> </button>
            </div>
        </div>
    </form>

</div>
