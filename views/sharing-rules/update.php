<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SharingRules */

$this->title = 'Update Sharing Rules: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sharing Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sharing-rules-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
