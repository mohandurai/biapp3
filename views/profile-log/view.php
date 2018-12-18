<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'json_query:ntext',
            'userid',
            'status',
            'created_date',
            'modified_date',
        ],
    ]) ?>

</div>