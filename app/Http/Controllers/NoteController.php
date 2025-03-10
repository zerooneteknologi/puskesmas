<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Emergency;
use App\Models\Laboratory;
use App\Models\Medicine;
use App\Models\Note;
use App\Models\Room;
use App\Models\Suport;
use App\Models\Tool;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('note.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('note.table', [
            'emergencies' => Emergency::all(),
            'rooms' => Room::all(),
            'laboratories' => Laboratory::all(),
            'actions' => Action::all(),
            'suports' => Suport::all(),
            'tools' => Tool::all(),
            'medicines' => Medicine::all(),
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
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
