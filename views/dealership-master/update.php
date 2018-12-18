<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DealershipMaster */

$this->title = 'Update Dealership Master: ' . ' ' . $model->dealership_id;
$this->params['breadcrumbs'][] = ['label' => 'Dealership Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dealership_id, 'url' => ['view', 'id' => $model->dealership_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dealership-master-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
