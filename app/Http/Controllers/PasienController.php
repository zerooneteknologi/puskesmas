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
        return view('pasien.index');
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
        $receiptPdf = view('pdf.receipt', [
            'pasien' => $pasien->load('notes'),
        ]);
        $notePdf = view('pdf.note', [
            'pasien' => $pasien->load('notes'),
        ]);

        // gabung pdf
        $combinePdf =
            $notePdf .
            '<div style="page-break-after: always;"></div>' .
            $receiptPdf;

        // render pdf
        // return view($combinePdf);
        $pdf = PDF::loadView('pdf.note', [
            'pasien' => $pasien->load('notes'),
        ]);
        return $pdf->setPaper('f4')->stream('invoice.pdf');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        //
    }
}
