<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FunctionMaster */

$this->title = 'Create Function Master';
$this->params['breadcrumbs'][] = ['label' => 'Function Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="function-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
