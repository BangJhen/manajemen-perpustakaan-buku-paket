@extends('layouts.app')

@section('title', $category->name . ' - Sistem Manajemen Buku Paket Sekolah')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori: {{ $category->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="fas fa-book-open fa-4x text-primary mb-3"></i>
                    <h4>{{ $category->name }}</h4>
                </div>
                
                @if($category->description)
                    <p class="text-muted">{{ $category->description }}</p>
                @endif
                
                <hr>
                
                <div class="text-center">
                    <h5 class="text-primary">{{ $category->books->count() }}</h5>
                    <p class="text-muted small">Total Buku Paket</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0">Buku dalam Kategori {{ $category->name }}</h6>
            </div>
            <div class="card-body">
                @if($category->books->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Buku Paket</th>
                                    <th>Kelas</th>
                                    <th>Jenis Buku</th>
                                    <th>Kurikulum</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td><span class="badge bg-info">Kelas {{ $book->grade_level }}</span></td>
                                    <td>{{ $book->book_type }}</td>
                                    <td>{{ $book->curriculum_type }}</td>
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
                        <p class="text-gray-500">Belum ada buku dalam kategori ini.</p>
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
