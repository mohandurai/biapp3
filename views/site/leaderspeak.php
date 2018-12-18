<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpspeakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leader Speak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empspeak-index">

 <!--   <h1><?= Html::encode($this->title) ?></h1>  -->

 <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <iframe src="./sms/leaderspeak.php" width="90%" height="700px;" scrolling="yes"></iframe> 

<?php 
//require_once "./sms/leaderspeak.php";
//require_once "footer.php";
?>
