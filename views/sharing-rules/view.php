<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SharingRules */

$this->title = $model->module;
$this->params['breadcrumbs'][] = ['label' => 'Sharing Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sharing-rules-view">



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
            'module',
            'sharing_access',
        ],
    ]) ?>

</div>
