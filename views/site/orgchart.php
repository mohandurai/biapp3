<?php

echo "<h2 class='toohead'>Organization Chart Standard</h2>";

$dp = Yii::$app->user->identity->dp;
$role = Yii::$app->user->identity->role;

$rldp = explode("_",$role);

$mod_sql = "SELECT department_id as id FROM audi_neev_designation a, department_master b where a.department=b.department_id and neev_designation='".$rldp[1]."'";
$mod_command = Yii::$app->db->createCommand($mod_sql);
$data1 = $mod_command->queryAll();
foreach($data1 as $cc)
{
	$dept = $cc['id'];
}

//echo $dp . " <<==== " . $mod_sql . " </br> " . $dept;
//exit;

if(strpos($role, '_HR') !== false || $role=='admin') { 
	$p1 = explode("/",$_SERVER['REQUEST_URI']);
	//$url7 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role1.php?dealer=".$dp."&dept=".$dept;
	$url7 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role3.php?dealer=".$dp;
	$url8 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/orggrid.php?dealer=".$dp;
} 
else 
{ 
	$p1 = explode("/",$_SERVER['REQUEST_URI']);
	//$url7 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role2.php?dealer=".$dp."&dept=".$dept;
	$url7 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role3.php?dealer=".$dp."&dept=".$dept;
	$url8 = 'https://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/orggrid.php?dealer=".$dp."&dept=".$dept;
}

//$url7 = 'http://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role3.php";
//echo $url7;
//exit;
?>
</br>
<div style="width:100%;height:100%;"> 
 <!--   <object type="text/html" data="<?php echo $url7; ?>" width="100%" height="90%"></object>  -->
 <iframe src="<?php echo $url7; ?>" width="100%" height="90%" scrolling="yes">
</iframe>

</div>

<div style="width:100%;height:100%;" class="mobi"> 
<!--    <object type="text/html" data="<?php echo $url8; ?>" width="100%" height="90%"></object>   -->
<iframe src="<?php echo $url8; ?>" width="100%" height="90%" scrolling="yes">
</iframe>
</div>
