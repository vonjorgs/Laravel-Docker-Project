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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->uuid('external_id')->unique();
            $table->string('name')->nullable();
            $table->text('kpi')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->string('payout_currency')->nullable();
            $table->string('creatives_url')->nullable();
            $table->string('preview_url')->nullable();
            $table->string('click_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
