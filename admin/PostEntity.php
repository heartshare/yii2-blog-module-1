<?php


namespace asdfstudio\blog\admin;


use asdfstudio\admin\forms\widgets\Button;
use asdfstudio\admin\forms\widgets\Input;
use asdfstudio\admin\forms\widgets\Select;
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
    public function form($scenario = Model::SCENARIO_DEFAULT)
    {
        return [
            'class' => Form::className(),
            'renderSaveButton' => false,
            'fields' => [
                [
                    'wrapper' => '<div class="col-md-8">{items}</div>',
                    'items' => [
                        [
                            'class' => Input::className(),
                            'attribute' => 'title',
                        ],
                        [
                            'class' => Input::className(),
                            'attribute' => 'slug',
                        ],
                        [
                            'class' => Select::className(),
                            'attribute' => 'status',
                            'items' => [
                                Post::STATUS_DRAFT => Yii::t('blog', 'Draft'), Post::STATUS_PUBLISHED => Yii::t('blog', 'Published')
                            ],
                        ],
                        [
                            'class' => Select::className(),
                            'attribute' => 'owner',
                            'labelAttribute' => 'username',
                            'query' => User::find()->indexBy('id'),
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
