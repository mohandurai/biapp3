<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeographyMaster */

$this->title = 'Create Geography Master';
$this->params['breadcrumbs'][] = ['label' => 'Geography Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geography-master-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
