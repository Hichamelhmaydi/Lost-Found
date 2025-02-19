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
        Schema::table('commentaire', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->timestamp('date_de_commentaires')->useCurrent();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commentaire', function (Blueprint $table) {
            //
        });
    }
};
