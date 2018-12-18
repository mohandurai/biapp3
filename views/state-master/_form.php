<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\ZoneMaster;
/* @var $this yii\web\View */
/* @var $model app\models\StateMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'state_code')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'state_name')->textInput(['maxlength' => 45]) ?>
<?= $form->field($model, 'zone_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ZoneMaster::find()->all(),'id','zone_name'),
    //'language' => 'en',
   'options' => ['placeholder' => 'Select a Region ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
