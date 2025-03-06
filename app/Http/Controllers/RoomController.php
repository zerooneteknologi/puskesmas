<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function validateData(Request $request)
    {
        return $data = $request->validate([
            'room_name' => '',
            'room_price' => '',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('room.index', [
            'rooms' => Room::all(),
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

        Room::create($validated);

        return redirect()
            ->route('room.index')
            ->with('success', "Berhasil Menambahakan $request->room_name");
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('room.edit', [
            'room' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $this->validateData($request);

        $room->update($validated);

        return redirect()
            ->route('room.index')
            ->with('success', "Berhasih Merubah Perawatan $room->room_name");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('room.index')
            ->with('success', "Berhasih Menghapus Perawatan $room->room_name");
    }
}
