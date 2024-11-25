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
        Schema::create('burgers', function (Blueprint $table) {

            $table->id();
            $table->string('nom');
            $table->decimal('prix');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->enum('statut', ['actif', 'archivé'])->default('actif');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('burgers');
    }
};
