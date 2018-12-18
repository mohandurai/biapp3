<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserGroupMaster */

$this->title = 'Update User Group Master: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'User Group Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->group_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-group-master-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
