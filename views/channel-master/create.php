<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChannelMaster */

$this->title = 'Create Channel Master';
$this->params['breadcrumbs'][] = ['label' => 'Channel Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-master-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
