@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="container">
            @include('layouts.partials.header_title', [
                'title' => 'Portefeuilles',
                'current_page' => 'Portefeuilles',
                'sectionTitle' => 'Accueil',
            ])
            {{-- <livewire:wallets-component /> --}}
            @livewire('wallets-component', ['position' => $position])
            
        </div>
    </div>
@endsection
