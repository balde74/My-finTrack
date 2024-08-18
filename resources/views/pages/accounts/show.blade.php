@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="container">
            @include('layouts.partials.header_title', [
                'title' => 'Comptes',
                'current_page' => 'Comptes',
                'sectionTitle' => 'Accueil',
            ])
            {{-- <livewire:wallets-component /> --}}
            @livewire('account.account-component', ['position' => $position])
            {{-- <livewire:account.account-component,['position', $position] /> --}}
            
        </div>
    </div>
@endsection
