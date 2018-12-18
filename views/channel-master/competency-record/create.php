<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CompetencyRecord */

$this->title = 'Create Competency Question';
$this->params['breadcrumbs'][] = ['label' => 'Competency Question', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competency-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
