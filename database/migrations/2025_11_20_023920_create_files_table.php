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
    Schema::create('files', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('kategori'); // materi / tugas / umum
        $table->string('file_path');
        $table->unsignedBigInteger('uploaded_by'); // user id
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
