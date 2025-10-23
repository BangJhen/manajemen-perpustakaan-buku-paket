@extends('layouts.app')

@section('title', 'Tambah Buku - Sistem Manajemen Perpustakaan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Buku Baru</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required
                               placeholder="Contoh: Matematika untuk SD/MI Kelas V">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="subject" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select class="form-select @error('subject') is-invalid @enderror" 
                                    id="subject" name="subject" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                <option value="Matematika" {{ old('subject') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                                <option value="Bahasa Indonesia" {{ old('subject') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                                <option value="IPA" {{ old('subject') == 'IPA' ? 'selected' : '' }}>IPA (Ilmu Pengetahuan Alam)</option>
                                <option value="IPS" {{ old('subject') == 'IPS' ? 'selected' : '' }}>IPS (Ilmu Pengetahuan Sosial)</option>
                                <option value="PPKn" {{ old('subject') == 'PPKn' ? 'selected' : '' }}>PPKn (Pendidikan Pancasila dan Kewarganegaraan)</option>
                                <option value="Bahasa Inggris" {{ old('subject') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                                <option value="Seni Budaya" {{ old('subject') == 'Seni Budaya' ? 'selected' : '' }}>Seni Budaya</option>
                                <option value="PJOK" {{ old('subject') == 'PJOK' ? 'selected' : '' }}>PJOK (Pendidikan Jasmani, Olahraga, dan Kesehatan)</option>
                                <option value="Agama" {{ old('subject') == 'Agama' ? 'selected' : '' }}>Pendidikan Agama</option>
                            </select>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="grade_level" class="form-label">Kelas <span class="text-danger">*</span></label>
                            <select class="form-select @error('grade_level') is-invalid @enderror" 
                                    id="grade_level" name="grade_level" required>
                                <option value="">Pilih Kelas</option>
                                <option value="I" {{ old('grade_level') == 'I' ? 'selected' : '' }}>Kelas I</option>
                                <option value="II" {{ old('grade_level') == 'II' ? 'selected' : '' }}>Kelas II</option>
                                <option value="III" {{ old('grade_level') == 'III' ? 'selected' : '' }}>Kelas III</option>
                                <option value="IV" {{ old('grade_level') == 'IV' ? 'selected' : '' }}>Kelas IV</option>
                                <option value="V" {{ old('grade_level') == 'V' ? 'selected' : '' }}>Kelas V</option>
                                <option value="VI" {{ old('grade_level') == 'VI' ? 'selected' : '' }}>Kelas VI</option>
                                <option value="VII" {{ old('grade_level') == 'VII' ? 'selected' : '' }}>Kelas VII</option>
                                <option value="VIII" {{ old('grade_level') == 'VIII' ? 'selected' : '' }}>Kelas VIII</option>
                                <option value="IX" {{ old('grade_level') == 'IX' ? 'selected' : '' }}>Kelas IX</option>
                                <option value="X" {{ old('grade_level') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                <option value="XI" {{ old('grade_level') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                <option value="XII" {{ old('grade_level') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                            </select>
                            @error('grade_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select @error('semester') is-invalid @enderror" 
                                    id="semester" name="semester">
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                                <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="book_type" class="form-label">Jenis Buku <span class="text-danger">*</span></label>
                            <select class="form-select @error('book_type') is-invalid @enderror" 
                                    id="book_type" name="book_type" required>
                                <option value="Buku Siswa" {{ old('book_type', 'Buku Siswa') == 'Buku Siswa' ? 'selected' : '' }}>Buku Siswa</option>
                                <option value="Buku Guru" {{ old('book_type') == 'Buku Guru' ? 'selected' : '' }}>Buku Guru</option>
                            </select>
                            @error('book_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="curriculum_year" class="form-label">Tahun Kurikulum</label>
                            <input type="number" class="form-control @error('curriculum_year') is-invalid @enderror" 
                                   id="curriculum_year" name="curriculum_year" value="{{ old('curriculum_year', date('Y')) }}" 
                                   min="2000" max="2030">
                            @error('curriculum_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="curriculum_type" class="form-label">Jenis Kurikulum <span class="text-danger">*</span></label>
                            <select class="form-select @error('curriculum_type') is-invalid @enderror" 
                                    id="curriculum_type" name="curriculum_type" required>
                                <option value="Kurikulum Merdeka" {{ old('curriculum_type', 'Kurikulum Merdeka') == 'Kurikulum Merdeka' ? 'selected' : '' }}>Kurikulum Merdeka</option>
                                <option value="Kurikulum 2013" {{ old('curriculum_type') == 'Kurikulum 2013' ? 'selected' : '' }}>Kurikulum 2013</option>
                                <option value="KTSP" {{ old('curriculum_type') == 'KTSP' ? 'selected' : '' }}>KTSP</option>
                            </select>
                            @error('curriculum_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="publisher" class="form-label">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('publisher') is-invalid @enderror" 
                                   id="publisher" name="publisher" value="{{ old('publisher', 'Kemendikbud') }}" required>
                            @error('publisher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                               id="isbn" name="isbn" value="{{ old('isbn') }}"
                               placeholder="Contoh: 978-602-427-xxx-x">
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Mata Pelajaran <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                  id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="published_date" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                   id="published_date" name="published_date" value="{{ old('published_date') }}">
                            @error('published_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="pages" class="form-label">Jumlah Halaman</label>
                            <input type="number" class="form-control @error('pages') is-invalid @enderror" 
                                   id="pages" name="pages" value="{{ old('pages') }}" min="1">
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock', 1) }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="language" class="form-label">Bahasa <span class="text-danger">*</span></label>
                        <select class="form-select @error('language') is-invalid @enderror" 
                                id="language" name="language" required>
                            <option value="Indonesian" {{ old('language', 'Indonesian') == 'Indonesian' ? 'selected' : '' }}>
                                Bahasa Indonesia
                            </option>
                            <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>
                                English
                            </option>
                            <option value="Other" {{ old('language') == 'Other' ? 'selected' : '' }}>
                                Lainnya
                            </option>
                        </select>
                        @error('language')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary me-md-2">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Buku
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
                    Pastikan semua informasi buku sudah benar sebelum menyimpan.
                </p>
                <hr>
                <p class="text-muted small">
                    <strong>Tips:</strong>
                    <br>• ISBN tidak wajib diisi
                    <br>• Stok minimal adalah 0
                    <br>• Deskripsi membantu identifikasi buku
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
