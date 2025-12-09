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
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-light">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-light" placeholder="Cari judul buku atau mata pelajaran..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select border-0 bg-light" id="gradeFilter">
                            <option value="">Semua Kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select border-0 bg-light" id="subjectFilter">
                            <option value="">Semua Mata Pelajaran</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Kimia">Kimia</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                            <option value="Bahasa Inggris">Bahasa Inggris</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <small class="text-muted">
                            <i class="fas fa-book me-1"></i>
                            Total: <span class="fw-semibold">{{ $books->total() }}</span> buku
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Books Grid -->
@if($books->count() > 0)
    <div class="row g-3" id="booksContainer">
        @foreach($books as $book)
        <div class="col-md-6 col-lg-4 book-item" 
             data-title="{{ strtolower($book->title) }}" 
             data-subject="{{ strtolower($book->subject) }}" 
             data-grade="{{ $book->grade_level }}">
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

<!-- JavaScript for Search and Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const gradeFilter = document.getElementById('gradeFilter');
    const subjectFilter = document.getElementById('subjectFilter');
    const bookItems = document.querySelectorAll('.book-item');

    function filterBooks() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGrade = gradeFilter.value;
        const selectedSubject = subjectFilter.value.toLowerCase();

        let visibleCount = 0;

        bookItems.forEach(item => {
            const title = item.dataset.title;
            const subject = item.dataset.subject;
            const grade = item.dataset.grade;

            const matchesSearch = title.includes(searchTerm) || subject.includes(searchTerm);
            const matchesGrade = !selectedGrade || grade === selectedGrade;
            const matchesSubject = !selectedSubject || subject.includes(selectedSubject);

            if (matchesSearch && matchesGrade && matchesSubject) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results message
        const booksContainer = document.getElementById('booksContainer');
        let noResultsMsg = document.getElementById('noResultsMessage');
        
        if (visibleCount === 0 && bookItems.length > 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.id = 'noResultsMessage';
                noResultsMsg.className = 'col-12 text-center py-5';
                noResultsMsg.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <h5>Tidak ada buku yang ditemukan</h5>
                        <p>Coba ubah kata kunci pencarian atau filter</p>
                    </div>
                `;
                booksContainer.appendChild(noResultsMsg);
            }
            noResultsMsg.style.display = 'block';
        } else if (noResultsMsg) {
            noResultsMsg.style.display = 'none';
        }
    }

    // Add event listeners
    searchInput.addEventListener('input', filterBooks);
    gradeFilter.addEventListener('change', filterBooks);
    subjectFilter.addEventListener('change', filterBooks);

    // Add smooth animations
    const style = document.createElement('style');
    style.textContent = `
        .book-item {
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
    `;
    document.head.appendChild(style);
});
</script>
@endsection
