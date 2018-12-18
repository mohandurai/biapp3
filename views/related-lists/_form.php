<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
$connection = \Yii::$app->db;
/* @var $this yii\web\View */
/* @var $model app\models\RelatedLists */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="related-lists-form">

    <?php $form = ActiveForm::begin(); ?>



<?php


$modlist=array_diff(scandir("../models"),array("..","."));



foreach($modlist as $k=>$v)
{
$modname = preg_match('/\w+/',$v,$matches);

$modname = preg_split('/(?=[A-Z])/',$matches[0]);

  $str="";
  $newmodname= array();

  for($i=1; $i < sizeof($modname); $i++ )
  {
  $str=strtolower($modname[$i]);
  $newmodname[]=$str;
  }
if(preg_match('/Search/',$matches[0],$found))
{
continue; 
}
$return_arry['models'][$matches[0]]=$matches[0];
}
 

?>

       <?= $form->field($model, 'model_name')->widget(Select2::classname(), [
    'data' => $return_arry['models'],
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Module ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>


    <?= $form->field($model, 'field_label')->textInput(['maxlength' => true]) ?>

    <?php
/*
    
     $tbls = $connection->createCommand('show tables');
     $tbls = $tbls->queryAll();

  
  foreach($tbls as $k=>$v)
  {
   
    foreach($v as $kk=>$vv)
    {
      $tblarry[$vv]=$vv;
    }

  }   ?>

 <?= $form->field($model, 'first_table')->widget(Select2::classname(), [
    'data' => $tblarry,
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Parent Table ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
    'pluginEvents' => [
     "change" => "function() { 

$.post('".Url::to(['/related-lists/columns'])."', { table: $(this).val()}, 
    function(returnedData){
console.log(returnedData);
$('#relatedlists-first_table_key').select2({data:JSON.parse(returnedData),multiple:true, placeholder: 'Select Items'})   
})}" 

   
     ],
   
]);
?> 
 <?= $form->field($model, 'second_table')->widget(Select2::classname(), [
    'data' => $tblarry,
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Child Table ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
'pluginEvents' => [
     "change" => "function() { 

$.post('".Url::to(['/related-lists/columns'])."', { table: $(this).val()}, 
    function(returnedData){
console.log(returnedData);
$('#relatedlists-second_table_key').select2({data:JSON.parse(returnedData),multiple:true, placeholder: 'Select Columns'});

$('#relatedlists-display_columns').select2({data:JSON.parse(returnedData),multiple:true, placeholder: 'Select Columns'});      
})}"

   
     ],
]); 
?> 
<?php

/*
    <?= $form->field($model, 'first_table_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_table_key')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'display_columns')->textInput(['maxlength' => true]) ?> */ ?>

    <?= $form->field($model, 'query')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
