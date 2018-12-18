<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelFunctionType */

$this->title = 'Update Channel Function Type: ' . ' ' . $model->channel_function_id;
$this->params['breadcrumbs'][] = ['label' => 'Channel Function Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->channel_function_id, 'url' => ['view', 'id' => $model->channel_function_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="channel-function-type-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
