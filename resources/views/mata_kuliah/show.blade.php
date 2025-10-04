@extends('layouts.app')

@section('title', 'Detail Mata Kuliah - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('mata_kuliah.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-lg transition-colors duration-300">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-4xl font-cyber font-bold neon-text text-cyber-pink animate-float">
                    <i class="fas fa-book-open mr-3"></i>
                    Detail Mata Kuliah
                </h1>
                <p class="text-gray-300">Informasi lengkap mata kuliah {{ $mataKuliah->nama }}</p>
            </div>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="btn-cyber px-6 py-3 rounded-lg font-semibold hover:scale-105 transition-transform duration-300">
                <i class="fas fa-edit mr-2"></i>
                Edit Mata Kuliah
            </a>
            <form action="{{ route('mata_kuliah.destroy', $mataKuliah) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-500/20 hover:bg-red-500/30 text-red-500 px-6 py-3 rounded-lg font-semibold transition-colors duration-300"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah {{ $mataKuliah->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                    <i class="fas fa-trash mr-2"></i>
                    Hapus Mata Kuliah
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        <!-- Main Info Card -->
        <div class="xl:col-span-2">
            <div class="card-cyber rounded-xl p-8">
                <!-- Header -->
                <div class="flex items-start justify-between mb-8">
                    <div class="flex-1">
                        <h2 class="text-3xl font-cyber font-bold text-white mb-3">{{ $mataKuliah->nama }}</h2>
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="bg-cyber-blue/20 text-cyber-blue px-4 py-2 rounded-full text-lg font-bold">
                                <i class="fas fa-code mr-2"></i>
                                {{ $mataKuliah->kode }}
                            </span>
                            <span class="bg-gradient-to-r from-cyber-purple to-purple-600 text-white px-4 py-2 rounded-full text-lg font-bold">
                                <i class="fas fa-calculator mr-2"></i>
                                {{ $mataKuliah->sks }} SKS
                            </span>
                        </div>
                        <div class="flex items-center space-x-2 text-cyber-green">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-semibold">Mata Kuliah Aktif</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="w-16 h-16 bg-gradient-to-r from-cyber-pink to-cyber-purple rounded-full flex items-center justify-center animate-pulse-cyber">
                            <i class="fas fa-graduation-cap text-2xl text-white"></i>
                        </div>
                    </div>
                </div>

                <!-- Course Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-4">
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">
                                    <i class="fas fa-id-card mr-2"></i>
                                    ID Mata Kuliah
                                </span>
                                <span class="text-white font-semibold">{{ $mataKuliah->id }}</span>
                            </div>
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">
                                    <i class="fas fa-calendar-plus mr-2"></i>
                                    Dibuat
                                </span>
                                <span class="text-white font-semibold">{{ $mataKuliah->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">
                                    <i class="fas fa-sync-alt mr-2"></i>
                                    Terakhir Update
                                </span>
                                <span class="text-white font-semibold">{{ $mataKuliah->updated_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400">
                                    <i class="fas fa-clock mr-2"></i>
                                    Status
                                </span>
                                <span class="text-cyber-green font-semibold">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SKS Breakdown -->
                <div class="bg-gradient-to-r from-cyber-purple/10 to-cyber-pink/10 border border-cyber-purple/30 rounded-lg p-6 mb-8">
                    <h4 class="text-cyber-purple font-semibold mb-4 flex items-center">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Breakdown SKS
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-gray-800/50 rounded-lg">
                            <div class="text-2xl font-bold text-cyber-blue mb-1">{{ $mataKuliah->sks }}</div>
                            <div class="text-sm text-gray-400">Total SKS</div>
                        </div>
                        <div class="text-center p-4 bg-gray-800/50 rounded-lg">
                            <div class="text-2xl font-bold text-cyber-green mb-1">{{ $mataKuliah->sks * 14 }}</div>
                            <div class="text-sm text-gray-400">Jam/Semester</div>
                        </div>
                        <div class="text-center p-4 bg-gray-800/50 rounded-lg">
                            <div class="text-2xl font-bold text-cyber-pink mb-1">
                                @if($mataKuliah->sks == 2)
                                    Ringan
                                @elseif($mataKuliah->sks == 3)
                                    Sedang
                                @else
                                    Berat
                                @endif
                            </div>
                            <div class="text-sm text-gray-400">Kategori Beban</div>
                        </div>
                    </div>
                </div>

                <!-- Course Description (if available) -->
                <div class="bg-gray-800/50 rounded-lg p-6">
                    <h4 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-file-alt mr-2"></i>
                        Deskripsi Mata Kuliah
                    </h4>
                    <div class="text-gray-300 leading-relaxed">
                        <p class="mb-4">
                            {{ $mataKuliah->nama }} adalah mata kuliah dengan kode {{ $mataKuliah->kode }} 
                            yang memiliki bobot {{ $mataKuliah->sks }} SKS. Mata kuliah ini diampu oleh 
                            {{ $mataKuliah->dosen->nama ?? 'dosen yang belum ditentukan' }}.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <h5 class="text-cyber-blue font-semibold mb-2">Informasi Akademik:</h5>
                                <ul class="space-y-1 text-gray-400">
                                    <li>• Kode: {{ $mataKuliah->kode }}</li>
                                    <li>• SKS: {{ $mataKuliah->sks }}</li>
                                    <li>• Dibuat: {{ $mataKuliah->created_at->format('d F Y') }}</li>
                                    <li>• Update: {{ $mataKuliah->updated_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="text-cyber-green font-semibold mb-2">Status Mata Kuliah:</h5>
                                <ul class="space-y-1 text-gray-400">
                                    <li>• Status: Aktif</li>
                                    <li>• Dosen: {{ $mataKuliah->dosen ? 'Sudah ditentukan' : 'Belum ditentukan' }}</li>
                                    <li>• Kategori: Mata Kuliah Wajib</li>
                                    <li>• Semester: Dapat diambil kapan saja</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="xl:col-span-1 space-y-8">
            <!-- Dosen Card -->
            <div class="card-cyber rounded-xl p-6">
                <h3 class="text-xl font-cyber font-bold text-cyber-green mb-6 flex items-center">
                    <i class="fas fa-user-tie mr-2"></i>
                    Dosen Pengampu
                </h3>
                
                @if($mataKuliah->dosen)
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-cyber">
                            <span class="text-2xl text-white font-bold">{{ strtoupper(substr($mataKuliah->dosen->nama, 0, 1)) }}</span>
                        </div>
                        <h4 class="text-lg font-semibold text-white mb-2">{{ $mataKuliah->dosen->nama }}</h4>
                        <p class="text-cyber-green text-sm mb-4">
                            <i class="fas fa-envelope mr-1"></i>
                            <a href="mailto:{{ $mataKuliah->dosen->email }}" class="hover:text-cyber-blue transition-colors duration-300">
                                {{ $mataKuliah->dosen->email }}
                            </a>
                        </p>
                    </div>

                    <!-- Dosen Stats -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between py-2 border-b border-gray-700">
                            <span class="text-gray-400">
                                <i class="fas fa-book mr-2"></i>
                                Total Mata Kuliah
                            </span>
                            <span class="text-white font-semibold">{{ $mataKuliah->dosen->mataKuliahs->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-700">
                            <span class="text-gray-400">
                                <i class="fas fa-calculator mr-2"></i>
                                Total SKS
                            </span>
                            <span class="text-white font-semibold">{{ $mataKuliah->dosen->mataKuliahs->sum('sks') }} SKS</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-400">
                                <i class="fas fa-calendar mr-2"></i>
                                Bergabung
                            </span>
                            <span class="text-white font-semibold">{{ $mataKuliah->dosen->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <a href="{{ route('dosen.show', $mataKuliah->dosen) }}" class="w-full bg-cyber-green/20 hover:bg-cyber-green/30 text-cyber-green py-2 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Profil Dosen
                        </a>
                        <a href="{{ route('mata_kuliah.index', ['dosen' => $mataKuliah->dosen->id]) }}" class="w-full bg-cyber-blue/20 hover:bg-cyber-blue/30 text-cyber-blue py-2 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>
                            Mata Kuliah Lainnya
                        </a>
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-slash text-2xl text-gray-400"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-400 mb-2">Dosen Belum Ditentukan</h4>
                        <p class="text-gray-500 text-sm mb-4">Mata kuliah ini belum memiliki dosen pengampu</p>
                        <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="btn-cyber px-4 py-2 rounded-lg font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>
                            Assign Dosen
                        </a>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="card-cyber rounded-xl p-6">
                <h3 class="text-xl font-cyber font-bold text-cyber-purple mb-6 flex items-center">
                    <i class="fas fa-bolt mr-2"></i>
                    Quick Actions
                </h3>
                
                <div class="space-y-3">
                    <a href="{{ route('mata_kuliah.edit', $mataKuliah) }}" class="w-full bg-cyber-purple/20 hover:bg-cyber-purple/30 text-cyber-purple py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center font-semibold">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Mata Kuliah
                    </a>
                    <a href="{{ route('mata_kuliah.create') }}" class="w-full bg-cyber-pink/20 hover:bg-cyber-pink/30 text-cyber-pink py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center font-semibold">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Mata Kuliah Baru
                    </a>
                    <a href="{{ route('mata_kuliah.index') }}" class="w-full bg-cyber-blue/20 hover:bg-cyber-blue/30 text-cyber-blue py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center font-semibold">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Mata Kuliah
                    </a>
                    <a href="{{ route('dashboard') }}" class="w-full bg-gray-600 hover:bg-gray-500 text-white py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center font-semibold">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Course Timeline -->
            <div class="card-cyber rounded-xl p-6">
                <h3 class="text-xl font-cyber font-bold text-cyber-blue mb-6 flex items-center">
                    <i class="fas fa-history mr-2"></i>
                    Timeline Mata Kuliah
                </h3>
                
                <div class="space-y-4">
                    <!-- Created -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-cyber-green/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-plus text-cyber-green"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-semibold">Mata kuliah dibuat</p>
                            <p class="text-gray-400 text-sm">{{ $mataKuliah->created_at->format('d M Y, H:i') }} • {{ $mataKuliah->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Last Update -->
                    @if($mataKuliah->updated_at != $mataKuliah->created_at)
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-cyber-blue/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-edit text-cyber-blue"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-white font-semibold">Data diperbarui</p>
                                <p class="text-gray-400 text-sm">{{ $mataKuliah->updated_at->format('d M Y, H:i') }} • {{ $mataKuliah->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Current Status -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-cyber-purple/20 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-check-circle text-cyber-purple"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-semibold">Status saat ini</p>
                            <p class="text-gray-400 text-sm">Mata kuliah aktif dan siap digunakan</p>
                        </div>
                    </div>
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
        }, index * 150);
    });

    // Add hover effects to action buttons
    const actionButtons = document.querySelectorAll('a[class*="bg-cyber"]');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Profile picture animation
    const profilePics = document.querySelectorAll('.animate-pulse-cyber');
    profilePics.forEach(pic => {
        pic.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        pic.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Add gradient text effect to main title
    const mainTitle = document.querySelector('h2.font-cyber');
    if (mainTitle) {
        mainTitle.addEventListener('mouseenter', function() {
            this.style.background = 'linear-gradient(45deg, #FF006E, #00D4FF, #8B5FBF)';
            this.style.webkitBackgroundClip = 'text';
            this.style.webkitTextFillColor = 'transparent';
            this.style.backgroundSize = '200% 200%';
            this.style.animation = 'gradient-shift 2s ease infinite';
        });
        
        mainTitle.addEventListener('mouseleave', function() {
            this.style.background = '';
            this.style.webkitBackgroundClip = '';
            this.style.webkitTextFillColor = '';
            this.style.backgroundSize = '';
            this.style.animation = '';
        });
    }
});

// Add CSS keyframes for gradient animation
const style = document.createElement('style');
style.textContent = `
    @keyframes gradient-shift {
        0% { background-position: 200% 200%; }
        50% { background-position: 0% 0%; }
        100% { background-position: 200% 200%; }
    }
`;
document.head.appendChild(style);
</script>
@endsection