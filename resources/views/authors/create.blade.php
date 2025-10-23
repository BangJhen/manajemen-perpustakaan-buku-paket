@extends('layouts.app')

@section('title', 'Tambah Penulis - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Penulis Baru</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('authors.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Penulis <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nationality" class="form-label">Kebangsaan</label>
                            <input type="text" class="form-control @error('nationality') is-invalid @enderror" 
                                   id="nationality" name="nationality" value="{{ old('nationality') }}" 
                                   placeholder="Contoh: Indonesia">
                            @error('nationality')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="biography" class="form-label">Biografi</label>
                        <textarea class="form-control @error('biography') is-invalid @enderror" 
                                  id="biography" name="biography" rows="5" 
                                  placeholder="Ceritakan tentang latar belakang dan karya penulis...">{{ old('biography') }}</textarea>
                        @error('biography')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('authors.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Penulis
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
                <p class="text-muted small">
                    <i class="fas fa-info-circle me-2"></i>
                    Hanya nama penulis yang wajib diisi. Informasi lainnya opsional.
                </p>
                <hr>
                <p class="text-muted small">
                    <strong>Tips:</strong>
                    <br>• Biografi membantu pembaca mengenal penulis
                    <br>• Tanggal lahir akan menampilkan usia otomatis
                    <br>• Kebangsaan membantu kategorisasi
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
