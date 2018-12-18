<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RelatedListsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="related-lists-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_table') ?>

    <?= $form->field($model, 'second_table') ?>

    <?= $form->field($model, 'first_table_columns') ?>

    <?= $form->field($model, 'second_table_coumns') ?>

    <?php // echo $form->field($model, 'query') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
