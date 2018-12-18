<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RelatedLists */

$this->title = 'Create Related Lists';
$this->params['breadcrumbs'][] = ['label' => 'Related Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="related-lists-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
