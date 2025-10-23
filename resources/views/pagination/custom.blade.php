@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <p class="text-muted mb-0 me-3">
                Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
            </p>
        </div>
        
        <ul class="pagination pagination-sm mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-light text-muted">
                        <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-left me-1"></i>Sebelumnya
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link border-0 bg-light text-muted">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link border-0 bg-primary text-white">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border-0 bg-white text-primary" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link border-0 bg-white text-primary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link border-0 bg-light text-muted">
                        Selanjutnya<i class="fas fa-chevron-right ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination .page-link {
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .pagination .page-link:hover {
            background-color: #f8f9fa !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(102, 126, 234, 0.3);
        }
        
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa !important;
            border: none !important;
        }
        
        @media (max-width: 768px) {
            .pagination .page-link {
                padding: 0.375rem 0.5rem;
                font-size: 0.8rem;
            }
            
            .pagination .page-link .fas {
                font-size: 0.7rem;
            }
        }
    </style>
@endif
