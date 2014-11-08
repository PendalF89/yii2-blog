<?php

use yii\db\Schema;
use yii\db\Migration;

class m141108_111436_add_blog_post_ref_type_fk extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'blog_post_ref_type', 'blog_post', 'type_id', 'blog_type', 'id', 'RESTRICT', 'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropForeignKey('blog_post_ref_type', 'blog_post');
    }
}
