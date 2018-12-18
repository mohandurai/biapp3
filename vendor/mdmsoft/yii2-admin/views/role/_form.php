<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <p class="headblockdetails">Admin</p>
 
<div class="fieldsblock">
<div class="row col-lg-12">
<div class="col-lg-12">
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
    </div>
    </div>

<div class="row col-lg-12">
<div class="col-lg-12">
    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
    </div>
    </div>

<div class="row col-lg-12">
<div class="col-lg-12">
    <?=
    $form->field($model, 'ruleName')->widget('yii\jui\AutoComplete', [
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'source' => array_keys(Yii::$app->authManager->getRules()),
        ]
    ])
    ?>
    
  

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
      </div>
    </div>
    </div>

    <div class="form-group topspace">
        <?php
        echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>