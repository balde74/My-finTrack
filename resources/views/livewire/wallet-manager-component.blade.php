<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header flex-row">
                <h4 class="card-title">Portefeuille </h4>
                <a class="btn btn-primary" href="settings-profile.html">Edit</a>
            </div>
            <div class="card-body">
                {{-- @foreach ($wallet->accounts as $account)
                    <div class="d-flex  align-items-center mb-3">
                        <span style="margin-right: 5px"><strong>{{ $account->name }} : </strong></span>
                        <div class="col">
                            <div class="progress mb-0 " style="height: 15px">
                                <div class="progress-bar" role="progressbar"
                                    aria-valuenow="{{ $account->pivot->percentage }}" aria-valuemin="0"
                                    aria-valuemax="100" style="width:{{ $account->pivot->percentage }}%">
                                    {{ $account->pivot->percentage }} %
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="number" class="form-control form-control-sm" wire:model="perscentage" value="{{ $account->pivot->percentage }}">
                        </div>
                        <div class="">

                            <button class="btn btn-sm btn-info ">kf</button>
                            <button class="btn btn-sm btn-info">kf</button>
                        </div>
                    </div>
                @endforeach --}}
                kdkdkdkdk
                @foreach($accounts as $account)
                <div class="d-flex align-items-center mb-3">
                    <div class="col">

                        <span style="margin-right: 5px"><strong>{{ $account->named }} : </strong></span>
                    </div>
                    <div class="col me-3">
                        <div class="progress mb-0" style="height: 15px">
                            <div class="progress-bar" role="progressbar"
                                aria-valuenow="{{ $selectedAccounts[$account->id] }}" aria-valuemin="0"
                                aria-valuemax="100" style="width:{{ $selectedAccounts[$account->id] }}%">
                                {{ $selectedAccounts[$account->id] }} %
                            </div>
                        </div>
                    </div>
                    <div class="col-2 me-3">
                        <input type="number" class="form-control form-control-sm" wire:model="selectedAccounts.{{ $account->id }}" min="0" max="100">
                    </div>
                    <div class="col=2 ">
                        <button class="btn btn-sm btn-info">kf</button>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
