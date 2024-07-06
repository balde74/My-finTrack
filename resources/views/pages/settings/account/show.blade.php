@extends('layouts.app',['title'=>'Account'])

@section('content')
    <div class="content-body">
        <div class="container">
          @include('layouts.partials.header_title',['title'=>'Parametres','current_page'=>'Compte'])
            <div class="row">
                <div class="col-xxl-12 col-xl-12">
                    <div class="settings-menu">
                        <a href="{{ route('account.show', Auth::user()->id) }}">Comptes</a>
                        {{-- <a href="settings-general.html">General</a>
                        <a href="settings-profile.html">Profile</a>
                        <a href="settings-bank.html">Add Bank</a>
                        <a href="settings-security.html">Security</a>
                        <a href="settings-session.html">Session</a>
                        <a href="settings-categories.html">Categories</a>
                        <a href="settings-currencies.html">Currencies</a>
                        <a href="settings-api.html">Api</a>
                        <a href="support.html">Support</a> --}}
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gestion des comptes financiers</h4>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                            
                               <div class="col-md-4 mr-1 p-2 " style="border-right: 2px solid rgb(82, 81, 81)" >
                                   <livewire:create-account-component/>
                                </div>
                                    <div class="col-md-8 p-2">
                                        <livewire:account-component/>
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
                </div>
            </div>
        </div>
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
