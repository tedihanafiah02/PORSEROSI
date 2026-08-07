<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // article_news: add title_en, content_en
        Schema::table('article_news', function (Blueprint $table) {
            if (!Schema::hasColumn('article_news', 'title_en')) {
                $table->string('title_en')->nullable()->after('name');
            }
            if (!Schema::hasColumn('article_news', 'title_id')) {
                $table->string('title_id')->nullable()->after('title_en');
            }
            if (!Schema::hasColumn('article_news', 'content_en')) {
                $table->longText('content_en')->nullable()->after('content');
            }
            if (!Schema::hasColumn('article_news', 'content_id')) {
                $table->longText('content_id')->nullable()->after('content_en');
            }
        });

        // categories: add name_en
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'name_en')) {
                $table->string('name_en')->nullable()->after('name');
            }
        });

        // event_registrations: add title_en, short_description_en
        Schema::table('event_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('event_registrations', 'title_en')) {
                $table->string('title_en')->nullable()->after('title');
            }
            if (!Schema::hasColumn('event_registrations', 'title_id')) {
                $table->string('title_id')->nullable()->after('title_en');
            }
            if (!Schema::hasColumn('event_registrations', 'short_description_en')) {
                $table->text('short_description_en')->nullable()->after('short_description');
            }
            if (!Schema::hasColumn('event_registrations', 'short_description_id')) {
                $table->text('short_description_id')->nullable()->after('short_description_en');
            }
        });

        // panduans: add title_en, description_en
        Schema::table('panduans', function (Blueprint $table) {
            if (!Schema::hasColumn('panduans', 'title_en')) {
                $table->string('title_en')->nullable()->after('title');
            }
            if (!Schema::hasColumn('panduans', 'title_id')) {
                $table->string('title_id')->nullable()->after('title_en');
            }
            if (!Schema::hasColumn('panduans', 'description_en')) {
                $table->text('description_en')->nullable()->after('description');
            }
            if (!Schema::hasColumn('panduans', 'description_id')) {
                $table->text('description_id')->nullable()->after('description_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('article_news', function (Blueprint $table) {
            $table->dropColumnIfExists(['title_en', 'title_id', 'content_en', 'content_id']);
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumnIfExists(['name_en']);
        });
        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropColumnIfExists(['title_en', 'title_id', 'short_description_en', 'short_description_id']);
        });
        Schema::table('panduans', function (Blueprint $table) {
            $table->dropColumnIfExists(['title_en', 'title_id', 'description_en', 'description_id']);
        });
    }
};
