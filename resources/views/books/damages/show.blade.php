@extends('layouts.app')

@section('title', 'Detail Laporan Kerusakan - ' . $book->title)

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">
                    <i class="fas fa-clipboard-list text-danger me-2"></i>
                    Detail Laporan Kerusakan
                </h2>
                <p class="text-muted mb-0">{{ $book->title }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('books.damages.edit', [$book, $damage]) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit me-2"></i>Edit Laporan
                </a>
                <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
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

<!-- Damage Detail -->
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Informasi Kerusakan
                </h5>
            </div>
            <div class="card-body p-4">
                <!-- Damage Type & Severity -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Jenis Kerusakan</label>
                        <h5 class="fw-bold text-dark">{{ $damage->damage_type }}</h5>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Tingkat Kerusakan</label>
                        <div>
                            <span class="badge {{ $damage->getSeverityBadgeClass() }} fs-6">
                                {{ ucfirst($damage->severity) }}
                            </span>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Description -->
                <div class="mb-4">
                    <label class="text-muted small mb-2">Deskripsi Detail Kerusakan</label>
                    <div class="bg-light p-3 rounded">
                        <p class="mb-0">{{ $damage->description }}</p>
                    </div>
                </div>

                <!-- Location -->
                @if($damage->location)
                <div class="mb-4">
                    <label class="text-muted small mb-1">Lokasi Kerusakan</label>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                        {{ $damage->location }}
                    </p>
                </div>
                @endif

                <hr>

                <!-- Dates & Reporter -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Tanggal Ditemukan</label>
                        <p class="mb-0">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            {{ $damage->damage_date->format('d F Y') }}
                        </p>
                    </div>
                    @if($damage->reported_by)
                    <div class="col-md-6">
                        <label class="text-muted small mb-1">Dilaporkan Oleh</label>
                        <p class="mb-0">
                            <i class="fas fa-user text-primary me-2"></i>
                            {{ $damage->reported_by }}
                        </p>
                    </div>
                    @endif
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="text-muted small mb-2">Status</label>
                    <div>
                        <span class="badge {{ $damage->getStatusBadgeClass() }} fs-6 px-3 py-2">
                            @if($damage->status == 'rusak')
                                <i class="fas fa-exclamation-circle me-1"></i>Belum Diperbaiki
                            @elseif($damage->status == 'diperbaiki')
                                <i class="fas fa-check-circle me-1"></i>Sudah Diperbaiki
                            @else
                                <i class="fas fa-times-circle me-1"></i>Tidak Dapat Diperbaiki
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Repair Information -->
                @if($damage->status == 'diperbaiki')
                <hr>
                <div class="bg-success bg-opacity-10 p-3 rounded">
                    <h6 class="text-success mb-3">
                        <i class="fas fa-tools me-2"></i>
                        Informasi Perbaikan
                    </h6>
                    
                    @if($damage->repair_date)
                    <div class="mb-3">
                        <label class="text-muted small mb-1">Tanggal Perbaikan</label>
                        <p class="mb-0">
                            <i class="fas fa-calendar-check text-success me-2"></i>
                            {{ $damage->repair_date->format('d F Y') }}
                        </p>
                    </div>
                    @endif

                    @if($damage->repair_notes)
                    <div>
                        <label class="text-muted small mb-2">Catatan Perbaikan</label>
                        <div class="bg-white p-3 rounded">
                            <p class="mb-0">{{ $damage->repair_notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Timeline Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-clock me-2"></i>
                    Timeline
                </h6>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="mb-3">
                        <small class="text-muted">Dibuat</small>
                        <p class="mb-0 fw-semibold">{{ $damage->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    @if($damage->updated_at != $damage->created_at)
                    <div class="mb-3">
                        <small class="text-muted">Terakhir Diperbarui</small>
                        <p class="mb-0 fw-semibold">{{ $damage->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-cog me-2"></i>
                    Aksi
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('books.damages.edit', [$book, $damage]) }}" class="btn btn-warning text-white">
                        <i class="fas fa-edit me-2"></i>Edit Laporan
                    </a>
                    <form action="{{ route('books.damages.destroy', [$book, $damage]) }}" 
                          method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan kerusakan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Hapus Laporan
                        </button>
                    </form>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
