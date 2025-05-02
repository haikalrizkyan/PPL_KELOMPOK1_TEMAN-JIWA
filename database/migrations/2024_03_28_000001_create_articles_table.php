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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->text('konten');
            $table->string('gambar')->nullable();
            $table->enum('status', ['draft', 'diterbitkan'])->default('draft');
            $table->enum('kategori', ['kesehatan_mental', 'perawatan_diri', 'hubungan', 'manajemen_stres', 'kecemasan', 'depresi'])->default('kesehatan_mental');
            $table->timestamp('tanggal_terbit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
}; 