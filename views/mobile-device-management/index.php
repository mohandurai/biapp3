<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MobileDeviceManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mobile Device Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mobile-device-management-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <? //= Html::a('Create Mobile Device Management', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'username',
            'device_key:ntext',
          //  'status',
		
   
        
[
'attribute' => 'status',
'format'=>'raw',

'value' =>function($data){

//$url = "http://127.0.0.1/yii2/logo.png";

return Html::dropDownList('status'.$data->id,$data->status, array("Active"=>"Active","InActive"=>"InActive","Delete"=>"Delete","Lock"=>"Lock","Reset"=>"Reset"),array("onchange"=>"test(this.value,$data->id)")) ;
//return Html::img($url,['alt'=>'yii']);

},




'filter'=>array("Active"=>"Active","InActive"=>"InActive"),

],
            // 'created_by',
            // 'created_date',
            // 'modified_by',
            // 'modified_date',
            // 'imei_no',
            // 'delivered_status',

          //  ['class' => 'yii\grid\ActionColumn'],
		    ['class' => 'yii\grid\ActionColumn','template' => '{view}',],	

        ],
    ]); ?>

</div>
<script>
function test(value,id)
{
$.ajax({
  url: 'updatestatus.php',
  data: 'value='+value+'&id='+id,
  processData: false,
  contentType: false,
  type: 'GET',
  success: function(data){
  alert(data);
   
  }
});
}
</script>