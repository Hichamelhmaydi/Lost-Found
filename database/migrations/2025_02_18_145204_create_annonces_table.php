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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre',20);
            $table->string('description',1000);
            $table->string('lieu',20);
            $table->dateTime('date_trouv_perte');
            $table->binary('image');
            $table->string('email',40);
            $table->string('phone',40);
            $table->enum('status',['en attend','trouve','recupere'])->default('recupere');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
