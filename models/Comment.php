<?php


namespace asdfstudio\blog\models;


/**
 * Class Comment
 * @package asdfstudio\blog\models
 * @property Post $post
 */
class Comment extends \asdfstudio\plugins\comments\models\Comment
{
    public function init()
    {
        parent::init();
        $this->type = 'blog';
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return parent::find()->where(['type' => 'blog']);
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id'])
            ->viaTable('blog_post_comment', ['comment_id' => 'id']);
    }
}
