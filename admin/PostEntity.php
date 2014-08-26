<?php


namespace asdfstudio\blog\admin;


use asdfstudio\admin\forms\widgets\Button;
use Yii;
use asdfstudio\admin\forms\Form;
use asdfstudio\admin\base\Entity;
use asdfstudio\blog\models\Post;
use yii\base\Model;
use yii\bootstrap\ActiveField;

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
    public static function labels()
    {
        return [Yii::t('blog', 'Post'), Yii::t('blog', 'Posts')];
    }

    /**
     * @inheritdoc
     */
    public static function slug()
    {
        return 'blog_post';
    }

    public static function model()
    {
        return Post::className();
    }

    /**
     * @inheritdoc
     */
    public static function form($scenario = Model::SCENARIO_DEFAULT)
    {
        return [
            'class' => Form::className(),
            'renderSaveButton' => false,
            'fields' => [
                [
                    'wrapper' => '<div class="col-md-8">{items}</div>',
                    'items' => [
                        [
                            'class' => ActiveField::className(),
                            'attribute' => 'title',
                        ],
                        [
                            'class' => ActiveField::className(),
                            'attribute' => 'slug',
                        ],
                        [
                            'class' => ActiveField::className(),
                            'attribute' => 'status',
                        ],
                        [
                            'class' => ActiveField::className(),
                            'attribute' => 'owner',
                        ],
                    ]
                ],
                [
                    'wrapper' => '<div class="col-md-4">{items}</div>',
                    'items' => [
                        [
                            'id' => 'publish',
                            'class' => Button::className(),
                            'label' => Yii::t('blog', 'Publish'),
                            'options' => [
                                'class' => 'btn btn-success'
                            ],
                            'action' => function($model) {
                                /* @var Post $model */
                                $model->publish();
                            },
                        ],
                    ],
                ],
            ],
        ];
    }
}
