<div>

    <h4 class="card-title mb-2" title="Créditer un compte">Ajouter une catégorie</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="AddCategory">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Nom </label>
                
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" min="1">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            <div class="mb-3">
                <label class="form-label mb-3">Type</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-rs-coins"></i>
                        </label>
                    </div>
                    <select wire:model="default_category_id" required class="form-select @error('default_category_id') is-invalid @enderror ">
                        <option>Sélectionner un type</option>
                        @foreach ($default_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('default_category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>

            {{-- <div class="mb-3">
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
            </div> --}}


          
            <div class="text-center col-12">
                <button type="submit" class="btn btn-primary w-100 ">Ajouter <i class="fi fi-rr-add"></i> </button>
            </div>
        </div>
    </form>

</div>
