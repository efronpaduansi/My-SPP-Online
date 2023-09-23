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
        Schema::table('siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('kk_id')->after('nis');
            $table->unsignedBigInteger('level_id')->after('kk_id');
            $table->unsignedBigInteger('class_id')->after('level_id');

            //relasi ke tabel kartu_keluarga
            $table->foreign('kk_id')->references('id')->on('kartu_keluarga')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            //relasi ke tabel level 
            $table->foreign('level_id')->references('id')->on('level_siswa')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
            //relasi ke tabel kelas
            $table->foreign('class_id')->references('id')->on('kelas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('kk_id');
            $table->dropForeign('kk_id');

            $table->dropColumn('level_id');
            $table->dropForeign('level_id');

            $table->dropColumn('class_id');
            $table->dropForeign('class_id');
        });
    }
};
