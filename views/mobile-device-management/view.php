<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MobileDeviceManagement */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Device Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-device-management-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? //= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? /*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'username',
            'device_key:ntext',
            'status',
            'created_by',
            'created_date',
            'modified_by',
            'modified_date',
            'imei_no',
            'delivered_status',
        ],
    ]) ?>

</div>
