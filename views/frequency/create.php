<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Frequency */

$this->title = 'Create Frequency';
$this->params['breadcrumbs'][] = ['label' => 'Frequencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frequency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
