<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'personnel_name' => '',
            'personnel_nip' => '',
            'personnel_role' => '',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('personnel.index', [
            'personnels' => Personnel::all(),
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

        Personnel::create($validated);

        return redirect()
            ->route('personnel.index')
            ->with(
                'success',
                "Berhasil Menambahkan personnel baru \"$request->personnel_name\"!"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Personnel $personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Personnel $personnel)
    {
        return view('personnel.edit', [
            'personnel' => $personnel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personnel $personnel)
    {
        $validated = $this->validateData($request);

        $personnel->update($validated);

        return redirect()
            ->route('personnel.index')
            ->with(
                'success',
                "Berhasil mengubah \"$personnel->personnel_name\"!"
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Personnel $personnel)
    {
        $personnel->delete();

        return redirect()
            ->route('personnel.index')
            ->with(
                'success',
                "Berhasil Menghapus \"$personnel->personnel_name\"!"
            );
    }
}
