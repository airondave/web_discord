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
        Schema::table('submissionsgg', function (Blueprint $table) {
            // Check if columns exist before adding them
            if (!Schema::hasColumn('submissionsgg', 'discord_id')) {
                $table->string('discord_id')->after('discord_username');
            }
            if (!Schema::hasColumn('submissionsgg', 'proof_url')) {
                $table->string('proof_url')->nullable()->after('discord_id');
            }
            if (!Schema::hasColumn('submissionsgg', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('proof_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissionsgg', function (Blueprint $table) {
            $table->dropColumn(['discord_id', 'proof_url', 'status']);
        });
    }
};
