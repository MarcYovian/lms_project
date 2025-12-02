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
    Schema::create('forums', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('konten');
        $table->string('lampiran')->nullable(); // file opsional
        $table->unsignedBigInteger('user_id');  // pembuat topik
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
