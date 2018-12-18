<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'json_query')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modified_date')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
