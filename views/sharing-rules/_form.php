<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;
$connection = \Yii::$app->db;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\SharingRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sharing-rules-form">

    <?php $form = ActiveForm::begin(); 

	    	
	$qry = $connection->createCommand('SELECT * FROM modules');
	$modules = $qry->queryAll();
	//print_r(ArrayHelper::map($modules,'module_name','module_name'));
	?>
	<p class="headblockdetails">Sharing Rules :</p>
						 <div class="fieldsblock">	            
	                
	                <div class="row col-lg-12">
							<div class="col-lg-12"> 

    <?= $form->field($model, 'module')->dropDownList(ArrayHelper::map($modules,'module_name','module_name'), ['prompt' => 'Select Module']) ?>
    </div>
    </div>

  <div class="row col-lg-12">
							<div class="col-lg-12"> 
    <?= $form->field($model, 'sharing_access')->dropDownList([ 'Public' => 'Public', 'PrivateEX' => 'PrivateEX', ], ['prompt' => 'Select Access']) ?>
    </div>
    </div>
    </div>

    <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>