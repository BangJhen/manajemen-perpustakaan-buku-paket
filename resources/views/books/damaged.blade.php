@extends('layouts.app')

@section('title', 'Buku Paket Rusak - Sistem Manajemen Buku Paket Sekolah')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
        Buku Paket Rusak
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Semua Buku
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-warning shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku Rusak</h6>
                        <h3 class="mb-0">{{ $books->total() }}</h3>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-book-dead fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Unit Rusak</h6>
                        <h3 class="mb-0">{{ $books->sum('damaged_count') }}</h3>
                    </div>
                    <div class="text-danger">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-info shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Perlu Perhatian</h6>
                        <h3 class="mb-0">{{ $books->where('condition', 'rusak')->count() }}</h3>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-tools fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
    <div class="card-header bg-warning bg-opacity-10">
        <h6 class="m-0 text-dark">
            <i class="fas fa-list me-2"></i>Daftar Buku Paket Rusak
        </h6>
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
                            <th>Kondisi</th>
                            <th>Total Stok</th>
                            <th>Jumlah Rusak</th>
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
                            <td>
                                <span class="badge bg-primary">{{ $book->subject }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">Kelas {{ $book->grade_level }}</span>
                            </td>
                            <td>
                                @if($book->condition == 'rusak')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-exclamation-circle me-1"></i>Rusak
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Ada Kerusakan
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $book->stock }}</span>
                            </td>
                            <td>
                                <span class="badge bg-danger">{{ $book->damaged_count }}</span>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $book->getAvailableStock() }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('books.show', $book) }}" 
                                       class="btn btn-sm btn-info text-white" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" 
                                       class="btn btn-sm btn-warning text-white" 
                                       title="Edit">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                <h5>Tidak Ada Buku Rusak</h5>
                <p class="text-muted">Semua buku paket dalam kondisi baik!</p>
                <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Buku
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Info Box -->
<div class="alert alert-info mt-4" role="alert">
    <h6 class="alert-heading">
        <i class="fas fa-info-circle me-2"></i>Informasi
    </h6>
    <p class="mb-0">
        Halaman ini menampilkan semua buku paket yang memiliki kerusakan atau dalam kondisi rusak. 
        Anda dapat mengedit kondisi buku untuk memperbarui status kerusakan.
    </p>
</div>

@endsection
