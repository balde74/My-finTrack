<div class="card">
    <div class="card-header">
        <h4 class="card-title">Gestion des portefeuilles</h4>
    </div>
    <div class="card-body ">
        <div class="row">

            <div class="col-md-5 mr-1 p-2 " style="border-right: 2px solid rgb(82, 81, 81)">
                @include('livewire.wallet.partials.create')

            </div>
            <div class="col-md-7 p-2">
                <h4 class="card-title  mb-2"></h4>
                @include('livewire.wallet.partials.list')
            </div>
        </div>

        {{-- <div class="col-5" style="border: 1px solid red;">
                @livewire('account-component')
            </div>
            <div class="col-5" style="border: 1px solid blue;">
                @livewire('account-component')
             </div> --}}

    </div>
    </d
