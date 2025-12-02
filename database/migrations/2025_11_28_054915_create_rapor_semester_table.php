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
    Schema::create('rapor_semester', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('siswa_id');
        $table->string('semester');
        $table->string('mapel');
        $table->integer('nilai_tugas')->nullable();
        $table->integer('nilai_uts')->nullable();
        $table->integer('nilai_uas')->nullable();
        $table->integer('nilai_akhir')->nullable();
        $table->text('catatan')->nullable();
        $table->unsignedBigInteger('guru_id');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapor_semester');
    }
};
