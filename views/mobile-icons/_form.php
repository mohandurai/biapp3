<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\MobileIcons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mobile-icons-form">

    <?php $form = ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data','class' => 'form-vertical'],
     ]); ?>
<?php


$modlist=array_diff(scandir("../../models"),array("..","."));



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

       <?= $form->field($model, 'module')->widget(Select2::classname(), [
    'data' => $return_arry['models'],
    'language' => 'en',
    'options' => ['multiple'=>false,'placeholder' => 'Select Module ...'],
    'pluginOptions' => [
        'allowClear' => true
    ], 
]);
?>
    <?= $form->field($model, 'model_label_name')->textInput(['maxlength' => 100]) ?>
   
 <?php

        $attr='file';
        $pathstr="";

        if(!$model->isNewRecord)
        {
          $path_arr=Yii::$app->db->createCommand('SELECT img_path FROM mobile_icons WHERE icon_id='.$model->icon_id)->queryAll();
            foreach($path_arr as $val)
            {
                $pathstr.=Html::img($val['img_path'],['class'=>'file-preview-image']).",";
            }
        }
        $intprev=$model->isNewRecord ? '' : $pathstr;


  if(!$model->isNewRecord)
        {

echo $form->field($model, $attr)->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>[], 'maxFileSize' => 2048,'showUpload' => false,'initialPreview'=>[$pathstr],'overwriteInitial'=>true
]
]); 
		}
		else
		{
			
echo $form->field($model, $attr)->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*' ],
    'pluginOptions'=>['allowedFileExtensions'=>[],'maxFileSize' => 2048 ,'showUpload' => false,
]
]); 
			
		} ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
