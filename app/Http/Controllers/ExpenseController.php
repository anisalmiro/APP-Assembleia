<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::orderBy('expense_date', 'desc')->paginate(15);
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Expense::create($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Despesa registrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')
            ->with('success', 'Despesa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        
        return redirect()->route('expenses.index')
            ->with('success', 'Despesa removida com sucesso!');
    }
}
