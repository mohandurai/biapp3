<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Update Job Profile: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    
     <?= $this->render('_form', [
        'modelsAttachments'=>$modelsAttachments,
        'model' => $model,
    ]) ?>

<?php 
$path_arr=Yii::$app->db->createCommand('SELECT * FROM documentsupload WHERE module="Profile" and  modid='.$model->id)->queryAll();
echo "<pre>";
$pathstr="";
//print_r($path_arr);
foreach($path_arr as $val)
{
$name=$val['filename'];
$nams=explode('.',$name);

$path= $val['filepath'];
 //echo VideoEmbed::widget(['responsive' => false, 'url' =>  'localhost/yii2_svn/web/'.$path]); 
//echo  $pathstr=Html::img($val['filepath'],['class'=>'file-preview-image',"width"=>"200px","height"=>"100px"]).",";
if($nams[1]=='mp4'){
echo \wbraganca\videojs\VideoJsWidget::widget([
        'options' => [
            'class' => 'video-js vjs-default-skin vjs-big-play-centered',
            //'poster' => "http://www.videojs.com/img/poster.jpg",
            'controls' => true,
            'preload' => 'auto',
            'width' => '970',
            'height' => '400',
        ],
        'tags' => [
            'source' => [
                ['src' => Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'], 'type' => '']
            ],
            
        ]
    ]);

//$pathstr[]=$val['path'];
}
else if($nams[1]=='pdf'){
$filepath=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];
echo "<embed src=\"$filepath\" width=\"100%\" height=\"500\"  alt =\"pdf\">";
}
else if($nams[1]=='ppt'){
$filepath=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];
echo "<iframe src=\"http://docs.google.com/gview?url=$filepath&embedded=true\" style=\"width:100%; height:500px;\" frameborder=\"0\"></iframe>";
}
else
{
echo  $pathstr=Html::img($val['filepath'],['class'=>'file-preview-image',"width"=>"200px","height"=>"100px"]).",";
}
}

echo "</pre>";

?>
    
<style>
.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
}

.video-container iframe,
.video-container object,
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
</div>
