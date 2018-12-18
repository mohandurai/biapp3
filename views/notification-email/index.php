<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationEmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-email-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Notification Email', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'module',
            'emp_id',
            'email:email',
            //'cc:ntext',
            'subject',
            // 'text',
            'sch_date',
            // 'delivery_status',
            // 'delivery_time',
            // 'created_date',
            // 'created_by',
            // 'modified_date',
            // 'status',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
