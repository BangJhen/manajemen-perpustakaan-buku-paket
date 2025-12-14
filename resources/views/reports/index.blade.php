@extends('layouts.app')

@section('title', 'Laporan Buku Paket')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-file-alt me-2"></i>Laporan Buku Paket
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="{{ route('reports.print') }}" method="GET" target="_blank" id="printForm">
            @foreach(request()->all() as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Cetak Laporan
            </button>
        </form>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                        <i class="fas fa-book text-primary fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Judul Buku</h6>
                        <h3 class="mb-0">{{ $totalBooks }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 rounded p-3 me-3">
                        <i class="fas fa-boxes text-success fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Stok</h6>
                        <h3 class="mb-0">{{ number_format($totalStock) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 rounded p-3 me-3">
                        <i class="fas fa-money-bill-wave text-info fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Nilai</h6>
                        <h3 class="mb-0 small">Rp {{ number_format($totalValue, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 rounded p-3 me-3">
                        <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Buku Rusak</h6>
                        <h3 class="mb-0">{{ $totalDamaged }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white">
        <h5 class="mb-0">
            <i class="fas fa-filter me-2"></i>Filter Laporan
            <button class="btn btn-sm btn-outline-secondary float-end" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </h5>
    </div>
    <div class="collapse show" id="filterCollapse">
        <div class="card-body">
            <form action="{{ route('reports.index') }}" method="GET" id="filterForm">
                <div class="row g-3">
                    <!-- Category Filter -->
                    <div class="col-md-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subject Filter -->
                    <div class="col-md-3">
                        <label for="subject" class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="subject" name="subject" 
                               value="{{ request('subject') }}" placeholder="Cari mata pelajaran...">
                    </div>

                    <!-- Grade Level Filter -->
                    <div class="col-md-3">
                        <label for="grade_level" class="form-label">Kelas</label>
                        <select class="form-select" id="grade_level" name="grade_level">
                            <option value="">Semua Kelas</option>
                            <option value="10" {{ request('grade_level') == '10' ? 'selected' : '' }}>Kelas 10</option>
                            <option value="11" {{ request('grade_level') == '11' ? 'selected' : '' }}>Kelas 11</option>
                            <option value="12" {{ request('grade_level') == '12' ? 'selected' : '' }}>Kelas 12</option>
                        </select>
                    </div>

                    <!-- Curriculum Type Filter -->
                    <div class="col-md-3">
                        <label for="curriculum_type" class="form-label">Kurikulum</label>
                        <select class="form-select" id="curriculum_type" name="curriculum_type">
                            <option value="">Semua Kurikulum</option>
                            <option value="Kurikulum Merdeka" {{ request('curriculum_type') == 'Kurikulum Merdeka' ? 'selected' : '' }}>Kurikulum Merdeka</option>
                            <option value="Kurikulum 2013" {{ request('curriculum_type') == 'Kurikulum 2013' ? 'selected' : '' }}>Kurikulum 2013</option>
                            <option value="KTSP" {{ request('curriculum_type') == 'KTSP' ? 'selected' : '' }}>KTSP</option>
                        </select>
                    </div>

                    <!-- Publisher Filter -->
                    <div class="col-md-3">
                        <label for="publisher" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" 
                               value="{{ request('publisher') }}" placeholder="Cari penerbit...">
                    </div>

                    <!-- Published Year Filter -->
                    <div class="col-md-3">
                        <label for="published_year" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="published_year" name="published_year" 
                               value="{{ request('published_year') }}" placeholder="2024">
                    </div>

                    <!-- Date Range Filter -->
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Tanggal Input Dari</label>
                        <input type="date" class="form-control" id="date_from" name="date_from" 
                               value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="date_to" class="form-label">Tanggal Input Sampai</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" 
                               value="{{ request('date_to') }}">
                    </div>

                    <!-- Sort By -->
                    <div class="col-md-3">
                        <label for="sort_by" class="form-label">Urutkan Berdasarkan</label>
                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Judul</option>
                            <option value="subject" {{ request('sort_by') == 'subject' ? 'selected' : '' }}>Mata Pelajaran</option>
                            <option value="grade_level" {{ request('sort_by') == 'grade_level' ? 'selected' : '' }}>Kelas</option>
                            <option value="stock" {{ request('sort_by') == 'stock' ? 'selected' : '' }}>Stok</option>
                            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Input</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div class="col-md-3">
                        <label for="sort_order" class="form-label">Urutan</label>
                        <select class="form-select" id="sort_order" name="sort_order">
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>A-Z / Terkecil</option>
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Z-A / Terbesar</option>
                        </select>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Terapkan Filter
                    </button>
                    <a href="{{ route('reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo me-2"></i>Reset Filter
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Report Table -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Kurikulum</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Tanggal Masuk</th>
                        <th>Stok</th>
                        <th>Rusak</th>
                        <th>Harga</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $book->title }}</strong>
                            @if($book->isbn)
                                <br><small class="text-muted">ISBN: {{ $book->isbn }}</small>
                            @endif
                        </td>
                        <td>{{ $book->subject }}</td>
                        <td>Kelas {{ $book->grade_level }}</td>
                        <td>{{ $book->curriculum_type }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->published_year ?? '-' }}</td>
                        <td>
                            <small>{{ $book->created_at->format('d/m/Y') }}</small>
                            <br>
                            <small class="text-muted">{{ $book->created_at->format('H:i') }}</small>
                        </td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->damaged_count ?? 0 }}</td>
                        <td>
                            @if($book->price)
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($book->price)
                                <strong>Rp {{ number_format($book->price * $book->stock, 0, ',', '.') }}</strong>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada data buku yang sesuai dengan filter</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($books->count() > 0)
                <tfoot class="table-light">
                    <tr>
                        <th colspan="8" class="text-end">Total:</th>
                        <th><strong>{{ number_format($totalStock) }}</strong></th>
                        <th><strong>{{ number_format($totalDamaged) }}</strong></th>
                        <th>-</th>
                        <th><strong>Rp {{ number_format($totalValue, 0, ',', '.') }}</strong></th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
