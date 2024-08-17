<div>
    <h4 class="card-title mb-2">Liste des catégories</h4>
    @if ($categories->count() > 0)
        <div class="table-responsive">
            <table class="table mb-0 table-responsive-sm">
                <thead class="">
                    <tr class="bg-ptext-white">
                        <th>Catégorie</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                @if ($editCategoryId != $category->id)
                                    {{ $category->name }}
                                @else
                                    <input type="text" wire:model="newCategoryName"
                                        class="form-control  @error('newCategoryName') is-invalid @enderror"
                                        value="{{ old('newCategoryName') }}" min="1">
                                    @error('newCategoryName')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                            </td>
                            <td>
                                @if ($editCategoryId != $category->id)
                                    {{ $category->defaultCategory->name }}
                                @else
                                    <select wire:model="newDefaultCategoryId"
                                        class="form-select @error('newDefaultCategoryId') is-invalid @enderror ">
                                        <option>Sélectionner une categorie</option>
                                        @foreach ($default_categories as $default_category)
                                            <option value="{{ $default_category->id }}">{{ $default_category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('newDefaultCategoryId')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                @endif
                            </td>
                            <td class="right-category">
                                @if ($editCategoryId != $category->id)
                                    <a href="#"
                                        wire:click.prevent="editCategoryFormShowFunction({{ $category->id }})"
                                        class=" btn btn-sm btn-warning mb-1"><i class="fi fi-rs-pencil"></i></a>
                                @else
                                    <a href="#" title="Mettre à jour " wire:click.prevent="updateCategoryFunction"
                                        class=" btn btn-sm btn-success mb-1"><i class="fi fi-bs-refresh"></i></a>

                                    <a href="#" title="Annuler la mise à jour" wire:click.prevent="hideCategoryFormShowFunction"
                                        class=" btn btn-sm btn-danger mb-1"><i class="fi fi-rr-circle-xmark"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div>
            <span class="text-info">Vous n'avez pas de catégorie de dépense enregistrée</span>
        </div>
    @endif
</div>
