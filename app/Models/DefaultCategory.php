<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DefaultCategory extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
