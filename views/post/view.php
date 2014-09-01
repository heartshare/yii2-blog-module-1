<?php
use yii\bootstrap\ActiveForm;
use asdfstudio\block\Block;
use yii\widgets\ListView;

/**
 * @var \asdfstudio\blog\models\Post $model
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $commentsProvider
 * @var \asdfstudio\blog\models\Comment $comment
 */
?>

<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <?php echo $this->render('_post', [
            'model' => $model,
            'comment' => $comment,
        ])?>

        <hr>

        <!-- Blog Footer -->
        <?php echo Block::show('blog.post.footer')?>

        <h3><?php echo Yii::t('blog', 'Comments')?></h3>
        <?php echo ListView::widget([
            'dataProvider' => $commentsProvider,
            'summary' => '',
            'itemView' => '_comment',
        ])?>
        <?php if (!Yii::$app->user->isGuest):?>
        <hr/>
        <div class="blog-post-comment-form">
            <?php $form = ActiveForm::begin()?>
                <?php echo $form->field($comment, 'comment')->textarea([
                    'rows' => 6,
                ])?>
                <?php echo \yii\helpers\Html::submitButton(Yii::t('blog', 'Submit'), [
                'class' => 'btn btn-lg btn-success',
            ])?>
            <?php ActiveForm::end()?>
        </div>
        <?php endif?>
    </div>
    <div class="col-md-4">
        <?php echo Block::show('blog.sidebar')?>
    </div>
 </div>