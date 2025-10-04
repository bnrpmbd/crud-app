@extends('layouts.app')

@section('title', 'Edit Dosen - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('dosen.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-lg transition-colors duration-300">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-4xl font-cyber font-bold neon-text text-cyber-green animate-float">
                <i class="fas fa-user-edit mr-3"></i>
                Edit Dosen
            </h1>
            <p class="text-gray-300">Perbarui informasi dosen {{ $dosen->nama }}</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-2xl mx-auto">
        <div class="card-cyber rounded-xl p-8">
            <form action="{{ route('dosen.update', $dosen) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-cyber">
                        <span class="text-3xl text-white font-bold">{{ strtoupper(substr($dosen->nama, 0, 1)) }}</span>
                    </div>
                    <h3 class="text-2xl font-cyber font-bold text-cyber-green">Edit Informasi Dosen</h3>
                    <p class="text-gray-400 text-sm">ID: {{ $dosen->id }} • Dibuat: {{ $dosen->created_at->format('d M Y') }}</p>
                </div>

                <!-- Nama Field -->
                <div class="space-y-2">
                    <label for="nama" class="block text-cyber-blue font-semibold">
                        <i class="fas fa-user mr-2"></i>
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        value="{{ old('nama', $dosen->nama) }}"
                        placeholder="Masukkan nama lengkap dosen..."
                        class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-blue/50 @error('nama') border-red-500 @enderror"
                        required
                    >
                    @error('nama')
                        <div class="flex items-center space-x-2 text-red-500 text-sm mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <p class="text-gray-400 text-xs">
                        <i class="fas fa-info-circle mr-1"></i>
                        Nama akan ditampilkan di sistem akademik
                    </p>
                </div>

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-cyber-blue font-semibold">
                        <i class="fas fa-envelope mr-2"></i>
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $dosen->email) }}"
                        placeholder="contoh: dosen@universitas.ac.id"
                        class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-blue/50 @error('email') border-red-500 @enderror"
                        required
                    >
                    @error('email')
                        <div class="flex items-center space-x-2 text-red-500 text-sm mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <p class="text-gray-400 text-xs">
                        <i class="fas fa-info-circle mr-1"></i>
                        Email harus unik dan akan digunakan untuk komunikasi
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                    <button 
                        type="submit" 
                        class="btn-cyber flex-1 py-3 px-6 rounded-lg font-semibold hover:scale-105 transition-transform duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-save"></i>
                        <span>Perbarui Dosen</span>
                    </button>
                    
                    <a 
                        href="{{ route('dosen.show', $dosen) }}" 
                        class="bg-cyber-purple/20 hover:bg-cyber-purple/30 text-cyber-purple flex-1 py-3 px-6 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-eye"></i>
                        <span>Lihat Detail</span>
                    </a>
                    
                    <a 
                        href="{{ route('dosen.index') }}" 
                        class="bg-gray-600 hover:bg-gray-500 text-white flex-1 py-3 px-6 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>

                <!-- Form Info -->
                <div class="bg-cyber-green/10 border border-cyber-green/30 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-lightbulb text-cyber-green text-lg mt-1"></i>
                        <div>
                            <h4 class="text-cyber-green font-semibold mb-2">Tips Edit:</h4>
                            <ul class="text-gray-300 text-sm space-y-1">
                                <li>• Pastikan perubahan data sudah sesuai dengan dokumen resmi</li>
                                <li>• Email baru harus unik dan belum terdaftar di sistem</li>
                                <li>• Perubahan akan mempengaruhi data mata kuliah terkait</li>
                                <li>• Riwayat perubahan akan tercatat di sistem</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Current vs New Data Comparison -->
        <div class="card-cyber rounded-xl p-6 mt-8">
            <h4 class="text-lg font-cyber font-bold text-cyber-purple mb-4">
                <i class="fas fa-balance-scale mr-2"></i>
                Perbandingan Data
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Current Data -->
                <div>
                    <h5 class="text-cyber-blue font-semibold mb-3">
                        <i class="fas fa-database mr-2"></i>
                        Data Saat Ini
                    </h5>
                    <div class="bg-gray-800/50 rounded-lg p-4 space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-gray-600 to-gray-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">{{ strtoupper(substr($dosen->nama, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">{{ $dosen->nama }}</p>
                                <p class="text-sm text-gray-400">{{ $dosen->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- New Data Preview -->
                <div>
                    <h5 class="text-cyber-green font-semibold mb-3">
                        <i class="fas fa-edit mr-2"></i>
                        Data Baru (Preview)
                    </h5>
                    <div class="bg-gray-800/50 rounded-lg p-4 space-y-3" id="preview-section">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center">
                                <span class="text-white font-bold" id="preview-initial">{{ strtoupper(substr($dosen->nama, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white" id="preview-nama">{{ $dosen->nama }}</p>
                                <p class="text-sm text-gray-400" id="preview-email">{{ $dosen->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mata Kuliah Info -->
        @if($dosen->mataKuliahs && $dosen->mataKuliahs->count() > 0)
            <div class="card-cyber rounded-xl p-6">
                <h4 class="text-lg font-cyber font-bold text-cyber-pink mb-4">
                    <i class="fas fa-book-open mr-2"></i>
                    Mata Kuliah Terkait ({{ $dosen->mataKuliahs->count() }})
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($dosen->mataKuliahs as $mk)
                        <div class="bg-gray-800/50 rounded-lg p-3 border border-gray-700">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-semibold text-white">{{ $mk->nama }}</p>
                                    <p class="text-sm text-gray-400">Kode: {{ $mk->kode }}</p>
                                </div>
                                <span class="bg-cyber-pink/20 text-cyber-pink px-2 py-1 rounded text-xs">
                                    {{ $mk->sks }} SKS
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 p-3 bg-amber-500/10 border border-amber-500/30 rounded-lg">
                    <div class="flex items-center space-x-2 text-amber-500">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span class="text-sm">Perubahan data dosen akan mempengaruhi {{ $dosen->mataKuliahs->count() }} mata kuliah yang tercantum di atas.</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const emailInput = document.getElementById('email');
    const previewNama = document.getElementById('preview-nama');
    const previewEmail = document.getElementById('preview-email');
    const previewInitial = document.getElementById('preview-initial');

    function updatePreview() {
        const nama = namaInput.value.trim();
        const email = emailInput.value.trim();

        previewNama.textContent = nama || '-';
        previewEmail.textContent = email || '-';
        previewInitial.textContent = nama ? nama.charAt(0).toUpperCase() : '?';

        // Add change indication
        const originalNama = '{{ $dosen->nama }}';
        const originalEmail = '{{ $dosen->email }}';

        if (nama !== originalNama) {
            previewNama.style.color = '#00F5A0';
            previewNama.style.fontWeight = 'bold';
        } else {
            previewNama.style.color = '';
            previewNama.style.fontWeight = '';
        }

        if (email !== originalEmail) {
            previewEmail.style.color = '#00F5A0';
            previewEmail.style.fontWeight = 'bold';
        } else {
            previewEmail.style.color = '';
            previewEmail.style.fontWeight = '';
        }
    }

    namaInput.addEventListener('input', updatePreview);
    emailInput.addEventListener('input', updatePreview);

    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
        submitButton.disabled = true;
    });

    // Add floating label effect
    const inputs = document.querySelectorAll('.input-cyber');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('label').style.color = '#00D4FF';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('label').style.color = '';
            }
        });
    });

    // Real-time validation
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.style.borderColor = '#ef4444';
            // Add error message if doesn't exist
            if (!this.parentElement.querySelector('.email-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'flex items-center space-x-2 text-red-500 text-sm mt-1 email-error';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>Format email tidak valid</span>';
                this.parentElement.appendChild(errorDiv);
            }
        } else {
            this.style.borderColor = '';
            const errorMsg = this.parentElement.querySelector('.email-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    });
});
</script>
@endsection