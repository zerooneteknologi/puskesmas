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
use Illuminate\Support\Facades\Cache;
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
        /**
         * get actions
         * 1. kategori_1
         * 2. kategori_2
         * 3. kategori_3
         * */
        $actions = Cache::remember('actions', 120, function () {
            $allActions = Action::all();
            return [
                'kategori_1' => $allActions->where('action_category', 1),
                'kategori_2' => $allActions->where('action_category', 2),
                'kategori_3' => $allActions->where('action_category', 3),
            ];
        });

        return view('note.table', [
            'emergencies' => Cache::remember('emergencies', 120, fn() => Emergency::all()),
            'rooms' => Cache::remember('rooms', 120, fn() => Room::all()),
            'laboratories' => Cache::remember('laboratories', 120, fn() => Laboratory::all()),
            'actions' => $actions['kategori_1'],
            'midwives' => $actions['kategori_2'],
            'teeth' => $actions['kategori_3'],
            'suports' => Cache::remember('suports', 120, fn() => Suport::all()),
            'tools' => Cache::remember('tools', 120, fn() => Tool::all()),
            'medicines' => Cache::remember('medicines', 120, fn() => Medicine::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unit = strtoupper($request->note_unit);
        $no =
            Pasien::whereYear('created_at', now('y'))
                ->where('pasien_nomor', 'LIKE', "%$request->note_unit%")
                ->count() + 1;
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

        return $pasienId;
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
