<div>
    <h4 class="card-title  mb-2">Liste des dépenses</h4>
    @if ($expenses->count() > 0)
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead class="">
                    <tr class="bg-ptext-white">
                        <th>Date</th>
                        <th>Portefeuille</th>
                        <th>Catégorie</th>
                        <th>Montant</th>
                        <th>Comptes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses->sortByDesc('created_at') as $expense)
                        <tr>
                            {{-- <td>{{ $expense->created_at->format('d-m-Y') }}</td> --}}
                            <td>{{ $expense->created_at->diffForHumans() }}</td>
                            <td>{{ $expense->wallet->name }}</td>
                            <td>{{ $expense->category->name }}(<small>{{ $expense->category->DefaultCategory->name }}</small>)</td>
                            <td>{{ number_format($expense->amount,2) }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    @foreach ($expense->expenseAllocations as $account)
                                        <div class="d-flex justify-content-between">
                                            <div class="me-2"><strong>{{ $account->account->name }}</strong></div>
                                            <div class="me-2">{{ $account->allocation_percentage }}%</div>
                                            <div>{{ number_format($account->amount, 2) }} </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>

                            </td>
                            <td class="right-category">
                                {{-- @if ($editCategoryId != $category->id) --}}
                                    <a href="#"
                                       wire:click="showExpenseEditFormFunction({{ $expense->id }})"
                                        class=" btn btn-sm btn-warning mb-1"><i class="fi fi-rs-pencil"></i></a>
                                
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $expenses->links() }}
        </div>
    @else
        <div>
            <span class="text-info">Vous n'avez pas de revenu enregistré</span>
        </div>
    @endif

    {{-- <livewire:walletManagerComponent/> --}}
    {{-- @livewire('walletManagerComponent', ['walletId' => $walletId], key($walletId)) --}}

</div>
