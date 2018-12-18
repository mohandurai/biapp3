<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CompetencyRecord */

$this->title = 'Update Competency Question: ' . ' ' . $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Competency Question', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recid, 'url' => ['view', 'id' => $model->recid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competency-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
