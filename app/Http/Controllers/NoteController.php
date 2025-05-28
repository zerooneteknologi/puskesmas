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
        // cache all models for 120 seconds
        $cacheall = fn($model, $key) => Cache::remember(
            $key,
            120,
            fn() => $model::all()
        );

        // cache actions by category
        $actions = Cache::remember('actions', 120, function () {
            $allActions = Action::all();
            return [
                'kategori_1' => $allActions->where('action_category', 1),
                'kategori_2' => $allActions->where('action_category', 2),
                'kategori_3' => $allActions->where('action_category', 3),
            ];
        });

        return view('note.table', [
            'emergencies' => $cacheall(Emergency::class, 'emergencies'),
            'rooms' => $cacheall(Room::class, 'rooms'),
            'laboratories' => $cacheall(Laboratory::class, 'laboratories'),
            'actions' => $actions['kategori_1'],
            'midwives' => $actions['kategori_2'],
            'teeth' => $actions['kategori_3'],
            'suports' => $cacheall(Suport::class, 'suports'),
            'tools' => $cacheall(Tool::class, 'tools'),
            'medicines' => $cacheall(Medicine::class, 'medicines'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unit = strtoupper($request->note_unit);
        $currentYear = now()->year;
        $no =
            Pasien::whereYear('created_at', $currentYear)
                ->where('pasien_nomor', 'LIKE', "%$unit%")
                ->count() + 1;
        $nomor = sprintf('%s%04d/%d', $unit, $no, $currentYear);

        $pasien = Pasien::updateOrCreate(
            [
                'pasien_nomor' => $nomor,
            ],
            [
                'pasien_nik' => $request->pasien_nik,
                'pasien_name' => $request->pasien_name,
                'pasien_age' => $request->pasien_age,
                'pasien_address' => $request->pasien_address,
                'pasien_status' => $request->pasien_status,
                'pasien_in' => $request->pasien_in,
                'pasien_out' => $request->pasien_out,
                'pasien_sum' => $request->pasien_sum,
                'pasien_room' => $request->pasien_room,
                'pasien_diagnoses' => $request->pasien_diagnoses,
            ]
        );
        $pasienId = $pasien->id;

        foreach ($request->note_category as $key => $cartegory) {
            Note::create([
                'pasien_id' => $pasienId,
                'note_date' => now(),
                'note_category' => $cartegory,
                'note_name' => $request->note_name[$key],
                'note_price' => $request->note_price[$key],
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
    /**
     * Search for notes based on the search term.
     */
    public function search(Request $request)
    {
        $pasiens = Pasien::latest()
            ->search($request->search)
            ->limit(10)
            ->get();

        return response()->json($pasiens);
    }
}
