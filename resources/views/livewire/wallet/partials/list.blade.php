<div>
    <h4 class="card-title  mb-2">Liste des portefeuilles</h4>
    @if ($wallets->count() > 0)

        @foreach ($wallets as $wallet)
            <div class="d-flex  align-items-center flex-wrap">


                <span class="me-3 icon-circle bg-primary text-white"><i class="fi fi-rr-credit-card"></i></span>
                <div class="flex-grow-1 ">
                    @if ($editWalletId == $wallet->id)
                        @include('livewire.wallet.partials.edit')
                    @else
                        <h5 class="mb-2"><span class="text-uppercase"
                                style="text-decoration:underline;">{{ $wallet->name }}</span></h5>
                    @endif
                    {{-- <small>Credit Card *********5478</small> <br> --}}

                    @if ($manageWalletId != $wallet->id)
                        @if ($wallet->accounts->count() > 0)
                            @foreach ($wallet->accounts as $account)
                                <div class="d-flex  align-items-center ">
                                    <span style="margin-right: 5px"><strong>{{ $account->name }}: </strong></span>
                                    <div class="col">
                                        <div class="progress mb-0 " style="height: 15px">
                                            <div class="progress-bar" role="progressbar"
                                                aria-valuenow="{{ $account->pivot->percentage }}" aria-valuemin="0"
                                                aria-valuemax="100" style="width:{{ $account->pivot->percentage }}%">
                                                {{ $account->pivot->percentage }} %
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <small class="text-info">Aucun compte associé, cliquer sur "Gérer"pour associer un compte</small>
                        @endif
                    @else
                        @include('livewire.wallet.partials.manager')
                    @endif
                    
                </div>
                <div class="d-flex  flex-sm-row float-lg-right ms-1 ">
                    @if ($manageWalletId != $wallet->id)
                        @if ($editWalletId == $wallet->id)
                            <button class="btn btn-sm btn-outline-danger mb-2 mb-sm-0"
                                wire:click="hideFormShowFunction">Annuler <i class="fi fi-br-ban"></i></button>
                        @else
                            <button class="btn btn-sm btn-outline-warning mb-2 mb-sm-0 ms-1"
                                wire:click="editFormShowFunction({{ $wallet->id }})">Editer <i
                                    class="fi fi-rs-pencil ms-auto"></i></button>
                        @endif
                        {{-- <a href="{{ route('wallet.show',$wallet->id) }} " class=" btn btn-sm btn-outline-primary">Gérer <i class="fi fi-bs-settings"></i></a> --}}
                        <button wire:click="manageWalletFormShow({{ $wallet->id }})"
                            class=" btn btn-sm btn-outline-primary mb-2 mb-sm-0 ms-1">Gérer <i
                                class="fi fi-bs-settings"></i></button>
                    @else
                        <button class="btn btn-sm btn-outline-danger mb-2 mb-sm-0 ms-1"
                            wire:click="hideFormManagerFunction">Fermer <i class="fi fi-sr-circle-xmark"></i></button>
                    @endif
                </div>
            </div>
            <hr>
        @endforeach
        {{ $wallets->links() }}
    @else
        <div>
            <span class="text-info">Vous n'avez pas portefeuille enregistré</span>
        </div>
    @endif

    {{-- <livewire:walletManagerComponent/> --}}
    {{-- @livewire('walletManagerComponent', ['walletId' => $walletId], key($walletId)) --}}

</div>