<?php

namespace App\Models;

use App\Models\Income;
use App\Models\Account;
use App\Models\IncomeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Income extends Model
{
    use HasFactory;
    protected $fillable = ['amount','account_id','income_category_id','description','user_id'];

    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
