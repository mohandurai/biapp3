<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeographyMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geography-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'geo_id') ?>

    <?= $form->field($model, 'country_code') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'territory') ?>

    <?php // echo $form->field($model, 'pincode') ?>

    <?php // echo $form->field($model, 'continental') ?>

    <?php // echo $form->field($model, 'bunit_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
