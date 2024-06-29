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
        Schema::create('transaksi_biaya_permohonan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('layanan_permohonan_id')->unsigned();
            $table->bigInteger('ppat_id')->unsigned();
            $table->enum('status', ['lunas', 'belum_lunas']);
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
        Schema::dropIfExists('transaksi_biaya_permohonan');
    }
};
