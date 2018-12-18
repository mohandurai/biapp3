<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SegmantMaster */

$this->title = 'Create Segmant Master';
$this->params['breadcrumbs'][] = ['label' => 'Segmant Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="segmant-master-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
