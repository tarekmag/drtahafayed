<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('social_profiles', function (Blueprint $table) {
            $table->string('clinido', 500)->nullable()->after('vezeeta');
        });

        DB::table('social_profiles')->whereNull('clinido')->update([
            'clinido' => 'https://clinido.com/ar/drprofile/91818/7120',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_profiles', function (Blueprint $table) {
            $table->dropColumn('clinido');
        });
    }
};
