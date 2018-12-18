<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MobileDeviceManagement */

$this->title = 'Create Mobile Device Management';
$this->params['breadcrumbs'][] = ['label' => 'Mobile Device Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-device-management-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
