<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use mdm\admin\models\AuthItem;
use app\models\CategoryMaster;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAllocation */
/* @var $form yii\widgets\ActiveForm */
$ArrayRole=   ArrayHelper::map(\app\models\Authitem::find()->where(['type'=>1])->all(),'name','name');

?>

<div class="menu-allocation-form">
 <div class="fieldsblock"> 

    <?php $form = ActiveForm::begin(); ?>
 <?php echo  $form->errorSummary($model); ?>

 <div class="row col-lg-12">
  <div class="col-lg-6"> 
       
    <?= $form->field($model, 'userid')->widget(Select2::classname(), [
    'data' => $ArrayRole,
    'language' => 'en',
    'options' => ['placeholder' => 'Select a Role ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
    </div>
    </div>

 <div class="row col-lg-12">
  <div class="col-lg-6"> 
     <?= $form->field($model, 'categoryid')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(CategoryMaster::find()->all(),'id','category'),
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Category ...'],
        'pluginOptions' => [
            'allowClear' => true
                 ], 
        
        'pluginEvents' => [
       ]
        
        
    ]);
    ?>
    </div>
       
    </div>

<?php 
if($model->isNewRecord){?>
     <div class="row col-lg-12">
       
<?php  echo maksyutin\duallistbox\Widget::widget([
            'model' => $model,
            'attribute' => 'parentmenu',
            'lngOptions' => [
                                'available'=> 'Available Sub category',
                            ],
            'title' => 'Subcategory',
            
            'data' => [],
            'data_id'=> 'name',
            'data_value'=> 'description'         
          ]);?>
    

</div>


 <div class="row col-lg-12">
        
  
<?php  echo maksyutin\duallistbox\Widget::widget([
            'model' => $model,
            'attribute' => 'childmenu',
            'lngOptions' => [
                                'available'=> 'Available Sub category',
                            ],
            'title' => 'Childmenu',
            
            'data' => [],
               
          ]);?>
   

</div>
  
<?php }
else{

?>
 <div class="row col-lg-12">
       <?php 

            $parentmenu5 =   [];
          $parenttype2=explode(",",$model->parentmenu);

          //  $selectparentmenu   =   json_decode($model->parentmenu);
           
          $model->parentmenu=json_encode(explode(",",$model->parentmenu));
 
  $parenttype=explode(",",$model->parentmenu);

  
       ?>
 <?php
  echo maksyutin\duallistbox\Widget::widget([
            'model' => $model,
            'attribute' => 'parentmenu',
            'lngOptions' => [
                                'available'=> 'Available Sub category',
                            ],
            'title' => 'Subcategory',
          // 'value'=>$selectparentmenu,

           'data' => \app\models\BiMenus::find()->andwhere(['category' => $model->categoryid,'parent_id'=>0]),
            //'data' => []
            'data_id'=> 'id',
            'data_value'=> 'title'       
        ]);
 ?>
    

</div>
<div class="row col-lg-12">
        <?php
         $model->childmenu=json_encode(explode(",",$model->childmenu)); ?>
  
<?php  echo maksyutin\duallistbox\Widget::widget([
            'model' => $model,
            'attribute' => 'childmenu',
            'lngOptions' => [
                                'available'=> 'Available Sub category',
                            ],
            'title' => 'Childmenu',
            
             'data' => \app\models\BiMenus::find()->andwhere(['parent_id' => $parenttype2]),
             'data_id'=> 'id',
            'data_value'=> 'title'   
               
          ]);?>
   

</div>
<?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
<?php
$url = Yii::$app->urlManager->createAbsoluteUrl('menu-allocation/parent'); 
$url1 = Yii::$app->urlManager->createAbsoluteUrl('menu-allocation/child'); 

$this->registerJs(
    '
    
        
$("#menuallocation-categoryid").on("change",function(){
   
    $.ajax({
        url: "'.$url.'",
        type:"POST",
        data:{"interviewer_role":$("#menuallocation-categoryid").val()},
        success: function(result){
            console.log(result);
            $(".unselecteddlb-parentmenu").html(result);
        }
    });
});

$("#dlb-parentmenu button").on("click",function(){
    
    $.ajax({
        url: "'.$url1.'",
        type:"POST",
        data:{"parentmenu":$("#menuallocation-parentmenu").val()},
        success: function(result){
            console.log(result);
            $(".unselecteddlb-childmenu").html(result);
        }
    });
});
', $this::POS_READY, ''); 

if(!$model->isNewRecord)
{

$this->registerJs(
    '
    $("#menuallocation-categoryid").on("change",function(){
    $(".selected.selecteddlb-parentmenu").html("");
    $(".unselected.unselecteddlb-childmenu").html("");
     $(".selected.selecteddlb-childmenu").html("");
    $.ajax({
        url: "'.$url.'",
        type:"POST",
        data:{"interviewer_role":$("#menuallocation-categoryid").val()},
        success: function(result){
            console.log(result);
            $(".unselecteddlb-parentmenu").html(result);
        }
    });
});

$("#dlb-parentmenu button").on("click",function(){
     
    $(".unselected.unselecteddlb-childmenu").html("");
     $(".selected.selecteddlb-childmenu").html("");
 
    $.ajax({
        url: "'.$url1.'",
        type:"POST",
        data:{"parentmenu":$("#menuallocation-parentmenu").val()},
        success: function(result){
            console.log(result);
            $(".unselecteddlb-childmenu").html(result);
        }
    });
});
     


', $this::POS_READY, ''); 
}

?>