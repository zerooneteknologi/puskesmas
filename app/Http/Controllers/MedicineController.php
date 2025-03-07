<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'medicine_name' => '',
            'medicine_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('medicine.index', [
            'medicines' => Medicine::all(),
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

        Medicine::create($validated);

        return redirect()
            ->route('medicine.index')
            ->with('success', "Berhasil Menambahkan $request->medicine_name !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicine.edit', [
            'medicine' => $medicine,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $validated = $this->validateData($request);

        $medicine->update($validated);

        return redirect()
            ->route('medicine.index')
            ->with('success', "Berhasil Mengubah $request->medicine_name !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()
            ->route('medicine.index')
            ->with('success', "Berhasil hapus $medicine->medicine_name !");
    }
}
