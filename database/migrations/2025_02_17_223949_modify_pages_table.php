<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('site_id')->constrained()->onDelete('cascade');
            $table->boolean('is_homepage')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeignId('site_id');
            $table->dropColumn(['is_homepage', 'slug']);
        });
    }
};
