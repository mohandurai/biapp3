<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationEmail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module')->textInput() ?>

    <?= $form->field($model, 'emp_id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'cc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'sch_date')->textInput() ?>

    <?= $form->field($model, 'delivery_status')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'delivery_time')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
