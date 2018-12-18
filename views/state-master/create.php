<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StateMaster */

$this->title = 'Create State Master';
$this->params['breadcrumbs'][] = ['label' => 'State Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
