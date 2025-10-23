@extends('layouts.app')

@section('title', 'Dashboard - SMAN 1 Dayeuhkolot | Sistem Manajemen Buku Paket')

@section('content')
<!-- Welcome Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h2 mb-1 text-dark fw-bold">Dashboard SMAN 1 Dayeuhkolot</h1>
                <p class="text-muted mb-0">Sistem Manajemen Buku Paket Tingkat SMA</p>
            </div>
            <div class="d-none d-md-block">
                <div class="text-end">
                    <small class="text-muted">{{ date('l, d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-5">
    <div class="col-xl-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-book text-primary"></i>
                            </div>
                            <h6 class="text-muted mb-0 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Buku Paket</h6>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $totalBooks }}</h2>
                        <small class="text-success">
                            <i class="fas fa-arrow-up me-1"></i>
                            Buku tersedia
                        </small>
                    </div>
                    <div class="text-primary opacity-75">
                        <i class="fas fa-book fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-tags text-info"></i>
                            </div>
                            <h6 class="text-muted mb-0 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Mata Pelajaran</h6>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $totalCategories }}</h2>
                        <small class="text-info">
                            <i class="fas fa-graduation-cap me-1"></i>
                            Kategori aktif
                        </small>
                    </div>
                    <div class="text-info opacity-75">
                        <i class="fas fa-tags fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-warehouse text-warning"></i>
                            </div>
                            <h6 class="text-muted mb-0 text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Stok</h6>
                        </div>
                        <h2 class="fw-bold text-dark mb-0">{{ $recentBooks->sum('stock') }}</h2>
                        <small class="text-warning">
                            <i class="fas fa-boxes me-1"></i>
                            Unit tersedia
                        </small>
                    </div>
                    <div class="text-warning opacity-75">
                        <i class="fas fa-warehouse fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Books Section -->
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">Buku Paket Terbaru</h3>
            <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-eye me-2"></i>Lihat Semua
            </a>
        </div>
        
        @if($recentBooks->count() > 0)
            <div class="row g-3">
                @foreach($recentBooks as $book)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-start justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded p-1 me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-book text-primary" style="font-size: 0.75rem;"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem; line-height: 1.2;">{{ Str::limit($book->title, 40) }}</h6>
                                        <small class="text-muted">{{ $book->book_type }}</small>
                                    </div>
                                </div>
                                @if($book->stock > 10)
                                    <span class="badge bg-success bg-opacity-10 text-success border-0 px-2 py-1" style="font-size: 0.7rem;">Tersedia</span>
                                @elseif($book->stock > 0)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border-0 px-2 py-1" style="font-size: 0.7rem;">Terbatas</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger border-0 px-2 py-1" style="font-size: 0.7rem;">Habis</span>
                                @endif
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="d-flex gap-1">
                                    <span class="badge bg-primary bg-opacity-10 text-primary border-0" style="font-size: 0.65rem; padding: 0.25rem 0.5rem;">{{ $book->subject }}</span>
                                    <span class="badge bg-info bg-opacity-10 text-info border-0" style="font-size: 0.65rem; padding: 0.25rem 0.5rem;">Kelas {{ $book->grade_level }}</span>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-boxes me-1"></i>{{ $book->stock }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-book fa-2x text-muted"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2">Belum Ada Buku Paket SMA</h5>
                    <p class="text-muted mb-4">Mulai dengan menambahkan buku paket SMA pertama untuk SMAN 1 Dayeuhkolot</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Tambah Buku Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold text-dark mb-4">Aksi Cepat</h3>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm position-relative overflow-hidden">
                    <div class="card-body p-4 text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-plus text-primary fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Tambah Buku Paket SMA</h5>
                        <p class="text-muted mb-4 small">Tambahkan buku paket kurikulum SMA dari Kemendikbud</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary w-100">
                            <i class="fas fa-book me-2"></i>Tambah Buku
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm position-relative overflow-hidden">
                    <div class="card-body p-4 text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-tags text-info fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Mata Pelajaran SMA</h5>
                        <p class="text-muted mb-4 small">Kelola mata pelajaran SMA untuk mengorganisir buku paket</p>
                        <a href="{{ route('categories.create') }}" class="btn btn-info w-100">
                            <i class="fas fa-tag me-2"></i>Tambah Kategori
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm position-relative overflow-hidden">
                    <div class="card-body p-4 text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-list text-success fa-lg"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Inventaris Buku SMA</h5>
                        <p class="text-muted mb-4 small">Kelola inventaris buku paket SMA yang tersedia</p>
                        <a href="{{ route('books.index') }}" class="btn btn-success w-100">
                            <i class="fas fa-eye me-2"></i>Lihat Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- School Info Footer -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 bg-light">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-school text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">SMAN 1 Dayeuhkolot</h6>
                                <small class="text-muted">Sistem Manajemen Buku Paket SMA</small>
                            </div>
                        </div>
                        <p class="text-muted mb-0 small">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Jl. Sukapura No.99, Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40267
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="text-end">
                            <small class="text-muted d-block">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Terakhir diperbarui: {{ date('d M Y') }}
                            </small>
                            <small class="text-muted">
                                <i class="fas fa-graduation-cap me-1"></i>
                                Tingkat SMA
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
