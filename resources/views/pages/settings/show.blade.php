@extends('layouts.app', ['title' => 'Account'])

@section('content')
    <div class="content-body">
        <div class="container">


            @livewire('SettingsComponent')

        </div>
    </div>
@endsection


{{-- <script>
     window.livewire.on('account', data => {
        // Votre code JavaScript ici

    toastr.success("Complete your profile to make it easier to finance", "Complete your profile!", {
        // timeOut: 500000,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        positionClass: "toast-top-right demo_rtl_class",
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1,
        closeHtml: '<span class="progress-count"></span> <i class="close-toast fi fi-rr-cross-small"></i> <a href="#">Suggest</a>'
    })


    });
    </script> --}}

{{-- @push('scripts')
        
        <script>
        $wire.on('account', () => {
            alert('djfj')
        });
        </script>
    @endpush --}}

{{-- @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('account', () => {
                notify({
                    type: 'success',
                    title: 'Success',
                    message: 'Account updated successfully.'
                });
            });
        });
    </script>
@endpush --}}
