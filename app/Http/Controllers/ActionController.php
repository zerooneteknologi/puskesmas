<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'action_category' => '',
            'action_name' => '',
            'action_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('action.index', [
            'actions' => Action::all(),
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
        $validated = $this->validateData($request);

        Action::create($validated);

        return redirect()
            ->route('action.index')
            ->with('success', "Berhasil Menambahkan $request->action_name !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Action $action)
    {
        return view('action.edit', [
            'action' => $action,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Action $action)
    {
        $validated = $this->validateData($request);

        $action->update($validated);

        return redirect()
            ->route('action.index')
            ->with('success', "Berhasil merubah $action->action_name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Action $action)
    {
        $action->delete();

        return redirect()
            ->route('action.index')
            ->with('success', "Berhasil hapus $action->action_name");
    }
}
