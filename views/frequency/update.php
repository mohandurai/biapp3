<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Frequency */

$this->title = 'Update Frequency: ' . ' ' . $model->f_id;
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->f_id, 'url' => ['view', 'id' => $model->f_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="frequency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
