<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ZoneMaster */

$this->title = 'Create Zone Master';
$this->params['breadcrumbs'][] = ['label' => 'Zone Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zone-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
