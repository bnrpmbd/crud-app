@extends('layouts.app')

@section('title', 'Dashboard - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-poppins font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-purple-400 to-indigo-400 animate-float">
            Academic Dashboard
        </h1>
        <p class="text-xl text-secondary font-inter font-light leading-relaxed max-w-2xl mx-auto">
            Sistem Manajemen Akademik Modern dengan Interface yang Elegant dan User-Friendly
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
        <!-- Total Dosen Card -->
        <div class="stats-card group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-blue-500/25 transition-all duration-300">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold font-poppins text-primary mb-1">{{ $totalDosen }}</p>
                    <p class="text-sm font-medium text-blue-400">Total Dosen</p>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-2 rounded-full transition-all duration-700 ease-out" style="width: 85%"></div>
            </div>
            <p class="text-xs text-muted mt-3 font-inter">Tenaga pengajar aktif</p>
        </div>

        <!-- Total Mata Kuliah Card -->
        <div class="stats-card group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-emerald-500/25 transition-all duration-300">
                    <i class="fas fa-book-open text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold font-poppins text-primary mb-1">{{ $totalMataKuliah }}</p>
                    <p class="text-sm font-medium text-emerald-400">Mata Kuliah</p>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-2 rounded-full transition-all duration-700 ease-out" style="width: 92%"></div>
            </div>
            <p class="text-xs text-muted mt-3 font-inter">Program studi tersedia</p>
        </div>

        <!-- Rata-rata SKS Card -->
        <div class="stats-card group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-purple-500/25 transition-all duration-300">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold font-poppins text-primary mb-1">{{ number_format($avgSks, 1) }}</p>
                    <p class="text-sm font-medium text-purple-400">Rata-rata SKS</p>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-400 to-purple-500 h-2 rounded-full transition-all duration-700 ease-out" style="width: {{ ($avgSks / 4) * 100 }}%"></div>
            </div>
            <p class="text-xs text-muted mt-3 font-inter">Per mata kuliah</p>
        </div>

        <!-- Status Card -->
        <div class="stats-card group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-pink-500/25 transition-all duration-300">
                    <i class="fas fa-server text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold font-poppins text-primary mb-1">ONLINE</p>
                    <p class="text-sm font-medium text-rose-400">System Status</p>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                <div class="bg-gradient-to-r from-pink-400 to-rose-500 h-2 rounded-full transition-all duration-700 ease-out" style="width: 100%"></div>
            </div>
            <p class="text-xs text-gray-500 mt-3 font-inter">Server aktif 24/7</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Mata Kuliah per Dosen Chart -->
        <div class="card-cyber p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-poppins font-bold text-primary mb-2">
                        Mata Kuliah per Dosen
                    </h3>
                    <p class="text-sm text-secondary font-inter">Distribusi beban mengajar</p>
                </div>
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="dosenChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- SKS Distribution Chart -->
        <div class="card-cyber p-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-poppins font-bold text-primary mb-2">
                        Distribusi SKS
                    </h3>
                    <p class="text-sm text-secondary font-inter">Kategori beban kredit</p>
                </div>
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-pink-400 rounded-full animate-pulse"></div>
                    <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                    <div class="w-3 h-3 bg-purple-400 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                </div>
            </div>
            <div class="relative h-80">
                <canvas id="sksChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card-cyber p-8 mt-8">
        <div class="mb-8">
            <h3 class="text-2xl font-poppins font-bold text-primary mb-2">
                Quick Actions
            </h3>
            <p class="text-sm text-secondary font-inter">Akses cepat ke fitur utama</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('dosen.create') }}" class="group elegant-card p-6 text-center transition-all duration-300 hover:scale-105">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:shadow-blue-500/25 transition-all duration-300">
                    <i class="fas fa-user-plus text-white text-xl"></i>
                </div>
                <p class="font-medium text-primary font-inter">Tambah Dosen</p>
                <p class="text-xs text-muted mt-1">Daftarkan dosen baru</p>
            </a>
            <a href="{{ route('mata_kuliah.create') }}" class="group elegant-card p-6 text-center transition-all duration-300 hover:scale-105">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center group-hover:shadow-emerald-500/25 transition-all duration-300">
                    <i class="fas fa-book-plus text-white text-xl"></i>
                </div>
                <p class="font-medium text-primary font-inter">Tambah Mata Kuliah</p>
                <p class="text-xs text-muted mt-1">Buat mata kuliah dengan SKS 1-6</p>
            </a>
            <a href="{{ route('dosen.index') }}" class="group elegant-card p-6 text-center transition-all duration-300 hover:scale-105">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:shadow-purple-500/25 transition-all duration-300">
                    <i class="fas fa-list text-white text-xl"></i>
                </div>
                <p class="font-medium text-primary font-inter">Lihat Semua Dosen</p>
                <p class="text-xs text-muted mt-1">Kelola data dosen</p>
            </a>
            <a href="{{ route('mata_kuliah.index') }}" class="group elegant-card p-6 text-center transition-all duration-300 hover:scale-105">
                <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center group-hover:shadow-pink-500/25 transition-all duration-300">
                    <i class="fas fa-search text-white text-xl"></i>
                </div>
                <p class="font-medium text-primary font-inter">Cari Mata Kuliah</p>
                <p class="text-xs text-muted mt-1">Filter berdasarkan nama, dosen & SKS</p>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card-cyber p-8 mt-8">
        <div class="mb-8">
            <h3 class="text-2xl font-poppins font-bold text-primary mb-2">
                Aktivitas Terbaru
            </h3>
            <p class="text-sm text-secondary font-inter">Mata kuliah yang baru ditambahkan</p>
        </div>
        <div class="space-y-4">
            @forelse($recentMataKuliah as $mk)
                <div class="elegant-card p-5 flex items-center justify-between hover:bg-slate-700/50 transition-all duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="font-medium text-primary font-inter mb-1">{{ $mk->nama }}</p>
                            <p class="text-sm text-secondary">
                                <span class="font-medium">{{ $mk->dosen->nama ?? 'Dosen tidak ditemukan' }}</span>
                                <span class="mx-2">•</span>
                                <span class="px-2 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs">{{ $mk->sks }} SKS</span>
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xs text-muted font-inter">{{ $mk->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 bg-slate-700/50 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-inbox text-muted text-2xl"></i>
                    </div>
                    <p class="text-muted font-inter">Belum ada aktivitas terbaru</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mata Kuliah per Dosen Chart
    const dosenCtx = document.getElementById('dosenChart').getContext('2d');
    const dosenChart = new Chart(dosenCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Jumlah Mata Kuliah',
                data: {!! json_encode($chartData['data']) !!},
                backgroundColor: function(context) {
                    const gradient = context.chart.canvas.getContext('2d').createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
                    gradient.addColorStop(1, 'rgba(147, 51, 234, 0.8)');
                    return gradient;
                },
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 15, 35, 0.95)',
                    titleColor: '#60A5FA',
                    bodyColor: '#F3F4F6',
                    borderColor: 'rgba(59, 130, 246, 0.5)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    titleFont: {
                        family: 'Inter',
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        family: 'Inter',
                        size: 13
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        borderColor: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        color: '#E5E7EB',
                        font: {
                            family: 'Inter',
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        borderColor: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        color: '#E5E7EB',
                        maxRotation: 45,
                        font: {
                            family: 'Inter',
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // SKS Distribution Chart
    const sksCtx = document.getElementById('sksChart').getContext('2d');
    const sksChart = new Chart(sksCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($sksDistribution['labels']) !!},
            datasets: [{
                data: {!! json_encode($sksDistribution['data']) !!},
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)', 
                    'rgba(147, 51, 234, 0.8)',
                    'rgba(236, 72, 153, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(147, 51, 234, 1)',
                    'rgba(236, 72, 153, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#F3F4F6',
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            family: 'Inter',
                            size: 13,
                            weight: '500'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 15, 35, 0.95)',
                    titleColor: '#60A5FA',
                    bodyColor: '#F3F4F6',
                    borderColor: 'rgba(59, 130, 246, 0.5)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    titleFont: {
                        family: 'Inter',
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        family: 'Inter',
                        size: 13
                    }
                }
            }
        }
    });

    // Add animation effects
    setTimeout(() => {
        dosenChart.update('active');
        sksChart.update('active');
    }, 500);
});
</script>
@endsection