<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SegmantMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Segmant Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="segmant-master-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Segmant Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
          //  'created_date',
        //    'created_by',
            // 'modified_date',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
