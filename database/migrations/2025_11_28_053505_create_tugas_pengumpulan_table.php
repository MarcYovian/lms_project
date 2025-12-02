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
    Schema::create('tugas_pengumpulan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tugas_id');
        $table->unsignedBigInteger('siswa_id');

        $table->string('file_path')->nullable();
        $table->integer('nilai')->nullable();
        $table->text('catatan')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_pengumpulan');
    }
};
