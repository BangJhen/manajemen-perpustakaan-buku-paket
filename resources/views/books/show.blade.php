@extends('layouts.app')

@section('title', $book->title . ' - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title">Detail Buku</h1>
        <p class="page-subtitle">Informasi lengkap buku paket</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">
            Edit
        </a>
        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
              onsubmit="return confirm('Hapus buku ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-secondary">
                Hapus
            </button>
        </form>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="p-4 text-center rounded mb-3 border">
                            <i class="fas fa-book fa-4x text-primary mb-2"></i>
                            <br>
                            <small class="text-muted">Cover Placeholder</small>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3 class="mb-3">{{ $book->title }}</h3>
                        
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Penerbit:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->publisher }}
                                @if($book->published_year)
                                    ({{ $book->published_year }})
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Mata Pelajaran:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->subject }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Kelas:</strong>
                            </div>
                            <div class="col-sm-8">
                                Kelas {{ $book->grade_level }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Jenis Buku:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->book_type }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Kurikulum:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->curriculum_type }}
                                @if($book->curriculum_year)
                                    ({{ $book->curriculum_year }})
                                @endif
                            </div>
                        </div>

                        @if($book->isbn)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>ISBN:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->isbn }}
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Bahasa:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->language }}
                            </div>
                        </div>

                        @if($book->published_date)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Tanggal Terbit:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->published_date->format('d F Y') }}
                            </div>
                        </div>
                        @endif

                        @if($book->pages)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Jumlah Halaman:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->pages }} halaman
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Stok:</strong>
                            </div>
                            <div class="col-sm-8">
                                <strong>{{ $book->stock }}</strong> eksemplar
                            </div>
                        </div>

                        @if($book->price)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Harga per Unit:</strong>
                            </div>
                            <div class="col-sm-8">
                                <strong>Rp {{ number_format($book->price, 0, ',', '.') }}</strong>
                                <br>
                                <small class="text-muted">
                                    Total nilai: Rp {{ number_format($book->price * $book->stock, 0, ',', '.') }}
                                </small>
                            </div>
                        </div>
                        @endif

                        @if($book->damaged_count > 0)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Buku Rusak:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="text-danger fw-semibold">
                                    {{ $book->damaged_count }} dari {{ $book->stock }} eksemplar
                                </span>
                                <br>
                                <small class="text-muted">
                                    Stok baik: {{ $book->getAvailableStock() }} eksemplar
                                </small>
                            </div>
                        </div>
                        @endif

                        @if($book->damage_notes)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Catatan Kerusakan:</strong>
                            </div>
                            <div class="col-sm-8">
                                <div class="border border-danger rounded p-2">
                                    {{ $book->damage_notes }}
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Ditambahkan:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->created_at->format('d F Y, H:i') }}
                            </div>
                        </div>

                        @if($book->updated_at != $book->created_at)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Terakhir Diperbarui:</strong>
                            </div>
                            <div class="col-sm-8">
                                {{ $book->updated_at->format('d F Y, H:i') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($book->description)
                <hr>
                <h5>Deskripsi</h5>
                <p class="text-muted">{{ $book->description }}</p>
                @endif
            </div>
        </div>

        <!-- Damage Records Section -->
        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Riwayat Kerusakan Buku</h5>
                    <a href="{{ route('books.damages.create', $book) }}" class="btn btn-primary btn-sm">
                        Tambah Laporan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($book->damages->count() > 0)
                    <p class="text-muted mb-3">
                        Total <strong>{{ $book->damages->count() }}</strong> laporan kerusakan tercatat
                    </p>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Kerusakan</th>
                                    <th>Tingkat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->damages()->latest()->get() as $damage)
                                <tr>
                                    <td>
                                        <small class="text-muted">
                                            {{ $damage->damage_date->format('d/m/Y') }}
                                        </small>
                                    </td>
                                    <td>
                                        <strong>{{ $damage->damage_type }}</strong>
                                        @if($damage->location)
                                            <br><small class="text-muted">{{ $damage->location }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $damage->getSeverityBadgeClass() }} fw-semibold">
                                            {{ ucfirst($damage->severity) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $damage->getStatusBadgeClass() }} fw-semibold">
                                            {{ str_replace('_', ' ', ucfirst($damage->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('books.damages.show', [$book, $damage]) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                Detail
                                            </a>
                                            <a href="{{ route('books.damages.edit', [$book, $damage]) }}" 
                                               class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('books.damages.destroy', [$book, $damage]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Hapus laporan kerusakan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary Statistics -->
                    <div class="row mt-4 g-3">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Belum Diperbaiki</h6>
                                    <h3 class="text-danger mb-0">
                                        {{ $book->damages()->where('status', 'rusak')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Sudah Diperbaiki</h6>
                                    <h3 class="text-success mb-0">
                                        {{ $book->damages()->where('status', 'diperbaiki')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Tidak Dapat Diperbaiki</h6>
                                    <h3 class="mb-0">
                                        {{ $book->damages()->where('status', 'tidak_dapat_diperbaiki')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-muted">Tidak Ada Laporan Kerusakan</h5>
                        <p class="text-muted">Buku ini dalam kondisi baik tanpa catatan kerusakan</p>
                        <a href="{{ route('books.damages.create', $book) }}" class="btn btn-primary">
                            Tambah Laporan Kerusakan
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0">Informasi Kurikulum</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Kurikulum:</strong><br>
                    {{ $book->curriculum_type }}
                </div>
                
                @if($book->curriculum_year)
                <div class="mb-3">
                    <strong>Tahun:</strong><br>
                    {{ $book->curriculum_year }}
                </div>
                @endif

                @if($book->semester)
                <div class="mb-3">
                    <strong>Semester:</strong><br>
                    Semester {{ $book->semester }}
                </div>
                @endif

                <div class="mb-3">
                    <strong>Penerbit:</strong><br>
                    {{ $book->publisher }}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="m-0">Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <h6>{{ $book->category->name }}</h6>
                @if($book->category->description)
                    <p class="text-muted small">{{ $book->category->description }}</p>
                @endif
                <a href="{{ route('categories.show', $book->category) }}" class="btn btn-sm btn-outline-primary">
                    Lihat Buku Paket Lain
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
