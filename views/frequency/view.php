<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Frequency */

$this->title = $model->f_id;
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frequency-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->f_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->f_id], [
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
            'f_id',
            'period',
            'status',
            [
              'attribute' => 'created_by',
          'value'=>$model->createdbyuser->username,
        ],
           // 'created_by',
            'modified_date',
                        [
              'attribute' => 'modified_by',
          'value'=>$model->modifiedbyuser->username,
        ],
        ],
    ]) ?>

</div>
