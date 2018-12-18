<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FunctionMaster */

$this->title = 'Update Function Master: ' . ' ' . $model->function_id;
$this->params['breadcrumbs'][] = ['label' => 'Function Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->function_id, 'url' => ['view', 'id' => $model->function_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="function-master-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
