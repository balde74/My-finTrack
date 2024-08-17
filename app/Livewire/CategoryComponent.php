<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\DefaultCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $name, $default_category_id;
    // public $categories, $default_categories;
    public $editCategoryId, $newDefaultCategoryId, $newCategoryName;


    public function AddCategory()
    {
        $this->validate([
            'name' => 'required',
            // 'default_category_id'=>'required|exists:default_categories,id'
            'default_category_id' => 'required',
        ]);
        Category::create([
            'name' => $this->name,
            'default_category_id' => $this->default_category_id,
            'user_id' => Auth::id(),
        ]);
        $this->reset(['name', 'default_category_id']);

    }

    public function editCategoryFormShowFunction($id)
    {
        $category = Category::findOrFail($id);

        $this->newDefaultCategoryId = $category->default_category_id;
        $this->newCategoryName = $category->name;
        $this->editCategoryId = $category->id;

        //reinitialisation des message d'erreur
        // $this->resetErrorBag();
    }

    public function hideCategoryFormShowFunction()
    {
        $this->editCategoryId = null;
    }

    public function updateCategoryFunction()
    {
        $this->validate([
            'newDefaultCategoryId' => 'required',
            'newCategoryName' => 'required',
        ]);

        $category = Category::findOrFail($this->editCategoryId);

        $category->update([
            'name' => $this->newCategoryName,
            'default_category_id' => $this->newDefaultCategoryId,
        ]);
        $this->editCategoryId = null;
    }
    public function render()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $default_categories = DefaultCategory::all();

        return view('livewire.category.category-component', [
            'default_categories' => $default_categories,
            'categories' => $categories,
        ]);
    }
}
