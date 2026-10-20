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
        Schema::table('page_views', function (Blueprint $table) {
            $table->uuid('visitor_id')->nullable()->after('session_id');
            $table->date('visited_on')->nullable()->after('visitor_id');
            $table->index(['visitor_id', 'visited_on', 'page']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_views', function (Blueprint $table) {
            $table->dropIndex(['visitor_id', 'visited_on', 'page']);
            $table->dropColumn(['visitor_id', 'visited_on']);
        });
    }
};
