<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Mengambil semua data pendapatan
        $pendapatan = Revenue::all();
        return view('report.index', compact('pendapatan'));
    }

    public function print($id)
    {
        // Mengambil data pendapatan berdasarkan ID
        $pendapatan = Revenue::findOrFail($id);
        
        // Mengirim data ke view untuk dicetak
        return view('report.print', compact('pendapatan'));
    }
}
