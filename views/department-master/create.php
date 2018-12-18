<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMaster */

$this->title = 'Create Department Master';
$this->params['breadcrumbs'][] = ['label' => 'Department Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-master-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
