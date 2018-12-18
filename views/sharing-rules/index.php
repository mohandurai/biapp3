<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SharingRulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sharing Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sharing-rules-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sharing Rules', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'module',
            'sharing_access',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
