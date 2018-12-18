<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeographyMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geography Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geography-master-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Geography Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'geo_id',
            'country_code',
            //'country',
[
                  'attribute'=>'country',
                  'value'=>'country1.country_name',
             ],
           // 'state',
[
                  'attribute'=>'state',
                  'value'=>'state1.state_name',
             ],
            //'city',
 [
                  'attribute'=>'city',
                  'value'=>'city1.city_name',
             ],
            // 'area',
            // 'territory',
             'pincode',
            // 'continental',
            // 'bunit_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
