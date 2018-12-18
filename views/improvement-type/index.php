<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ImprovementTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Improvement Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="improvement-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Improvement Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type_id',
            'type_name',
            'created_by',
            'created_date',
            'modified_by',
            // 'modified_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
