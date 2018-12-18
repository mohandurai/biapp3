<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;
use app\models\Import;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CountryMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Import CSV Log';
$this->params['breadcrumbs'][] = $this->title;

function get_user($id)
{
return Import::getCreatedBy($id);
}
?>
<div class="import-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			//id, model, total_records, success_records, error_records, success_path, success_file,error_path, error_file, created_by, created_date
			'id',
			'model',
			//'total_records',
			//'success_records',
			//'error_records',
			[
            'label' => 'Total Records',
            'format' => 'raw',
            'value' => 'total_records',
            'contentOptions'=>['style'=>'max-width: 50px;']
			],
			[
            'label' => 'Success Records',
            'format' => 'raw',
            'value' => 'success_records',
            'contentOptions'=>['style'=>'max-width: 50px;']
			],
			[
            'label' => 'Error Records',
            'format' => 'raw',
            'value' => 'error_records',
            'contentOptions'=>['style'=>'max-width: 50px;']
			],
			[
			'attribute' => 'created_by',
			'format' => 'raw',
			'value'=>function ($data) {
			//return Html::a(Html::encode("View"),'site/index');
			return get_user($data['id']);
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
			'attribute' => '',
			'format' => 'raw',
			'value'=>function ($data) {
				return Html::a(Html::encode("View"),'index.php?r=import/view&id='.$data['id']);
			},
			],

		],
    ]); ?>

</div>
