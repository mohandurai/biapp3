<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use mdm\admin\models\AuthItem;
use mdm\admin\models\searchs\AuthItem as AuthItemSearch;
use yii\rbac\Item;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;
use app\models\RolewiseMboTemplate;

$this->registerJs(
	'$("document").ready(function(){ 	
		$("#mboentrysheet-sheet_name").change( function() {
			var rid = $(this).val();
			//alert(rid);
			$.get("getassusers.php", {rid: rid}, function (data) { 
				//alert(data);
				$("#mboentrysheet-assign_users").html(data);
			});
			return false;
		});

		$("#proceed-sheet").click( function() {
			var shtid = $("#mboentrysheet-sheet_name").val();
			var uid = $("#mboentrysheet-assign_users").val();
			//alert(shtid + " MMMMMMMMMMM " + uid);
			window.location.href="index.php?r=mbo-entry-sheet/create&sheetid="+shtid+"&uid="+uid;
			return false;
		});

	});'
);

if(isset($_GET['sheetid']))
{
	$sheetid = $_GET['sheetid'];
	$uid = $_GET['uid'];
	
} else {
	$sheetid = 0;
	$uid = 0;	
}


?>


<html>
<head>

<style type="text/css">
.maincontainer{
width: 100%;
min-height: 400px;
margin: 0 auto;
border:1px solid #000;
}
.mainhead{
height: 70px;
background:#cc0033;
border:1px solid #000;
color: #fff;
word-break: break-all;
font-weight: bold;
font-size: 12px;
}
.head1{
width:30%;
float: left;
height: 100%;
border-right: 1px solid #000;
text-align: center;
padding: 25px 0 25px 0;
box-sizing:border-box;
}

.head2{
width:30%;
height: 100%;
float: left;
border-right: 1px solid #000;
padding: 25px 0 25px 0;
box-sizing:border-box;
text-align: center;
}
.head3{
width:12%;
height: 100%;
float: left;
border-right: 1px solid #000;
padding: 25px 0 25px 0;
box-sizing:border-box;
text-align: center;
}
.head4{
width: 12%;
height: 100%;
float: left;
border-right: 1px solid #000;
padding: 25px 0 25px 0;
text-align: center;
box-sizing:border-box;
}
.head5{
width:8%;
height: 100%;
box-sizing:border-box;
float: left;
border-right: 1px solid #000;
padding: 25px 0 25px 0;
text-align: center;
}

.head6{
width:8%;
height: 100%;
float: left;
padding: 25px 0 25px 0;$loguser
box-sizing:border-box;
text-align: center;

}
.head61{
width: 100%;
height: 50%;
padding: 10px 0 10px 0;
border-bottom:1px solid #000;
box-sizing:border-box;
}


.head62{
width: 33.3333%;
height: 50%;
float: left;
padding: 10px 0 10px 0;
border-right: 1px solid #000;
box-sizing:border-box;
}
.head62:last-child{
border-right: none;
}
.bcontainer{
width: 100%;
min-height: 50px;
border-left:1px solid #000;
border-right:1px solid #000;
border-bottom:none;
box-sizing:border-box;
}

.maincat{
width: 100%;
height: 30px;
background:#d5d9d8;
box-sizing:border-box;
border-bottom:1px solid #ccc;
font-size: 15px;
}
.subcat{
width: 100%;
height: 50px;
box-sizing:border-box;
font-size: 12px;
display: flex;
background:#fff;
text-align: center;
}

.outofscore{
width: 100%;
height: 30px;
box-sizing:border-box;
border-bottom:1px solid #000;
font-size: 12px;
background:#cc0033;
color: #fff;
font-weight: bold;
}
.outofscore .bc1{
background:#fff;
}

.rating{
width: 100%;
height: 30px;
box-sizing:border-box;
border-bottom:1px solid #000;
font-size: 13px;
font-weight: bold;
}
.rating .bc6 .bc61{
background: #fff;
}

.rating .bc6 div:last-child{
height: 100%;
background:#cc0033;
color: #fff;
} 
.rating .bc6 div:nth-child(2){
height: 100%;
background:#cc0033;
color: #fff;
} 


.subcat .bc1{
font-weight: normal;
}

.bc1{
width:30%;
height: 100%;
float: left;
font-weight: bold;
padding: 5px;
display: flex;
box-sizing:border-box;
border-right:1px solid #ccc;
align-items: center; 
}

.bc11{
width:30%;
height: 100%;
float: left;
padding: 5px;
box-sizing:border-box;
display: flex;
border-bottom:1px solid #ccc;
border-right:1px solid #ccc;
border-left:1px solid #ccc;
align-items: center;  
}

.bc2{
width:30%;
height: 100%;
float: left;
padding: 5px;
display: flex;
box-sizing:border-box;
border-right:1px solid #ccc;
border-bottom:1px solid #ccc;
align-items: center; 
}

.bc3{
width:12%;
height: 100%;
float: left;
display: flex;
padding: 2px;
box-sizing:border-box;
border-right:1px solid #ccc;
justify-content: center;
align-items: center; 
border-bottom:1px solid #ccc;
}

.bc4{
width:8%;
height: 100%;
float: left;
padding: 8px;
display: flex;
box-sizing:border-box;
border-right:1px solid #ccc;
align-items: center; 
justify-content: flex-end;
border-bottom:1px solid #ccc;
text-align: right;
}

.bc5{
width:12%;
height: 100%;
float: left;
display: flex;
padding: 8px;
box-sizing:border-box;
border-right:1px solid #ccc;
align-items: center; 
justify-content: flex-end;
border-bottom:1px solid #ccc;
text-align: right;
}

.bc6{
width:8%;
height: 100%;
display: flex;
float: left;
padding: 2px;
box-sizing:border-box;
border-right:1px solid #ccc;
text-align: center;
padding: 3px;
justify-content: center;
align-items: center; 
border-bottom:1px solid #ccc;
}



.bc61, .bc62{
width:33.3333%;
height: 100%;
float: left;
border-right:1px solid #000;
box-sizing:border-box;
}
.inputcl{
width:55px;
height:20px;
}

</style>
</head>
<script type="text/javascript" >

</script>

<body>
<div class="maincontainer">
<div class="mainhead">
<div class="head1">
Key Performance Indicators
</div>
<div class="head2">
Measured Variables
</div>
<div class="head3">
Period of Measurement
</div>
<div class="head5">
Target
</div>
<div class="head4">
Weighting Factor
</div>
<div class="head6">
Achievement
</div>
</div>


<?php

$qry55 = "SELECT aa.id as emptrnid, c.kpi_category,
    a.lineitem_id, 
    d.variable_name,
    e.frequency_title,
	aa.target,
	aa.kpi_category as dummycat,
	aa.acheivement,
    aa.weightage as line_weight
FROM mbo_emp_transaction aa,
    neev_kpi_category_lineitems a,
    neev_kpi_category c,
    neev_measured_variable d,
    contest_frequency e  
where aa.template_id=". $sheetid . " and mbo_emp_id=". $uid . " and aa.kpi_lineitem=a.id
and a.category_id = c.id 
        and a.measured_id = d.id
        and a.frequency_id = e.frequency_id order by a.category_id ";

//echo $qry55;
//exit;

	$connection = Yii::$app->getDb();
	$command = $connection->createCommand($qry55);
	$result = $command->queryAll();

$categ1 = "";

?>
<form id="achievform" action="emp_achive_update.php" method="post" onSubmit="if(!confirm('Are sure to Update Achievement Info. ?')){return false;}">
<?php
$totalweightfact	=	0;
foreach($result as $res)
{
	$categ = $res['kpi_category'];

//echo $categ . " <<<== " . $categ1 . "</br></br>";

	if($categ!=$categ1) {
		$sqlsumlineweight	=	'select sum(weightage) as sum_line_weight from mbo_emp_transaction where mbo_emp_id="'.$uid.'" and template_id="'.$sheetid.'" and kpi_category="'.$res['dummycat'].'"';
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand($sqlsumlineweight);
		$counttotal = $command->queryAll();
		//var_dump($counttotal);
		echo '<div class="maincat"><div class="bc1">';
		echo '<b>'.$res['kpi_category'].'</b>';
		echo '</div>';
		echo '<div class="bc2">';
		echo '';
		echo '</div>';
		echo '<div class="bc3">';
		echo '';
		echo '</div>';
		echo '<div class="bc4">';
		echo '';
		echo '</div>';
		echo '<div class="bc5">';
		echo '<b>'.$counttotal[0]['sum_line_weight'].'</b>';		
		$totalweightfact	=	$totalweightfact+$counttotal[0]['sum_line_weight'];
		echo '</div>';
		echo '<div class="bc6">';
		echo '';		
		echo '</div>';
		echo '</div>';
		
	} 
	{
		echo '<div class="subcat"><div class="bc11">';
		echo $res['lineitem_id'];
		echo '</div>';
		echo '<div class="bc2">';
		echo $res['variable_name'];
		echo '</div>';
		echo '<div class="bc3">';
		echo $res['frequency_title'];
		echo '</div>';
		echo '<div class="bc4">';
		echo $res['target'];
		//echo '<input type="text" name=target[] size=5 value="'.$res['target'].'">';
		echo '</div>';
		echo '<div class="bc5">';
		echo $res['line_weight'];
		//echo $res['line_weight'];
		//echo '<input type="text" name=line_weight[] size=5 value="'.$res['line_weight'].'">';
		echo '</div>';
		echo '<div class="bc6">';
		echo '<input type="text" name=get_achive[] size=5 value="'.$res['acheivement'].'">';
		echo '</div>';
		echo '</div>';
	}
	$categ1 = $categ;
	?>
	<input type="hidden" name="emptransid[]" value="<?php echo $res['emptrnid'];?>"/>
<?php
}
echo '<div class="maincat"><div class="bc1">';
		//echo '<b>'.$res['kpi_category'].'</b>';
		echo '</div>';
		echo '<div class="bc2">';
		//echo 'aa';
		echo '</div>';
		echo '<div class="bc3">';
		echo '';
		echo '</div>';
		echo '<div class="bc4">';
		echo '';
		echo '</div>';
		echo '<div class="bc5">';
		echo '<b>'.$totalweightfact.'</b>';		
		echo '</div>';
		echo '<div class="bc6">';
		echo '';		
		echo '</div>';
		echo '</div>';
	echo '</div>';
//exit;

$qry56 = "SELECT comments FROM mbo_review_comments WHERE ref_mbo_id=" . $_GET['id'] . " AND uid=" . $_GET['uid'] . " AND role_templ_id=". $_GET['sheetid'];
$connection = Yii::$app->getDb();
$command = $connection->createCommand($qry56);
$res56 = $command->queryAll();
//print_r($res56);
foreach($res56 as $r5)
{
   $cmt = $r5['comments'];
}

//echo $cmt . " <<=== ";

?>

	<div class="revcomtextar topspace"><div>Review Comments:</div></div><textarea type="textarea" name="revcomments" cols="80" rows="5"><?php echo $cmt;?></textarea></div></div>

<input type="hidden" name="save5" value="Yes">
<input type="hidden" name="mboid" value="<?php echo $_GET['id'];?>"/>
<input type="hidden" name="sid" value="<?php echo $sheetid;?>"/>
<input type="hidden" name="uid" value="<?php echo $uid;?>"/>

	<?php $this->registerJs(
	'$("document").ready(function(){

		$("#savetemp").click(function(e) {  
		//alert("");
		var catid = $(this).attr("alt");
		$.get("'.Url::to(['/rolewise-mbo-template/publishrolempusers']).'", {pubid: catid,status:"Saved"}, function (data) { 
	    	//alert(data);
		});    	
		$("#submitbutton").trigger("click");		
	    return false;
	});
	 	
		$("#publishtemp").click(function(e) {  
		    var conf = confirm("Are you sure to Submit For Review ..... ");
		    if(conf==true)
		      {
			    var catid = $(this).attr("alt");
			  	//var pubyear = $("#rolewisembotemplate-year1").val();
			  	//var pubmth = $("#rolewisembotemplate-mth1").val();
			  	//alert(catid + "<<<===" + pubyear + "<<<===" +pubmth);
			  	//return false;
			    $.get("'.Url::to(['/rolewise-mbo-template/publishrolempusers']).'", {pubid: catid}, function (data) { 
			    	alert(data);
				});    	
				$("#submitbutton").trigger("click");
				
			    return false;
			  }
			else { return false; }
		});
	});'
	);

?>
<?php
if($model->status == 'New' || $model->status == 'Saved'){
	?>
	<center>
		<input class="btn btn-primary" type="submit" id="submitbutton" value="Update" style="display: none;">
		<?php
			echo Html::a('Save', ['rolewise-mbo-template/publishrolempusers'], ['class' => 'btn btn-primary', 'alt'=>$model->id,  'id'=>'savetemp']) ;
		?>
		<?php
			echo Html::a('Save & Submit For Review', ['rolewise-mbo-template/userviewmbo', 'mid' => $model->id,'sheetid' => $model->template_id, 'uid' => $model->emp_id], ['class' => 'btn btn-primary', 'alt'=>$model->id,  'id'=>'publishtemp']) ;
		?>
	</center>
	<?php
}?>

</center>
</form>

</body>

</html>
