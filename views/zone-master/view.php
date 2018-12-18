<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ZoneMaster */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Zone Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'zone_name',
[                     
            'attribute' => 'created_date',
            'value' => date("d-M-Y",  strtotime($model->created_date)),
        ],
           // 'created_date',
           // 'modified_date',
[                     
            'attribute' => 'modified_date',
            'value' => date("d-M-Y",  strtotime($model->modified_date)),
        ],
            'created_by',
            'modified_by',
        ],
    ]) ?>

</div>
