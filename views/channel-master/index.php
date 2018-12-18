<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChannelMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Channel Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-master-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Channel Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'channel_id',
            'channel_code',
            'channel_name',
            //'channel_function_type_id',
			
			['attribute'=>'channel_function_type_id' , 'value'=>'channelfuntiontype.channel_function_name',],
			
          //  'desc',
            // 'created_date',
            // 'modified_date',
            // 'created_by',
            // 'modified_by',
            // 'channel_parent',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
