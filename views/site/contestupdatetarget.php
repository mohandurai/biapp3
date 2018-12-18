<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\User;

   $userid=Yii::$app->user->identity->id;



$this->title = 'Lead By Source';
$this->params['breadcrumbs'][] = $this->title;


//window.location="../web/leadsummary.php?d1="+d1+'&d2='+d2;

?>
<iframe src="../web/contestupdatetarget.php?userid=<?php echo $userid ?>" width="100%" height="500px;" scrolling="yes"></iframe>