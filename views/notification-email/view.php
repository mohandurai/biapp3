<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationEmail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notification Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-email-view">

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
            'module',
            'emp_id',
            'email:email',
            'cc:ntext',
            'subject',
            'text',
            'sch_date',
            'delivery_status',
            'delivery_time',
            'created_date',
            'created_by',
            'modified_date',
            'status',
        ],
    ]) ?>

</div>
