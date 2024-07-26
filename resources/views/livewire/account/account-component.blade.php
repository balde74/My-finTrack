<div class="card">
    <div class="card-header">
        <h4 class="card-title">Gestion des comptes financiers</h4>
    </div>
    <div class="card-body ">
        <div class="row">
           
            <div class="col-md-5 mr-1 p-2 " style="border-right: 2px solid rgb(82, 81, 81)">
               @if (!$editFormShow)
               @include('livewire.account.partials.account-create')
                   
               @else
               @include('livewire.account.partials.account-edit')
                   
               @endif

            </div>
            <div class="col-md-7 p-2">
                <h4 class="card-title  mb-2">Liste des comptes</h4>
                @include('livewire.account.partials.account-list')
            </div>
        </div>

        {{-- <div class="col-5" style="border: 1px solid red;">
                @livewire('account-component')
            </div>
            <div class="col-5" style="border: 1px solid blue;">
                @livewire('account-component')
             </div> --}}

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
