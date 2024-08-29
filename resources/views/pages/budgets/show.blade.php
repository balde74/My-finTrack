@extends('layouts.app')
@section('content')
    <div class="content-body">
        <div class="container">
            @include('layouts.partials.header_title', [
                'title' => 'Budgets',
                'current_page' => 'Budgets',
                'sectionTitle' => 'Accueil',
            ])
            {{-- <livewire:wallets-component /> --}}
            {{-- @livewire('wallets-component', ['position' => $position]) --}}
            @livewire('budget-component', ['position' => $position])
            
        </div>
    </div>
@endsection
