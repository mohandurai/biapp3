<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;



/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<style type="text/css">
.modal-dialog{
margin-right: 0;
}
.modal-content{
background:#d5d9d8;
border-radius: 0;
}
.modal-footer{
border-top: none;
padding-right:30px;
}
.panel{
border:none;
border-radius: 0;
background:#b0b6b8;
box-shadow: 0 1px 1px rgba(0, 0, 0, 5);
color: #fff;
font-weight: bold;
}
.panel-body{
	padding-bottom: 0px;
	padding-top: 0px;
}
.text-muted{
color: #715d49;
font-weight: bold;
padding-top: 17px;
}
.imgbot{
margin-bottom:10px;
}
.content {
/*padding: 50px 15px 0px 15px !important;*/
}
.pull-center{
text-align: center;
}


</style>
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	 $(".profile").click(function() {
  	$("#profile").show();
   $(".congra").hide();
});



$(".user-menu" ).click(function() {
  $(".homepaimgov" ).toggle();

});



$(".innpaimg").click(function() {

$(".homepaimgov" ).hide();

});




$(".homepaimgov").click(function()
{

$(".homepaimgov" ).hide();

});





});
</script>


<header class="header">





<nav class="navbar navbar-static-top" role="navigation">
<div class="col-md-2 logo">
	<img src="images/brandideaAnalytics_logo.png" alt="BrandIdea Analytics">
	<a id="sidebarCollapse" class="pull-right">  <i class="fa fa-align-justify"></i></a>
</div>

<div class=" llor col-md-10 header-nav">
	<div class="row">

<?php echo Nav::widget([
    // 'type' => SideNav::TYPE_DEFAULT,
    'encodeLabels' => false,

 //  'heading' => '<i class="glyphicon glyphicon-superscript"></i> Operations',
   'items' => [
     //    [
     //        'url' => ['/site/index'],
     //         'label' => Yii::t('app', 'Home'),
     //        'icon' => 'home',
	   // //  'active' =>true ,
     //    ],



 ['label' => '<span ><img src="images/icons/mkt-pot.png" alt="miaro project "></span> Market Potential',  'url'=>['/site/marketingpotential','category'=>1],'options'=> ['id'=>'markpot','category'=>1,'class'=>'menu-nav' ], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'),'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential/*')||Yii::$app->user->can('/*')) ? true : false,],
// ,'contid'=>'91'
['label' => '<span><img src="images/icons/delivery-van.png" alt="miaro project "></span> Secondary Sales', 'icon'=>'hand-left', 'url'=>['/site/secondarysales'], 'options'=>['id'=>'secsales','category'=>4,'class'=>'menu-nav'], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

// ['label' => '<span class="glyphicon glyphicon-home"></span> Home to Home', 'icon'=>'hand-left', 'url'=>['/site/sales'], 'options'=> ['class'=>'menu-nav'], ['id'=>'sales'], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => '<span><img src="images/icons/brand-ideator.png" alt="miaro project "></span> Brand Ideator', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'brandidea','class'=>'menu-nav'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => '<span><img src="images/icons/media.png" alt="miaro project "></span> Media', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'media','category'=>2,'class'=>'menu-nav'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => '<span><img src="images/icons/shoping-man.png" alt="miaro project "></span> Tertiary Sales', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'tersales','category'=>5,'class'=>'menu-nav'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

 [
            'label' => '<span><img src="images/icons/setting.png" alt="miaro project "></span> Admin panel',
            'icon' => 'cog',
            'options'=> ['id'=>'admin','class'=>'menu-nav'],

            'items' => [
             ['label' => 'User Master', 'icon'=>'', 'url'=>['/user/index'], /*'active'=>(Yii::$app->controller->module->controller->id == 'user'),*/ 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/user/index')||Yii::$app->user->can('/user/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/user/*')) ? true : false,],
             ['label' => 'Menu Master', 'icon'=>'', 'url'=>['/bi-menus/index'], 'visible' => (Yii::$app->user->can('user-signup') || Yii::$app->user->can('/bi-menus/index')||Yii::$app->user->can('/bi-menus/view')||Yii::$app->user->can('/bi-menus/*')) ? true : false,],
              ['label' => 'Profile Log', 'icon'=>'', 'url'=>['/profile-log/index'], 'visible' => (Yii::$app->user->can('user-signup') || Yii::$app->user->can('/profile-log/index')||Yii::$app->user->can('/profile-log/view')||Yii::$app->user->can('/profile-log/*')) ? true : false,],
 ['label' => 'Menu Allocation ', 'icon'=>'', 'url'=>['/menu-allocation/index'],  'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/menu-allocation/index')||Yii::$app->user->can('/menu-allocation/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/menu-allocation/*')) ? true : false,],


	  ['label' => 'Location Master', 'icon'=>'', 'url'=>['/location-master/index'],  'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/location-master/index')||Yii::$app->user->can('/location-master/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/location-master/*')) ? true : false,],


                ['label' => 'Roles And Profiles', 'icon'=>'', 'target'=>"_blank", 'url'=>['/admin/'], 'active'=>(Yii::$app->controller->module->controller->id == 'admin'), 'visible' => (Yii::$app->user->can('/admin/role/*')||Yii::$app->user->can('/*')) ? true : false,],



            ],
        ],
  ],


//	'items'=>$newitems,
]); ?>


<!-- <input type='text' id="custom" /> -->
<ul class="nav navbar-nav">

<?php
if (Yii::$app->user->isGuest) {
    ?>
    <li class="dropdown tasks-menu">
        <?= Html::a('Login', ['/site/login']) ?>
    </li>
<?php
} else {
$role = @Yii::$app->user->identity->role;
$arr = explode("_",$role);
unset($arr[0]);
?>
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i>
            <span><?= ucfirst(@Yii::$app->user->identity->first_name) . " " . ucfirst(@Yii::$app->user->identity->last_name) ?>
            <i class="caret"></i>
			<!-- <span style="padding-left:16%;font-size:11px;"><?= implode($arr); ?></span> -->
            </span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
      <img src="<?= @Yii::$app->user->identity->profile_image_url?>" class="img-circle" alt="User Image"/>

                <p>
     <?= ucfirst(@Yii::$app->user->identity->first_name) . " " . ucfirst(@Yii::$app->user->identity->last_name) ?> - <?= ucfirst(@Yii::$app->user->identity->role) ?>
                    <?php
                    $cdate = @Yii::$app->user->identity->created_at;
                    ?>
                    <small>Member since <?php echo date('F j, Y', $cdate) ?></small>
                </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">

            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <!--<div class="pull-left profile">
                    <a class="btn btn-default btn-flat">Profile</a>
                </div>-->

                <div class="pull-center">
                    <?= Html::a(
                            'Sign out',
                            ['/site/logout'],
                            ['data-method' => 'post','class'=>'btn btn-success']
                        ) ?>
                </div>
            </li>
        </ul>
    </li><?php
}
?>
<!-- User Account: style can be found in dropdown.less -->
<?php

?>
</ul>
</div>
</div>
<!--
<div class="llogo"></div>
<div class="logo"></div>
-->

</nav>
<div class="header-bottom">


							<a class="period-calendar" data-placement="bottom" data-toggle="popover" data-title="Period Selection" data-container="body"  data-html="true" id="login"><i class="glyphicon glyphicon-calendar"></i></a>
							<p>2017</p>
							<select name="language" class="form-control currency-conv">

									<option value="1">INR-Indian Rupee</option>
									<option value="2">USD-U.S Dollar</option>
									<option value="3">EUR-Euro</option>
									<option value="4">GBP-British Pound</option>
									<option value="5">JPY-Japanese Yen</option>
									<option value="6">CNY-Chinese Yuan</option>
							</select>
							<a href="#"><i class="glyphicon glyphicon-save"></i>Profile Save</a>
							<a href="#"><i class="glyphicon glyphicon-refresh"></i>Reload</a>
							<div id="popover-content" class="hide">
					      <form class="form-inline" role="form">
					        <div class="form-group">
											<div class="col-md-12">
												<div class="form-check ">
														<span class="period-title col-md-2">Period Type</span>

												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="period" > <span class="label-text">Single</span>
													</label>
												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="period" > <span class="label-text">Continuous</span>
													</label>
												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="period" > <span class="label-text">Mixed</span>
													</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-check">
														<span class="period-title col-md-2">Periodicity</span>
												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="Periodicity" > <span class="label-text">By Cal Year</span>
													</label>
												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="Periodicity" > <span class="label-text">By Qutrterly</span>
													</label>
												</div>
												<div class="form-check">
													<label>
														<input type="radio" name="Periodicity" > <span class="label-text">By Month</span>
													</label>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-check">
														<span class="period-title col-md-2">Select Period</span>
												</div>
												<select name="language" class="form-control select-dropdown col-md-8">
														<option value=""></option>
														<option value="1">2017</option>
														<option value="2">2016</option>
														<option value="3">2015</option>
														<option value="4">2014</option>
														<option value="5">2013</option>
												</select>
											</div>
					          <div class="period-submin">
					          	<button class="apply" type="submit" >Apply</button>
											<button class="close" type="submit" >Close</button>
										</div>
					        </div>
					      </form>
					    </div>


</div>
</header>
