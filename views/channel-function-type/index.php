<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChannelFunctionTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Channel Function Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-function-type-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Channel Function Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'channel_function_id',
            'channel_function_name',
            'channel_function_description',
           // 'created_by',
          //  'created_date',
            // 'modified_by',
            // 'modified_date',
            // 'bunit_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
