<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MenuAllocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menu Allocations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-allocation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="content-header">
        <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i>Create Menu Allocation', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


         [
                'attribute' => 'userid',
                'value'=>'role.name',
                'label'=>'Role'
            ],

            [
                'attribute' => 'categoryid',
                'value'=>'category.category',
            ],
             [
                'attribute' => 'parentmenu',
                'value'=>'parent',
            ],
            [
                'attribute' => 'parentmenu',
                'value'=>'child',
            ],

           //'parentmenu',
           // 'childmenu',
            // 'created_by',
            // 'modified_by',
            // 'created_date',
            // 'modified_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
