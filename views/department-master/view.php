<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMaster */

$this->title = $model->department_id;
$this->params['breadcrumbs'][] = ['label' => 'Department Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-master-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->department_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->department_id], [
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
            'department_id',
            'department_code',
            'department_name',
            'created_date',
            'created_by',
            'modified_date',
            'modified_by',
        ],
    ]) ?>

</div>
