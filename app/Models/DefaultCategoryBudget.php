<?php

namespace App\Models;

use App\Models\DefaultCategory;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultCategoryBudget extends Model
{
    use HasFactory;

    protected $fillable = ['wallet_id', 'default_category_id', 'amount', 'percentage', 'user_id'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    /**
     * Relation avec la catégorie par défaut associée.
     */
    public function defaultCategory()
    {
        return $this->belongsTo(DefaultCategory::class);
    }

    public function is_fixed()
    {

        return !is_null($this->amount) && is_null($this->percentage);
    }

}
