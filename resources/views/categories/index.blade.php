@extends('layouts.app')

@section('title', 'Kelola Mata Pelajaran - SMAN 1 Dayeuhkolot')

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Kelola Mata Pelajaran SMA</h2>
                <p class="text-muted mb-0">Manajemen mata pelajaran dan kategori buku paket SMAN 1 Dayeuhkolot</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" id="toggleView" onclick="toggleViewMode()">
                    <i class="fas fa-list me-2" id="viewIcon"></i>
                    <span id="viewText">List View</span>
                </button>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Mata Pelajaran
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Overview -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 text-center">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="fas fa-tags text-primary"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">{{ $categories->total() }}</h5>
                <small class="text-muted">Total Mata Pelajaran</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 text-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="fas fa-book text-success"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">{{ $categories->sum('books_count') ?? 0 }}</h5>
                <small class="text-muted">Total Buku Paket</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 text-center">
                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="fas fa-graduation-cap text-info"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">3</h5>
                <small class="text-muted">Tingkat Kelas (X-XII)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 text-center">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                    <i class="fas fa-chart-line text-warning"></i>
                </div>
                <h5 class="fw-bold text-dark mb-0">{{ $categories->where('books_count', '>', 0)->count() }}</h5>
                <small class="text-muted">Mata Pelajaran Aktif</small>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-light">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-light" placeholder="Cari mata pelajaran..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select border-0 bg-light" id="sortFilter">
                            <option value="name">Urutkan: Nama A-Z</option>
                            <option value="books_count">Urutkan: Jumlah Buku</option>
                            <option value="created_at">Urutkan: Terbaru</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <small class="text-muted">
                            <i class="fas fa-tags me-1"></i>
                            Total: <span class="fw-semibold">{{ $categories->total() }}</span> mata pelajaran
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Categories Views -->
@if($categories->count() > 0)
    <!-- Grid View -->
    <div class="row g-4" id="gridView">
        @foreach($categories as $category)
        <div class="col-md-6 col-lg-4 category-item" 
             data-name="{{ strtolower($category->name) }}" 
             data-books="{{ $category->books_count ?? 0 }}">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <!-- Category Header -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-{{ $category->name == 'Matematika' ? 'calculator' : ($category->name == 'Fisika' ? 'atom' : ($category->name == 'Kimia' ? 'flask' : ($category->name == 'Biologi' ? 'leaf' : ($category->name == 'Bahasa Indonesia' ? 'language' : ($category->name == 'Bahasa Inggris' ? 'globe' : ($category->name == 'Sejarah' ? 'landmark' : ($category->name == 'Geografi' ? 'map' : ($category->name == 'Ekonomi' ? 'chart-line' : ($category->name == 'Sosiologi' ? 'users' : 'book'))))))))) }} text-primary fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-1">{{ $category->name }}</h5>
                                <small class="text-muted">Mata Pelajaran SMA</small>
                            </div>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary border-0 px-3 py-2">
                            {{ $category->books_count ?? 0 }} buku
                        </div>
                    </div>

                    <!-- Category Description -->
                    <p class="text-muted mb-3" style="font-size: 0.9rem; line-height: 1.5; min-height: 45px;">
                        {{ $category->description ? Str::limit($category->description, 80) : 'Mata pelajaran ' . $category->name . ' untuk tingkat SMA.' }}
                    </p>

                    <!-- Books Preview -->
                    <div class="mb-3" style="min-height: 110px;">
                        @if($category->books && $category->books->count() > 0)
                            <small class="text-muted fw-semibold">Buku Terbaru:</small>
                            <div class="mt-2">
                                @foreach($category->books->take(2) as $book)
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="bg-light rounded p-1 me-2" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-book text-muted" style="font-size: 0.6rem;"></i>
                                        </div>
                                        <small class="text-dark">{{ Str::limit($book->title, 35) }}</small>
                                    </div>
                                @endforeach
                                @if($category->books->count() > 2)
                                    <small class="text-muted">+{{ $category->books->count() - 2 }} buku lainnya</small>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-3 bg-light rounded">
                                <i class="fas fa-book-open text-muted mb-2"></i>
                                <small class="text-muted d-block">Belum ada buku paket</small>
                            </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm flex-fill" 
                                onclick="viewCategoryBooks({{ $category->id }}, '{{ $category->name }}')"
                                title="Lihat Semua Buku">
                            <i class="fas fa-eye me-1"></i>Lihat Buku
                        </button>
                        <a href="{{ route('categories.edit', $category) }}" 
                           class="btn btn-outline-warning btn-sm flex-fill" 
                           title="Edit Mata Pelajaran">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline flex-fill" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran {{ $category->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" title="Hapus Mata Pelajaran">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- List View -->
    <div class="d-none" id="listView">
        @foreach($categories as $category)
        <div class="category-item mb-3" 
             data-name="{{ strtolower($category->name) }}" 
             data-books="{{ $category->books_count ?? 0 }}">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <!-- Icon and Info -->
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-{{ $category->name == 'Matematika' ? 'calculator' : ($category->name == 'Fisika' ? 'atom' : ($category->name == 'Kimia' ? 'flask' : ($category->name == 'Biologi' ? 'leaf' : ($category->name == 'Bahasa Indonesia' ? 'language' : ($category->name == 'Bahasa Inggris' ? 'globe' : ($category->name == 'Sejarah' ? 'landmark' : ($category->name == 'Geografi' ? 'map' : ($category->name == 'Ekonomi' ? 'chart-line' : ($category->name == 'Sosiologi' ? 'users' : 'book'))))))))) }} text-primary fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $category->name }}</h5>
                                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                        {{ $category->description ? Str::limit($category->description, 100) : 'Mata pelajaran ' . $category->name . ' untuk tingkat SMA.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Stats -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="badge bg-primary bg-opacity-10 text-primary border-0 px-3 py-2 mb-2">
                                    {{ $category->books_count ?? 0 }} buku
                                </div>
                                @if($category->books && $category->books->count() > 0)
                                    <div>
                                        <small class="text-muted">Buku terbaru:</small>
                                        <div class="mt-1">
                                            @foreach($category->books->take(1) as $book)
                                                <small class="text-dark d-block">{{ Str::limit($book->title, 30) }}</small>
                                            @endforeach
                                            @if($category->books->count() > 1)
                                                <small class="text-muted">+{{ $category->books->count() - 1 }} lainnya</small>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <small class="text-muted">Belum ada buku paket</small>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-md-3">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn-outline-primary btn-sm" 
                                        onclick="viewCategoryBooks({{ $category->id }}, '{{ $category->name }}')"
                                        title="Lihat Semua Buku">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('categories.edit', $category) }}" 
                                   class="btn btn-outline-warning btn-sm" 
                                   title="Edit Mata Pelajaran">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran {{ $category->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus Mata Pelajaran">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
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
            {{ $categories->links('pagination.custom') }}
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
                        <i class="fas fa-tags fa-3x text-muted"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Belum Ada Mata Pelajaran SMA</h4>
                    <p class="text-muted mb-4">Mulai dengan menambahkan mata pelajaran SMA pertama untuk SMAN 1 Dayeuhkolot</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary px-4">
                        <i class="fas fa-plus me-2"></i>Tambah Mata Pelajaran Pertama
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal for Category Books View -->
<div class="modal fade" id="categoryBooksModal" tabindex="-1" aria-labelledby="categoryBooksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="categoryBooksModalLabel">Buku Paket Matematika</h5>
                    <small class="text-muted">Daftar buku paket dalam mata pelajaran ini</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2">
                <div id="categoryBooksContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2">Memuat data buku...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-primary" id="addBookToCategory">
                    <i class="fas fa-plus me-2"></i>Tambah Buku ke Mata Pelajaran
                </a>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Enhanced Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortFilter = document.getElementById('sortFilter');
    const categoryItems = document.querySelectorAll('.category-item');

    // Search and Filter Functionality
    function filterCategories() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;

        // Get category items from both views
        const gridItems = document.querySelectorAll('#gridView .category-item');
        const listItems = document.querySelectorAll('#listView .category-item');
        
        // Filter grid view items
        gridItems.forEach(item => {
            const name = item.dataset.name;
            const matchesSearch = name.includes(searchTerm);

            if (matchesSearch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Filter list view items
        listItems.forEach(item => {
            const name = item.dataset.name;
            const matchesSearch = name.includes(searchTerm);

            if (matchesSearch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide no results message
        showNoResultsMessage(visibleCount === 0 && (gridItems.length > 0 || listItems.length > 0));
    }

    function showNoResultsMessage(show) {
        const container = document.getElementById('categoriesContainer');
        let noResultsMsg = document.getElementById('noResultsMessage');
        
        if (show) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.id = 'noResultsMessage';
                noResultsMsg.className = 'col-12 text-center py-5';
                noResultsMsg.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <h5>Tidak ada mata pelajaran yang ditemukan</h5>
                        <p>Coba ubah kata kunci pencarian</p>
                    </div>
                `;
                container.appendChild(noResultsMsg);
            }
            noResultsMsg.style.display = 'block';
        } else if (noResultsMsg) {
            noResultsMsg.style.display = 'none';
        }
    }

    // Sort Functionality
    function sortCategories() {
        const sortBy = sortFilter.value;
        const gridContainer = document.getElementById('gridView');
        const listContainer = document.getElementById('listView');
        
        // Sort grid view items
        const gridItems = Array.from(document.querySelectorAll('#gridView .category-item'));
        gridItems.sort((a, b) => {
            if (sortBy === 'name') {
                return a.dataset.name.localeCompare(b.dataset.name);
            } else if (sortBy === 'books_count') {
                return parseInt(b.dataset.books) - parseInt(a.dataset.books);
            }
            return 0;
        });
        gridItems.forEach(item => gridContainer.appendChild(item));
        
        // Sort list view items
        const listItems = Array.from(document.querySelectorAll('#listView .category-item'));
        listItems.sort((a, b) => {
            if (sortBy === 'name') {
                return a.dataset.name.localeCompare(b.dataset.name);
            } else if (sortBy === 'books_count') {
                return parseInt(b.dataset.books) - parseInt(a.dataset.books);
            }
            return 0;
        });
        listItems.forEach(item => listContainer.appendChild(item));
    }

    // Event Listeners
    searchInput.addEventListener('input', filterCategories);
    sortFilter.addEventListener('change', sortCategories);

    // Add smooth animations only for buttons
    const style = document.createElement('style');
    style.textContent = `
        .btn {
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .modal-content {
            border-radius: 1rem;
        }
    `;
    document.head.appendChild(style);
});

// View Category Books Function
function viewCategoryBooks(categoryId, categoryName) {
    const modal = new bootstrap.Modal(document.getElementById('categoryBooksModal'));
    const modalTitle = document.getElementById('categoryBooksModalLabel');
    const modalContent = document.getElementById('categoryBooksContent');
    const addBookBtn = document.getElementById('addBookToCategory');
    
    // Update modal title
    modalTitle.textContent = `Buku Paket ${categoryName}`;
    
    // Update add book button link
    addBookBtn.href = `{{ route('books.create') }}?category=${categoryId}`;
    
    // Show loading state
    modalContent.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-muted mt-2">Memuat data buku...</p>
        </div>
    `;
    
    // Show modal
    modal.show();
    
    // Fetch books data from API
    fetch(`/api/categories/${categoryId}/books`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                displayCategoryBooks(data.books);
            } else {
                displayCategoryBooksError();
            }
        })
        .catch(error => {
            console.error('Error fetching books:', error);
            displayCategoryBooksError();
        });
}

function displayCategoryBooks(books) {
    const modalContent = document.getElementById('categoryBooksContent');
    
    if (books && books.length > 0) {
        let booksHtml = '<div class="row g-3">';
        
        books.forEach(book => {
            // Determine stock status
            let stockBadge = '';
            if (book.stock > 10) {
                stockBadge = `<span class="badge bg-success bg-opacity-10 text-success border-0" style="font-size: 0.7rem;">Tersedia (${book.stock})</span>`;
            } else if (book.stock > 0) {
                stockBadge = `<span class="badge bg-warning bg-opacity-10 text-warning border-0" style="font-size: 0.7rem;">Terbatas (${book.stock})</span>`;
            } else {
                stockBadge = `<span class="badge bg-danger bg-opacity-10 text-danger border-0" style="font-size: 0.7rem;">Habis (0)</span>`;
            }
            
            booksHtml += `
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-book text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-1" title="${book.title}">${book.title.length > 30 ? book.title.substring(0, 30) + '...' : book.title}</h6>
                                    <small class="text-muted">Kelas ${book.grade_level} • ${book.book_type}</small>
                                    <div class="mt-1">
                                        ${stockBadge}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        
        booksHtml += '</div>';
        
        // Add summary info
        const totalBooks = books.length;
        const totalStock = books.reduce((sum, book) => sum + parseInt(book.stock), 0);
        
        booksHtml = `
            <div class="mb-3 p-3 bg-light rounded">
                <div class="row text-center">
                    <div class="col-4">
                        <h6 class="fw-bold text-primary mb-0">${totalBooks}</h6>
                        <small class="text-muted">Total Buku</small>
                    </div>
                    <div class="col-4">
                        <h6 class="fw-bold text-success mb-0">${totalStock}</h6>
                        <small class="text-muted">Total Stok</small>
                    </div>
                    <div class="col-4">
                        <h6 class="fw-bold text-info mb-0">${books.filter(b => b.stock > 0).length}</h6>
                        <small class="text-muted">Tersedia</small>
                    </div>
                </div>
            </div>
        ` + booksHtml;
        
        modalContent.innerHTML = booksHtml;
    } else {
        modalContent.innerHTML = `
            <div class="text-center py-4">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-book-open fa-2x text-muted"></i>
                </div>
                <h5 class="text-dark mb-2">Belum Ada Buku Paket</h5>
                <p class="text-muted">Mata pelajaran ini belum memiliki buku paket.</p>
            </div>
        `;
    }
}

function displayCategoryBooksError() {
    const modalContent = document.getElementById('categoryBooksContent');
    modalContent.innerHTML = `
        <div class="text-center py-4">
            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
            <h5 class="text-dark mb-2">Gagal Memuat Data</h5>
            <p class="text-muted">Terjadi kesalahan saat memuat data buku.</p>
        </div>
    `;
}

// Toggle View Mode Implementation
let currentView = 'grid'; // Default view

function toggleViewMode() {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    const viewIcon = document.getElementById('viewIcon');
    const viewText = document.getElementById('viewText');
    const toggleBtn = document.getElementById('toggleView');

    if (currentView === 'grid') {
        // Switch to List View
        gridView.classList.add('d-none');
        listView.classList.remove('d-none');
        
        viewIcon.className = 'fas fa-th-large me-2';
        viewText.textContent = 'Grid View';
        
        currentView = 'list';
        
        // Add animation
        listView.style.opacity = '0';
        setTimeout(() => {
            listView.style.opacity = '1';
            listView.style.transition = 'opacity 0.3s ease';
        }, 50);
        
    } else {
        // Switch to Grid View
        listView.classList.add('d-none');
        gridView.classList.remove('d-none');
        
        viewIcon.className = 'fas fa-list me-2';
        viewText.textContent = 'List View';
        
        currentView = 'grid';
        
        // Add animation
        gridView.style.opacity = '0';
        setTimeout(() => {
            gridView.style.opacity = '1';
            gridView.style.transition = 'opacity 0.3s ease';
        }, 50);
    }
    
    // Save preference to localStorage
    localStorage.setItem('categoriesViewMode', currentView);
    
    // Update button state
    toggleBtn.blur(); // Remove focus after click
}

// Load saved view preference on page load
function loadViewPreference() {
    const savedView = localStorage.getItem('categoriesViewMode');
    if (savedView && savedView !== currentView) {
        toggleViewMode();
    }
}

// Initialize view preference when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Load view preference after a short delay to ensure elements are ready
    setTimeout(loadViewPreference, 100);
});
</script>
@endsection
