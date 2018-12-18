<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'department_id') ?>

    <?= $form->field($model, 'department_code') ?>

    <?= $form->field($model, 'department_name') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
