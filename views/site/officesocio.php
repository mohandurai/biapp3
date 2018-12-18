<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpspeakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OffiSocio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empspeak-index">

 <!--   <h1><?= Html::encode($this->title) ?></h1>  -->

 <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <iframe src="./sms/employeeonline.php" width="100%" height="500px;" scrolling="yes"></iframe>



