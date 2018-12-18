<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MobileIcons */

$this->title = $model->icon_id;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-icons-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->icon_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->icon_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'icon_id',
            'module',
            'img_path:ntext',
        ],
    ]) ?>

    <img src="<?=$model->img_path?>"/>


</div>
