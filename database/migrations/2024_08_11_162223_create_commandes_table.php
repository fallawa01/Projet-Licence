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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('burger_id')->constrained()->onDelete('cascade');
            $table->enum('etat', ['en_cours', 'terminee', 'payee', 'annulee'])->default('en_cours');
            $table->decimal('montant', 8, 2)->nullable();
            $table->integer('quantite');
            $table->timestamp('date_commande');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
