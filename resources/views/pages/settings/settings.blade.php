@extends('layouts.app')
@section('content')
<div id="main-wrapper">
    <div class="content-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-4">
                                <div class="page-title-content">
                                    <h3>Parametres</h3>
                                    <p class="mb-2">Welcome Ekash Finance Management</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="breadcrumbs"><a href="#">Home </a>
                                    <span><i class="fi fi-rr-angle-small-right"></i></span>
                                    <a href="#">{{ Route::currentRouteName() }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-12 col-xl-12">
                    <livewire:SettingsMenu />

                    {{-- @if (request()->routeIs('settings'))
                        <livewire:settings-account />
                    @elseif (request()->routeIs('settings.bank'))
                        <livewire:settings-bank />
                    @endif

                    <livewire:settings-account/>
                    <livewire:settings-bank/> --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
