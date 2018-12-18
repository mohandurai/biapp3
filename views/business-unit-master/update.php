<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessUnitMaster */

$this->title = 'Update Business Unit Master: ' . ' ' . $model->bunit_id;
$this->params['breadcrumbs'][] = ['label' => 'Business Unit Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bunit_id, 'url' => ['view', 'id' => $model->bunit_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-unit-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
