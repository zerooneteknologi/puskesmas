<?php

namespace App\Http\Controllers;

use App\Models\Suport;
use Illuminate\Http\Request;

class SuportController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'suport_name' => '',
            'suport_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('suport.index', [
            'suports' => Suport::all(),
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

        Suport::create($validated);

        return redirect()
            ->route('suport.index')
            ->with('success', "Berhasil Menambahakan $request->suport_name !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Suport $suport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suport $suport)
    {
        return view('suport.edit', [
            'suport' => $suport,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suport $suport)
    {
        $validated = $this->validateData($request);

        $suport->update($validated);

        return redirect()
            ->route('suport.index')
            ->with('success', "Berhasil Ubah $request->suport_name !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suport $suport)
    {
        $suport->delete();

        return redirect()
            ->route('suport.index')
            ->with('success', "Berhasil hapus $suport->suport_name !");
    }
}
