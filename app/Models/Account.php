<?php

namespace App\Models;

use App\Models\User;
use App\Models\Income;
use App\Models\Wallet;
use App\Models\ExpenseAllocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['name','balance','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallets()
    {
        return $this->belongsToMany(Wallet::class)->withPivot('percentage');
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenseAllocations()
    {
        return $this->hasMany(ExpenseAllocation::class);
    }
}

