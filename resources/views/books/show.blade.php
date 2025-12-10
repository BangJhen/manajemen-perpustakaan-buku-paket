@extends('layouts.app')

@section('title', $book->title . ' - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="d-flex gap-2">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Hapus
                </button>
            </form>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="bg-light p-4 text-center rounded mb-3">
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
                                    <span class="badge bg-secondary ms-2">
                                        <i class="fas fa-calendar-alt me-1"></i>{{ $book->published_year }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Mata Pelajaran:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-primary fs-6">{{ $book->subject }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Kelas:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-info fs-6">Kelas {{ $book->grade_level }}</span>
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
                                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }} fs-6">
                                    {{ $book->stock }} eksemplar
                                </span>
                            </div>
                        </div>

                        @if($book->price)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Harga per Unit:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-money-bill-wave me-1"></i>
                                    Rp {{ number_format($book->price, 0, ',', '.') }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    Total nilai: Rp {{ number_format($book->price * $book->stock, 0, ',', '.') }}
                                </small>
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Kondisi:</strong>
                            </div>
                            <div class="col-sm-8">
                                @if($book->condition == 'rusak')
                                    <span class="badge bg-danger fs-6">
                                        <i class="fas fa-exclamation-circle me-1"></i>Rusak
                                    </span>
                                @else
                                    <span class="badge bg-success fs-6">
                                        <i class="fas fa-check-circle me-1"></i>Baik
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($book->damaged_count > 0)
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Buku Rusak:</strong>
                            </div>
                            <div class="col-sm-8">
                                <span class="badge bg-warning text-dark fs-6">
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
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
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
        <div class="card shadow mt-4">
            <div class="card-header bg-danger text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Riwayat Kerusakan Buku
                    </h5>
                    <a href="{{ route('books.damages.create', $book) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i>Tambah Laporan
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if($book->damages->count() > 0)
                    <div class="alert alert-warning mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Total <strong>{{ $book->damages->count() }}</strong> laporan kerusakan tercatat
                    </div>

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
                                        <span class="badge {{ $damage->getSeverityBadgeClass() }}">
                                            {{ ucfirst($damage->severity) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $damage->getStatusBadgeClass() }}">
                                            {{ str_replace('_', ' ', ucfirst($damage->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('books.damages.show', [$book, $damage]) }}" 
                                               class="btn btn-info btn-sm text-white" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('books.damages.edit', [$book, $damage]) }}" 
                                               class="btn btn-warning btn-sm text-white"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('books.damages.destroy', [$book, $damage]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Hapus laporan kerusakan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
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
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card border-danger">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Belum Diperbaiki</h6>
                                    <h3 class="text-danger mb-0">
                                        {{ $book->damages()->where('status', 'rusak')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Sudah Diperbaiki</h6>
                                    <h3 class="text-success mb-0">
                                        {{ $book->damages()->where('status', 'diperbaiki')->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-dark">
                                <div class="card-body text-center">
                                    <h6 class="text-muted mb-2">Tidak Dapat Diperbaiki</h6>
                                    <h3 class="text-dark mb-0">
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
                        <a href="{{ route('books.damages.create', $book) }}" class="btn btn-danger">
                            <i class="fas fa-plus me-2"></i>Tambah Laporan Kerusakan
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0">Informasi Kurikulum</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Kurikulum:</strong><br>
                    <span class="badge bg-success">{{ $book->curriculum_type }}</span>
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

        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0">Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <h6>{{ $book->category->name }}</h6>
                @if($book->category->description)
                    <p class="text-muted small">{{ $book->category->description }}</p>
                @endif
                <a href="{{ route('categories.show', $book->category) }}" class="btn btn-sm btn-outline-secondary">
                    Lihat Buku Paket Lain
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
