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
            $table->enum('condition', ['baik', 'rusak'])->default('baik')->after('stock');
            $table->integer('damaged_count')->default(0)->after('condition')->comment('Jumlah buku rusak');
            $table->text('damage_notes')->nullable()->after('damaged_count')->comment('Catatan kerusakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['condition', 'damaged_count', 'damage_notes']);
        });
    }
};
