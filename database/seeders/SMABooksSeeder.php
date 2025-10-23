<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SMABooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data first (disable foreign key checks)
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Book::truncate();
        Category::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Categories for SMA Subjects
        $categories = [
            ['name' => 'Matematika', 'description' => 'Buku paket mata pelajaran Matematika SMA'],
            ['name' => 'Bahasa Indonesia', 'description' => 'Buku paket mata pelajaran Bahasa Indonesia SMA'],
            ['name' => 'Bahasa Inggris', 'description' => 'Buku paket mata pelajaran Bahasa Inggris SMA'],
            ['name' => 'Fisika', 'description' => 'Buku paket mata pelajaran Fisika SMA'],
            ['name' => 'Kimia', 'description' => 'Buku paket mata pelajaran Kimia SMA'],
            ['name' => 'Biologi', 'description' => 'Buku paket mata pelajaran Biologi SMA'],
            ['name' => 'Sejarah', 'description' => 'Buku paket mata pelajaran Sejarah SMA'],
            ['name' => 'Geografi', 'description' => 'Buku paket mata pelajaran Geografi SMA'],
            ['name' => 'Ekonomi', 'description' => 'Buku paket mata pelajaran Ekonomi SMA'],
            ['name' => 'Sosiologi', 'description' => 'Buku paket mata pelajaran Sosiologi SMA'],
            ['name' => 'PPKn', 'description' => 'Buku paket mata pelajaran Pendidikan Pancasila dan Kewarganegaraan SMA'],
            ['name' => 'Seni Budaya', 'description' => 'Buku paket mata pelajaran Seni Budaya SMA'],
            ['name' => 'PJOK', 'description' => 'Buku paket mata pelajaran Pendidikan Jasmani, Olahraga, dan Kesehatan SMA'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create SMA Books for SMAN 1 Dayeuhkolot
        $smaBooks = [
            // KELAS X (10)
            // Matematika Kelas X
            [
                'title' => 'Matematika untuk SMA/MA Kelas X',
                'subject' => 'Matematika',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-900-1',
                'description' => 'Buku paket Matematika untuk siswa kelas X SMA/MA berdasarkan Kurikulum Merdeka. Membahas fungsi, trigonometri, dan statistika.',
                'published_date' => '2022-07-01',
                'pages' => 280,
                'language' => 'Indonesian',
                'stock' => 35,
                'category_id' => 1
            ],
            [
                'title' => 'Matematika untuk SMA/MA Kelas X - Buku Guru',
                'subject' => 'Matematika',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Guru',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-901-8',
                'description' => 'Buku panduan guru untuk mata pelajaran Matematika kelas X SMA/MA berdasarkan Kurikulum Merdeka.',
                'published_date' => '2022-07-01',
                'pages' => 320,
                'language' => 'Indonesian',
                'stock' => 8,
                'category_id' => 1
            ],

            // Bahasa Indonesia Kelas X
            [
                'title' => 'Bahasa Indonesia untuk SMA/MA Kelas X',
                'subject' => 'Bahasa Indonesia',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-902-5',
                'description' => 'Buku paket Bahasa Indonesia untuk siswa kelas X SMA/MA. Membahas teks laporan, eksposisi, dan anekdot.',
                'published_date' => '2022-07-01',
                'pages' => 240,
                'language' => 'Indonesian',
                'stock' => 40,
                'category_id' => 2
            ],

            // Bahasa Inggris Kelas X
            [
                'title' => 'Bahasa Inggris untuk SMA/MA Kelas X',
                'subject' => 'Bahasa Inggris',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-903-2',
                'description' => 'English textbook for grade X SMA/MA students. Covers basic communication, descriptive texts, and simple conversations.',
                'published_date' => '2022-07-01',
                'pages' => 200,
                'language' => 'Indonesian',
                'stock' => 38,
                'category_id' => 3
            ],

            // Fisika Kelas X
            [
                'title' => 'Fisika untuk SMA/MA Kelas X',
                'subject' => 'Fisika',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-904-9',
                'description' => 'Buku paket Fisika untuk siswa kelas X SMA/MA. Membahas gerak, gaya, energi, dan momentum.',
                'published_date' => '2022-07-01',
                'pages' => 260,
                'language' => 'Indonesian',
                'stock' => 32,
                'category_id' => 4
            ],

            // Kimia Kelas X
            [
                'title' => 'Kimia untuk SMA/MA Kelas X',
                'subject' => 'Kimia',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-905-6',
                'description' => 'Buku paket Kimia untuk siswa kelas X SMA/MA. Membahas struktur atom, ikatan kimia, dan stoikiometri.',
                'published_date' => '2022-07-01',
                'pages' => 250,
                'language' => 'Indonesian',
                'stock' => 30,
                'category_id' => 5
            ],

            // Biologi Kelas X
            [
                'title' => 'Biologi untuk SMA/MA Kelas X',
                'subject' => 'Biologi',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-906-3',
                'description' => 'Buku paket Biologi untuk siswa kelas X SMA/MA. Membahas keanekaragaman hayati, virus, dan bakteri.',
                'published_date' => '2022-07-01',
                'pages' => 270,
                'language' => 'Indonesian',
                'stock' => 33,
                'category_id' => 6
            ],

            // Sejarah Kelas X
            [
                'title' => 'Sejarah Indonesia untuk SMA/MA Kelas X',
                'subject' => 'Sejarah',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-907-0',
                'description' => 'Buku paket Sejarah Indonesia untuk siswa kelas X SMA/MA. Membahas masa praaksara hingga kerajaan Hindu-Buddha.',
                'published_date' => '2022-07-01',
                'pages' => 220,
                'language' => 'Indonesian',
                'stock' => 36,
                'category_id' => 7
            ],

            // KELAS XI (11)
            // Matematika Kelas XI
            [
                'title' => 'Matematika untuk SMA/MA Kelas XI',
                'subject' => 'Matematika',
                'grade_level' => '11',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-910-0',
                'description' => 'Buku paket Matematika untuk siswa kelas XI SMA/MA. Membahas limit, turunan, dan integral.',
                'published_date' => '2022-07-01',
                'pages' => 300,
                'language' => 'Indonesian',
                'stock' => 34,
                'category_id' => 1
            ],

            // Fisika Kelas XI
            [
                'title' => 'Fisika untuk SMA/MA Kelas XI',
                'subject' => 'Fisika',
                'grade_level' => '11',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-911-7',
                'description' => 'Buku paket Fisika untuk siswa kelas XI SMA/MA. Membahas gelombang, optik, dan listrik dinamis.',
                'published_date' => '2022-07-01',
                'pages' => 280,
                'language' => 'Indonesian',
                'stock' => 31,
                'category_id' => 4
            ],

            // Kimia Kelas XI
            [
                'title' => 'Kimia untuk SMA/MA Kelas XI',
                'subject' => 'Kimia',
                'grade_level' => '11',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-912-4',
                'description' => 'Buku paket Kimia untuk siswa kelas XI SMA/MA. Membahas termokimia, laju reaksi, dan kesetimbangan.',
                'published_date' => '2022-07-01',
                'pages' => 270,
                'language' => 'Indonesian',
                'stock' => 29,
                'category_id' => 5
            ],

            // Biologi Kelas XI
            [
                'title' => 'Biologi untuk SMA/MA Kelas XI',
                'subject' => 'Biologi',
                'grade_level' => '11',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-913-1',
                'description' => 'Buku paket Biologi untuk siswa kelas XI SMA/MA. Membahas sistem organ, genetika, dan evolusi.',
                'published_date' => '2022-07-01',
                'pages' => 290,
                'language' => 'Indonesian',
                'stock' => 32,
                'category_id' => 6
            ],

            // Ekonomi Kelas XI
            [
                'title' => 'Ekonomi untuk SMA/MA Kelas XI',
                'subject' => 'Ekonomi',
                'grade_level' => '11',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-914-8',
                'description' => 'Buku paket Ekonomi untuk siswa kelas XI SMA/MA. Membahas ketenagakerjaan, pendapatan nasional, dan APBN.',
                'published_date' => '2022-07-01',
                'pages' => 240,
                'language' => 'Indonesian',
                'stock' => 28,
                'category_id' => 9
            ],

            // KELAS XII (12)
            // Matematika Kelas XII
            [
                'title' => 'Matematika untuk SMA/MA Kelas XII',
                'subject' => 'Matematika',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-920-9',
                'description' => 'Buku paket Matematika untuk siswa kelas XII SMA/MA. Membahas integral lanjut, statistika inferensial, dan matematika diskrit.',
                'published_date' => '2022-07-01',
                'pages' => 320,
                'language' => 'Indonesian',
                'stock' => 33,
                'category_id' => 1
            ],

            // Fisika Kelas XII
            [
                'title' => 'Fisika untuk SMA/MA Kelas XII',
                'subject' => 'Fisika',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-921-6',
                'description' => 'Buku paket Fisika untuk siswa kelas XII SMA/MA. Membahas fisika modern, radioaktivitas, dan teknologi digital.',
                'published_date' => '2022-07-01',
                'pages' => 300,
                'language' => 'Indonesian',
                'stock' => 30,
                'category_id' => 4
            ],

            // Kimia Kelas XII
            [
                'title' => 'Kimia untuk SMA/MA Kelas XII',
                'subject' => 'Kimia',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-922-3',
                'description' => 'Buku paket Kimia untuk siswa kelas XII SMA/MA. Membahas kimia organik, polimer, dan biokimia.',
                'published_date' => '2022-07-01',
                'pages' => 280,
                'language' => 'Indonesian',
                'stock' => 27,
                'category_id' => 5
            ],

            // Biologi Kelas XII
            [
                'title' => 'Biologi untuk SMA/MA Kelas XII',
                'subject' => 'Biologi',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-923-0',
                'description' => 'Buku paket Biologi untuk siswa kelas XII SMA/MA. Membahas bioteknologi, ekologi, dan lingkungan.',
                'published_date' => '2022-07-01',
                'pages' => 290,
                'language' => 'Indonesian',
                'stock' => 31,
                'category_id' => 6
            ],

            // Geografi Kelas XII
            [
                'title' => 'Geografi untuk SMA/MA Kelas XII',
                'subject' => 'Geografi',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-924-7',
                'description' => 'Buku paket Geografi untuk siswa kelas XII SMA/MA. Membahas interaksi keruangan, pembangunan berkelanjutan, dan mitigasi bencana.',
                'published_date' => '2022-07-01',
                'pages' => 250,
                'language' => 'Indonesian',
                'stock' => 26,
                'category_id' => 8
            ],

            // Sosiologi Kelas XII
            [
                'title' => 'Sosiologi untuk SMA/MA Kelas XII',
                'subject' => 'Sosiologi',
                'grade_level' => '12',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-925-4',
                'description' => 'Buku paket Sosiologi untuk siswa kelas XII SMA/MA. Membahas perubahan sosial, globalisasi, dan modernisasi.',
                'published_date' => '2022-07-01',
                'pages' => 230,
                'language' => 'Indonesian',
                'stock' => 25,
                'category_id' => 10
            ],

            // PPKn untuk semua kelas
            [
                'title' => 'Pendidikan Pancasila dan Kewarganegaraan untuk SMA/MA Kelas X',
                'subject' => 'PPKn',
                'grade_level' => '10',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-930-8',
                'description' => 'Buku paket PPKn untuk siswa kelas X SMA/MA. Membahas nilai-nilai Pancasila dan sistem hukum Indonesia.',
                'published_date' => '2022-07-01',
                'pages' => 180,
                'language' => 'Indonesian',
                'stock' => 40,
                'category_id' => 11
            ],
        ];

        foreach ($smaBooks as $book) {
            Book::create($book);
        }
    }
}
