<div class="wallet-tab">
    <div class="row g-0">
        <div class="col-xl-3">
            <div class="nav d-block">
                <div class="row">

                    @foreach ($accounts as $account)
                        <div class="col-xl-12 col-md-6">
                            <div class="wallet-nav {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill"
                                data-bs-target="#w_{{ $account->id }}">
                                <div class="wallet-nav-icon">
                                    <span><i class="fi fi-ss-coins"></i></span>
                                </div>
                                <div class="wallet-nav-text">
                                    <h3 class="text-uppercase">{{ $account->name }}</h3>
                                    {{-- <p>{{ number_format($wallet->calculateTotalAmount(), 2) }} </p> --}}
                                    <small>
                                        @if ($account->is_associated == 0)
                                            <span><i class="fi fi-sr-triangle-warning text-warning"></i></span> Non
                                            associé
                                        @elseif ($account->is_associated == 1)
                                            <span> <i class="fi fi-rr-info text-info"></i></span> Associé en partie
                                        @elseif ($account->is_associated == 2)
                                            <span><i class="fi fi-sr-badge-check text-success"></i></span> Associé
                                        @endif

                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            {{-- <div class="add-card-link">
                <h5 class="mb-0">Add new wallet</h5>
                <a href="add-new-account.html">
                    <i class="fi fi-rr-square-plus"></i>
                </a>
            </div> --}}
        </div>
        <div class="col-xl-9">
            <div class="tab-content wallet-tab-content">
                @foreach ($accounts as $account)
                    <div class="tab-pane show {{ $loop->first ? 'active' : '' }}" id="w_{{ $account->id }}">
                        <div class="wallet-tab-title">
                            <h3 class="text-uppercase">{{ $account->name }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="wallet-total-balance">
                                            <p class="mb-0">Montant total du compte</p>
                                            <h2>{{ number_format($account->balance, 2) }}</h2>

                                        </div>

                                        <h6 class="mb-0">Portefeuille(s) associé(s)</h6>
                                        <small> Pourcentage associé: {{ $account->wallets->sum('pivot.percentage') }}
                                            %</small>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($account->wallets as $wallet)
                                            @php
                                                $total += $account->balance * ($wallet->pivot->percentage / 100);
                                            @endphp
                                            <div class="funds-credit">
                                                <p class="mb-0">{{ $wallet->name }}</p>
                                                <p>{{ $wallet->pivot->percentage }} %</p>
                                                <h5>{{ number_format($account->balance * ($wallet->pivot->percentage / 100), 2) }}
                                                </h5>
                                            </div>
                                        @endforeach
                                        <p class="mb-0">Montant total attribué aux portefeuilles :
                                            <strong>{{ number_format($total, 2) }}</strong>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            @if ($account->incomes->count() >0)
                                
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Historique des revenus</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="transaction-table">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Catégorie</th>
                                                            <th>Montant</th>
                                                            <th>Comptes</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($account->incomes as $income)
                                                            <tr>
                                                                <td>{{ $income->created_at->format('d-m-Y') }}</td>
                                                                <td>{{ $income->incomeCategory->name }} </td>
                                                                <td>{{ number_format($income->amount, 2) }}</td>
                                                                <td>{{ $income->account->name }}</td>

                                                                <td>{{ $income->description }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if ($account->expenseAllocations->count() >0)
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Historique des dépenses</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="transaction-table">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Portefeuille</th>
                                                            <th>Catégorie</th>
                                                            <th>Montant</th>
                                                            <th>Comptes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($account->expenseAllocations as $expense)
                                                            <tr>
                                                                <td>{{ $expense->created_at->format('d-m-Y') }}</td>
                                                                <td>{{ $expense->expense->wallet->name }}</td>
                                                                <td>{{ $expense->expense->category->name }}(<small>{{ $expense->expense->category->DefaultCategory->name }}</small>)
                                                                </td>
                                                                <td>{{ number_format($expense->amount, 2) }}</td>
                                                                <td>{{ $expense->account->name }}</td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>


</div>
