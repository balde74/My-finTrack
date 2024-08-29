<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'category_id', 'default_category_id', 'amount', 'percentage', 'user_id'];
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
