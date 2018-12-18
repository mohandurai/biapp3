<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationEmail */

$this->title = 'Update Notification Email: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notification Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notification-email-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
