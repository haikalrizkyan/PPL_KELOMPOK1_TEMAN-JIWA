<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaldoToUsersTable extends Migration
{
    /**
     * Menjalankan migrasi untuk menambahkan kolom saldo ke tabel users.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('saldo', 10, 2)->default(0); // Menambahkan kolom saldo dengan default 0
        });
    }

    /**
     * Membalikkan migrasi (rollback) dan menghapus kolom saldo dari tabel users.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }
}
