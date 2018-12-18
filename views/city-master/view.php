<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CityMaster */

$this->title = $model->city_id;
$this->params['breadcrumbs'][] = ['label' => 'City Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->city_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->city_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'city_id',
            'city_name',
            'created_by',
//            'created_date',
 [                     
            'attribute' => 'created_date',
            'value' => date("d-M-Y",  strtotime($model->created_date)),
        ],
           /* 'modified_by',
           // 'modified_date',
[                     
            'attribute' => 'modified_date',
            'value' => date("d-M-Y",  strtotime($model->modified_date)),
        ],*/
            's_id',
            'postal_code',
        ],
    ]) ?>

</div>
