<?php

use yii\helpers\Html;

/**
 * @var \asdfstudio\blog\models\Post $model
 */
?>

<div class="row">
    <div class="col-md-12 blog-post">
        <!-- Title -->
        <h1><?php echo Html::a($model->title, ['view', 'id' => $model->slug])?></h1>

        <!-- Author -->
        <p class="lead">
            <?php echo Yii::t('blog', 'by {owner}', [
                'owner' => Html::a($model->owner->username, ['view']),
            ])?>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>
            <span class="glyphicon glyphicon-time"></span>
            <?php echo Yii::t('blog', 'Posted on {date, date} {date, time}', [
                'date' => $model->published_at,
            ])?>
        </p>

        <hr>

        <!-- Post Content -->
        <div class="blog-post-content">
            <?php echo $model->content?>
        </div>
    </div>
</div>