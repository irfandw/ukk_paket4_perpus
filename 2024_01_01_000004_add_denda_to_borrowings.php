<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->unsignedSmallInteger('lama_hari')->default(7)->after('due_date');
            $table->unsignedInteger('denda')->default(0)->after('status');
            $table->enum('status', ['dipinjam', 'menunggu_verifikasi', 'dikembalikan', 'terlambat'])
                ->default('dipinjam')->change();
        });

        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('tipe', ['pinjam', 'kembali', 'tambah', 'kurang'])->default('pinjam');
            $table->integer('jumlah')->default(1);
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn(['lama_hari', 'denda']);
        });
    }
};
