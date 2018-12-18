<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OpenCoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Open Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-courses-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Open Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'course_id',
            'title',
            'description',
            'url:url',
            //'emp_id',
             [
               'attribute'=>'emp_id',
               'label' => 'Username',
                'value'=> 'createdbyuser.username',
            ],
            // 'file',
            // 'type',
            // 'rate',
            // 'comment',
            // 'role',
            // 'assigned_role',
            // 'created_by',
            // 'created_date',
            // 'modified_by',
            // 'modified_date',
             'status',
             [
               'label'=>'Result',
               'attribute' => 'rate',
                'value' => function ($data){
 return $data->rate>2 ? "Pass": ($data->rate<3 ? "Fail": "");
  }
            ],
                ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',],
        ],
    ]); ?>

</div>
