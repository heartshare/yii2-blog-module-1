<?php


namespace asdfstudio\blog\controllers;


use Yii;
use asdfstudio\blog\base\Controller;
use asdfstudio\blog\models\Comment;
use asdfstudio\blog\models\Post;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
    public function actionIndex()
    {
        $query = Post::find();

        $postsProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [

            ]
        ]);

        return $this->render('index', [
            'postsProvider' => $postsProvider,
        ]);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view'],
                'rules' => [
                    [
                        'allow' => false,
                        'verbs' => ['POST'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'verbs' => ['GET'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $comment = new Comment();
        if (Yii::$app->getRequest()->getIsPost()) {
            $comment->load(Yii::$app->getRequest()->getBodyParams());
            $comment->owner_id = Yii::$app->user->id;

            if ($comment->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                $comment->save();
                $model->link('comments', $comment);
                $transaction->commit();
            }
        }

        $commentsProvider = new ActiveDataProvider([
            'query' => $model->getComments()->with('owner')->orderBy(['created_at' => SORT_DESC]),
            'pagination' => false,
        ]);

        return $this->render('view', [
            'model' => $model,
            'comment' => $comment,
            'commentsProvider' => $commentsProvider
        ]);
    }

    /**
     * @param $slug
     * @return Post
     * @throws \yii\web\NotFoundHttpException
     */
    public function loadModel($slug)
    {
        $model = Post::findOneBySlug($slug);
        if ($model === null) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}
