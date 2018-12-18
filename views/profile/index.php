<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use dosamigos\fileupload\FileUpload;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index  ie-botscrol">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Job Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         
             [
              'attribute'=>'roles',
               'label' => 'Roles',
                'value'=> 'role.description',
            ],

            /*[
              'attribute'=>'filetype',
               'label' => 'Filetype',
                'value'=> 'filetransfer.f_name',
            ],*/

            [
                'label'=>'Download',
                'format' => 'raw',
                'value'=>function ($model) {
                           
                            $url = ['web/download2.php', 'id' => $model->id]; 
                        if(!empty($model->document)){ 
                            return Html::a('Download', 'download2.php?id='.$model->id.'&module=Profile', [
                                    'title' => Yii::t('yii', 'Select'),'class' => 'btn btn-primary-sel'
                            ]);  
                        }
                        else{
                            return '';
                        }
                       
                },

            ],
 
                       
  [
                'label'=>'Upload',
                'format' => 'raw',
                'value' => function ($model) {
                   return FileUpload::widget([
                        'model' => $model,
                        'attribute' => 'position_type['.$model->id.']',
                        //'name'=>'files['.$model->id.']',
                        'url' => ['profile/uploadfiles', 'id' => $model->id],  // your url, this is just for demo purposes,
                        'options' => ['accept' => 'image/*'],
                        'clientOptions' => [
                            'maxFileSize' => 2000000
                        ],
                        // Also, you can specify jQuery-File-Upload events
                        // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
                        'clientEvents' => [
                            'fileuploaddone' => 'function(e, data) {
                                                    console.log(e);
                                                    console.log(data);
                                                }',
                            'fileuploadfail' => 'function(e, data) {
                                                    console.log(e);
                                                    console.log(data);
                                                }',
                        ],
                    ]);
                 },
            ],
            // 'created_by',
            // 'created_date',
            // 'modified_by',
            // 'modified_date',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'label'=>'Action',
                'format' => 'raw',
             
             'value'=>function ($model) {
                           
                            $url = ['profile/view', 'id' => $model->id]; 
                     
                            return Html::a('View', $url, [
                                    'title' => Yii::t('yii', 'View'),'class' => 'btn btn-primary-sel'
                            ]);  
                       
                       
                }
           ],
        ],
    ]); ?>

</div>
