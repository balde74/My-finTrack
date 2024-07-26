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
        <div class="float-right">

            <button wire:click="editFormShowFunction({{ $account->id }})" class="btn btn-outline-warning">Editer  <i class="fi fi-rs-pencil ms-auto"></i></button>
            {{-- <button wire:click="$emit('postAdded')">kdk</button> --}}
            <button class=" btn btn-outline-primary" >Gérer  <i class="fi fi-bs-settings"></i></button>
            {{-- <a href="{{ route('account.manager') }}" class="btn btn-outline-primary"></a> --}}
        </div>
    </div>
    <hr class="border opacity-1">
@endforeach

{{ $accounts->links() }}
@else
<div>
    <span class="text-info">Vous n'avez pas de compte</span>

</div>
@endif