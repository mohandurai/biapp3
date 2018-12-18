<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\GeographyMaster;
use app\models\ZoneMaster;
use app\models\DealershipCategory;
use app\models\DealershipMaster;
use app\models\BusinessUnitMaster;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use kartik\widgets\SwitchInput;


/* @var $this yii\web\View */
/* @var $model app\models\DealershipMaster */
/* @var $form yii\widgets\ActiveForm */
?>

  <div class="form-group">
                                     

<div class="dealership-master-form">

    <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'zone_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ZoneMaster::find()->all(),'id','zone_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a  Region ...'],
    'pluginOptions' => [
        'allowClear' => true
             ], 
	
	'pluginEvents' => [
   ]
	
	
]);
?>


    <?= $form->field($model, 'dealership_name')->textInput(['maxlength' => 45]) ?>

<?php echo $form->field($model, 'tms_status')->dropDownList(['Yes' => 'Yes', 'No' => 'No'],['prompt'=>'Choose...']); ?>

  <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DealershipCategory::find()->all(),'category_id','category_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a category...'],
    'pluginOptions' => [
        'allowClear' => true
             ], 
	
	'pluginEvents' => [
   ]
	
	
]);
?>

 

<?= $form->field($model, 'centralAudiParhomepage')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(BusinessUnitMaster::find()->all(),'bunit_id','business_unit_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a DP...'],
    'pluginOptions' => [
        'allowClear' => true
             ], 
    
    'pluginEvents' => [
   ]
    
    
]);
?>


    <?= $form->field($model, 'id_external_dealer_shop')->textInput(['maxlength' => 55]) ?>


<?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DealershipMaster::find()->all(),'dealership_id','dealership_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Dealer ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>

<?= $form->field($model, 'segment',['template'=> "{input}\n{error}"])->checkboxList(['1'=>'Retail',
            '2'=>'Corporate','3'=>'Performance'],['itemOptions'=>['class' => 'groupvechivle','id'=>'task']]) ?>
 <?php echo $form->field($model, 'dealer_type')->dropDownList(['Dealership'=>'Dealership'],['prompt'=>'Choose...']); ?>


    <?= $form->field($model, 'partner_number')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'Primarycode')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'KVPSPartnernummer')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'OfficialNameAudiPartner')->textInput(['maxlength' => 55]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => 55]) ?>
      
  <?php echo SwitchInput::widget([
'name' => 'audi_sales',
'type' => SwitchInput::RADIO,
'items' => [
['label' => 'AudiSales', 'value' => 1],
['label' => 'AudiService', 'value' => 2],
['label' => 'OverAll', 'value' => 3],
],
'pluginOptions' => ['size' => 'mini'],
'labelOptions' => ['style' => 'font-size: 12px'],
]);?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'fax_number')->textInput(['maxlength' => 55]) ?>
    <?= $form->field($model, 'external_city_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(GeographyMaster::find()->all(),'geo_id','city1.city_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a city ...'],
    'pluginOptions' => [
        'allowClear' => true
             ], 
	
	'pluginEvents' => [
   ]
	
	
]);
?>
							

    <?= $form->field($model, 'external_dealer_area_id')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'website_url')->textInput(['maxlength' => 55]) ?>

  
   
    <?= $form->field($model, 'Group1')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'Groupstreetnumber')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'post_code')->textInput(['maxlength' => 55]) ?>

    <?= $form->field($model, 'GroupCentralEmailadress')->textInput(['maxlength' => 55]) ?>
	
	

    <?= $form->field($model, 'email')->textInput(['maxlength' => 55]) ?>

    
<?= $form->field($model, 'responsible_persons')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DealershipMaster::find()->all(),'dealership_id','dealership_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Dealer ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
  
 
 <?= $form->field($model, 'coordinates')->textInput(['maxlength' => 55]) ?>
    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 55]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
//alert();
    $('input#task').click(function() {
        var checked = $(this).is(':checked');
        //alert(checked);
        if(checked){
            $('input.groupvechivle').prop('checked',true);
        }else{
            $('input.groupvechivle').prop('checked',false);
        }       
    });
    
     ", $this::POS_READY, '');
?>
