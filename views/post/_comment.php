<?php

use yii\helpers\Html;

/**
 * @var \asdfstudio\blog\models\Comment $model
 */
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="media">
            <div class="media-body">
                <h5 class="media-heading">
                    <span class="pull-left">
                        <?php echo Yii::t('blog', 'Posted on {date, date} {date, time}', [
                            'date' => $model->created_at,
                        ])?>
                        <?php echo Yii::t('blog', 'by {owner}', [
                            'owner' => $model->owner->username,
                        ])?>
                    </span>
                    <?php echo Html::a(null, null, [
                        'name' => 'comment-' . $model->id,
                    ])?>
                    <?php echo Html::a('#' . $model->id, [
                        'post/view',
                        'id' => $model->post->slug,
                        '#' => 'comment-' . $model->id,
                    ], [
                        'class' => 'pull-right'
                    ])?>
                </h5>
                <br/>
                <p>
                    <?php echo $model->comment?>
                </p>
            </div>
        </div>
    </div>
</div>