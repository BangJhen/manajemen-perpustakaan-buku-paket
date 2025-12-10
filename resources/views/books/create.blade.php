@extends('layouts.app')

@section('title', 'Tambah Buku Paket SMA - SMAN 1 Dayeuhkolot')

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Tambah Buku Paket SMA</h2>
                <p class="text-muted mb-0">Tambahkan buku paket baru untuk SMAN 1 Dayeuhkolot</p>
            </div>
            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<!-- Main Form -->
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
                <form action="{{ route('books.store') }}" method="POST" id="bookForm">
                    @csrf
                    
                    <!-- Form Icon -->
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-book text-primary fa-2x"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Informasi Buku Paket SMA</h4>
                        <p class="text-muted">Lengkapi data buku paket untuk SMAN 1 Dayeuhkolot</p>
                    </div>

                    <!-- Step 1: Basic Information -->
                    <div class="step-section mb-5" id="step1">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-size: 0.875rem;">1</div>
                            <h5 class="fw-bold text-dark mb-0">Informasi Dasar</h5>
                        </div>

                        <!-- Book Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark mb-2">
                                Judul Buku Paket <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg border-0 bg-light @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   required
                                   placeholder="Contoh: Matematika untuk SMA/MA Kelas X"
                                   style="padding: 1rem 1.25rem;">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subject and Grade -->
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label fw-semibold text-dark mb-2">
                                    Mata Pelajaran <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-0 bg-light @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required style="padding: 1rem 1.25rem;">
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
                            
                            <div class="col-md-6">
                                <label for="grade_level" class="form-label fw-semibold text-dark mb-2">
                                    Kelas <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg border-0 bg-light @error('grade_level') is-invalid @enderror" 
                                        id="grade_level" name="grade_level" required style="padding: 1rem 1.25rem;">
                                    <option value="">Pilih Kelas</option>
                                    <option value="10" {{ old('grade_level') == '10' ? 'selected' : '' }}>Kelas X (10)</option>
                                    <option value="11" {{ old('grade_level') == '11' ? 'selected' : '' }}>Kelas XI (11)</option>
                                    <option value="12" {{ old('grade_level') == '12' ? 'selected' : '' }}>Kelas XII (12)</option>
                                </select>
                                @error('grade_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Book Details -->
                    <div class="step-section mb-5" id="step2">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-size: 0.875rem;">2</div>
                            <h5 class="fw-bold text-dark mb-0">Detail Buku</h5>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="book_type" class="form-label fw-semibold text-dark mb-2">
                                    Jenis Buku <span class="text-danger">*</span>
                                </label>
                                <select class="form-select border-0 bg-light @error('book_type') is-invalid @enderror" 
                                        id="book_type" name="book_type" required style="padding: 0.75rem 1rem;">
                                    <option value="Buku Siswa" {{ old('book_type', 'Buku Siswa') == 'Buku Siswa' ? 'selected' : '' }}>Buku Siswa</option>
                                    <option value="Buku Guru" {{ old('book_type') == 'Buku Guru' ? 'selected' : '' }}>Buku Guru</option>
                                </select>
                                @error('book_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="curriculum_type" class="form-label fw-semibold text-dark mb-2">
                                    Kurikulum <span class="text-danger">*</span>
                                </label>
                                <select class="form-select border-0 bg-light @error('curriculum_type') is-invalid @enderror" 
                                        id="curriculum_type_select" 
                                        name="curriculum_type"
                                        onchange="toggleCustomCurriculum()" 
                                        required
                                        style="padding: 0.75rem 1rem;">
                                    <option value="Kurikulum Merdeka" {{ old('curriculum_type', 'Kurikulum Merdeka') == 'Kurikulum Merdeka' ? 'selected' : '' }}>Kurikulum Merdeka</option>
                                    <option value="Kurikulum 2013" {{ old('curriculum_type') == 'Kurikulum 2013' ? 'selected' : '' }}>Kurikulum 2013</option>
                                    <option value="KTSP" {{ old('curriculum_type') == 'KTSP' ? 'selected' : '' }}>KTSP</option>
                                    <option value="custom" {{ old('curriculum_type') && !in_array(old('curriculum_type'), ['Kurikulum Merdeka', 'Kurikulum 2013', 'KTSP']) ? 'selected' : '' }}>Lainnya (Ketik Sendiri)</option>
                                </select>
                                <input type="text" 
                                       class="form-control border-0 bg-light mt-2 @error('curriculum_type') is-invalid @enderror" 
                                       id="curriculum_type_custom" 
                                       value="{{ old('curriculum_type') && !in_array(old('curriculum_type'), ['Kurikulum Merdeka', 'Kurikulum 2013', 'KTSP']) ? old('curriculum_type') : '' }}"
                                       placeholder="Ketik nama kurikulum..."
                                       style="padding: 0.75rem 1rem; display: none;">
                                @error('curriculum_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="semester" class="form-label fw-semibold text-dark mb-2">Semester</label>
                                <select class="form-select border-0 bg-light @error('semester') is-invalid @enderror" 
                                        id="semester" name="semester" style="padding: 0.75rem 1rem;">
                                    <option value="">Pilih Semester</option>
                                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-4 mt-2">
                            <div class="col-md-4">
                                <label for="publisher" class="form-label fw-semibold text-dark mb-2">
                                    Penerbit <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control border-0 bg-light @error('publisher') is-invalid @enderror" 
                                       id="publisher" 
                                       name="publisher" 
                                       value="{{ old('publisher', 'Kemendikbud') }}" 
                                       required
                                       style="padding: 0.75rem 1rem;">
                                @error('publisher')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="published_year" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-calendar-alt me-1 text-primary"></i>Tahun Terbit
                                </label>
                                <input type="number" 
                                       class="form-control border-0 bg-light @error('published_year') is-invalid @enderror" 
                                       id="published_year" 
                                       name="published_year" 
                                       value="{{ old('published_year', date('Y')) }}" 
                                       min="1900"
                                       max="{{ date('Y') + 1 }}"
                                       placeholder="{{ date('Y') }}"
                                       style="padding: 0.75rem 1rem;">
                                @error('published_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Tahun buku diterbitkan</small>
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label fw-semibold text-dark mb-2">
                                    Jumlah Stok <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control border-0 bg-light @error('stock') is-invalid @enderror" 
                                       id="stock" 
                                       name="stock" 
                                       value="{{ old('stock', 1) }}" 
                                       min="0" 
                                       required
                                       style="padding: 0.75rem 1rem;">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Damage Tracking Section -->
                        <div class="row g-4 mt-2">
                            <div class="col-md-4">
                                <label for="condition" class="form-label fw-semibold text-dark mb-2">
                                    Kondisi Buku <span class="text-danger">*</span>
                                </label>
                                <select class="form-select border-0 bg-light @error('condition') is-invalid @enderror" 
                                        id="condition" 
                                        name="condition" 
                                        required
                                        style="padding: 0.75rem 1rem;">
                                    <option value="baik" {{ old('condition', 'baik') == 'baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="rusak" {{ old('condition') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                </select>
                                @error('condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="damaged_count" class="form-label fw-semibold text-dark mb-2">
                                    Jumlah Buku Rusak
                                </label>
                                <input type="number" 
                                       class="form-control border-0 bg-light @error('damaged_count') is-invalid @enderror" 
                                       id="damaged_count" 
                                       name="damaged_count" 
                                       value="{{ old('damaged_count', 0) }}" 
                                       min="0"
                                       style="padding: 0.75rem 1rem;">
                                <small class="text-muted">Jumlah buku yang rusak dari total stok</small>
                                @error('damaged_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="damage_notes" class="form-label fw-semibold text-dark mb-2">
                                    Catatan Kerusakan
                                </label>
                                <textarea class="form-control border-0 bg-light @error('damage_notes') is-invalid @enderror" 
                                          id="damage_notes" 
                                          name="damage_notes" 
                                          rows="3" 
                                          style="padding: 0.75rem 1rem;"
                                          placeholder="Jelaskan kondisi kerusakan buku (halaman robek, cover rusak, dll)">{{ old('damage_notes') }}</textarea>
                                @error('damage_notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Additional Information (Optional) -->
                    <div class="step-section mb-5" id="step3">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; font-size: 0.875rem;">3</div>
                            <h5 class="fw-bold text-dark mb-0">Informasi Tambahan <small class="text-muted">(Opsional)</small></h5>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="isbn" class="form-label fw-semibold text-dark mb-2">ISBN</label>
                                <input type="text" 
                                       class="form-control border-0 bg-light @error('isbn') is-invalid @enderror" 
                                       id="isbn" 
                                       name="isbn" 
                                       value="{{ old('isbn') }}"
                                       placeholder="978-602-427-xxx-x"
                                       style="padding: 0.75rem 1rem;">
                                @error('isbn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="pages" class="form-label fw-semibold text-dark mb-2">Jumlah Halaman</label>
                                <input type="number" 
                                       class="form-control border-0 bg-light @error('pages') is-invalid @enderror" 
                                       id="pages" 
                                       name="pages" 
                                       value="{{ old('pages') }}" 
                                       min="1"
                                       style="padding: 0.75rem 1rem;">
                                @error('pages')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-money-bill-wave me-1 text-success"></i>Harga per Unit
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light">Rp</span>
                                    <input type="number" 
                                           class="form-control border-0 bg-light @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price') }}" 
                                           min="0"
                                           step="0.01"
                                           placeholder="0"
                                           style="padding: 0.75rem 1rem;">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Harga per unit untuk perhitungan anggaran</small>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="description" class="form-label fw-semibold text-dark mb-2">Deskripsi Buku</label>
                            <textarea class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      style="padding: 1rem 1.25rem;"
                                      placeholder="Jelaskan tentang isi dan kegunaan buku paket ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden Fields with Default Values -->
                    <input type="hidden" name="subject" id="hidden_subject" value="{{ old('subject') }}">
                    <input type="hidden" name="curriculum_year" value="{{ date('Y') }}">
                    <input type="hidden" name="language" value="Indonesian">

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 justify-content-end pt-4 border-top">
                        <a href="{{ route('books.index') }}" class="btn btn-light px-4 py-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-plus me-2"></i>Tambah Buku Paket
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JavaScript for Enhanced Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookForm');
    const categorySelect = document.getElementById('category_id');
    const gradeSelect = document.getElementById('grade_level');
    const titleInput = document.getElementById('title');
    const hiddenSubject = document.getElementById('hidden_subject');

    // Auto-generate title based on selections
    function updateTitle() {
        const categoryText = categorySelect.options[categorySelect.selectedIndex]?.text || '';
        const gradeText = gradeSelect.options[gradeSelect.selectedIndex]?.text || '';
        
        if (categoryText && gradeText && !titleInput.value.trim()) {
            const romanGrade = gradeSelect.value === '10' ? 'X' : 
                             gradeSelect.value === '11' ? 'XI' : 
                             gradeSelect.value === '12' ? 'XII' : gradeSelect.value;
            
            titleInput.value = `${categoryText} untuk SMA/MA Kelas ${romanGrade}`;
        }
        
        // Update hidden subject field
        if (categoryText) {
            hiddenSubject.value = categoryText;
        }
    }

    // Event listeners for auto-generation
    categorySelect.addEventListener('change', updateTitle);
    gradeSelect.addEventListener('change', updateTitle);

    // Form validation and enhancement
    form.addEventListener('submit', function(e) {
        const requiredFields = ['title', 'category_id', 'grade_level', 'book_type', 'curriculum_type', 'publisher', 'stock'];
        let isValid = true;
        
        requiredFields.forEach(fieldName => {
            const field = document.getElementById(fieldName);
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
                field.focus();
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showAlert('Mohon lengkapi semua field yang wajib diisi!', 'warning');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Re-enable button after 5 seconds (in case of error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });

    // Input enhancements
    const inputs = document.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            if (this.value.trim()) {
                this.classList.add('filled');
            } else {
                this.classList.remove('filled');
            }
        });
    });

    // Step navigation (visual enhancement)
    const steps = document.querySelectorAll('.step-section');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const stepNumber = entry.target.id.replace('step', '');
                updateStepIndicator(stepNumber);
            }
        });
    }, { threshold: 0.5 });

    steps.forEach(step => observer.observe(step));

    function updateStepIndicator(activeStep) {
        steps.forEach((step, index) => {
            const stepNum = index + 1;
            const indicator = step.querySelector('.rounded-circle');
            
            if (stepNum <= activeStep) {
                indicator.classList.remove('bg-secondary');
                indicator.classList.add('bg-primary');
            } else {
                indicator.classList.remove('bg-primary');
                indicator.classList.add('bg-secondary');
            }
        });
    }

    // Add smooth animations and styles
    const style = document.createElement('style');
    style.textContent = `
        .form-control:focus, .form-select:focus {
            border-color: transparent !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
            background-color: #fff !important;
        }
        
        .step-section {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            padding-left: 1rem;
        }
        
        .step-section:hover {
            border-left-color: #667eea;
            background-color: rgba(102, 126, 234, 0.02);
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .form-control.filled, .form-select.filled {
            background-color: #fff !important;
        }
        
        .focused {
            transform: scale(1.01);
            transition: transform 0.2s ease;
        }
        
        @media (max-width: 768px) {
            .step-section {
                padding-left: 0.5rem;
            }
        }
    `;
    document.head.appendChild(style);

    // Auto-focus first input
    setTimeout(() => {
        titleInput.focus();
    }, 300);

    // Initialize curriculum type on page load
    toggleCustomCurriculum();
});

// Toggle custom curriculum input
function toggleCustomCurriculum() {
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

// Alert function
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 4000);
}

// Smart ISBN formatting
document.getElementById('isbn').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^\d]/g, '');
    if (value.length >= 3) {
        value = value.substring(0, 3) + '-' + value.substring(3);
    }
    if (value.length >= 7) {
        value = value.substring(0, 7) + '-' + value.substring(7);
    }
    if (value.length >= 11) {
        value = value.substring(0, 11) + '-' + value.substring(11);
    }
    if (value.length >= 13) {
        value = value.substring(0, 13) + '-' + value.substring(13, 14);
    }
    e.target.value = value;
});
</script>
@endsection
