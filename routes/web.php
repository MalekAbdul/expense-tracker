<?php

use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider and all of them will | be assigned to the "web" middleware group. Make something great! | */

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $totalIncome = $user->incomes()->sum('amount');
    $totalExpense = $user->expenses()->sum('amount');
    $balance = $totalIncome - $totalExpense;

    $recentIncomes = $user->incomes()->orderBy('date', 'desc')->take(5)->get();
    $recentExpenses = $user->expenses()->orderBy('date', 'desc')->take(5)->get();

    // Map and merge recent transactions for a single list
    $recentTransactions = $recentIncomes->map(function ($item) {
            $item->type = 'income';
            return $item;
        }
        )->concat($recentExpenses->map(function ($item) {
            $item->type = 'expense';
            return $item;
        }
        ))->sortByDesc('date')->take(5);

        // Analytics: Last 7 days expenses
        $chartData = collect(range(6, 0))->mapWithKeys(function ($days) use ($user) {
            $date = now()->subDays($days)->format('Y-m-d');
            $amount = $user->expenses()->whereDate('date', $date)->sum('amount');
            return [now()->subDays($days)->format('D') => $amount];
        }
        );

        $chartLabels = $chartData->keys()->toArray();
        $chartValues = $chartData->values()->toArray();

        // Analytics: Category breakdown
        $categoryData = $user->expenses()
            ->selectRaw('category, sum(amount) as total')
            ->groupBy('category')
            ->having('total', '>', 0)
            ->get();

        $catLabels = $categoryData->pluck('category')->toArray();
        $catValues = $categoryData->pluck('total')->toArray();

        return view('dashboard', compact(
        'totalIncome', 'totalExpense', 'balance', 'recentTransactions',
        'chartLabels', 'chartValues', 'catLabels', 'catValues'
        ));
    })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');

    Route::resource('incomes', IncomeController::class);
    Route::resource('expenses', \App\Http\Controllers\ExpenseController::class);
});

require __DIR__ . '/auth.php';
