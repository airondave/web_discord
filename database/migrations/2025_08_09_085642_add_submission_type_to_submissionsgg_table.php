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
            $table->string('submission_type')->default('regular')->after('desired_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissionsgg', function (Blueprint $table) {
            $table->dropColumn('submission_type');
        });
    }
};
