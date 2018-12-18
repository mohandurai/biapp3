<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DealershipMaster */

$this->title = 'Create Dealership Master';
$this->params['breadcrumbs'][] = ['label' => 'Dealership Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealership-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
