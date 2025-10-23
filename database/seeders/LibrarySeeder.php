<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Buku-buku cerita fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku-buku berdasarkan fakta dan kenyataan'],
            ['name' => 'Sejarah', 'description' => 'Buku-buku tentang peristiwa sejarah'],
            ['name' => 'Teknologi', 'description' => 'Buku-buku tentang teknologi dan komputer'],
            ['name' => 'Pendidikan', 'description' => 'Buku-buku untuk keperluan pendidikan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Authors
        $authors = [
            [
                'name' => 'Pramoedya Ananta Toer',
                'biography' => 'Penulis Indonesia terkenal, penulis Tetralogi Pulau Buru',
                'birth_date' => '1925-02-20',
                'nationality' => 'Indonesia'
            ],
            [
                'name' => 'Andrea Hirata',
                'biography' => 'Penulis novel Laskar Pelangi yang terkenal',
                'birth_date' => '1967-10-24',
                'nationality' => 'Indonesia'
            ],
            [
                'name' => 'Tere Liye',
                'biography' => 'Penulis produktif Indonesia dengan berbagai genre',
                'birth_date' => '1979-05-21',
                'nationality' => 'Indonesia'
            ],
            [
                'name' => 'Dewi Lestari',
                'biography' => 'Penulis dan musisi Indonesia, penulis Supernova',
                'birth_date' => '1976-01-20',
                'nationality' => 'Indonesia'
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }

        // Create Books
        $books = [
            [
                'title' => 'Bumi Manusia',
                'isbn' => '9789799731234',
                'description' => 'Novel pertama dari Tetralogi Pulau Buru',
                'published_date' => '1980-01-01',
                'pages' => 535,
                'language' => 'Indonesian',
                'stock' => 5,
                'author_id' => 1,
                'category_id' => 1
            ],
            [
                'title' => 'Laskar Pelangi',
                'isbn' => '9789792248234',
                'description' => 'Novel tentang perjuangan anak-anak Belitung untuk bersekolah',
                'published_date' => '2005-01-01',
                'pages' => 529,
                'language' => 'Indonesian',
                'stock' => 8,
                'author_id' => 2,
                'category_id' => 1
            ],
            [
                'title' => 'Bumi',
                'isbn' => '9786020331234',
                'description' => 'Novel fantasi tentang petualangan di dunia paralel',
                'published_date' => '2014-01-01',
                'pages' => 440,
                'language' => 'Indonesian',
                'stock' => 12,
                'author_id' => 3,
                'category_id' => 1
            ],
            [
                'title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
                'isbn' => '9789792234567',
                'description' => 'Novel science fiction tentang cinta dan fisika kuantum',
                'published_date' => '2001-01-01',
                'pages' => 198,
                'language' => 'Indonesian',
                'stock' => 6,
                'author_id' => 4,
                'category_id' => 1
            ],
            [
                'title' => 'Anak Semua Bangsa',
                'isbn' => '9789799734567',
                'description' => 'Novel kedua dari Tetralogi Pulau Buru',
                'published_date' => '1980-01-01',
                'pages' => 518,
                'language' => 'Indonesian',
                'stock' => 4,
                'author_id' => 1,
                'category_id' => 1
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
