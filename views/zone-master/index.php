<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZoneMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zone Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Zone Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'zone_name',
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
                'label'=>'Modified Date',
                //'format' => 'raw',
'attribute' =>  'modified_date',
                'value'=>function ($model) {
                           
                           $datetime=$model->modified_date;
			   $datetime1=strtotime($datetime);
			  $date=date('d-M-Y',$datetime1);
                            return $date;
                                             
                },
            ],
      //      'modified_date',
            'created_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
