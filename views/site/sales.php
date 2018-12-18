<?php

/*
$this->registerJs(
  '$("document").ready(function(){  

      $("#markpot").click(function(e) {  
          alert("AAAAAAAAAAAAAA");
          $("#admin").hide();
          $("#sales").hide();
          $("#secsales").hide();
          $("#tersales").hide();
      });

  });'
);
*/

//echo "</br>";
//echo $_GET['r'] . " <<<<========</br>";

$site1 = $_GET['r'];

$site2 = explode("/",$site1);

//echo $site2[1];

$this->registerJs(
    '$("document").ready(function() {  
      var mod3 = "'. $site2[1] . '"
      //alert(mod3);
         if(mod3=="sales") {  
            //alert("Yesssssss");
            $("#admin").hide();
            $("#markpot").hide();
            $("#secsales").hide();
            $("#tersales").hide();

            $("#filter-area").show();
          }


        $("#proceed").click(function(e) {  
            //alert("Yesssssss");
            $("#chartview").show();
            $("#gridview").show();
            //alert($("#w0").val()+" <<==== "+$("#w1").val()+" <<==== "+$("#discover").val()+" <<==== "+$("#gender").val()+" <<==== "+$("#profiles").val());
            return false;
        });


    });'
  );


use yii\helpers\Html;
$this->title = 'Marketing Potential';
$this->params['breadcrumbs'][] = $this->title;

//echo "Welcome to Martket Potential !!!!!!!";

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

$url3 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/reports/report1.php";

$urlchart = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/highcharts/sample.php";

$url5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1];

//echo $url3 . "</br>";
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<link rel="stylesheet" href="./js/leaflet.css" />
<script src="./js/leaflet.js"></script>

<script> 
function callfresh() {
  var url5 = "<?php echo $url5; ?>"+"/web/index.php?r=site%2Fmarketingpotential";
  //alert(url5);
  window.location.href= url5;
}

</script> 


<div style="width:100%; height:800px; overflow: auto;">

   <div style="width:50%; text-align:center; float:left;">
      <div id="map" style="border: 2px solid red; height: 300px;"></div>
      <button id='reload' value='Refresh' onclick="callfresh();">Refresh</button>
   </div>

   <div id="chartview" style="display:none; width:50%; border: 2px solid red; text-align:center; float:left;">
      <iframe src="<?php echo $urlchart; ?>" width="100%" height="290px;" scrolling="yes"></iframe>
   </div>

  <iframe  id="gridview" src="<?php echo $url3; ?>" style="display:none; width:100%; height:700px; overflow: auto;"></iframe>

</br></br></br></br></br></br>

</div>


