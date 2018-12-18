<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Option */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="option-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'option')->textInput(['maxlength' => 999]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
