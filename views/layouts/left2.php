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

//$name = @Yii::$app->user->identity->username;
//$pass1 = @Yii::$app->user->identity->password_hash;
//$pass = hash('md4',$pass1);
// print_r( $_SESSION['is_menu']);die;
?>

<div class="col-md-2 scrollbar" id="sidebar">




<aside class="left-side sidebar-offcanvas" >

    <section class="sidebar">

        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='search' id='search-btn' class="btn btn-flat">
                            <i class="fa fa-search"></i></button>
                    </span>
            </div>
        </form> -->

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


if(Yii::$app->user->identity->id!=null) {

?>

<!-- <hr style="background-color: #fff; border-top: 2px dashed #8c8b8b;"> -->

<center>
    <button id="toggle-Period" style="display:none; font-weight: bold; color:blue; font-size: 12px;">Period Selection</button>
</center>

<div id="filter-area" style=" border: 1px solid;
      padding: 10px;
      resize: vertical;
      overflow: auto;display:none">

<?php

if (strpos($siteid, 'marketingpotential') !== false) {
  $able = false;
} else {
    $able = false;
}


if(isset($_REQUEST['ptype'])) {  ///CHANGED GET TO REQUEST BY ROBINSON
    $setPType = $_REQUEST['ptype'];
    $setAnzType = $_REQUEST['antype'];
    $yr1 = $_REQUEST['year'];
    $setYr = explode(",",$yr1);
    $setYrsview=$_REQUEST['view'];
    $setYrs = array_values(array_filter($setYr));
    //echo "<pre>";
    //print_r($b);
    //echo "</pre>";
    $disp = "";
} else {
    $setPType = "";
    $disp = "display:none;";
    $setYr = array();
}

?>

<span style="margin-top:15px; color:white;">Period Type</span>

<?php

$datav = array(0=>"None",1=>"Single",2=>"Continuous",3=>"Mixed");

// Multiple select without model
echo Select2::widget([
    'name' => 'anlztype',
    'disabled'=> $able,
    'value' => $setAnzType,
    'data' => $datav,
    'options' => ['id'=> 'anlztype', 'class'=>"period" ,'multiple' => false,'placeholder' => 'Select Period Type ...']
]);

?>

<span style="margin-top:15px; color:white;">Periodicity</span>

<?php
$data = array(0=>"None",5=>"By Cal Year",2=>"By Qtr",3=>"By Month");

// Multiple select without model
echo Select2::widget([
    'name' => 'prdtype',
    'disabled'=> $able,
    'value' => $setPType,
    'data' => $data,
    'options' => ['id' => 'prdtype', 'multiple' => false, 'placeholder' => 'Select Periodicity ...']
]);


//if (strpos($siteid, 'marketingpotential') !== false) {
  //$disp1 = "display:none;";
$disp1 = "";
//}

?>

<div id="year-view" style="<?php echo $disp1; ?>">
<span style="margin-top:15px; color:white;">View:</span>
<?php

$data2 = array(0=>"Cumulative", 2=>"Time Series", 3=>"Growth");

// Multiple select without model
echo Select2::widget([
    'name' => 'yearview',
    'value' => $setYrsview,
    'data' => $data2,
    'options' => ['multiple' => false]
]);

?>

</span>
</div>



<div id="year-area" style="<?php echo $disp; ?>">
<span style="margin-top:15px; color:white;">Year:</span>
<?php

$data = array(0=>"None",2011=>2011,2012=>2012,2013=>2013,2014=>2014,2015=>2015,2016=>2016,2017=>2017);

// Multiple select without model
echo Select2::widget([
    'name' => 'year',
    'disabled'=> $able,
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
    'options' => ['multiple' => true, 'placeholder' => 'Select Year ...']
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
    'options' => ['multiple' => true, 'placeholder' => 'Select Year ...']
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
    'options' => ['multiple' => true, 'placeholder' => 'Select Year ...']
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

<?php
if( isset($_REQUEST['r']))
{?>
<div id="filter-area1" class="fliter-area" >
<?php} else {?>
<div id="filter-area1" >
      <?php }?>
<?php
if(isset($_SESSION['combby']))
{




    if($_SESSION['combby'] != ''){
    $urlFilter = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/multiselect/test.php?domname=".$siteid.'&combby='.$_SESSION['combby'].'&comb='.$_SESSION['comb'].'&mnid='.$_SESSION['mnid'].'&categs='.$_SESSION['categs'].'&tbl='.$_SESSION['tbl'].'&year='.$_SESSION['year'].'&view='.$_SESSION['view'].'&locid='.$_SERVER['locid'].'&ptype='.$_SESSION['ptype'];
    $_SESSION['combby'] = '';
    }
    else
    {
         $urlFilter = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/multiselect/test.php?domname=".$siteid;
       }

}
else
{
    $urlFilter = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/multiselect/test.php?domname=".$siteid;
}


?>

<div id="myTabs">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#discovery" aria-controls="home" role="tab" data-toggle="tab">Discovery</a></li>
    <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Diagnostics</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Prescription</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Prediction</a></li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active" id="discovery">
            <div class="tree well">
              <form action="" method="get">
                <ul class="tree-menu-list">
                    <li class="parent">
                        <span><i class="glyphicon glyphicon-chevron-down"></i> Lifestyle Segmntn</span>
                        <ul class="collapse">
                            <li class="child">
                              <span data-placement="right" data-toggle="popover-menu" data-title="Menu" data-container="body"  data-html="true" href="#" ><i class="glyphicon glyphicon-chevron-down"></i>Lifestyle Indctr (LSI)</span>

                              <div id="popover-child" class="hide">
                                 <ul id="parent-check">
                                    <li ><span data-toggle="tooltip" data-placement="left" title="Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum."><i class="glyphicon glyphicon-chevron-down"></i><input type="checkbox" name="vehicle" value="Bike" >Lifestyle Indctr</span><ul>
                                        <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><input type="checkbox" name="vehicle" value="Bike">Lifestyle Indctr</span></li>
                                        <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><input type="checkbox" name="vehicle" value="Bike">Art Gallery / Museum</span></li>
                                        <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><input type="checkbox" name="vehicle" value="Bike">Ashram</span></li>
                                        <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><input type="checkbox" name="vehicle" value="Bike">Astrology Servc Provdr</span></li>
                                    </ul></li>
                                    <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><i class="glyphicon glyphicon-chevron-down"></i><input type="checkbox" name="vehicle" value="Bike">Art Gallery / Museum</span></li>
                                    <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><i class="glyphicon glyphicon-chevron-down"></i><input type="checkbox" name="vehicle" value="Bike">Ashram</span></li>
                                    <li data-toggle="tooltip" data-placement="left" title="Tooltip on left"><span><i class="glyphicon glyphicon-chevron-down"></i><input type="checkbox" name="vehicle" value="Bike">Astrology Servc Provdr</span></li>
                                </ul>

                					    </div>

                            </li>
                            <li class="child">
                              <span><i class="glyphicon glyphicon-chevron-down"></i> Latrine Facility of HH</span>
                                <ul>
                                  <li class="grand-child">
                                    <span><i class="glyphicon glyphicon-chevron-down"></i> Latrine Facility of HH</span>
                                      <ul>
                                          <li class="grand-child">
                                            <span> Grand Child</span>
                                          </li>
                                        </ul>
                                  </li>
                                  </ul>
                            </li>
                            <li class="child">
                              <span><i class="glyphicon glyphicon-chevron-down"></i>Gen Segmntn (Urban)</span>
                                <ul>
                                    <li class="grand-child">
                                      <span> Grand Child</span>
                                    </li>
                                </ul>
                            </li>
                            <li class="child">
                              <span><i class="glyphicon glyphicon-chevron-down"></i>Rural Cohorts</span>
                                <ul>
                                    <li class="grand-child">
                                      <span> Grand Child</span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                     <li class="parent">
                        <span><i class="glyphicon glyphicon-chevron-down"></i> Cultural Segmntn</span>
                        <ul>
                            <li class="child">
                              <span><i class="icon-leaf"></i> Child</span>
                        </li>
                    </ul>
                    </li>
                     <li class="parent">
                        <span><i class="glyphicon glyphicon-chevron-down"></i> Rural Segmntn</span>
                        <ul>
                            <li class="child">
                              <span><i class="glyphicon glyphicon-chevron-down"></i> Child</span>
                        </li>
                    </ul>
                    </li>
                     <li class="parent">
                        <span><i class="glyphicon glyphicon-chevron-down"></i> Shopper Segmntn</span>
                        <ul>
                            <li class="child">
                              <span><i class="glyphicon glyphicon-chevron-down"></i> Child</span>
                        </li>
                    </ul>
                    </li>
                </ul>
              </form>

              </div>
            </div>
    <!-- <div role="tabpanel" class="tab-pane fade in active" id="discovery"><iframe id="category-area" src="<?php echo $urlFilter; ?>" frameBorder="0" width="100%" height="350px"></iframe></div> -->
   <!-- <div role="tabpanel" class="tab-pane fade" id="profile">2</div>
    <div role="tabpanel" class="tab-pane fade" id="messages">3</div>
    <div role="tabpanel" class="tab-pane fade" id="settings">4</div> -->
  </div>

</div>

<div class="com_split">
  <span class="combine" data-toggle="collapse" data-target="#combine">Combine</span>
    <span class="split" data-toggle="collapse" data-target="#split">Split</span>

    <div id="combine" class="collapse" aria-expanded="true">
      <a href=" http://192.168.10.82/biweb9/web/index.php?r=site%2Fmarketingpotential&categs=2772_2773&comb=0&mnid=29_30&combby=2492&tbl=1054_1054_&antype=1&ptype=5&year=2015&view=0">Nos</a>
    </div>


      <div id="split" class="collapse" aria-expanded="true">
          <a href="">Values</a>
      </div>


</div>

<input type="hidden" id="myAnchor">

</div>


<?php } ?>

</section>

</aside>

</div>
