<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StateMaster */

$this->title = $model->s_id;
$this->params['breadcrumbs'][] = ['label' => 'State Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->s_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->s_id], [
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
           // 's_id',
            'state_code',
            'state_name',
           // 'c_id',
           // 'zone_id',
           // 'created_by',
            //'created_date',
            //'modified_by',
           // 'modified_date',
        ],
    ]) ?>

</div>
