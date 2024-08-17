<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ExpenseAllocation;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'category_id', 'wallet_id', 'user_id', 'description', 'date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function expenseAllocations()
    {
        return $this->hasMany(ExpenseAllocation::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
