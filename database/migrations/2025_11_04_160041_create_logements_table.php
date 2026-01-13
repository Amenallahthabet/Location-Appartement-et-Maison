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
        Schema::create('logements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->integer('nb_chambres')->default(1);
            $table->json('photos')->nullable(); 
            $table->decimal('prix', 10, 2)->default(0); 

            $table->unsignedBigInteger('locateur_id'); 
            $table->foreign('locateur_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logements');
    }
};
