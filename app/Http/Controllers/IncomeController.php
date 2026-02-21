<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $incomes = Auth::user()->incomes()->orderBy('date', 'desc')->paginate(10);
        return view('incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('incomes.create');
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
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Auth::user()->incomes()->create($validated);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\View\View
     */
    public function edit(Income $income)
    {
        $this->authorizeOwner($income);
        return view('incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Income $income)
    {
        $this->authorizeOwner($income);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'source' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $income->update($validated);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Income $income)
    {
        $this->authorizeOwner($income);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }

    /**
     * Authorize that the user owns the income record.
     *
     * @param  \App\Models\Income  $income
     * @return void
     */
    protected function authorizeOwner(Income $income)
    {
        if ($income->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
