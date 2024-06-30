<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsip_notaris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('layanan_permohonan_id')->unsigned();
            $table->bigInteger('notaris_id')->unsigned();
            $table->string('no_arsip');
            $table->string('no_akta');
            $table->string('file');
            $table->timestamps();

            $table->foreign('layanan_permohonan_id')->references('id')->on('layanan_permohonan')->onDelete('cascade');
            $table->foreign('notaris_id')->references('id')->on('notaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_notaris');
    }
};
