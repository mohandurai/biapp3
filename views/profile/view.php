<?php

//use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;
use cics\widgets\VideoEmbed;
use \yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\db\Command ;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\db\Query;
$connection = \Yii::$app->db;
use yii\widgets\Pjax;
use yii\web\UploadedFile;
use yii\bootstrap\Modal;
require_once("db.php");

/* @var $this yii\web\View */
/* @var $model app\models\NeevCareerpath */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Job Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css" media="screen">
    .video-ul { width: 90%; height: 330px; overflow-y: scroll; list-style: none; margin-top: 10px; margin-bottom: 10px }
    .video-li {list-style: none; margin-top: 10px; margin-bottom: 10px; }
    ul #images { text-align: center; list-style: none; margin-top: 10px; margin-bottom: 10px; }
    #footer { margin-top: 20px;}

    .thumb1 li
    {
      border-bottom: 2px solid rgb(255, 0, 0);
      margin-bottom: 10px;
    }

    .thumb1 video
    {
      vertical-align: middle;
      margin-right: 15px;

    }
    .video-image
    {

      margin-top: 10px;
      margin-bottom: 10px;
      margin-right: 15px;
    }

    .thumb1 embed
    {
      vertical-align: middle;
      margin-top: 10px;
      margin-bottom: 10px;
      margin-right: 15px;
    }

    .thumb1
    {
      float: left;
      width: 40%;
    }

    .main-video
    {
      float: left;
      width:60%;
    }

    .main-video video
    {
      width: 100% !important;
      height: auto !important;

    }

    .thumb1 img
    {
      margin-top: 10px;
      margin-bottom: 10px;
      vertical-align: middle;
      margin-right: 15px;
    }

    .video-ul
    {
      width: 100% !important;
    }

    .thumb1 iframe
    {

      vertical-align: middle;
      padding-top: 10px;
      padding-bottom: 10px;
      margin-right: 15px;

    }

    .thumb a
    {
      margin-left: 15px;
    }

    @media screen and (max-width:960px)
{

   .thumb1
    {
      clear: both !important;
      width: 98%;
      margin-top: 20px !important;
    }

    .main-video
    {
      clear: both !important;
      width:99%;
    }
}
  </style>

   <style>
.imgclass
{
height:50px;
width:50px;
}
</style>

<script>

$(document).ready(function(){ 
    $('img.downloadable').click(function(){
        var $this = $(this);
        $this.wrap('<a href="' + $this.attr('src') + '" download />')
    });
});
</script>
<div class="neev-careerpath-view ">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
<div class="main-video">

<?php
Modal::begin([
'header'=>'<h4></h4>',
'id'=>'modal',
'size'=>'modal-lg'
]);
echo "<div id='modalContent'>";
echo "</div>";
Modal::end();
?>

 <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
<?
$modid=$model->id;
  $query1="SELECT * FROM documentsupload A inner join profile B on A.modid=B.id  WHERE A.module='Profile' and A.modid='".$modid."'";
$r=mysql_query($query1);
while($r1=mysql_fetch_array($r))
{
$download=$r1['filepath'];
$name=$r1['filename'];
$mime=$r1['mime_type'];
}
?>
 <? echo Html::a('Download', 'download2.php?id='.$model->id.'&module=Profile', [
                                    'title' => Yii::t('yii', 'Download'),'class' => 'btn btn-primary-sel'
                            ]);  ?>
 
    </p>

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'careerpath_id',
            'career_role',
            'careerpath_title',
            'content_type',
           [
                'label' => 'Created By',
                'value'=> $model->useruser->username,
            ],
            [
                'label' => 'Modified By',
                'value'=> $model->myuser->username,
            ],
            [
                'label' => 'Created Date',
                'value'=> $model->created_date,
            ],
            [
                'label' => 'Modified Date',
                'value'=> $model->modified_date,
            ],
        ],
    ])*/ ?>

</div>
</div>


<?php 

$query="SELECT * FROM documentsupload A inner join profile B on A.modid=B.id  WHERE A.module='Profile' and A.modid='".$model->id."' and mime_type='".pdf."'";
$path_arr=Yii::$app->db->createCommand($query)->queryAll(); 
$pathstr="";
foreach($path_arr as $val)
{
    //print_r($val);
    
    $fieltype=explode("/",$val['mime_type']);
              $mimetype=($fieltype[0]);
    
        
//echo $val['mime_type'];        
    switch($mimetype)
            {
                case "video":
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
            break; 
                case "image":
            $items = [
                [
                    'url' =>Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'],
                    'src' =>Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'],
                    'options' => array('title' => 'Camposanto monumentale (inside)')
                ]
            ];
            echo dosamigos\gallery\Gallery::widget(['items' => $items]);
            break;

            case "xls":
            require_once "excel_reader2.php";
            Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));
            $filepath=Yii::getAlias('@anyname')."/web/".$val['filepath'];
           // exit;
            //Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));
            //echo $excelurl=Yii::getAlias('@anyname');
            
            //$filepath=Yii::getAlias('@anyname')."/web/uploads/Hershey Tuneem 2 Pro Ticket Tracker-08-Jan-20166.xls";
            $filepath1=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];
            $data = new Spreadsheet_Excel_Reader($filepath);
            $data1=$data->dump(true,true);
				echo "<div class='extbl'>";
            echo "<table style='height:10px; width:10px;'>";
            echo "<tr>";
            echo "<td>";
            echo $data1;
            echo "<a href='$filepath1' class='btn btn-info'><img src='' alt='Download File' >
    </a>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";            
            break;
/*
            case "xlsx":
            require_once "XLSXReader.php";
            Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));
            $filepath=Yii::getAlias('@anyname')."/web/".$val['filepath'];
           // exit;
            //Yii::setAlias('@anyname', realpath(dirname(__FILE__).'/../../'));
            //echo $excelurl=Yii::getAlias('@anyname');
            
            //$filepath=Yii::getAlias('@anyname')."/web/uploads/Hershey Tuneem 2 Pro Ticket Tracker-08-Jan-20166.xls";
            $filepath1=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];            
            $data = new XLSXReader($filepath);                    

            echo "<table style='height:10px; width:10px;'>";
            echo "<tr>";
            echo "<td>";
            echo $data;
            echo "<a href='$filepath1' class='btn btn-info'><img src='' alt='Download File' >
       
    </a>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            
            break;
            */

            

            case "application":
             $filepath=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];
            if($fieltype[1]!='pdf')
            {

                //echo "haaiii";
             echo "<iframe src=\"http://docs.google.com/gview?url=$filepath&embedded=true\" style=\"width:100%; height:500px;\" frameborder=\"0\"></iframe>";
            }
            else
            {
            echo "<embed src=\"$filepath\" width=\"100%\" height=\"500\"  alt =\"pdf\">";
            }
            break;
            case "zip":
              $filepath=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];         
             echo "<iframe src=\"$filepath\" style=\"width:100%; height:500px;\" frameborder=\"0\"></iframe>";
             break;          
            
            default:
            
            $filepath=Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()."/".$val['filepath'];
            echo "<embed src=\"$filepath\" width=\"100%\" height=\"500\" >";

            }   
}
?>

   
