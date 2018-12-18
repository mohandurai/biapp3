<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NotificationEmail */

$this->title = 'Create Notification Email';
$this->params['breadcrumbs'][] = ['label' => 'Notification Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-email-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
