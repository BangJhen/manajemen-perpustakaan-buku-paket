<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Buku Paket - {{ date('d/m/Y') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #333;
        }
        
        .header h2 {
            font-size: 16px;
            font-weight: normal;
            color: #666;
            margin-bottom: 10px;
        }
        
        .header .date {
            font-size: 11px;
            color: #888;
        }
        
        .filter-info {
            background: #f5f5f5;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .filter-info h3 {
            font-size: 13px;
            margin-bottom: 8px;
            color: #333;
        }
        
        .filter-info p {
            font-size: 11px;
            margin: 3px 0;
            color: #555;
        }
        
        .statistics {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 10px;
        }
        
        .stat-box {
            flex: 1;
            background: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        
        .stat-box .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .stat-box .value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background: #333;
            color: white;
        }
        
        table th {
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            font-weight: bold;
        }
        
        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            font-size: 11px;
        }
        
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        table tfoot {
            background: #f5f5f5;
            font-weight: bold;
        }
        
        table tfoot td {
            padding: 10px 8px;
            border-top: 2px solid #333;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        .badge-primary {
            background: #cce5ff;
            color: #004085;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #333;
            text-align: right;
            font-size: 11px;
            color: #666;
        }
        
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            text-align: center;
            width: 200px;
        }
        
        .signature-box .title {
            font-size: 11px;
            margin-bottom: 60px;
        }
        
        .signature-box .name {
            font-size: 11px;
            font-weight: bold;
            border-top: 1px solid #333;
            padding-top: 5px;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
            
            @page {
                margin: 1cm;
            }
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .print-button:hover {
            background: #5a6fd8;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">
        🖨️ Cetak Laporan
    </button>

    <div class="header">
        <h1>LAPORAN BUKU PAKET</h1>
        <h2>SMA Negeri 1 Dayeuhkolot</h2>
        <p class="date">Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
        @if($books->count() == 0)
            <p style="color: #dc3545; font-size: 11px; margin-top: 10px;">
                <strong>Perhatian:</strong> Tidak ada data buku. Pastikan filter sudah sesuai atau database memiliki data.
            </p>
        @endif
    </div>

    @if($request->hasAny(['category_id', 'subject', 'grade_level', 'curriculum_type', 'condition', 'publisher', 'published_year', 'date_from', 'date_to']))
    <div class="filter-info">
        <h3>Filter yang Diterapkan:</h3>
        @if($request->filled('category_id'))
            <p><strong>Kategori:</strong> {{ $books->first()->category->name ?? '-' }}</p>
        @endif
        @if($request->filled('subject'))
            <p><strong>Mata Pelajaran:</strong> {{ $request->subject }}</p>
        @endif
        @if($request->filled('grade_level'))
            <p><strong>Kelas:</strong> Kelas {{ $request->grade_level }}</p>
        @endif
        @if($request->filled('curriculum_type'))
            <p><strong>Kurikulum:</strong> {{ $request->curriculum_type }}</p>
        @endif
        @if($request->filled('condition'))
            <p><strong>Kondisi:</strong> {{ ucfirst($request->condition) }}</p>
        @endif
        @if($request->filled('publisher'))
            <p><strong>Penerbit:</strong> {{ $request->publisher }}</p>
        @endif
        @if($request->filled('published_year'))
            <p><strong>Tahun Terbit:</strong> {{ $request->published_year }}</p>
        @endif
        @if($request->filled('date_from') || $request->filled('date_to'))
            <p><strong>Periode Input:</strong> 
                {{ $request->date_from ? date('d/m/Y', strtotime($request->date_from)) : '...' }} 
                s/d 
                {{ $request->date_to ? date('d/m/Y', strtotime($request->date_to)) : '...' }}
            </p>
        @endif
    </div>
    @endif

    <div class="statistics">
        <div class="stat-box">
            <div class="label">Total Judul Buku</div>
            <div class="value">{{ $totalBooks }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Stok</div>
            <div class="value">{{ number_format($totalStock) }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Nilai</div>
            <div class="value">Rp {{ number_format($totalValue, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Buku Rusak</div>
            <div class="value">{{ $totalDamaged }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 18%;">Judul Buku</th>
                <th style="width: 9%;">Mata Pelajaran</th>
                <th style="width: 4%;">Kelas</th>
                <th style="width: 9%;">Kurikulum</th>
                <th style="width: 8%;">Penerbit</th>
                <th style="width: 5%;">Thn Terbit</th>
                <th style="width: 7%;">Tgl Masuk</th>
                <th style="width: 5%;">Stok</th>
                <th style="width: 5%;">Rusak</th>
                <th style="width: 9%;">Harga</th>
                <th style="width: 6%;">Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $book->title }}</strong>
                    @if($book->isbn)
                        <br><small style="color: #888;">ISBN: {{ $book->isbn }}</small>
                    @endif
                </td>
                <td>{{ $book->subject }}</td>
                <td>{{ $book->grade_level }}</td>
                <td>{{ $book->curriculum_type }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->published_year ?? '-' }}</td>
                <td style="font-size: 10px;">{{ $book->created_at->format('d/m/Y') }}</td>
                <td>{{ $book->stock }}</td>
                <td>{{ $book->damaged_count ?? 0 }}</td>
                <td>
                    @if($book->price)
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ ucfirst($book->condition) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="12" style="text-align: center; padding: 20px; color: #888;">
                    Tidak ada data buku yang sesuai dengan filter
                </td>
            </tr>
            @endforelse
        </tbody>
        @if($books->count() > 0)
        <tfoot>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>TOTAL:</strong></td>
                <td><strong>{{ number_format($totalStock) }}</strong></td>
                <td><strong>{{ number_format($totalDamaged) }}</strong></td>
                <td><strong>Rp {{ number_format($totalValue, 0, ',', '.') }}</strong></td>
                <td>-</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <div class="title">Mengetahui,<br>Kepala Sekolah</div>
            <div class="name">(_____________________)</div>
        </div>
        <div class="signature-box">
            <div class="title">Petugas Perpustakaan</div>
            <div class="name">(_____________________)</div>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Manajemen Buku Paket</p>
        <p>© {{ date('Y') }} SMA Negeri 1 Dayeuhkolot</p>
    </div>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
