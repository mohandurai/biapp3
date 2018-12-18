<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CityMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'city_name') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 's_id') ?>

    <?php // echo $form->field($model, 'postal_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
