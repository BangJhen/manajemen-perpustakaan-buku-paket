@extends('layouts.app')

@section('title', 'Tambah Laporan Kerusakan - ' . $book->title)

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Laporan Kerusakan Buku
                </h2>
                <p class="text-muted mb-0">{{ $book->title }}</p>
            </div>
            <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<!-- Book Info Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm bg-light">
            <div class="card-body p-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="mb-1 fw-bold">{{ $book->title }}</h5>
                        <p class="text-muted mb-0">
                            <span class="badge bg-primary me-2">{{ $book->subject }}</span>
                            <span class="badge bg-info me-2">Kelas {{ $book->grade_level }}</span>
                            <span class="badge bg-secondary">Stok: {{ $book->stock }} unit</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <div class="text-danger">
                            <i class="fas fa-tools me-1"></i>
                            <strong>{{ $book->damaged_count }}</strong> unit rusak
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Damage Report Form -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
                <form action="{{ route('books.damages.store', $book) }}" method="POST">
                    @csrf

                    <!-- Form Icon -->
                    <div class="text-center mb-5">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-clipboard-list text-danger fa-2x"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Form Laporan Kerusakan</h4>
                        <p class="text-muted">Lengkapi informasi detail kerusakan buku</p>
                    </div>

                    <!-- Damage Information -->
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Informasi Kerusakan
                        </h5>

                        <div class="row g-4">
                            <!-- Damage Type -->
                            <div class="col-md-6">
                                <label for="damage_type" class="form-label fw-semibold">
                                    Jenis Kerusakan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-0 bg-light @error('damage_type') is-invalid @enderror" 
                                        id="damage_type" name="damage_type" required>
                                    <option value="">Pilih Jenis Kerusakan</option>
                                    <option value="Halaman Robek" {{ old('damage_type') == 'Halaman Robek' ? 'selected' : '' }}>Halaman Robek</option>
                                    <option value="Halaman Hilang" {{ old('damage_type') == 'Halaman Hilang' ? 'selected' : '' }}>Halaman Hilang</option>
                                    <option value="Cover Rusak" {{ old('damage_type') == 'Cover Rusak' ? 'selected' : '' }}>Cover Rusak</option>
                                    <option value="Coretan/Vandalisme" {{ old('damage_type') == 'Coretan/Vandalisme' ? 'selected' : '' }}>Coretan/Vandalisme</option>
                                    <option value="Basah/Terkena Air" {{ old('damage_type') == 'Basah/Terkena Air' ? 'selected' : '' }}>Basah/Terkena Air</option>
                                    <option value="Penjilidan Lepas" {{ old('damage_type') == 'Penjilidan Lepas' ? 'selected' : '' }}>Penjilidan Lepas</option>
                                    <option value="Lainnya" {{ old('damage_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('damage_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Severity -->
                            <div class="col-md-6">
                                <label for="severity" class="form-label fw-semibold">
                                    Tingkat Kerusakan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-0 bg-light @error('severity') is-invalid @enderror" 
                                        id="severity" name="severity" required>
                                    <option value="">Pilih Tingkat</option>
                                    <option value="ringan" {{ old('severity') == 'ringan' ? 'selected' : '' }}>
                                        🟡 Ringan (Masih bisa digunakan)
                                    </option>
                                    <option value="sedang" {{ old('severity') == 'sedang' ? 'selected' : '' }}>
                                        🟠 Sedang (Perlu perbaikan)
                                    </option>
                                    <option value="berat" {{ old('severity') == 'berat' ? 'selected' : '' }}>
                                        🔴 Berat (Tidak dapat digunakan)
                                    </option>
                                </select>
                                @error('severity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div class="col-md-6">
                                <label for="location" class="form-label fw-semibold">
                                    Lokasi Kerusakan
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg border-0 bg-light @error('location') is-invalid @enderror" 
                                       id="location" 
                                       name="location" 
                                       value="{{ old('location') }}"
                                       placeholder="Contoh: Halaman 45-50, Cover depan, dll">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Damage Date -->
                            <div class="col-md-6">
                                <label for="damage_date" class="form-label fw-semibold">
                                    Tanggal Ditemukan <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control form-control-lg border-0 bg-light @error('damage_date') is-invalid @enderror" 
                                       id="damage_date" 
                                       name="damage_date" 
                                       value="{{ old('damage_date', date('Y-m-d')) }}"
                                       required>
                                @error('damage_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">
                                    Deskripsi Detail Kerusakan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          required
                                          placeholder="Jelaskan secara detail kondisi kerusakan buku, bagian mana yang rusak, seberapa parah, dll.">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Reported By -->
                            <div class="col-md-6">
                                <label for="reported_by" class="form-label fw-semibold">
                                    Dilaporkan Oleh
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg border-0 bg-light @error('reported_by') is-invalid @enderror" 
                                       id="reported_by" 
                                       name="reported_by" 
                                       value="{{ old('reported_by') }}"
                                       placeholder="Nama pelapor">
                                @error('reported_by')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label fw-semibold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-0 bg-light @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="rusak" {{ old('status', 'rusak') == 'rusak' ? 'selected' : '' }}>Rusak (Belum Diperbaiki)</option>
                                    <option value="diperbaiki" {{ old('status') == 'diperbaiki' ? 'selected' : '' }}>Sudah Diperbaiki</option>
                                    <option value="tidak_dapat_diperbaiki" {{ old('status') == 'tidak_dapat_diperbaiki' ? 'selected' : '' }}>Tidak Dapat Diperbaiki</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Repair Information (Optional) -->
                    <div class="mb-5" id="repairSection" style="display: none;">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="fas fa-tools text-success me-2"></i>
                            Informasi Perbaikan
                        </h5>

                        <div class="row g-4">
                            <!-- Repair Date -->
                            <div class="col-md-6">
                                <label for="repair_date" class="form-label fw-semibold">
                                    Tanggal Perbaikan
                                </label>
                                <input type="date" 
                                       class="form-control form-control-lg border-0 bg-light @error('repair_date') is-invalid @enderror" 
                                       id="repair_date" 
                                       name="repair_date" 
                                       value="{{ old('repair_date') }}">
                                @error('repair_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Repair Notes -->
                            <div class="col-12">
                                <label for="repair_notes" class="form-label fw-semibold">
                                    Catatan Perbaikan
                                </label>
                                <textarea class="form-control border-0 bg-light @error('repair_notes') is-invalid @enderror" 
                                          id="repair_notes" 
                                          name="repair_notes" 
                                          rows="4"
                                          placeholder="Jelaskan tindakan perbaikan yang dilakukan">{{ old('repair_notes') }}</textarea>
                                @error('repair_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-4 border-top">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-lg btn-outline-secondary px-5">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-lg btn-danger px-5">
                            <i class="fas fa-save me-2"></i>Simpan Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Show/hide repair section based on status
document.getElementById('status').addEventListener('change', function() {
    const repairSection = document.getElementById('repairSection');
    if (this.value === 'diperbaiki') {
        repairSection.style.display = 'block';
    } else {
        repairSection.style.display = 'none';
    }
});

// Trigger on page load if status is already 'diperbaiki'
if (document.getElementById('status').value === 'diperbaiki') {
    document.getElementById('repairSection').style.display = 'block';
}
</script>
@endsection
