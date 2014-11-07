<?php

use yii\db\Schema;
use yii\db\Migration;

class m141107_230213_create_blog_category_table extends Migration
{
    public function up()
    {
        $this->createTable('blog_category', [
            'id' => 'pk',
            'parent_id' => Schema::TYPE_INTEGER,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('blog_category');
    }
}
