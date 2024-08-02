<div>
    <h4 class="card-title  mb-2">Liste des revenus</h4>
    @if ($incomes->count() > 0)
    <div class="table-responsive">
        <table class="table table-sm table-striped">
            <thead class="">
                <tr class="bg-ptext-white">
                    <th>Date</th>
                    <th>Compte</th>
                    <th>catégorie</th>
                    <th>Montant</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomes as $income)
                    
                <tr>
                    <td>{{ $income->created_at->format('d-m-Y') }}</td>
                    <td>
                        @if ($editIncomeId != $income->id)
                        {{ $income->account->name }} <br>
                            
                        @else
                            
                            <select wire:model="newAccountId" class="form-select @error('newAccountId') is-invalid @enderror ">
                                <option>Sélectionner un compte</option>
                                @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                            </select>
                            @error('newAccountId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @endif
                    </td>
                    <td>
                        @if ( $editIncomeId != $income->id)
                        {{ $income->incomeCategory->name }}
                            
                        @else
                            <select wire:model="newIncomeCategoryId" class="form-select @error('newIncomeCategoryId') is-invalid @enderror ">
                                <option>Sélectionner une categorie</option>
                                @foreach ($income_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('newIncomeCategoryId')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                            
                        @endif

                    </td>
                    <td>
                        @if ($editIncomeId != $income->id)
                            
                        {{ $income->amount }}
                        @else
                
                            <input type="number" wire:model="newAmount" class="form-control  @error('newAmount') is-invalid @enderror"
                            value="{{ old('newAmount') }}" min="1">
                        @error('newAmount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @endif

                    </td>

                    <td class="right-category">
                        @if ($editIncomeId != $income->id)
                        <a href="#" wire:click.prevent="editIncomeFormShowFunction({{ $income->id }})" class=" btn btn-sm btn-warning mb-1"><i class="fi fi-rs-pencil"></i></a>
                        <a href="#" wire:click="" class=" btn btn-sm btn-danger mb-1"><i class="fi fi-rs-trash"></i></a>
                            
                        @else
                        <a href="#" title="Mettre à jour " wire:click.prevent="updateIncomeFunction" class=" btn btn-sm btn-success mb-1"><i class="fi fi-bs-refresh"></i></a>
                        <a href="#" title="Annuler la mise à jour " wire:click.prevent="hideIncomeFormShowFunction" class=" btn btn-sm btn-danger mb-1"><i class="fi fi-rr-circle-xmark"></i></a>

                        @endif
                        {{-- <span><i class="fi fi-rs-pencil"></i></span> --}}
                        {{-- <span><i class="fi fi-rr-eye"></i></span> --}}
                        {{-- <span><i class="fi fi-rr-trash"></i></span> --}}
                    </td>

                
                </tr>
                @endforeach
             
            </tbody>
        </table>
        {{ $incomes->links() }}
    </div>
       
    @else
        <div>
            <span class="text-info">Vous n'avez pas de revenu enregistré</span>
        </div>
    @endif

    {{-- <livewire:walletManagerComponent/> --}}
    {{-- @livewire('walletManagerComponent', ['walletId' => $walletId], key($walletId)) --}}

</div>
