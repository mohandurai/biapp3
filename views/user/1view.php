<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


<style type="text/css">
.nav-tabs > li > a{
border:2px solid darkgray;
border-radius: 0;
padding: 15px 15px;
color:#000;

}

.nav > li > a:hover, .nav > li > a:focus{
background:red;
color: #fff;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
background:red;
color: #fff;
}

.table tbody{
border-top: 5px solid #6d7579;
}
.nav-tabs{
/*border:1px solid;*/
}
</style>


<ul id = "myTab" class = "nav nav-tabs">
   <li class = "active">
      <a href = "#home" data-toggle = "tab" id="0" class="pointer">
         User Basic
      </a>
   </li>
   <li><a id="1" href = "#cy" data-toggle = "tab" class="pointer">Competency</a></li>
   <li><a id="2" href = "#nrw" data-toggle = "tab" class="pointer">Neev Related Work</a></li>
   <li><a id="3" href = "#jd" data-toggle = "tab" class="pointer">Job Description</a></li>
</ul>

<div id = "myTabContent" class = "tab-content">

   <div class = "tab-pane fade in active" id = "home">
      <p style	="margin-top:10px;">
       
      <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'first_name',
            'last_name',
         //   'auth_key',
        //    'password_hash',
        //    'password_reset_token',
            'email:email',
            'status',
'role',
//'dp',
    	 [
	  'attribute'=>'dp',
	'value'=> $model->bunit->business_unit_name,
            ],
//'role_id',
//'reports_to',
 	[
	  'attribute'=>'reports_to',
	  'value'=> $model->reportuser->username,
        ],
//'employee_id',
'mobile',
//'last_updated_by',
//'sms_status',
//'login_status',
//'loginLastLock',
//'loginAttempt',
'email_id',
'date_of_birth',
'qualification',
//'department',
	[
		'attribute'=>'department',
		'value'=> $model->departmentname->department_name,
	],
'pincode',
'country',
'zone',
'state',
'city',
'area',
'territory',
'supervisor',
//'reports_to_role',
//'competency',
//'subcompetency',
//'dealership',
	[
		'attribute'=>'dealership',
		'value'=> $model->dealername->dealership_name,
	],
'co_ordinator',
//'usergroup',
//'channel',
	[
		'attribute'=>'channel',
		'value'=> $model->channelname->channel_name,
	],
//'function',
//'company',
//'businessunit',
'leader',
'color',

'date_of_joining',
'date_of_promotion',
'exp_current_job',
'exp_prevoius_job',
'total_exp',
'date_of_leaving',
//'remarks',
'created_by',
'modified_by',
'qualification_date',
'gender',
'street_name',
//'neev_designation',
//'mobile_no',
//'contest_designation',
'segment',

	[                     
            'attribute' => 'created_at',
            'value' => date("Y-m-d H:i:s",  strtotime(gmdate("Y-m-d H:i:s", $model->created_at ) )+ + 5 * 3600 + 30 * 60 ),
        ],
	[                     
            'attribute' => 'updated_at',
            'value' => date("Y-m-d H:i:s",  strtotime(gmdate("Y-m-d H:i:s", $model->updated_at ) )+ + 5 * 3600 + 30 * 60 ),
        ],

           // 'created_at',
          //  'updated_at',
        ],
    ]) ?>
      </p>
   </div>
   
   <div class = "tab-pane fade" id = "nrw">
      <p>
      </p>
   </div>
   
   <div class = "tab-pane fade" id = "cy">
      <p>
      </p>
   </div>
   <div class = "tab-pane fade" id = "jd">
      <p>
      </p>
   </div>
   
   
</div>
 
</div>



