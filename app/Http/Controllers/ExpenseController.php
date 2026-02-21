<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $expenses = Auth::user()->expenses()->orderBy('date', 'desc')->paginate(10);
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('expenses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|in:' . implode(',', $this->getCategories()),
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Auth::user()->expenses()->create($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense recorded successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\View\View
     */
    public function edit(Expense $expense)
    {
        $this->authorizeOwner($expense);
        $categories = $this->getCategories();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Expense $expense)
    {
        $this->authorizeOwner($expense);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|in:' . implode(',', $this->getCategories()),
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Expense $expense)
    {
        $this->authorizeOwner($expense);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    /**
     * Authorize that the user owns the expense record.
     *
     * @param  \App\Models\Expense  $expense
     * @return void
     */
    protected function authorizeOwner(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }
    }

    /**
     * Get the defined expense categories.
     *
     * @return array
     */
    protected function getCategories()
    {
        return [
            'Household / Living',
            'Food & Snacks',
            'Transportation',
            'Communication & Internet',
            'Personal & Essentials',
            'Education / Office',
            'Health',
            'Family & Social',
            'Financial',
        ];
    }
}
