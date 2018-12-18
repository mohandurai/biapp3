<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\BusinessUnitMaster;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\AudiNeevDesignation;
/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
<?php
if($model->isNewRecord )
{
?>

    
<?= $form->field($model, 'name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(AudiNeevDesignation::find()->all(),'neev_designation','neev_designation'),
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Designation ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
<?

}

?>

<?= $form->field($model, 'dealer')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(BusinessUnitMaster::find()->all(),'bunit_id','business_unit_name'),
    'language' => 'en',
    //'disabled'=>'true',
    'options' => ['multiple'=>false,'placeholder' => 'Select Dealer ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2,'readonly'=>true]) ?>


    <?php 
    /*
    $form->field($model, 'ruleName')->widget('yii\jui\AutoComplete', [
        'options' => [
            'class' => 'form-control',
        ],
        'clientOptions' => [
            'source' => array_keys(Yii::$app->authManager->getRules()),
        ]
    ])
    */
    ?>

    <?php 
    /* $form->field($model, 'data')->textarea(['rows' => 6]) */ 
    ?>

    <div class="form-group">
        <?php
        echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'chkdp'])
        ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs(
    '$("document").ready(function(){    
    	//alert("PPPPPPPPPP");
  
$("#authitem-name").click(function() {
			var dp1 = $("#authitem-name").val();
			//alert(dp1);
			//var select="#authitem-name option:eq("+dp1+")";
			//var option=$(select).text();
			//alert(option);
 $("#authitem-description").val(dp1);
			if(dp1=="")
			{
				 alert("Select Dealer Designation !!! ");

			}
		
				
			
		});
  	$("#chkdp").click(function() {
			var dp = $("#authitem-dealer").val();

			//alert(dp);
			if(dp=="") {
				alert("Select Dealer Principal !!! ");
				return false;
			}
		});
    });'

);

?>
