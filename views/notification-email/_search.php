<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificationEmailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-email-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'emp_id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'cc') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'sch_date') ?>

    <?php // echo $form->field($model, 'delivery_status') ?>

    <?php // echo $form->field($model, 'delivery_time') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
