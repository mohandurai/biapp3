<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMaster */

$this->title = 'Update Department Master: ' . ' ' . $model->department_id;
$this->params['breadcrumbs'][] = ['label' => 'Department Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->department_id, 'url' => ['view', 'id' => $model->department_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-master-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
