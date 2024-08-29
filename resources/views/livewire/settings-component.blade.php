<div>
    @include('layouts.partials.header_title', [
        'title' => 'Paramètres',
        'current_page' => $currentPageText,
        'sectionTitle' => 'Paramètres',
    ])

    <div class="row">

        <div class="col-xxl-12 col-xl-12">
            <div class="settings-menu">
                <a href="#" wire:click.prevent="setPage('accounts','Comptes')"
                    class="{{ $currentPage == 'accounts' ? 'active' : '' }}">Comptes</a>
                <a href="#" wire:click.prevent="setPage('wallets','Portefeuilles')"
                    class="{{ $currentPage == 'wallets' ? 'active' : '' }}">Portefeuilles</a>
                {{-- <a href="#" wire:click.prevent="setPage('profile','Profile')"
                    class="{{ $currentPage == 'profile' ? 'active' : '' }}">Profile</a> --}}
                <a href="#" wire:click.prevent="setPage('incomes','Revenus')"
                    class="{{ $currentPage == 'incomes' ? 'active' : '' }}">Revenus</a>
                <a href="#" wire:click.prevent="setPage('categories','Catégories')"
                    class="{{ $currentPage == 'categories' ? 'active' : '' }}">Catégories</a>

                <a href="#" wire:click.prevent="setPage('expenses','Dépenses')"
                    class="{{ $currentPage == 'expenses' ? 'active' : '' }}">Dépenses</a>

                <a href="#" wire:click.prevent="setPage('budgets','Budgets')"
                    class="{{ $currentPage == 'budgets' ? 'active' : '' }}">Budgets</a>
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


            <div class="content">
                @if ($currentPage == 'accounts')
                    <livewire:account.account-component />
                @elseif ($currentPage == 'wallets')
                    <livewire:wallets-component />
                @elseif ($currentPage == 'incomes')
                    <livewire:income-component />
                @elseif ($currentPage == 'categories')
                    <livewire:category-component />
                @elseif ($currentPage == 'expenses')
                    <livewire:expense-component />
                    @elseif ($currentPage == 'budgets')
                    <livewire:budget-component />
                @endif
            </div>
        </div>
    </div>
</div>
