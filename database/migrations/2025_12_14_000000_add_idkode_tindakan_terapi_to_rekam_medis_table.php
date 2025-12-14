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
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->unsignedBigInteger('idkode_tindakan_terapi')->nullable()->after('dokter_pemeriksa');
            $table->foreign('idkode_tindakan_terapi')->references('idkode_tindakan_terapi')->on('kode_tindakan_terapi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekam_medis', function (Blueprint $table) {
            $table->dropForeign(['idkode_tindakan_terapi']);
            $table->dropColumn('idkode_tindakan_terapi');
        });
    }
};
