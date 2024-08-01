<div class="row">
    <div class="col-xxl-4 col-xl-4 col-lg-6">

        <div class="card">
            {{-- <div class="card-header">
            <h4 class="card-title">Gestion des comptes financiers</h4>
        </div> --}}
            <div class="card-body ">

                @if (!$editFormShow)
                    @include('livewire.account.partials.create')
                @else
                    @include('livewire.account.partials.edit')
                @endif
            </div>
        </div>
    </div>
    <div class="col-xxl-8 col-xl-8 col-lg-8">

        <div class="card">
            {{-- <div class="card-header">
            <h4 class="card-title">Gestion des comptes financiers</h4>
        </div> --}}
            <div class="card-body ">
                @include('livewire.account.partials.list')
            </div>
        </div>
    </div>
</div>
</div>
<script>
    // Hide flash message after 3 seconds
    setTimeout(function() {
        let flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';
            setTimeout(() => flashMessage.remove(), 500);
        }

    }, 5000);
    Livewire.hook('message.processed', (message, component) => {
        setTimeout(hideFlashMessage, 5000); // 5 seconds
    });
</script>
