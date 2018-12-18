<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CityMaster */

$this->title = 'Update City Master: ' . ' ' . $model->city_id;
$this->params['breadcrumbs'][] = ['label' => 'City Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->city_id, 'url' => ['view', 'id' => $model->city_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
