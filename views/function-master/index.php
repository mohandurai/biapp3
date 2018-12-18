<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FunctionMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Function Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="function-master-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Function Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'function_id',
            'function_code',
            'function_name',
			 [
              'attribute' => 'company_id',
	      'value'=>'company.company_name',
	    ],
		 [
              'attribute' => 'bunit_id',
	      'value'=>'bunit.business_unit_name',
	    ],
          //  'company_id',
         //   'bunit_id',
            // 'desc',
            // 'created_date',
            // 'modified_date',
            // 'created_by',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
