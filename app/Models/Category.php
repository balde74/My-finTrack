<?php

namespace App\Models;

use App\Models\Expense;
use App\Models\DefaultCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','default_category_id','user_id'];

    public function DefaultCategory()
    {
        return $this->belongsTo(DefaultCategory::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
