@extends('layouts.app')

@section('title', 'Edit Buku - ' . $book->title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Buku: {{ $book->title }}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $book->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                                   id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                            @error('isbn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="published_date" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                   id="published_date" name="published_date" 
                                   value="{{ old('published_date', $book->published_date?->format('Y-m-d')) }}">
                            @error('published_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="pages" class="form-label">Jumlah Halaman</label>
                            <input type="number" class="form-control @error('pages') is-invalid @enderror" 
                                   id="pages" name="pages" value="{{ old('pages', $book->pages) }}" min="1">
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Damage Tracking Section -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="condition" class="form-label">Kondisi Buku <span class="text-danger">*</span></label>
                            <select class="form-select @error('condition') is-invalid @enderror" 
                                    id="condition" name="condition" required>
                                <option value="baik" {{ old('condition', $book->condition ?? 'baik') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak" {{ old('condition', $book->condition) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="damaged_count" class="form-label">Jumlah Buku Rusak</label>
                            <input type="number" class="form-control @error('damaged_count') is-invalid @enderror" 
                                   id="damaged_count" name="damaged_count" 
                                   value="{{ old('damaged_count', $book->damaged_count ?? 0) }}" min="0">
                            <small class="text-muted">Jumlah buku yang rusak dari total stok</small>
                            @error('damaged_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="damage_notes" class="form-label">Catatan Kerusakan</label>
                        <textarea class="form-control @error('damage_notes') is-invalid @enderror" 
                                  id="damage_notes" name="damage_notes" rows="3" 
                                  placeholder="Jelaskan kondisi kerusakan buku">{{ old('damage_notes', $book->damage_notes) }}</textarea>
                        @error('damage_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="language" class="form-label">Bahasa <span class="text-danger">*</span></label>
                        <select class="form-select @error('language') is-invalid @enderror" 
                                id="language" name="language" required>
                            <option value="Indonesian" {{ old('language', $book->language) == 'Indonesian' ? 'selected' : '' }}>
                                Bahasa Indonesia
                            </option>
                            <option value="English" {{ old('language', $book->language) == 'English' ? 'selected' : '' }}>
                                English
                            </option>
                            <option value="Other" {{ old('language', $book->language) == 'Other' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                        @error('language')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Perbarui Buku
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
                    Pastikan semua perubahan sudah benar sebelum menyimpan.
                </p>
                <hr>
                <div class="small">
                    <strong>Dibuat:</strong><br>
                    {{ $book->created_at->format('d F Y, H:i') }}
                    <br><br>
                    <strong>Terakhir Diperbarui:</strong><br>
                    {{ $book->updated_at->format('d F Y, H:i') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
