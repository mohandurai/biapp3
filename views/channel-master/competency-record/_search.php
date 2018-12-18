<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompetencyRecordSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competency-record-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'recid') ?>

    <?= $form->field($model, 'competency') ?>

    <?= $form->field($model, 'question') ?>

    <?= $form->field($model, 'createdby') ?>

    <?= $form->field($model, 'createddate') ?>

    <?php // echo $form->field($model, 'modifiedby') ?>

    <?php // echo $form->field($model, 'modifieddate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
