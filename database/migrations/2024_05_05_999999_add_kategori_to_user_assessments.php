<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('skor');
        });
    }

    public function down(): void
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
}; 