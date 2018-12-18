<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MobileIcons */

$this->title = 'Update Mobile Icons: ' . ' ' . $model->icon_id;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->icon_id, 'url' => ['view', 'id' => $model->icon_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mobile-icons-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
