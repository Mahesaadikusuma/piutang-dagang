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
        Schema::create('piutangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('cicilan');
            $table->date('awal_tempo');
            $table->date('akhir_jatuh_tempo');
            $table->unsignedBigInteger('jumlah_piutang');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piutangs');
    }
};
