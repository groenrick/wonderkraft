<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, convert existing content to JSON format
        $pages = DB::table('pages')->get();

        foreach ($pages as $page) {
            DB::table('pages')
                ->where('id', $page->id)
                ->update([
                    'content' => json_encode([
                        [
                            'type' => 'App\\ContentBlocks\\TitleParagraphBlock',
                            'data' => [
                                'title' => '',
                                'paragraph' => $page->content ?? ''
                            ]
                        ]
                    ])
                ]);
        }

        // Then change the column type
        Schema::table('pages', function (Blueprint $table) {
            $table->json('content')->nullable()->change();
        });
    }

    public function down()
    {
        // Convert JSON content back to text
        $pages = DB::table('pages')->get();

        foreach ($pages as $page) {
            $content = json_decode($page->content, true);
            $text = '';

            if (is_array($content) && !empty($content)) {
                // Get the paragraph from the first block
                $text = $content[0]['data']['paragraph'] ?? '';
            }

            DB::table('pages')
                ->where('id', $page->id)
                ->update(['content' => $text]);
        }

        Schema::table('pages', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
        });
    }
};
