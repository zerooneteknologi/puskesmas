<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = Pasien::all()->load('notes');
        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien.table', [
            'pasiens' => Pasien::all()->load('notes'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        // render view
        return view('pdf.note', [
            'pasien' => $pasien->load('notes'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validatedata = $request->validate([
            'pasien_nomor' => '',
            'pasien_name' => '',
            'pasien_age' => '',
            'pasien_address' => '',
            'pasien_status' => '',
            'pasien_in' => '',
            'pasien_out' => '',
            'pasien_sum' => '',
            'pasien_room' => '',
            'pasien_diagnoses' => '',
            'pasien_discount' => '',
        ]);

        $pasien->update($validatedata);

        return redirect()->route('pasien.show', $pasien->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()
            ->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }

    /**
     * filter listing form storage
     */
    public function filter(Request $request)
    {
        $pasiens = Pasien::filter($request)->get();

        return view('pasien.table', [
            'pasiens' => $pasiens,
        ]);
    }

    public function print()
    {
        return view('pdf.noteall', [
            'pasiens' => Pasien::with('notes')->get(),
        ]);
    }
}
