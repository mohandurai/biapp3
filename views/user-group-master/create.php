<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserGroupMaster */

$this->title = 'Create User Group Master';
$this->params['breadcrumbs'][] = ['label' => 'User Group Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
