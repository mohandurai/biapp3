<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CandidateListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Candidate Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'first_name',
            'last_name',
            'email:email',
            //'role_id',
            [
                'attribute'=>'role',
                'label'=>'Role',
                'value'=>'role.description'
            ],
            [
                'label'=>'Download CV',
                'format' => 'raw',
                'value'=>function ($model) {
                           
                            $url = ['web/download1.php', 'id' => $model->id]; 
                        if(!empty($model->document)){ 
                            return Html::a('Download', 'download1.php?id='.$model->id.'&module=CandidateList', [
                                    'title' => Yii::t('yii', 'Select'),'class' => 'btn btn-primary-sel'
                            ]);  
                        }
                        else{
                            return '';
                        }
                       
                },
            ],
           [
                'label'=>'Created Date',
                //'format' => 'raw',
'attribute' =>  'created_date',
                'value'=>function ($model) {
                           
                           $datetime=$model->created_date;
			   $datetime1=strtotime($datetime);
			  $date=date('d-M-Y',$datetime1);
                            return $date;
                                             
                },
            ],
            [
                //'label'=>'Download',
                'format' => 'raw',
                'value'=>function ($model) {
                    
                    return Html::a('Add User', ['site/createuser','candidateid'=>$model->id], [
                                    'title' => Yii::t('yii', 'Add User'),'class' => 'btn btn-primary-sel'
                            ]); 
                }
            ]
            //'created_by',
            //'created_date',
            // 'modified_by',
            // 'modified_date',
            // 'status',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
