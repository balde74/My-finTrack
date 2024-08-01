@foreach ($accounts as $account)
    <div class="d-flex align-items-center mb-3">
        <div class="col-3">
            <span style="margin-right: 5px"><strong>{{ $account->name }} : </strong></span>
        </div>
        <div class="col me-2">
            <div class="progress mb-0" style="height: 15px">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $selectedAccounts[$account->id] }}"
                    aria-valuemin="0" aria-valuemax="100" style="width:{{ $selectedAccounts[$account->id] }}%">
                    {{ $selectedAccounts[$account->id] }} %
                </div>
            </div>
        </div>
        <form class="d-flex align-items-center" wire:submit.prevent="addAccountPercentToWallet({{ $account->id }})">

            <div class="col me-2 ">
                <input type="number" class="form-control form-control-sm" wire:model="selectedAccounts.{{ $account->id }}" min="0" max="100">
            </div>
            
            <div class="col ">
                <button type="submit"  class="btn btn-sm btn-outline-success ms-1" >Ajouter</button>
                {{-- <a href="#" class="btn btn-sm btn-outline-success" wire:click="">Ajouter <i class="fi fi-sr-add"></i></a> --}}
    
            </div>
        </form>
    </div>
    <hr>
@endforeach
