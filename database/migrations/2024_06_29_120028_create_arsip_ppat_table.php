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
        Schema::create('arsip_ppat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('layanan_permohonan_id')->unsigned();
            $table->bigInteger('ppat_id')->unsigned();
            $table->string('no_arsip');
            $table->string('no_akta');
            $table->string('file');

            $table->timestamps();

            $table->foreign('layanan_permohonan_id')->references('id')->on('layanan_permohonan')->onDelete('cascade');
            $table->foreign('ppat_id')->references('id')->on('ppat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_ppat');
    }
};
