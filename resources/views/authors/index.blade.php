@extends('layouts.app')

@section('title', 'Kelola Penulis - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kelola Penulis</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Penulis
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($authors->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kebangsaan</th>
                            <th>Tanggal Lahir</th>
                            <th>Jumlah Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $index => $author)
                        <tr>
                            <td>{{ $authors->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $author->name }}</strong>
                                @if($author->biography)
                                    <br><small class="text-muted">{{ Str::limit($author->biography, 50) }}</small>
                                @endif
                            </td>
                            <td>{{ $author->nationality ?: '-' }}</td>
                            <td>
                                @if($author->birth_date)
                                    {{ $author->birth_date->format('d/m/Y') }}
                                    <br><small class="text-muted">{{ $author->birth_date->age }} tahun</small>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $author->books_count ?? 0 }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('authors.show', $author) }}" class="btn btn-outline-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus penulis ini?')">
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
            <div class="mt-3">
                {{ $authors->links('pagination.custom') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-user-edit fa-4x text-gray-300 mb-3"></i>
                <h5 class="text-gray-500">Belum ada penulis</h5>
                <p class="text-gray-400">Mulai dengan menambahkan penulis pertama</p>
                <a href="{{ route('authors.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Penulis Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
