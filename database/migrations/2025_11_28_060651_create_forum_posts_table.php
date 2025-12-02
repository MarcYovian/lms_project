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
    Schema::create('forum_posts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // pengirim (guru/siswa)
        $table->string('judul');
        $table->text('konten');
        $table->string('lampiran')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_posts');
    }
};
