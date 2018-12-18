<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MobileDeviceManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobile-device-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'device_key')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'modified_date')->textInput() ?>

    <?= $form->field($model, 'imei_no')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'delivered_status')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
