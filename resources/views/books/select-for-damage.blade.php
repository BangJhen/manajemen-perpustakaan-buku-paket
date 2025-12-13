@extends('layouts.app')

@section('title', 'Pilih Buku untuk Laporan Kerusakan - Sistem Manajemen Buku Paket Sekolah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Pilih Buku untuk Dilaporkan</h1>
        <p class="page-subtitle">Pilih buku yang ingin dilaporkan kerusakannya</p>
    </div>
    <a href="{{ route('books.damaged') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<!-- Info Alert -->
<div class="card mb-4 border-primary">
    <div class="card-body">
        <h6 class="mb-2"><i class="fas fa-info-circle text-primary me-2"></i>Informasi</h6>
        <ul class="mb-0" style="font-size: 0.875rem;">
            <li class="text-muted mb-1">Pilih buku yang ingin dilaporkan dengan klik tombol <strong>"+ Lapor Kerusakan"</strong></li>
            <li class="text-muted mb-1">Setiap laporan untuk <strong>1 unit buku</strong></li>
            <li class="text-muted mb-1">Laporan maksimal sesuai dengan <strong>stok buku</strong></li>
            <li class="text-muted">Jika tombol <strong>"Penuh"</strong>, artinya semua unit sudah dilaporkan rusak</li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h6 class="mb-0">Daftar Semua Buku</h6>
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
                            <th>Stok</th>
                            <th>Sudah Dilaporkan</th>
                            <th>Sisa Bisa Lapor</th>
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
                            <td>
                                @if($book->damages->count() > 0)
                                    <span class="text-danger fw-semibold">{{ $book->damages->count() }}</span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $remaining = $book->stock - $book->damages->count();
                                @endphp
                                @if($remaining > 0)
                                    <span class="text-success fw-semibold">{{ $remaining }}</span>
                                @else
                                    <span class="text-muted">0</span>
                                @endif
                            </td>
                            <td>
                                @if($book->damages->count() < $book->stock)
                                    <a href="{{ route('books.damages.create', $book) }}" 
                                       class="btn btn-sm btn-primary action-btn"
                                       title="Lapor kerusakan buku ini">
                                        <i class="fas fa-plus me-1"></i>Lapor Kerusakan
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-secondary action-btn" 
                                            disabled
                                            title="Semua unit sudah dilaporkan rusak">
                                        <i class="fas fa-ban me-1"></i>Penuh
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                @if ($books->hasPages())
                    <nav>
                        <ul class="pagination pagination-sm">
                            @if ($books->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">‹ Sebelumnya</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->previousPageUrl() }}">‹ Sebelumnya</a>
                                </li>
                            @endif

                            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $books->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

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
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak Ada Buku</h5>
                <p class="text-muted">Belum ada buku yang terdaftar dalam sistem</p>
            </div>
        @endif
    </div>
</div>

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
</style>
@endsection
