<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MobileIconsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mobile Icons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-icons-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mobile Icons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'icon_id',
            'model_label_name', 
            
           // 'img_path:ntext',
            [
'format' =>  ['image',['width'=>'100','height'=>'100']],
'value'=>function($data) { return $data->img_path; },

   ],
 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
