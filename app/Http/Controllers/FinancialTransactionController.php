<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinancialTransaction;
use App\Models\Member;

class FinancialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = FinancialTransaction::with('member')
            ->orderBy('transaction_date', 'desc')
            ->paginate(15);
        
        return view('financial-transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::orderBy('first_name')->get();
        return view('financial-transactions.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'type' => 'required|in:tithe,donation,collection',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        FinancialTransaction::create($validated);

        return redirect()->route('financial-transactions.index')
            ->with('success', 'Transação financeira registrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->load('member');
        return view('financial-transactions.show', compact('financialTransaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialTransaction $financialTransaction)
    {
        $members = Member::orderBy('first_name')->get();
        return view('financial-transactions.edit', compact('financialTransaction', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialTransaction $financialTransaction)
    {
        $validated = $request->validate([
            'member_id' => 'nullable|exists:members,id',
            'type' => 'required|in:tithe,donation,collection',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $financialTransaction->update($validated);

        return redirect()->route('financial-transactions.index')
            ->with('success', 'Transação financeira atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->delete();
        
        return redirect()->route('financial-transactions.index')
            ->with('success', 'Transação financeira removida com sucesso!');
    }
}
