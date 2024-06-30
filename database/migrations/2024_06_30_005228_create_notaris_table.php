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
        Schema::create('notaris', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pengajuan');
            $table->bigInteger('layanan_permohonan_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nama_pihak_pertama');
            $table->string('nama_pihak_kedua');
            $table->text('alamat_asset_termohon');
            $table->string('status_layanan');
            $table->string('file_notaris');
            $table->timestamps();

            $table->foreign('layanan_permohonan_id')->references('id')->on('layanan_permohonan')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notaris');
    }
};
