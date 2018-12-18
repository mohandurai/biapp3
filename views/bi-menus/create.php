<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BiMenus */

$this->title = 'Create Bi Menus';
$this->params['breadcrumbs'][] = ['label' => 'Bi Menuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bi-menus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
