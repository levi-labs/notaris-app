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
        Schema::create('biaya_tambahan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ppat_id')->unsigned()->nullable();
            $table->string('nominal');
            $table->timestamps();
            $table->foreign('ppat_id')->references('id')->on('ppat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_tambahan');
    }
};
