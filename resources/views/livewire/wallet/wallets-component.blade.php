<div>
    @if ($position === 'sidebar')
    @include('livewire.wallet.partials.list_sidebar')
        
    @elseif ($position === 'settings')
        
    <div class="row">
        <div class="col-xxl-4 col-xl-4 col-lg-6">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title">Gestion des portefeuilles</h4>
                </div> --}}
                <div class="card-body ">
                    @include('livewire.wallet.partials.create')
                </div>
            </div>
        </div>
        <div class="col-xxl-8 col-xl-8 col-lg-6">
            <div class="card">
                {{-- <div class="card-header">
                        <h4 class="card-title">Gestion des portefeuilles</h4>
                    </div> --}}
                <div class="card-body col-12">
                    @include('livewire.wallet.partials.list')
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
