<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Bill;
use App\Models\Emergency;
use App\Models\Laboratory;
use App\Models\Medicine;
use App\Models\Note;
use App\Models\Pasien;
use App\Models\Room;
use App\Models\Suport;
use App\Models\Tool;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $unit = strtoupper($request->note_unit);
        $no = Pasien::whereYear('created_at', now('y'))->count() + 1;
        $nomor =
            $unit .
            str_pad($no, 3, '0', STR_PAD_LEFT) .
            '/' .
            Carbon::now()->year;

        $pasienId = Pasien::insertGetId([
            'pasien_nomor' => $nomor,
            'pasien_name' => $request->pasien_name,
            'pasien_age' => $request->pasien_age,
            'pasien_address' => $request->pasien_address,
            'pasien_status' => $request->pasien_status,
            'pasien_in' => $request->pasien_in,
            'pasien_out' => $request->pasien_out,
            'pasien_sum' => $request->pasien_sum,
            'pasien_room' => $request->pasien_room,
            'pasien_diagnoses' => $request->pasien_diagnoses,
            'created_at' => now(),
        ]);

        foreach ($request->note_category as $key => $cartegory) {
            Note::create([
                'pasien_id' => $pasienId,
                'note_category' => $cartegory,
                'note_name' => $request->note_name[$key],
                'note_price' => $request->note_price[$key],
                'created_at' => now(),
            ]);
        }

        DB::table('bills')->truncate();
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
