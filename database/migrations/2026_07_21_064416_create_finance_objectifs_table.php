<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('finance_objectifs', function (Blueprint $table) {
            $table->id();
            $table->enum('periode', ['jour', 'mois', 'annee'])->unique();
            $table->decimal('montant', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_objectifs');
    }
};