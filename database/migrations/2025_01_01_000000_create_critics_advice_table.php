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
        Schema::create('critics_advice', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name', 100);
            $table->string('sender_email', 100);
            $table->text('messages');
            $table->text('response')->nullable();
            $table->timestamp('send_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('critics_advice');
    }
}; 