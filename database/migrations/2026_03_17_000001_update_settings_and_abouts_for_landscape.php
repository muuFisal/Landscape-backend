<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'light_logo')) {
                $table->text('light_logo')->nullable()->after('logo');
            }

            if (! Schema::hasColumn('settings', 'dark_logo')) {
                $table->text('dark_logo')->nullable()->after('light_logo');
            }
        });

        Schema::table('abouts', function (Blueprint $table) {
            if (! Schema::hasColumn('abouts', 'about_badge')) {
                $table->json('about_badge')->nullable()->after('image');
            }
            if (! Schema::hasColumn('abouts', 'about_title')) {
                $table->json('about_title')->nullable()->after('about_badge');
            }
            if (! Schema::hasColumn('abouts', 'about_description')) {
                $table->longText('about_description')->nullable()->after('about_title');
            }
            if (! Schema::hasColumn('abouts', 'about_image')) {
                $table->string('about_image')->nullable()->after('about_description');
            }

            if (! Schema::hasColumn('abouts', 'mission_badge')) {
                $table->json('mission_badge')->nullable()->after('about_image');
            }
            if (! Schema::hasColumn('abouts', 'mission_title')) {
                $table->json('mission_title')->nullable()->after('mission_badge');
            }
            if (! Schema::hasColumn('abouts', 'mission_description')) {
                $table->longText('mission_description')->nullable()->after('mission_title');
            }
            if (! Schema::hasColumn('abouts', 'mission_image')) {
                $table->string('mission_image')->nullable()->after('mission_description');
            }

            if (! Schema::hasColumn('abouts', 'vision_badge')) {
                $table->json('vision_badge')->nullable()->after('mission_image');
            }
            if (! Schema::hasColumn('abouts', 'vision_title')) {
                $table->json('vision_title')->nullable()->after('vision_badge');
            }
            if (! Schema::hasColumn('abouts', 'vision_description')) {
                $table->longText('vision_description')->nullable()->after('vision_title');
            }
            if (! Schema::hasColumn('abouts', 'vision_image')) {
                $table->string('vision_image')->nullable()->after('vision_description');
            }

            if (! Schema::hasColumn('abouts', 'shapes_badge')) {
                $table->json('shapes_badge')->nullable()->after('vision_image');
            }
            if (! Schema::hasColumn('abouts', 'shapes_title')) {
                $table->json('shapes_title')->nullable()->after('shapes_badge');
            }
            if (! Schema::hasColumn('abouts', 'shapes_description')) {
                $table->longText('shapes_description')->nullable()->after('shapes_title');
            }
            if (! Schema::hasColumn('abouts', 'shapes_items')) {
                $table->json('shapes_items')->nullable()->after('shapes_description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach (['light_logo', 'dark_logo'] as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('abouts', function (Blueprint $table) {
            foreach ([
                'about_badge', 'about_title', 'about_description', 'about_image',
                'mission_badge', 'mission_title', 'mission_description', 'mission_image',
                'vision_badge', 'vision_title', 'vision_description', 'vision_image',
                'shapes_badge', 'shapes_title', 'shapes_description', 'shapes_items',
            ] as $column) {
                if (Schema::hasColumn('abouts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
