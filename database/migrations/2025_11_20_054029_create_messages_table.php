<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->unsignedBigInteger('user_id');
            $table->text('message'); // ← biasanya namanya 'message', bukan 'pesan'
            $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
