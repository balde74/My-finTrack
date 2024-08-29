<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Budget;
use App\Models\Account;
use App\Models\Expense;
use App\Models\DefaultCategoryBudget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class)->withPivot('percentage');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function defaultCategoryBudgets()
    {
        return $this->hasMany(DefaultCategoryBudget::class);
    }

    public function CategoryBudgets()
    {
        return $this->hasMany(Budget::class);
    }
    
    // montant total du wallet
    public function calculateTotalAmount()
    {
        $totalAmount = 0;
        foreach ($this->accounts as $account) {
            // Le montant pour chaque compte est calculé comme: balance * (pourcentage / 100)
            $totalAmount += ($account->balance * $account->pivot->percentage) / 100;
        }
        return $totalAmount;
    }

    public function getMonthlyExpensesAttribute()
    {
        // Dépenses du mois en cours
        $currentMonthExpenses = $this->expenses()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        // Dépenses du mois précédent
        $previousMonthExpenses = $this->expenses()
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->sum('amount');

        // Calcul du pourcentage de différence
        if ($previousMonthExpenses > 0) {
            $percentageDifference = (($currentMonthExpenses - $previousMonthExpenses) / $previousMonthExpenses) * 100;
        } else {
            $percentageDifference = $currentMonthExpenses > 0 ? 100 : 0;
        }

        // Retourner un tableau avec les deux montants
        return [
            'currentMonth' => $currentMonthExpenses,
            'previousMonth' => $previousMonthExpenses,
            'percentageDifference' => $percentageDifference,
        ];
    }

    // public function getMonthlyIncomesAttribute()
    // {
    //     // Dépenses du mois en cours
    //     $currentMonthIncomes = $this->incomes()
    //         ->whereMonth('created_at', Carbon::now()->month)
    //         ->whereYear('created_at', Carbon::now()->year)
    //         ->sum('amount');

    //     // Dépenses du mois précédent
    //     $previousMonthIncomes = $this->incomes()
    //         ->whereMonth('created_at', Carbon::now()->subMonth()->month)
    //         ->whereYear('created_at', Carbon::now()->subMonth()->year)
    //         ->sum('amount');

    //     // Calcul du pourcentage de différence
    //     if ($previousMonthIncomes > 0) {
    //         $percentageDifference = (($currentMonthIncomes - $previousMonthIncomes) / $previousMonthIncomes) * 100;
    //     } else {
    //         $percentageDifference = $currentMonthIncomes > 0 ? 100 : 0;
    //     }

    //     // Retourner un tableau avec les deux montants
    //     return [
    //         'currentMonth' => $currentMonthIncomes,
    //         'previousMonth' => $previousMonthIncomes,
    //         'percentageDifference' => $percentageDifference,
    //     ];
    // }
}
