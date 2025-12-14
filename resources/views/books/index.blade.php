@extends('layouts.app')

@section('title', 'Kelola Buku Paket - SMAN 1 Dayeuhkolot')

@section('content')
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Kelola Buku</h1>
        <p class="page-subtitle">Manajemen inventaris buku paket</p>
    </div>
    <a href="{{ route('books.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Buku
    </a>
</div>

<!-- Search and Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('books.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari judul buku...">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="grade">
                        <option value="">Semua Kelas</option>
                        <option value="X" {{ request('grade') == 'X' ? 'selected' : '' }}>Kelas X</option>
                        <option value="XI" {{ request('grade') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                        <option value="XII" {{ request('grade') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" name="subject">
                        <option value="">Semua Mata Pelajaran</option>
                        <option value="Matematika" {{ request('subject') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                        <option value="Fisika" {{ request('subject') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
                        <option value="Kimia" {{ request('subject') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
                        <option value="Biologi" {{ request('subject') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
                        <option value="Bahasa Indonesia" {{ request('subject') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                        <option value="Bahasa Inggris" {{ request('subject') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Cari
                        </button>
                        @if(request()->hasAny(['search', 'grade', 'subject']))
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Results Info -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Menampilkan {{ $books->count() }} dari {{ $books->total() }} buku</p>
</div>

<!-- Books Grid -->
@if($books->count() > 0)
    <div class="row g-3">
        @foreach($books as $book)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h6 class="mb-0" style="font-weight: 600; font-size: 0.9375rem;">{{ Str::limit($book->title, 40) }}</h6>
                        @if($book->stock > 10)
                            <span class="badge bg-success">{{ $book->stock }}</span>
                        @elseif($book->stock > 0)
                            <span class="badge bg-warning">{{ $book->stock }}</span>
                        @else
                            <span class="badge bg-danger">0</span>
                        @endif
                    </div>
                    
                    <p class="text-muted mb-2" style="font-size: 0.875rem;">
                        {{ $book->subject }} • Kelas {{ $book->grade_level }}
                    </p>
                    
                    <p class="text-muted mb-3" style="font-size: 0.8125rem;">
                        {{ $book->publisher }}
                        @if($book->price)
                            <br>Rp {{ number_format($book->price, 0, ',', '.') }}
                        @endif
                    </p>
                    
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top mt-auto">
                        <a href="{{ route('books.show', $book) }}" class="text-primary text-decoration-none" style="font-size: 0.875rem;">
                            Lihat Detail →
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('books.edit', $book) }}" class="text-secondary text-decoration-none" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-secondary p-0 text-decoration-none" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            {{ $books->links('pagination.custom') }}
        </div>
    </div>
@else
    <!-- Empty State -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                         style="width: 100px; height: 100px;">
                        <i class="fas fa-book fa-3x text-muted"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Belum Ada Buku Paket SMA</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan buku paket SMA pertama untuk SMAN 1 Dayeuhkolot</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Tambah Buku Pertama
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<style>
/* Card hover effect */
.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Action icons hover */
.card a i, .card button i {
    transition: color 0.2s ease;
}

.card a:hover i {
    color: #0d6efd !important;
}

.card button:hover i {
    color: #dc3545 !important;
}

/* Detail link hover */
.card a[href*="show"]:hover {
    text-decoration: underline !important;
}
</style>
@endsection
