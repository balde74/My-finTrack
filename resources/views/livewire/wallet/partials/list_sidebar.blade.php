<div class="wallet-tab">
    <div class="row g-0">
        <div class="col-xl-3">
            <div class="nav d-block">
                <div class="row">

                    @foreach ($wallets as $wallet)
                        <div class="col-xl-12 col-md-6">
                            <div class="wallet-nav {{ $loop->first ? 'active' : '' }}" data-bs-toggle="pill"
                                data-bs-target="#w_{{ $wallet->id }}">
                                <div class="wallet-nav-icon">
                                    <span><i class="fi fi-sr-wallet"></i></span>
                                </div>
                                <div class="wallet-nav-text">
                                    <h3 class="text-uppercase">{{ $wallet->name }}</h3>
                                    <p>{{ number_format($wallet->calculateTotalAmount(), 2) }} </p>
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
                @foreach ($wallets as $wallet)
                    <div class="tab-pane show {{ $loop->first ? 'active' : '' }}" id="w_{{ $wallet->id }}">
                        <div class="wallet-tab-title">
                            <h3 class="text-uppercase">{{ $wallet->name }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="wallet-total-balance">
                                            <p class="mb-0">Montant total du portefeuille</p>
                                            <h2>{{ number_format($wallet->calculateTotalAmount(), 2) }}</h2>
                                        </div>

                                        <h6 class="mb-0">Compte(s) associé(s)</h6>
                                        @foreach ($wallet->accounts as $account)
                                            <div class="funds-credit">
                                                <p class="mb-0">{{ $account->name }}</p>
                                                <p>{{ $account->pivot->percentage }} %</p>
                                                <h5>{{ number_format($account->balance * ($account->pivot->percentage / 100), 2) }}
                                                </h5>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="stat-widget-1">
                                        <h6>Dépense(s) Mensuelle(s)</h6>

                                        <h3>{{ number_format($wallet->monthlyExpenses['currentMonth'], 2) }}</h3>
                                        <p>
                                            @if ($wallet->monthlyExpenses['percentageDifference'] > 0)
                                                <span class="text-success"><i class="fi fi-rr-arrow-trend-up"></i>
                                                    {{ $wallet->monthlyExpenses['percentageDifference'] }}%</span>
                                                Mois précedent:
                                                <strong>{{ number_format($wallet->monthlyExpenses['previousMonth'], 2) }}</strong>
                                            @elseif ($wallet->monthlyExpenses['percentageDifference'] == 0)
                                                <span class="text-secondary"><i class="fi fi-rs-arrow-right"></i>
                                                    {{ $wallet->monthlyExpenses['percentageDifference'] }}%</span>
                                                Mois précedent:
                                                <strong>{{ number_format($wallet->monthlyExpenses['previousMonth'], 2) }}</strong>
                                            @else
                                                <span class="text-danger"><i class="fi fi-rr-arrow-trend-down"></i>
                                                    {{ $wallet->monthlyExpenses['percentageDifference'] }}%</span>
                                                Mois précedent:
                                                <strong>{{ number_format($wallet->monthlyExpenses['previousMonth'], 2) }}</strong>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="stat-widget-1">
                                        <h6>Revenu(s) Mensuel(s)</h6>
                                      
                                        <h3>{{ number_format($wallet->monthlyIncomes['currentMonth'] , 2) }}</h3>
                                        <p>
                                            @if ($wallet->monthlyIncomes['percentageDifference'] > 0)
                                                <span class="text-success"><i class="fi fi-rr-arrow-trend-up"></i> {{ $wallet->monthlyIncomes['percentageDifference'] }}%</span>
                                                Mois précedent: <strong>{{ number_format($wallet->monthlyIncomes['previousMonth'] ,2)}}</strong>
                                                @elseif ($wallet->monthlyIncomes['percentageDifference'] == 0)
                                                <span class="text-secondary"><i class="fi fi-rs-arrow-right"></i> {{ $wallet->monthlyIncomes['percentageDifference'] }}%</span>
                                                Mois précedent: <strong>{{ number_format($wallet->monthlyIncomes['previousMonth'] ,2)}}</strong>
                                            @else
                                            <span class="text-danger"><i class="fi fi-rr-arrow-trend-down"></i> {{ $wallet->monthlyIncomes['percentageDifference'] }}%</span>
                                            Mois précedent: <strong>{{ number_format($wallet->monthlyIncomes['previousMonth'] ,2)}}</strong>
                                            @endif
                                        </p>
                                    </div>
                                </div> --}}

                            </div>


                            <div class="col-xxl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Balance Overtime</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="chartjsBalanceOvertime"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Historique des Transactions</h4>
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
                                                        @foreach ($wallet->expenses as $expense)
                                                        <tr>
                                                            <td>{{ $expense->created_at->format('d-m-Y') }}</td>
                                                            {{-- <td>{{ $expense->created_at->diffForHumans() }}</td> --}}
                                                            <td>{{ $expense->wallet->name }}</td>
                                                            <td>{{ $expense->category->name }}(<small>{{ $expense->category->DefaultCategory->name }}</small>)
                                                            </td>
                                                            <td>{{ number_format($expense->amount, 2) }}</td>
                                                            <td>
                                                                <div class="d-flex flex-column">
                                                                    @foreach ($expense->expenseAllocations as $account)
                                                                        <div class="d-flex justify-content-between">
                                                                            <div class="me-2">
                                                                                <strong>{{ $account->account->name }}</strong>
                                                                            </div>
                                                                            <div class="me-2">
                                                                                {{ $account->allocation_percentage }}%
                                                                            </div>
                                                                            <div>
                                                                                {{ number_format($account->amount, 2) }}
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    @endforeach
                                                                </div>

                                                            </td>


                                                        </tr>
                                          @endforeach
                                                    </tbody>
                                                </table>
                                                {{-- {{ $expenses->links() }} --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>

        </div>
    </div>


</div>
