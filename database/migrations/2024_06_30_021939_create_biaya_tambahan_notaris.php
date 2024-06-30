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
        Schema::create('biaya_tambahan_notaris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notaris_id')->unsigned()->nullable();
            $table->string('nama_biaya');
            $table->string('nominal');
            $table->enum('status', ['lunas', 'belum lunas']);
            $table->timestamps();
            $table->foreign('notaris_id')->references('id')->on('notaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_tambahan_notaris');
    }
};
