<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->dropColumn('page_id');
            $table->foreignId('site_id')->constrained()->onDelete('cascade');
            $table->boolean('is_primary')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->foreignId('page_id')->constrained();
            $table->dropForeignId('site_id');
            $table->dropColumn('is_primary');
        });
    }
};
