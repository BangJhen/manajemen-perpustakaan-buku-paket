@extends('layouts.app')

@section('title', 'Dashboard - Sistem Manajemen Buku Paket Sekolah')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Buku Paket
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBooks }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Mata Pelajaran
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Stok Total
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $recentBooks->sum('stock') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Books -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buku Paket Terbaru</h6>
    </div>
    <div class="card-body">
        @if($recentBooks->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Buku Paket</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Jenis Buku</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentBooks as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td><span class="badge bg-primary">{{ $book->subject }}</span></td>
                            <td><span class="badge bg-info">Kelas {{ $book->grade_level }}</span></td>
                            <td>{{ $book->book_type }}</td>
                            <td>{{ $book->stock }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-book fa-3x text-gray-300 mb-3"></i>
                <p class="text-gray-500">Belum ada buku yang ditambahkan.</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Buku Pertama
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                <h5>Tambah Buku Paket Baru</h5>
                <p class="text-muted">Tambahkan buku paket kurikulum sekolah dari Kemendikbud</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Paket</a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <i class="fas fa-tag fa-3x text-info mb-3"></i>
                <h5>Tambah Mata Pelajaran</h5>
                <p class="text-muted">Buat mata pelajaran baru untuk mengorganisir buku paket</p>
                <a href="{{ route('categories.create') }}" class="btn btn-info">Tambah Mata Pelajaran</a>
            </div>
        </div>
    </div>
</div>
@endsection
