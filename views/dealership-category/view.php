<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DealershipCategory */

$this->title = $model->category_id;
$this->params['breadcrumbs'][] = ['label' => 'Dealership Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealership-category-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->category_id], [
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
           // 'category_id',
            'Category_name',
        ],
    ]) ?>

</div>
