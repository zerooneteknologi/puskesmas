<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'emergency_name' => '',
            'emergency_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('emergency.index', [
            'emergencies' => Emergency::all(),
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

        Emergency::create($validated);

        return redirect()
            ->route('emergency.index')
            ->with('success', 'Berhasil Menambahkan Perwatan UGD Baru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Emergency $emergency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emergency $emergency)
    {
        return view('emergency.edit', [
            'emergency' => $emergency,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Emergency $emergency)
    {
        $validated = $this->validateData($request);

        $emergency->update($validated);

        return redirect()
            ->route('emergency.index')
            ->with('success', 'Berhasil Merubah Perwatan UGD!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emergency $emergency)
    {
        $emergency->delete();

        return redirect()
            ->route('emergency.index')
            ->with('success', 'Berhasil Menghapus Perwatan UGD!');
    }
}
