<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('subject')->after('title'); // Mata pelajaran (Matematika, IPA, dll)
            $table->string('grade_level')->after('subject'); // Kelas (I, II, III, IV, V, VI, VII, VIII, IX, X, XI, XII)
            $table->string('semester')->nullable()->after('grade_level'); // Semester (1 atau 2)
            $table->string('curriculum_type')->default('Kurikulum Merdeka')->after('semester'); // Jenis kurikulum
            $table->string('book_type')->default('Buku Siswa')->after('curriculum_type'); // Buku Siswa/Buku Guru
            $table->string('publisher')->default('Kemendikbud')->after('book_type'); // Penerbit
            $table->year('curriculum_year')->nullable()->after('publisher'); // Tahun kurikulum
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'subject',
                'grade_level', 
                'semester',
                'curriculum_type',
                'book_type',
                'publisher',
                'curriculum_year'
            ]);
        });
    }
};
