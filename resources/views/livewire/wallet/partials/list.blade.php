<div>
    <h4 class="card-title  mb-2">Liste des portefeuilles</h4>
    @if ($wallets->count() > 0)

        @foreach ($wallets as $wallet)
            <div class="verify-content">
                <div class="d-flex align-items-center">
                    <span class="me-3 icon-circle bg-primary text-white"><i class="fi fi-rr-credit-card"></i></span>
                    <div class="primary-number">
                        @if ($editWalletId == $wallet->id)
                            @include('livewire.wallet.partials.edit')
                        @else
                            <h5 class="mb-0"><span class="text-uppercase">{{ $wallet->name }}</span></h5>
                        @endif
                        <small>Credit Card *********5478</small>
                        <br>
                        <span class="text-success">Verified</span>
                    </div>
                </div>
                <div class="float-right">
                    @if ($editWalletId == $wallet->id)
                    <button class="btn btn-outline-danger"
                    wire:click="hideFormShowFunction">Annuler <i class="fi fi-br-ban"></i></button>
                    @else
                        <button class="btn btn-outline-warning"
                            wire:click="editFormShowFunction({{ $wallet->id }})">Editer <i
                                class="fi fi-rs-pencil ms-auto"></i></button>
                    @endif
                    <button class=" btn btn-outline-primary">Gérer <i class="fi fi-bs-settings"></i></button>
                </div>
            </div>
            <hr>
        @endforeach
        {{ $wallets->links() }}
    @else
        <div>
            <span class="text-info">Vous n'avez pas de compte</span>
        </div>
    @endif


</div>
