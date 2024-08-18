<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseAllocation extends Model
{
    use HasFactory;
    protected $fillable = ['expense_id', 'account_id', 'allocation_percentage', 'amount'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

}
