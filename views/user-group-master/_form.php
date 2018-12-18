<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Attachments;
use yii\helpers\ArrayHelper;
use app\models\SubjectMaster;
use app\models\ContentType;
use app\models\FileTransfer;
use kartik\select2\Select2;
use app\models\Modules;
use yii\helpers\Url;
use app\models\User;
use kartik\widgets\SwitchInput;
use app\models\AuthItem;
use app\models\RoleCategory;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model app\models\UserGroupMaster */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-group-master-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'role')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(RoleCategory::find()->all(),'id','name'),
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select assigned_role ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
    'pluginEvents' => [

    "change" => 'function() {  roleselect = $(this).val();   }']
]);
?>

<?= $form->field($model, 'assigned_role')->widget(DepDrop::classname(), [
     //'data'=> [$model->assigned_role=>"'".$model->assigned_role."'"],
    'options' => ['placeholder' => 'Select role', 'multiple' => true],
    'type' => DepDrop::TYPE_SELECT2,
    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
    'pluginOptions'=>[
        'depends'=>['usergroupmaster-role'],
        'url' => Url::to(['/user-group-master/itemlist']),
        'loadingText' => 'Loading....',
 'initialize' => true
    ],
'pluginEvents' => [

    "change" => 'function() {  baseselect = $(this).val();  }']
]);

?>
<?php 
  echo Html::button('Suggest', [ 'class' => 'btn btn-primary','id'=>'suggest',  
  'onclick' => '(function ( $event ) { 
 $(".unselected").empty();
$(".selected").empty();

//alert($("#usergroupmaster-role").val());

     // alert($("#usergroupmaster-assigned_role").val());
                    
 $.get("'.Url::to(['/user-group-master/rolelist']).'", {categoryitemid: baseselect ,category: roleselect}, function (data) {
                               
console.log(data);

data=JSON.parse(data);
                              $.each(data, function (i, item) {
          
//console.log(i);

                                   $(".unselected").append("<option value=" + item.index + ">" + item.name + "</option>");
                                });
                                //$(".unselected").DualListBox();

                  $(".selected").prop("required",true);
      $("#allright").click();
                            });

           
                           

 
   })();' ]);

  ?>
     
<? echo $form->field($model, 'users')->widget(maksyutin\duallistbox\Widget::classname(), [   
    'model' => $model,
    'attribute' => 'users',
    'title' => 'Select user',
    'data' =>[],
    'data_id'=> 'id',
    
    'data_value'=> 'username',
    'lngOptions' => [
        'warning_info' => 'Вы уверены, что хотите выбрать такое количество элементов?
                           Возможно Ваш браузер может перестанет отвечать на запросы..',
        'search_placeholder' => 'Filter Search',
        'showing' => ' - Count',
        'available' => 'Available Users',
        'selected' => 'Selected Users'
    ]
  ]);
  
  ?>



    <?//= $form->field($model, 'group_code')->textInput(['maxlength' => 100]) ?>

    <?//= $form->field($model, 'modified_date')->textInput() ?>

    <?//= $form->field($model, 'modified_by')->textInput() ?>

    <?//= $form->field($model, 'created_date')->textInput() ?>

    <?//= $form->field($model, 'created_by')->textInput() ?>

    <?//= $form->field($model, 'status')->textInput(['maxlength' => 60]) ?>
  <?
if(!$model->isNewRecord)
{
$this->registerJs(
    '$("document").ready(function(){ 

console.log("'.$selected_users[0].'");

var data='. json_encode($selected_users).';

$.each(data, function (i, item) {

$(".unselected").val(item).attr("selected", "selected");

$("#allright").click();
});
 });'
);
}

?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
