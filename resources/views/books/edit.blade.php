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
                    
                    <!-- Informasi Dasar -->
                    <div class="mb-4">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-book me-2"></i>Informasi Dasar
                        </h5>
                        <hr class="mb-4">
                    </div>
                    
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

                    <!-- Informasi Akademik -->
                    <div class="mb-4 mt-5">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-graduation-cap me-2"></i>Informasi Akademik
                        </h5>
                        <hr class="mb-4">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ old('subject', $book->subject) }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Kategori Mata Pelajaran <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id" required>
                                <option value="">Pilih Kategori</option>
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
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="grade_level" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select class="form-select @error('grade_level') is-invalid @enderror" 
                                    id="grade_level" name="grade_level" required>
                                <option value="">Pilih Kelas</option>
                                <option value="10" {{ old('grade_level', $book->grade_level) == '10' ? 'selected' : '' }}>Kelas 10</option>
                                <option value="11" {{ old('grade_level', $book->grade_level) == '11' ? 'selected' : '' }}>Kelas 11</option>
                                <option value="12" {{ old('grade_level', $book->grade_level) == '12' ? 'selected' : '' }}>Kelas 12</option>
                            </select>
                            @error('grade_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" 
                                    id="semester" name="semester">
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ old('semester', $book->semester) == '1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="2" {{ old('semester', $book->semester) == '2' ? 'selected' : '' }}>Semester 2</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="book_type" class="form-label">Jenis Buku <span class="text-danger">*</span></label>
                            <select class="form-select @error('book_type') is-invalid @enderror" 
                                    id="book_type" name="book_type" required>
                                <option value="">Pilih Jenis</option>
                                <option value="Buku Siswa" {{ old('book_type', $book->book_type) == 'Buku Siswa' ? 'selected' : '' }}>Buku Siswa</option>
                                <option value="Buku Guru" {{ old('book_type', $book->book_type) == 'Buku Guru' ? 'selected' : '' }}>Buku Guru</option>
                            </select>
                            @error('book_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kurikulum & Penerbit -->
                    <div class="mb-4 mt-5">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-book-reader me-2"></i>Kurikulum & Penerbit
                        </h5>
                        <hr class="mb-4">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="curriculum_type" class="form-label">Jenis Kurikulum <span class="text-danger">*</span></label>
                            <select class="form-select @error('curriculum_type') is-invalid @enderror" 
                                    id="curriculum_type_select" 
                                    name="curriculum_type"
                                    onchange="toggleCustomCurriculumEdit()" 
                                    required>
                                <option value="">Pilih Kurikulum</option>
                                <option value="Kurikulum Merdeka" {{ old('curriculum_type', $book->curriculum_type) == 'Kurikulum Merdeka' ? 'selected' : '' }}>Kurikulum Merdeka</option>
                                <option value="Kurikulum 2013" {{ old('curriculum_type', $book->curriculum_type) == 'Kurikulum 2013' ? 'selected' : '' }}>Kurikulum 2013</option>
                                <option value="KTSP" {{ old('curriculum_type', $book->curriculum_type) == 'KTSP' ? 'selected' : '' }}>KTSP</option>
                                <option value="custom" {{ old('curriculum_type', $book->curriculum_type) && !in_array(old('curriculum_type', $book->curriculum_type), ['Kurikulum Merdeka', 'Kurikulum 2013', 'KTSP']) ? 'selected' : '' }}>Lainnya (Ketik Sendiri)</option>
                            </select>
                            <input type="text" 
                                   class="form-control mt-2 @error('curriculum_type') is-invalid @enderror" 
                                   id="curriculum_type_custom" 
                                   value="{{ old('curriculum_type', $book->curriculum_type) && !in_array(old('curriculum_type', $book->curriculum_type), ['Kurikulum Merdeka', 'Kurikulum 2013', 'KTSP']) ? old('curriculum_type', $book->curriculum_type) : '' }}"
                                   placeholder="Ketik nama kurikulum..."
                                   style="display: none;">
                            @error('curriculum_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="curriculum_year" class="form-label">Tahun Kurikulum</label>
                            <input type="number" class="form-control @error('curriculum_year') is-invalid @enderror" 
                                   id="curriculum_year" name="curriculum_year" 
                                   value="{{ old('curriculum_year', $book->curriculum_year) }}" 
                                   min="2000" max="2030" placeholder="2022">
                            @error('curriculum_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="published_year" class="form-label">
                                <i class="fas fa-calendar-alt me-1 text-primary"></i>Tahun Terbit
                            </label>
                            <input type="number" 
                                   class="form-control @error('published_year') is-invalid @enderror" 
                                   id="published_year" 
                                   name="published_year" 
                                   value="{{ old('published_year', $book->published_year) }}" 
                                   min="1900"
                                   max="{{ date('Y') + 1 }}"
                                   placeholder="{{ date('Y') }}">
                            @error('published_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Tahun buku diterbitkan</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="publisher" class="form-label">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                               id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" required>
                        @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4 mt-5">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-align-left me-2"></i>Deskripsi
                        </h5>
                        <hr class="mb-4">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Detail Buku -->
                    <div class="mb-4 mt-5">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i>Detail Buku
                        </h5>
                        <hr class="mb-4">
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
                    </div>

                    <!-- Stok & Harga -->
                    <div class="mb-4 mt-5">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-warehouse me-2"></i>Stok & Harga
                        </h5>
                        <hr class="mb-4">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-money-bill-wave me-1 text-success"></i>Harga per Unit
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       id="price" 
                                       name="price" 
                                       value="{{ old('price', $book->price) }}" 
                                       min="0"
                                       step="0.01"
                                       placeholder="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Harga per unit untuk perhitungan anggaran</small>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Perbarui Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle custom curriculum input for edit form
function toggleCustomCurriculumEdit() {
    const select = document.getElementById('curriculum_type_select');
    const customInput = document.getElementById('curriculum_type_custom');
    
    if (select.value === 'custom') {
        customInput.style.display = 'block';
        customInput.required = true;
        select.removeAttribute('name');
        select.removeAttribute('required');
        customInput.setAttribute('name', 'curriculum_type');
        setTimeout(() => customInput.focus(), 100);
    } else {
        customInput.style.display = 'none';
        customInput.required = false;
        customInput.removeAttribute('name');
        select.setAttribute('name', 'curriculum_type');
        select.setAttribute('required', 'required');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleCustomCurriculumEdit();
});
</script>

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
