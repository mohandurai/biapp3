<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MobileIcons */

$this->title = 'Create Mobile Icons';
$this->params['breadcrumbs'][] = ['label' => 'Mobile Icons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-icons-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
