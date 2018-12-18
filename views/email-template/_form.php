<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'template_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?php /* $form->field($model, 'attachments')->textInput(['maxlength' => 255]) ?>

    <?php /* $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput() */ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
