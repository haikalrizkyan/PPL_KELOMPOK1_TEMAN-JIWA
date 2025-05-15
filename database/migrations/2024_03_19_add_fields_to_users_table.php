<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nama');
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('foto_profil')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nama', 'name');
            $table->dropColumn([
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'nomor_telepon',
                'foto_profil',
                'status'
            ]);
        });
    }
}; 