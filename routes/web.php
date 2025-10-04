<?php

use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MataKuliahController;

Route::get('/', function () {
    $totalDosen = Dosen::count();
    $totalMataKuliah = MataKuliah::count();
    $avgSks = MataKuliah::avg('sks') ?? 0;
    $recentMataKuliah = MataKuliah::with('dosen')->latest()->take(5)->get();
    
    // Chart data untuk mata kuliah per dosen
    $chartData = [
        'labels' => [],
        'data' => []
    ];
    
    $dosenWithMk = Dosen::withCount('mataKuliahs')
        ->having('mata_kuliahs_count', '>', 0)
        ->orderBy('mata_kuliahs_count', 'desc')
        ->limit(10)
        ->get();
    
    foreach ($dosenWithMk as $dosen) {
        $chartData['labels'][] = $dosen->nama;
        $chartData['data'][] = $dosen->mata_kuliahs_count;
    }
    
    // SKS Distribution data
    $sksDistribution = [
        'labels' => ['2 SKS', '3 SKS', '4 SKS'],
        'data' => [
            MataKuliah::where('sks', 2)->count(),
            MataKuliah::where('sks', 3)->count(),
            MataKuliah::where('sks', 4)->count()
        ]
    ];
    
    return view('dashboard', compact('totalDosen', 'totalMataKuliah', 'avgSks', 'recentMataKuliah', 'chartData', 'sksDistribution'));
})->name('dashboard');

Route::resource('dosen', DosenController::class);
Route::resource('mata_kuliah', MataKuliahController::class);
