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
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->unsignedBigInteger('id_ag')->nullable();
            $table->foreign('id_ag')->references('id')->on('agencies')->onDelete('cascade');
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->foreign('id_cat')->references('id')->on('charge_cats')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->date('date');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charges');
    }
};
