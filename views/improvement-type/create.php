<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ImprovementType */

$this->title = 'Create Improvement Type';
$this->params['breadcrumbs'][] = ['label' => 'Improvement Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="improvement-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
