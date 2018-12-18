<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelMaster */

$this->title = 'Update Channel Master: ' . ' ' . $model->channel_id;
$this->params['breadcrumbs'][] = ['label' => 'Channel Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->channel_id, 'url' => ['view', 'id' => $model->channel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="channel-master-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
