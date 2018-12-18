<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MobileDeviceManagement */

$this->title = 'Update Mobile Device Management: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Device Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mobile-device-management-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
