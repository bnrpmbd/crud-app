@extends('layouts.app')

@section('title', 'Manajemen Dosen')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
            <div>
                <h1 class="text-4xl font-poppins font-bold text-primary mb-3">
                    Manajemen Dosen
                </h1>
                <p class="text-secondary font-inter text-lg">Kelola data dosen dengan interface yang elegant dan modern</p>
            </div>
            <a href="{{ route('dosen.create') }}" 
               class="btn-primary flex items-center space-x-2 group">
                <i class="fas fa-plus text-sm group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="font-medium">Tambah Dosen</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="stats-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-muted text-sm font-inter">Total Dosen</p>
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">{{ $items->total() }}</h3>
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
                    <h3 class="text-3xl font-bold font-poppins text-primary mt-1">Online</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-signal text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="card-cyber p-6">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" 
                           name="q" 
                           value="{{ $q }}"
                           placeholder="Cari dosen berdasarkan nama atau email..." 
                           class="input-cyber pl-12 w-full font-inter">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-muted"></i>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex items-center space-x-2">
                    <i class="fas fa-search text-sm"></i>
                    <span>Cari</span>
                </button>
                @if($q)
                    <a href="{{ route('dosen.index') }}" class="elegant-card px-6 py-3 flex items-center space-x-2 text-secondary hover:text-primary transition-colors">
                        <i class="fas fa-times text-sm"></i>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Flash Messages -->
    @if(session('ok'))
        <div class="elegant-card p-5 border border-emerald-400/20 bg-gradient-to-r from-emerald-500/10 to-emerald-400/5">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center mr-4">
                    <i class="fas fa-check text-emerald-400 text-sm"></i>
                </div>
                <span class="text-emerald-300 font-medium font-inter">{{ session('ok') }}</span>
            </div>
        </div>
    @endif

    <!-- Table Section -->
    <div class="table-cyber">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                <i class="fas fa-hashtag mr-2"></i>No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                <i class="fas fa-user mr-2"></i>Nama
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                <i class="fas fa-envelope mr-2"></i>Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                <i class="fas fa-calendar mr-2"></i>Dibuat
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($items as $index => $dosen)
                            <tr class="hover:bg-gray-800 transition-colors duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    <span class="cyber-badge-sm">{{ $items->firstItem() + $index }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-green rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($dosen->nama, 0, 2)) }}</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('dosen.show', $dosen) }}" class="text-white font-medium group-hover:text-cyber-blue transition-colors duration-200 hover:underline">
                                                {{ $dosen->nama }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-gray-300 hover:text-cyber-green transition-colors duration-200">
                                        <i class="fas fa-envelope mr-2 text-cyber-green"></i>{{ $dosen->email }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    <i class="fas fa-clock mr-2 text-cyber-pink"></i>
                                    {{ $dosen->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('dosen.show', $dosen) }}" 
                                           class="cyber-button-sm bg-cyber-blue hover:bg-opacity-80" 
                                           title="Lihat Detail Dosen">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('dosen.edit', $dosen) }}" 
                                           class="cyber-button-sm bg-cyber-purple hover:bg-opacity-80" 
                                           title="Edit Dosen">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('dosen.destroy', $dosen) }}" 
                                              class="inline-block"
                                              onsubmit="return confirm('Yakin ingin menghapus dosen {{ $dosen->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="cyber-button-sm bg-red-600 hover:bg-red-700" 
                                                    title="Hapus Dosen">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-search text-4xl mb-4 opacity-50"></i>
                                        <p class="text-xl mb-2">Tidak ada data dosen</p>
                                        <p class="text-sm">{{ $q ? "Coba ubah kata kunci pencarian" : "Mulai dengan menambah dosen baru" }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($items->hasPages())
            <div class="mt-8">
                <div class="cyber-card">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-gray-400 text-sm">
                            Menampilkan {{ $items->firstItem() }} - {{ $items->lastItem() }} dari {{ $items->total() }} data
                        </div>
                        <div class="flex space-x-1">
                            {{-- Previous --}}
                            @if($items->onFirstPage())
                                <span class="cyber-pagination-disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $items->previousPageUrl() }}" class="cyber-pagination-link">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($items->getUrlRange(max(1, $items->currentPage() - 2), min($items->lastPage(), $items->currentPage() + 2)) as $page => $url)
                                @if($page == $items->currentPage())
                                    <span class="cyber-pagination-active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="cyber-pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if($items->hasMorePages())
                                <a href="{{ $items->nextPageUrl() }}" class="cyber-pagination-link">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="cyber-pagination-disabled">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection