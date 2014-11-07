<?php

use yii\db\Schema;
use yii\db\Migration;

class m141107_232305_add_blog_post_ref_category_fk extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'blog_post_ref_category', 'blog_post', 'category_id', 'blog_category', 'id', 'RESTRICT', 'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropForeignKey('blog_post_ref_category', 'blog_post');
    }
}
