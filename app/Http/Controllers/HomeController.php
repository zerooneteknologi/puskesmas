<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'pasienmonth' => Pasien::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'pasienday' => Pasien::whereDate('created_at', now())->count(),
            'pasiensum' => Pasien::whereYear('created_at', now('y'))->count(),
            'pasiens' => Pasien::whereYear('created_at', now('y'))
                ->latest()
                ->limit(10)
                ->get(),
        ]);
    }
}
