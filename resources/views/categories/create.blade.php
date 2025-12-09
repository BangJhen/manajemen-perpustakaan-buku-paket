@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran - SMAN 1 Dayeuhkolot')

@section('content')
<!-- Header Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold text-dark mb-1">Tambah Mata Pelajaran SMA</h2>
                <p class="text-muted mb-0">Buat mata pelajaran baru untuk SMAN 1 Dayeuhkolot</p>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<!-- Main Form -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-5">
                <form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
                    @csrf
                    
                    <!-- Form Icon -->
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-tags text-primary fa-2x"></i>
                        </div>
                        <h4 class="fw-bold text-dark">Informasi Mata Pelajaran</h4>
                        <p class="text-muted">Lengkapi data mata pelajaran SMA di bawah ini</p>
                    </div>

                    <!-- Subject Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-dark mb-2">
                            Nama Mata Pelajaran <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg border-0 bg-light @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="Contoh: Matematika, Fisika, Kimia..."
                               style="padding: 1rem 1.25rem;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Pilih dari mata pelajaran SMA yang tersedia</small>
                    </div>

                    <!-- Quick Select Buttons -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-dark mb-3">Pilih Cepat Mata Pelajaran SMA:</label>
                        <div class="row g-2">
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Matematika">
                                    <i class="fas fa-calculator me-2"></i>Matematika
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Fisika">
                                    <i class="fas fa-atom me-2"></i>Fisika
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Kimia">
                                    <i class="fas fa-flask me-2"></i>Kimia
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Biologi">
                                    <i class="fas fa-leaf me-2"></i>Biologi
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Bahasa Indonesia">
                                    <i class="fas fa-language me-2"></i>B. Indonesia
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Bahasa Inggris">
                                    <i class="fas fa-globe me-2"></i>B. Inggris
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Sejarah">
                                    <i class="fas fa-landmark me-2"></i>Sejarah
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Geografi">
                                    <i class="fas fa-map me-2"></i>Geografi
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Ekonomi">
                                    <i class="fas fa-chart-line me-2"></i>Ekonomi
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Sosiologi">
                                    <i class="fas fa-users me-2"></i>Sosiologi
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="PPKn">
                                    <i class="fas fa-flag me-2"></i>PPKn
                                </button>
                            </div>
                            <div class="col-6 col-md-4">
                                <button type="button" class="btn btn-outline-primary w-100 subject-btn" data-subject="Seni Budaya">
                                    <i class="fas fa-palette me-2"></i>Seni Budaya
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="form-label fw-semibold text-dark mb-2">Deskripsi Mata Pelajaran</label>
                        <textarea class="form-control border-0 bg-light @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  style="padding: 1rem 1.25rem;"
                                  placeholder="Jelaskan tentang mata pelajaran ini untuk tingkat SMA...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Opsional - Deskripsi akan membantu dalam pengelolaan buku paket</small>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 justify-content-end">
                        <a href="{{ route('categories.index') }}" class="btn btn-light px-4 py-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="fas fa-plus me-2"></i>Tambah Mata Pelajaran
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
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const subjectButtons = document.querySelectorAll('.subject-btn');
    const form = document.getElementById('categoryForm');

    // Subject descriptions for auto-fill
    const subjectDescriptions = {
        'Matematika': 'Mata pelajaran Matematika untuk tingkat SMA yang mencakup aljabar, geometri, trigonometri, kalkulus, dan statistika.',
        'Fisika': 'Mata pelajaran Fisika SMA yang mempelajari tentang mekanika, termodinamika, gelombang, optik, dan fisika modern.',
        'Kimia': 'Mata pelajaran Kimia SMA yang membahas struktur atom, ikatan kimia, stoikiometri, termokimia, dan kimia organik.',
        'Biologi': 'Mata pelajaran Biologi SMA yang mempelajari tentang sel, genetika, evolusi, ekologi, dan sistem organ makhluk hidup.',
        'Bahasa Indonesia': 'Mata pelajaran Bahasa Indonesia SMA yang mengembangkan kemampuan berbahasa dan bersastra Indonesia.',
        'Bahasa Inggris': 'Mata pelajaran Bahasa Inggris SMA untuk mengembangkan kemampuan komunikasi dalam bahasa Inggris.',
        'Sejarah': 'Mata pelajaran Sejarah SMA yang mempelajari peristiwa masa lalu Indonesia dan dunia.',
        'Geografi': 'Mata pelajaran Geografi SMA yang mempelajari tentang bumi, lingkungan, dan interaksi manusia dengan alam.',
        'Ekonomi': 'Mata pelajaran Ekonomi SMA yang membahas tentang kegiatan ekonomi, pasar, dan pembangunan ekonomi.',
        'Sosiologi': 'Mata pelajaran Sosiologi SMA yang mempelajari tentang masyarakat, interaksi sosial, dan perubahan sosial.',
        'PPKn': 'Mata pelajaran Pendidikan Pancasila dan Kewarganegaraan untuk membentuk karakter dan kesadaran berbangsa.',
        'Seni Budaya': 'Mata pelajaran Seni Budaya SMA yang mengembangkan kreativitas dan apresiasi terhadap seni dan budaya.'
    };

    // Handle subject button clicks
    subjectButtons.forEach(button => {
        button.addEventListener('click', function() {
            const subject = this.dataset.subject;
            
            // Set subject name
            nameInput.value = subject;
            
            // Auto-fill description if empty
            if (!descriptionInput.value.trim()) {
                descriptionInput.value = subjectDescriptions[subject] || '';
            }
            
            // Visual feedback
            subjectButtons.forEach(btn => btn.classList.remove('btn-primary'));
            subjectButtons.forEach(btn => btn.classList.add('btn-outline-primary'));
            
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-primary');
            
            // Focus on description field
            setTimeout(() => {
                descriptionInput.focus();
            }, 100);
        });
    });

    // Form validation and enhancement
    form.addEventListener('submit', function(e) {
        const name = nameInput.value.trim();
        
        if (!name) {
            e.preventDefault();
            nameInput.focus();
            showAlert('Nama mata pelajaran harus diisi!', 'warning');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Re-enable button after 3 seconds (in case of error)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });

    // Input enhancements
    nameInput.addEventListener('input', function() {
        // Reset button states when typing manually
        subjectButtons.forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
        });
        
        // Find matching button and highlight it
        const inputValue = this.value.trim();
        subjectButtons.forEach(btn => {
            if (btn.dataset.subject === inputValue) {
                btn.classList.remove('btn-outline-primary');
                btn.classList.add('btn-primary');
            }
        });
    });

    // Add smooth animations
    const style = document.createElement('style');
    style.textContent = `
        .subject-btn {
            transition: all 0.2s ease;
            font-size: 0.875rem;
            padding: 0.75rem 0.5rem;
        }
        
        .subject-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .form-control:focus {
            border-color: transparent;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #fff;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        @media (max-width: 768px) {
            .subject-btn {
                font-size: 0.8rem;
                padding: 0.6rem 0.4rem;
            }
        }
    `;
    document.head.appendChild(style);
});

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
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 3000);
}
</script>
@endsection
