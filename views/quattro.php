<?php
session_start();
$_SESSION['gridQry']="";
$_SESSION['repcat'] = "";
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\grid\GridView;
use app\models\ServiceProvider;
use app\models\ConnectionTypes;
use yii\web\View;
use bburim\flot\Chart as Chart;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModuleTableRelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quattro Reports';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="vivie-qty-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

<table><tr><td>

<?php

$p1 = explode("/",$_SERVER['REQUEST_URI']);
$url7 = 'http://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/reports/quat_report_main.php";

//echo $url7;
//exit;

$mainreps = array('100'=>'Select Report Header', '101'=>'Admin Quaatro Report','102'=>'Dealer Quaatro Report','103'=>'Participant Quaatro Report');

if(isset($_GET['repid'])) { $set1 = $_GET['repid']; }
if(isset($_GET['category'])) { $set2 = $_GET['category']; }
if(isset($_GET['dealer'])) { $set3 = $_GET['dealer']; }
if(isset($_GET['year'])) { $set4 = $_GET['year']; } else { $set4 = date("Y"); }
if(isset($_GET['month'])) { $set5 = $_GET['month']; } else { $set5 = date("m"); }

echo "<select id='mainrep'>";
foreach($mainreps as $k=>$reps)
{
    if($k == $set1) { $sel = "selected"; } else { $sel = ""; }
    echo "<option value='" . $k . "' ". $sel . ">" . $reps . "</option>";

}
echo "</select>";

 echo "</td><td width='20px;'></td><td colspan='9' align='center'>";
 echo Html::Button('Proceed', ['class' => 'button', 'onclick'=>'window.location.href = "index.php?r=md-repfilter/quattro&repid="+$("#mainrep").val()']);
 echo "</td></tr></table></br>";


if($_GET['repid']==101)
    {
        	//echo "<pre>";
        	//print_r($cats);
        	//exit;
		$qry2 = "select distinct dealer_category from sales_contest order by dealer_category";
          $cats=Yii::$app->db->createCommand($qry2)->queryAll();
		$i = 1;
		foreach($cats as $cat)
			{
				$ctgy[$i] = $cat['dealer_category'];
				$i++;
			}

		echo "<table><tr><td>Select Category:</td><td><select id='categ'><option value='0'>---ALL---</option>";
		foreach($ctgy as $k=>$reps)
		{
		    if($k == $set2) { $sel = "selected"; } else { $sel = ""; }
		    echo "<option value='" . $k . "' ". $sel . ">" . $reps . "</option>";

		}
		echo "</select></td><td width='5%'></td><td>Select Dealer:</td></td><td><select id='dealar'><option value='0'>---ALL---</option>";

		$qry2 = "select distinct dealer_name from sales_contest order by dealer_name";
          $dealers=Yii::$app->db->createCommand($qry2)->queryAll();
		$i = 1;
		foreach($dealers as $deal)
			{
				$dlr[$i] = $deal['dealer_name'];
				$i++;
			}

		foreach($dlr as $k=>$reps)
		{
		    if($k == $set3) { $sel = "selected"; } else { $sel = ""; }
		    echo "<option value='" . $k . "' ". $sel . ">" . $reps . "</option>";

		}
		
		echo "</select></td><td width='5%'></td><td>Select Year:</td><td><select id='years'><option value='0'>---None---</option>";

		$yrarr = array('2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024');

		foreach($yrarr as $k=>$reps)
		{
		    if($k == $set4) { $sel = "selected"; } else { $sel = ""; }
		    echo "<option value='" . $k . "' ". $sel . ">" . $reps . "</option>";

		}
		
		echo "</select></td><td width='5%'></td><td>Select Month:</td><td><select id='months'><option value='0'>---None---</option>";

		$mtharr= array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec','13'=>'1-Qtr','14'=>'2-Qtr','15'=>'3-Qtr','16'=>'4-Qtr','17'=>'1-Half','18'=>'2-Half','19'=>'Yearly');

		foreach($mtharr as $k=>$reps)
		{
		    if($k == $set5) { $sel = "selected"; } else { $sel = ""; }
		    echo "<option value='" . $k . "' ". $sel . ">" . $reps . "</option>";

		}
		
	echo "</select>";
		
		echo "</td><td width='5%'></td><td colspan='9' align='center'>";
		echo Html::Button('Generate', ['class' => 'button', 'onclick'=>'window.location.href = "index.php?r=md-repfilter/quattro&repid="+$("#mainrep").val()+"&category="+$("#categ").val()+"&dealer="+$("#dealar").val()+"&year="+$("#years").val()+"&month="+$("#months").val()']);
		echo "</td></tr></table></br>";

if($set5==13){ $qrymth = "jan' OR month='feb' OR month='mar"; } else { $qrymth = $mtharr[$set5]; }
if($set5==14){ $qrymth = "apr' OR month='may' OR month='jun"; } else { $qrymth = $mtharr[$set5]; }
if($set5==15){ $qrymth = "jul' OR month='aug' OR month='sep"; } else { $qrymth = $mtharr[$set5]; }
if($set5==16){ $qrymth = "oct' OR month='nov' OR month='dec"; } else { $qrymth = $mtharr[$set5]; }
if($set5==17){ $qrymth = "jan' OR month='feb' OR month='mar' OR month='apr' OR month='may' OR month='jun"; } else { $qrymth = $mtharr[$set5]; }
if($set5==18){ $qrymth = "jul' OR month='aug' OR month='sep' OR month='oct' OR month='nov' OR month='dec"; } else { $qrymth = $mtharr[$set5]; }

if($set2==0 && $set3==0)
{
	$_SESSION['gridQry'] = "SELECT id as ID, dealer_category as Category, TRUNCATE((SUM(net_total)/count(*)),2) as Avg_Score FROM sales_contest WHERE year='" . $set4 . "' AND month='" . $qrymth . "' group by dealer_category";
}
elseif($set2!=0 && $set3==0)
{
   	$_SESSION['gridQry'] = "SELECT id as ID, dealer_category as Category, TRUNCATE((SUM(net_total)/count(*)),2) as Avg_Score FROM sales_contest WHERE dealer_category='" . $ctgy[$set2] . "' AND year='" . $set4 . "' AND month='" . $qrymth . "' group by dealer_category";
}
elseif($set2==0 && $set3!=0)
{
   	$_SESSION['gridQry'] = "SELECT id as ID, dealer_category as Category, TRUNCATE((SUM(net_total)/count(*)),2) as Avg_Score FROM sales_contest WHERE dealer_name='" . $dlr[$set3] . "' AND year='" . $set4 . "' AND month='" . $qrymth . "' group by dealer_category";
}
        $_SESSION['repid'] = '101';

		//echo "<pre>";

//echo $_SESSION['gridQry'];
//print_r($dlr);
//exit;

?>
    <div style="width:'1200px'; height:'5000px';"> 
        <object type="text/html" data="<?php echo $url7; ?>" width="1200px" height="5000px">
        </object>
    </div>

<?php

    }



    elseif($_GET['repid']==102)
    {
        echo "Under Processing</br>";
        $_SESSION['gridQry']='SELECT "Null" as ID, "Null" as Category, "Null" as AvgTotal';
    ?>
    <div style="width:'1200px'; height:'5000px';"> 
        <object type="text/html" data="<?php echo $url7; ?>" width="1200px" height="5000px">
        </object>
    </div>

   <?php

    }
    elseif($_GET['repid']==103)
    {
       echo "Under Processing</br>";
       $_SESSION['gridQry']='SELECT "Null" as ID, "Null" as Category, "Null" as AvgTotal';
    ?>
    <div style="width:'1200px'; height:'5000px';"> 
        <object type="text/html" data="<?php echo $url7; ?>" width="1200px" height="5000px">
        </object>
    </div>

   <?php

    }



?>


