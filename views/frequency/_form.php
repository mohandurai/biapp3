<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Frequency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="frequency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'period')->textInput(['maxlength' => 100]) ?>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
