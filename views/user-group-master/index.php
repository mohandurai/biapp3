<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserGroupMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Group Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Group Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'group_id',
            'title',
            'description',
            //'group_code',
            //'modified_date',
            // 'modified_by',
             'created_date',
            // 'created_by',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
