<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SharingRules */

$this->title = 'Create Sharing Rules';
$this->params['breadcrumbs'][] = ['label' => 'Sharing Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sharing-rules-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
