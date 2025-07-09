<?php

namespace App\Http\Controllers;

use App\Imports\LaboratoriesImport;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaboratoryController extends Controller
{
    public function vaidateData(Request $request)
    {
        return $data = $request->validate([
            'laboratory_name' => '',
            'laboratory_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('laboratory.index', [
            'laboratories' => Laboratory::all(),
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
        if ($request->hasFile('laboratory_file')) {
            $request->validate([
                'laboratory_file' => 'required|file|mimes:xlsx,xls,csv',
            ]);

            Excel::import(
                new LaboratoriesImport(),
                $request->file('laboratory_file')
            );
            return redirect()
                ->route('laboratory.index')
                ->with('success', 'Berhasil mengimpor data laboratorium');
        } else {
            # code...
        }

        $validated = $this->vaidateData($request);

        Laboratory::create($validated);

        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                "Berhasih Menambahkan Laboratorium $request->laboratory_name"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Laboratory $laboratory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratory $laboratory)
    {
        return view('laboratory.edit', [
            'laboratory' => $laboratory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laboratory $laboratory)
    {
        $validated = $this->vaidateData($request);

        $laboratory->update($validated);

        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                "Berhasih merubah Laboratorium $request->laboratory_name"
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return redirect()
            ->route('laboratory.index')
            ->with(
                'success',
                "Berhasih menghapus Laboratorium $laboratory->laboratory_name"
            );
    }
}
