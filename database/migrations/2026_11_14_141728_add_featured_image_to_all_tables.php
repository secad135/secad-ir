<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['projects', 'notes', 'posts'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('featured_image')->nullable()->after('title');
            });
        }
    }

    public function down(): void
    {
        foreach (['projects', 'notes', 'posts'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('featured_image');
            });
        }
    }
};