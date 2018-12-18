<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeographyMaster */

$this->title = 'Update Geography Master: ' . ' ' . $model->geo_id;
$this->params['breadcrumbs'][] = ['label' => 'Geography Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->geo_id, 'url' => ['view', 'id' => $model->geo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="geography-master-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
