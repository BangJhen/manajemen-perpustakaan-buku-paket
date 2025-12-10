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
        Schema::create('book_damages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->string('damage_type'); // Jenis kerusakan: Robek, Hilang Halaman, Coretan, dll
            $table->enum('severity', ['ringan', 'sedang', 'berat']); // Tingkat kerusakan
            $table->text('description'); // Deskripsi detail kerusakan
            $table->string('location')->nullable(); // Lokasi kerusakan (halaman berapa, bagian mana)
            $table->date('damage_date'); // Tanggal ditemukan kerusakan
            $table->string('reported_by')->nullable(); // Dilaporkan oleh siapa
            $table->enum('status', ['rusak', 'diperbaiki', 'tidak_dapat_diperbaiki'])->default('rusak');
            $table->text('repair_notes')->nullable(); // Catatan perbaikan
            $table->date('repair_date')->nullable(); // Tanggal diperbaiki
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_damages');
    }
};
