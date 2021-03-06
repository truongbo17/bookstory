<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateSeoKeywordIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::dropIfExists('seo_keywords');
        Index::create('seo_keywords', function (Mapping $mapping, Settings $settings) {
            $mapping->integer('seo_keyword_id');
            $mapping->text('title');
            $mapping->text('slug');
            $mapping->integer('status');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::dropIfExists('seo_keywords');
    }
}
