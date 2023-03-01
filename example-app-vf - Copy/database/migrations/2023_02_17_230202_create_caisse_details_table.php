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
        Schema::create('caisse_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('id_caisse');
            $table->foreign('id_caisse')->references('id')->on('caisses');
            $table->integer('n_200')->default(0);
            $table->integer('n_100')->default(0);
            $table->integer('n_50')->default(0);
            $table->integer('n_20')->default(0);
            $table->integer('n_10')->default(0);
            $table->integer('n_5')->default(0);
            $table->integer('n_2')->default(0);
            $table->integer('n_1')->default(0);
            $table->integer('n_05')->default(0);
            $table->integer('n_04')->default(0);
            $table->integer('n_02')->default(0);
            $table->decimal('sold_total', 12, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisse_details');
    }
};
