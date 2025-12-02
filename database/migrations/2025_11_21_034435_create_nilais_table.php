<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id'); 
            $table->unsignedBigInteger('guru_id');  
            $table->string('mapel');               
            $table->integer('nilai');              
            $table->text('keterangan')->nullable(); 
            $table->timestamps();

            // relasi
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }
};
