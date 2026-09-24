<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('label')->nullable();
            $table->timestamps();
        });
        DB::table('settings')->insert([
            ['key' => 'denda_per_hari', 'value' => '2000', 'label' => 'Tarif denda per hari (Rp)', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'maks_hari_pinjam', 'value' => '14', 'label' => 'Maksimal hari pinjam', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'maks_buku_aktif', 'value' => '3', 'label' => 'Maksimal buku aktif per anggota', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'nama_perpus', 'value' => 'Perpustakaan Digital SDN 1 Kalidadap', 'label' => 'Nama perpustakaan', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    public function down(): void { Schema::dropIfExists('settings'); }
};
