<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function validateDate(Request $request)
    {
        return $data = $request->validate([
            'tool_name' => '',
            'tool_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tool.index', [
            'tools' => Tool::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateDate($request);

        Tool::create($validated);

        return redirect()
            ->route('tool.index')
            ->with('success', "Berhasil Menambahkan $request->tool_name !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        return view('tool.edit', [
            'tool' => $tool,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $validated = $this->validateDate($request);

        $tool->update($validated);

        return redirect()
            ->route('tool.index')
            ->with('success', "Berhasil merubah $request->tool_name !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        $tool->delete();

        return redirect()
            ->route('tool.index')
            ->with('success', "Berhasil hapus $tool->tool_name !");
    }
}
