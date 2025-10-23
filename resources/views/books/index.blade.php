@extends('layouts.app')

@section('title', 'Kelola Buku - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Buku</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Buku
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($books->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku Paket</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Jenis Buku</th>
                            <th>Kurikulum</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $index => $book)
                        <tr>
                            <td>{{ $books->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $book->title }}</strong>
                                @if($book->semester)
                                    <br><small class="text-muted">Semester {{ $book->semester }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $book->subject }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info">Kelas {{ $book->grade_level }}</span>
                            </td>
                            <td>{{ $book->book_type }}</td>
                            <td>
                                <small>{{ $book->curriculum_type }}</small>
                                @if($book->curriculum_year)
                                    <br><small class="text-muted">{{ $book->curriculum_year }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $book->stock }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-outline-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
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
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $books->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-book fa-4x text-gray-300 mb-3"></i>
                <h5 class="text-gray-500">Belum ada buku</h5>
                <p class="text-gray-400">Mulai dengan menambahkan buku pertama Anda</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Buku Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
