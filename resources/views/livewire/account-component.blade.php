<div>
    <h4 class="card-title  mb-2">Liste des comptes</h4>
    @if ($accounts->count() > 0)

        @foreach ($accounts as $account)
            <div class="verify-content">
                <div class="d-flex align-items-center">
                    <span class="me-3 icon-circle bg-primary text-white">
                        <i class="fi fi-rs-bank"></i></span>
                    <div class="primary-number">
                        <h5 class="mb-0 text-uppercase">{{ $account->name }}</h5>
                        <small>{{ $account->balance }} </small>
                        <br>
                        <p> <strong>

                                @if ($account->is_associated == 0)
                                    <span><i class="fi fi-sr-triangle-warning text-warning"></i></span> Non associé
                                @elseif ($account->is_associated == 1)
                                    <span> <i class="fi fi-rr-info text-info"></i></span> Associé en partie
                                @elseif ($account->is_associated == 2)
                                    <span><i class="fi fi-sr-badge-check text-success"></i></span> Associé
                                @endif
                            </strong>
                        </p>

                        {{-- <span class="text-success">{{ $account->is_verified ? 'Associé' : 'Non associé' }}</span> --}}
                    </div>
                </div>
                <button class=" btn btn-outline-primary">Gérer</button>
            </div>
            <hr class="border opacity-1">
        @endforeach
    @else
        <div>
            <span class="text-info">Vous n'avez pas de compte</span>

        </div>
    @endif


</div>
