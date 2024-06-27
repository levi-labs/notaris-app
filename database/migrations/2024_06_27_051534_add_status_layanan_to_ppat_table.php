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
        Schema::table('ppat', function (Blueprint $table) {
            $table->string('status_layanan')->after('layanan_permohonan_id')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppat', function (Blueprint $table) {
            $table->dropColumn('status_layanan');
        });
    }
};
