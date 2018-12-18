<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpspeakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planning Calendar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plancalendar-index">

 <!--   <h1><?= Html::encode($this->title) ?></h1>  -->

 <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 <iframe src="./plancalendar/index.php" width="100%" height="500px" scrolling="yes"></iframe> 

<?php 
//require_once "./sms/leaderspeak.php";
//require_once "footer.php";
?>
