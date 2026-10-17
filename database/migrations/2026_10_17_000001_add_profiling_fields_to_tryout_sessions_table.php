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
        Schema::table('tryout_sessions', function (Blueprint $table) {
            if (!Schema::hasColumn('tryout_sessions', 'category_scores')) {
                $table->json('category_scores')->nullable()->after('total_score');
            }
            if (!Schema::hasColumn('tryout_sessions', 'competency_levels')) {
                $table->json('competency_levels')->nullable()->after('category_scores');
            }
            if (!Schema::hasColumn('tryout_sessions', 'talent_quadrant')) {
                $table->string('talent_quadrant')->default('Box 5 (Penampil Tangguh / Solid Performer)')->after('competency_levels');
            }
            if (!Schema::hasColumn('tryout_sessions', 'career_recommendation')) {
                $table->string('career_recommendation')->nullable()->after('talent_quadrant');
            }
            if (!Schema::hasColumn('tryout_sessions', 'career_breakdown')) {
                $table->json('career_breakdown')->nullable()->after('career_recommendation');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tryout_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'category_scores',
                'competency_levels',
                'talent_quadrant',
                'career_recommendation',
                'career_breakdown',
            ]);
        });
    }
};
