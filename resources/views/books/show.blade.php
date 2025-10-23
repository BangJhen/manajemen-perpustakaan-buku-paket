@extends('layouts.app')

@section('title', $book->title . ' - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detail Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
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
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
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
                                    {{ $book->stock }} {{ $book->stock == 1 ? 'eksemplar' : 'eksemplar' }}
                                </span>
                            </div>
                        </div>

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
