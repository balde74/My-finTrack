<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseAllocation extends Model
{
    use HasFactory;
    protected $fillable = ['expense_id', 'account_id', 'allocation_percentage', 'amount'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
