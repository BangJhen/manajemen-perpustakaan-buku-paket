@extends('layouts.app')

@section('title', $author->name . ' - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Profil Penulis</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
        </div>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <div class="bg-light p-4 rounded mb-3">
                    <i class="fas fa-user fa-4x text-primary"></i>
                </div>
                <h4>{{ $author->name }}</h4>
                @if($author->nationality)
                    <p class="text-muted">
                        <i class="fas fa-globe me-1"></i>{{ $author->nationality }}
                    </p>
                @endif
                @if($author->birth_date)
                    <p class="text-muted">
                        <i class="fas fa-calendar me-1"></i>{{ $author->birth_date->format('d F Y') }}
                        <br><small>({{ $author->birth_date->age }} tahun)</small>
                    </p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        @if($author->biography)
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0">Biografi</h6>
            </div>
            <div class="card-body">
                <p>{{ $author->biography }}</p>
            </div>
        </div>
        @endif

        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0">Buku-buku Karya {{ $author->name }}</h6>
            </div>
            <div class="card-body">
                @if($author->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Tahun</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($author->books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td><span class="badge bg-secondary">{{ $book->category->name }}</span></td>
                                    <td>{{ $book->published_date ? $book->published_date->format('Y') : '-' }}</td>
                                    <td>
                                        <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book fa-3x text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Belum ada buku dari penulis ini.</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Buku
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
