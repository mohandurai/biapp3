<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\LocationMaster;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocationMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Location Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="content-header">
        <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i>Create Location Master', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
        'firstPageLabel' => '1st',
        'lastPageLabel' => 'End',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'code',
            'lat',
            'lng',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
