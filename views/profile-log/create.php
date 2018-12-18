<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfileLog */

$this->title = 'Create Profile Log';
$this->params['breadcrumbs'][] = ['label' => 'Profile Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
