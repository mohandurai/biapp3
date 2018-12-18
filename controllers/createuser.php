<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

use mdm\admin\models\AuthItem;
use yii\helpers\ArrayHelper;
use  app\models\User;
use  app\models\DepartmentMaster;
use  app\models\CountryMaster;
use  app\models\ZoneMaster;
use  app\models\StateMaster;
use  app\models\CityMaster;
use  app\models\AreaMaster;
use  app\models\TerritoryMaster;
use  app\models\DealershipMaster;
use app\models\UserGroupMaster;
use app\models\ChannelMaster;
use app\models\FunctionMaster;
use app\models\CompanyMaster;
use app\models\BusinessUnitMaster;
use yii\helpers\Json;
use yii\db\Query;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\web\UploadedFile;

use mdm\admin\models\searchs\AuthItem as AuthItemSearch;
use yii\rbac\Item;
use dosamigos\datepicker\DatePicker;
use common\models\DataOperations;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
require_once "db.php";
?>
<?php
//city,area,territory 

$this->registerJs(
    '$("document").ready(function(){ 


$("#signupform-pincode").change(function()
{
//alert("kkk");
$.post( " '.Url::to(["/site/geolist"]).'", { pincode:$("#signupform-pincode").val()}, function (data) {
//console.log(data);
data=JSON.parse(data);
 $.each(data, function  (i, item) {
                    
console.log(item.state);

                                   $("#signupform-country").val(item.country);
                                     $("#signupform-state").val(item.state);
                                       $("#signupform-city").val(item.city);
                                       $("#signupform-territory").val(item.territory);
                                       $("#signupform-area").val(item.area);
                                       $("#signupform-zone").val(item.village);                                       
                                });
});
});


 });'
);


?>
<?php

/*$searchModel = new AuthItemSearch(['type' => Item::TYPE_ROLE]);
$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());


    foreach ($dataProvider as $item ) 
    {

            if (is_array($item) || is_object($item))
            {
            $rolekeys=array_keys($item);
            for($k=0;$k<sizeof($rolekeys);$k++)
            {
            $role[$rolekeys[$k]]=$rolekeys[$k];
            }

            }

    }*/





?>
<div class="site-signup">
    

  
<?php $form = ActiveForm::begin(['id' => 'form-signup','options'=>['enctype'=>'multipart/form-data','class' => 'form-vertical']]); ?>

            
             <p class="headblockdetails">Signup </p>
                         <div class="fieldsblock">              
                    
         

                
                 <div class="row col-lg-12">
                            <div class="col-lg-6"> 
        <?= $form->field($model, 'first_name') ?>
        </div>
        
        <div class="col-lg-6"> 
        <?= $form->field($model, 'last_name') ?>
        </div>
        </div>
        
         <div class="row col-lg-12">
                            <div class="col-lg-6"> 
                            
                            <?= $form->field($model, 'date_of_birth')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
         // modify template for custom rendering
       // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>
                            
                            
    

        </div>
        


                            <div class="col-lg-6"> 
                                <?= $form->field($model, 'qualification') ?>
                                </div>
                    </div>          
                                
         <div class="row col-lg-12">
                            <div class="col-lg-6">                  
                <?= $form->field($model, 'email') ?>
                </div>
                
         <div class="col-lg-6">        
<?= $form->field($model, 'mobile') ?>
</div>
</div>
           <div class="row col-lg-12">
                            <div class="col-lg-12"> 
                <?= $form->field($model, 'username') ?>
                </div>
                
                </div>
 <div class="row col-lg-12">
                            <div class="col-lg-6"> 
                            
                <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                            <div class="col-lg-6"> 
        <?= $form->field($model, 'repeat_password')->passwordInput() ?>
        </div>
        </div>
        </div>
        
        <p></p>
         <div class="fieldsblock">
        <div class="row col-lg-12">
                            <div class="col-lg-4"> 
        <?php 
        $db= Yii::$app->user->identity->dp;
        $ArrayRole=   ArrayHelper::map(\app\models\Authitem::find()->where(['type'=>1])->andwhere(['dealer'=>$db])->all(),'name','description');
        ?>
        <?= $form->field($model, 'role')->widget(Select2::classname(), [
    'data' => $ArrayRole,
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Role ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>

<div class="col-lg-4"> 
    <?php $sql = "select id,username,emp_code from user";
$res2 = mysql_query($sql);
    $nrw = mysql_num_rows($res2); 
 while($rt = mysql_fetch_assoc($res2))
{
$cid = $rt['id'];
$name = $rt['username'];
//$code = $rt['emp_code'];;
$code=$rt['username'];
$dropval1[$cid] = $name."(".$code.")";
}
?>
  <?= $form->field($model, 'reports_to')->dropDownList($dropval1) ?>
</div>

<div class="col-lg-4"> 
<?= $form->field($model, 'department')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DepartmentMaster::find()->all(),'department_id','department_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Department ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>
</div>
</div>


<p></p>
         <div class="fieldsblock">

<div class="row col-lg-12">
<div class="col-lg-4" >
<?= $form->field($model, 'pincode')->textInput() 	 ?>

</div>
</div>
        <div class="row col-lg-12">
                            <div class="col-lg-4"> 
  <?= $form->field($model, 'country') ?>
<?/* = $form->field($model, 'country')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CountryMaster::find()->all(),'c_id','country_name'),
    'language' => 'en',

    'options' => ['placeholder' => 'Select a Country ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'zone') ?>
<?/* = $form->field($model, 'zone')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ZoneMaster::find()->all(),'zone_id','zone_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Zone ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'state') ?>
<?/* = $form->field($model, 'state')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(StateMaster::find()->all(),'s_id','state_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a State ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>
</div>

<div class="row col-lg-12"> 
<div class="col-lg-4"> 
 <?= $form->field($model, 'city') ?>
<?/* = $form->field($model, 'city')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CityMaster::find()->all(),'city_id','city_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a City ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'area') ?>
<?/* = $form->field($model, 'area')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(AreaMaster::find()->all(),'area_id','area_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Area ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>


<div class="col-lg-4"> 
 <?= $form->field($model, 'territory') ?>
<?/*= $form->field($model, 'territory')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(TerritoryMaster::find()->all(),'tertiary_id','tertiary_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Territory ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?>
</div>
</div>
</div>

<p></p>
         <div class="fieldsblock">
<div class="row col-lg-12"> 
<div class="col-lg-4"> 
<?= $form->field($model, 'dealership')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(DealershipMaster::find()->all(),'dealership_id','dealership_name'),
    'language' => 'en',
   'options' => [
        'placeholder' => 'Select Dealer ...',
        'multiple' => true
    ],
    'pluginOptions' => [
        'allowClear' => true,
	

    ], 
]);
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'supervisor')->dropDownList(['No' => 'No', 'Yes' => 'Yes' ]) ?>
 </div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'trainer')->dropDownList(['No' => 'No', 'Yes' => 'Yes']) ?>
</div>
</div>
<div class="col-lg-4"> 
  <?= $form->field($model, 'co_ordinator')->dropDownList(['No' => 'No', 'Yes' => 'Yes']) ?>
</div>
<div class="col-lg-4"> 
<?php
// $connection = Yii::$app->db;
//$sql = "select channel_id,description,concat(channel_code,'-',channel_name) as name from channel_master";
//$command =$sql->createCommand();
//$data = Yii::$app->db->createCommand($sql)->execute();
   $titles = '';
    $sql = "select a.channel_id,b.channel_function_name as description,concat(a.channel_code,'-',a.channel_name) as name from channel_master as a,channel_function_type as b where a.channel_function_type_id=b.channel_function_id";
$res2 = mysql_query($sql);
    $nrw = mysql_num_rows($res2); 
 while($rt = mysql_fetch_assoc($res2))
{
$cid = $rt['channel_id'];
$ccode = $rt['description'];
$cname = $rt['name'];;
$dropval[$cid] = $cname."->".$ccode;
}
?>
  <?= $form->field($model, 'channel')->dropDownList($dropval) ?>

 <?/* = $form->field($model, 'channel')->widget(Select2::classname(), [
    'data' => ArrayHelper::$cid,$ccode,$cname,
    'language' => 'en',
    'options' => ['placeholder' => 'Select a channel ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]); */
?> 
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'usergroup')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(UserGroupMaster::find()->all(),'group_id','title'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Dealer ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>
<div class="col-lg-4"> 
<?= $form->field($model, 'function')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(FunctionMaster::find()->all(),'function_id','function_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Function ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'businessunit')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(BusinessUnitMaster::find()->all(),'bunit_id','business_unit_name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a BusinessUnit ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'company')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(CompanyMaster::find()->all(),'company_id','company_desc'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a company ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
</div>
<div class="col-lg-4"> 
 <?= $form->field($model, 'leader')->dropDownList(['0' => 'No', '1' => 'Yes' ]) ?>
 </div>
<div class="col-lg-4"> 
<?php

        $attr=$model->isNewRecord ? 'file[]' : 'upload_image[]';
        $pathstr="";   
        $intprev=$model->isNewRecord ? '' : $pathstr;
  echo $form->field($model, $attr)->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*,csv,png,doc,jpeg,jpg,gif,pdf,3gp,mp4,mp3,xls', 'multiple'=>true],
    'pluginOptions'=>['allowedFileExtensions'=>['pdf','doc','jpeg','jpg','gif','png','csv','3gp','mp4','mp3','xls'], 'showUpload' => false,'initialPreview'=>[
              //$pathstr
            ],'overwriteInitial'=>true

        ]
    ]); 
?>

</div>

<div class="col-lg-4"> 
 <?//= $form->field($model, 'belongs_to')->dropDownList(['' => '-- Select --','1' => 'Good to Great-1', '2' => 'Good to Great-2' ]) ?>
 </div>
 
</div>


                <div class="form-group topspace">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'signup', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    
</div>
