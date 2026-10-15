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
        if (! Schema::hasTable('patient_reviews') || Schema::hasColumn('patient_reviews', 'source')) {
            return;
        }

        Schema::table('patient_reviews', function (Blueprint $table) {
            $table->string('source', 20)->default('website')->after('locale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_reviews', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
