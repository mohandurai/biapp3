<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CandidateListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Candidate Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.right-side > .content-header > .breadcrumb {
	margin-top:0px!important;
	}
</style>
<div class="candidate-index ie-botscrol">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create  Candidate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'label'=>'Download',
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
            //'created_by',
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
            // 'modified_by',
            // 'modified_date',
            // 'status',

                       ['class' => 'yii\grid\ActionColumn',
			'template' => '{view}{update}',
			
			'buttons' => [
     
	
	 'view' => function ($url, $model) {
		     return Html::a('View', Url::toRoute(['/candidate-list/view', 'id' => $model->id]), [
                                    'title' => Yii::t('yii', 'Select'),'class' => 'btn btn-primary-sel'
                            ]); 

        },
		 'update' => function ($url, $model) {
		     return Html::a('Update', Url::toRoute(['/candidate-list/update', 'id' => $model->id]), [
                                    'title' => Yii::t('yii', 'Select'),'class' => 'btn btn-primary-sel'
                            ]); 

        }
    
                
    
    ]
	
			//  test
			],
        ],
    ]); ?>

</div>
