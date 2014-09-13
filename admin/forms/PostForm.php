<?php


namespace asdfstudio\blog\admin\forms;


use asdfstudio\admin\forms\widgets\Input;
use asdfstudio\admin\forms\widgets\Select;
use asdfstudio\admin\forms\widgets\Textarea;
use Yii;
use asdfstudio\admin\forms\Form;
use asdfstudio\admin\forms\widgets\Button;
use asdfstudio\blog\models\Post;
use yii\db\ActiveRecord;

class PostForm extends Form
{
    /**
     * @inheritdoc
     */
    public function fields()
    {
        /* @var ActiveRecord $userClass */
        $userClass = $this->model->getRelation('owner')->modelClass;

        return [
            'title' => [
                'class' => Input::className(),
            ],
            'content' => [
                'class' => Textarea::className(),
            ],
            'slug' => [
                'class' => Input::className(),
            ],
            'status' => [
                'class' => Select::className(),
                'items' => [
                    Post::STATUS_DRAFT => Yii::t('blog', 'Draft'), Post::STATUS_PUBLISHED => Yii::t('blog', 'Published')
                ],
            ],
            'owner' => [
                'class' => Select::className(),
                'labelAttribute' => 'username',
                'query' => $userClass::find()->indexBy('id'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array_merge(parent::actions(), [
            'publish' => [
                'class' => Button::className(),
                'label' => Yii::t('blog', 'Publish'),
                'options' => [
                    'class' => 'btn btn-success'
                ],
                'action' => 'publish',
            ],
        ]);
    }

    /**
     * @param Post $model
     * @return Post
     */
    public function actionPublish($model)
    {
        return $model->publish();
    }
}
