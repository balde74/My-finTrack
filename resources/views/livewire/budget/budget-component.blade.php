<div>
    @if ($position === 'sidebar')
    @include('livewire.budget.partials.list_sidebar')
    @else
        <div class="row">

            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                            <h4 class="card-title mb-0">Budgetisation</h4>
                        </div>
                    <div class="card-body col-12">
                        @include('livewire.budget.partials.list')
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
