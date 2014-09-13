<?php


namespace asdfstudio\blog\admin;


use asdfstudio\admin\details\Detail;
use asdfstudio\admin\forms\widgets\Button;
use asdfstudio\admin\forms\widgets\Input;
use asdfstudio\admin\forms\widgets\Select;
use asdfstudio\admin\forms\widgets\Textarea;
use asdfstudio\admin\grids\Grid;
use asdfstudio\blog\admin\forms\PostForm;
use common\models\User;
use Yii;
use asdfstudio\admin\forms\Form;
use asdfstudio\admin\base\Entity;
use asdfstudio\blog\models\Post;
use yii\base\Model;

class PostEntity extends Entity
{
    /**
     * @inheritdoc
     */
    public static function attributes()
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
    public function labels()
    {
        return [Yii::t('blog', 'Post'), Yii::t('blog', 'Posts')];
    }

    /**
     * @inheritdoc
     */
    public function slug()
    {
        return 'blog_post';
    }

    public function model()
    {
        return Post::className();
    }

    /**
     * @inheritdoc
     */
    public function form($scenario = Model::SCENARIO_DEFAULT)
    {
        return [
            'class' => PostForm::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function grid()
    {
        return [
            'class' => Grid::className(),
            'columns' => [
                'id',
                'title',
                'slug',
                'content:raw',
                [
                    'attribute' => 'status',
                    'format' => ['list', [
                        Post::STATUS_DRAFT => Yii::t('blog', 'Draft'), Post::STATUS_PUBLISHED => Yii::t('blog', 'Published')
                    ]],
                ],
                [
                    'attribute' => 'owner',
                    'format' => ['model', ['labelAttribute' => 'username']],
                ],
                'published_at:date',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function detail()
    {
        return [
            'class' => Detail::className(),
            'attributes' => [
                'id',
                'title',
                'slug',
                'content:raw',
                [
                    'attribute' => 'status',
                    'format' => ['list', [
                        Post::STATUS_DRAFT => Yii::t('blog', 'Draft'), Post::STATUS_PUBLISHED => Yii::t('blog', 'Published')
                    ]],
                ],
                [
                    'attribute' => 'owner',
                    'format' => ['model', ['labelAttribute' => 'username']],
                ],
                'published_at:date',
            ],
        ];
    }
}
