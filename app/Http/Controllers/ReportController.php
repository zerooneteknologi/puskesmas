<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Pasien;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('report.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve notes data along with related patients, filtered by number
        $notes = Note::with('pasien')
            ->nomor(request('unit'))
            ->date(request('month'))
            ->orderBy('note_date')
            ->get();

        $data = [];

        foreach ($notes as $note) {
            $data[] = [
                'note_date' => date('Y-m-d', strtotime($note->note_date)),
                'note_category' => $note->note_category,
                'note_price' => $note->note_price,
            ];
        }
        // Get all categories from notes and sort them in ascending order
        $categories = collect(range(1, 9))->all();

        // Group data by note_date
        $grouped = collect($data)->groupBy('note_date');

        // Prepare the final result array
        $result = [];

        foreach ($grouped as $date => $items) {
            $row = ['note_date' => $date];
            foreach ($categories as $category) {
                // Directly sum note_price for each category on this date
                $row[$category] = $items
                    ->where('note_category', $category)
                    ->sum('note_price');
            }
            $result[] = $row;
        }

        // return $result;
        return view('report.create', [
            'categories' => $categories,
            'notes' => collect($result),
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
