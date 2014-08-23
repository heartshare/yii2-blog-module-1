<?php


namespace asdfstudio\blog\controllers;


use asdfstudio\blog\base\Controller;
use asdfstudio\blog\models\Post;
use yii\data\ActiveDataProvider;
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

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        return $this->render('view', [
            'model' => $model,
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
