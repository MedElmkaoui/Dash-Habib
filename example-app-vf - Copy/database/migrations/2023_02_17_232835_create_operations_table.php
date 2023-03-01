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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prod')->nullable();
            $table->foreign('id_prod')->references('id')->on('produits')->onDelete('set null');
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->foreign('id_cat')->references('id')->on('operation_cats')->onDelete('set null');
            $table->date('date');
            $table->decimal('montant');
            $table->decimal('cost')->nullable();
            $table->string('in_out');
            
            $table->unsignedBigInteger('id_ag')->nullable();
            $table->foreign('id_ag')->references('id')->on('agencies')->onDelete('set null');

            $table->text('note')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
