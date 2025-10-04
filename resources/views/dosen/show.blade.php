@extends('layouts.app')

@section('title', 'Detail Dosen - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dosen.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-lg transition-colors duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-4xl font-cyber font-bold neon-text text-cyber-blue animate-float">
                    <i class="fas fa-user-circle mr-3"></i>
                    Detail Dosen
                </h1>
                <p class="text-gray-300">Informasi lengkap dosen {{ $dosen->nama }}</p>
            </div>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('dosen.edit', $dosen) }}" class="btn-cyber px-6 py-3 rounded-lg font-semibold hover:scale-105 transition-transform duration-300">
                <i class="fas fa-edit mr-2"></i>
                Edit Dosen
            </a>
            <form action="{{ route('dosen.destroy', $dosen) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500/20 hover:bg-red-500/30 text-red-500 px-6 py-3 rounded-lg font-semibold transition-colors duration-300"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus dosen {{ $dosen->nama }}? Tindakan ini akan menghapus semua mata kuliah yang terkait.')">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus Dosen
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Profile Card -->
        <div class="xl:col-span-1">
            <div class="card-cyber rounded-xl p-8 text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse-cyber">
                    <span class="text-5xl text-white font-bold">{{ strtoupper(substr($dosen->nama, 0, 1)) }}</span>
                </div>
                
                <h2 class="text-2xl font-cyber font-bold text-white mb-2">{{ $dosen->nama }}</h2>
                <p class="text-cyber-blue mb-4">
                    <i class="fas fa-envelope mr-2"></i>
                    <a href="mailto:{{ $dosen->email }}" class="hover:text-cyber-green transition-colors duration-300">
                        {{ $dosen->email }}
                    </a>
                </p>
                
                <!-- Status Badge -->
                <div class="flex justify-center mb-6">
                    @if($dosen->mataKuliahs && $dosen->mataKuliahs->count() > 0)
                        <span class="bg-cyber-green/20 text-cyber-green px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            Aktif Mengajar
                        </span>
                    @else
                        <span class="bg-yellow-500/20 text-yellow-500 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                            <i class="fas fa-clock mr-2"></i>
                            Belum Ada Mata Kuliah
                        </span>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-2xl font-bold text-cyber-blue">{{ $dosen->mataKuliahs ? $dosen->mataKuliahs->count() : 0 }}</div>
                        <div class="text-sm text-gray-400">Mata Kuliah</div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <div class="text-2xl font-bold text-cyber-green">{{ $dosen->mataKuliahs ? $dosen->mataKuliahs->sum('sks') : 0 }}</div>
                        <div class="text-sm text-gray-400">Total SKS</div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="space-y-3 text-left">
                    <div class="flex items-center justify-between py-2 border-b border-gray-700">
                        <span class="text-gray-400">
                            <i class="fas fa-id-card mr-2"></i>
                            ID Dosen
                        </span>
                        <span class="text-white font-semibold">{{ $dosen->id }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-700">
                        <span class="text-gray-400">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Bergabung
                        </span>
                        <span class="text-white font-semibold">{{ $dosen->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-gray-700">
                        <span class="text-gray-400">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Terakhir Update
                        </span>
                        <span class="text-white font-semibold">{{ $dosen->updated_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-gray-400">
                            <i class="fas fa-clock mr-2"></i>
                            Status Akun
                        </span>
                        <span class="text-cyber-green font-semibold">
                            <i class="fas fa-circle text-xs mr-1"></i>
                            Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-8">
            <!-- Mata Kuliah Section -->
            <div class="card-cyber rounded-xl p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-cyber font-bold text-cyber-pink">
                        <i class="fas fa-book-open mr-3"></i>
                        Mata Kuliah
                        @if($dosen->mataKuliahs && $dosen->mataKuliahs->count() > 0)
                            <span class="text-lg font-normal text-gray-400">({{ $dosen->mataKuliahs->count() }} mata kuliah)</span>
                        @endif
                    </h3>
                    
                    <a href="{{ route('mata_kuliah.create', ['dosen_id' => $dosen->id]) }}" class="bg-cyber-pink/20 hover:bg-cyber-pink/30 text-cyber-pink px-4 py-2 rounded-lg font-semibold transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Mata Kuliah
                    </a>
                </div>

                @if($dosen->mataKuliahs && $dosen->mataKuliahs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($dosen->mataKuliahs as $mk)
                            <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700 hover:border-cyber-pink/50 transition-colors duration-300 cyber-glow">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-white mb-2">{{ $mk->nama }}</h4>
                                        <p class="text-sm text-gray-400 mb-1">
                                            <i class="fas fa-code mr-2"></i>
                                            Kode: {{ $mk->kode }}
                                        </p>
                                        <p class="text-sm text-gray-400">
                                            <i class="fas fa-calendar mr-2"></i>
                                            Dibuat: {{ $mk->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="bg-cyber-purple/20 text-cyber-purple px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $mk->sks }} SKS
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-2 pt-4 border-t border-gray-700">
                                    <a href="{{ route('mata_kuliah.show', $mk) }}" 
                                       class="flex-1 bg-cyber-blue/20 hover:bg-cyber-blue/30 text-cyber-blue text-center py-2 rounded-lg transition-colors duration-300">
                                        <i class="fas fa-eye mr-1"></i>
                                        Detail
                                    </a>
                                    <a href="{{ route('mata_kuliah.edit', $mk) }}" 
                                       class="flex-1 bg-cyber-green/20 hover:bg-cyber-green/30 text-cyber-green text-center py-2 rounded-lg transition-colors duration-300">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- SKS Summary -->
                    <div class="mt-6 p-4 bg-gradient-to-r from-cyber-purple/10 to-cyber-pink/10 border border-cyber-purple/30 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-calculator text-cyber-purple text-xl"></i>
                                <div>
                                    <p class="text-white font-semibold">Total Beban Mengajar</p>
                                    <p class="text-gray-400 text-sm">Berdasarkan {{ $dosen->mataKuliahs->count() }} mata kuliah</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-cyber-purple">{{ $dosen->mataKuliahs->sum('sks') }} SKS</p>
                                <p class="text-sm text-gray-400">
                                    @if($dosen->mataKuliahs->sum('sks') >= 12)
                                        <i class="fas fa-check-circle text-cyber-green mr-1"></i>
                                        Full Load
                                    @elseif($dosen->mataKuliahs->sum('sks') >= 8)
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>
                                        Moderate Load
                                    @else
                                        <i class="fas fa-info-circle text-cyber-blue mr-1"></i>
                                        Light Load
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-book-open text-3xl text-gray-400"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-400 mb-2">Belum Ada Mata Kuliah</h4>
                        <p class="text-gray-500 mb-6">Dosen ini belum memiliki mata kuliah yang diasign</p>
                        <a href="{{ route('mata_kuliah.create', ['dosen_id' => $dosen->id]) }}" class="btn-cyber px-6 py-3 rounded-lg font-semibold">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Mata Kuliah Pertama
                        </a>
                    </div>
                @endif
            </div>

            <!-- Activity Timeline -->
            <div class="card-cyber rounded-xl p-8">
                <h3 class="text-2xl font-cyber font-bold text-cyber-green mb-6">
                    <i class="fas fa-history mr-3"></i>
                    Timeline Aktivitas
                </h3>

                <div class="space-y-4">
                    <!-- Account Created -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-cyber-blue/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user-plus text-cyber-blue"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-semibold">Akun dosen dibuat</p>
                            <p class="text-gray-400 text-sm">{{ $dosen->created_at->format('d M Y, H:i') }} • {{ $dosen->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Last Update -->
                    @if($dosen->updated_at != $dosen->created_at)
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-cyber-green/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-edit text-cyber-green"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-white font-semibold">Data dosen diperbarui</p>
                                <p class="text-gray-400 text-sm">{{ $dosen->updated_at->format('d M Y, H:i') }} • {{ $dosen->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Mata Kuliah Activities -->
                    @if($dosen->mataKuliahs && $dosen->mataKuliahs->count() > 0)
                        @foreach($dosen->mataKuliahs->sortByDesc('created_at')->take(3) as $mk)
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-cyber-pink/20 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-book-plus text-cyber-pink"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-white font-semibold">Mata kuliah "{{ $mk->nama }}" ditambahkan</p>
                                    <p class="text-gray-400 text-sm">{{ $mk->created_at->format('d M Y, H:i') }} • {{ $mk->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        @if($dosen->mataKuliahs->count() > 3)
                            <div class="text-center pt-4">
                                <a href="{{ route('mata_kuliah.index', ['dosen' => $dosen->id]) }}" class="text-cyber-blue hover:text-cyber-green transition-colors duration-300">
                                    <i class="fas fa-ellipsis-h mr-2"></i>
                                    Lihat semua aktivitas mata kuliah
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations to cards
    const cards = document.querySelectorAll('.card-cyber');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add hover effects to mata kuliah cards
    const mkCards = document.querySelectorAll('.cyber-glow');
    mkCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0, 212, 255, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    // Profile picture animation
    const profilePic = document.querySelector('.animate-pulse-cyber');
    if (profilePic) {
        profilePic.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        profilePic.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }
});
</script>
@endsection