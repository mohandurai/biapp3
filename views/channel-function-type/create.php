<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChannelFunctionType */

$this->title = 'Create Channel Function Type';
$this->params['breadcrumbs'][] = ['label' => 'Channel Function Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-function-type-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
