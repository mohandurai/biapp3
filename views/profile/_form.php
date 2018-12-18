<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Attachments;
use yii\helpers\ArrayHelper;
use app\models\ContentType;
use app\models\Role;
use app\models\FileTransfer;
use kartik\select2\Select2;
use app\models\Modules;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="Job profile-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form','options'=>['enctype'=>'multipart/form-data','class' => 'form-vertical']]); ?>

 
   <?= $form->field($model, 'roles')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\app\models\Authitem::find()->where(['type'=>1])->all(),'name','name'),
                        'language' => 'en',
                        'options' => ['multiple'=>false,'placeholder' => 'Select Role ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
<?php
	$userLists =   [];
       
           // $userLists   =   json_decode($model->interviewer_role);
           
            
	echo $form->field($model, 'emp_id')->widget(maksyutin\duallistbox\Widget::classname(), [	
    'model' => $model,
    'attribute' => 'emp_id',
    'title' => 'Select users',
    //'data' => [],
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
     <?= $form->field($model, 'filetype')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(FileTransfer::find()->all(),'f_id','f_name'),
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Content ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
    'pluginEvents' => [
    
    "change" => "function() {  module1(this.value); if($('#profile-filetype').val()!= 6 ) { $('#attachments-0-filename').attr('disabled', true); if(this.value==8){ $('#elearning_list').show();}} else { $('#attachments-0-filename').removeAttr('disabled');}}"]    
]);
?>
<div class="panel panel-default">
        <div class="panel-heading"><h5><b><i class="glyphicon glyphicon-file"></i> Attachments </b></h5></div>
        <div class="panel-body" id="qid">
<?php

        $attr=$model->isNewRecord ? 'file[]' : 'upload_image[]';
        $pathstr="";

        if(!$model->isNewRecord)
        {
        $path_arr=Yii::$app->db->createCommand('SELECT filepath FROM documentsupload
         WHERE modid='.$model->id)->queryAll();            foreach($path_arr as $val)
            {
                $pathstr.=Html::img($val['filepath'],['class'=>'file-preview-image']).",";
            }
        }
        $intprev=$model->isNewRecord ? '' : $pathstr;

    echo $form->field($model, $attr)->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*,csv,png,doc,jpeg,jpg,gif,pdf,3gp,mp4,mp3,xls,zip', 'multiple'=>true],
    'pluginOptions'=>['allowedFileExtensions'=>['pdf','doc','jpeg','jpg','gif','png','csv','3gp','mp4','mp3','xls','zip'], 'showUpload' => false,'initialPreview'=>[
             // $pathstr
            ],'overwriteInitial'=>true

        ]
    ]); 
?>

   <div class="panel-heading">
                       
                        
                        <div class="clearfix"></div>
                    </div>
           
        </div>

    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

   <?php ActiveForm::end(); ?>
<script type="text/javascript">
    function module1(val1){
         if(val1 ==1 || val1 ==2){
              document.getElementById('qid').style.display = 'none';                
                     }
                     else{
              document.getElementById('qid').style.display = 'block';                       
          }
       }
</script>

<?php
$url = Yii::$app->urlManager->createAbsoluteUrl('profile/username'); 
$this->registerJs(
                '$("document").ready(function(){ 

$("#profile-roles").change(function(){
    		$.ajax({
		        url: "'.$url.'",
		        type:"POST",
		        data:{"name":$("#profile-roles").val()},
		        success: function(result){
		            console.log(result);
		          $(".unselecteddlb-emp_id").html(result);
                    
		        }
   
		    });

 
   	});
function initializesendmail(){
      $(".unselected").empty();
$(".selected").empty();


 $.get("'.Url::to(['/profile/username']).'", {categoryitemid: baseselect ,category: roleselect}, function (data) {
                               
console.log(data);

data=JSON.parse(data);
                              $.each(data, function (i, item) {
          
//console.log(i);

                                   $(".unselected").append("<option value=" + item.index + ">" + item.name + "</option>");
                                });
                                //$(".unselected").DualListBox();

                  $(".selected").prop();
      $("#allright").click();
                            });
    }

$("#dynamic-form").on("afterInsert", function(e, item) {


$($(".fileinput-remove").get().reverse()).each(function(i) {

if(i==0)
console.log(this.click());
});

        /*$("button").each(function() {

            if($(this).hasClass("fileinput-remove"))
            {
            console.log(this.click());
            }

            });*/

    });

var ajaxtype='.(isset($ajaxtype)?1:0).';            

$("body").on("beforeSubmit", "form#'.$model->formName().'", function () {

            if(ajaxtype==1)
            {
            ajaxtype=0;     
                                
                var form = $(this);         
                if (form.find(".has-error").length) {
                      alert("fail");
                      return false;
                     }          
                 $.ajax({
                  url: form.attr("action"),
                  type: "post",
                  data: form.serialize() ,
                  success: function (response) {
                    
                    var res=JSON.parse(response);
                
                    if (res["id"])                              
                    {
                    //alert("record saved successfully");
                    //form.trigger("reset");
                        window.setTimeout(function () {
                      $("#snoAlertBox").fadeOut(300);
                        $(document).find("#modal").modal("hide");   
                    }, 1000);


                     $("#snoAlertBox").fadeIn();
                            //$("#questionmaster-num_answers").val(null).trigger("change"); 
                            //$("#questionmaster-max_attempt").val(null).trigger("change"); 
                        
                    $.pjax.reload({container:"#contentpjax", async:false});
                    //$("#questionmaster-content_id").val("28").trigger("change"); 
                     //  parent.mynotify();
                        parent.$("#profile-id").val(res["id"]).trigger("change"); 
                    }   
                    else
                    {       
                    
                    }               
                    
                       // do something with response
                  }

                 });
                
                ajaxtype=0;             
                console.log("inside false");
                    return false;
            }
if(ajaxttype==1)
            {

            ajaxtype=0;     
                    alert("dfgdg");         
                var form = $(this);         
                if (form.find(".has-error").length) {
                      alert("fail");
                      return false;
                     }          
                 $.ajax({
                  url: form.attr("action"),
                  type: "post",
                  data: form.serialize() ,
                  success: function (response) {
                    
                    var res=JSON.parse(response);
                
                    if (res["id"])                              
                    {
                    //alert("record saved successfully");
                    //form.trigger("reset");
                        window.setTimeout(function () {
                      $("#snoAlertBox").fadeOut(300);
                        $(document).find("#modal").modal("hide");   
                    }, 1000);


                     $("#snoAlertBox").fadeIn();
                            //$("#questionmaster-num_answers").val(null).trigger("change"); 
                            //$("#questionmaster-max_attempt").val(null).trigger("change"); 
                        
                    $.pjax.reload({container:"#contentpjax", async:false});
                    //$("#questionmaster-content_id").val("28").trigger("change"); 
                     //  parent.mynotify();
                        parent.$("#questionmaster-content_id").val(res["id"]).trigger("change"); 
                    }   
                    else
                    {       
                    
                    }               
                    
                       // do something with response
                  }

                 });
                
                ajaxtype=0;             
                console.log("inside false");
                    return false;
            }
});



});'
);?>
</div>
