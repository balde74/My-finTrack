<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>{{ $isFixed ? 'Montant attribué' : 'Pourcentage attribué' }} </th>
                <th>{{ $isFixed ? 'Pourcentage du montant' : 'Montant du pourcentage' }}
                </th>
                <th>Nouvelle attribution</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalBudgetAmount = 0;
            @endphp
            @foreach ($type->categories->where('user_id',Auth::id()) as $category)
                @php
                    // Accédez aux budgets de chaque catégorie pour le portefeuille actuel
                    $categoryBudget = $categoryBudgets[$wallet->id][$category->id] ?? null;

                    // recuperation du montant total des charges fixes
                    $isFixed
                        ? ($totalBudgetAmount += isset($categoryBudget['amount'])
                            ? floatVal($categoryBudget['amount'])
                            : 0)
                        : ($totalBudgetAmount += isset($categoryBudget['percentage'])
                            ? floatval($categoryBudget['percentage'])
                            : 0);
                    // : (isset($categoryBudget['percentage']) ? $wallet->calculateTotalAmount() * ($budgetValue / 100) * ($categoryBudget['percentage'] / 100) : 0);
                    // dd('je doit determiner la somme des budgets saisie');
                @endphp
                <tr>
                    <td>{{ $category->name }}</td>
                    <td> {{ $isFixed
                        ? (isset($categoryBudget['amount'])
                            ? floatval($categoryBudget['amount']) . ' '
                            : 'Non défini')
                        : (isset($categoryBudget['percentage'])
                            ? floatval($categoryBudget['percentage']) . ' %'
                            : 'Non défini') }}
                    </td>
                    <td> {{ $isFixed
                        ? (isset($categoryBudget['amount'])
                            ? number_format(100 * (floatval($categoryBudget['amount']) / $budgetValue), 2) . '%'
                            : 'Non défini')
                        : (isset($categoryBudget['percentage'])
                            ? number_format(
                                $wallet->calculateTotalAmount() * ($budgetValue / 100) * (floatval($categoryBudget['percentage']) / 100),
                                2,
                            )
                            : 'Non défini') }}
                    </td>



                    <td>
                        @if ($isFixed)
                            <input type="number" class="form-control" name="" value="{{ $category->budget }}"
                                wire:model.live="categoryBudgets.{{ $wallet->id }}.{{ $category->id }}.amount"
                                @if (!$defaultCategoryBudget) disabled  placeholder="Budget global non défini " @endif>
                            @error('categoryBudgets.' . $wallet->id . '.' . $category->id . '.amount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @else
                            <input type="number" class="form-control" name="" value="{{ $category->budget }}"
                                wire:model.live="categoryBudgets.{{ $wallet->id }}.{{ $category->id }}.percentage"
                                @if (!$defaultCategoryBudget) disabled  placeholder="Budget global non défini " @endif>
                            @error('categoryBudgets.' . $wallet->id . '.' . $category->id . '.percentage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        @endif

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <button wire:click="categoryBudgetAdd({{ $wallet->id }})" class="btn btn-primary mt-2"
            @if ($isFixed) 
                @if ($totalBudgetAmount > $budgetValue || $totalBudgetAmount <= 0)
                    disabled
                @endif 
             @else
                @if ($totalBudgetAmount > 100 || $totalBudgetAmount <= 0) 
                    disabled 
                @endif
             @endif
        >
        <i class="fi fi-ss-disk"></i>
        {{ $isFixed ? 'Charges fixes' : 'Charges variables' }}
    </button>
    <small class="text-warning">
        @if ($isFixed)
            @if ($totalBudgetAmount > $budgetValue )
            Somme des montants saisis supérieure au budget total ( {{ $totalBudgetAmount }} )
            @endif
        @else
            @if ($totalBudgetAmount > 100 )
            Somme des pourcentage saisis supérieure à 100 ( {{ $totalBudgetAmount }} % )
            @endif
        @endif
    </small>
 

</div>
