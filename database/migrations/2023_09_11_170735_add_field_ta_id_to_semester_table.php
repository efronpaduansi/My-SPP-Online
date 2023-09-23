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
        Schema::table('semester', function (Blueprint $table) {
            $table->unsignedBigInteger('ta_id')->after('id');

            //relasi ke tabel tahun_ajaran
            $table->foreign('ta_id')->references('id')->on('tahun_ajaran')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('semester', function (Blueprint $table) {
            $table->dropColumn('ta_id');
            $table->dropForeign('ta_id');
        });
    }
};
