<style>
* {
 font-family: Audi_Normal;
}
</style>

<?php 

echo "<span style='color:#cc0033;font-size: 10px;'><b>Note : </b>Count of employees handling that role is shown orange color</br>Name of employees would be displayed by rolling the mouse pointer on the name box</br></br>";


include("db.php");

//echo "1TH ====>>Admin";
//exit;
//$usrcnt ="#990000";

$p1 = explode("/",$_SERVER['REQUEST_URI']);
$url7 = 'http://' . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/manpower/role3.php";

//echo $_GET['dealer'] . " <<==== " . $_GET['dept'] . "</br></br>";

if(isset($_REQUEST['dealer'])) { $dlr = $_REQUEST['dealer']; } else {$dlr=0;}
if(isset($_REQUEST['dept'])) { $dpt = $_REQUEST['dept']; } else {$dpt=0;}

$sel2 = ""; $sel5 = ""; $sel6 = ""; 

if($dlr==2) { $sel2 = "selected='selected'"; }
elseif($dlr==5) { $sel5 = "selected='selected'"; } 
elseif($dlr==6) { $sel6 = "selected='selected'"; }

$sel00 = ""; $sel11 = ""; $sel22 = ""; $sel33 = ""; $sel44 = ""; $sel55 = ""; $sel66 = ""; $sel77 = ""; $sel88 = ""; $sel99 = ""; $sel10 = ""; 

if($dpt==0) { $sel00 = "selected='selected'"; }
elseif($dpt==1) { $sel11 = "selected='selected'"; } 
elseif($dpt==2) { $sel22 = "selected='selected'"; }
elseif($dpt==3) { $sel33 = "selected='selected'"; }
elseif($dpt==4) { $sel44 = "selected='selected'"; }
elseif($dpt==5) { $sel55 = "selected='selected'"; }
elseif($dpt==6) { $sel66 = "selected='selected'"; }
elseif($dpt==7) { $sel77 = "selected='selected'"; }
elseif($dpt==8) { $sel88 = "selected='selected'"; }
elseif($dpt==9) { $sel99 = "selected='selected'"; }
elseif($dpt==10) { $sel10 = "selected='selected'"; }

//echo $dlr . " <<<=== " . $dpt . "</br>";
//exit;

if($dlr==1) {
	echo "<form name='form1' style='font-size: 12px;' method='get' action='" . $url7 . "'><span style='font-size: 12px'>Select Dealership Name : </span>&nbsp;<select  name='dealer'><option value='0'>---None---</option><option value='5' " . $sel5 . ">biweb</option><option value='2' " . $sel2 . ">Audi Mumbai West</option><option value='6' ". $sel6 . ">Audi Delhi South</option>";
} elseif($dlr==6) {
	echo "<form name='form1' style='font-size: 12px;' method='get' action='" . $url7 . "'><span style='font-size: 12px'>Select Dealership Name : </span><select  name='dealer'><option value='". $dlr . "'>Audi Delhi South</option>";
}

if(isset($_GET['dept']))
{
	echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-size: 12px'>Select Department :</span> <select name='dept'><option value='0' " . $sel00 . ">---ALL---</option><option value='2' " . $sel22 . ">Sales</option><option value='1' " . $sel11 . ">After Sales</option><option value='3' " . $sel33 . ">Finance</option><option value='4' " . $sel44 . ">HR</option><option value='8' " . $sel88 . ">Customer Care</option>";
} else {
	echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Department : <select style='font-size: 12px' name='dept'><option value='0' " . $sel00 . ">---ALL---</option><option value='2'>Sales</option><option value='1'>After Sales</option><option value='3'>Finance</option><option value='4'>HR</option><option value='8'>Customer Care</option>";
}

echo "</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='Proceed'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo "<input type='button' id='btnPrint' value='Download' /></br></br>";

//$str5 = [{v:'Robert', f:'Robert<div style="color:red; font-style:italic">President</div>'},'', 'President'],
//   [{v:'Jim', f:'Jim<div style="color:red; font-style:italic">Vice President</div>'},'Robert', 'Vice President'],
//$str5 = "[{v:'Admin', f:'Admin Administrator'},'', 'Administrator'],";

$qry66 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '99999'";
$res2 = mysql_query($qry66);
while($row2 = mysql_fetch_array($res2))
{
	$r2 = $row2['role'];
	$idnum2 = $row2['id'];
	$rlname2 = $row2['description'];

	$qry33 = "SELECT id, concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r2 . "' ORDER BY first_name";
//echo $qry33 . "</br></br>";
		$res33 = mysql_query($qry33);
		$usrcnt=0;
		$rlname2aa="";
		while($d2 = mysql_fetch_array($res33))
		{
			$rlname2aa .= $d2['EmpName'] . ",\u000A ";
			$usrcnt++;

		}
	$rlname2aaa = substr($rlname2aa,0,-8);

	//$rlname2a =  $rlname2 ." <div ".'class="org-circle"'."> " . $usrcnt . "</div>";
	$rlname2a = "<b> <div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /> <div>". $rlname2 . "</div></b>";

//$str5 = "['" . $rlname2a . "', 'Admin <div ".'class="org-circle"'.">" . $usrcnt . "</div>', '" . $rlname2aaa . "'],";
//$str5 = "[{v:'".$rlname2a."', f:'<div style=\"color:red; font-style:italic\">".$rlname2a."</div>'}, 'Administrator (" . $usrcnt . ")', 'Bob\u000ASponge'],";
//echo  " ===>>> " . $rlname2a . " <<<=== ";<div style="color:red; font-style:italic">Vice President<div>





  if($r2!="") {

	if($dpt=='3') {	
		$qry3 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum2."' AND department='3'";
	} else {
		$qry3 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum2."' AND department='0'";
	}

	
//echo $qry3 . "</br>AAAAA</br>";

	$res3 = mysql_query($qry3);
	while($row3 = mysql_fetch_array($res3))
	{
		$r3 = $row3['role'];
		$idnum3 = $row3['id'];
		$rlname3 = $row3['description'];

		$qry33 = "SELECT concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r3 . "' ORDER BY first_name";

		$res33 = mysql_query($qry33);
		$usrcnt=0;
		$rlname3aa="";
		while($d3 = mysql_fetch_array($res33))
		{
			$rlname3aa .= $d3['EmpName'] . ",\u000A ";
			$usrcnt++;
		}
	$rlname3aaa = substr($rlname3aa,0,-8);
	
	$rlname3a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname3 . "</div> </b></div";

$str5 = "['". $rlname2a . "', 'Dealer Principle', 'Admin Delhi South'],";

$str5 .= "['" . $rlname3a . "', '" . $rlname2a . "', '". $rlname3aaa . "'],";








	  if($r3!="") {

		if($dpt==0) {
			$qry4 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum3."'";
		} elseif($dpt==3) {
			$qry4 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum3."' AND department='" .$dpt. "' AND department = '3'";
		}
		else {
			$qry4 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum3."' AND department='" .$dpt. "' AND department <> '3'";
		}
	
//echo $qry4 . "</br></br>";

		$res4 = mysql_query($qry4);
		while($row4 = mysql_fetch_array($res4))
			{
				$r4 = $row4['role'];
				$idnum4 = $row4['id'];
				$rlname4 = $row4['description'];

				$qry33 = "SELECT id, concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r4 . "' ORDER BY first_name";
//echo $qry33 . "</br></br>";
				$res33 = mysql_query($qry33);
				$usrcnt=0;
				$rlname4aa="";
				$rlshow_red4="</br>";
				while($d4 = mysql_fetch_array($res33))
				{
					$qry75= "SELECT COUNT(*) AS cnt FROM user where reports_to=" . $d4['id'] . " HAVING COUNT(*) > 5";
					$res75 = mysql_query($qry75);
					while($row75 = mysql_fetch_array($res75))
					{
						$rl2cnt = $row75['cnt'];
						if($rl2cnt>5) {
					//		$rlshow_red4 .= "<div ".'class="p15"'."><font color=\"red\"><b> <div ".'class="org-circle org-circle-red"'.">" . $rl2cnt . "</div> <br/> <br /><div>". $d4['EmpName'] . "</div></b></br></font></div>";
						}
					}

					$rlname4aa .= $d4['EmpName'] . ",\u000A ";
					$usrcnt++;
				}
			$rlname4aaa = substr($rlname4aa,0,-8);

		
		$rlname4a = "<div ".'class="pb15"'."><b> <div ".'class="org-circle"'.">" . $usrcnt . "</div> <br /><br /><div>". $rlname4 . "</div>". $rlshow_red4 ."</b></div>";
		

$str5 .= "['" . $rlname4a . "', '" . $rlname3a . "', '". $rlname4aaa ."'],";









		     if($r4!="") {

				if($dpt==0) {
				$qry5 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum4."'";
				} else {
					$qry5 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum4."' AND department='" .$dpt. "'";
				}

//echo $qry5 . "</br></br>";

				$res5 = mysql_query($qry5);
					while($row5 = mysql_fetch_array($res5))
					{
						$r5 = $row5['role'];
						$idnum5 = $row5['id'];
						$rlname5 = $row5['description'];

						$qry33 = "SELECT id, concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r5 . "' ORDER BY first_name";
						$res33 = mysql_query($qry33);
						$usrcnt=0;
						$rlname5aa="";
						$rlshow_red5="";
						while($ddd = mysql_fetch_array($res33))
						{
							$qry75= "SELECT COUNT(*) AS cnt FROM user where reports_to=" . $ddd['id'] . " HAVING COUNT(*) > 5";
							$res75 = mysql_query($qry75);
							while($row75 = mysql_fetch_array($res75))
							{
								$rl2cnt = $row75['cnt'];
								if($rl2cnt>5) {
								//	$rlshow_red5 .= "\u000A<div ".'class="p15"'."><font color=\"red\"><b><div>". $ddd['EmpName'] . "</div> <div ".'class="org-circle org-circle-red"'.">" . $rl2cnt . "</div></b></br></font></div>";
								}
							}
							$rlname5aa .= $ddd['EmpName'] . ",\u000A ";
							$usrcnt++;
						}
					$rlname5aaa = substr($rlname5aa,0,-8);

		
		//$rlname5a = "<div ".'class="pb15"'."><b><div>". $rlname5 . "</div> <div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlshow_red5 ."</div></b></div>";
		$rlname5a = "<div ".'class="pb15"'."><b> <div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname5 . "</div></b></div>";

$str5 .= "['" . $rlname5a . "', '" . $rlname4a . "', '" . $rlname5aaa . "'],";









				     if($r5!="") {

						if($dpt==0) {
							$qry6 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum5."'";
						} else {
							$qry6 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum5."' AND department='" .$dpt. "'";
						}

						$res6 = mysql_query($qry6);
							while($row6 = mysql_fetch_array($res6))
							{
								$r6 = $row6['role'];
								$idnum6 = $row6['id'];
								$rlname6 = $row6['description'];

								$qry33 = "SELECT id, concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r6 . "' ORDER BY first_name";
								$res33 = mysql_query($qry33);
								$usrcnt=0;
								$rlname6aa="";
								$rlshow_red6="";
								while($d6 = mysql_fetch_array($res33))
								{
									$qry75= "SELECT COUNT(*) AS cnt FROM user where reports_to=" . $d6['id'] . " HAVING COUNT(*) > 5";
									$res75 = mysql_query($qry75);
									while($row75 = mysql_fetch_array($res75))
									{
										$rl2cnt = $row75['cnt'];
										if($rl2cnt>5) {
											//$rlshow_red6 .= "\u000A<font color=\"red\"><b>". $d6['EmpName'] . " (" . $rl2cnt . ")</b></br></font>";
										
											//$rlshow_red6 .= "<div ".'class="p15"'."><font color=\"red\"><b><div>". $d6['EmpName'] . " </div><div ".'class="org-circle org-circle-red"'.">" . $rl2cnt . "</div></b></br></font></div>";
										}
									}

									$rlname6aa .= $d6['EmpName'] . ",\u000A ";
									$usrcnt++;
								}
								$rlname6aaa = substr($rlname6aa,0,-8);

						
						$rlname6a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname6 . "</div> <div>". $rlshow_red6 ."</div></b></div>";

$str5 .= "['" . $rlname6a . "', '" . $rlname5a . "', '" . $rlname6aaa . "'],";









						     if($r6!="") {

								if($dpt==0) {
									$qry7 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum6."'";
									} else {
										$qry7 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum6."' AND department='" .$dpt. "'";
									}
								//$qry7 = "SELECT role FROM user where reports_to_role = '" . $r6 . "' GROUP BY role";

								$res7 = mysql_query($qry7);
									while($row7 = mysql_fetch_array($res7))
									{
										$r7 = $row7['role'];
										$idnum7 = $row7['id'];
										$rlname7 = $row7['description'];

										$qry33 = "SELECT concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r7 . "' ORDER BY first_name";
										$res33 = mysql_query($qry33);
										$usrcnt=0;
										$rlname7aa="";
										while($d7 = mysql_fetch_array($res33))
										{
											$rlname7aa .= $d7['EmpName'] . ",\u000A ";
											$usrcnt++;
										}
									$rlname7aaa = substr($rlname7aa,0,-8);

							
							$rlname7a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname7 . "</div> </b></div>";

$str5 .= "['" . $rlname7a . "', '" . $rlname6a . "', '" . $rlname7aaa . "'],";









									   if($r7!="") {

										if($dpt==0) {
									$qry8 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum7."'";
									} else {
										$qry8 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum7."' AND department='" .$dpt. "'";
									}

										$res8 = mysql_query($qry8);
											while($row8 = mysql_fetch_array($res8))
											{
												$r8 = $row8['role'];
												$idnum8 = $row8['id'];
												$rlname8 = $row8['description'];


												$qry33 = "SELECT concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r8 . "' ORDER BY first_name";
												$res33 = mysql_query($qry33);
												$usrcnt=0;
												$rlname8aa="";
												while($d8 = mysql_fetch_array($res33))
												{
													$rlname8aa .= $d8['EmpName'] . ",\u000A ";
													$usrcnt++;
												}
											$rlname8aaa = substr($rlname8aa,0,-8);

											
											$rlname8a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname8 . "</div> </b></div>";
											
											

$str5 .= "['" . $rlname8a . "', '" . $rlname7a . "', '" . $rlname8aaa . "'],";








											   if($r8!="") {

												if($dpt==0) {
													$qry9 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum8."'";
													} else {
													$qry9 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum8."' AND department='" .$dpt. "'";
													}

												$res9 = mysql_query($qry9);
													while($row9 = mysql_fetch_array($res9))
													{
														$r9 = $row9['role'];
														$idnum9 = $row9['id'];
														$rlname9 = $row9['description'];


														$qry33 = "SELECT concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r9 . "' ORDER BY first_name";
														$res33 = mysql_query($qry33);
														$usrcnt=0;
														$rlname9aa="";
														while($d9 = mysql_fetch_array($res33))
														{
															$rlname9aa .= $d9['EmpName'] . ",\u000A ";
															$usrcnt++;
														}
													$rlname9aaa = substr($rlname9aa,0,-8);
													$rlname9a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname9 . "</div> </b></div>";

$str5 .= "['" . $rlname9a . "', '" . $rlname8a . "', '" . $rlname9aaa . "'],";









													   if($r9!="") {

														if($dpt==0) {
															$qry10 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum9."'";
															} else {
																$qry10 = "SELECT id, neev_designation as role, description FROM audi_neev_designation where reports_to_role = '".$idnum9."' AND department='" . $dpt . "'";
															}

														$res10 = mysql_query($qry10);
															while($row10 = mysql_fetch_array($res10))
															{
																$r10 = $row10['role'];
																$idnum10 = $row10['id'];
																$rlname10 = $row10['description'];

															$qry33 = "SELECT concat(first_name,' ',last_name) as EmpName FROM user where role = '6_" . $r10 . "'";
															$res33 = mysql_query($qry33);
															$usrcnt=0;
															$rlname10aa="";
															while($d10 = mysql_fetch_array($res33))
															{
																$rlname10aa .= $d10['EmpName'] . ",\u000A ";
																$usrcnt++;
															}
														$rlname10aaa = substr($rlname10aa,0,-8);
														$rlname10a = "<div ".'class="pb15"'."><b><div ".'class="org-circle"'.">" . $usrcnt . "</div><br /><br /><div>". $rlname10 . "</div> </b></div>";

$str5 .= "['" . $rlname10a . "', '" . $rlname9a . "', '" . $rlname10aaa . "'],";

															}
														$i++;
													    }  else { continue; } 		 ////// End of if 9
													}
												$i++;
											     }  else { continue; }  		 ////// End of if 8
											}
										$i++;
									    	}  else { continue; }  ////// End of if 7
									}
								$i++;
							    } else { continue; } ////// End of if 6
							}
						$i++;
						} else { continue; } ////// End of if 5
					}
				$i++;
				} else { continue; }	////// End of if 4
			}
		$i++;
		} else { continue; } ////// End of if 3
	 }
   $i++;
   } else { continue; }  ////// End of if 2
}


$str6 = substr($str5,0,-1);
//echo $str6;
//exit;

echo '<script type="text/javascript" src="loader.js"></script><div id="chart_div"></div>';


echo '<script>google.charts.load("current", {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn("string", "Name");
        data.addColumn("string", "Manager");
        data.addColumn({"type": "string", "role": "tooltip", "p": {"html": true}});
        
        
        

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([';

echo $str6;

echo  ']);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById("chart_div"));

        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {allowHtml:true, color:"#b0b6b8"});
	   //chart.draw(data, options);
      }
</script>';

