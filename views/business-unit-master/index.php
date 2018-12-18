<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusinessUnitMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dealer Principle Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-unit-master-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dealer Principle Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bunit_id',
            'business_unit_code',
            'business_unit_name',
		
           // 'business_unit_parent',

           [
                'attribute' => 'business_unit_parent',
                'value'=> 'parentuser.business_unit_name',
            ],
		

		
		[
                'attribute' => 'company_id',
                'value'=> 'company.company_name',
            ],

           // 'created_date',
            // 'created_by',
            // 'modified_date',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
