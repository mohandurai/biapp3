<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BiMenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'BI Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bi-menus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="content-header">
        <?= Html::a('<i class="glyphicon glyphicon-menu-hamburger"></i>Create BI Menus', ['create'], ['class' => 'btn btn-success']) ?>
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

            [
                'attribute'=>'category',
                'label'=>'Category',
                'value'=>function ($model) {
                      if($model->category==1) {
                        return "Marketing Potential";
                      }
                      elseif($model->category==2) {
                        return "Secondary Sales";
                      }
                      elseif($model->category==3) {
                        return "Home to Home";
                      }
                      elseif($model->category==4) {
                        return "Tertiary Sales";
                      }
                        else
                        {
                            return 'None';
                        }
                    },
            ],

            'title',

           [
                'attribute'=>'parent_id',
                'label'=>'Parent Menu',
                 'value'=>function ($model) {
                      if($model->parent_id!=0){
                        return $model->parent->title;}
                        else
                        {
                            return 'None';
                        }
                    },
            ],
            [
                'attribute'=>'active',
                'label'=>'Status',
                 'value'=>function ($model) {
                      if($model->active!=0){
                        return 'Active';}
                        else
                        {
                            return 'InActive';
                        }
                    },
            ],

            // 'level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
