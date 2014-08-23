<?php
use yii\widgets\ListView;
use asdfstudio\block\Block;

/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $postsProvider
 */

$this->title = Yii::t('blog', 'Blog');
?>

<div class="row">
    <div class="col-md-8">
        <?php echo ListView::widget([
            'dataProvider' => $postsProvider,
            'summary' => '',
            'itemView' => '_post',
        ])?>
    </div>
    <div class="col-md-4">
        <?php echo Block::show('blog.sidebar')?>
    </div>
</div>