<div class="container">
    <h2 class="my-4">Budgetisation par Portefeuille</h2>

    @foreach ($wallets as $wallet)
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-uppercase">{{ $wallet->name }}</h3>
                <p>Montant total : {{ number_format($wallet->calculateTotalAmount(), 2) }} </p>
            </div>

            <div class="card-body">
                @foreach ($defaultCategories as $type)
                    <div class="card mb-3">
                        <div class="card-header row">
                            <div class="col-8">
                                <h4 class="text-capitalize">{{ $type->name }}</h4>
                            </div>
                            <div class="col text-end">
                                @php
                                    $defaultCategoryBudget = $wallet->defaultCategoryBudgets->firstWhere(
                                        'default_category_id',
                                        $type->id,
                                    );

                                    $isFixed = $type->id == 1; // 1 pour fixe, 2 pour variable
                                    $budgetValue = $defaultCategoryBudget
                                        ? ($isFixed
                                            ? $defaultCategoryBudget->amount
                                            : $defaultCategoryBudget->percentage)
                                        : '';

                                    $budgetValue = isset($budgetValue) ? floatval($budgetValue) : 0;
                                @endphp
                                {{ $isFixed ? 'Budget Global :' : 'Pourcentage Global :' }}
                                {{ $budgetValue ? ($isFixed ? number_format($budgetValue, 2) : $budgetValue . '%') : 'Non défini' }}

                                @if ($budgetValue)
                                    <small>(
                                        {{ $isFixed
                                            ? number_format(100 * ($budgetValue / $wallet->calculateTotalAmount()), 2) . '%'
                                            : number_format($wallet->calculateTotalAmount() * ($budgetValue / 100), 2) }})
                                    </small>
                                @endif


                                @if ($isFixed)
                                    <input type="number"
                                        class="form-control mt-2 mb-2 @error('budgets.' . $wallet->id . '.' . $type->id . '.amount') is-invalid @enderror"
                                        wire:model.live="budgets.{{ $wallet->id }}.{{ $type->id }}.amount"
                                        value="{{ $budgetValue }}" placeholder="Attribuer un montant global">

                                    @error('budgets.' . $wallet->id . '.' . $type->id . '.amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @if ($fixedBudgetAmount[$wallet->id] ?? 0 != 0)
                                        <small class="text-info">Pourcentage du montant saisi:
                                            {{ number_format($fixedBudgetAmount[$wallet->id] ?? 0, 2) }} %</small>
                                    @endif
                                @else
                                    <input type="number"
                                        class="form-control mt-2 mb-2 @error('budgets.' . $wallet->id . '.' . $type->id . '.percentage') is-invalid @enderror"
                                        wire:model.live="budgets.{{ $wallet->id }}.{{ $type->id }}.percentage"
                                        value="{{ $budgetValue }}" placeholder="Attribuer un pourcentage global">

                                    @error('budgets.' . $wallet->id . '.' . $type->id . '.percentage')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @if ($variableBudgetPercentageAmount[$wallet->id] ?? 0 != 0)
                                        <small class="text-info">Montant du pourcentage saisi:
                                            {{ number_format($variableBudgetPercentageAmount[$wallet->id] ?? 0, 2) }}
                                        </small>
                                    @endif
                                @endif

                            </div>
                        </div>

                        <div class="card-body">
                            @include('livewire.budget.partials.categoryBudgetTable')
                        </div>
                    </div>
                @endforeach
                <div class="text-end">

                    @if (floatval($fixedBudgetAmount[$wallet->id] ?? 0) + floatval($variableBudgetPercentage[$wallet->id] ?? 0) > 100)
                        <small><span class="text-danger">Répartis a plus de 100% (
                                {{ number_format(floatval($fixedBudgetAmount[$wallet->id] ?? 0) + floatval($variableBudgetPercentage[$wallet->id] ?? 0), 2) }}%)</span></small>
                    @endif
                    <button class="btn btn-primary mt-3" wire:click="DefaultCategoryBudgetAdd({{ $wallet->id }})"
                        @if (floatval($fixedBudgetAmount[$wallet->id] ?? 0) + floatval($variableBudgetPercentage[$wallet->id] ?? 0) < 0 ||
                                floatval($fixedBudgetAmount[$wallet->id] ?? 0) + floatval($variableBudgetPercentage[$wallet->id] ?? 0) > 100 ||
                                $submittedWalletId == $wallet->id) disabled @endif>
                        Enregistrer les budgets pour ce portefeuille
                    </button>

                </div>
            </div>
        </div>
    @endforeach

</div>
