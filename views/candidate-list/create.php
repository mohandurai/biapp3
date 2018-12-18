<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CandidateList */

$this->title = 'Create  Candidatet';
$this->params['breadcrumbs'][] = ['label' => 'Candidate Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
