<?php
session_start();
echo $_SESSION['gridqry'];
exit;
if(isset($_REQUEST['refresh']))
{
    ?>
<script>
$("#container1").html('');
</script>
    <?php
}
include("db2.php");
error_reporting(-1);
//$host = "localhost";
//$username = "root";   
//$password = "1111";   
//$dbname = "test5";    
    
//echo $host . " ZZZ<<== " . $dbname . " <<== " . $username  . " <<== " . $password;   
//exit;   

$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $combine="";
    $year=$_REQUEST['year'];
    $category=explode("_",$_REQUEST['categs']);
    $relatedid=implode(",",$category);
    $locationid=$_REQUEST['locid'];
    $comb=$_REQUEST['comb'];
    
//$sql = $_SESSION['gridqry'];
 // $sql = "SELECT (select location_name from biweb.city_master where refid=loc12) as location, count(*) as outlets FROM `area_life_style_indicator_final` WHERE `related_menu_id`  in ($relatedid)";

$sql = "SELECT 'Total' as `location`, count(*) as outlets FROM `area_life_style` WHERE `related_menu_id`  in ($relatedid)";
 // group by `loc12`";

$result = $conn->query($sql) or die(mysqli_error($conn3));;
$rcnt = $result->num_rows;

//echo $rcnt . " <<<=== </br>"; 
echo $sql;
exit;   


$str2a = ""; $str2="";

if($rcnt==1) {
    $row = $result->fetch_assoc();
   
    $str2 = '{
        name: "' . $row['location'] . '",
          color:"#0a560a",
        data: ['.$row['outlets'] . ']

    }';
} elseif($rcnt>1) {
    //echo "GGGGGGGGGG</br>";
    while($row = $result->fetch_assoc()) {
        $str2a .= '{name: "' . $row['location'] . '", data: [' . $row['outlets'] . "]},";
    }

    $str2 = substr($str2a,0,-1);
    
} else {
    echo "Error !!!!";
}

// $parurl = $_SERVER['HTTP_REFERER'];
// $query_str = parse_url($parurl, PHP_URL_QUERY);
// parse_str($query_str, $query_params);
// $checked = explode("_",$query_params['categs']);

// $comb = $query_params['comb'];

//echo "<pre>";
//print_r($comb);
//echo "</pre>";

if($comb==0) {
    $title2 = "Values";    
} else {
    $title2 = "Count";
}

//echo $str2 . " </br>";
//exit;

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	</head>
	<body>

<script type="text/javascript" src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container1" style="min-width: 100%; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">

Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $title2; ?>'
    },
    colors: ['#7cb5ec'],
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    xAxis: {
        min:0,
        max:2,
            categories: ['Total']
        },

    scrollbar: {
            enabled: true
    },


    series: [
        <?php echo $str2; ?>
    ]
});
		</script>

</div>

	</body>
</html>
