<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DealershipCategory */

$this->title = 'Create Dealership Category';
$this->params['breadcrumbs'][] = ['label' => 'Dealership Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealership-category-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
