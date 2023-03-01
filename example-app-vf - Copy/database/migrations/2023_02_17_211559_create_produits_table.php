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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('id_cat')->unsigned()->default(0);
            $table->foreign('id_cat')->references('id')->on('produit_cats');
            $table->bigInteger('id_compte')->unsigned()->default(0);
            $table->foreign('id_compte')->references('id')->on('comptes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
