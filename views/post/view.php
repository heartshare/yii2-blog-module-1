<?php
use yii\helpers\Html;
use asdfstudio\block\Block;

/**
 * @var \asdfstudio\blog\models\Post $model
 * @var \yii\web\View $this
 */
?>

<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <?php echo $this->render('_post', [
            'model' => $model,
        ])?>

        <hr>

        <!-- Blog Footer -->
        <?php echo Block::show('blog.post.footer')?>

    </div>
    <div class="col-md-4">
        <?php echo Block::show('blog.sidebar')?>
    </div>
 </div>