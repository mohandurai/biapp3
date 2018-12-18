<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\BiMenus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bi-menus-form">
  <div class="fieldsblock"> 
    <?php $form = ActiveForm::begin(); ?>
   <div class="row col-lg-12">
        <div class="col-lg-6"> 
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

   </div>
    <?php 
    $menu=array();
    $menu[0]=array("id"=>0,"menu_name"=>"=== None ===");
    $t=yii::$app->db->createCommand("select id,title from bi_menus")->queryAll();

    foreach($t as $key=>$value)
    {
      
        $temp=array("id"=>$value["id"],"menu_name"=>$value["title"]);
     array_push($menu,$temp);

    }
    ?>
     <div class="col-lg-6"> 
      <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map($menu,'id','menu_name'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Parent Menu ...','multiple'=>false],
        'pluginOptions' => [
            'allowClear' => true
                 ], 
        
        'pluginEvents' => [
       ]
        
        
    ]);
    ?>
    </div>
    </div>
     <div class="row col-lg-12">
           <div class="col-lg-12">                    
    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
</div>
    </div>

     <div class="row col-lg-12">
       <div class="col-lg-6"> 
    <?php 
    	/*	
    	echo $form->field($model, 'active')->dropDownList(['1' => 'Active', '0' => 'InActive'],['prompt'=>'Select status...']); 
    	*/
    ?>
    <?= $form->field($model, 'active')->dropDownList(['1' => 'Active', '0' => 'InActive'], ['value' => !empty($model->active) ? $model->active : 1]); ?>
</div>
 <div class="col-lg-6"> 
    <?= $form->field($model, 'level')->textInput(['type' => 'number','min'=>0]) ?>
</div>
</div>


<div class="row col-lg-12">
   <div class="col-lg-6"> 

    <?= $form->field($model, 'category')->dropDownList(['0' => '=== None ===', '1' => 'Marketing Potential', '2' => 'Secondary Sales', '3' => 'Home to Home', '4' => 'Tertiary Sales'], ['value' => !empty($model->active) ? $model->active : 1]); ?>
</div>
</div>


<div class="row col-lg-12">
           <div class="col-lg-12">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
</div>

    <?php ActiveForm::end(); ?>

</div>
</div>
