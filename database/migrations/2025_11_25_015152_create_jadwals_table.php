<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->string('mapel');
        $table->string('guru');
        $table->string('kelas'); // contoh: X IPA 1
        $table->string('hari');  // Senin / Selasa / dst
        $table->string('jam_mulai');
        $table->string('jam_selesai');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};
