<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DealershipCategory */

$this->title = 'Update Dealership Category: ' . ' ' . $model->category_id;
$this->params['breadcrumbs'][] = ['label' => 'Dealership Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_id, 'url' => ['view', 'id' => $model->category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dealership-category-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
