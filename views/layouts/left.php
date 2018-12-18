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
use yii\widgets\Form;
use yii\helpers\ArrayHelper;
include("db.php");
session_start();
$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//$_SESSION['grid_path'] = '';
$grid_path = $_SESSION['grid_path'];
$perd=array();
?>
<style>
	/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}
/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}
.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
 -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}
/* Animation */
@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
/*loader css ends here*/
        #loading-image{
          position:absolute;
          left:100px;
          top:100px;
        }
        /** gif for chart**/
        #loading-image1{
          position:absolute;
          right:175px;
          top:100px;
        }
        /** gif for report**/
        #loading-image2{
          position:absolute;
          right:420px;
          top:300px;
        }
        /** overlay background css for super parent of all div (map,chart,report)**/
        .super{
          position:absolute;
          top:0px;
          right:0px;
          height:1000px;
          width:1000px;
        }
        .overlay {
          position: fixed;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          background: rgba(0, 0, 0, 0.7);
          transition: opacity 500ms;
          visibility: hidden;
          opacity: 0;
        }
</style>
<script type="text/javascript">
var testyear ='';
var period_t;
var cntCP= 0;
var cntCUM = 0;
var checkprd = 0;
$(document).ready(function() {
    sessionStorage.setItem('view',0);
    sessionStorage.setItem('year',2017);
    sessionStorage.setItem('categs','');
    sessionStorage.setItem('id','');
    sessionStorage.setItem('parentlvl','');
    sessionStorage.setItem('childlvl','');
    sessionStorage.setItem('combval','');
    sessionStorage.setItem('groupby','');
    sessionStorage.setItem('tbl','');
    sessionStorage.setItem('level','');
    sessionStorage.setItem('levelid','');
    sessionStorage.setItem('menu_id','');
    sessionStorage.setItem('menu_item_id','');
    sessionStorage.setItem('split_combine_id','');
    sessionStorage.setItem('selectedname','');
    $('body').find(".By_Cal_Yr").prop("checked", true).trigger("click");
    $('body').find(".Single").prop("checked", true).trigger("click");
    // alert($('.period.active').text())
    period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
    period =2;//$('input[type=radio][name="period"]:checked').attr('id');
    calchange(period_type,period);
    // alert($('body').find(".Single").parent().parent().next().find('#selectId1').val());
    // $('body').find('#3d #selectId1').val('2017');
    // $('body').find('option[value="2017"]').attr('selected', 'selected');
   // $('body').find("#2").prop("checked", true).trigger("click");
  // $("input[name='period']").trigger('select');
	 $(".profile").click(function() {
  	$("#profile").show();
   $(".congra").hide();
});
  // $('#Discovery').resizable()
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
   <!-- <link rel="stylesheet" href="//static.jstree.com/3.2.1/assets/dist/themes/default/style.min.css"> -->
   <script>
    selectedval = new Array();
    // $('body').find('.selectId1').val('2017');
   </script>
  <script src="js/jstree.js"></script>
<div class="col-md-2 scrollbar content" id="sidebar">
<aside class="left-side sidebar-offcanvas" >
    <section class="sidebar">
      <nav class="navbar period-calendar">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a class="dropdown-toggle select-period" data-toggle="dropdown" href="#" title="Select Period"><i class="fa fa-calendar selbox" ></i></a>
            </li>
          </ul>
      </nav>
	<p id="currentval" >   </p>
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
<div id="filter-area" style="border: 1px solid;padding: 10px;resize: vertical;overflow: auto;display:none">
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
//Period Type//
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
<?php
}
 else {
 	?>
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
$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<div id="myTabs">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
	<?php
		if(isset($_REQUEST["category"]))
		{
      // echo $_REQUEST["category"];
			$secondparent=array();$menu=array();$bool_arr1=array();
			$sq="select refid from bi_menu where level_id=".$_REQUEST['category']." and
			 parent_id =0 and stat='A'";
			$resultsq = $conn->query($sq);
			$row44=$resultsq->fetch_assoc();
      //print_r($row44);die;
			$sql = "select * from bi_menu where parent_id=".$row44['refid']." and stat='A' order by order_fld asc";
			$result = $conn->query($sql);
			//echo $sql;
       //252819 discovery
			$countres=0;

			while($row3 = $result->fetch_assoc()) {

				if($countres==0 )
				{

                  echo '<li role="presentation" class="active '.$row3["menu_name"].'" id="'.$row3["refid"].'"><a href="#'.$row3["menu_name"].'" aria-controls="'.$row3["menu_name"].'" role="tab" data-toggle="tab">'.$row3["menu_name"].'</a></li>';
                  $countres++;
                    //print_r($result->fetch_assoc());
				}
				else

				{
 				echo '<li role="presentation" class="'.$row3["menu_name"].'" id="'.$row3["refid"].'"><a href="#'.$row3["menu_name"].'" aria-controls="'.$row3["menu_name"].'" role="tab" data-toggle="tab">'.$row3["menu_name"].'</a></li>';
         // echo '$('.nav-tabs li a').css("pointer-events", "none")';
          //print_r($result->fetch_assoc());

				}
				 array_push($secondparent,$row3["refid"]);
				 array_push($menu,$row3["menu_name"]);
			        array_push($bool_arr1,$row3['bool_val']);

		  }
     // var_dump($secondparent);die;
	?>
    <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Diagnostics</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Prescription</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Prediction</a></li> -->
  </ul>
<!-- First Tab-->
<div class="tab-content">
<!--End-->
  <!-- Tab panes -->
   <?php
  //without first//

   $firstone=0;  $strim=implode(",",$secondparent);
   //print_r($secondparent);die;
	$divarr=array();$divarr1=array();$divarr1f=array();$divarrf=array();$bool_arr=array();
  $namearr=array();
  for($m=0;$m<count($menu);$m++)
  {
  	$firststr='';
  $secondsql="select * from bi_menu where  parent_id =".$secondparent[$m]." and level_id=0 and stat='A' order by order_fld asc";
  $secresult = $conn->query($secondsql);




  $secondsql1="select * from bi_menu where   parent_id =".$secondparent[$m]." and level_id=0 and stat='A' order by order_fld asc";
  $secresult1 = $conn->query($secondsql1);
   $secondlevel="select * from bi_menu where  parent_id =".$secondparent[$m]."  and stat='A' order by order_fld asc";
   //echo $secondlevel;
  $secondlevelresult = $conn->query($secondlevel);
   while($secresultw = $secresult->fetch_assoc()) {
                      array_push($divarr1,$secresultw['refid']);
   }
   if($firstone==0)
   {
   	$firststr=' in active';
   	$firstone++;
   }

  ?>
          <div role="tabpanel" class="tab-pane fade <?php echo $firststr?>" id="<?php echo $menu[$m];?>">
            <div id="my-resize" class="tree well">
                <?php
                //print_r($divarr1);die;
                if(count($divarr1)>0)
                {
                    echo '<ul class="tree-menu-list">';
                    $i=0;
                    while($row2 = $secresult1->fetch_assoc()) {
                     $thirdsql="select * from bi_menu  where parent_id in (".$row2['refid'].") and stat='A' order by order_fld asc";
                    $thirdresult = $conn->query($thirdsql);
                ?>
                   <li class="parent" id="<?php echo $row2['refid'];?>" parent_id="<?php echo $secondparent[$m];?>">
                    <span><?php echo $row2['menu_name']?><i class="pull-right fa fa-chevron-right"></i></span>
                        <ul id="<?php echo $row2['refid'];?>"  >
                    <?php
                   //var_dump($thirdresult->fetch_assoc());die;
                    while($row4 = $thirdresult->fetch_assoc()) {
                    	  //print_r($row4['parent_id']);
                         array_push($divarr,$row4['refid']);
                         array_push($namearr,$row4['menu_name']);

                      ?>
                              <li class="child" id="<?php echo $row4['refid'];?>" parent_id="<?php echo $secondparent[$m];?>">

                                   <span class="child_menu" id="my_popover<?php echo $row4['refid'];?>" onClick="test(this)"  menuid="<?php echo $row4['refid'];?>" ><?php echo $row4['menu_name'];?><i class="hide-i pull-right fa fa-chevron-right"></i><a href="javascript:void(0)" alt="" class="pull-right delete_selection my_popover<?php echo $row4['refid'];?>" ><i class="fa fa-trash" aria-hidden="true"></i></a></span>


                              </li>
                              <?php $i++;}  ?>
                              </ul>
                     </li>
                     <?php
                     }
                     ?>
                     </ul>
                     <?php
                  }
                    else// secondary sales (divarra1 not considered)
                  {
                  	//var_dump($secondlevelresult->fetch_assoc());
                  echo '<ul id="child">';

                    while($row4 = $secondlevelresult->fetch_assoc()) {
                        // print_r($row4['bool_val']);
                       array_push($divarr,$row4['refid']);
                         array_push($namearr,$row4['+']);
                        // array_push($bool_arr,$row4['bool_val']);
                       // print_r($bool_arr);die;
                      ?>
                              <li class="child" id="<?php echo $row4['refid'];?>" parent_id="<?php echo $secondparent[$m];?>">
                              <?php
                              if($row4['bool_val']==0)
                              {  //echo "keerthana";
                                ?>

                                   <span class="child_menu" id="my_popover<?php echo $row4['refid'];?>" onClick="test(this)"  menuid="<?php echo $row4['refid'];?>" ><?php echo $row4['menu_name'];?><i class="pull-right fa fa-chevron-right"></i><a href="javascript:void(0)" alt="" class="pull-right delete_selection my_popover<?php echo $row4['refid'];?>" ><i class="fa fa-trash" aria-hidden="true"></i></a></span>


                               <?php //echo "naveen";
                              }
                                else if ($row4['bool_val']==1){ ?>
                                    <span class="child_menu check_radio" id="my_popover<?php echo $row4['refid'];?>"   menuid="<?php echo $row4['refid'];?>" onClick="test1(this)" >
<input type="radio" menu_id="<?php echo $row4['menu_id'];?>" menu_item_id="<?php echo $row4['menu_item_id'];?>" level_id ="<?php echo $row4['level_id'];?>" name="my_popover<?php echo $row4['refid'];?>" class="Continuous" menu_name="<?php echo $row4['menu_name']?>" > <?php echo $row4['menu_name'];?></span>
                               <?php  } ?>
                                </li>
                              <?php }   echo '</ul>';      }
                               ?>

                 </div>
            </div>
<?php  }  ?>
  </div>
</div>
<div class="com_split">
  <span class="combine" view="C"  data-toggle="collapse" id="combine"><img src="images/combine.png" alt="combine" width="16px">Combine</span>
    <span class="split" view="S" data-toggle="collapse" id="split"><img src="images/split.png" alt="split" width="16px">Split</span>
</div>
<input type="hidden" id="myAnchor">
</div>
<?php } }?>
<div class="selection-area">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs selection-ul" role="tablist">
    <li role="presentation" class="active"><a href="#myselection" aria-controls="home" role="tab" data-toggle="tab">My Selection</a></li>
    <li role="presentation"><a href="#postselection" aria-controls="profile" role="tab" data-toggle="tab">Post Selection</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active my-scroll" id="myselection">
        <div class="col-md-12 pad-0">
            <ul>
                <li class="selection-list" id="selectedlist">
            </li>
            </ul>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane my-scroll" id="postselection">...</div>
  </div>
  <div id ="jstreeSplit" style=" "> </div>
   <div id ="jstreeCombine" style=" "> </div>
</div>
<!-- Split Details show here!-->
<div class="selection-area">
</div>
</section>
</aside>
<footer class="footer">
        <div class="container-fluid">
            <!-- <p class="col-md-2 col-md-push-1">&copy; BrandIdea <?= date('Y') ?></p> -->
            <p class="pull-right">Powered by Brand Idea Consultancy Services Pvt. Ltd.</p>
        </div>
</footer>
</div>
<div id="combineview" class="collapse" aria-expanded="true">
    <div class="popover-header">
        <h3>Combine</h3>
        <a href="javascript:void(0)" class="combinesplit-colse"><i class="fa fa-times"></i></a>
    </div>
   <div id ="jstreeC" style=""> </div>
 </div>
   <div id="splitview" class="collapse" aria-expanded="true">
     <div class="popover-header">
         <h3>Split</h3>
         <a href="javascript:void(0)" class="combinesplit-colse"><i class="fa fa-times"></i></a>
     </div>
     <div id ="jstreeS" style=" "> </div>
  </div>
<?php
if(isset($_REQUEST["category"]))
{
  // $grid_path = $_SESSION['grid_path'];
	for($i=0;$i<count($divarr);$i++)
	{
	echo '<div id="popover-child'.$divarr[$i].'" class="popover-child " >
	  <div class="popover-header">
	        <h3>'.$namearr[$i].'</h3>
	        <a href="javascript:void(0)" class="popover_close"><i class="fa fa-times"></i></a>
	  </div>
	  <div class="h-scroll-large" id="treeview_container"></div>
	</div>';
	}
}?>
<script type="text/javascript">

  // menu-nav
// $('body').on('click', '.menu-nav', function()
//   {
//       $('body').find('#modname').text($(this).attr('id'));
//       alert($(this).attr('id'));
//   });
grid_path = '<?php if(isset($grid_path)) echo $grid_path;?>';
// myselection
 // $('body').on('click', '#myselection', function()
 //  {
 //  });
//         $('#chart').prepend('<img id="loading-image1" src="small.gif" />');
//         $('#report').prepend('<img id="loading-image2" src="small.gif" />');
  $('body').on('click', '#jstreeS .jstree-anchor', function()
  {
    // var ty=window.parent("#map");
    // alert(ty);
	$("#combineview").css("display","none");
   $("#splitview").css("display","none");
    combsplitoptions = sessionStorage.getItem('combsplitoptions');
    combsplitoptions = JSON.parse(combsplitoptions);
    proceed = 1;
    for(var j=0;j<combsplitoptions.length;j++)
    {
        // alert(combsplitoptions[j]['parent']);
        if( $(this).parent().attr('id') == combsplitoptions[j]['parent'])
        {
          proceed = 0;
          break;
        }
    }
    if(proceed == 1)
    {
      document.getElementById("mapframe").contentWindow.reset_reading();
      $('#map').append('<img id="loading-image" src="small.gif" />');
      $("#loading-image").show();
      //alert();
      grid_path = sessionStorage.getItem('getpath');
      levelid =new Array();
      menu_item_id =new Array();
      menu_id = new Array();
      sessionStorage.setItem('resulttype','S');
      split_combine_id = $(this).parent().attr('id'); //combv
     // console.log("there",split_combine_id);
      var tblids = [];
      var parentlabel = new Array();
      var menulabel = new Array();
      $('select[name=menuselect] option:selected').each(function() {
      levelid.push($(this).attr('level_id'));
      // tblids.push({
      //  key1: $(this).attr('menu_id')],
      //  value1:  $(this).attr('menu_item_id')
      // });
      if(tblids["A_"+$(this).attr('menu_id')] == undefined)
      {
      tblids["A_"+$(this).attr('menu_id')] = $(this).attr('menu_item_id');
      }
      else
      {
      tblids["A_"+$(this).attr('menu_id')] = tblids["A_"+$(this).attr('menu_id')]+","+$(this).attr('menu_item_id');
      }
      menu_id.push($(this).attr('menu_id'));
      menu_item_id.push($(this).attr('menu_item_id'));
      menulabel.push($(this).text());
      parentlabel.push($(this).attr('data-section'));
      });
      tableids = [];
      for (key in tblids) {
      // alert(tblids[key]);
      temp1 = key;
      temp1= temp1.replace("A_", "");
      temp = temp1+","+tblids[key];
      tableids.push(temp);
      }
      console.log(tableids);
      var uniquepLabel = [];
      $.each(parentlabel, function(i, el){
      if($.inArray(el, uniquepLabel) === -1) uniquepLabel.push(el);
      });
      jsonPL = JSON.stringify(uniquepLabel);
      jsonML = JSON.stringify(menulabel);
      sessionStorage.setItem('parentlbl',jsonPL);
      sessionStorage.setItem('menulbl',jsonML);
      levelids = levelid.filter(function(item, pos, self) {
      return self.indexOf(item) == pos;
      })
      menu_ids = menu_id.filter(function(item, pos, self) {
      return self.indexOf(item) == pos;
      })
      optionid = $(this).parent().attr('id');
      sessionStorage.setItem('levelid',levelid);
      // sessionStorage.setItem('optionid',optionid);
      sessionStorage.setItem('menu_item_id',menu_item_id);
      sessionStorage.setItem('split_combine_id',split_combine_id);
      file = sessionStorage.getItem('maplevel');
      file=file.replace('KML','SVG');
      file=file.replace('.kml','.svg');
       if(file=="SVG/1---21---21.svg")
                 {
          file1=file.split("SVG/");
          file2=file1[1].split(".svg");
          file3=file2[0].split("---");
          locid=file3[0];
         parentlvl=file3[1];
        childlvl=file3[2];
                 }
                 else if(file=="SVG/1---21---1.kml")
                 {
              file1=file.split("SVG/");
              file2=file1[1].split(".svg");
              file3=file2[0].split("---");
              locid =file3[0];
              parentlvl=file3[1];
             childlvl=file3[2];
                 }
        else
        {
        file1=file.split("SVG/");
        file11=file1[1].split("/");
        file2=file11[2].split(".svg");
        file3=file2[0].split("---");
        locid =file3[0];
        parentlvl=file3[1];
        childlvl=file3[2];
        }
      // file = file.substring(0, file.indexOf('.'));
      // file = file.split('/');
      // mapids = file[1].split('---');
      // parentlvl = mapids[1];
      // childlvl =mapids[2];
      // locid = mapids[0];
      var iFrameDOM = $('body').find("#mapframe").contents();//$("iframe #mapframe").contents();
      year = sessionStorage.getItem('year');//'2015,2016';
      if(year=="")
      {
      du=(parseInt(dy)-1).toString();
      year=du;
      $("#currentval").text(year);
      }
      view = sessionStorage.getItem('view');//0;//0;
      combv = split_combine_id;
      menu_item_id = menu_item_id.toString();
      menu_ids = menu_ids.toString();
      tableids = JSON.stringify(tableids);
      sessionStorage.setItem('categs',menu_item_id);
      sessionStorage.setItem('id',locid);
      sessionStorage.setItem('parentlvl',parentlvl);
      sessionStorage.setItem('childlvl',childlvl);
      sessionStorage.setItem('groupby','S');
      sessionStorage.setItem('tbl',menu_ids);
       lvn=sessionStorage.getItem('levelid');

      sessionStorage.setItem('level','');
      sessionStorage.setItem('tableids',tableids);
      // sessionStorage.setItem('view',view);
      sessionStorage.setItem('combv',combv);

      showtree("S",combsplitoptions,combv);
      // alert
      r3= $.ajax(
      {
      type: "POST",
      url: 'sales/'+grid_path,//"consum_report.php",
      // async:false,
      data:{"year":year,"categs":menu_item_id,"chart":"chart","id":locid,parentlvl:parentlvl,childlvl:childlvl,"groupby":'S',"tbl":menu_ids,"mnid":'',"level":lvn,"view":view,"combv":combv,"tbldata":tableids},
      // async:false,
      beforeSend: function(){
      $("#mapframe").contents().find(".spinner-wrapper").show();
      },
      complete: function(){
      $("#mapframe").contents().find(".spinner-wrapper").hide();
      },
      success:function(data)
      {
      if(data != 'data not available')
      {

              //console.log("combv",combv);
          document.getElementById("mapframe").contentWindow.clusterclear();
          dat = JSON.parse(data);
        
          console.log(dat);
          sessionStorage.setItem('reading',dat[4]);
          sessionStorage.setItem('getstate_data', JSON.stringify(dat[2]));
          sessionStorage.setItem('colorsvg',JSON.stringify(dat[5]));

          // iFrameDOM.find("#report").html(dat[0])//.DataTable();
          document.getElementById("mapframe").contentWindow.datatable_split(dat[0]);
          console.log(dat[1]);
          document.getElementById("mapframe").contentWindow.higcharts_split(dat[1],dat[2]);
            if(view == 3)
                  {
                     document.getElementById("mapframe").contentWindow.map_split(dat[2]);
                  }
                  else
                  {


                    if(combv==2491 )
                  {
                     document.getElementById("mapframe").contentWindow.locationshow(dat[7],parentlvl,childlvl);
                  }
                  else if( combv==3148)
                  {
                      document.getElementById("mapframe").contentWindow.locationshow(dat[4],parentlvl,childlvl);
                  }
                   else if(combv== 2642)
                   {
                      document.getElementById("mapframe").contentWindow.locationshow(dat[8],parentlvl,childlvl);
                   }

                  else
                  {
                      svgname = locid+'---'+parentlvl+'---'+childlvl;
                      // alert(svgname);
                       // if(svgname == '73---12---12')
                       //  {
                       //    svgname = '14878---12---12';
                       //  }
                    document.getElementById("mapframe").contentWindow.toptenseries(dat[2]);

                     document.getElementById("mapframe").contentWindow.svgexecution_st_combine(svgname,dat[2],'');
                  }
                  }
          // document.getElementById("mapframe").contentWindow.svgexecution_st(svgname,dat[2]);//map_split(dat[2]);
      }
      else
      {
          alert(data);
      }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
      $("#mapframe").contents().find(".spinner-wrapper").hide();
      alert("Status: " + textStatus); alert("Error: " + errorThrown);
      }
      });
    }
    setTimeout(func, 1000);
      function func() {
        if ($('#view').hasClass('jstree-closed')) {
            $('#view i.jstree-icon').trigger("click");
            // $('#view').removeClass('jstree-closed');
            // $('#view').addClass('jstree-open');
        }
      }
});

$('body').on('click', '#jstreeC .jstree-anchor', function() {
  // alert(testyear);
  // iFrameDOM = $('#myiframe').contents().find('body');
  //         iFrameDOM.find('.reading-conv').val('4');
  // $('.loading').show();
  // jstree-children
   // alert("test");
   $("#combineview").css("display","none");
   $("#splitview").css("display","none");
  var proceed = 0;
  btncnt = sessionStorage.getItem('buttoncnt');
  if($(this).text() == 'Combine')
  {
    if(btncnt == 1)
    {
      proceed = 1;
    }
  }
  else
  {
    // alert(0)
    proceed = 1;
  }
  // alert($(this).text());
  if(proceed == 1)
  {
      // alert($(this).parent().find('.jstree-children').length);
      // document.getElementById("mapframe").contentWindow.reset_reading();
      ms = document.getElementById('mapframe').contentWindow['map'];
      grid_path = sessionStorage.getItem('getpath');
      // alert(grid_path);
      levelid =new Array();
      menu_item_id =new Array();
      menu_id = new Array();
      split_combine_id = $(this).parent().attr('id'); //combv

      console.log("combv",split_combine_id);
      sessionStorage.setItem('resulttype','C');
      menulabel = new Array();
      parentlabel = new Array();
      selectval = new Array();
      var tblids = [];
      levelid =[];
      menu_id=[];
      menu_item_id=[];
      menulabel=[];
      parentlabel=[];
      selectval=[];
    //  ****************for checkbox***********************
    if($('select[name=menuselect] option:selected'))
  {
      $('select[name=menuselect] option:selected').each(function() {
      levelid.push($(this).attr('level_id'));
      menu_id.push($(this).attr('menu_id'));
      menu_item_id.push($(this).attr('menu_item_id'));
      menulabel.push($(this).text());
      parentlabel.push($(this).attr('data-section'));
      selectval.push($(this).val());
       if(tblids["A_"+$(this).attr('menu_id')] == undefined)
      {
      tblids["A_"+$(this).attr('menu_id')] = $(this).attr('menu_item_id');
      }
      else
      {
      tblids["A_"+$(this).attr('menu_id')] = tblids["A_"+$(this).attr('menu_id')]+","+$(this).attr('menu_item_id');
      }
      // alert($(this).val());
      });
  }
  //*************************for Radio ******************************************
  else
  {



     $('body').on('click','.check_radio', function(){

       $(".combine, .split").css("pointer-events","auto");
         $('body').find(".check_radio .Continuous").prop("checked", false);
                     if($(this).find(".Continuous").prop('checked') == false)
                     {
                       $(".combine, .split").css("pointer-events","auto");
                       // $(".combine, .split").addClass("combine-active split-active");
                        $(this).find(".Continuous").prop("checked", true);
                        if($(this).find(".Continuous").prop('checked') == true)
                     {
                        alert($(this).find(".Continuous").attr('level_id'));
                        levelid.push($(this).find(".Continuous").attr('level_id'));
                         menu_id.push($(this).attr('menu_id'));
					      menu_item_id.push($(this).attr('menu_item_id'));
					      menulabel.push($(this).text());
					      parentlabel.push($(this).attr('data-section'));
					      selectval.push($(this).val());
					       if(tblids["A_"+$(this).attr('menu_id')] == undefined)
					      {
					      tblids["A_"+$(this).attr('menu_id')] = $(this).attr('menu_item_id');
					      }
					      else
					      {
					      tblids["A_"+$(this).attr('menu_id')] = tblids["A_"+$(this).attr('menu_id')]+","+$(this).attr('menu_item_id');
					      }
					                         //levelid=$(this).find(".Continuous").attr('level_id');

                      }

                         //alert($(this).find(".Continuous").attr('level_id'));
                     }
                   });
 }





      //get all tbl id with values
       tableids = [];
      for (key in tblids) {
      // alert(tblids[key]);
      temp1 = key;
      temp1= temp1.replace("A_", "");
      temp = temp1+","+tblids[key];
      tableids.push(temp);
      }
      // console.log('tableids');
      // console.log(tableids);
      tableids = JSON.stringify(tableids);
      sessionStorage.setItem('tableids',tableids);
      //ends here
      var uniquepLabel = [];
      $.each(parentlabel, function(i, el){
      if($.inArray(el, uniquepLabel) === -1) uniquepLabel.push(el);
      });
      jsonPL = JSON.stringify(uniquepLabel);
      jsonML = JSON.stringify(menulabel);
      sessionStorage.setItem('parentlbl',jsonPL);
      sessionStorage.setItem('menulbl',jsonML);
      sessionStorage.setItem('selectval',JSON.stringify(selectval));
      levelids = levelid.filter(function(item, pos, self) {
      return self.indexOf(item) == pos;
      })
      menu_ids = menu_id.filter(function(item, pos, self) {
      return self.indexOf(item) == pos;
      })
      sessionStorage.setItem('levelid',levelid);
      sessionStorage.setItem('menu_id',menu_id);
      sessionStorage.setItem('menu_item_id',menu_item_id);
      sessionStorage.setItem('split_combine_id',split_combine_id);
      file = sessionStorage.getItem('maplevel');
     file= file.replace('KML','SVG');
       file= file.replace('.kml','.svg');
         if(file=="SVG/1---21---21.svg")
                 {
                  file1=file.split("SVG/");
                  file2=file1[1].split(".svg");
                  file3=file2[0].split("---");
                  locid=file3[0];
                  parentlvl=file3[1];
                  childlvl=file3[2];
                 }
                 else if(file=="SVG/1---21---1.svg")
                 {
                    file1=file.split("SVG/");
                    file2=file1[1].split(".svg");
                    file3=file2[0].split("---");
                    locid =file3[0];
                    parentlvl=file3[1];
                    childlvl=file3[2];
                 }
                else
                {
                  file1=file.split("SVG/");
                  file11=file1[1].split("/");
                  file2=file11[2].split(".svg");
                  file3=file2[0].split("---");
                  locid =file3[0];
                  parentlvl=file3[1];
                  childlvl=file3[2];
                }
      // file = file.substring(0, file.indexOf('.'));
      // file = file.split('/');
      // mapids = file[1].split('---');
      // parentlvl = mapids[1];
      // childlvl =mapids[2];
      // locid = mapids[0];
      var iFrameDOM = $('body').find("#mapframe").contents();//$("iframe #mapframe").contents();
      // year = '2015,2016';
      // view =3; //0;
      var  year = sessionStorage.getItem('year');//'2015,2016';
      if(year=="")
      {
      du=(parseInt(dy)-1).toString();
      year=du;
      $("#currentval").text(year);
      }
      view = sessionStorage.getItem('view');//0;//0;
      combv = split_combine_id;
      menu_item_id = menu_item_id.toString();
      menu_ids = menu_ids.toString();
      //assing values in sessionStorage
      // sessionStorage.setItem('year',year);
      sessionStorage.setItem('categs',menu_item_id);
      sessionStorage.setItem('id',locid);
      sessionStorage.setItem('parentlvl',parentlvl);
      sessionStorage.setItem('childlvl',childlvl);
      sessionStorage.setItem('groupby','C');
      sessionStorage.setItem('tbl',menu_ids);
     // sessionStorage.setItem("lastname", levelid);
     lv= sessionStorage.getItem('lastname');
      // sessionStorage.setItem('view',view);
      sessionStorage.setItem('combv',combv);
      combsplitoptions = sessionStorage.getItem('combsplitoptions');
      combsplitoptions = JSON.parse(combsplitoptions);
      showtree("C",combsplitoptions,combv);
      // if(year != ''){
      r3= $.ajax(
      {
        type: "POST",
        url: 'sales/'+grid_path,//"consum_report.php",
        data:{"year":year,"categs":menu_item_id,"chart":"chart","id":locid,parentlvl:parentlvl,childlvl:childlvl,"groupby":'C',"tbl":menu_ids,"mnid":'',"level":lv,"view":view,"combv":combv,"tbldata":tableids},
        // async:false,
        beforeSend: function(){
        $("#mapframe").contents().find(".spinner-wrapper").show();
        },
        complete: function(){
        $("#mapframe").contents().find(".spinner-wrapper").hide();
        },
        success:function(data)
        {

        try
        {
        ms.data.revertStyle();
        }
        catch(err) {
        // document.getElementById("demo").innerHTML = err.message;
        }
        // document.getElementById("mapframe").contentWindow.reset_reading();
        if(data != 'data not available')
        {
                dat = JSON.parse(data);
          if(combv==2642)
          {
             document.getElementById("mapframe").contentWindow.locationshow(dat[8],parentlvl,childlvl);
             //sessionStorage.setItem('marker_uncover', JSON.stringify(dat[8]));

          }

        
           console.log("uncovered");
         console.log(dat);
          sessionStorage.setItem('reading',dat[4]);
          sessionStorage.setItem('getstate_data', JSON.stringify(dat[2]));
          document.getElementById("mapframe").contentWindow.datatable_combine(dat[0]);
          // alert('df');
          svgname = locid+'---'+parentlvl+'---'+childlvl;
          document.getElementById("mapframe").contentWindow.svgexecution_st_combine(svgname,dat[2],'');
          document.getElementById("mapframe").contentWindow.higcharts_combine(dat[1],dat[2]);
        }
        else
        {
          $("#mapframe").contents().find(".spinner-wrapper").hide();
          $('#chart').html();
          $('#report').html();
          try
          {
          ms.data.revertStyle();
          }
          catch(err) {
          // document.getElementById("demo").innerHTML = err.message;
          }
          alert(data);
        }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        try
        {
          ms.data.revertStyle();
        }
        catch(err) {
        // document.getElementById("demo").innerHTML = err.message;
        }
        // document.getElementById('mapframe').contentWindow['areavalue'] = [];
        // alert("Status: " + textStatus); alert("Error: " + errorThrown);
          // $("#mapframe").contents().alert('data not available');
            document.getElementById("mapframe").contentWindow.alert_find();
        }
      });
  }
  setTimeout(func, 1000);
    function func() {
      if ($('#view').hasClass('jstree-closed')) {
          $('#view i.jstree-icon').trigger("click");
          // $('#view').removeClass('jstree-closed');
          // $('#view').addClass('jstree-open');
      }
    }
});
//$(".loading").css("display", "none");
function del(id,nthchild)
{
  $("#treeview_container > div > div.selected > div[data-key='"+nthchild+"'] > span").click();
  $("#span"+id).html('');
}
  function test1(data)
    {
        sessionStorage.setItem('superparent',$(data).text());
    }
  function test(data)
    {

         var popid=$(data).attr('menuid');
      
       sessionStorage.setItem('superparent',$(data).text());
       $.ajax({
        url: "index.php?r=site/childmenu",
        data:{'menuid':popid},
         success: function(result){
          console.log(result);
           $('#popover-child'+popid+' > #treeview_container').html(result);
           // elemtdy = $('#popover-child'+popid+' > #treeview_container').find('#demo'+popid+' option[value=' + selectval[0] + ']').attr('selected', true);
              // tab-content
              $('.tab-content').find('.selected').each(function()
                {
                  $(this).children('div').each(function () {
                     $('#popover-child'+popid+' > #treeview_container').find('#demo'+popid+' option[value=' + $(this).attr('data-value') + ']').attr('selected', true);
                  });
                });
            // $(".tab-content > div[role = 'tabpanel'] .item").each(function(){});
              $('.tab-content').find('.selection-list-right').each(function()
                {
                  // alert('sds');
                  $(this).children('li').each(function () {
                     // alert('d');
                     ids = $(this).attr('id')
                     ids = ids.replace("span", "");
                     // alert(ids);
                     // alert($(this).attr('id'));
                     $('#popover-child'+popid+' > #treeview_container').find('#demo'+popid+' option[value=' + ids + ']').attr('selected', true);
                  });
                });

                $('.popover-child').hide();
                  // show the desired div
                  $('#popover-child'+popid).toggle();
                  // if($('div').attr('id') == "252819")
                  // {
                  //   $('#popover-child'+popid).hide();
                  // }
                  // else {
                  //
                  //
                  // }



       $('#demo'+popid).treeMultiselect({searchable: true, searchParams: ['section', 'text'],hideSidePanel:false, startCollapsed: true, enableSelectAll: true });
      $('#demo'+popid).change(function(){
        var checkarr=new Array();
        var checkarr1=new Array();
        var innercheck=new Array();
      
        countchk=0;
         $.each($('#demo'+popid+' option:selected'), function(){
               var spliting=$(this).attr('data-section').split("/");
               var repayfull=spliting[spliting.length-1];
               var repay=spliting[spliting.length-1].replace(" ","");

              if(checkarr1.indexOf(repay)==-1)
              {
                checkarr1.push(repay);
                checkarr[countchk]=new Array();
                checkarr[countchk][0]=repay;

                checkarr[countchk][1]=new Array();
                 checkarr[countchk][2]=repayfull;
                curcount=countchk;
                countchk++;
              }
                temparr=new Array();
                temparr.push($(this).text());
                temparr.push(spliting[spliting.length-1]);
                temparr.push($(this).val());
                temparr.push($(this).attr('data-key'));
                if(innercheck.indexOf($(this).val())==-1)
                {
                  innercheck.push($(this).val());
                   checkarr[curcount][1].push(temparr);
                }
        });
            strcheck='';
            //console.log(checkarr);
            $.each(checkarr, function( index, value ) {

              //window.parent("#subhead").val(value[0]);
             // sessionStorage.setItem('sub_head',value[0]);
            console.log(index+'----'+value);
            strcheck += '<div class="row" id="div'+value[0]+'"><div class="col-md-4 no-padding"><ul class="selection-list-left"><li>'+value[2]+'</li></ul></div><div class="col-md-8 no-padding"><ul class="selection-list-right">';
            $.each(value[1], function( index1, value1 ) {
              strcheck += '<li id="span'+value1[2]+'">'+value1[0]+'<span class="remove-selected" onclick="del('+value1[2]+','+value1[3]+')">X</span></li>';
         });
            strcheck +='</ul></div></div>';
        });
                 $("#selectedlist").html('');
                 $("#selectedlist").html(strcheck);

                 // $('.option, .section').click(function(){
                 //   if ($(row4['bool_val']==0))
                 //   {
                 //        superparent=$(this).parent().parent().attr('id')
                 //        alert($(data).parent().parent().attr('id')); //checked
                 //      }
                 // });
               //   $("input[type=checkbox]").change(function() {
               //     if($(this).prop('checked')) {
               //
               //         $('.nav-tabs li a').css("pointer-events", "auto");
               //     } else {
               //         $('.nav-tabs li a').css("pointer-events", "none");
               //     }
               // });


     });

            $(".selected").attr("style","display:none;");
     }});
       // selectval  $('#timing').val
       $("body").on("click", ".popover-child .section", function(){
         if ($("input[type=checkbox]").is(':checked')) {
              $('.delete_selection').css("display","none");
              $('.my_popover'+popid).css("display","block");
              // alert(popid);
              $("#combine").addClass('combine-active');
              $("#split").addClass('split-active');
            }
         else {
           $("#combine").removeClass('combine-active');
           $("#split").removeClass('split-active');
         };
});

      $('.my_popover'+popid).click(function(e){
         $("#mapframe").contents().find('#cl').hide();

          e.stopImmediatePropagation();
          menu_item_id = sessionStorage.getItem('categs');
          $('.selection-list').empty();//trigger("click");
          $("select[name=menuselect] option:selected").removeAttr("selected");
          $('.section').prop('checked', false);
          $('.option').prop('checked', false);
          $('.child_menu').removeClass("active-span");
          restype =  sessionStorage.getItem('resulttype');
          $("#combine").removeClass('combine-active');
          $("#combine").removeClass('active-color');
          $("#split").removeClass('split-active');
          $("#split").removeClass('active-color');
          $('li.Diagnostics a, li.Prescriptn a, li.Predictn a').css({"pointer-events": "none","color": "#999"});
          $("#jstreeSplit").empty();
          $(".delete_selection").hide();
          $("#jstreeCombine").empty();
          view = sessionStorage.getItem('view');
          year = sessionStorage.getItem('year');
          menu_item_id = sessionStorage.getItem('categs');
      // alert(view+" / "+year+" / "+menu_item_id);
        if(view != '' && year != '' && menu_item_id != '')
        {
        // alert('1');
        document.getElementById("mapframe").contentWindow.reset_reading();

        document.getElementById("mapframe").contentWindow.clear_selection();

        $('.selection-list').empty();//trigger("click");
        $("select[name=menuselect] option:selected").removeAttr("selected");
        $('.child_menu').removeClass("active-span");
        $("#mapframe").contents().find('#legendlabel').hide();
        $("#mapframe").contents().find('#chartname').html('chart');
        $("#mapframe").contents().find('#reportname').html('Data view');
        restype =  sessionStorage.getItem('resulttype');

      }
      });
      
    }

$("document").ready(function() {

    $(".combine, .split").css("pointer-events","none");
  $('body').on('click','.check_radio', function(){

         $('body').find(".check_radio .Continuous").prop("checked", false);
                     // if($(this).find(".Continuous").prop('checked') == false)
                     // {
                       $(".combine, .split").css("pointer-events","auto");
                       levelid=$(this).find(".Continuous").attr('level_id');
                           sessionStorage.setItem("lastname", levelid);
                        $(this).find(".Continuous").prop("checked", true);

                   
                        if($(this).find(".Continuous").prop('checked') == true)
                     {
                              var pusharr =new Array();
                                var uniqueNames = [];

                          if(levelid != undefined)
                          {
                            //alert(levelid);
                            $.ajax({
                            url: "index.php?r=site/menuenable",
                               type:"POST",
                            data:{'level':levelid},
                            success: function(result)
                            {
                              enab= result;

                            enab = JSON.parse(enab);
                                optcs= enab[0]['flag'];
                              for(i=0;i<enab.length;i++)
                              {
                              pusharr.push(enab[i]['flag']);
                              }
                                 
                              $.each(pusharr, function(i, el){
                                  if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
                              });

                                console.log(uniqueNames);

                                // if(r=='')
                                // {

                                //    alert("data not available");
                                // }
                               if(  uniqueNames.length==1 && uniqueNames[0]=='C')
                                {
                                         //alert("C");
                                     $(".combine").css("pointer-events","auto");
                                     $(".combine").addClass("combine-active");
                                     $(".split, .combine").removeClass("split-active active-color");
                                }
                                else if(uniqueNames.length==1 && uniqueNames[0]=='S')
                                {
                                  //alert("S");
                                  $(".split").css("pointer-events","auto");
                                  $(".combine, .split").removeClass("combine-active active-color");
                                  $(".split").addClass("split-active ");
                                }
                                else if(uniqueNames.length>1)
                                {
                                // alert("C,S");
                                  $(".combine, .split").css("pointer-events","auto");
                                  $(".combine, .split").removeClass("active-color");
                                  $(".combine, .split").addClass("combine-active split-active");
                                }
                                else // both combine and split
                                {
                                  $(".combine, .split").css("pointer-events","none");
                                  $(".combine, .split").removeClass("combine-active split-active active-color");
                                }
                                      }
                            });
                              //  }
                          }
              
                     //Menuenable
                      }

                         //alert($(this).find(".Continuous").attr('level_id'));
                   //  }
  });
  // $(".check_radio").click(function(){
  //       $(".Continuous").prop("checked", false);
  //     $(this).find(".Continuous").prop("checked", true);

  // });
  $('#combine').click(function(){
      $('#combineview').css('display','block');
      $('#splitview').css('display','none');
      $("#mapframe").contents().find('#legendlabel').hide();
      // setTimeout(func1, 500);
      //   function func1(){
      //            $('#jstreeC i.jstree-icon').trigger("click");
      //          }
  });
  $('#split').click(function(){
      $('#combineview').css('display','none');
      $('#splitview').css('display','block');
      // setTimeout(func1, 500);
      //   function func1(){
      //            $('#jstreeS i.jstree-icon').trigger("click");
      //          }
  });
    $("#combine,#split").click(function(){
     // sessionStorage.setItem("levelid1",levelid2);
      
     $('select[name=menuselect] option:selected').each(function() {
     levelid=$(this).attr('level_id');
   });
 if($('.check_radio .Continuous').is(':checked')) 
  { 

    //alert("it's checked"); 

     levelid= sessionStorage.getItem("lastname");


}
     
                    
                svgpath=''; arr1=[];arr2=[];fileid=[];
                 file = sessionStorage.getItem('maplevel');
                   file=file.replace('KML','SVG');
                    file=file.replace('.kml','.svg');
                    //file=svgpath;
                    console.log(file);
                  if(file=="SVG/1---21---21.svg" || file=="SVG/1---21---1.svg")
                  {

                  file1=file.split("SVG/");
                  file2=file1[1].split(".svg");
                  file3=file2[0].split("---");
                  fileid=file3[0];
                  mainloc=file3[1];
                  subloc=file3[2];
                  }
                  else
                  {
                  file1=file.split("SVG/");
                  file11=file1[1].split("/");
                  file2=file11[2].split(".svg");
                  file3=file2[0].split("---");
                  fileid=file3[0];
                  mainloc=file3[1];
                  subloc=file3[2];


                  }


            $.ajax({
                url:'index.php?r=site/geomaster' ,
                type:"POST",
                data:{"mainlocation": mainloc ,
                "sublocation":  subloc
                },
              success: function(response)
                 {
                    sessionStorage.setItem("loc_filter",'');
                    sessionStorage.setItem("variable_fiter",'');
                    sessionStorage.setItem("range_filter",'');
                    sessionStorage.setItem('selectval','');
                  k=JSON.parse(response);
                  console.log(k);
                           for(i=0;i<k.length;i++)
                  {
                      geo = k[i].split(',');
                       arr1.push(geo[0]);
                      arr2.push(geo[1]);
                  }
               //console.log(arr1,arr2)
               $.ajax({
                url:'index.php?r=site/mastername' ,
                type:"POST",
                data:{
                  "mastername":arr2[0],
                  "fileid": fileid,
                  "passid":"refid"
                },
                success: function(response)
                 {
                  p=JSON.parse(response);
                  console.log(p);
                   for(i=0;i<p.length;i++)
                        {
                        p1=p[i].toString();
                     $('#mapframe').contents().find("#mapname").html(p1);
                      }
                 }});
                 }});
       $("#jstreeS").css("display", "none");
       $("#jstreeC").css("display", "none");
       $("#jstreeC").html('');
       $("#jstreeS").html('');
      flag=$(this).attr('view');




     





        if(levelid != undefined)
        {
            $.ajax({
            url: "index.php?r=site/levelmenu",
            data:{'level':levelid,'flag':flag,'levelview':'levelview'},
             success: function(result){
              var vat = result;
              sessionStorage.setItem('combsplitoptions',result);
            //  console.log("KKKKKKKKK",result);
              sessionStorage.setItem('buttoncnt',JSON.parse(vat).length);
               $("#jstree"+flag).html('');
              $("#jstree"+flag).css("display", "block");
              $("#jstree"+flag).removeAttr("class role aria-multiselectable tabindex aria-activedescendant aria-busy");
              $('#jstree'+flag).jstree({
                'plugins': ['wholerow','conditionalselect'],
                'expand_selected_onload': true,
                'core': {
                  'data': eval(result),
                  'animation': true,
                  'themes': {
                    'icons': false,
                  }
                   },

              }).on('ready.jstree', function(){ console.log('rega');console.log($(this).jstree('open_all')); });
         }});
      }
       var getpath = '';
        $.ajax({
        url: "index.php?r=site/getpathres",
        data:{'level':levelid,'flag':flag,'levelview':'levelview'},
         success: function(result){
        //alert(result);
          sessionStorage.setItem('getpath',result.replace(/\s+/, ""));
 }});


  });
});
function showtree(viewtype,jsonst,comb)
{
              flagshow='';
              flagshow=(viewtype == "S") ? "Split" : (viewtype == "C") ? "Combine" : '' ;
              flaghide=(viewtype == "C") ? "Split" : (viewtype == "S") ? "Combine" : '' ;
              var selectedname='';
              for(var j=0;j<jsonst.length;j++)
              {                  // alert(combsplitoptions[j]['parent']);
                  if( comb == jsonst[j]['id'])
                  {
                    selectedname =   jsonst[j]['text'];
                  }
              }
             jsonbuild='[{"id":"view","parent":"#","text":"'+flagshow+'","li_attr":"0","enaable":"1"},{"id":"name","parent":"view","text":"'+selectedname+'","li_attr":"0","enaable":"1"}]';
             //alert(selectedname);

              if(flagshow != '')
              {
                $("#jstree"+flaghide).html('');
                $("#jstree"+flaghide).css("display", "none");
                $("#jstree"+flaghide).removeAttr("class role aria-multiselectable tabindex aria-activedescendant aria-busy");
                $("#jstree"+flagshow).html('');
                $("#jstree"+flagshow).css("display", "block");
                $("#jstree"+flagshow).removeAttr("class role aria-multiselectable tabindex aria-activedescendant aria-busy");
                $('#jstree'+flagshow).jstree('open_all');
                $('#jstree'+flagshow).jstree({
                  'plugins': ['search', 'radiobutton', 'wholerow','conditionalselect'],
                  'core': {
                    'data': eval(jsonbuild),
                    'animation': true,
                    'expand_selected_onload': false,
                    'themes': {
                      'icons': false,
                    }
                  },
                })
                sessionStorage.setItem('selectedname',selectedname);
              }
}
 $(document).ajaxStart(function(){
  //ajax-loader
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
</script>
<div class="dropdown-menu period-selection" data-animations="fadeIn">
  <h3>Period Selection</h3>
  <li><div id="popover-content" class="">
    <form class="form-inline" role="form">
      <div class="form-group">
          <div class="col-md-12 form-row">
            <div class="form-check ">
                <span class="period-title col-md-2">Period Type</span>
            </div>
<div class="form-check" id="div1">
  <?php
$sqp="select refid,period_name from period_type_master where  stat='A'";
$resultperiod = $conn->query($sqp);
while($resultp = $resultperiod->fetch_assoc()) {
 // array_push($perd,$resultp["period_name"]);
$datav[$resultp["refid"]]=$resultp["period_name"];
?>
<label>
<input type="radio"  name="periodtype"  id ="<?php echo $resultp['refid'];?>" value="<?php echo $resultp['refid'];?>" class = "<?php  echo str_replace('Period','',$resultp['period_name']) ?>"> <span class="label-text"><?php echo str_replace('Period','',$resultp['period_name']);?></span>
</label>
<?php
}
?>
</div>
          </div>
        <div class="col-md-12 form-row" id="cont">
            <div class="form-check">
                <span class="period-title col-md-2">Periodicity</span>
            </div>
<div class="form-check" id="div1b">
  <?php
$topmenuid=$_REQUEST['category'];
//echo $_REQUEST['category'];
$sqp1="SELECT distinct tm.period_name as period_name ,tm.refid as refid FROM timeline_master tm ,timeline_data td  where tm.refid=td.period_id and  td.second_lvl_menu_id ='".$topmenuid."'";
$resultperiod1 = $conn->query($sqp1);
while($resultp1 = $resultperiod1->fetch_assoc()) {
//print_r($perd);
//echo $sqp1;
$datav1[$resultp1["period_name"]]=$resultp1["refid"];
?>
<label>
<input type="radio"  name="period"  id ="<?php echo $resultp1['refid'];?>" value="<?php echo $resultp1['refid'];?>" > <span class="label-text  <?php echo str_replace(' ','_',$resultp1['period_name']);?>"><?php echo str_replace('Period','',$resultp1['period_name']);?></span>
</label>
<?php
}
?>
</div>
</div>
          <div class="col-md-12 form-row" id="3d">
            <div class="form-check">
                <span class="period-title col-md-2">Select Period <br></span>
            </div>
                <div class="form-check custome-check" id="div3"> </div>
                <div class="form-check" id="div31"></div>
                <div class="form-check">
                  <div class="single_period">
                        <!-- <input   data-bind="
                  daterangepicker: dateRange4,
                  daterangepickerOptions: {
                    single: true,
                    periods:['year','quarter','month', 'finyear'],
                  }
                "/> -->
                <input type="text" name="birthday" placeholder="Select Period"  id='pselection'/>
              </div>
                  <div class="continuous_period">
                  <input type="text" name="period_continuous" placeholder="Select Period"   id='period_continuous'/>
                      <!-- <input type="text" name="birthday_c2" value="2015"  id = 'pselectionC2'/> -->
                  </div>
                </div>
          </div>
           <div class="col-md-12" id="4d">
            <div class="form-check">
              <!--   <span class="period-title col-md-2">Parameter</span>-->
            </div>
            <!-- <div class="form-check col-md-2" ></div> -->
             <div class="form-check col-md-12" id="div4"></div>
        </div>
        <script type="text/javascript">
                            $( window ).load(function()
                            {
                              // Run code
                              dt = new Date();
                              dy =dt.getFullYear();
                              $("#currentval").text(parseInt(dy)-1);
                          $("#cont").hide();
                            });
                   $("input[name='periodtype']").change(function()
                             {
                            if($('input[name=periodtype]:radio:checked').val()==1)
                            {
                                $("#cont").hide();
                            }
                            else if($('input[name=periodtype]:radio:checked').val()==2)
                            {
                                $("#cont").hide();
                            }
                              else if($('input[name=periodtype]:radio:checked').val()==3)
                            {
                                $("#cont").show();
                                $("#div1b").show();
                                $("#period_continuous").hide();
                            }
                             });
                          function quatermonth(ch)
                          {
                            if(ch=='01')
                            {
                            var r="Jan-Mar";
                            ch=r;
                            }
                            if(ch=='02')
                            {
                            var r="Apr-Jun";
                            ch=r;
                            }
                            if(ch=='03')
                            {
                            var r="Jul-Sep";
                            ch=r;
                            }
                            if(ch=='04')
                            {
                            var r="Oct-Dec";
                            ch=r;
                            }
                            return ch;
                            console.log(ch);
                          }
                           function quatermonthrev(ch)
                          {
                            if(ch=='Jan-Mar')
                            {
                            var r="01";
                            ch=r;
                            }
                            if(ch=='Apr-Jun')
                            {
                            var r="02";
                            ch=r;
                            }
                            if(ch=='Jul-Sep')
                            {
                            var r="03";
                            ch=r;
                            }
                            if(ch=='Oct-Dec')
                            {
                            var r="04";
                            ch=r;
                            }
                            return ch;
                            console.log(ch);
                          }
                          function monthlist(ch)
                          {
                            if(ch=='01')
                            {
                            var r="Jan";
                            ch=r;
                            }
                            if(ch=='02')
                            {
                            var r="Feb";
                            ch=r;
                            }
                            if(ch=='03')
                            {
                            var r="Mar";
                            ch=r;
                            }
                            if(ch=='04')
                            {
                            var r="Apr";
                            ch=r;
                            }
                            if(ch=='05')
                            {
                            var r="May";
                            ch=r;
                            }
                            if(ch=='06')
                            {
                            var r="Jun";
                            ch=r;
                            }
                            if(ch=='07')
                            {
                            var r="Jul";
                            ch=r;
                            }
                            if(ch=='08')
                            {
                            var r="Aug";
                            ch=r;
                            }
                            if(ch=='09')
                            {
                            var r="Sep";
                            ch=r;
                            }
                            if(ch=='10')
                            {
                            var r="Oct";
                            ch=r;
                            }
                            if(ch=='11')
                            {
                            var r="Nov";
                            ch=r;
                            }
                            if(ch=='12')
                            {
                            var r="Dec";
                            ch=r;
                            }
                            return ch;
                          //console.log(ch);
                          }
                          function digits_count(n)
                          {
                            var count = 0;
                            if (n > 1) ++count;
                            while (n / 10 >= 1) {
                            n /= 10;
                            ++count;
                            }
                            return count;
                          }
                          var monthquater=['Jan-Mar','Apr-Jun','Jul-Sep','Oct-Dec'];
                          var monthquaterrev=['01','02','03','04'];
                          var month=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                          var monthrev=['01','02','03','04','05','06','07','08','09','10','11','12'];
                          var array1= [];
                          var array2=[];
                          var arr3=[];
                          var arr4=[];
                          var yearcoll=[];
                          var arr5=[];
                          var yearmon=[];
                          var yearmon1=[];
                          var yearmon3=[];
                          var vald=[];
                          var finyr=[];
                          var yearmon2=[];
                          var yearmon3=[];
                          var finyr1=[];
                          var finyr2=[];
                          var obj1=[];
                          var period_type;
                          var period;
                          obj1=[];
                          var val=[];
                          function cont()
                          {
                          $("#div3").empty();
                          $("#div31").empty();
                          $("#div4").empty();
                          for (var key1 in obj1) {
                          var array1 = $.map(obj1[key1], function(value, index) {
                          return [value];
                          });
                          arr3=[];
                          arr4=[];
                          arr3.push(array1[0]);
                          arr4.push(array1[1]);
                          }
                          }
                          function calyear()
                          {
                               d = new Date(arr3[0]);
                               n = d.getFullYear();
                               e = new Date(arr4[0]);
                               o = e.getFullYear();
                               diff = o - n;
                                yearcoll=[];
                                for(i=0;i<diff+1;i++)// generating all years
                                {
                               yearcoll.push(n+i);
                                }
                          }
                          function finyear()
                          {
                                      finyr=[];
                                      finyr1=[];
                                      finyr2=[];
                                      a = arr3.toString();// start year
                                      b = ",";
                                      position = 4;
                                      output = [a.slice(0, position), b, a.slice(position)].join('');
                                      array = [output];
                                      spl=output.split(",");
                                      quatermonth(spl[1]);
                                      a1 = arr4.toString();// end year
                                      b1 = ",";
                                      position1 = 4;
                                      output1 = [a1.slice(0, position), b1, a1.slice(position1)].join('');
                                      array1 = [output1];
                                      spl1=output1.split(",");
                                      quatermonth(spl1[1]);
                                      start1= spl[0]+" "+spl[1];
                                      end1=spl1[0]+" "+spl1[1];
                                      d = new Date(spl[0]);
                                      n = d.getFullYear();
                                      e = new Date(spl1[0]);
                                      o = e.getFullYear();
                                      diff =o-n;
                                      diff1=spl1[1]-spl[1];
                                      yearcoll=[];
                                      for(i=0;i<diff+1;i++)// generating all years
                                      {
                                      yearcoll.push(n+i);
                                      }
                                      for(i=0;i<diff1+1;i++)// generating all  end years
                                      {
                                      finyr.push(parseInt(spl[1])+i);
                                      if(digits_count(finyr[i])==1)
                                      {
                                      finyr1.push('0'+finyr[i]);
                                      }
                                      if(digits_count(finyr[i])==2)
                                      {
                                      finyr1.push(finyr[i].toString());
                                      }
                                      }
                                      finyr3=[];
                                      for(i=0;i<finyr1.length;i++)
                                      {
                                      finyr2.push(yearcoll[i]+"-"+finyr1[i]);
                                      finyr3[i]=yearcoll[i]+finyr1[i];
                                      }
                          }
                          function quarter()
                          {
                                      a = arr3.toString();// start year
                                       b = ",";
                                       position = 4;
                                       output = [a.slice(0, position), b, a.slice(position)].join('');
                                       array = [output];
                                      spl=output.split(",");
                                      quatermonth(spl[1]);
                                      a1 = arr4.toString();// end year
                                      b1 = ",";
                                      position1 = 4;
                                      output1 = [a1.slice(0, position), b1, a1.slice(position1)].join('');
                                       array1 = [output1];
                                       spl1=output1.split(",");
                                      quatermonth(spl1[1]);
                                      start1= spl[0]+" "+quatermonth(spl[1]);
                                       end1=spl1[0]+" "+quatermonth(spl1[1]);
                                       d = new Date(spl[0]);
                                       n = d.getFullYear();
                                       e = new Date(spl1[0]);
                                       o = e.getFullYear();
                                       diff =o-n;
                                      yearcoll=[];
                                      for(i=0;i<diff+1;i++)// generating all years
                                      {
                                      yearcoll.push(n+i);
                                      }
                                         yearmon3=[];
                                         yearmon4=[];
                                      for(i=0;i<yearcoll.length;i++)// generating all years
                                      {
                                      for(j=0;j<monthquater.length;j++)
                                      {
                                      yearmon.push(yearcoll[i]+' '+monthquater[j]);
                                       yearmon3.push(yearcoll[i]+monthquaterrev[j])  ;
                                      }
                                      }
                                       in1 = yearmon.indexOf(start1);
                                       in2 = yearmon.indexOf(end1);
                                      yearmon1=yearmon.slice(in1, in2+1);
                                      yearmon4=yearmon3.slice(in1, in2+1);
                          }
                          function monthyear()
                          {
                                                a = arr3.toString();// start year
                                                b = ",";
                                                position = 4;
                                                output = [a.slice(0, position), b, a.slice(position)].join('');
                                                array = [output];
                                                spl=output.split(",");
                                                monthlist(spl[1]);
                                                a1 = arr4.toString();// end year
                                                b1 = ",";
                                                position1 = 4;
                                                output1 = [a1.slice(0, position), b1, a1.slice(position1)].join('');
                                                array1 = [output1];
                                                spl1=output1.split(",");
                                                monthlist(spl1[1]);
                                                start= spl[0]+" "+monthlist(spl[1]);
                                                end=spl1[0]+" "+monthlist(spl1[1]);
                                                d = new Date(spl[0]);
                                                n = d.getFullYear();
                                                e = new Date(spl1[0]);
                                                o = e.getFullYear();
                                                diff =o-n;
                                                //console.log(diff);
                                                yearcoll=[];
                                                yearmon4=[];
                                                yearmon3=[];
                                                for(i=0;i<diff+1;i++)// generating all years
                                                {
                                                     yearcoll.push(n+i);
                                                }
                                                // console.log(yearcoll[diff]);
                                                for(i=0;i<yearcoll.length;i++)// generating all years
                                                {
                                                for(j=0;j<month.length;j++)
                                                {
                                                      yearmon.push(yearcoll[i]+' '+month[j]);
                                                      yearmon3.push(yearcoll[i]+monthrev[j])  ;
                                                }
                                                }
                                                in1 = yearmon.indexOf(start);
                                                in2 = yearmon.indexOf(end);
                                                yearmon1=yearmon.slice(in1, in2+1);
                                                yearmon4=yearmon3.slice(in1, in2+1);
                          }
                          function mixedfin(a)
                          {
                                                     lasttwo=a % 100;
                                                       b = (a-(a%100))/100;
                                                          c=b.toString();
                                                          if(digits_count(lasttwo)==1)
                                                          {
                                                           d=b+" - 0"+lasttwo;
                                                          }
                                                          else
                                                          {
                                                          d=b+" - "+lasttwo;
                                                        }
                                                           return d;
                          }
                          function adjustmonth(a)
                          {
                                         if(a%100==1)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+" Jan";
                                                 return a;
                                             }
                                             else if(a%100==2)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Feb";
                                                 return a;
                                             }
                                               else if(a%100==3)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Mar";
                                                 return a;
                                             }
                                                else if(a%100==4)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Apr";
                                                 return a;
                                             }
                                                else if(a%100==5)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"May";
                                                 return a;
                                             }
                                                else if(a%100==6)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Jun";
                                                 return a;
                                             }
                                                   else if(a%100==7)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Jul";
                                                 return a;
                                             }
                                                else if(a%100==8)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Aug";
                                                 return a;
                                             }
                                                else if(a%100==9)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Sep";
                                                 return a;
                                             }
                                                else if(a%100==10)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Oct";
                                                 return a;
                                             }
                                                else if(a%100==11)
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Nov";
                                                 return a;
                                             }
                                             else
                                             {
                                                a = (a-(a%100))/100;
                                                a=a.toString();
                                                a=a+"Dec";
                                                 return a;
                                             }
                          }
                          function adjustpara(a)
                          {
                            if(a%100==1)
                            {
                            a = (a-(a%100))/100;
                            a=a.toString();
                            a=a+" Jan-Mar";
                            return a;
                            }
                            else if(a%100==2)
                            {
                            a = (a-(a%100))/100;
                            a=a.toString();
                            a=a+" Apr-Jun";
                            return a;
                            }
                            else if(a%100==3)
                            {
                            a = (a-(a%100))/100;
                            a=a.toString();
                            a=a+"Jul-Sep";
                            return a;
                            }
                            else
                            {
                            a = (a-(a%100))/100;
                            a=a.toString();
                            a=a+"Oct-Dec";
                            return a;
                            }
                          }
                          function valuestosend()
                          {
                                $.ajax({
                                                        url:'index.php?r=site/viewdisplay' ,
                                                        type:"POST",
                                                        data:{"topmenuid":"<?php echo $topmenuid;?>",
                                                        },
                                                        success: function(response)
                                                    {
                                                       obj2 =JSON.parse(response);
                                                       arr5=[];
                                                        for (var key2 in obj2)
                                                        {
                                                                      var array2 = $.map(obj2[key2], function(value, index)
                                                                       {
                                                                            return [value];
                                                                        });
                                                                            arr5.push(array2[0]);
                                                           }
                                                      // dynamic button creation
                                                        s= "<div id='selectId4' >";
                                                        for(var val in arr5)
                                                         {
                                                               s+= "<label><input type='radio' name= 'selectName4' value ="+(parseInt(val)+1)+"><span class='label-text'>"+ arr5[val]+"</span></label>";
                                                         }
                                                        s+="</div>";
                                                        $("#div4").eq(0).html(s);
                                                     }
                                          });
                          }
                          function calchange(period_type,period)
                          {
                          tomenuid = "<?php echo $topmenuid;?>";
                          if(tomenuid != '') // validation
                          $.ajax({
                          url:'index.php?r=site/calyearsdisplay' ,
                          type:"POST",
                          data:{"topmenuid":"<?php echo $topmenuid;?>",
                          "period_id": period,
                          "period_type_id":period_type
                          },
                          cache: false,
                          success: function(response)
                          {
                          obj1 =JSON.parse(response);
                          // continuous
                          if(period_type=='2' && period=='2')//by calyear
                          {
                            cont();
                            calyear();
                            // alert('asdas');
                            // console.log('asadasd');
                            initdatepickcontinues(yearcoll);
                             //  s="<span> From </span>";
                             //  s+= "<select id='selectIdf'  name= 'selectNamet'>";
                             //  $('#selectIdf').empty();
                             //  for(var val in yearcoll) {
                             //  s+= "<option value ="+yearcoll[val]+">"+ yearcoll[val]+"</option>";
                             //  }
                             //  s+="</select>";
                             // s1="<span> To </span>";
                             //  s1+= "<select id='selectIdt'  name= 'selectNamef'>";
                             //  $('#selectIdt').empty();
                             //  for(var val in yearcoll) {
                             //  s1+= "<option value ="+yearcoll[val]+">"+ yearcoll[val]+"</option>";
                             //  }
                             //  s1+="</select>";
                             //  $("#div3").eq(0).html(s);
                             //  $("#div31").eq(0).html(s1);
                             //  $("#currentval").text(yearcoll[0]+" to "+yearcoll[0]);
                             //  $('#selectIdt,#selectIdf').on('change', function (e)
                             //   {
                             //     $("#currentval").text($("#selectIdf option:selected").text()+" to "+$("#selectIdt option:selected").text());
                             //   });
                               valuestosend();
                          }
                          else if(period_type=='2' && period=='7')//byfinace
                          {
                              cont();
                              finyear();
                              s="<span> From </span>";
                              s+= "<select id='selectIdf'  name= 'selectNamet'>";
                              $('#selectIdf').empty();
                              for(var val in finyr2) {
                              s+= "<option value ="+finyr3[val]+">"+ finyr2[val]+"</option>";
                              }
                              s+="</select>";
                             s1="<span> To </span>";
                              s1+= "<select id='selectIdt'  name= 'selectNamef'>";
                              $('#selectIdt').empty();
                              for(var val in finyr2)
                              {
                                        s1+= "<option value ="+finyr3[val]+">"+ finyr2[val]+"</option>";
                              }
                              s1+="</select>";
                              $("#div3").eq(0).html(s);
                              $("#div31").eq(0).html(s1);
                              $("#currentval").text(finyr2[0]+" to" +finyr2[0]);
                             $('#selectIdt,#selectIdf').on('change', function (e)
                             {
                               $("#currentval").text($("#selectIdf option:selected").text()+" to "+$("#selectIdt option:selected").text());
                             });
                               valuestosend();
                                 }
                          else if(period_type=='2' && period=='6')//by quater
                          {
                                   cont();
                                   quarter();
                                   s="<span> From </span>";
                                                s+= "<select id='selectIdf'  name= 'selectNamet'>";
                                                $('#selectIdf').empty();
                                                for(var val in yearmon1) {
                                                s+= "<option value ="+yearmon4[val]+">"+ yearmon1[val]+"</option>";
                                                }
                                                s+="</select>";
                                                s1="<span> To </span>";
                                                s1+= "<select id='selectIdt'  name= 'selectNamef'>";
                                                $('#selectIdt').empty();
                                                for(var val in yearmon1) {
                                                s1+= "<option value ="+yearmon4[val]+">"+ yearmon1[val]+"</option>";
                                                }
                                                s1+="</select>";
                                                $("#div3").eq(0).html(s);
                                                $("#div31").eq(0).html(s1);
                                                $("#currentval").text(yearmon1[0]+" to "+yearmon1[0]);
                                                $('#selectIdt,#selectIdf').on('change', function (e)
                                           {
                                             $("#currentval").text($("#selectIdf option:selected").text()+" to "+$("#selectIdt option:selected").text());
                                           });
                                            valuestosend();
                          }
                          else if(period_type=='2' && period=='4')//by month
                          {
                                  cont();
                                   monthyear();
                                               s="<span>From</span>";
                                              s+= "<select id='selectIdf'  name= 'selectNamef'>";
                                              $("#selectIdf").empty();
                                              for(var val in yearmon1) {
                                              s+= "<option value ="+yearmon4[val]+">"+ yearmon1[val]+"</option>";
                                              }
                                              s+="</select>";
                                               s1="<span> To </span>";
                                              s1+= "<select id='selectIdt'  name= 'selectNamef'>";
                                              $("#selectIdt").empty();
                                              for(var val in yearmon1) {
                                              s1+= "<option value ="+yearmon4[val]+">"+ yearmon1[val]+"</option>";
                                              }
                                              s1+="</select>";
                                              $("#div3").eq(0).html(s);
                                              $("#div31").eq(0).html(s1);
                                              $("#currentval").text(yearmon1[0]+" to "+yearmon1[0]);
                                               $('#selectIdt,#selectIdf').on('change', function (e)
                                         {
                                           $("#currentval").text($("#selectIdf option:selected").text()+" to "+$("#selectIdt option:selected").text());
                                         });
                                              valuestosend();
                          }
                            //single
                          else if(period_type=='1' && period=='2')//by calyear
                          {
                            cont();
                            calyear();
                            //  s= "<select id='selectId1'  name= 'selectName'>";
                            // for(var val in yearcoll)
                            // {
                            //   s+= "<option value ="+yearcoll[val]+">"+ yearcoll[val]+"</option>";
                            // }
                            // s+="</select>";
                            // $("#div3").html(s);
                            // obj1=[];
                            // $("#currentval").text(yearcoll[0]);
                            // alert('fdf');
                            initdatapickercust(yearcoll);
                            // $('body').find('input[name="birthday"]').daterangepicker({});
                            // $('#selectId1').on('change', function (e)
                            // {
                            //        $("#currentval").text($("#selectId1 option:selected").text());
                            // });
                          }
                          else if(period_type=='1' && period=='7')//byfinace
                          {
                            cont();
                            finyear();
                                        s = $("<select id=\"selectId\" name=\"selectName\" />");
                                        for(var val in  finyr2)
                                         {
                                               $("<option />", {value: finyr3[val], text:  finyr2[val]}).appendTo(s);
                                        }
                                        s.appendTo("#div3");
                                        $("#currentval").text(finyr2[0]);
                                        $('#selectId').on('change', function (e)
                                        {
                                                      $("#currentval").text($("#selectId option:selected").text());
                                        });
                          }
                          else if(period_type=='1' && period=='6')//by quater
                          {
                                  cont();
                                   quarter();
                                    s = $("<select id=\"selectId\" name=\"selectName\" />");
                                    for(var val in  yearmon1) {
                                    $("<option />", {value: yearmon4[val], text:  yearmon1[val]}).appendTo(s);
                                    }
                                    s.appendTo("#div3");
                                    obj1=[];
                                    $("#currentval").text(yearmon1[0]);
                                    $('#selectId').on('change', function (e)
                                    {
                                         $("#currentval").text($("#selectId option:selected").text());
                                    });
                          }
                          else if(period_type=='1' && period=='4')
                          {
                              cont();
                              monthyear();
                                  s = $("<select id=\"selectId\" name=\"selectName\" />");
                                    for(var val in  yearmon1)
                                     {
                                             $("<option />", {value: yearmon4[val], text:  yearmon1[val]}).appendTo(s);
                                    }
                                    s.appendTo("#div3");
                                    obj1=[];
                                    $("#currentval").text(yearmon1[0]);
                                    $('#selectId').on('change', function (e)
                                    {
                                            $("#currentval").text($("#selectId option:selected").text());
                                                });
                          }//by month
                          //mixed year
                          else  if(period_type=='3')
                         {
                             if(period_type=='3' && period=='2')//by calyear
                            {
                                cont();
                                calyear();
                                s= "<div class='selectRow'>";
                                s+="<select id='multipleSelectExample' data-placeholder='Select an option' multiple >";
                                for(var val in yearcoll)
                                 {
                                      s+= "<option value ="+yearcoll[val]+">"+ yearcoll[val]+"</option>";
                                 }
                                s+="</select>";
                                s+="</div>";
                                valueselc=[];
                                $("#div3").html(s);
                                $("#currentval").text(yearcoll[0]);
                                $('#multipleSelectExample').on('change', function (e)
                                  {
                                    $("#currentval").text($('select#multipleSelectExample').val());
                                });
                                $(document).ready(
                                function () {
                                $("#multipleSelectExample").select2();
                                }
                                );
                                valuestosend();
                            }
                                else if(period_type=='3' && period=='7')//byfinace
                                {
                                      cont();
                                      finyear();
                                      var s= "<div class='selectRow'>";
                                      s+="<select id='multipleSelectExample3' data-placeholder='Select an option' multiple >";
                                      for(var val in finyr2) {
                                      s+= "<option value ="+finyr3[val]+">"+ finyr2[val]+"</option>";
                                      }
                                      s+="</select>";
                                      s+="</div>";
                                      $("#div3").html(s);
                                      $("#currentval").text(finyr2[0]);
                                      var r=[]; var t=[];
                                      $('#multipleSelectExample3').on('change', function (e)
                                      {
                                         r.push(parseInt($('select#multipleSelectExample3').val()));
                                      $('select#multipleSelectExample3').val('');
                                      for(i=0;i<r.length;i++)
                                      {
                                           t[i]=mixedfin(r[i]);
                                      }
                                     $("#currentval").text(t);
                                     });
                                          $(document).ready(
                                          function () {
                                          $("#multipleSelectExample3").select2();
                                          });
                                          // console.log(s.appendTo("#div3"));
                                         valuestosend();
                                }
                                else if(period_type=='3' && period=='6')//by quater
                                {
                                    cont();
                                    quarter();
                                    s= "<div class='selectRow'>";
                                    s+="<select id='multipleSelectExample1' data-placeholder='Select an option' multiple >";
                                    for(i=0;i<yearmon1.length;i++)
                                    {
                                    s+= "<option value ="+yearmon3[i]+">"+ yearmon1[i]+"</option>";
                                    }
                                    s+="</select>";
                                    s+="</div>";
                                    $("#div3").html(s);
                                    $("#currentval").text(yearmon1[0]);
                                    var a=[];
                                    var g=[];
                                    $('#multipleSelectExample1').on('change', function (e) {
                                    a.push(parseInt($('select#multipleSelectExample1').val()));
                                    $('select#multipleSelectExample1').val('');
                                    for(i=0;i<a.length;i++)
                                    {
                                      g[i]=adjustpara(a[i]);
                                    }
                                    $("#currentval").text(g);
                                    });
                                    $(document).ready(
                                    function () {
                                    $("#multipleSelectExample1").select2();
                                    }
                                    );
                                    obj1=[];
                                    valuestosend();
                                }
                                else if(period_type=='3' && period=='4')//by month
                                {
                                        cont();
                                        monthyear();
                                        s= "<div class='selectRow'>";
                                        s+="<select id='multipleSelectExample2' data-placeholder='Select an option' multiple >";
                                        for(i=0;i<yearmon1.length;i++)
                                        {
                                        s+= "<option value ="+yearmon4[i]+">"+ yearmon1[i]+"</option>";
                                        }
                                        s+="</select>";
                                        s+="</div>";
                                        $("#div3").html(s);
                                        $("#currentval").text(yearmon1[0]);
                                        var f=[];var p=[];
                                        $('#multipleSelectExample2').on('change', function (e)
                                        {
                                        f.push(parseInt($('select#multipleSelectExample2').val()));
                                        for(i=0;i<f.length;i++)
                                        {
                                        p[i]=adjustmonth(f[i]);
                                        }
                                        $("#currentval").text(p);
                                        });
                                        $(document).ready(
                                        function () {
                                        $("#multipleSelectExample2").select2();
                                        }
                                        );
                                        obj1=[];
                                        valuestosend();
                                }
                              $("input[name='period']").change(function()
                             {
                               period='';
                               period =$('input[type=radio][name="period"]:checked').attr('id');
                             calchange(period_type,period);
                              });
                        }
                          else
                          {
                             console.log("not valid ");
                          }
                          }
                        });
                          }
                        // $("input[name='period']").change(function()
                        //  {
                        //    period='';
                        //    period =$('input[type=radio][name="period"]:checked').attr('id');
                        //
                        //    $("input[name='periodtype']").change(function()
                        //    {
                        //        period_type='';
                        //        period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
                        //        calchange(period_type,period);
                        //    });
                        //  });
            </script>
        <div class="period-submin">
          <button class="apply" id = "dlDropDown" type = "button">Apply</button>
          <!-- type="submit" -->
          <a href="javascript:void(0);" class="close" type="submit" >Close</a>
        </div>
      </div>
    </form>
  </div>
  </li>
</div>
<script>
$("input[name='periodtype']").change(function()
{
    // alert('1');
    period='2';
    period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
    $('body').find('.daterangepicker').parent().addClass('del').empty();
    $('body').find('.del').remove();
    calchange(period_type,period);
});
// $("input[name='period']").change(function(){
//     period_type='';
//     period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
//     calchange(period_type,period);
// });
// $("input[name='period']").change(function()
// {
//     period='';
//     period =$('input[type=radio][name="period"]:checked').attr('id');
//     calchange(period_type,period);
// });
// $("input[name='periodtype']").change(function()
// {
//     period_type='';
//     period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
//     calchange(period_type,period);
// });
$('.date-own').on('change', function() {
	alert($('input[name=period]:checked').val());
});
$('.dropdown-toggle').on('click', function() {
  // alert($('body').find('.selectId1').val());
  // $('body').find('#selectId1 option[value="2017"]').attr("selected", "selected");
  // $('body').find('.selectId1').val()
});
$('.apply').on('click', function(e)
  {
       e.preventDefault();
      if($('body').find('li.period.active').text() == 'Year')
      {
       period = 2;
      }
      else if($('body').find('li.period.active').text() == 'Month')
      {
         period == 4;
      }
      else  if($('body').find('li.period.active').text() == 'Quarter')
      {
         period == 6;
      }
       // alert(period_type);
        // $('body').find('.selectId1').val('2017');
        // $("#currentval").text($("#selectId1 option:selected").text());
    periodicity = period;
     // alert(period_type+'  '+periodicity);
    if(period_type == 1 && periodicity == 2) //cummaltive single year
    {
      // $('#selectId').val();
        if ($('body').find('li.period.active').text() == 'Year')
       {
          period_t = 'Y';
       }
      else if ($('body').find('li.period.active').text() == 'Quarter')
       {
          period_t = 'Q';
       }
       else if ($('body').find('li.period.active').text() == 'Month')
       {
          period_t = 'M';
       }
        else
       {
          period_t = 'FY';
       }
      testyear = 0;
      sessionStorage.setItem('view',0);
       sessionStorage.setItem('year',$('#pselection').val());//  sessionStorage.setItem('year',$('#selectId1').val());
      $("#currentval").text($("#pselection").val());//$("#currentval").text($("#selectId1 option:selected").text());
    }
    else if(period_type == 2 && periodicity == 2)//continues year
    {
      // alert($('input[name=selectName4]:checked').val());
      // alert($('body').find('#selectId4').val());
          $("#currentval").text($("#period_continuous").val());
          if($('input[name=selectName4]:checked').val() == 1)
          {
            sessionStorage.setItem('view',0);
          }
          else if($('input[name=selectName4]:checked').val() == 2) //contiues time series
          {
            sessionStorage.setItem('view',2);
          }
          else if($('input[name=selectName4]:checked').val() == 3) //contiues growth
          {
            sessionStorage.setItem('view',3);
          }
          yrtext = $('input[name=period_continuous]').val();
         years = yrtext.split(" To ");
          // years = [];
          // years.push($('#selectIdf').val());
          // years.push($('#selectIdt').val());
          // console.log(years);
          years = years.toString();
          // console.log(years);
          sessionStorage.setItem('year',years);
    }
    else if(period_type == 3 && periodicity == 2)//mixed year
    {
          if($('input[name=selectName4]:checked').val() == 1)
          {
            sessionStorage.setItem('view',5);
          }
          else if($('input[name=selectName4]:checked').val() == 2) //contiues time series
          {
            sessionStorage.setItem('view',1);
          }
          else if($('input[name=selectName4]:checked').val() == 3) //contiues growth
          {
            sessionStorage.setItem('view',3);
          }
        years = $('#multipleSelectExample').val();
        years = years.toString();
        sessionStorage.setItem('year',years);
    }
    else if(period_type == 1 && periodicity == 6) //Qtr single
    {
      // $('#pselection').val()
      pselec = $('#pselection').val();
      pselec = pselec.split(" ");
      lastChar = pselec[0].substr(pselec[0].length - 1);
      fin = pselec[1]+'0'+lastChar;
      testyear = 0;
      // alert(fin);
      sessionStorage.setItem('view',0);
       sessionStorage.setItem('year',find);//  sessionStorage.setItem('year',$('#selectId1').val());
      $("#currentval").text($("#pselection").val());
    }
    $('.period-selection').toggleClass('show-period');
  });
 $('body').on('click', '#clrsel', function() //clear selection
  {
      view = sessionStorage.getItem('view');
      year = sessionStorage.getItem('year');
      menu_item_id = sessionStorage.getItem('categs');
      // alert(view+" / "+year+" / "+menu_item_id);
      if(view != '' && year != '' && menu_item_id != '')
      {
        document.getElementById("mapframe").contentWindow.reset_reading();
        document.getElementById("mapframe").contentWindow.clear_selection();
        $('.selection-list').empty();//trigger("click");
        $("select[name=menuselect] option:selected").removeAttr("selected");
        $('.child_menu').removeClass("active-span");
        restype =  sessionStorage.getItem('resulttype');
        if(restype == 'C'){
        $('.combine').trigger("click");
        }
        else
        {
        $('.split').trigger("click");
        }
      }
  });
var month_name = function(dt){
mlist = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
  return mlist[dt.getMonth()];
};
function initdatapickercust(datrange)
{
  checkprd =0;
  datstrt = "01/01/"+datrange[0];
  dadend = "12/01/"+datrange[datrange.length-1];
    // alert(datstrt);
    // alert(dadend);
    // $(function() {
    $('.continuous_period').empty();
    $('.single_period').empty().append('<input type="text" name="birthday" placeholder="Select Period" id="pselection">');
  $('body').find('input[name="birthday"]').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      single: true,
      minDate:datstrt,
      maxDate: dadend ,
      periods:['year','quarter','month', 'finyear']
  },
   function(start, end, label) {
        console.log('CUMM '+$('body').find('li.period.active').length);
        console.log($('body').find('li.period.active').text());
      if($('body').find('li.period.active').text() == 'Year')
        {
          //dateFormat = 'YYYY';
          var d = new Date(start);
          var n = d.getFullYear();
          $('input[name="birthday"]').val(n);
        }
        else if($('body').find('li.period.active').text() == 'YearYear')
        {
          //dateFormat = 'YYYY';
          var d = new Date(start);
          var n = d.getFullYear();
          $('input[name="birthday"]').val(n);
        }
        else if ($('body').find('li.period.active').text() == 'Month' || $('body').find('li.period.active').text() == 'YearMonth')//YearMonth
        {
          // getMonth
          var d = new Date(start);
          var yr = d.getFullYear();
          var mnth = month_name(d);
           $('input[name="birthday"]').val(mnth+' '+yr);
          // dateFormat = 'MMM YYYY';
        }
         else if ($('body').find('li.period.active').text() == 'Quarter' || $('body').find('li.period.active').text() == 'YearQuarter') //YearQuarter
        {
          dateFormat = 'MMM YYYY';
        }
      if ($('body').find('li.period.active').text() == 'Quarter' || $('body').find('li.period.active').text() == 'YearQuarter') //done by robin
        {
            fulldatemonth = new Date(start).getMonth();
            // alert(fulldatemonth);
            if (fulldatemonth == 0)
            {
                  // dateFormat = 'YYYY';
                  // startDateText = moment(startDate).format(dateFormat);
                  // text = 'Q1 '+startDateText;
                  var d = new Date(start);
                  var yr = d.getFullYear();
                  $('input[name="birthday"]').val('Q1 '+yr);
            }
            else if (fulldatemonth == 3)
            {
                   var d = new Date(start);
                  var yr = d.getFullYear();
                  $('input[name="birthday"]').val('Q2 '+yr);
            }
            else if (fulldatemonth == 6)
            {
                    var d = new Date(start);
                  var yr = d.getFullYear();
                  $('input[name="birthday"]').val('Q3 '+yr);
            }
            else //if (fulldatemonth = 'Oct')
            {
                   var d = new Date(start);
                  var yr = d.getFullYear();
                  $('input[name="birthday"]').val('Q4 '+yr);
            }
        }
      // alert(label);
      // var years = moment().diff(start, 'years');
      // alert("You are " + years + " years old!");
  });
    // });
}
 $("body").on("click", ".period", function()
  {
    // alert(checkprd);
    if($(this).text() != 'Finanical Year')
    {
        checkprd = 0;
    }
    if($(this).text() == 'Finanical Year')
    {
      $('.decade-select').removeClass('hidden');
      $('.year-select').addClass('hidden');
      if(checkprd == 0)
      {
         $('body').find('.calendar-table .table-value').each(function() {
                console.log($(this).text());
                getlst = $(this).text();
                getlst = getlst.slice(-2);
                getlst = parseInt(getlst)+1;
                getIt =  $(this).text()+'-'+getlst;
                $(this).text(getIt);
                $(this).attr("data-bind","html: $data.html, css: $data.css");
        } );
         checkprd++;
      }
    }
  });
//table-value
 $("body").on("click", ".daterangepicker .table-row", function()
  {
    // alert('asdas');
    // e.preventDefault();
    // alert('asdas');
    if($('body').find('li.period.active').text() == 'Finanical Year')
    {
        $('body').find('.table-value').each(function() {
                console.log($(this).text());
                getlst = $(this).text();
                // getlst = $(this).text();
                testy = getlst;
                testy = testy.split('-');
                if(testy.length == 1){
                getlst = getlst.slice(-2);
                getlst = parseInt(getlst)+1;
                getIt =  $(this).text()+'-'+getlst;
                $(this).text(getIt);}
        } );
    }
  });
  $("body").on("change", ".decade-select", function()
    {
      // alert('1');
    if($('body').find('li.period.active').text() == 'Finanical Year')
    {
      $('.decade-select').removeClass('hidden');
      // $('.year-select').addClass('hidden');
      // if(checkprd == 0)
      // {
         $('body').find('.calendar-table .table-value').each(function() {
                console.log($(this).text());
                getlst = $(this).text();
                testy = getlst;
                testy = testy.split('-');
                if(testy.length == 1){
                getlst = getlst.slice(-2);
                getlst = parseInt(getlst)+1;
                getIt =  $(this).text()+'-'+getlst;
                $(this).text(getIt);
                $(this).attr("data-bind","html: $data.html, css: $data.css");}
        } );
         checkprd++;
      // }
    }
    });
function initdatepickcontinues(datrange)
{
    console.log('continus');
    checkprd= 0;
    datstrt = "01/01/"+datrange[0];
    dadend = "12/01/"+datrange[datrange.length-1];
      // $(function() {
      console.log(datstrt);
      try {
      $('input[name="period_continuous"]').data('daterangepicker').remove();
      }
      catch(err) {
      console.log(err.message);
      }
      $('.single_period').empty();
    $('.continuous_period').empty().append('<input type="text" placeholder="Select Period" name="period_continuous" id="period_continuous">');
    $('body').find('input[name="period_continuous"]').daterangepicker({
    // minDate:datstrt,
    // maxDate: dadend
      expanded: true,
    periods:['year','quarter','month', 'finyear']
    },
    function(start, end, label) {
    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      $('body').find('.table-value').attr('onclick', 'testfun();');
      console.log(start);
      console.log(end);
      console.log(label)
      console.log('Get  '+sessionStorage.getItem('endcal'));
      // console.log($('body').find('.custom-range-inputs input[type=text]').val());
       $('body').find('.table-value').each(function() {
                console.log($(this).text());
        } );
      // table-value
      // $('body').find('.custom-range-inputs input[type=text]').each(function() {
      //           // console.log($(this).val());
      //   } );
      // console.log($data.startDateInput);
      // console.log($data.endDateInput);
       // console.log('CP '+$('body').find('li.period.active').length);
      // console.log($('body').find('li.period.active').text())
       if(label == 'year')
        {
          //dateFormat = 'YYYY';
            datarry = new Array();
            $('body').find('.custom-range-inputs input[type=text]').each(function() {
                // console.log($(this).val());
                var d = new Date($(this).val());
                var n = d.getFullYear();
                datarry.push(n);
              } );
          // var d = new Date(start);
          // var n = d.getFullYear();
          // var d1 = new Date(end);
          // var n1 = d1.getFullYear();
          $('input[name="period_continuous"]').val(datarry[0]+' To '+datarry[1]);
        }
        else if ($('body').find('li.period.active').text() == 'Month')
        {
          // getMonth
           datarry = new Array();
          $('body').find('.custom-range-inputs input[type=text]').each(function() {
            // console.log($(this).val());
            var d = new Date($(this).val());
            var yr = d.getFullYear();
            var mnth = month_name(d);
            datarry.push(mnth+' '+yr);
          });
          // var d = new Date(start);
          // var yr = d.getFullYear();
          // var mnth = month_name(d);
          //  var d1 = new Date(end);
          // var yr1 = d1.getFullYear();
          // var mnth1 = month_name(d1);
           $('input[name="period_continuous"]').val(datarry[0]+' To '+datarry[1]);
          // dateFormat = 'MMM YYYY';
        }
        //  else if ($('body').find('li.period.active').text() == 'Quarter')
        // {
        //   dateFormat = 'MMM YYYY';
        // }
      if ($('body').find('li.period.active').text() == 'Quarter') //done by robin
        {
              datarry = new Array();
              twodates = new Array();
              yrarry = new Array();
             $('body').find('.custom-range-inputs input[type=text]').each(function() {
            // console.log($(this).val());
            var d = new Date($(this).val());
            datarry.push(d);
            var yr = d.getFullYear();
            twodates.push( new Date(d).getMonth());
          });
             // enddat = d.getFullYear();
            fulldatemonth = twodates[0];
            fulldatemonthE =twodates[1];
            // alert(fulldatemonth);
            console.log(fulldatemonth);
            console.log(fulldatemonthE);
            if (fulldatemonth == 0)
            {
                  // dateFormat = 'YYYY';
                  // startDateText = moment(startDate).format(dateFormat);
                  // text = 'Q1 '+startDateText;
                  var d = new Date(datarry[0]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val('Q1 '+yr);
            }
            //yrarry
            else if (fulldatemonth == 3)
            {
                  var d = new Date(datarry[0]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val('Q2 '+yr);
            }
            else if (fulldatemonth == 6)
            {
                  var d = new Date(datarry[0]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val('Q3 '+yr);
            }
            else //if (fulldatemonth = 'Oct')
            {
                  var d = new Date(datarry[0]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val('Q4 '+yr);
            }
             if (fulldatemonthE == 2)
            {
                  // dateFormat = 'YYYY';
                  // startDateText = moment(startDate).format(dateFormat);
                  // text = 'Q1 '+startDateText;
                  var d = new Date(datarry[1]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val( $('input[name="period_continuous"]').val()+' To Q1 '+yr);
            }
            else if (fulldatemonthE == 4)
            {
                  // dateFormat = 'YYYY';
                  // startDateText = moment(startDate).format(dateFormat);
                  // text = 'Q1 '+startDateText;
                  var d = new Date(datarry[1]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val( $('input[name="period_continuous"]').val()+' To Q2 '+yr);
            }
            else if (fulldatemonthE == 5)
            {
                  var d = new Date(datarry[1]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val($('input[name="period_continuous"]').val()+' To Q2 '+yr);
            }
            else if (fulldatemonthE == 8)
            {
                  var d = new Date(datarry[1]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val($('input[name="period_continuous"]').val()+' To Q3 '+yr);
            }
            else //if (fulldatemonth = 'Oct')
            {
                   var d = new Date(datarry[1]);
                  var yr = d.getFullYear();
                  $('input[name="period_continuous"]').val($('input[name="period_continuous"]').val()+' To Q4 '+yr);
            }
        }
  });
    // });
}
var cntconp = 0;
var cntp =0;
// $('body').find('input[name="birthday"]').focus(function()
//   {
//      period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
//      period = 2;
//       try {
//               $('body').find('input[name="period_continuous"]').data('daterangepicker').remove();
//       }
//       catch(err) {
//               // document.getElementById("demo").innerHTML = err.message;
//               console.log(err.message);
//       }
//       calchange(period_type,period);
//       cntconp++;
//   } );
//   $('body').find('input[name="period_continuous"]').focus(function()
//   {
//     // $('.single_period').empty();
//     period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
//     period = 2;
//       try {
//               $('body').find('input[name="birthday"]').data('daterangepicker').remove();
//       }
//       catch(err) {
//               // document.getElementById("demo").innerHTML = err.message;
//               console.log(err.message);
//       }
//     cntp++;
//     calchange(period_type,period);
//   } );
  // yt = sessionStorage.getItem('year');
  // yt = yt.split(',');
  // if(yt.length == 1){
  // $('input[name="birthday"]').val(sessionStorage.getItem('year'));
  // }
// $('body').table-value
  // $("body").on("click", ".table-value", function()
  // {

  //   alert($(this).text());
  // });
</script>
