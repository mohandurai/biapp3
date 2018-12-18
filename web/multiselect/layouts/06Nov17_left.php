<?php
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use kartik\sidenav\SideNav;
use yii\helpers\Url;

use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use dosamigos\datepicker\DateRangePicker;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$name = @Yii::$app->user->identity->username;
$pass1 = @Yii::$app->user->identity->password_hash;
$pass = hash('md4',$pass1); 
?>

<aside class="left-side sidebar-offcanvas" style="max-height: 300px; overflow: auto;">

    <section class="sidebar">

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat">
                            <i class="fa fa-search"></i></button>
                    </span>
            </div>
        </form>

<?php


$p1 = explode("/",$_SERVER['REQUEST_URI']);

if (isset($_SERVER['HTTPS']) &&
  ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
  isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
  }
else {
    $protocol = 'http://';
}

$p2 = explode("%2F",$p1[3]);

$siteid = $p2[1];



$_SESSION['login_id']= @Yii::$app->user->identity->username;

$items = [
                    [
                        'label' => '<span class="fa fa-angle-down"></span><span class="text-info">Menu Yii2</span>',
                        'url' => '#'
                    ],
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
	             ['label' => '<span class="fa fa-dashboard"></span> Leads', 'url' => ['/leads/index']],
 ['label' => '<span class="fa fa-dashboard"></span> Users', 'url' => ['/user/index']],
 ['label' => '<span class="fa fa-dashboard"></span> Contact', 'url' => ['/site/contact']],
];






if(Yii::$app->user->can('create-lead'))
{

$items[]= ['label' =>'Permissions' , 'url' => ['/admin/']];
}
?>

<?php

function  admincheck2()
{
if( !empty(Yii::$app->user->identity->username))
return  false;
}



function  admincheck()
{
if(Yii::$app->user->identity->role != "admin")
return  false;
}





function  admincheck1()
{
if(Yii::$app->user->identity->role == "admin")
return true;
else
return(

     Yii::$app->controller->module->controller->id =='import' && Yii::$app->controller->module->controller->action->id == 'log'
   

	)? true : false;



}














$callback = function($menu){
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'], 
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
};

// $cmenus=MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback);



$newitems=MenuHelper::getAssignedMenu(Yii::$app->user->id,null,null,true);



echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'encodeLabels' => false,
 //  'heading' => '<i class="glyphicon glyphicon-superscript"></i> Operations',
   'items' => [
        [
            'url' => ['/site/index'],
             'label' => Yii::t('app', 'Home'),
            'icon' => 'home',
	   //  'active' =>true ,
        ],

 

	['label' => 'Marketing Potential', 'icon'=>'hand-left', 'url'=>['/site/marketingpotential'], 'options'=> ['id'=>'markpot'], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'),'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential')||Yii::$app->user->can('/site/marketingpotential/*')||Yii::$app->user->can('/*')) ? true : false,],
// ,'contid'=>'91'
['label' => 'Secondary Sales', 'icon'=>'hand-left', 'url'=>['/site/secondarysales'], 'options'=> ['id'=>'secsales'], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales')||Yii::$app->user->can('/site/secondarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Home to Home', 'icon'=>'hand-left', 'url'=>['/site/sales'], 'options'=> ['id'=>'sales'], 'active'=>(@Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales')||Yii::$app->user->can('/site/sales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Brand Ideator', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'brandidea'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Media', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'media'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Tertiary Sales', 'icon'=>'hand-left', 'url'=>['/site/tertiarysales'], 'options'=> ['id'=>'tersales'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales')||Yii::$app->user->can('/site/tertiarysales/*')||Yii::$app->user->can('/*')) ? true : false,],

		

		
  
		   
		 
        
   		
  



 [
            'label' => 'Admin panel',
            'icon' => 'cog',
            'options'=> ['id'=>'admin'],
	    
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
]);


if(Yii::$app->user->identity->id!=null) {

?>

<!-- <hr style="background-color: #fff; border-top: 2px dashed #8c8b8b;"> -->

<center>
    <button id="toggle-Period" style="display:none; font-weight: bold; color:blue; font-size: 12px;">Period Selection</button>
</center>

<div id="filter-area" style="display:none; border: 1px solid;
      padding: 10px; 
      resize: vertical;
      overflow: auto;">

<?php

$data = array(0=>"None",5=>"Yearly",1=>"Half-Yearly",2=>"Quarterly",3=>"Monthly",4=>"From & To Date");

if(isset($_GET['ptype'])) {
    $setPType = $_GET['ptype'];
    $yr1 = $_GET['year'];
    $setYr = explode(",",$yr1);
    $setYrsview=$_GET['view'];
    $setYrs = array_values(array_filter($setYr));
    //echo "<pre>";
    //print_r($b);
    //echo "</pre>";
    $disp = "";
    $disp1 = "";
} else {
    $setPType = "";
    $disp = "display:none;";
    $disp1 = "display:none;";
    $setYr = array();
}

// Multiple select without model
echo Select2::widget([
    'name' => 'prdtype',
    'value' => $setPType,
    'data' => $data,
    'options' => ['id' => 'prdtype', 'multiple' => false, 'placeholder' => 'Select Type ...']
]);


if (strpos($siteid, 'marketingpotential') !== false) { 
  $disp1 = "display:none;";
}

?>

<div id="year-view" style="<?php echo $disp1; ?>">
<span style="margin-top:15px; color:white;">Select View:</span>
<?php

$datav = array(0=>"Cumulative",1=>"Mixed",2=>"Range",3=>"Growth");

// Multiple select without model
echo Select2::widget([
    'name' => 'yearview',
    'value' => $setYrsview,
    'data' => $datav,
    'options' => ['multiple' => false]
]);

?>

</span>
</div>



<div id="year-area" style="<?php echo $disp; ?>">
<span style="margin-top:15px; color:white;">Select Year:</span>
<?php

$data = array(0=>"None",2011=>2011,2012=>2012,2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017);

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => $setYrs,
    'data' => $data,
    'options' => ['multiple' => true, 'placeholder' => 'Select Year(s) ...']
]);

?>

</div>



<div id="hly-area" style="display:none;">

<span style="color:white;">Select Year:</span>

<?php

$data = array(0=>"None",2011=>2011,2012=>2012,2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017);

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => '',
    'data' => $data,
    'options' => ['multiple' => false, 'placeholder' => 'Select Year ...']
]);

$data1 = array(0=>"None","H1"=>"1-Half","H2"=>"2-Half");

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => '',
    'data' => $data1,
    'options' => ['multiple' => true, 'placeholder' => 'Select ...']
]);

?>

</div>




<div id="qty-area" style="display:none;">

<span style="color:white;">Select Year:</span>

<?php

$data = array(0=>"None",2011=>2011,2012=>2012,2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017);

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => '',
    'data' => $data,
    'options' => ['multiple' => false, 'placeholder' => 'Select Year ...']
]);

$data1 = array(0=>"None","Q1"=>"1-Qtr","Q2"=>"2-Qtr","Q3"=>"3-Qtr","Q4"=>"4-Qtr");

echo "</br>";

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => '',
    'data' => $data1,
    'options' => ['multiple' => true, 'placeholder' => 'Select ...']
]);

?>

</div>





<div id="mth-area" style="display:none;">

Select Year:
<?php

$data = array(0=>"None",2011=>2011,2012=>2012,2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017);

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'value' => '',
    'data' => $data,
    'options' => ['multiple' => false, 'placeholder' => 'Select Year ...']
]);

$data1 = array(0=>"None",1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");

// Multiple select without model
echo Select2::widget([
    'name' => 'mth',
    'value' => '',
    'data' => $data1,
    'options' => ['multiple' => true, 'placeholder' => 'Select Month(s) ...']
]);

?>

</div>




<div id="date-area" style="display:none;">

From Date :
<?= DatePicker::widget([
    'name' => 'fromdate',
    'value' => date("d-m-Y"),
    'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy'
        ]
]);?>

</br>
To Date :
<?= DatePicker::widget([
    'name' => 'todate',
    'value' => date("d-m-Y"),
    'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'dd-mm-yyyy'
        ]
]);?>

</div>

</div>


<center>
    <button id="toggle-Category" style="display:none; font-weight: bold; color:blue; font-size: 12px;">Category Selection</button>
</center>
 
 
<div id="filter-area1" style="display:none; border: 2px solid;
      padding: 5px; 
      resize: vertical;
      overflow: auto;">

<?php

$urlFilter = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/multiselect/test.php?domname=".$siteid;

?>


<iframe id="category-area" src="<?php echo $urlFilter; ?>" frameBorder="0" width="290px" height="220px"></iframe>

<input type="hidden" id="myAnchor">

</div>

<?php } ?>

</section>

</aside>

