<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountryMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Country Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'country_code',
            'country_name',
          //  'created_by',
         //   'created_date',
            // 'modified_by',
            // 'modified_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
