@extends('layouts.app')

@section('title', 'Edit Mata Kuliah - Academic Management System')

@section('content')
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex items-center space-x-4">
        <a href="{{ route('mata_kuliah.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-3 rounded-lg transition-colors duration-300">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-4xl font-cyber font-bold neon-text text-cyber-pink animate-float">
                <i class="fas fa-book-open mr-3"></i>
                Edit Mata Kuliah
            </h1>
            <p class="text-gray-300">Perbarui informasi mata kuliah {{ $mata_kuliah->nama }}</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto">
        <div class="card-cyber rounded-xl p-8">
            <form action="{{ route('mata_kuliah.update', $mata_kuliah) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Form Header -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-r from-cyber-pink to-cyber-purple rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-cyber">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-cyber font-bold text-cyber-pink">Edit Informasi Mata Kuliah</h3>
                    <p class="text-gray-400 text-sm">
                        ID: {{ $mata_kuliah->id }} • Kode: {{ $mata_kuliah->kode }} • Dibuat: {{ $mata_kuliah->created_at->format('d M Y') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Nama Mata Kuliah Field -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-cyber-pink font-semibold">
                                <i class="fas fa-book mr-2"></i>
                                Nama Mata Kuliah <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="nama" 
                                name="nama" 
                                value="{{ old('nama', $mata_kuliah->nama) }}"
                                placeholder="Contoh: Pemrograman Web"
                                class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-pink/50 @error('nama') border-red-500 @enderror"
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
                                Nama mata kuliah harus jelas dan deskriptif
                            </p>
                        </div>

                        <!-- Kode Mata Kuliah Field -->
                        <div class="space-y-2">
                            <label for="kode" class="block text-cyber-pink font-semibold">
                                <i class="fas fa-code mr-2"></i>
                                Kode Mata Kuliah <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="kode" 
                                name="kode" 
                                value="{{ old('kode', $mata_kuliah->kode) }}"
                                placeholder="Contoh: CS101, MATH201"
                                class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-pink/50 @error('kode') border-red-500 @enderror"
                                required
                                style="text-transform: uppercase;"
                            >
                            @error('kode')
                                <div class="flex items-center space-x-2 text-red-500 text-sm mt-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <p class="text-gray-400 text-xs">
                                <i class="fas fa-info-circle mr-1"></i>
                                Kode harus unik, kombinasi huruf dan angka
                            </p>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- SKS Field -->
                        <div class="space-y-2">
                            <label for="sks" class="block text-cyber-pink font-semibold">
                                <i class="fas fa-calculator mr-2"></i>
                                Jumlah SKS <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="sks" 
                                name="sks" 
                                class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-pink/50 @error('sks') border-red-500 @enderror"
                                required
                            >
                                <option value="">Pilih jumlah SKS</option>
                                <option value="2" {{ old('sks', $mata_kuliah->sks) == '2' ? 'selected' : '' }}>2 SKS</option>
                                <option value="3" {{ old('sks', $mata_kuliah->sks) == '3' ? 'selected' : '' }}>3 SKS</option>
                                <option value="4" {{ old('sks', $mata_kuliah->sks) == '4' ? 'selected' : '' }}>4 SKS</option>
                            </select>
                            @error('sks')
                                <div class="flex items-center space-x-2 text-red-500 text-sm mt-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <p class="text-gray-400 text-xs">
                                <i class="fas fa-info-circle mr-1"></i>
                                SKS menentukan beban kerja mata kuliah
                            </p>
                        </div>

                        <!-- Dosen Field -->
                        <div class="space-y-2">
                            <label for="dosen_id" class="block text-cyber-pink font-semibold">
                                <i class="fas fa-user-tie mr-2"></i>
                                Dosen Pengampu <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="dosen_id" 
                                name="dosen_id" 
                                class="input-cyber w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-cyber-pink/50 @error('dosen_id') border-red-500 @enderror"
                                required
                            >
                                <option value="">Pilih dosen pengampu</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" 
                                            {{ old('dosen_id', $mata_kuliah->dosen_id) == $dosen->id ? 'selected' : '' }}
                                            data-email="{{ $dosen->email }}"
                                            data-mk-count="{{ $dosen->mata_kuliahs_count ?? 0 }}">
                                        {{ $dosen->nama }} 
                                        @if(isset($dosen->mata_kuliahs_count))
                                            ({{ $dosen->mata_kuliahs_count }} MK)
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <div class="flex items-center space-x-2 text-red-500 text-sm mt-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <p class="text-gray-400 text-xs" id="dosen-info">
                                <i class="fas fa-info-circle mr-1"></i>
                                Pilih dosen yang akan mengampu mata kuliah ini
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Selected Dosen Preview -->
                <div id="dosen-preview" class="hidden">
                    <div class="bg-gradient-to-r from-cyber-green/10 to-cyber-blue/10 border border-cyber-green/30 rounded-lg p-6">
                        <h4 class="text-cyber-green font-semibold mb-4 flex items-center">
                            <i class="fas fa-user-check mr-2"></i>
                            Dosen yang Dipilih
                        </h4>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center">
                                <span class="text-white font-bold" id="dosen-initial">?</span>
                            </div>
                            <div>
                                <p class="text-white font-semibold" id="dosen-name">-</p>
                                <p class="text-gray-400 text-sm" id="dosen-email">-</p>
                                <p class="text-cyber-green text-sm" id="dosen-mk-count">-</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                    <button 
                        type="submit" 
                        class="btn-cyber flex-1 py-4 px-6 rounded-lg font-semibold hover:scale-105 transition-transform duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-save"></i>
                        <span>Perbarui Mata Kuliah</span>
                    </button>
                    
                    <a 
                        href="{{ route('mata_kuliah.show', $mata_kuliah) }}" 
                        class="bg-cyber-purple/20 hover:bg-cyber-purple/30 text-cyber-purple flex-1 py-4 px-6 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-eye"></i>
                        <span>Lihat Detail</span>
                    </a>
                    
                    <a 
                        href="{{ route('mata_kuliah.index') }}" 
                        class="bg-gray-600 hover:bg-gray-500 text-white flex-1 py-4 px-6 rounded-lg font-semibold transition-colors duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>

                <!-- Form Info -->
                <div class="bg-cyber-pink/10 border border-cyber-pink/30 rounded-lg p-6">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-lightbulb text-cyber-pink text-lg mt-1"></i>
                        <div>
                            <h4 class="text-cyber-pink font-semibold mb-3">Tips Edit:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-300 text-sm">
                                <ul class="space-y-1">
                                    <li>• Pastikan perubahan data sudah sesuai dengan kurikulum</li>
                                    <li>• Kode mata kuliah baru harus tetap unik</li>
                                    <li>• Perubahan SKS akan mempengaruhi beban dosen</li>
                                </ul>
                                <ul class="space-y-1">
                                    <li>• Pergantian dosen akan mengubah jadwal pengajaran</li>
                                    <li>• Pastikan dosen baru sesuai dengan bidang keahlian</li>
                                    <li>• Riwayat perubahan akan tercatat di sistem</li>
                                </ul>
                            </div>
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
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Current Data -->
                <div>
                    <h5 class="text-cyber-blue font-semibold mb-3">
                        <i class="fas fa-database mr-2"></i>
                        Data Saat Ini
                    </h5>
                    <div class="bg-gray-800/50 rounded-lg p-6">
                        <div class="space-y-4">
                            <div>
                                <h6 class="text-xl font-semibold text-white mb-2">{{ $mata_kuliah->nama }}</h6>
                                <p class="text-cyber-blue text-sm font-semibold mb-3">
                                    <i class="fas fa-code mr-1"></i>
                                    {{ $mata_kuliah->kode }}
                                </p>
                                <div class="flex items-center space-x-4 mb-4">
                                    <span class="bg-cyber-purple/20 text-cyber-purple px-3 py-1 rounded-full text-sm font-bold">
                                        {{ $mata_kuliah->sks }} SKS
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-gray-900/50 rounded-lg">
                                <div class="w-10 h-10 bg-gradient-to-r from-gray-600 to-gray-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">
                                        {{ $mata_kuliah->dosen ? strtoupper(substr($mata_kuliah->dosen->nama, 0, 1)) : '?' }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-white font-semibold">{{ $mata_kuliah->dosen->nama ?? 'Dosen tidak ditemukan' }}</p>
                                    <p class="text-gray-400 text-sm">{{ $mata_kuliah->dosen->email ?? '-' }}</p>
                                </div>
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
                    <div class="bg-gray-800/50 rounded-lg p-6" id="preview-section">
                        <div class="space-y-4">
                            <div>
                                <h6 class="text-xl font-semibold text-white mb-2" id="preview-nama">{{ $mata_kuliah->nama }}</h6>
                                <p class="text-cyber-blue text-sm font-semibold mb-3">
                                    <i class="fas fa-code mr-1"></i>
                                    <span id="preview-kode">{{ $mata_kuliah->kode }}</span>
                                </p>
                                <div class="flex items-center space-x-4 mb-4">
                                    <span class="bg-cyber-purple/20 text-cyber-purple px-3 py-1 rounded-full text-sm font-bold">
                                        <span id="preview-sks">{{ $mata_kuliah->sks }}</span> SKS
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 p-3 bg-gray-900/50 rounded-lg">
                                <div class="w-10 h-10 bg-gradient-to-r from-cyber-green to-cyber-blue rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm" id="preview-dosen-initial">
                                        {{ $mata_kuliah->dosen ? strtoupper(substr($mata_kuliah->dosen->nama, 0, 1)) : '?' }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-white font-semibold" id="preview-dosen-name">{{ $mata_kuliah->dosen->nama ?? 'Dosen tidak ditemukan' }}</p>
                                    <p class="text-gray-400 text-sm" id="preview-dosen-email">{{ $mata_kuliah->dosen->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form elements
    const namaInput = document.getElementById('nama');
    const kodeInput = document.getElementById('kode');
    const sksSelect = document.getElementById('sks');
    const dosenSelect = document.getElementById('dosen_id');
    
    // Preview elements
    const previewNama = document.getElementById('preview-nama');
    const previewKode = document.getElementById('preview-kode');
    const previewSks = document.getElementById('preview-sks');
    const previewDosenName = document.getElementById('preview-dosen-name');
    const previewDosenEmail = document.getElementById('preview-dosen-email');
    const previewDosenInitial = document.getElementById('preview-dosen-initial');
    
    // Dosen preview elements
    const dosenPreview = document.getElementById('dosen-preview');
    const dosenName = document.getElementById('dosen-name');
    const dosenEmail = document.getElementById('dosen-email');
    const dosenInitial = document.getElementById('dosen-initial');
    const dosenMkCount = document.getElementById('dosen-mk-count');
    const dosenInfo = document.getElementById('dosen-info');

    // Original values for comparison
    const originalData = {
        nama: '{{ $mata_kuliah->nama }}',
        kode: '{{ $mata_kuliah->kode }}',
        sks: '{{ $mata_kuliah->sks }}',
        dosen_id: '{{ $mata_kuliah->dosen_id }}',
        dosen_nama: '{{ $mata_kuliah->dosen->nama ?? "" }}',
        dosen_email: '{{ $mata_kuliah->dosen->email ?? "" }}'
    };

    function updatePreview() {
        const nama = namaInput.value.trim();
        const kode = kodeInput.value.trim().toUpperCase();
        const sks = sksSelect.value;
        const selectedDosenOption = dosenSelect.options[dosenSelect.selectedIndex];

        // Update preview
        previewNama.textContent = nama || 'Nama Mata Kuliah';
        previewKode.textContent = kode || 'KODE';
        previewSks.textContent = sks || '0';
        
        if (dosenSelect.value) {
            const dosenNama = selectedDosenOption.textContent.split('(')[0].trim();
            const dosenEmailVal = selectedDosenOption.dataset.email;
            previewDosenName.textContent = dosenNama;
            previewDosenEmail.textContent = dosenEmailVal;
            previewDosenInitial.textContent = dosenNama ? dosenNama.charAt(0).toUpperCase() : '?';
        } else {
            previewDosenName.textContent = 'Belum dipilih';
            previewDosenEmail.textContent = '-';
            previewDosenInitial.textContent = '?';
        }

        // Highlight changes
        highlightChanges(nama, kode, sks, dosenSelect.value, selectedDosenOption);
    }

    function highlightChanges(nama, kode, sks, dosenId, selectedDosenOption) {
        // Reset colors
        previewNama.style.color = '';
        previewKode.style.color = '';
        previewSks.style.color = '';
        previewDosenName.style.color = '';
        previewDosenEmail.style.color = '';

        // Highlight changed fields
        if (nama !== originalData.nama) {
            previewNama.style.color = '#00F5A0';
            previewNama.style.fontWeight = 'bold';
        }

        if (kode !== originalData.kode) {
            previewKode.style.color = '#00F5A0';
            previewKode.style.fontWeight = 'bold';
        }

        if (sks !== originalData.sks) {
            previewSks.style.color = '#00F5A0';
            previewSks.style.fontWeight = 'bold';
        }

        if (dosenId !== originalData.dosen_id) {
            previewDosenName.style.color = '#00F5A0';
            previewDosenName.style.fontWeight = 'bold';
            previewDosenEmail.style.color = '#00F5A0';
        }
    }

    function updateDosenPreview() {
        const selectedOption = dosenSelect.options[dosenSelect.selectedIndex];
        
        if (dosenSelect.value) {
            const nama = selectedOption.textContent.split('(')[0].trim();
            const email = selectedOption.dataset.email;
            const mkCount = selectedOption.dataset.mkCount;
            
            dosenName.textContent = nama;
            dosenEmail.textContent = email;
            dosenInitial.textContent = nama.charAt(0).toUpperCase();
            dosenMkCount.textContent = `Mengampu ${mkCount} mata kuliah`;
            
            // Update info text
            if (parseInt(mkCount) >= 8) {
                dosenInfo.innerHTML = '<i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>Dosen ini sudah mengampu banyak mata kuliah';
                dosenInfo.className = 'text-yellow-500 text-xs';
            } else {
                dosenInfo.innerHTML = '<i class="fas fa-check-circle text-cyber-green mr-1"></i>Dosen tersedia untuk mata kuliah tambahan';
                dosenInfo.className = 'text-cyber-green text-xs';
            }
            
            dosenPreview.classList.remove('hidden');
        } else {
            dosenPreview.classList.add('hidden');
            dosenInfo.innerHTML = '<i class="fas fa-info-circle mr-1"></i>Pilih dosen yang akan mengampu mata kuliah ini';
            dosenInfo.className = 'text-gray-400 text-xs';
        }
    }

    // Event listeners
    namaInput.addEventListener('input', updatePreview);
    kodeInput.addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        updatePreview();
    });
    sksSelect.addEventListener('change', updatePreview);
    dosenSelect.addEventListener('change', function() {
        updatePreview();
        updateDosenPreview();
    });

    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
        submitButton.disabled = true;
    });

    // Initialize preview
    updatePreview();
    if (dosenSelect.value) {
        updateDosenPreview();
    }

    // Add floating label effect
    const inputs = document.querySelectorAll('.input-cyber');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            const label = this.parentElement.querySelector('label');
            if (label) label.style.color = '#FF006E';
        });
        
        input.addEventListener('blur', function() {
            const label = this.parentElement.querySelector('label');
            if (label && !this.value) {
                label.style.color = '';
            }
        });
    });

    // Real-time validation for kode
    kodeInput.addEventListener('blur', function() {
        const kode = this.value.trim();
        const kodeRegex = /^[A-Z]{2,4}[0-9]{2,4}$/;
        
        if (kode && !kodeRegex.test(kode)) {
            this.style.borderColor = '#ef4444';
            // Add error message if doesn't exist
            if (!this.parentElement.querySelector('.kode-error')) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'flex items-center space-x-2 text-red-500 text-sm mt-1 kode-error';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>Format kode tidak valid (contoh: CS101, MATH201)</span>';
                this.parentElement.appendChild(errorDiv);
            }
        } else {
            this.style.borderColor = '';
            const errorMsg = this.parentElement.querySelector('.kode-error');
            if (errorMsg) {
                errorMsg.remove();
            }
        }
    });
});
</script>
@endsection