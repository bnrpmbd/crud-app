@extends('layouts.app')

@section('title', 'Tambah Dosen - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('dosen.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-lg transition-colors duration-300">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-4xl font-cyber font-bold neon-text text-cyber-green animate-float">
                <i class="fas fa-user-plus mr-3"></i>
                Tambah Dosen Baru
            </h1>
            <p class="text-gray-300">Masukkan informasi dosen untuk ditambahkan ke sistem</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-2xl mx-auto">
        <div class="card-cyber rounded-xl p-8">
            <form action="{{ route('dosen.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-cyber">
                        <i class="fas fa-user-graduate text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-cyber font-bold text-cyber-blue">Informasi Dosen</h3>
                    <p class="text-gray-400 text-sm">Lengkapi form di bawah dengan data yang valid</p>
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
                        value="{{ old('nama') }}"
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
                        value="{{ old('email') }}"
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
                        <span>Simpan Dosen</span>
                    </button>
                    
                    <a 
                        href="{{ route('dosen.index') }}" 
                        class="bg-gray-600 hover:bg-gray-500 text-white flex-1 py-3 px-6 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>

                <!-- Form Info -->
                <div class="bg-cyber-blue/10 border border-cyber-blue/30 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-lightbulb text-cyber-blue text-lg mt-1"></i>
                        <div>
                            <h4 class="text-cyber-blue font-semibold mb-2">Tips Pengisian:</h4>
                            <ul class="text-gray-300 text-sm space-y-1">
                                <li>• Pastikan nama lengkap sesuai dengan dokumen resmi</li>
                                <li>• Gunakan email institusi jika tersedia</li>
                                <li>• Email harus unik dan belum terdaftar di sistem</li>
                                <li>• Data dapat diubah setelah disimpan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Preview Section -->
        <div class="card-cyber rounded-xl p-6 mt-8" id="preview-section" style="display: none;">
            <h4 class="text-lg font-cyber font-bold text-cyber-purple mb-4">
                <i class="fas fa-eye mr-2"></i>
                Preview Data
            </h4>
            <div class="bg-gray-800/50 rounded-lg p-4 space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-cyber-blue to-cyber-purple rounded-full flex items-center justify-center">
                        <span class="text-white font-bold" id="preview-initial">?</span>
                    </div>
                    <div>
                        <p class="font-semibold text-white" id="preview-nama">-</p>
                        <p class="text-sm text-gray-400" id="preview-email">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama');
    const emailInput = document.getElementById('email');
    const previewSection = document.getElementById('preview-section');
    const previewNama = document.getElementById('preview-nama');
    const previewEmail = document.getElementById('preview-email');
    const previewInitial = document.getElementById('preview-initial');

    function updatePreview() {
        const nama = namaInput.value.trim();
        const email = emailInput.value.trim();

        if (nama || email) {
            previewSection.style.display = 'block';
            previewNama.textContent = nama || '-';
            previewEmail.textContent = email || '-';
            previewInitial.textContent = nama ? nama.charAt(0).toUpperCase() : '?';
        } else {
            previewSection.style.display = 'none';
        }
    }

    namaInput.addEventListener('input', updatePreview);
    emailInput.addEventListener('input', updatePreview);

    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
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