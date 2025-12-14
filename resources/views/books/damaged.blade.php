@extends('layouts.app')

@section('title', 'Buku Paket Rusak - Sistem Manajemen Buku Paket Sekolah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Buku Rusak</h1>
        <p class="page-subtitle">Daftar buku dengan laporan kerusakan</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('books.selectForDamage') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Buat Laporan Kerusakan
        </a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Judul Buku Rusak</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $books->total() }}</h3>
                    </div>
                    <div class="rounded p-2 border border-danger">
                        <i class="fas fa-book text-danger"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Buku dengan laporan kerusakan</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Total Unit Rusak</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $books->sum(function($book) { return $book->damages->count(); }) }}</h3>
                    </div>
                    <div class="rounded p-2 border border-danger">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Unit yang dilaporkan rusak</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Stok Tersisa Baik</p>
                        <h3 class="mb-0" style="font-size: 2rem; font-weight: 700;">{{ $books->sum(function($book) { return $book->getAvailableStock(); }) }}</h3>
                    </div>
                    <div class="rounded p-2 border border-success">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                </div>
                <p class="text-muted mb-0" style="font-size: 0.875rem;">Unit masih dalam kondisi baik</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h6 class="mb-0">Daftar Buku Rusak</h6>
    </div>
    <div class="card-body">
        @if($books->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku Paket</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Total Stok</th>
                            <th>Unit Rusak</th>
                            <th>Stok Baik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $index => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $book->title }}</strong>
                                <br>
                                <small class="text-muted">{{ $book->book_type }}</small>
                            </td>
                            <td>{{ $book->subject }}</td>
                            <td>Kelas {{ $book->grade_level }}</td>
                            <td>{{ $book->stock }}</td>
                            <td><span class="text-danger fw-semibold">{{ $book->damages->count() }}</span></td>
                            <td>{{ $book->getAvailableStock() }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('books.show', $book) }}" 
                                       class="btn btn-sm btn-outline-primary action-btn">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                @if ($books->hasPages())
                    <nav>
                        <ul class="pagination pagination-sm justify-content-center mb-0">
                            {{-- Previous --}}
                            @if ($books->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">‹ Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->previousPageUrl() }}">‹ Sebelumnya</a>
                                </li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach(range(1, $books->lastPage()) as $page)
                                @if($page == $books->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $books->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if ($books->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->nextPageUrl() }}">Selanjutnya ›</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Selanjutnya ›</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h5 class="text-muted">Belum Ada Laporan Kerusakan</h5>
                <p class="text-muted mb-3">Semua buku dalam kondisi baik. Belum ada buku yang dilaporkan rusak.</p>
                <a href="{{ route('books.selectForDamage') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Buat Laporan Kerusakan
                </a>
            </div>
        @endif
    </div>
</div>


@endsection

<style>
/* Pagination styling */
.pagination {
    gap: 0.25rem;
}

.pagination .page-link {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.375rem;
    color: #6b7280;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background-color: #f9fafb;
    border-color: #2563eb;
    color: #2563eb;
}

.pagination .page-item.active .page-link {
    background-color: #2563eb;
    border-color: #2563eb;
    color: white;
}

.pagination .page-item.disabled .page-link {
    background-color: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

/* Action button simple hover */
.action-btn {
    transition: opacity 0.2s ease;
}

.action-btn:hover {
    opacity: 0.8;
}

/* Remove background colors from badges */
.badge.bg-danger {
    background-color: transparent !important;
    color: #dc3545;
    border: 1px solid #dc3545;
}
</style>
