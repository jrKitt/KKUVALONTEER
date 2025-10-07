<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('activities')
            ->whereNull('tags')
            ->orWhere('tags', '=', '')
            ->update(['tags' => json_encode([])]);

        DB::table('activities')
            ->where('tags', 'NOT LIKE', '[%')
            ->where('tags', '!=', '')
            ->whereNotNull('tags')
            ->get()
            ->each(function ($activity) {
                if (!empty($activity->tags) && !str_starts_with($activity->tags, '[')) {
                    // Convert string to array (assuming comma-separated)
                    $tagsArray = array_map('trim', explode(',', $activity->tags));
                    DB::table('activities')
                        ->where('id', $activity->id)
                        ->update(['tags' => json_encode($tagsArray)]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('activities')
            ->whereNotNull('tags')
            ->get()
            ->each(function ($activity) {
                $tags = json_decode($activity->tags, true);
                if (is_array($tags)) {
                    DB::table('activities')
                        ->where('id', $activity->id)
                        ->update(['tags' => implode(',', $tags)]);
                }
            });
    }
};
