<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CountryMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-master-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'country_name')->textInput(['maxlength' => 100]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
