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
    Schema::create('forum_replies', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('forum_id');
        $table->unsignedBigInteger('user_id');
        $table->text('pesan');
        $table->string('lampiran')->nullable(); // reply attachment opsional
        $table->timestamps();

        $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_replies');
    }
};
