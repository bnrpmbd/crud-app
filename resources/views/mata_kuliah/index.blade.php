@extends('layouts.app')

@section('title', 'Manajemen Mata Kuliah')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <h1 class="text-4xl font-poppins font-bold text-primary mb-3">
                    Manajemen Mata Kuliah
                </h1>
                <p class="text-secondary font-inter text-lg">Kelola kurikulum dengan sistem yang elegant dan user-friendly</p>
            </div>
            <a href="{{ route('mata_kuliah.create') }}" 
               class="btn-primary flex items-center space-x-2 group">
                <i class="fas fa-plus text-sm group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="font-medium">Tambah Mata Kuliah</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-muted text-sm font-inter">Total Mata Kuliah</p>
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">{{ $items->total() }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-book text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-muted text-sm font-inter">Total Dosen</p>
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">{{ $dosens->count() }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-muted text-sm font-inter">Halaman Saat Ini</p>
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">{{ $items->currentPage() }} / {{ $items->lastPage() }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-muted text-sm font-inter">Status Sistem</p>
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">Active</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card-cyber p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <div class="relative">
                    <input type="text" 
                           name="q" 
                           value="{{ $q }}"
                           placeholder="Cari berdasarkan nama atau SKS (2-4)..." 
                           class="input-cyber pl-12 w-full font-inter">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-muted"></i>
                </div>
            </div>
            <div>
                <div class="relative">
                    <select name="dosen_id" class="input-cyber w-full font-inter pl-10">
                        <option value="">Semua Dosen</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $dosen_id == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                    </select>
                    <i class="fas fa-user-tie absolute left-3 top-1/2 transform -translate-y-1/2 text-muted text-sm"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex items-center space-x-2 flex-1">
                    <i class="fas fa-filter text-sm"></i>
                    <span>Filter</span>
                    </button>
                    @if($q || $dosen_id)
                        <a href="{{ route('mata_kuliah.index') }}" class="elegant-card px-6 py-3 flex items-center space-x-2 text-secondary hover:text-primary transition-colors">
                            <i class="fas fa-times text-sm"></i>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Flash Messages -->
        @if(session('ok'))
            <div class="elegant-card p-5 border border-emerald-400/20 bg-gradient-to-r from-emerald-500/10 to-emerald-400/5 mb-6">
                <div class="flex items-center text-emerald-300">
                    <i class="fas fa-check-circle mr-3 text-xl"></i>
                    <span class="font-medium">{{ session('ok') }}</span>
                </div>
            </div>
        @endif

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @forelse($items as $mk)
                <div class="elegant-card p-6 group hover:scale-105 hover:shadow-2xl transition-all duration-300">
                    <div class="mb-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs font-medium">
                                {{ $mk->sks }} SKS
                            </span>
                            <div class="flex space-x-1">
                                <a href="{{ route('mata_kuliah.edit', $mk) }}" 
                                   class="w-8 h-8 bg-purple-500 hover:bg-purple-600 rounded-lg flex items-center justify-center text-white text-sm transition-colors" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('mata_kuliah.destroy', $mk) }}" 
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $mk->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-600 hover:bg-red-700 rounded-lg flex items-center justify-center text-white text-sm transition-colors" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <h3 class="text-lg font-bold text-primary group-hover:text-blue-400 transition-colors duration-300">
                            {{ $mk->nama }}
                        </h3>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex items-center text-secondary">
                            <i class="fas fa-user-tie text-emerald-400 mr-2"></i>
                            <span class="text-sm">{{ $mk->dosen->nama }}</span>
                        </div>
                        <div class="flex items-center text-secondary">
                            <i class="fas fa-calendar text-blue-400 mr-2"></i>
                            <span class="text-sm">{{ $mk->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="elegant-card p-12 text-center">
                        <div class="text-muted">
                            <i class="fas fa-search text-6xl mb-4 opacity-50"></i>
                            <p class="text-xl mb-2 text-secondary">Tidak ada mata kuliah ditemukan</p>
                            <p class="text-sm mb-4">{{ $q ? "Coba ubah kata kunci pencarian" : "Mulai dengan menambah mata kuliah baru" }}</p>
                            @if(!$q && !$dosen_id)
                                <a href="{{ route('mata_kuliah.create') }}" class="btn-primary inline-flex items-center space-x-2">
                                    <i class="fas fa-plus text-sm"></i>
                                    <span>Tambah Mata Kuliah</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
            <div class="elegant-card p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-muted text-sm">
                        Menampilkan {{ $items->firstItem() }} - {{ $items->lastItem() }} dari {{ $items->total() }} data
                    </div>
                    <div class="flex space-x-1">
                        {{-- Previous --}}
                        @if($items->onFirstPage())
                            <span class="px-3 py-2 bg-slate-600/50 text-muted rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}" class="px-3 py-2 bg-slate-700/50 text-secondary hover:text-primary hover:bg-blue-500/20 rounded-lg transition-colors">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach($items->getUrlRange(max(1, $items->currentPage() - 2), min($items->lastPage(), $items->currentPage() + 2)) as $page => $url)
                            @if($page == $items->currentPage())
                                <span class="px-3 py-2 bg-blue-500 text-white rounded-lg font-medium">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 bg-slate-700/50 text-secondary hover:text-primary hover:bg-blue-500/20 rounded-lg transition-colors">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}" class="px-3 py-2 bg-slate-700/50 text-secondary hover:text-primary hover:bg-blue-500/20 rounded-lg transition-colors">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-3 py-2 bg-slate-600/50 text-muted rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection