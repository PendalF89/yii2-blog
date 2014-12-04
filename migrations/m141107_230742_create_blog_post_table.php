<?php

use yii\db\Schema;
use yii\db\Migration;

class m141107_230742_create_blog_post_table extends Migration
{
    public function up()
    {
        $this->createTable('blog_post', [
            'id' => 'pk',
            'category_id' => Schema::TYPE_INTEGER,
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'title_seo' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'meta_description' => Schema::TYPE_TEXT,
            'preview' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'publish_status' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('blog_post');
    }
}
