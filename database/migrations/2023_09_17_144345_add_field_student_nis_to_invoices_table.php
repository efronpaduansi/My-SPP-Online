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
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->after('id');
            $table->unsignedBigInteger('semester_id')->after('student_id');

              //relasi ke tabel siswa
              $table->foreign('student_id')->references('id')->on('siswa')
              ->onUpdate('cascade')
              ->onDelete('cascade');

              //relasi ke tabel semester
              $table->foreign('semester_id')->references('id')->on('semester')
              ->onUpdate('cascade')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('student_id');
            $table->dropForeign('student_id');

            $table->dropColumn('semester_id');
            $table->dropForeign('semester_id');
        });
    }
};
