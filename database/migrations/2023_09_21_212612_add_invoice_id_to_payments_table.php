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
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->after('id');
            // $table->unsignedBigInteger('created_by')->after('date')->nullable();

              //relasi ke tabel invoice
              $table->foreign('invoice_id')->references('id')->on('invoices')
              ->onUpdate('cascade')
              ->onDelete('cascade');

              //relasi ke tabel users
            //   $table->foreign('created_by')->references('id')->on('users')
            //   ->onUpdate('cascade')
            //   ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('invoice_id');
            $table->dropForeign('invoice_id');

            // $table->dropColumn('created_by');
            // $table->dropForeign('created_by');
        });
    }
};
