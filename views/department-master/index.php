<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Department Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-master-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Department Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'department_id',
            'department_code',
            'department_name',
            'created_date',
            'created_by',
            // 'modified_date',
            // 'modified_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
