<?php

use yii\db\Schema;
use yii\db\Migration;

class m140901_053245_blog_post_comment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_post_comment}}', [
            'id' => Schema::TYPE_PK,
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'comment_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('u_post_id_comment_id', '{{%blog_post_comment}}', ['post_id', 'comment_id'], true);
        $this->createIndex('i_post_id', '{{%blog_post_comment}}', ['post_id'], false);
    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_post_comment}}');
    }
}
