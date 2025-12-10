@extends('layouts.app')

@section('title', 'Kelola Buku Paket - SMAN 1 Dayeuhkolot')

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Kelola Buku Paket SMA</h2>
                <p class="text-muted mb-0">Manajemen inventaris buku paket SMAN 1 Dayeuhkolot</p>
            </div>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Buku
            </a>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="row mb-3">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <form action="{{ route('books.index') }}" method="GET" id="filterForm">
                    <div class="row g-2 align-items-end">
                        <!-- Search -->
                        <div class="col-md-3">
                            <input type="text" 
                                   class="form-control form-control-sm border-0 bg-light" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="🔍 Cari judul buku...">
                        </div>
                        <!-- Grade -->
                        <div class="col-md-2">
                            <select class="form-select form-select-sm border-0 bg-light" name="grade">
                                <option value="">Semua Kelas</option>
                                <option value="10" {{ request('grade') == '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ request('grade') == '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ request('grade') == '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                        </div>
                        <!-- Subject -->
                        <div class="col-md-2">
                            <select class="form-select form-select-sm border-0 bg-light" name="subject">
                                <option value="">Semua Mapel</option>
                                <option value="Matematika" {{ request('subject') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                                <option value="Fisika" {{ request('subject') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
                                <option value="Kimia" {{ request('subject') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
                                <option value="Biologi" {{ request('subject') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
                                <option value="Bahasa Indonesia" {{ request('subject') == 'Bahasa Indonesia' ? 'selected' : '' }}>B. Indonesia</option>
                                <option value="Bahasa Inggris" {{ request('subject') == 'Bahasa Inggris' ? 'selected' : '' }}>B. Inggris</option>
                            </select>
                        </div>
                        <!-- Date From -->
                        <div class="col-md-2">
                            <input type="date" 
                                   class="form-control form-control-sm border-0 bg-light" 
                                   name="date_from" 
                                   value="{{ request('date_from') }}"
                                   placeholder="Dari">
                        </div>
                        <!-- Date To -->
                        <div class="col-md-2">
                            <input type="date" 
                                   class="form-control form-control-sm border-0 bg-light" 
                                   name="date_to" 
                                   value="{{ request('date_to') }}"
                                   placeholder="Sampai">
                        </div>
                        <!-- Sort -->
                        <div class="col-md-1">
                            <select class="form-select form-select-sm border-0 bg-light" name="sort" title="Urutkan">
                                <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>↓</option>
                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>↑</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-2 mt-2">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                        </div>
                        @if(request()->hasAny(['search', 'grade', 'subject', 'date_from', 'date_to', 'sort']))
                        <div class="col-auto">
                            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times me-1"></i>Reset
                            </a>
                        </div>
                        @endif
                        <div class="col text-end">
                            <small class="text-muted">
                                <i class="fas fa-book me-1"></i>
                                <span class="fw-semibold">{{ $books->total() }}</span> buku
                            </small>
                        </div>
                    </div>

                    <!-- Filter Info (Compact) -->
                    @if(request()->hasAny(['search', 'grade', 'subject', 'date_from', 'date_to']))
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="fas fa-filter me-1"></i>
                            @if(request('search'))
                                <span class="badge bg-primary bg-opacity-10 text-primary border-0 me-1" style="font-size: 0.7rem;">"{{ request('search') }}"</span>
                            @endif
                            @if(request('grade'))
                                <span class="badge bg-info bg-opacity-10 text-info border-0 me-1" style="font-size: 0.7rem;">Kelas {{ request('grade') }}</span>
                            @endif
                            @if(request('subject'))
                                <span class="badge bg-success bg-opacity-10 text-success border-0 me-1" style="font-size: 0.7rem;">{{ request('subject') }}</span>
                            @endif
                            @if(request('date_from'))
                                <span class="badge bg-warning bg-opacity-10 text-warning border-0 me-1" style="font-size: 0.7rem;">{{ \Carbon\Carbon::parse(request('date_from'))->format('d/m/Y') }}</span>
                            @endif
                            @if(request('date_to'))
                                <span class="badge bg-warning bg-opacity-10 text-warning border-0 me-1" style="font-size: 0.7rem;">- {{ \Carbon\Carbon::parse(request('date_to'))->format('d/m/Y') }}</span>
                            @endif
                        </small>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Books Grid -->
@if($books->count() > 0)
    <div class="row g-3" id="booksContainer">
        @foreach($books as $book)
        <div class="col-md-6 col-lg-4 book-item">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <!-- Header with Status -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-book text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.95rem; line-height: 1.3;">
                                    {{ Str::limit($book->title, 45) }}
                                </h6>
                                <small class="text-muted">{{ $book->book_type }}</small>
                            </div>
                        </div>
                        @if($book->stock > 10)
                            <span class="badge bg-success bg-opacity-10 text-success border-0">Tersedia</span>
                        @elseif($book->stock > 0)
                            <span class="badge bg-warning bg-opacity-10 text-warning border-0">Terbatas</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger border-0">Habis</span>
                        @endif
                    </div>

                    <!-- Book Info -->
                    <div class="mb-3">
                        <div class="d-flex flex-wrap gap-1 mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary border-0" style="font-size: 0.7rem;">
                                {{ $book->subject }}
                            </span>
                            <span class="badge bg-info bg-opacity-10 text-info border-0" style="font-size: 0.7rem;">
                                Kelas {{ $book->grade_level }}
                            </span>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border-0" style="font-size: 0.7rem;">
                                {{ $book->curriculum_type }}
                            </span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-boxes me-1"></i>
                                Stok: <span class="fw-semibold text-dark">{{ $book->stock }}</span>
                                @if($book->damaged_count > 0)
                                    <span class="badge bg-danger ms-1" style="font-size: 0.65rem;">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $book->damaged_count }} rusak
                                    </span>
                                @endif
                            </small>
                            @if($book->curriculum_year)
                                <small class="text-muted">{{ $book->curriculum_year }}</small>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('books.show', $book) }}" 
                           class="btn btn-outline-primary btn-sm flex-fill" 
                           title="Lihat Detail">
                            <i class="fas fa-eye me-1"></i>Detail
                        </a>
                        <a href="{{ route('books.edit', $book) }}" 
                           class="btn btn-outline-warning btn-sm flex-fill" 
                           title="Edit Buku">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline flex-fill" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku {{ $book->title }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" title="Hapus Buku">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
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

<!-- JavaScript for Button Animations -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth animations only for buttons
    const style = document.createElement('style');
    style.textContent = `
        .btn {
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
