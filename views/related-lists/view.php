<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RelatedLists */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Related Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="related-lists-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'model_name',
            'first_table',
            'second_table',
            'first_table_key',
            'second_table_key',
            'display_columns',
            'query:ntext',
        ],
    ]) ?>

</div>
