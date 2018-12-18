<?php
require_once "db.php";
 $module = 'monthly_dealer_contest';
  $month = $_GET['month'];
?>

<form method="post" action="delearmonthylogin.php" id="view">

<label>Select Month</label>
<select name="month"> 
	<option value='01'>January</option>
	<option value='02'>February</option>
	<option value='03'>March</option>
	<option value='04'>April</option>
	<option value='05'>May</option>
	<option value='06'>June</option>
	<option value='07'>July</option>
	<option value='08'>Augest</option>
	<option value='09'>Septemer</option>
	<option value='10'>October</option>
	<option value='11'>November</option>
	<option value='12'>December</option>	
</select> 
<?php
if(!isset($month)){

	echo '<input type="Submit" id="search" value="Search">';
}
?>
 <br>


<table border="2"> <tr>
<th> emp_code</th>
<th> designation</th>
<th> dealer</th>
<th>Month</th>
<th> month_target</th>
<th> self_target</th>
<th> month_achived</th>
<th> mystery_achived</th>
<th> css_achived</th>

</tr>
<?php
//created_date, modified_date, created_by, modified_by, mystery_achived, css_achived;

$sql3="select * from $module where month='$month' ";
$res = mysql_query($sql3);
while($rt1=mysql_fetch_assoc($res)){
echo '<tr>';
echo '<td>'.$rt1['emp_code'].'</td>'; 
echo '<td>'.$rt1['designation'].'</td>'; 
echo '<td>'.$rt1['dealer'].'</td>'; 
echo '<td>'.$rt1['month'].'</td>'; 
echo '<td>'.$rt1['month_target'].'</td>'; 
echo '<td>'.$rt1['self_target'].'</td>'; 
echo '<td>'.'<input type="text" name="'.$rt1['id'].'_month_achived'.'">'.'</td>'; 
echo '<td>'.'<input type="text" name="'.$rt1['id'].'_mystery_achived'.'">'.'</td>'; 
echo '<td>'.'<input type="text" name="'.$rt1['id'].'_css_achived'.'">'.'</td>'; 
echo '</tr>';
}
?>
</table>
<input type="hidden" value="<?php echo $module; ?>" name="module">
<?php
if(isset($month)){

	echo '<input type="submit" value="submit">';
} ?>
</form>


