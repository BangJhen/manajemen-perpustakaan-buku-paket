@extends('layouts.app')

@section('title', 'Edit Kategori - ' . $category->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Kategori: {{ $category->name }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('categories.show', $category) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" required
                               placeholder="Contoh: Fiksi, Non-Fiksi, Sejarah, dll">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Jelaskan tentang kategori ini...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('categories.show', $category) }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0">Informasi</h6>
            </div>
            <div class="card-body">
                <div class="small">
                    <strong>Dibuat:</strong><br>
                    {{ $category->created_at->format('d F Y, H:i') }}
                    <br><br>
                    <strong>Terakhir Diperbarui:</strong><br>
                    {{ $category->updated_at->format('d F Y, H:i') }}
                    <br><br>
                    <strong>Jumlah Buku:</strong><br>
                    {{ $category->books->count() }} buku
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
