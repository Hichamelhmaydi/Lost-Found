<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 20);
            $table->text('description');
            $table->string('lieu', 20);
            $table->binary('photo');
            $table->string('email', 40);
            $table->string('tele', 40);
            $table->enum('status', ['en attend', 'trouve', 'perdu'])->default('en attend');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('annonces');
    }
};
