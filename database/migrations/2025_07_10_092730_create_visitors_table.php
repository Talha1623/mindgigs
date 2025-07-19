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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('contact');
            $table->string('email')->nullable();
            $table->string('source');
            $table->string('purpose')->nullable(); // optional: more detail
            $table->string('person_to_meet')->nullable(); // optional
            $table->unsignedBigInteger('added_by'); // NEW: who added this            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
