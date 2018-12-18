<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use  app\models\CandidateList;
use  app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model app\models\CandidateList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-Create-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 45]) ?>

    <?php
    $db=Yii::$app->user->identity->dp;
    $ArrayHelper=   ArrayHelper::map(\app\models\Authitem::find()->where(['type'=>1])->andwhere(['dealer'=>$db])->all(),'name','description');
    echo $form->field($model, 'role_id')->widget(Select2::classname(), [
    'data' => $ArrayHelper,
    'language' => 'en',
    'options' => ['placeholder' => 'Select a role ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
<?php
        //$form->field($model, 'delear_id')->textInput();
    
    $ArrayHelper=   ArrayHelper::map(\app\models\DealershipMaster::find()->where(['centralAudiParhomepage'=>$db])->all(),'dealership_id','dealership_name');
    echo $form->field($model, 'dealer_id')->dropDownList($ArrayHelper);
    ?>

    <?php // $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'InActive' => 'InActive',]) ?>

    <?= $form->field($model, 'resumefile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
