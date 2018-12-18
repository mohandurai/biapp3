<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatedListsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Related Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="related-lists-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Related Lists', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'first_table',
           // 'second_table',
           // 'first_table',
           // 'second_table',
           // 'first_table_key',
           // 'second_table_key',
             'model_name',
             'query:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
