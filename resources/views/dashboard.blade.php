@extends('layouts.app')

@section('title', 'Dashboard - SMAN 1 Dayeuhkolot | Sistem Manajemen Buku Paket')

@section('content')
<!-- Welcome Header -->
<div class="mb-5">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Sistem Manajemen Buku Paket SMAN 1 Dayeuhkolot</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Total Buku</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $totalBooks }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded p-2">
                        <i class="fas fa-book text-primary"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Judul buku tersedia</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Mata Pelajaran</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $totalCategories }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded p-2">
                        <i class="fas fa-tags text-primary"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Kategori aktif</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Buku Rusak</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $totalDamagedUnits }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded p-2">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Unit perlu perbaikan</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Books Section -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0" style="font-weight: 600;">Buku Terbaru</h4>
        <a href="{{ route('books.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua
        </a>
    </div>
    
    @if($recentBooks->count() > 0)
        <div class="row g-3">
            @foreach($recentBooks as $book)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-1" style="font-weight: 600; font-size: 0.9375rem;">{{ Str::limit($book->title, 35) }}</h6>
                            @if($book->stock > 10)
                                <span class="badge bg-success">{{ $book->stock }}</span>
                            @elseif($book->stock > 0)
                                <span class="badge bg-warning">{{ $book->stock }}</span>
                            @else
                                <span class="badge bg-danger">0</span>
                            @endif
                        </div>
                        <p class="text-muted mb-2" style="font-size: 0.875rem;">{{ $book->subject }} • Kelas {{ $book->grade_level }}</p>
                        <p class="text-muted mb-0" style="font-size: 0.8125rem;">{{ $book->publisher }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h5 class="mb-2">Belum Ada Buku</h5>
                <p class="text-muted mb-4">Mulai dengan menambahkan buku paket pertama</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Buku
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Quick Actions -->
<div class="mb-5">
    <h4 class="mb-4" style="font-weight: 600;">Aksi Cepat</h4>
    <div class="row g-3">
        <div class="col-md-3">
            <a href="{{ route('books.create') }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded p-3 d-inline-flex mb-3">
                            <i class="fas fa-plus text-primary fa-lg"></i>
                        </div>
                        <h6 class="mb-0" style="font-weight: 600;">Tambah Buku</h6>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded p-3 d-inline-flex mb-3">
                            <i class="fas fa-tags text-primary fa-lg"></i>
                        </div>
                        <h6 class="mb-0" style="font-weight: 600;">Mata Pelajaran</h6>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3">
            <a href="{{ route('books.damaged') }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-danger bg-opacity-10 rounded p-3 d-inline-flex mb-3">
                            <i class="fas fa-exclamation-triangle text-danger fa-lg"></i>
                        </div>
                        <h6 class="mb-0" style="font-weight: 600;">Buku Rusak</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('reports.index') }}" class="text-decoration-none">
                <div class="card h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded p-3 d-inline-flex mb-3">
                            <i class="fas fa-file-alt text-primary fa-lg"></i>
                        </div>
                        <h6 class="mb-0" style="font-weight: 600;">Laporan</h6>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
