<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::orderBy('name')->paginate(15);
        return view('assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'acquisition_date' => 'required|date',
            'value' => 'required|numeric|min:0',
            'status' => 'required|in:new,good,damaged,discarded',
        ]);

        Asset::create($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Item do patrimônio cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        return view('assets.show', compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'acquisition_date' => 'required|date',
            'value' => 'required|numeric|min:0',
            'status' => 'required|in:new,good,damaged,discarded',
        ]);

        $asset->update($validated);

        return redirect()->route('assets.index')
            ->with('success', 'Item do patrimônio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        $asset->delete();
        
        return redirect()->route('assets.index')
            ->with('success', 'Item do patrimônio removido com sucesso!');
    }
}
