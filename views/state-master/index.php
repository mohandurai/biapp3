<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StateMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'State Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create State Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 's_id',
            'state_code',
            'state_name',
         //   'c_id',
         //   'zone_id',
            // 'created_by',
            // 'created_date',
            // 'modified_by',
            // 'modified_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
