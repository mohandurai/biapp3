<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAllocation */

$this->title = 'Update Menu Allocation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Menu Allocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="menu-allocation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
