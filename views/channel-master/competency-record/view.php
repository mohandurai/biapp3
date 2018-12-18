<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CompetencyRecord */

$this->title = $model->recid;
$this->params['breadcrumbs'][] = ['label' => 'Competency Question', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competency-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->recid], [
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
            'recid',
            'competency',
            'question',
            'createdby',
            'createddate',
            'modifiedby',
            'modifieddate',
        ],
    ]) ?>

</div>
