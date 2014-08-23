<?php


namespace asdfstudio\blog\admin;


use Yii;
use asdfstudio\admin\AdminItemInterface;
use asdfstudio\blog\models\Post;

class PostItem extends Post implements AdminItemInterface
{
    /**
     * @inheritdoc
     */
    public static function adminAttributes()
    {
        return [
            'title',
            'slug',
            'content:html',
            [
                'attribute' => 'owner',
                'format' => ['model', ['labelAttribute' => 'username']],
            ],
            [
                'attribute' => 'status',
                'format' => ['list', [
                    Post::STATUS_DRAFT => Yii::t('blog', 'Draft'), Post::STATUS_PUBLISHED => Yii::t('blog', 'Published')
                ]],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function adminLabels()
    {
        return [Yii::t('blog', 'Post'), Yii::t('blog', 'Posts')];
    }

    /**
     * @inheritdoc
     */
    public static function adminSlug()
    {
        return 'blog_post';
    }
}
