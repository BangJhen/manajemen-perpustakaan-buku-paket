<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolPackageNoAuthorSeeder extends Seeder
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

        // Create Categories for School Subjects
        $categories = [
            ['name' => 'Matematika', 'description' => 'Buku paket mata pelajaran Matematika'],
            ['name' => 'Bahasa Indonesia', 'description' => 'Buku paket mata pelajaran Bahasa Indonesia'],
            ['name' => 'IPA', 'description' => 'Buku paket mata pelajaran Ilmu Pengetahuan Alam'],
            ['name' => 'IPS', 'description' => 'Buku paket mata pelajaran Ilmu Pengetahuan Sosial'],
            ['name' => 'PPKn', 'description' => 'Buku paket mata pelajaran Pendidikan Pancasila dan Kewarganegaraan'],
            ['name' => 'Bahasa Inggris', 'description' => 'Buku paket mata pelajaran Bahasa Inggris'],
            ['name' => 'Seni Budaya', 'description' => 'Buku paket mata pelajaran Seni Budaya'],
            ['name' => 'PJOK', 'description' => 'Buku paket mata pelajaran Pendidikan Jasmani, Olahraga, dan Kesehatan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create School Package Books (without author)
        $schoolBooks = [
            [
                'title' => 'Matematika untuk SD/MI Kelas V',
                'subject' => 'Matematika',
                'grade_level' => 'V',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-852-9',
                'description' => 'Buku paket Matematika untuk siswa kelas V SD/MI berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 180,
                'language' => 'Indonesian',
                'stock' => 25,
                'category_id' => 1
            ],
            [
                'title' => 'Matematika untuk SD/MI Kelas V - Buku Guru',
                'subject' => 'Matematika',
                'grade_level' => 'V',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Guru',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-853-6',
                'description' => 'Buku panduan guru untuk mata pelajaran Matematika kelas V SD/MI berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 220,
                'language' => 'Indonesian',
                'stock' => 5,
                'category_id' => 1
            ],
            [
                'title' => 'Bahasa Indonesia untuk SD/MI Kelas IV',
                'subject' => 'Bahasa Indonesia',
                'grade_level' => 'IV',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-840-6',
                'description' => 'Buku paket Bahasa Indonesia untuk siswa kelas IV SD/MI berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 160,
                'language' => 'Indonesian',
                'stock' => 30,
                'category_id' => 2
            ],
            [
                'title' => 'Ilmu Pengetahuan Alam untuk SD/MI Kelas VI',
                'subject' => 'IPA',
                'grade_level' => 'VI',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-860-4',
                'description' => 'Buku paket IPA untuk siswa kelas VI SD/MI berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 200,
                'language' => 'Indonesian',
                'stock' => 20,
                'category_id' => 3
            ],
            [
                'title' => 'Pendidikan Pancasila dan Kewarganegaraan untuk SMP/MTs Kelas VII',
                'subject' => 'PPKn',
                'grade_level' => 'VII',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-870-3',
                'description' => 'Buku paket PPKn untuk siswa kelas VII SMP/MTs berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 150,
                'language' => 'Indonesian',
                'stock' => 35,
                'category_id' => 5
            ],
            [
                'title' => 'Bahasa Inggris untuk SMP/MTs Kelas VIII',
                'subject' => 'Bahasa Inggris',
                'grade_level' => 'VIII',
                'semester' => null,
                'curriculum_type' => 'Kurikulum Merdeka',
                'book_type' => 'Buku Siswa',
                'publisher' => 'Kemendikbud',
                'curriculum_year' => 2022,
                'isbn' => '978-602-427-880-2',
                'description' => 'Buku paket Bahasa Inggris untuk siswa kelas VIII SMP/MTs berdasarkan Kurikulum Merdeka',
                'published_date' => '2022-01-01',
                'pages' => 170,
                'language' => 'Indonesian',
                'stock' => 28,
                'category_id' => 6
            ],
        ];

        foreach ($schoolBooks as $book) {
            Book::create($book);
        }
    }
}
