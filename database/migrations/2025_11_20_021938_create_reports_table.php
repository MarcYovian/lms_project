<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->string('kategori'); // contoh: kegiatan, siswa, guru, keuangan, dsb.
        $table->string('lampiran')->nullable(); // file upload
        $table->unsignedBigInteger('dibuat_oleh'); // user id
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
