<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FunctionMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="function-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'function_id') ?>

    <?= $form->field($model, 'function_code') ?>

    <?= $form->field($model, 'function_name') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'bunit_id') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
