<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MobileIconsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobile-icons-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'icon_id') ?>

    <?= $form->field($model, 'module') ?>

    <?= $form->field($model, 'img_path') ?>
    <?= $form->field($model, 'model_label_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
