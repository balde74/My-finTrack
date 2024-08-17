<div>
    <h4 class="card-title  mb-2">Liste des comptes</h4>
    @if ($accounts->count() > 0)
        @foreach ($accounts as $account)
            <div class="verify-content">
                <div class="d-flex align-items-center">
                    <span class="me-3 icon-circle bg-primary text-white">
                        <i class="fi fi-rs-bank"></i></span>
                    <div class="primary-number">
                        <div class="row " >
                            
                                <h5 class="mb-0 text-uppercase">{{ $account->name }}</h5>
                                <small>{{ number_format($account->balance,2) }} </small>
                                <br>
                                <small>
                                    @if ($account->is_associated == 0)
                                        <span><i class="fi fi-sr-triangle-warning text-warning"></i></span> Non associé
                                    @elseif ($account->is_associated == 1)
                                        <span> <i class="fi fi-rr-info text-info"></i></span> Associé en partie
                                    @elseif ($account->is_associated == 2)
                                        <span><i class="fi fi-sr-badge-check text-success"></i></span> Associé
                                    @endif
    
                                </small>

                                <div class="col-md-9">
                                    <ul class="list-group-numbered">
                                        @foreach ($account->wallets as $wallet)
                                            <li class="list-group-item d-flex justify-content-between align-items-start ">
                                                <div class="ms-2 me-auto">
                                                    <div class="fw-bold"><small>{{ $wallet->name }}</small></div>
                                                </div>
                                                <span class="badge bg-primary rounded-pill"><small>{{ $wallet->pivot->percentage }} %</small></span>
                                            </li>
                                            <hr class="border opacity-1">
                                        @endforeach
    
                                    </ul>
                                </div>

                         

                        </div>

                        {{-- <span class="text-success">{{ $account->is_verified ? 'Associé' : 'Non associé' }}</span> --}}
                    </div>

                </div>
                <div class="float-right">
                    <button wire:click="editFormShowFunction({{ $account->id }})"
                        class="btn btn-sm btn-outline-warning">Editer <i class="fi fi-rs-pencil ms-auto"></i></button>
                    {{-- <button class=" btn btn-sm btn-outline-primary">Gérer <i class="fi fi-bs-settings"></i></button> --}}
                </div>
            </div>
            <hr>
        @endforeach

        {{ $accounts->links() }}
    @else
        <div>
            <span class="text-info"> Vous n'avez pas de compte enregistré </span>
        </div>
    @endif
</div>
