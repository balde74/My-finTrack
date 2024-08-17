<div>

    <h4 class="card-title mb-2" title="Créditer un compte">Modifier une dépense</h4>
    @if (session()->has('message'))
        <div id="flash-message" class="alert alert-success d-flex align-items-center" role="alert">
            <div>
                <span><i class="fi fi-ss-check-circle" style="margin-right:5px"></i></span>{{ session('message') }}
            </div>
        </div>
    @endif
    <form wire:submit.prevent="updateExpense">
        <div class="row">
            <div class="mb-3 col-xl-12">
                <label class="form-label">Montant </label>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-ss-sack-dollar"></i>
                        </label>
                    </div>
                    <input type="number" wire:model.live="newAmount"
                        class="form-control @error('newAmount') is-invalid @enderror" min="1">
                </div>
                @error('newAmount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label mb-3">Catégorie de la dépense </label>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-rs-coins"></i>
                        </label>
                    </div>
                    <select wire:model="expense_category"
                        class="form-select @error('expense_category') is-invalid @enderror ">
                        <option>Sélectionner une catégorie</option>
                        @foreach ($expense_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('expense_category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label mb-3">Portefeuille </label>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text">
                            <i class="fi fi-rr-wallet"></i>
                        </label>
                    </div>
                    <select wire:model.live="newSelectedWallet" disabled
                        class="form-select @error('wallet') is-invalid @enderror ">
                        <option value="0">Sélectionner un portefeuille</option>
                        @foreach ($wallets as $wallet)
                            <option value="{{ $wallet->id }}">{{ $wallet->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('newSelectedWallet')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            @if ($newSelectedWallet)
                <div class="mb-3">
                    <label class="form-label mb-3">Comptes à débiter </label>

                    @foreach ($newSelectedWalletAccounts as $account)
                        <div class="input-group mb-1">
                            <span class="input-group-text">{{ $account->name }}</span>
                            <input type="number" wire:model.live="selectedAccounts.{{ $account->id }}"
                                class="form-control @error('selectedAccounts.' . $account->id) is-invalid @enderror"
                                placeholder="Pourcentage" min="0" max="100">
                            <span class="input-group-text">%</span>
                            @error('selectedAccounts.' . $account->id)
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <small class="text-center"> Valeur en montant:
                            {{ isset($accountAmounts[$account->id]) ? $accountAmounts[$account->id] : 0 }}
                        </small> <br>
                        <small
                            class="me-5 text-danger">{{ isset($errorAccountsBalance[$account->id]) ? $errorAccountsBalance[$account->id] : '' }}
                        </small>
                        <br>
                    @endforeach
                    @if (isset($totalPercentage))
                        @if ($totalPercentage > 0)
                            <small>Montant réparti à : {{ $totalPercentage }} %
                                @if ($totalPercentage < 100 || $totalPercentage > 100)
                                    <i class="fi fi-ss-triangle-warning text-warning"></i>
                                @else
                                    <i class="fi fi-ss-comment-alt-check text-success"></i>
                                @endif
                            </small>
                        @endif
                    @endif
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label mb-3">Donner une description </label>
                <textarea cols="30" rows="10" class="form-control @error('newDescription') is-invalid @enderror"
                    wire:model="newDescription"></textarea>
                @error('newDescription')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center col-12">
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary w-100"
                            @if ($totalPercentage != 100) disabled @endif>
                            Modifier <i class="fi fi-rr-edit"></i>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-outline-danger w-100"
                            wire:click.prevent="editFormHideFunction">
                            Annuler <i class="fi fi-rr-pencil-slash"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>


</div>
