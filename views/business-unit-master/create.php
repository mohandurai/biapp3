<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BusinessUnitMaster */

$this->title = 'Create Dealer Principle Master';
$this->params['breadcrumbs'][] = ['label' => 'Dealer Principle Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-unit-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
