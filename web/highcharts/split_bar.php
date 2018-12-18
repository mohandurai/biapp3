<?php
session_start();
//echo $_SESSION['gridqry'];
//exit;

include("db2.php");

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

//$sql = $_SESSION['gridqry'];
$sql = "SELECT (select location_name from biweb.city_master where refid=loc12) as location, count(*) as outlets FROM `area_life_style_indicator_final` WHERE `related_menu_id` = 360 group by `loc12`";
$result = $conn->query($sql);
$rcnt = $result->num_rows;

//echo $rcnt . " <<<=== </br>"; 
//echo $str2a = "AAAAAAA";
//exit;   

$str2a = "";

if($rcnt==1) {
    $row = $result->fetch_assoc();
    $str2 = '{
        name: "' . $row['location'] . '", 
        data: ["' . $row['outlets'] . '"]

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

$parurl = $_SERVER['HTTP_REFERER'];
$query_str = parse_url($parurl, PHP_URL_QUERY);
parse_str($query_str, $query_params);
$checked = explode("_",$query_params['categs']);

$comb = $query_params['comb'];

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
<script src="code/highcharts.js"></script>

<div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo $title2; ?>'
    },
    
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    xAxis: {
            categories: ['']
        },

    series: [
        <?php echo $str2; ?>
    ]
});
		</script>

</div>

	</body>
</html>
