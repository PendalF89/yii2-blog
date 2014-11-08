<?php

use yii\db\Schema;
use yii\db\Migration;

class m141108_110957_create_blog_type_table extends Migration
{
    public function up()
    {
        $this->createTable('blog_type', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('blog_type');
    }
}
