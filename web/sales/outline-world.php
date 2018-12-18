<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/../../config/web.php');
new yii\web\Application($config);
use yii\helpers\ArrayHelper;
$login=Yii::$app->user->identity->id;
$clientuserid=Yii::$app->user->identity->client_user_id;
// print_r($clientuserid);die;
include("function.php");
$mapload=new Loadmap();
$fileloc=$mapload->init($clientuserid);
$searchls=$mapload->search();
?>
<?php
$p1 = explode("/",$_SERVER['REQUEST_URI']);
if (isset($_SERVER['HTTPS']) &&($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
  }
else {
    $protocol = 'http://';
}
$url5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1];
$url5map = $protocol . $_SERVER['HTTP_HOST'] . "/". $p1[1]."/". $p1[2]."/". $p1[3];
$url3 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/sales";
$fileurl = $protocol . $_SERVER['HTTP_HOST'] . "/". $p1[1]."/". $p1[2]."/sales/";
?>

<!doctype html>

<html lang="en">
<head>
<title>Brandidea Analytics</title>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!--old -->
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/fontawesome/css/font-awesome.css">
<link rel='stylesheet' href='css/spectrum.css' />
<link rel="stylesheet" href="css/jquery-confirm.min.css">
<link rel="stylesheet" href="css/jsPanel.css">
<link href="https://google-developers.appspot.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="tipped.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="tipped.css"/> -->
<script type="text/javascript">var map;var svglat = [];</script>
<script src="js/jquery.js"></script>
<script src="js/highstock.src.js"></script>
<script src="js/highcharts-more.js"></script>
<script src="js/exporting.js"></script>
<script src="js/export-data.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="togeojson.js"></script>
<script src="geoxml3.js"></script>
<script src="js/jquery-confirm.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/tooltip.js"></script>
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src='js/spectrum.js'></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/piecharts_new.js"></script>
<script type="text/javascript" language="javascript" src="js/gradient.js"></script>
<script src="circles.js"></script>
<!-- <script src="js/svgoverlay.js"></script> -->
<script type="text/javascript" language="javascript" src="js/kml-polygon-to-svg-master/dist/index.js"></script>
<!-- <script type="text/javascript" language="javascript" src="tipped.js"></script> -->
<!-- <script type="text/javascript" src="custom_tooltip.js"></script> -->
<!-- <script src="http://maptooltip.googlecode.com/files/mapTooltip.js" type="text/javascript"></script> -->
<!--Geo json conversion End-->

<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->
<style type='text/css'>
.jsPanel
{
 -webkit-user-select: none; /* Safari 3.1+ */
    -moz-user-select: none; /* Firefox 2+ */
    -ms-user-select: none; /* IE 10+ */
    user-select: none; /* Standard syntax */
}
     /*html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }*/
    #map {
        position: relative;
        top:0;
        left: 0;
        right: 0;
        bottom:0;
        width: 100%; height: 100%; float: left;
       /* height: 100%;*/
        /*zoom: 1.15;*/
    }
    #map div {
   cursor:default !important;
  }
    #chart {
        /* position: relative; */
        width: 100%; height: 100%;
    }
    #report {
        position: relative;
        /* top:13px;
        left: 0;
        right: 0;
        bottom:0; */
        width: 100%; height: 50%; float: left;
        margin: 0;
        padding: 5px 8px 0;
    }
    #btn-spin {
      position: relative;
      left: 200px;
      z-index: 10;
      font-size: 1.5em;
    }
    .help {
        font-size: 1.5em;
        position: relat;
        top:0;
        left: 0;
        right: 0;
        height: 30px;
        z-index: 10;
        background-color: rgba(0,0,0,0.5);
        color: white;
        padding: 10px;
        margin: 0px;
        text-align: center;
      }
    .help a.sources {
        float: left;
        margin-left: 50px;
        color: white;
     }
    .help a.logo {
        float: right;
    }
    .help a.logo img {
        height: 30px;
    }
    .tooltip{
  border:thin 1px #eee;
  background-color:#FFFFFF;
  padding:5px;
  width:250px;
  }
  /* ul{
      background-color:#eee;
      cursor:pointer;
  } */
  /* li{
      padding:12px;
  } */
  .legend1 {
text-align: left;
/* width: 200px; */
line-height: 18px;
color: #000;
/*background-color:white;*/
/*height:40px;
width:50px;*/
}
#legendlabel b
{
  color:#fff;
}
.legend1 .circle {
float: left;
  width: 7px;
  height: 7px;
  margin: 5px 5px 0 0;
  border: 1px solid rgba(0, 0, 0, .2);
}

 .legend2 {
text-align: left;
width: auto;
line-height: 18px;
color: #555;
/*background-color:white;*/
/*height:50px;
width:50px;*/
}
.legend2 .circle1 {
float: left;
  width: 6px;
  height: 6px;
  margin: 5px 5px 0 0;
  border: 1px solid rgba(0, 0, 0, .2);
}
#legendcluster {
    border-radius: 5px;
    background: white;
    padding: 5px;
    margin: 10px;
    transition: all 0.5s ease  0.5s !important;
    bottom:0 !important;
  }
  #legendcluster:hover {
    box-shadow: 0 0 112px 10px #1DB9E8;
  }
  #legendcluster p
  {
    margin:1px 0;
  }
.report-container
{
    padding: 0 0;
    margin: 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow:0 2px 10px rgba(0, 0, 0, 0.2);
    display: block;
    float: left;
    width: 99%;
    border: 1px solid #000;
    background: #ffffff;
    min-height: 100%;
}
.report-header
{
  background: #333;
  display: block;
  float: left;
  width: 100%;
  padding: 0 10px;
}
.report-container h4
{
  margin: 0;
  padding: 5px 10px;
  color: #ffffff;
  display:  inline-block;
  font-size: 14px;
}
#tool{
text-align: center;
    border: 3px solid green;
}
@media only screen and (max-width: 1024px) {
    .map-container, .chart-container{width:49%;}
}
@media only screen and (max-width: 768px) {
    .map-container, .chart-container{width:100%;}
}
/* a[href^="http://maps.google.com/maps"]{display:none !important}
a[href^="https://maps.google.com/maps"]{display:none !important}
.gm-style-cc
{
  display: none;
} */

</style>
<script type="text/javascript">
var cphistory = [];
var swbounds = [];//southwest bounds
var nebounds = [];//northwest bounds
var zoomO = 0;
// sessionStorage.setItem('sw','');
// sessionStorage.setItem('ne','');
var zoomsvgarray = [];
var location_type ="";
var commented_elemt = new Array();
var layers_arr =[];
var history=new Array();
var historyg=new Array();
var editableLayers;
var global_marker;
var findduplicates = 0;
var routingControl;
var tblcnt =0;
var isDataEmpty = 0;
var rowstable = '';
var piechartmarker = [];
var jquerydatatable = '';
var mnidfileter = '';
var charts ='';
var splitname3 = 0;
var chartcatgr = '';
var chartseries = '';
var chartdupseries = '';
var fullcnt ='';
var splitarray = '';
var titleval ='';
var source_report ='';
var retailerchk = '';
var spitdata = '';
var colorcodeid = [];
var areavalue =[];
var all_overlays=[];
var markcluster=[];
var type;
var menus;
var infowindowm;
var markerCluster;
var  markerscharts = [];
var tablebck;
var colorstore = new Array();
var tstclrarry = new Array();
var dynamicrangeval = new Array(); //for range filter
var maprmitms = []; //for split filter
var svg;
var overlay;
var goprevy = 0;
var issetsvg = 0;
var fldarr=new Array();
var fldidarr=new Array();
var fldarrfinal=new Array();
var namebuild=new Array();
var fldname=new Array();
var globalcharts = '';
var cenpoints = [];
function alert_find(){
  alert('data not available');
}
sessionStorage.setItem("loc_filter",'');
sessionStorage.setItem("variable_fiter",'');
sessionStorage.setItem("range_filter",'');
sessionStorage.setItem('selectval','');
sessionStorage.setItem('svgnxt','');
sessionStorage.getItem('resulttype','');
 $(document).ready(function (){

   if (sessionStorage.getItem("theme") !== null) {
     $('body').addClass(sessionStorage.getItem("theme"));
   }
  //  $(".jsPanel").mouseover(function(){
  //   $ ('.jsPanel').trigger( "click" );
  // });
// $('body').find('.gm-style-mtc').parent().eq(0).css('display','none');
    $('body').on('click', '.gm-style-mtc', function(e) {
      // e.stopImmediatePropagation();
      // $('.gm-style-mtc').css('display','block');
      // $(this).hide();
      // alert($(this).find('div').attr('title'));
            myOptions = {};

            if($(this).find('div').attr('title') == 'Show street map')
            {
                  map.setOptions({
                  zoomControl: true
                  });
              myOptions.mapTypeControlOptions = {
              mapTypeIds: [
              'mystyle',
                google.maps.MapTypeId.HYBRID

              ]};
            }
            else if($(this).find('div').attr('title') == 'Show imagery with street names')
            {
               map.setOptions({
                  zoomControl: true
                  });
              myOptions.mapTypeControlOptions = {
              mapTypeIds: [
              'mystyle',
                google.maps.MapTypeId.ROADMAP

              ]};
            }
            else
            {
                  map.setOptions({
                  zoomControl: false
                  });
                  myOptions.mapTypeControlOptions = {
                  mapTypeIds: [
                  google.maps.MapTypeId.HYBRID,
                  google.maps.MapTypeId.ROADMAP

                  ]};


                          file11 = sessionStorage.getItem('maplevel');
        if(file11=="SVG/1---21---21.svg")
        {


              // file1=file11.split("SVG/");
              // file2=file1[1].split(".svg");
              // file3=file2[0].split("---");
              // locid=file3[0];
              // parentlvl=file3[1];
              // childlvl=file3[2];

          sw = new google.maps.LatLng(-52.7583653915395, -180);
          ne = new google.maps.LatLng(77.36713192729601, 180);
          var bounds = new google.maps.LatLngBounds(sw,ne);
          map.fitBounds(bounds);
          map.setZoom(map.getZoom()+1);

        }
        else if(file11=="SVG/1---21---1.svg")
        {

          sw = new google.maps.LatLng(-52.7583653915395, -180);
          ne = new google.maps.LatLng(77.36713192729601, 180);
          var bounds = new google.maps.LatLngBounds(sw,ne);
          map.fitBounds(bounds);
          map.setZoom(map.getZoom()+1);

        }
        else
        {
                sw = sessionStorage.getItem('sw');
                sw=sw.split(",");
                sw = new google.maps.LatLng(sw[0], sw[1]);
                ne = sessionStorage.getItem('ne');
                ne=ne.split(",");
                ne = new google.maps.LatLng(ne[0], ne[1]);
                var bounds = new google.maps.LatLngBounds(sw,ne);
                 map.fitBounds(bounds);
                  // map.setZoom(map.getZoom()-1);
        }

            }

            map.setOptions(myOptions);
            map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Hide' }));


  //     map.setOptions({
  //   mapTypeControl: false
  // });
      // console.log(map.mapTypeControlOptions);

    });
   // $('body').find('.gm-style-mtc').on
   // $('.gm-style-mtc').hide();
     $('#mapname').html(sessionStorage.getItem("refreshMapname"));

 $(document).on('load', function() {
   $(".spinner-wrapper").hide();

 });


//  document.addEventListener("click", function(){
//     document.getElementById("demo").innerHTML = "Hello World!";
// });
});
</script>
  <body onload="loadScript()">

    <!-- <div class="loading" style = "display:none">Loading&#8230;</div> -->
    <div class="spinner-wrapper" style = "display:none">
    <div class="sk-cube-grid">
      <div class="sk-cube sk-cube1"></div>
      <div class="sk-cube sk-cube2"></div>
      <div class="sk-cube sk-cube3"></div>
      <div class="sk-cube sk-cube4"></div>
      <div class="sk-cube sk-cube5"></div>
      <div class="sk-cube sk-cube6"></div>
      <div class="sk-cube sk-cube7"></div>
      <div class="sk-cube sk-cube8"></div>
      <div class="sk-cube sk-cube9"></div>
    </div>
    </div>
<!-- <div class="loading" >Loading&#8230;</div> -->
  <input type="text" id="markeropt" hidden="true" value="0"/>
<br>
<div id="info"></div>
 <div id="right-panel">
      <span class="close">X</span>
 </div>
 <div id="legend-popup" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
   <div class="modal-dialog modal-sm" role="document">

     <div class="modal-content">

       <div class="modal-body"><div id="cl"></div></div>
       <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
     </div>

   </div>
 </div>
</body>
<!--MAP-->
<script>
  //$( ".dragme" ).draggable();
// var fakedata = ['test1','test2','test3','test4','ietsanders'];
// $("#customerAutocomplte").autocomplete({source:fakedata})
 // Create the search box and link it to the UI element.
baseurl='<?php echo  $fileurl;?>';
  // });
//console.log
// $('#customerAutocomplte').autocomplete({
//     serviceUrl: '/autocomplete/countries',
//     onSelect: function (suggestion) {
//         alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
//     }
// });
var $info = $('#info');
var file;
var defaulturl='<?php echo $fileurl;?>';

var styles = {
        default: null,
        silver: [
          {
            elementType: 'geometry',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          },
          {
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            elementType: 'labels.text.stroke',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#bdbdbd'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#ffffff'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#dadada'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#c9c9c9'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          }
        ],
        night: [
          {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
          {
            featureType: 'administrative.locality',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#263c3f'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#6b9a76'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#38414e'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry.stroke',
            stylers: [{color: '#212a37'}]
          },
          {
            featureType: 'road',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9ca5b3'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#746855'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#1f2835'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#f3d19c'}]
          },
          {
            featureType: 'transit',
            elementType: 'geometry',
            stylers: [{color: '#2f3948'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'labels.text.fill',
            stylers: [{color: '#d59563'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#17263c'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#515c6d'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#17263c'}]
          }
        ],
        retro: [
          {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
          {
            featureType: 'administrative',
            elementType: 'geometry.stroke',
            stylers: [{color: '#c9b2a6'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'geometry.stroke',
            stylers: [{color: '#dcd2be'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ae9e90'}]
          },
          {
            featureType: 'landscape.natural',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#93817c'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry.fill',
            stylers: [{color: '#a5b076'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#447530'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#f5f1e6'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [{color: '#fdfcf8'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#e9bc62'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry',
            stylers: [{color: '#e98d58'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry.stroke',
            stylers: [{color: '#db8555'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#806b63'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8f7d77'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#ebe3cd'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [{color: '#b9d3c2'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#92998d'}]
          }
        ],
        hiding: [
          {
            featureType: 'poi.business',
            stylers: [{visibility: 'off'}]
          },
          {
            featureType: 'transit',
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          }
        ]
      };
var myStyle =
[
                        {stylers: [ {"visibility": "on" } ] },
                        {
                        featureType: "all",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
                        {
                        featureType: "road",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
                        {
                        featureType: "administrative",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
                        {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },{
                        featureType: "water",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },{
                        featureType: "road",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
                        {
                          featureType: "road.highway",
                          elementType: "geometry",
                          stylers: [
                        { visibility: "off"
                        }]
                        },
                        {
                        featureType: 'poi.business',
                        stylers: [
                        {visibility: 'off'
                        }]
                        },
                        {
                        featureType: 'transit',
                        elementType: 'labels.icon',
                        stylers: [{visibility: 'off'}]
                        },
                        {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{visibility: 'off'}]
                        },
                        {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
];
var myStyle1 =
[
                               {
                                featureType: "road",
                                     elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                featureType: "administrative",
                                elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                featureType: "poi",
                                elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                  featureType: "water",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                 },
                                {
                                  featureType: "road",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                },
                                {
                                             featureType: "road.highway",
                                             elementType: "geometry",
                                             stylers: [
                                     { visibility: "off"
                                     }]
                                           },
                                           {
                                  featureType: "water",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                 },
                                {
                                  featureType: "road",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                },
                                {
                                             featureType: "road.highway",
                                             elementType: "geometry",
                                             stylers: [
                                     { visibility: "off"
                                     }]
                                           },
                                {
                                featureType: 'poi.business',
                                stylers: [
                                {visibility: 'off'
                                }]
                                },
                                {
                                featureType: 'transit',
                                elementType: 'labels.icon',
                                stylers: [{visibility: 'off'}]
                                },
                                {
                                featureType: 'water',
                                elementType: 'geometry',
                                stylers: [{visibility: 'off'}]
                                },
                                {
                                featureType: "poi.park",
                                elementType: "geometry",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {stylers: [ {"visibility": "on" } ] },
                                {
                                featureType: "road",
                                     elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                featureType: "administrative",
                                elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                featureType: "poi",
                                elementType: "labels",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
                                {
                                  featureType: "water",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                 },
                                {
                                  featureType: "road",
                                  elementType: "labels",
                                  stylers: [
                                    { visibility: "off" }
                                  ]
                                },
                                {
                                             featureType: "road.highway",
                                             elementType: "geometry",
                                             stylers: [
                                     { visibility: "off"
                                     }]
                                           },
                                {
                                featureType: 'poi.business',
                                stylers: [
                                {visibility: 'off'
                                }]
                                },
                                {
                                featureType: 'transit',
                                elementType: 'labels.icon',
                                stylers: [{visibility: 'off'}]
                                },
                                {
                                featureType: 'water',
                                elementType: 'geometry',
                                stylers: [{visibility: 'off'}]
                                },
                                {
                                featureType: "poi.park",
                                elementType: "geometry",
                                stylers: [
                                { visibility: "off" }
                                ]
                                },
];
 </script>
<!--Initial map call-->
<script>
//Global Variable
var file;
var file1;
var conversion;
var countrynames=[];
var countryid=[];
var maplayer;
var presentkey=[];
var historyarr=[];
var historyarr_svg = [];
var goperv_svg ='N';
var markerarr=[];
var aerialdist=[];
var distancearr=[];
var marker;
var latlngarr=[];
var infowindow1;
var directionsDisplay;
var directionsService;
var color_arry=[];
var drawingManager;
var centerpoint=[];
var cityCircle;
var circlearr=[];
var drawingTool;
var circle;
var circles=[];
var radius=[];
var zoomarr=[];

var refid=[];
var mastername=[];
var lat=[];
var lan=[];



    function colorgenerator(negativecnt,postivecnt,coloshadesnegative,coloshades)
    {
        let colorsg = new GradientArray();
        if(negativecnt > 0)
        {
          ngtval = negativecnt;
          coloshadesnegative.push(colorsg.gradientList("#ff0000","#ffcccc", ngtval));
            coloshadesnegative = coloshadesnegative[0];
           if(negativecnt == 1)
           {
                coloshadesnegative.pop();
           }
          coloshadesnegative.reverse();
          if(postivecnt > 0)
          {
            HexFrom = "#004000";
            HexTo = "#1aff1a";
            postivecnt = Math.abs(postivecnt);
            coloshades.push(colorsg.gradientList(HexFrom,HexTo,postivecnt));
            coloshades = coloshades[0];
             if(postivecnt == 1)
             {
               coloshades.pop();
             }
            coloshades = coloshades.concat(coloshadesnegative);
          }
          else
          {
            coloshades = coloshadesnegative;
          }
        }
        else
        {
          HexFrom = "#004000";
          HexTo = "#1aff1a";
          postivecnt = Math.abs(postivecnt);
          coloshades.push(colorsg.gradientList(HexFrom,HexTo,postivecnt));
          coloshades = coloshades[0];
        }
        return coloshades;
    }
    function sortFloat(a,b) { return a - b; }
    function createslider(from,to,pram)
    {
        $( "body #slider-range" ).slider({
        range: true,
        min: from,
        max: to,
        values: [ from, to ],
        slide: function( event, ui ) {
        if(pram == 1){
        // alert(ui.values);
        $( "#byrank1" ).val( ui.values[ 0 ]  );
        $( "#byrank2" ).val(  ui.values[ 1 ] );
        }
        else
        {
        $( "#byrange1" ).val( ui.values[ 0 ]  );
        $( "#byrange2" ).val(  ui.values[ 1 ] );
        }
        }
        });
        if(pram == 1)
        {
        $( "#byrank1" ).val($( "body #slider-range" ).slider( "values", 0 ));
        $( "#byrank1" ).val($( "body #slider-range" ).slider( "values", 1 ));
        }
        else
        {
        $( "#byrange1" ).val($( "body #slider-range" ).slider( "values", 0 ));
        $( "#byrange2" ).val($( "body #slider-range" ).slider( "values", 1 ));
        }
    }
    function updaterank()
    {
      comb = sessionStorage.getItem('groupby');
      filteryear = sessionStorage.getItem('year');
      view = sessionStorage.getItem('view');
      var resyear = filteryear.split(",");
      tablcolmns = jquerydatatable.columns( { filter : 'applied'} ).data();
      var arrayint = [];
      if(resyear.length > 1 && (view !=0))
      {
        var arrindex = 1+resyear.length
        var arr = tablcolmns[arrindex];
      }
      else
      {
        if(comb == 'C')
        {
        var arr = tablcolmns[1];
        }
        else
        {
        var arr = tablcolmns[2];
        }
      }
      for(jk=0;jk<arr.length;jk++)
      {
        var find = ',';
        var re = new RegExp(find, 'g');
        arr[jk] = arr[jk].replace(re, '');
        arrayint.push(parseFloat(arr[jk]));
      }
      var sorted = arrayint.slice().sort(function(a,b){return b-a})
      var ranks = arrayint.slice().map(function(v){ return sorted.indexOf(v)+1 });
      ranks = ranks.sort(sortFloat);
      createslider(ranks[0],ranks[ranks.length-1],1);
       $('#byrank1').val(ranks[0]);
        $('#byrank2').val(ranks[ranks.length-1]);
    }
    function updaterange()
    {
        comb = sessionStorage.getItem('groupby');
        filteryear = sessionStorage.getItem('year');
        var resyear = filteryear.split(",");
         if(dynamicrangeval.length == 0)
         {
          dattablesoure = jquerydatatable.columns( { filter : 'applied'} ).data();//jquerydatatable.columns().data();
          // console
          // console.log(jquerydatatable.columns().data());
          if(resyear.length > 1 && view !=0 && view !=5 && comb == 0)
          {
           sourceindx = (resyear.length)+1;
          }
          else  if(resyear.length > 1 && view > 0 && view !=5 && comb == 1)
          {
           sourceindx = (resyear.length)+2;
          }
          else
          {
            if(comb == 'C')
            {
                var cummlativedata = 0;
                if(view ==0 || view == 5)
                {
                  cummlativedata = 1;
                }
              if(resyear.length > 1 && cummlativedata ==1){
              sourceindx = 1;
              }
              else
              {
              sourceindx = (resyear.length);
              }
            }
            else
            {
               var cummlativedata = 0;
                if(view ==0 || view == 5)
                {
                  cummlativedata = 1;
                }
               if(resyear.length > 1 && cummlativedata ==1)
               {
                 sourceindx = 2;
                }
                else
                {
                  sourceindx = (resyear.length)+1;
                }
            }
          }
          // console.log(comb);
          // console.log(sourceindx);
          dattablesoure = dattablesoure[sourceindx];
          // console.log(dattablesoure);
          // console.log(jquerydatatable.columns().data());
          var find = ',';var re = new RegExp(find, 'g'); //str = searchData[jk].replace(re, '');
          for(dt=0;dt<dattablesoure.length;dt++)
          {
          dattablesoure[dt] = parseFloat(dattablesoure[dt].replace(re,''));
          }
        }
         else
        {
           dattablesoure=new Array();//dynamicrangeval;
           // dynamicrangeval=[];
           // alert("SDfs");
           dattablesourechk = jquerydatatable.rows( { filter : 'applied'} ).data();
                $.each(dattablesourechk, function(idx, item) {
                  // console.log(dattablesourechk[idx]);
                      dattablesoure.push(dynamicrangeval[dattablesourechk[idx]['DT_RowId']]);
                });

        }
        // console.log(dattablesoure);
        max = Math.max.apply(Math,dattablesoure); // 3
        min = Math.min.apply(Math,dattablesoure)
        $('#by-rank').find('span').empty();
        $('#by-name').find('span').empty();
        $('#byrank1').val('');
        $('#byrank2').val('');
        //delayMillis = 1000;
        $("#byrange1").val(min);
        $("#byrange2").val(max);
        createslider(min,max,2);
    }
baseurl='<?php echo  $fileurl;?>';
//Global Local stroage
sessionStorage.setItem("selectedlocation1","");
// console.log(sessionStorage.getItem("currentloadfile"));

if(sessionStorage.getItem("currentloadfile") != "" && sessionStorage.getItem("currentloadfile") != null )
{

   var initfile=sessionStorage.getItem("currentloadfile");
   var zoomn=sessionStorage.getItem("currentzoom");
   var historyarr=JSON.parse(sessionStorage.getItem("hist"));
   var zoomarr=JSON.parse(sessionStorage.getItem("zoom"));
   var cphistory = JSON.parse(sessionStorage.getItem("cphistory"));
   // console.log('sessionStorage.getItem("sw")');
   // console.log(sessionStorage.getItem("sw"));
    // try{
    // var sw = JSON.parse(sessionStorage.getItem("sw"));
    // var ne = JSON.parse(sessionStorage.getItem("ne"));
    // }
    // catch(e){
    // var sw = JSON.parse(sessionStorage.getItem("sw"));
    // var ne = JSON.parse(sessionStorage.getItem("ne"));
    // }

    // var  swbounds.push(sessionStorage.getItem('sw'));
    //   sessionStorage.setItem("swbounds", JSON.stringify(swbounds));
    //   nebounds.push(sessionStorage.getItem('ne'));
    //   sessionStorage.setItem("nebounds", JSON.stringify(nebounds));
   var swbounds = JSON.parse(sessionStorage.getItem("swbounds"));
   var nebounds = JSON.parse(sessionStorage.getItem("nebounds"));
   zoomarr.pop();
   historyarr.pop();
   cphistory.pop();
   swbounds.pop();
   nebounds.pop();
}
else
{

// {

  var initfile='SVG/<?php echo $fileloc?>.svg';



  var zoomn='';
// }

// else
// {

// var initfile='SVG/<?php //echo $fileloc?>.svg';
//     var zoomn='';
// }
//console.log("testing",initfile);

}
//initialize map
function initMap_new()
{
       var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: new google.maps.LatLng(21.146633, 79.088860),
        // mapTypeId: google.maps.MapTypeId.ROADMAP
        mapTypeControlOptions: {
        //   mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        mapTypeIds: [ google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        },
         // mapTypeId: 'mystyle',
      });
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend1'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend2'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend3'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend4'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend5'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend6'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend7'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend8'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend9'));
        map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Hide' }));
       // map.mapTypes.set('mystyle1', new google.maps.StyledMapType(myStyle1, { name: 'Map' }));
         directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
         // setTimeout(function() { if(map != null ){;} }, 5000);
         // svgexecution();
         // map123 = JSON.stringify(map);
           // sessionStorage.setItem('map', map123);
        var script1 = document.createElement('script');
        script1.type = 'text/javascript';
        script1.src = "js/svgoverlay.js";
        document.body.appendChild(script1);
        tileListener = google.maps.event.addListenerOnce(map,'idle',svgexecution);
//         google.maps.event.addListenerOnce( map, 'idle', function() {
//     svgexecution();
// });
}
//async defer
function initMap()
{
        drawingTool =   new google.maps.drawing.DrawingManager;
        directionsService = new google.maps.DirectionsService;
        map = new google.maps.Map(document.getElementById('map'),
         {
        center: {lat: 30.36037059235898, lng: -1.847078402945954},
        zoom: 1,
        gestureHandling: 'greedy',
        preserveViewport: true,
        zoomControl: false,
        panControl:true,
        disableDoubleClickZoom: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        draggable: true,
        scrollwheel: false,
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: true,
        mapTypeControlOptions: {
        //   mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        },
         mapTypeId: 'mystyle',
        });
        // map.setOptions({
        // animatedZoom: false,
        // });
        map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Hide' }));
       // map.mapTypes.set('mystyle1', new google.maps.StyledMapType(myStyle1, { name: 'Map' }));
         directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
         // $('body').find('.gm-style-mtc').parent().eq(0).css('display','none');
         // document.getElementById("myDIV").style.display = "none";
       //css('width', '100px !important');
            // var xmlhttp = new XMLHttpRequest();
            // xmlhttp.open('GET', 'india3a.svg', false);
            // xmlhttp.send();
            // var overlay = new SvgOverlay({
            // content: xmlhttp.responseText,
            // map: map
            // });
            // var svg = overlay.getSvg();
            // svg.setAttribute('opacity', 1);
            // console.log('overlay.getContainer()');
            // tes = overlay.getContainer();
            //svg part
            var script1 = document.createElement('script');
            script1.type = 'text/javascript';
            script1.src = "js/svgoverlay.js";
            document.body.appendChild(script1);
            console.log('BBBBBBBBBBBBBBBBBB');
            // tileListener = google.maps.event.addListener(map,'tilesloaded',svgexecution);
            //svg part ends here
            sessionStorage.setItem('map', map);
            sessionStorage.setItem("currentloadfile", initfile);
            initlayer(map,initfile,0,0,'');
            // $('#map').attr("style", "display: block !important");
            // $('#map').css('display','block !important');
            // initlayer('SVG/1---5---7.svg',0,0);
            maptraverse(map,initfile);

              // map.addListener(map, 'bounds_changed', function() {
              // console.log(map.getBounds());
              // });



            lisenter();
              var styleControl = document.getElementById('style-selector-control');

              map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);
          var legendc = document.getElementById('legendcluster');
          map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legendc);
              // Set the map's style to the initial value of the selector.
              var styleSelector = document.getElementById('style-selector');
              try {
               if( styles[styleSelector.value] !='')
               {
                map.setOptions({styles: styles[styleSelector.value]});
               }
              }
              catch(err) {
                console.log(err);
              }
              //map.setOptions({styles: styles[styleSelector.value]});
              // Apply new JSON when the user selects a different style.

              try {
               if( styleSelector !='')
               {
              styleSelector.addEventListener('change', function() {
                map.setOptions({styles: styles[styleSelector.value]});
              });
            }

          }
            catch(e) {
                console.log(e);
              }
                 var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          console.log(JSON.stringify(map.getBounds()));
          searchBox.setBounds(map.getBounds());
        });


      //  map.addListenerOnce('idle', function(){
      //   console.log('SDFDFDFDF');
      // $('body').find('.gm-style-mtc').parent().eq(0).css('display','none');
      // });
        var markersearch = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }
          // Clear out the old markers.
          markersearch.forEach(function(marker) {
            marker.setMap(null);
          });
          markersearch = [];
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
            // Create a marker for each place.
            markersearch.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);



          // alert($('body').find('.gm-style-mtc').length);
          //     $('body').find('.gm-style-mtc').parent().eq(0).css('display','none');
        });

  // google.maps.event.addListener(map, 'bounds_changed', function() {
  //       alert(map.getBounds());
  //       });
        }
function circpie()
{

    resulttype1 =sessionStorage.getItem('resulttype');
    if(resulttype1 =='C')
    {

    typeval=$("input[name=type]:checked").val();
    if(typeval == 'circle')
    {

    overlay.setMap(null);
    locationlayer();

    //typeval=$("input[name=type]:checked").val();

    }


    else if (typeval == 'svg')
    {
    locid=  sessionStorage.getItem('id');
    parentlvl = sessionStorage.getItem('parentlvl');
    childlvl =sessionStorage.getItem('childlvl');
    locationid=(locid==73) ? 14878 :locid;

    svgname = locationid+'---'+parentlvl+'---'+childlvl;

    removeAlllayer();
    removeAllcircles();
    removeAllcircles1();


    svgexecution_st_combine(svgname,'','onclick',history);
    svg_opacity(typeval);


    }



    }
    else if(resulttype1 =='S')
    {
    typeval=$("input[name=type]:checked").val();
    if(typeval == 'circle')
    {

    locationcolor();
    //overlay.setMap(null);
    combinesplit_res(1,0,0);

    }


    else if (typeval == 'svg')
    {
    //  alert("fhffkjfkjffojfmfm");
    locid=  sessionStorage.getItem('id');
    parentlvl = sessionStorage.getItem('parentlvl');
    childlvl =sessionStorage.getItem('childlvl');
    locationid=(locid==73) ? 14878 :locid;

    svgname = locationid+'---'+parentlvl+'---'+childlvl;

    //console.log("gh",svgname,history);
    // removeAlllayer();
    // removeAllcircles();
    // removeAllcircles1();

    //svgexecution_st_combine(svgname,'','onclick',history);

    svg_opacity(typeval);
    // opacityon=$("#custom-handle2").html();
    //     v=opacityon/100;
    //    svg = overlay.getSvg();
    //    svg.setAttribute('opacity', v);
    }



    }
    else{
    svg_opacity(typeval);
    locationlayer();
    }
}
//initialize layer fn

function loc_type(mainloc,subloc,fileid)
    {
      $.ajax({
         url:'AjaxRequest.php' ,
        type:"POST",
        data:{"main_location": mainloc,
           "sub_location":subloc,
           "file_id":fileid,
           "mouseover":1,
        },

      success: function (data) {


       location_type=data;
       sessionStorage.setItem("loctype",  location_type);
        console.log(location_type);
      }});
    }



function initlayer(map,files,history,circle,zoomlevel) //initlayer(map,initfile,0,0,'');
{
          //alert(circle);


          // if(circle==1)
          //        {

          //         alert("megha");
          //   overlay.set(null);
          //      }

 // map.addListenerOnce('idle', function(){
 //        console.log('SDFDFDFDF');
 //      $('body').find('.gm-style-mtc').parent().eq(0).css('display','none');
 //      });
    /**
 * SVG Overlay constructor
 * @param {Object} options May contain the map and the content of the overlay
 */
function SvgOverlay(options) {
  this.options_ = options || {};
  this.container_ = document.createElement('div');
  this.container_.style.position = 'absolute';

  this.center_ = new google.maps.LatLng(0, 0);
  if (!this.options_.layer) {
    this.options_.layer = 'overlayLayer';
  }
  oversp1 = sessionStorage.getItem('map');
  if (this.options_.map) {
    this.setMap(this.options_.map);
  }

  if (this.options_.content) {
    this.setContent(this.options_.content);
  }
}
SvgOverlay.prototype = new google.maps.OverlayView();
/**
 * Internal method. Triggered when `setMap` was called with an argument.
 */
SvgOverlay.prototype.onAdd = function() {

  var li = this.getPanes()['overlayMouseTarget'].appendChild(this.container_);

};

/**
 * Set the new SVG content to display on a map.
 * @param {String} content The content to display (SVG)
 */
SvgOverlay.prototype.setContent = function(content) {
  this.container_.innerHTML = content;
  this.content_ = content;
  this.svg_ = this.container_.getElementsByTagName('svg')[0];

  this.draw();
};

/**
 * Get the assigned SVG string.
 * @return {String} The content passed in
 */
SvgOverlay.prototype.getContent = function() {
  return this.content_;
};

/**
 * Get the surrounding DOM container.
 * @return {Element} The container element
 */
SvgOverlay.prototype.getContainer = function() {
  return this.container_;
};

/**
 * Get the SVG element.
 * @return {Element} The SVG element
 */
SvgOverlay.prototype.getSvg = function() {
  return this.svg_;
};

/**
 * Internal method. Called when the layer needs an update.
 */
SvgOverlay.prototype.draw = function() {
  var projection = this.getProjection(),
    style, center, width, offset, left, top;

  if (!projection || !this.svg_) {
    return;
  }

  style = this.container_.style;


  svglat.push(this.center_);
  center = projection.fromLatLngToDivPixel(this.center_);
  width = Math.round(projection.getWorldWidth());
  offset = width / 2;

  left = Math.round(center.x) - offset;
  top = Math.round(center.y) - offset;

  // scale svg to world bounds
  this.svg_.setAttribute('width', width);
  this.svg_.setAttribute('height', width);

  // apply offset
  style.left = left + 'px';
  style.top = top + 'px';
};

/**
 * Internal method. Triggered when `setMap` was called with `null.
 */
SvgOverlay.prototype.onRemove = function() {
  this.container_.parentNode.removeChild(this.container_);
};

/**
 * Make module compatible to module loaders
 */
if (typeof module == 'object') {
  // console.log('robin');
  module.exports = SvgOverlay;
}


    //sessionStorage.setItem("file",file);
    sessionStorage.setItem("currentloadfile", files);
     try {
    overlay.setMap(null);
    }
    catch(err) {
    //document.getElementById("demo").innerHTML = err.message;
    }
    fetaurearr=[];
    // console.log('rose');
    // console.log(files);
    fileloc1=files.split("/");
    fileloc12=fileloc1[1].split(".svg");
    filesplit16 =fileloc12[0].split("---");
     if(typeof filesplit16[1] == 'undefined')
    {
        fileloc12=fileloc1[2].split(".svg");
        filesplit16 =fileloc12[0].split("---");
        // alert(filesplit16);
    }
    // alert(filesplit16);
    console.log('filesplit16');
    console.log(filesplit16);
    // alert(zoomlevel);
    if ((filesplit16[0]==15) || (filesplit16[0] == 12) || (filesplit16[0]==21))
    {
        if(zoomlevel != '')
        {
            var bounds = map.getBounds();
            // console.log(bounds);
            if(bounds != null)
            {
              var ne = bounds.getNorthEast(); // LatLng of the north-east corner
              var sw = bounds.getSouthWest(); // LatLng of the south-west corder
              var nw = new google.maps.LatLng(ne.lat(), sw.lng());
              var se = new google.maps.LatLng(sw.lat(), ne.lng());
              // alert(zoomlevel)



            }
               map.setZoom(zoomlevel);

        }
    }
    file=files;
    sessionStorage.setItem('maplevel',file);
    var conversion=[];
    var allMarkers = [];
    centerpoint=[];
     //console.log("moodydl",file);

    if(circle==1)
    {
        // overlay.set(null);

        circpie();
        if(file=="SVG/1---21---21.svg")
        {
        $("#mapname").text("Global");
        }

    }
    else if(circle==0 || circle=='')
    {
        $("#rep").val("")
        if(file=="SVG/1---21---21.svg")
        {
        $("#mapname").text("Global");
        }

        // if(file=="SVG/1---21---21.svg")
        // {


        //   file1=file.split("SVG/");
        //   file2=file1[1].split(".svg");
        //   file3=file2[0].split("---");
        //   fileid=file3[0];
        //   mainloc=file3[1];
        //   subloc=file3[2];

        // }
        // else if(file=="SVG/1---21---1.svg")
        // {


        //     file1=file.split("SVG/");

        //     file2=file1[1].split(".svg");
        //     file3=file2[0].split("---");
        //     fileid=file3[0];
        //     mainloc=file3[1];
        //     subloc=file3[2];

        // }


        // else
        // {
        //   file1=file.split("SVG/");
        //   file11=file1[1].split("/");
        //   console.log(file11);
        //   file2=file11[2].split(".svg");
        //   file3=file2[0].split("---");
        //   fileid=file3[0];
        //   mainloc=file3[1];
        //   subloc=file3[2];
        // }
                                  // if(mainloc=="21"&&subloc=="1")
                                  // {
                                  //  $("#mapname").text("Country");
                                  // }
                                  // else
                                  // {
                                  //  mapname1(mainloc,subloc,'','',fileid);
                                  // }


        svgpath = files.replace('kml','svg');
        svgpath = svgpath.replace('KML','SVG');
        svgnxt = sessionStorage.getItem('svgnxt');
             //console.log("buggggg",svgnxt);
          var ajax = new XMLHttpRequest();
          ajax.open("GET", svgpath, true);
          ajax.send();
        // Append the SVG to the target
         try {
      overlay.setMap(null); //removing svg
      }
      catch(err) {
      //document.getElementById("demo").innerHTML = err.message;
      }
        if(svgnxt == '')
        {

          ajax.onload = function(e)
          {
              $('body').find('#map div').eq(0).css("background-color","rgba(0, 0, 0,0.9)");
              // console.log('ZOMMM LEVEL');
              // console.log(map.getZoom()+2);
              // alert('t');
              // var opt = { minZoom: map.getZoom()-2, maxZoom: map.getZoom()+2 };
              // map.setOptions(opt);
              // alert(goprevy);
              // console.log('historyarr');
              // console.log(historyarr);
              // console.log(cphistory);

              overlay = new SvgOverlay({
              content: ajax.responseText,
              map: map,

              });

                console.log('overlay');
                console.log(overlay);



                sw = sessionStorage.getItem('sw');
                sw=sw.split(",");
                sw = new google.maps.LatLng(sw[0], sw[1]);
                ne = sessionStorage.getItem('ne');
                ne=ne.split(",");
                ne = new google.maps.LatLng(ne[0], ne[1]);
                console.log(filesplit16);
                if(filesplit16[1]!=21 && filesplit16[2]!=21 )
                {
                        geolvl = sessionStorage.getItem('geolvl');
                        geo=geolvl.split(",");
                        latlnggeo = new google.maps.LatLng(geo[0], geo[1]);
                        var center = latlnggeo;
                        console.log('dfdfdfdfdf');
                        console.log(JSON.stringify(center));
                        console.log(overlay.getProjection());

                        if ((filesplit16[0]==12) && (filesplit16[1] == 12))
                        {

                           //   var centerPt = overlay.getProjection().fromLatLngToDivPixel(center);
                           //  var topRightPt = new google.maps.Point(centerPt.x+10, centerPt.y+10);
                           //  var botLeftPt = new google.maps.Point(centerPt.x-10, centerPt.y-10);
                           // if(goprevy == 0 )
                           //        {
                           //          var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                           //          var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                           //        }
                            var bounds = new google.maps.LatLngBounds(sw,ne);




                            map.fitBounds(bounds);


                            // fruits.pop();
                            v=map.getZoom();
                            sessionStorage.setItem("currentzoom",v);
                            console.log(goprevy);
                            console.log('goprevy');


                        }
                        else if((filesplit16[0]==12) && (filesplit16[1] == 15))
                        {
                           // var centerPt = overlay.getProjection().fromLatLngToDivPixel(center);
                           //  console.log('1215');
                           //  var topRightPt = new google.maps.Point(centerPt.x+15, centerPt.y+15);
                           //  var botLeftPt = new google.maps.Point(centerPt.x-15, centerPt.y-15);
                           //  var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                           //  var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                            var bounds = new google.maps.LatLngBounds(sw,ne);


                            map.fitBounds(bounds);//}
                               // if(goprevy == 0 )
                               //  {
                               //    zoomsvgarray.push(map.getZoom());
                               //  }
                              // v=map.getZoom();
                              // sessionStorage.setItem("currentzoom",v);

                        }

                        else if((filesplit16[0]==filesplit16[1]))
                        {
                            // var topRightPt = new google.maps.Point(centerPt.x+20, centerPt.y+20);
                            // var botLeftPt = new google.maps.Point(centerPt.x-20, centerPt.y-20);
                            // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                            // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);

                            var bounds = new google.maps.LatLngBounds(sw,ne);


                                  if(goprevy != 0 )
                                  {
                                    // console.log()
                                    // if(((filesplit16[0] == 7) && (filesplit16[1] = 7) && (fileid == 17)))
                                    // {
                                    //   // console.log('RRRRRRRRRRRRRRRRRRRRR');
                                    // var bounds = new google.maps.LatLngBounds(

                                    // new google.maps.LatLng(11.593352,74.04960609999999),
                                    // new google.maps.LatLng(18.4411689,78.5860101)
                                    // );
                                    // map.fitBounds(bounds);
                                    // }
                                    //  if(((filesplit16[0] == 5) && (filesplit16[1] =5) && (fileid == 1)))
                                    // {
                                    //   var bounds = new google.maps.LatLngBounds(
                                    //   new google.maps.LatLng(7.798000,68.14712),
                                    //   new google.maps.LatLng(37.090000,97.34466));
                                    //   map.fitBounds(bounds);
                                    // }
                                    // console.log('RRRRROSEEEEEEEEEEEE')
                                    // console.log(JSON.stringify(sw));
                                    // console.log(JSON.stringify(ne));
                                    map.fitBounds(bounds);


                                  }
                                  else
                                  {

                                        map.fitBounds(bounds);
                                        zoomsvgarray.push(map.getZoom());
                                  }


                              // v=map.getZoom();
                              // sessionStorage.setItem("currentzoom",v);

                        }
                        else
                        {
                          console.log('else');
                          // var topRightPt = new google.maps.Point(centerPt.x+50, centerPt.y+50);
                          // var botLeftPt = new google.maps.Point(centerPt.x-50, centerPt.y-50);
                          // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                          // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                          var bounds = new google.maps.LatLngBounds(sw,ne);

                          if(goprevy != 0 )
                            {

                             //  if(((filesplit16[0] == 7) && (filesplit16[1] = 9) && (fileid == 17)))
                             //  {
                             //    var bounds = new google.maps.LatLngBounds(

                             //    new google.maps.LatLng(11.593352,74.04960609999999),
                             //    new google.maps.LatLng(18.4411689,78.5860101)
                             //    );
                             //    map.fitBounds(bounds);
                             //  }
                             // if(((filesplit16[0] == 5) && (filesplit16[1] = 7) && (fileid == 1)))
                             //          {
                             //            var bounds = new google.maps.LatLngBounds(
                             //            new google.maps.LatLng(7.798000,68.14712),
                             //            new google.maps.LatLng(37.090000,97.34466));
                             //            map.fitBounds(bounds);
                             //          }

                                      map.fitBounds(bounds);
                            }
                            else
                            {
                              map.fitBounds(bounds);
                              zoomsvgarray.push(map.getZoom());
                            }

                          // v=map.getZoom();
                          // sessionStorage.setItem("currentzoom",v);
                        }






                        //india bounds
                        // var bounds = new google.maps.LatLngBounds(
                        // new google.maps.LatLng(7.798000,68.14712),
                        // new google.maps.LatLng(37.090000,97.34466));

                        //karnat
                        // var bounds = new google.maps.LatLngBounds(
                        // new google.maps.LatLng(11.593352,74.04960609999999),
                        // new google.maps.LatLng(18.4411689,78.5860101)
                        // );
                        // 12.954517,77.3507335
                        // 12.9715987,77.5945627
                        // bengu city
                        // var bounds = new google.maps.LatLngBounds(
                        //                   new google.maps.LatLng(12.954517,77.3507335),
                        //                   new google.maps.LatLng(12.9715987,77.5945627)
                        //                   );
                        //                var southWest = new google.maps.LatLng( 12.97232, 77.59480 );
                        // var northEast = new google.maps.LatLng( 12.89201, 77.58905 );
                        // var bounds = new google.maps.LatLngBounds( southWest, northEast );


                        // map.fitBounds(bounds);

                        // alert('d');
                        // map.setZoom(map.getZoom()+2.2);
                         // map.setZoom(map.getZoom()+0.5);
                         console.log('VVVVVVVV');
                         // console.log(JSON.stringify(map.getBounds()));
                          //console.log(map.bounds.getNorthEast());
                          //console.log(map.bounds.getSouthWest());
                          //console.log('HHHHHHHHHHHHHHHHHHHH');
                }
                else
                {

                    //console.log('dddddddddddddddddddddddddd');
                    latlng = new google.maps.LatLng(30.36037059235898, -1.847078402945954);
                    map.setCenter(latlng);
                    map.setZoom(1);

                }
                // map.setZoom(map.getZoom()+0.5);

          }
        }




        if(file=="SVG/1---21---21.svg")
        {


        file1=file.split("SVG/");
        file2=file1[1].split(".svg");
        file3=file2[0].split("---");
        fileid=file3[0];
        mainloc=file3[1];
        subloc=file3[2];

        }
        else if(file=="SVG/1---21---1.svg")
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
          file = file.replace('kml','svg');
          file = file.replace('KML','SVG');
          file1=file.split("SVG/");
          console.log('TERERErerererere');
          console.log(file1);
          file11=file1[1].split("/");
          file2=file11[2].split(".svg");
          file3=file2[0].split("---");
          fileid=file3[0];
          mainloc=file3[1];
          subloc=file3[2];
        }



        //filesplit(file,"");
        // console.log(mainloc,"----",subloc)

        loc_type(mainloc,subloc,fileid);

    }

    if(history==0)
    {
      // sw = [];ne =[];
      historyarr.push(files);
      sessionStorage.setItem("hist", JSON.stringify(historyarr));
      zoomarr.push(map.getZoom());
      sessionStorage.setItem("zoom", JSON.stringify(zoomarr));
      cphistory.push(sessionStorage.getItem('geolvl'));
      sessionStorage.setItem("cphistory", JSON.stringify(cphistory));
      swbounds.push(sessionStorage.getItem('sw'));
      sessionStorage.setItem("swbounds", JSON.stringify(swbounds));
      nebounds.push(sessionStorage.getItem('ne'));
      sessionStorage.setItem("nebounds", JSON.stringify(nebounds));

    }
  //  togglelocationload(files);

}
       function zoom(map)
       {
        // console.log('reg');
        var bounds = new google.maps.LatLngBounds();
        // map = new google.maps.Map(el, {animatedZoom: false});
        map.data.forEach(function(feature) {
          processPoints(feature.getGeometry(), bounds.extend, bounds);
        });
        map.fitBounds(bounds);
    // if($("#map").attr("style")!='height:100%;width:100%;position: relative; overflow: hidden;')
    // {
        // $("body").css('display','none');
        v=map.getZoom();
        // map.setZoom(map.getZoom()+0.8);
        sessionStorage.setItem("currentzoom",v);
        // $("body").css('display','block');
   // }
      }
       function locationcolor()
  {
                  opacity=$("#custom-handle2").html();
                  opacity1=$("#custom-handle1").html();
                  v=opacity/100;
                  v1=opacity1/100;
                   map.data.setStyle(function(feature) {
                                                return {
                            strokeColor:  "#000000",
                            strokeOpacity: v,
                            strokeWeight: 1,
                            fillColor:'#fff',
                            fillOpacity: v,

                            };
                            });
                    $(".close").click();
                    $(".modal-backdrop.fade.in").remove();
  }
function maptraverse(map1)
{
    // Set the  style
    map1.data.setStyle(function(feature) {
          return {
            strokeColor: '#000',
            strokeOpacity:1,
            strokeWeight: 0.5,
            fillColor: '#FFF',
            fillOpacity: 0.5,
          };
    });
    var infowindow = new google.maps.InfoWindow();
    infowindow1 = new google.maps.InfoWindow();
      infowindowm= new google.maps.InfoWindow({
          maxWidth: 200
        });
     //Draw tool
     // setInterval(function(){
     //  alert(map.getZoom());
     // },10000)


      map1.addListener('dragend',  function(event) {
        map1.setOptions({ draggable : true });
         // $(".dragme").draggable("enable");
      });
       map.addListener('click', function(event) {
          // To find Aerial distance and distance  add marker
          //removeAllcircles();
           if($("#markeropt").val()!=0)
           {
             if($("#markeropt").val()!=0 && $("#markeropt").val()==1 && markerarr.length<2)
              {
                placeMarker(event.latLng);
              }
              else if(($("#markeropt").val()==2))
             {
                placeMarker(event.latLng);
             }
           }
       });
        //Click the map event
    map1.data.addListener('click', function(event) {
          // To find Aerial distance and distance  add marker
          //removeAllcircles();
           if($("#markeropt").val()!=0)
           {
             if($("#markeropt").val()!=0 && $("#markeropt").val()==1 && markerarr.length<2)
              {
                placeMarker(event.latLng);
              }
              else if(($("#markeropt").val()==2))
             {
                placeMarker(event.latLng);
             }
           }
           else
           {
              sessionStorage.setItem("selectedlocation1",event.feature.getProperty('DB_ID'));
              var bounds = new google.maps.LatLngBounds();
               fileloc=file.split("/");
                fileloc2=fileloc[1].split(".svg");
                 filesplit6 =fileloc2[0].split("---");
              if(filesplit6[1]!=21 || filesplit6[2]!=21){
                  if(filesplit6[1] != filesplit6[2]){
                    // processPoints(event.feature.getGeometry(), bounds.extend, bounds);
                    // map.fitBounds(bounds);
                  //  map.panTo(bounds.getLatlng());
                 }
                }
           }
    });
    //mouseover the map event
     //            map1.data.setStyle({
     //    title: 'Hovering here???'
     // });
      loc_type(mainloc,subloc,fileid);
    map1.data.addListener('mouseover', function(event) {


                    if(file=="SVG/1---21---21.svg")
                    {
                      file1=file.split("SVG/");

                      file2=file1[1].split(".svg");
                      file3=file2[0].split("---");
                      fileid=file3[0];
                      mainloc=file3[1];
                      subloc=file3[2];

                    }
                    else if(file=="SVG/1---21---1.svg")
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


              name = sessionStorage.getItem("loctype");

        if(colorcodeid.length > 0 && issetsvg == 0)//not split
        {
          if(areavalue[event.feature.getProperty('DB_ID')] != undefined)
          {
             var title = event.feature.getProperty('Name');
              title =" <b> "+title+"-"+name+":</b>"+areavalue[event.feature.getProperty('DB_ID')]+" <br>";
               infowindow.setContent(title);
              // infowindow.setPosition(event.latLng);
              // infowindow.open(map, map.data);
               injectTooltip(event, title);
          }
          else
          {
            var title = event.feature.getProperty('Name');
              // infowindow.setContent(title);
              // infowindow.setPosition(event.latLng);
              // infowindow.open(map, map.data);
                injectTooltip(event, title);
          }
        }
        else //split
        {
            if($("#markeropt").val()==0)
            {

             // console.log(event.feature.getProperty('Name'));
            name = sessionStorage.getItem("loctype");
             // alert(issetsvg);
             if(issetsvg == 1)
             {
                 // name = sessionStorage.getItem("loctype");
                  locid = event.feature.getProperty('DB_ID'); //$(this).attr('id');
                  locfilter = sessionStorage.getItem("loc_filter");

                  if(locfilter.indexOf(locid) != -1)//for location filter
                  {


                    getitem = sessionStorage.getItem('getstate_data');
                     colorsvg = sessionStorage.getItem('colorsvg');
                     colorsvg = JSON.parse(colorsvg);
                    mpdata = JSON.parse(getitem);
                    // console.log(mpdata);
                    // if(mainloc==12 && subloc==12)
                    // {
                    //   locid=(locid==73) ? 14878 :locid;
                    // }

                    if(mainloc==12 && subloc==15)
                    {
                      locid=(locid==73) ? 14878 :locid;
                    }
                    mmd = mpdata[locid];

                    str ='';
                     str+='<div class = "legend1"><b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1]+"-"+name+'</b><br>';
                    for(var ij =0;ij<arr.length;ij++)
                    {
                    // str ='';
                    if(ij<10){
                    fills=arr[ij].colr;//getsplitcolour(parseInt(ij));
                    tval =arr[ij].value;
                    var resco12 = tval.toString().split('.');
                    var resco1 =resco12[0].replace(/\,/g,'');
                    var amtcomma =moneyFormatIndia((resco1));
                    // reading
                    if ( resco1[1] !== void 0 )
                    {
                    if(resco12[1] != undefined)
                    {
                    amtcomma = amtcomma+'.'+resco12[1];
                    }
                    // amtcomma = amtcomma+'.'+resco12[1];
                    }

                    //str+='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+":"+amtcomma+'<br>';
                    }
                    // console.log(str);
                    }
                    str='</div>';
                    deleteTooltip(event);
                    injectTooltip(event,str);
                  }
                  else // no filter split
                  {
                      locid = event.feature.getProperty('DB_ID');
                    if(locfilter == '')
                    {
                        getitem = sessionStorage.getItem('getstate_data');
                        colorsvg = sessionStorage.getItem('colorsvg');
                        colorsvg = JSON.parse(colorsvg);
                        mpdata = JSON.parse(getitem);
                        // console.log(mpdata);
                        //locid=(locid==73) ? 14878 :locid;
                        mmd = mpdata[locid];

                        // var_fil = sessionStorage.getItem("variable_fiter");
                        // if(var_fil != '')
                        // {

                        //   var_fil = var_fil.split(',');
                        //   filarr = [];
                        //   for(var i=0;i<var_fil.length;i++)
                        //   {

                        //   filarr[parseInt(var_fil[i])] = mmd[parseInt(var_fil[i])];
                        //   }


                        //   mmd = filarr;
                        //  }


                        // // console.log(mmd);
                        // var arr = Object.keys(mmd).map(function(k) { return mmd[k] });
                        // arr.sort(function(a,b) {
                        // return b.value-a.value
                        // });
                        // arr.length = 10;
                        // console.log(colorsvg);
                        // console.log('colorsvg');
                        // console.log(arr);//.row('row-'+locid)
                        str ='';
                           // var str_leg ='';
                          // console.log(jquerydatatable.row().context[0].aIds,locid);
                           if(jquerydatatable.row().context[0].aIds[locid]!==undefined)
                           {
                                 str+='<div class = "legend1"><b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1]+"-"+name+'</b><br>';
                           }

                          // str_leg += '<div class = "legend1"><b>';
                      //   for(var ij =0;ij<arr.length;ij++)
                      //   {
                      //   // str ='';
                      //   if(ij<10){
                      //   fills=arr[ij].colr;//getsplitcolour(parseInt(ij));
                      //   tval =arr[ij].value;
                      //   var resco12 = tval.toString().split('.');
                      //   var resco1 =resco12[0].replace(/\,/g,'');
                      //   var amtcomma =moneyFormatIndia((resco1));
                      //   // reading
                      //   if ( resco1[1] !== void 0 )
                      //   {
                      //   if(resco12[1] != undefined)
                      //   {
                      //   amtcomma = amtcomma+'.'+resco12[1];
                      //   }
                      //   // amtcomma = amtcomma+'.'+resco12[1];
                      //   }
                      //   //split view legend
                      //   //str_leg +='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+'<br>';
                      // // str+='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+':'+amtcomma+'<br>';
                      //   }
                      //   // console.log(str);
                      //   }
                        str+='</div>';
                        //str_leg+='</div>';
                               //   $("#legendlabel").show();
                               // $("#legendlabel").html(str_leg);

                        deleteTooltip(event);
                        injectTooltip(event,str);
                    }
                    else
                    {
                           name = sessionStorage.getItem("loctype");
                        // console.log("keerthana", location_type1);
                        if(event.feature.getProperty('Name')=="POK" ||event.feature.getProperty('Name')=="COK")
                        {
                          var title=event.feature.getProperty('Name');
                        }
                        else
                        {
                         var title=event.feature.getProperty('Name')+"-"+name;
                        }

                        injectTooltip(event, title);
                    }

                  }
              }
              else
               {
                  //+" "+str1;
                  name = sessionStorage.getItem("loctype");
                  // console.log("keerthana", location_type1);
                  if(event.feature.getProperty('Name')=="POK" ||event.feature.getProperty('Name')=="COK")
                  {
                  var title=event.feature.getProperty('Name');
                  }
                  else
                  {
                    if(name=="")
                    {
                     var title=event.feature.getProperty('Name');
                    }
                    else
                    {
                        var title=event.feature.getProperty('Name')+"-"+name;
                    }

                  }

                  injectTooltip(event, title);
               }
             // console.log(event);
            }
        }
      //}
    });
    //mouseout the map
     map1.data.addListener('mouseout', function(event) {
    // $info.hide();
      if($("#markeropt").val()==0)
        {
           deleteTooltip(event);
          // infowindow.close();
         // map1.data.overrideStyle(event.feature, {fillColor: '#FFFFFF'});
        }
      });
      //mouseout the map
     map1.data.addListener('mousemove', function(event) {
    // $info.hide();
      if($("#markeropt").val()==0)
        {
          moveTooltip(event);
        }
      });
    map1.data.forEach(function(feature) {
          countrynames.push(feature.getProperty('Name'));
          feature.forEachProperty(function(value,property) {
          });
    });
    // map1.data.addListener('dblclick', function(event) {

    //   // event.preventDefault();
    //   // alert('s');
    //   removeAlllayer();
    //         fileid="";
    //        refid=[];mastername=[];

    //        var nextlevelfile=null;
    //        $('.loading', window.parent.document).show();
    //     setTimeout(function(){
    //       $.ajax({
    //                type: "POST",
    //                url: "AjaxRequest.php",
    //                data:{"nextlevel":"nextlevel","id":event.feature.getProperty('DB_ID').trim(),"currentlevel":file},
    //                async:false,

    //               success: function (data) {

    //                 // console.log(data)
    //                 data = data.split("//");
    //                 sessionStorage.setItem('geolvl',data[1]);
    //                 data = data[0];
    //                   nextlevelfile = data[0];

    //                 //  nextlevelfile1=nextlevelfile1.toString();
    //                 // nextlevelfile1=nextlevelfile1.split(",");

    //                  // nextlevelfile=nextlevelfile1[0];

    //                      // console.log(nextlevelfile);


    //                         if( nextlevelfile=="SVG/14878---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/73---12---15.svg";
    //                         }
    //                           if( nextlevelfile=="SVG/13346---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/676---12---15.svg";
    //                         }
    //                    if (nextlevelfile && nextlevelfile !=undefined)
    //                     {
    //                    statuscode=UrlExists(baseurl+nextlevelfile);
    //                    // console.log(statuscode);
    //                    if(statuscode == true)
    //                     {
    //                         var callback1 = function(feature) {
    //                         map1.data.remove(feature);
    //                         removeAllcircles();
    //                     };
    //                     map1.data.forEach(callback1);
    //                    sessionStorage.setItem("currentloadfile", nextlevelfile);

    //                        typeval=$("input[name=type]:checked").val();
    //                                 if(typeval=="circle")
    //                     {
    //                      initlayer(map,nextlevelfile,0,1,'');
    //                     }
    //                     else
    //                     {
    //                       initlayer(map,nextlevelfile,0,0,'');
    //                     }
    //                      // $('#map').attr("style", "display: block !important");
    //                    //map1.clearInstanceListeners(data);
    //                  $('.loading', window.parent.document).hide();
    //                  //SVG/1/5---7/1---5---7.svg
    //              if(nextlevelfile=="SVG/1---21---21.svg")
    //              {


    //                 file1=nextlevelfile.split("SVG/");
    //                 file2=file1[1].split(".svg");
    //                 file3=file2[0].split("---");
    //                 fileid=file3[0];
    //                 mainloc=file3[1];
    //                 subloc=file3[2];


    //                 file11=file.split("SVG/");
    //                 file21=file11[1].split(".svg");
    //                 file31=file21[0].split("---");
    //                 fileid1=file31[0];
    //                 mainloc1=file31[1];
    //                 subloc1=file31[2];

    //              }
    //              else if(nextlevelfile=="SVG/1---21---1.svg")
    //              {


    //                   file1=nextlevelfile.split("SVG/");

    //                   file2=file1[1].split(".svg");
    //                   file3=file2[0].split("---");
    //                   fileid=file3[0];
    //                   mainloc=file3[1];
    //                   subloc=file3[2];

    //                   file11=file.split("SVG/");

    //                   file21=file11[1].split(".svg");
    //                   file31=file21[0].split("---");
    //                   fileid1=file31[0];
    //                   mainloc1=file31[1];
    //                   subloc1=file31[2];

    //              }


    //             else
    //             {
    //                             file1=nextlevelfile.split("SVG/");
    //                             file11=file1[1].split("/");
    //                             file2=file11[2].split(".svg");
    //                             file3=file2[0].split("---");
    //                             fileid=file3[0];
    //                             mainloc=file3[1];
    //                             subloc=file3[2];

    //                             file1=file.split("SVG/");
    //                             file11=file1[1].split("/");
    //                             file21=file11[2].split(".svg");
    //                             file31=file21[0].split("---");
    //                             fileid1=file31[0];
    //                             mainloc1=file31[1];
    //                             subloc1=file31[2];
    //             }




    //                  arr1=[];arr2=[];
    //                  if(mainloc1==mainloc)
    //                  {
    //                   mapname1(mainloc,subloc,mainloc1,subloc1,fileid);
    //                  }
    //                         else if(mainloc=="21"&&subloc=="1")
    //                            {
    //                                $("#mapname").text("Country");
    //                            }
    //                  else{
    //                    mapname1(mainloc,subloc,mainloc1,subloc1,fileid);
    //                  }
    //                    }
    //                    else
    //                    {
    //           $('.loading', window.parent.document).hide();
    //                         $.alert({
    //                               title: '',
    //                               content: 'Data Not Available',
    //                               boxWidth: '30%',
    //                               top:-500,
    //                                 offsetTop: 70,
    //                               useBootstrap: false,
    //                           });
    //                    }
    //                  }
    //               }
    //           });
    //           view = sessionStorage.getItem('view');
    //           year = sessionStorage.getItem('year');
    //           menu_item_id = sessionStorage.getItem('categs');
    //         // alert(view+" / "+year+" / "+menu_item_id);
    //         if(view != '' && year != '' && menu_item_id != '')
    //         {
    //            // $('.loading', window.parent.document).show();
    //           // alert(view);
    //           map.data.revertStyle();
    //            comb = sessionStorage.getItem('groupby');
    //           // if(comb != 'S'){
    //           combinesplit_res("");//}
    //           if(issetsvg == 1)
    //                     {
    //                       // alert(issetsvg);
    //                       map.data.setStyle(function(feature)
    //                           {
    //                           // else
    //                             return ({
    //                             fillColor: 'white',
    //                             strokeWeight:0
    //                             });
    //                           });
    //                     }
    //       }
    //     },500);
    // });
        $("#customerAutocomplte").hide();$("#legendcluster").hide();$("#legendlabel").hide();
        var themeControlDiv = document.createElement('div');
        var showhideControlDiv = document.createElement('div');
        var screenControlDiv = document.createElement('div');
        var backControlDiv = document.createElement('div');
        var addControlDiv = document.createElement('div');
        var deleteControlDiv = document.createElement('div');
        var routeControlDiv = document.createElement('div');
        var downloadControlDiv = document.createElement('div');
        var locationControlDiv = document.createElement('div');
        var toggleControlDiv= document.createElement('div');
        var searchControlDiv= document.createElement('div');
        var filterControlDiv= document.createElement('div');
        var handmoveControlDiv= document.createElement('div');
        var locationsearchControlDiv= document.createElement('div');
        var centerControl = new BackControl(themeControlDiv,showhideControlDiv,screenControlDiv,backControlDiv,addControlDiv,deleteControlDiv,routeControlDiv,downloadControlDiv,locationControlDiv,toggleControlDiv,searchControlDiv,filterControlDiv,handmoveControlDiv,locationsearchControlDiv, map);
        themeControlDiv.index=1;
        screenControlDiv.index = 3;
        backControlDiv.index = 4;
        addControlDiv.index = 5;
        deleteControlDiv.index = 6;
        routeControlDiv.index=7;
        downloadControlDiv.index=8;
        locationControlDiv.index=9;
        toggleControlDiv.index=10;
        searchControlDiv.index=11;
        filterControlDiv.index=12;
        handmoveControlDiv.index=13;
        showhideControlDiv.index=14;
        locationsearchControlDiv.index=2;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(themeControlDiv);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(showhideControlDiv);
         map.controls[google.maps.ControlPosition.RIGHT_TOP].push(locationsearchControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(screenControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(backControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(addControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(deleteControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(routeControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(downloadControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(locationControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(toggleControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(searchControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(filterControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(handmoveControlDiv);

}
function initiateRectangle(){
    //Allowing to draw shapes in the Client Side
    if(drawingTool.getMap()) {
        drawingTool.setMap(null); // Used to disable the Rectangle tool
    }
    drawingTool.setOptions({
        drawingMode : google.maps.drawing.OverlayType.RECTANGLE,
        drawingControl : true,
        drawingControlOptions : {
            position : google.maps.ControlPosition.TOP_CENTER,
            drawingModes : [google.maps.drawing.OverlayType.RECTANGLE]
        }
    });
    //Loading the drawn shape in the Map.
    drawingTool.setMap(map);
}
function initiateCircle() {
    //Allowing to draw shapes in the Client Side
    if(drawingTool.getMap()) {
        drawingTool.setMap(null); // Used to disable the Circle tool
    }
    drawingTool.setOptions({
        drawingMode : google.maps.drawing.OverlayType.CIRCLE,
        drawingControl : true,
        drawingControlOptions : {
            position : google.maps.ControlPosition.TOP_CENTER,
            drawingModes : [google.maps.drawing.OverlayType.CIRCLE]
        }
    });
        //Loading the drawn shape in the Map.
    drawingTool.setMap(map);
}
function initiatePolygon() {
    //Allowing to draw shapes in the Client Side
    if(drawingTool.getMap()) {
        drawingTool.setMap(null); // Used to disable the Polygon tool
    }
    drawingTool.setOptions({
        drawingMode : google.maps.drawing.OverlayType.POLYGON,
        drawingControl : true,
        drawingControlOptions : {
            position : google.maps.ControlPosition.TOP_CENTER,
            drawingModes : [google.maps.drawing.OverlayType.POLYGON]
        }
    });
        //Loading the drawn shape in the Map.
    drawingTool.setMap(map);
}
function lisenter()
{
  google.maps.event.addListener(drawingTool,'overlaycomplete',function(event)
  {
     all_overlays.push(event);
      function checkout(marker)
          {
            var insideCircle = false;
              insideCircle = event.overlay.getBounds().contains(marker);
            return insideCircle;
          }
          function check_is_in_or_out(marker)
          {
            var insideRectangle = false;
              insideRectangle = event.overlay.getBounds().contains(marker);
            return insideRectangle;
          }
        if(event.type   ==  google.maps.drawing.OverlayType.CIRCLE) {
          drawingTool.setMap(null);
          radi=parseFloat(event.overlay.getRadius()/1000).toFixed(2);
            $.ajax({
            type: "POST",
            url: "AjaxRequest.php",
            data:{"lat":event.overlay.getCenter().lat(),"lng":event.overlay.getCenter().lng(),"menu":menus,"rad":radi,"type":type,"Draw":"Circle"},

            success:function(data){
           if(data.length  != 0)
              {
                testarr=JSON.parse(data);
                      $.each(testarr, function(i, item)
                      {
                                   t=testarr[i].split("****");
                                   lati=parseFloat(t[0]); loni=parseFloat(t[1]); addr=t[2]; ccp=t[3];
                                   localid=t[4];
                                   iconi=(t[4] != '') ? t[4] : 'images/marker.png';
                                     var image = {
                                    url: defaulturl+iconi,
                                    scaledSize: new google.maps.Size(15, 15), // scaled size
                                    origin: new google.maps.Point(0,0), // origin
                                    anchor: new google.maps.Point(0, 0)
                                    // This marker is 20 pixels wide by 32 pixels high.
                                   // size: new google.maps.Size(30, 30),
                                  };
                                    myLatLng = {lat: lati, lng: loni};
                                    if(checkout(myLatLng)==true)
                                   {
                                        markerm = new google.maps.Marker({
                                        position:myLatLng,
                                        map: map,
                                        icon:image,
                                        address: "<b>"+ccp+"</b><br>"+addr
                                      });
                                        markcluster.push(markerm);
                                       google.maps.event.addListener(markerm, 'click', function() {
                                              infowindowm.setContent(this.address);
                                              infowindowm.open(map, this);
                                          });
                                      }
                           });
                     markerCluster = new MarkerClusterer(map, markcluster,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
             }
            minClusterZoom = 14;
                      markerCluster.setMaxZoom(minClusterZoom);
                       google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
                          map.fitBounds(cluster.getBounds());
                          if( map.getZoom() > minClusterZoom+1 )
                              map.setZoom(minClusterZoom+1);
                       });
            }});
        }
        if(event.type   ==  google.maps.drawing.OverlayType.POLYGON) {
          drawingTool.setMap(null);
           xarr=[];yarr=[];
           for (var i = 0; i < event.overlay.getPath().getLength(); i++) {
              splitit=event.overlay.getPath().getAt(i).toUrlValue(6);
              splitn=splitit.split(",");
              xarr.push(splitn[0]);
              yarr.push(splitn[1]);
          }
          $.ajax({
            type: "POST",
            url: "AjaxRequest.php",
            data:{"x":xarr,"y":yarr,"menu":menus,"type":type,"Draw":"Poly"},
            success:function(data){
           if(data.length  != 0)
              {
                testarr=JSON.parse(data);
                      $.each(testarr, function(i, item)
                      {
                                   t=testarr[i].split("****");
                                   lati=parseFloat(t[0]); loni=parseFloat(t[1]); addr=t[2]; ccp=t[3];
                                   localid=t[4];
                                   iconi=(t[4] != '') ? t[4] : 'images/marker.png';
                                   var image = {
                                    url: defaulturl+iconi,
                                 scaledSize: new google.maps.Size(15, 15),
                                    origin: new google.maps.Point(0,0), // origin
                                    anchor: new google.maps.Point(0, 0)
                                  };
                                   myLatLng = {lat: lati, lng: loni};
                                   markerm = new google.maps.Marker({
                                      position:myLatLng,
                                      map: map,
                                      icon:image,
                                      address:  "<b>"+ccp+"</b><br>"+addr
                                    });
                                  markcluster.push(markerm);
                                  google.maps.event.addListener(markerm, 'click', function() {
                                          infowindowm.setContent(this.address);
                                          infowindowm.open(map, this);
                                      });
                      });
                     markerCluster = new MarkerClusterer(map, markcluster,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
             minClusterZoom = 14;
                      markerCluster.setMaxZoom(minClusterZoom);
                       google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
                          map.fitBounds(cluster.getBounds());
                          if( map.getZoom() > minClusterZoom+1 )
                              map.setZoom(minClusterZoom+1);
                       });
                             }
            }});
        }
         if(event.type   ==  google.maps.drawing.OverlayType.RECTANGLE) {
          xarr=[];yarr=[];
       drawingTool.setMap(null);
          var rectb=event.overlay.getBounds().toString();
           rect=rectb.split("),");
           for(l=0;l<rect.length;l++)
          {
                pol1=rect[l].replace("(","");
                pol2=pol1.replace(")","");
                pol3=pol2.replace("(","");
                pol4=pol3.replace(")","");
                pola = pol4.split(',');
                xarr.push(pola[0]);
                yarr.push(pola[1]);
          }
             $.ajax({
            type: "POST",
            url: "AjaxRequest.php",
            data:{"x":xarr,"y":yarr,"menu":menus,"type":type,"Draw":"Rect"},
            success:function(data){
           if(data.length  != 0)
              {
                testarr=JSON.parse(data);
                      $.each(testarr, function(i, item)
                      {
                                   t=testarr[i].split("****");
                                   lati=parseFloat(t[0]); loni=parseFloat(t[1]); addr=t[2]; ccp=t[3];
                                   localid=t[4];
                                   iconi=(t[4] != '') ? t[4] : 'images/marker.png';
                                   var image = {
                                    url: defaulturl+iconi,
                                    scaledSize: new google.maps.Size(15, 15),
                                    origin: new google.maps.Point(0,0), // origin
                                    anchor: new google.maps.Point(0, 0)
                                  };
                                  myLatLng = {lat: lati, lng: loni};
                                   if(check_is_in_or_out(myLatLng)==true)
                                   {
                                      markerm = new google.maps.Marker({
                                        position:myLatLng,
                                        map: map,
                                         icon:image,
                                        address: "<b>"+ccp+"</b><br>"+addr
                                      });
                                      markcluster.push(markerm);
                                     google.maps.event.addListener(markerm, 'click', function() {
                                            infowindowm.setContent(this.address);
                                            infowindowm.open(map, this);
                                        });
                                    }
                           });
                     markerCluster = new MarkerClusterer(map, markcluster,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
                     minClusterZoom = 14;
                      markerCluster.setMaxZoom(minClusterZoom);
                       google.maps.event.addListener(markerCluster, 'clusterclick', function(cluster) {
                          map.fitBounds(cluster.getBounds());
                          if( map.getZoom() > minClusterZoom+1 )
                              map.setZoom(minClusterZoom+1);
                       });
                       }
            }});
        }
 });
}
function stopDrawing() {
    drawingTool.setMap(null);
}
function processPoints(geometry, callback, thisArg) {
  if (geometry instanceof google.maps.LatLng) {
    callback.call(thisArg, geometry);
  } else if (geometry instanceof google.maps.Data.Point) {
    callback.call(thisArg, geometry.get());
  } else {
    geometry.getArray().forEach(function(g) {
      processPoints(g, callback, thisArg);
    });
  }
}
function BackControl(themecontrolDiv,showhidecontrolDiv,screencontrolDiv,controlDiv,controlDivadd,controlDivdelete,controlDivroute,controlDivdownload,controlDivlocation,controlDivtoggle,controlDivsearch,filterControlDiv,handControlDiv,locationsearchcontrolDiv, map) {
          //showhide control start
        // Set CSS for the control border.
        var controlUIshowhide = document.createElement('div');
        controlUIshowhide.style.backgroundColor = '#fff';
        controlUIshowhide.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIshowhide.style.cursor = 'pointer';
        controlUIshowhide.style.marginBottom = '0px';
        controlUIshowhide.style.textAlign = 'center';
        controlUIshowhide.title = 'Show/Hide Toolbar';
        showhidecontrolDiv.appendChild(controlUIshowhide);
        // Set CSS for the control interior.
        var controlTextshowhide = document.createElement('div');
        controlTextshowhide.className = 'map-icons';
        controlTextshowhide.innerHTML = '<i id="showhide" class="icon-close"></i>';
        // controlTextshowhide.innerHTML = '<img src="images/white/close-white.svg" class="select-icon" width="12" height="12" id="showhide" />';
        controlUIshowhide.appendChild(controlTextshowhide);
        //showhide control End
         //Screen control start
        // Set CSS for the control border.
        var controlUIscreen = document.createElement('div');
        controlUIscreen.style.backgroundColor = '#fff';
        controlUIscreen.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIscreen.style.cursor = 'pointer';
        controlUIscreen.style.marginBottom = '0px';
        controlUIscreen.style.textAlign = 'center';
        controlUIscreen.title = 'zoomchange';
        screencontrolDiv.appendChild(controlUIscreen);
        // Set CSS for the control interior.
        // var controlTextscreen = document.createElement('div');
        // controlTextscreen.style.color = 'rgb(25,25,25)';
        // controlTextscreen.style.fontFamily = 'Roboto,Arial,sans-serif';
        // controlTextscreen.style.lineHeight = '16px';
        // controlTextscreen.style.paddingLeft = '4px';
        // controlTextscreen.style.paddingRight = '4px';
        // controlTextscreen.innerHTML = '<img src="images/if_fullscreen_118670.svg" class="select-icon" width="12" height="12" id = "zoomchange" title="Full Screen" type="image"/>';
        // controlUIscreen.appendChild(controlTextscreen);
        //filter control
        var filtercontrolUI = document.createElement('div');
        filtercontrolUI.style.backgroundColor = '#fff';
        filtercontrolUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        filtercontrolUI.style.cursor = 'pointer';
        filtercontrolUI.style.marginBottom = '0px';
        filtercontrolUI.style.textAlign = 'center';
        filtercontrolUI.title = 'filter';
        filterControlDiv.appendChild(filtercontrolUI);
         // Set CSS for the filter interior.
        var filterTextscreen = document.createElement('div');
        filterTextscreen.className = 'map-icons';
        filterTextscreen.innerHTML = '<i id ="filtercontr" class="icon-57164"></i>';
        // filterTextscreen.innerHTML = '<img src="images/white/57164-white.svg" class="select-icon" width="12" height="12" id ="filtercontr" title="Filter"/>';
        filtercontrolUI.appendChild(filterTextscreen);
        //Screen Control End
        //Back control start
        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '0px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Back';
        controlUI.className ="map-tools";
        controlDiv.appendChild(controlUI);
        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.className = 'map-icons';
        controlText.innerHTML = '<i id="bakc" class="icon-back"></i>';
        // controlText.innerHTML = '<img src="images/white/back-white.svg" class="select-icon" width="12" height="12" id="bakc" title="Back"/>';
        controlUI.appendChild(controlText);
        //Back Control End
        //Add marker Control Start
        var controlUId = document.createElement('div');
        controlUId.style.backgroundColor = '#fff';
        controlUId.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUId.style.cursor = 'pointer';
        controlUId.style.marginBottom = '0px';
        controlUId.style.textAlign = 'center';
        controlUId.title = 'Add Marker';
        controlDivadd.appendChild(controlUId);
        // Set CSS for the control interior.
        var controlTextd = document.createElement('div');
        controlTextd.className = 'map-icons';
        controlTextd.innerHTML = '<i id="colordist" class="icon-aerial_dist"></i>';
        // controlTextd.innerHTML = '<img src="images/white/aerial_dist-white.svg" width="12" height="12" title="Aerial distance" id = "colordist"/>';
        controlUId.appendChild(controlTextd);
        //Addmarker Control End
        //delete Control Start
        var controlUIdelete = document.createElement('div');
        //controlUIdelete.className ="map-tools";
        controlUIdelete.style.backgroundColor = '#fff';
        controlUIdelete.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdelete.style.cursor = 'pointer';
        controlUIdelete.style.marginBottom = '0px';
        controlUIdelete.style.textAlign = 'center';
        controlUIdelete.title = 'Delete Overlay';
        controlDivdelete.appendChild(controlUIdelete);
        // Set CSS for the control interior.
        var controlTextddelete = document.createElement('div');
        controlTextddelete.className = 'map-icons';
        controlTextddelete.innerHTML = '<i id="colorremove" class="icon-60761"></i>';
        // controlTextddelete.innerHTML = '<img src="images/white/60761-white.svg" width="12" height="12" title="Remove All Layers" id = "colorremove"/>';
        controlUIdelete.appendChild(controlTextddelete);
        //Delete  Control End
        //Find the route Control Start
        var controlUIroute = document.createElement('div');
        //controlUIroute.className ="map-tools";
        controlUIroute.style.backgroundColor = '#fff';
        controlUIroute.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIroute.style.cursor = 'pointer';
        controlUIroute.style.marginBottom = '0px';
        controlUIroute.style.textAlign = 'center';
        controlUIroute.title = 'Find the route Overlay';
        controlDivroute.appendChild(controlUIroute);
        // Set CSS for the control interior.
        var controlTextdroute = document.createElement('div');
        controlTextdroute.className = 'map-icons';
        controlTextdroute.innerHTML = '<i id="colorshowdist" class="icon-25386"></i>';
        // controlTextdroute.innerHTML = '<img src="images/white/25386-white.svg" width="12" height="12" title="Show Distance" id = "colorshowdist" />';
        controlUIroute.appendChild(controlTextdroute);
        //Find the route  Control End
         // download Control Start
        var controlUIdownload = document.createElement('div');
        controlUIdownload.style.backgroundColor = '#fff';
        controlUIdownload.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdownload.style.cursor = 'pointer';
        controlUIdownload.style.marginBottom = '0px';
        controlUIdownload.style.textAlign = 'center';
        controlUIdownload.title = 'Export to image';
        controlDivdownload.appendChild(controlUIdownload);
        // Set CSS for the control interior.
        var controlTextddownload = document.createElement('div');
        controlTextddownload.className = 'map-icons';
        controlTextddownload.innerHTML = '<i id="colorexptoimg" class="icon-128472"></i>';
        // controlTextddownload.innerHTML = '<img src="images/white/128472-white.svg" width="12" height="12" id="colorexptoimg" title="Export To image"/>';
        controlUIdownload.appendChild(controlTextddownload);
        // download  Control End
        // Location Control Start
        var controlUILocation = document.createElement('div');
        //controlUILocation.className ="map-tools";
        controlUILocation.style.backgroundColor = '#fff';
        controlUILocation.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUILocation.style.cursor = 'pointer';
        controlUILocation.style.marginBottom = '0px';
        controlUILocation.style.textAlign = 'center';
        controlUILocation.title = 'Location Layer';
        controlDivlocation.appendChild(controlUILocation);
        // Set CSS for the control interior.
        var controlTextdLocation = document.createElement('div');
        controlTextdLocation.className = 'map-icons';
        controlTextdLocation.innerHTML = '<a class="colorloc" data-backdrop="static" data-toggle="modal" data-target="#myModal" href="" id="colorloc"><i class="icon-69399"></i></a>';
        // controlTextdLocation.innerHTML = '<img class="colorloc" data-backdrop="static" data-toggle="modal" data-target="#myModal" src="images/white/69399-white.svg" width="12" height="12" title="Location Layer" id = "colorloc" />';
        controlUILocation.appendChild(controlTextdLocation);
        // Location  Control End
         // Toggle Control Start
        var controlUIToggle = document.createElement('div');
        controlUIToggle.style.backgroundColor = '#fff';
        controlUIToggle.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIToggle.style.cursor = 'pointer';
        controlUIToggle.style.marginBottom = '0px';
        controlUIToggle.style.textAlign = 'center';
        controlUIToggle.title = 'Toggle Layer';
        controlDivtoggle.appendChild(controlUIToggle);
        // Set CSS for the control interior.
        var controlTextdToggle = document.createElement('div');
        controlTextdToggle.className = 'map-icons';
        controlTextdToggle.innerHTML = ' <a class="colortogg" data-backdrop="static" data-toggle="modal" data-target="#toggleModal" href="" id ="colortogg"><i class="icon-77756"></i></a>';
        // controlTextdToggle.innerHTML = ' <img class="colortogg" data-backdrop="static" data-toggle="modal" data-target="#toggleModal" src="images/white/77756-white.svg" width="12" height="12" title="Toggle Location" id ="colortogg"/>';
        controlUIToggle.appendChild(controlTextdToggle);
        // Toggle  Control End
         // Search Data set Control Start
        var controlUISearch = document.createElement('div');
        controlUISearch.style.backgroundColor = '#fff';
        controlUISearch.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUISearch.style.cursor = 'pointer';
        controlUISearch.style.marginBottom = '0px';
        controlUISearch.style.textAlign = 'center';
        controlUISearch.title = 'Search Data set Layer';
        controlDivsearch.appendChild(controlUISearch);
        // Set CSS for the control interior.
        var controlTextdSearch = document.createElement('div');
        controlTextdSearch.className = 'map-icons';
        controlTextdSearch.innerHTML = '<a class="colorsearch" data-backdrop="static" data-toggle="modal" data-target="#searchModal" href=""  id="colorsearch"><i class="icon-54554"></i></a>';
        // controlTextdSearch.innerHTML = '<img class="colorsearch" data-backdrop="static" data-toggle="modal" data-target="#searchModal" src="images/white/54554-white.svg" width="12" height="12" title="Search Data Set" id = "colorsearch"/>';
        controlUISearch.appendChild(controlTextdSearch);
        // Search Data set  Control End

  // locationSearch Data set Control Start
        var controlUIlocSearch = document.createElement('div');
        controlUIlocSearch.style.backgroundColor = '#fff';
        controlUIlocSearch.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIlocSearch.style.cursor = 'pointer';
        controlUIlocSearch.style.marginBottom = '0px';
        controlUIlocSearch.style.textAlign = 'center';
        controlUIlocSearch.title = 'Search Data set Layer';
        locationsearchcontrolDiv.appendChild(controlUIlocSearch);
        // Set CSS for the control interior.
        var controlTextdlocSearch = document.createElement('div');
        controlTextdlocSearch.className = 'map-icons';
        controlTextdlocSearch.innerHTML = '<i class="icon-54554"></i>';
        // controlTextdSearch.innerHTML = '<img class="colorsearch" data-backdrop="static" data-toggle="modal" data-target="#searchModal" src="images/white/54554-white.svg" width="12" height="12" title="Search Data Set" id = "colorsearch"/>';
        controlUIlocSearch.appendChild(controlTextdlocSearch);
        //location Search Data set  Control End

         //Move control start
        // Set CSS for the control border.
        var controlUIdrag = document.createElement('div');
        controlUIdrag.style.backgroundColor = '#fff';
        controlUIdrag.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdrag.style.cursor = 'pointer';
        controlUIdrag.style.marginBottom = '0px';
        controlUIdrag.style.textAlign = 'center';
        controlUIdrag.title = 'Drag';
        handControlDiv.appendChild(controlUIdrag);
        // Set CSS for the control interior.
        // var controlTextdrag = document.createElement('div');
        // controlTextdrag.className = 'map-icons';
        // controlTextdrag.innerHTML = '<i id="dragmap" class="icon-drag"></i>';
        // controlUIdrag.appendChild(controlTextdrag);
        // controlTextdrag.innerHTML = '<img src="images/white/drag-white.svg" class="select-icon" width="12" height="12" id = "dragmap" title="Drag Map"/>';
        //Move Control End

         controlUIlocSearch.addEventListener('click', function() {
          $("#customerAutocomplte").toggle();
        });
        controlUIshowhide.addEventListener('click', function() {
          if(controlUIdownload.style.display!='none')
          {
              controlUIshowhide.className = 'map-icons';
            controlUIshowhide.innerHTML='<i id="showhide" class="icon-open"></i>';
            // controlUIshowhide.innerHTML='<img src="images/white/open-white.svg" class="select-icon" width="12" height="12" id = "showhide" />';
            controlUIdownload.style.display='none';
            controlUIlocSearch.style.display='none';
        controlUI.style.display='none';
        controlUId.style.display='none';
        controlUIdelete.style.display='none';
        controlUIroute.style.display='none';
        controlUILocation.style.display='none';
        controlUIToggle.style.display='none';
        controlUISearch.style.display='none';
        controlUIdrag.style.display='none';
        controlUIscreen.style.display='none';
        filtercontrolUI.style.display='none';
          }
          else
          {
            controlUIshowhide.innerHTML='<i class="icon-close"></i>';
            // controlUIshowhide.innerHTML='<img src="images/white/close-white.svg" class="select-icon" width="12" height="12" id = "showhide" />';
            controlUIdownload.style.display='block';
            controlUIlocSearch.style.display='block';
        controlUI.style.display='block';
        controlUId.style.display='block';
        controlUIdelete.style.display='block';
        controlUIroute.style.display='block';
        controlUILocation.style.display='block';
        controlUIToggle.style.display='block';
        controlUISearch.style.display='block';
        controlUIdrag.style.display='block';
        controlUIscreen.style.display='block';
        filtercontrolUI.style.display='block';
                  }
        });

        // Screen button the click event listeners
        controlUIscreen.addEventListener('click', function() {
          if($(".map-container").attr("style")=='height:100%;width:99%;position: relative; overflow: hidden;')
          {
            $(".map-container").attr("style","height:35rem;width:49%;");
            $(".chart-container").attr("style","");
            $(".report-container").attr("style","");
            $("a").parent('div').css({"background": "#2B9089"});
            $("#zoomchange").parent('div').css({"background": "#ffffff"});
          }
          else
          {
            $(".map-container").attr("style","height:100%;width:99%;position: relative; overflow: hidden;");
            $(".chart-container").attr("style","display:none;");
            $(".report-container").attr("style","display:none;");
            $("a").parent('div').css({"background": "#2B9089"});
            $("#zoomchange").parent('div').css({"background": "#d93637"});
          }
        });
        // Back button the click event listeners
        controlUI.addEventListener('click', function() {

           $(".map-icons i").removeAttr('style');
           $(".map-icons").removeAttr('style');
           $(".icon-back").css("color", "#ffffff");
           $("#bakc").parent('div').css({"background": "#d93637"});
           //$("#bakc").attr("src","images/white/back-white.svg");
          goprev();
        });
        //Add Marker Control event
         controlUId.addEventListener('click', function() {
            // $("img").parent('div').css({"background": "#ffffff"});
            $(".map-icons i").removeAttr('style');
            $(".map-icons").removeAttr('style');
            $(".icon-aerial_dist").css("color", "#ffffff");
           $("#colordist").parent('div').css({"background": "#d93637"});
           //$("#colordist").attr("src","images/white/aerial_dist-white.svg");
            $("#markeropt").val(1);
          });
         //Delete Control event
         controlUIdelete.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-60761").css("color", "#ffffff");
           $("#colorremove").parent('a').css({"background": "#d93637"});
           $("#colorremove").parent('div').css({"background": "#d93637"});
           //$("#colorremove").attr("src","images/white/60761-white.svg");
           removeAlllayer();
          });
         //Find the route Control event
         controlUIroute.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-25386").css("color", "#ffffff");
           $("#colorshowdist").parent('div').css({"background": "#d93637"});
           //$("#colorshowdist").attr("src","images/white/25386-white.svg");
           $("#markeropt").val(2);
          });
        //Download Control event
         controlUIdownload.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-128472").css("color", "#ffffff");
            $("#colorexptoimg").parent('div').css({"background": "#d93637"});
            //$("#colorexptoimg").attr("src","images/white/128472-white.svg");
           html2canvas(document.getElementById("map"), {
            useCORS: true,
            onrendered: function(canvas) {
             var img = canvas.toDataURL("image/png");
             img = img.replace('data:image/png;base64,', '');
             var finalImageSrc = 'data:image/png;base64,' + img;
             //$('#imgh').attr('src', finalImageSrc);
             var a = document.createElement("a");
              a.download = "download_img.png";
              a.href = finalImageSrc;
              document.body.appendChild(a);
              a.click();
            }
            });
          });
         //Location layer
         controlUILocation.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-69399").css("color", "#ffffff");
              $("#colorloc").parent('div').css({"background": "#d93637"});
              //$("#colorloc").attr("src","images/white/69399-white.svg");
           $("#markeropt").val(3);
          });
           //Toggle layer
         controlUIToggle.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-77756").css("color", "#ffffff");
           $("#colortogg").parent('div').css({"background": "#d93637"});
           //$("#colortogg").attr("src","images/white/77756-white.svg");
          });
            //Search  layer
         controlUISearch.addEventListener('click', function() {
           $(".map-icons").removeAttr('style');
           $(".map-icons i").removeAttr('style');
           $(".icon-54554").css("color", "#ffffff");
             $("#colorsearch").parent('div').css({"background": "#d93637"});
             //$("#colorsearch").attr("src","images/white/54554-white.svg");
          });
          filtercontrolUI.addEventListener('click', function() {
            $(".map-icons").removeAttr('style');
            $(".map-icons i").removeAttr('style');
            $(".icon-57164").css("color", "#ffffff");
              $("#filtercontr").parent('div').css({"background": "#d93637"});
              //$("#filtercontr").attr("src","images/white/57164-white.svg");
              // alert($("#rep").val());
              if($("#rep").val()=="circle")
             {
              dialog(1);
             }
             else
             {
              dialog(0);
            }
          });
           controlUIdrag.addEventListener('click', function() {
             $(".map-icons").removeAttr('style');
             $(".map-icons i").removeAttr('style');
             $(".icon-drag").css("color", "#ffffff");
             $("#dragmap").parent('div').css({"background": "#d93637"});
             //$("#dragmap").attr("src","images/white/drag-white.svg");
              // $( ".dragme" ).draggable({ disabled: true });
              map.setOptions({ draggable : true });
          });
}
  function getsplitcolour(d)
  {
    switch (d) {
    case 0: return 'rgb(243, 12, 12)';//#F30C0C
    case 1: return 'rgb(27, 104, 7)';//#1B6807
    case 2: return 'rgb(0, 0, 255)';//#0000FF
    case 3: return 'rgb(17, 108, 223)';//#116CDF
    case 4: return 'rgb(172, 117, 7)';//#AC7507
    case 5: return 'rgb(226, 240, 13  )';//#E2F00D
    case 6: return 'rgb(79, 84, 12)';//#4F540C
    case 7: return 'rgb(84, 12, 13)';//#540C0D
    case 8: return 'rgb(12, 84, 78)';//#0C544E
    case 9: return 'rgb(101, 12, 117 )';//#650C75
    }
  }
</script>
<script>
function splitradius(mainloc,subloc,d)
{
      d=d/10000000;
      if(mainloc==21 &&subloc==21)
      {
      d=30;
      return d;
      }//world contient
       else if(mainloc==21 &&subloc==1)
       {
      d=30;
      return d;
       }  //world country
        else if(mainloc==5 &&subloc==5)
       {
        d=30;
        return d;
       } //india outline
       else if(mainloc==5 &&subloc==7)
       {
      if(d>100)
              {
              d=25;
              return d;
              }
              else if(d>90)
              {
              d=23;
              return d;
              }
              else if(d>80)
              {
              d=22;
              return d;
              }
              else if(d>70)
              {
              d=20;
              return d;
              }
              else if(d>60)
              {
              d=19;
              return d;
              }
              else if(d>50)
              {
              d=19;
              return d;
              }
              else if(d>40)
              {
              d=19;
              return d;
              }
              else if(d>30)
              {
              d=19;
              return d;
              }
              else if(d>20)
              {
              d=19;
              return d;
              }
              else if(d>10)
              {
              d=18;
              return d;
              }
              else if(d>5)
              {
              d=17;
              return d;
              }
              else if(d>0)
              {
              d=15;
              return d;
              }
              else
              {
              d=12;
              return d;
              }
       } // india state
        else if(mainloc==7 &&subloc==7)
       {
       d=22;
       return d;
       } // all one state
        else if(mainloc==7 &&subloc==9)
       {
      if(d>100)
              {
              d=25;
              return d;
              }
              else if(d>90)
              {
              d=23;
              return d;
              }
              else if(d>80)
              {
              d=21;
              return d;
              }
              else if(d>70)
              {
              d=20;
              return d;
              }
              else if(d>60)
              {
              d=18;
              return d;
              }
              else if(d>50)
              {
              d=17;
              return d;
              }
              else if(d>40)
              {
              d=16;
              return d;
              }
              else if(d>30)
              {
              d=15;
              return d;
              }
              else if(d>20)
              {
              d=14;
              return d;
              }
              else if(d>10)
              {
              d=13;
              return d;
              }
              else if(d>5)
              {
              d=10;
              return d;
              }
              else if(d>0)
              {
              d=7;
              return d;
              }
              else
              {
              d=5;
              return d;
              }
       } // all districts of a state
        else if(mainloc==12 &&subloc==12)
       {
      d=22;
      return d;
       }  // iso dis
        else if(mainloc==12 &&subloc==15)
       {
              if(d>100)
              {
              d=25;
              return d;
              }
              else if(d>90)
              {
              d=24;
              return d;
              }
              else if(d>80)
              {
              d=23;
              return d;
              }
              else if(d>70)
              {
              d=22;
              return d;
              }
              else if(d>60)
              {
              d=19;
              return d;
              }
              else if(d>50)
              {
              d=17;
              return d;
              }
              else if(d>40)
              {
              d=14;
              return d;
              }
              else if(d>30)
              {
              d=13;
              return d;
              }
              else if(d>20)
              {
              d=12;
              return d;
              }
              else if(d>10)
              {
              d=11;
              return d;
              }
              else if(d>5)
              {
              d=10;
              return d;
              }
              else if(d>2)
              {
              d=8;
              return d;
              }
              else if(d>1)
              {
              d=7;
              return d;
              }
              else if(d>0)
              {
              d=6;
              return d;
              }
              else
              {
              d=2;
              return d;
              }
       } // all city ward
       else if(mainloc==15 &&subloc==15)
       {
       d=22;
              return d;
       } // single ward
       else
       {
       d=20;
              return d;
       }
 }
function sizevalue(mainloc,subloc,d)
{
      d=d/10000000;
      if(mainloc==21 &&subloc==21)
      {
      d=190000;
      return d;
      }//world contient
       else if(mainloc==21 &&subloc==1)
       {
      d=190000;
      return d;
       }  //world country
        else if(mainloc==5 &&subloc==5)
       {
        d=190000;
        return d;
       } //india outline
       else if(mainloc==5 &&subloc==7)
       {
      if(d>100)
              {
              d=190000;
              return d;
              }
              else if(d>90)
              {
              d=180000;
              return d;
              }
              else if(d>80)
              {
              d=170000;
              return d;
              }
              else if(d>70)
              {
              d=160000;
              return d;
              }
              else if(d>60)
              {
              d=150000;
              return d;
              }
              else if(d>50)
              {
              d=140000;
              return d;
              }
              else if(d>40)
              {
              d=130000;
              return d;
              }
              else if(d>30)
              {
              d=120000;
              return d;
              }
              else if(d>20)
              {
              d=110000;
              return d;
              }
              else if(d>10)
              {
              d=100000;
              return d;
              }
              else if(d>5)
              {
              d=90000;
              return d;
              }
              else if(d>0)
              {
              d=86000;
              return d;
              }
              else
              {
              d=9000;
              return d;
              }
       } // india state
        else if(mainloc==7 &&subloc==7)
       {
       d=190000;
       return d;
       } // all one state
        else if(mainloc==7 &&subloc==9)
       {
      if(d>100)
              {
              d=89000;
              return d;
              }
              else if(d>90)
              {
              d=79000;
              return d;
              }
              else if(d>80)
              {
              d=69000;
              return d;
              }
              else if(d>70)
              {
              d=65000;
              return d;
              }
              else if(d>60)
              {
              d=62000;
              return d;
              }
              else if(d>50)
              {
              d=50000;
              return d;
              }
              else if(d>40)
              {
              d=47000;
              return d;
              }
              else if(d>30)
              {
              d=45000;
              return d;
              }
              else if(d>20)
              {
              d=43000;
              return d;
              }
              else if(d>10)
              {
              d=41000;
              return d;
              }
              else if(d>5)
              {
              d=40000;
              return d;
              }
              else if(d>0)
              {
              d=30000;
              return d;
              }
              else
              {
              d=20000;
              return d;
              }
       } // all districts of a state
        else if(mainloc==12 &&subloc==12)
       {
      d=70000;
      return d;
       }  // iso dis
        else if(mainloc==12 &&subloc==15)
       {
              if(d>100)
              {
              d=6000;
              return d;
              }
              else if(d>90)
              {
              d=5500;
              return d;
              }
              else if(d>80)
              {
              d=5000;
              return d;
              }
              else if(d>70)
              {
              d=4700;
              return d;
              }
              else if(d>60)
              {
              d=4200;
              return d;
              }
              else if(d>50)
              {
              d=4100;
              return d;
              }
              else if(d>40)
              {
              d=4000;
              return d;
              }
              else if(d>30)
              {
              d=3500;
              return d;
              }
              else if(d>20)
              {
              d=3000;
              return d;
              }
              else if(d>10)
              {
              d=2700;
              return d;
              }
              else if(d>5)
              {
              d=2000;
              return d;
              }
              else if(d>2)
              {
              d=1900;
              return d;
              }
              else if(d>1)
              {
              d=1200;
              return d;
              }
              else if(d>0)
              {
              d=600;
              return d;
              }
              else
              {
              d=500;
              return d;
              }
       } // all city ward
       else if(mainloc==15 &&subloc==15)
       {
       d=700;
              return d;
       } // single ward
       else
       {
       d=5000;
              return d;
       }
 }


 function removeAllcircles()
{
  for(var i in circles) {
  circles[i].setMap(null);
  }
  circles = [];
}
function mulfac(mainloc,subloc)
{
  if(mainloc==5 && subloc==7)
  {
    mf=1.2;
    return mf;
  }
  else if(mainloc==7 && subloc==9)
  {
    mf=0.5;
    return mf;
  }
  else
  {
    mf=2;
    return mf;
  }
}
  // <script src="js/svgoverlay.js">////script>
function loadScript()
{
	//AIzaSyC6xJLF1r0jCwFxFaL-zDvRDgCl8Ogo1tk//robin key
	//AIzaSyCWN1D6LyQlKiP63eBS3Mi4HZb8n1bBDlk//oldkey
    // var myKey = "AIzaSyBqIODxX0CX7hw600u4PghiCWRKeXPZogE";
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyC6xJLF1r0jCwFxFaL-zDvRDgCl8Ogo1tk&callback=initMap&libraries=geometry,drawing,places";
    // alert('1');
    // console.log(script)
    document.body.appendChild(script);
    // var script1 = document.createElement('script');
    // script1.type = 'text/javascript';
    // script1.src = "js/svgoverlay.js";
    // document.body.appendChild(script1);
    // alert('2');
    // svgexecution();
}
// google.maps.event.addListenerOnce( map, 'idle', function() {
//     svgexecution();
// });
  </script>
 <script src="js/markerclusterer.js"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script> -->

    <script>
function UrlExists(url)
{
      var http = new XMLHttpRequest();
      http.open('HEAD', url, false);
      http.send();
      if (((http.status >= 100) && (http.status < 400)) || (http.status == 12029))
      {
      return true;
      }
      else{
      return false;
      }
}



function mapname1(mainloc,subloc,mainloc1,subloc1,fileid)
{


    $.ajax({
    url:'AjaxRequest.php' ,
    type:"POST",
    data:{
      "label":1,
    "mainlocation":mainloc,
    "sublocation":subloc,
    "fileid":fileid,
    },
    success: function(response)
    {

      if(mainloc=="21"&&subloc=="21"){
      $("#mapname").text('Global');
      }
      else if(mainloc=="21"&&subloc=="1")
      {
      $("#mapname").text('Country');
      }


      else
      {
      $("#mapname").text(response);

      }
    //  alert(response);
        sessionStorage.setItem("refreshMapname",response);
    }
    });
}


function goprev()
{
    // console.log(cphistory);
    // console.log('regafsd');
    removeAlllayer();
    // console.log('cenpoints');
    // console.log(cenpoints);
    comb = sessionStorage.getItem('groupby');
    goprevy = 1;
    backfile=historyarr[historyarr.length-2];
    sessionStorage.setItem('sw',swbounds[swbounds.length-2]);
    sessionStorage.setItem('ne',nebounds[nebounds.length-2]);
    sessionStorage.setItem('geolvl',cphistory[cphistory.length-2]);
    // console.log(historyarr);
    latLng = cphistory[cphistory.length-2];
    // alert(latLng);
    // latlng = new google.maps.LatLng(latLng[0], latLng[1]);
    // console.log('TTTTTTTTTTTTT');
    // console.log(cphistory);
    // console.log(historyarr);
    // map.setCenter(latlng);
    // map.setCenter(latlng)
    // sessionStorage.setItem('geolvl',latlng);
    if(backfile=="SVG/1---21---21.svg")
    {


      file1=backfile.split("SVG/");
      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      fileid=file3[0];
      mainloc=file3[1];
      subloc=file3[2];

    }
    else if(backfile=="SVG/1---21---1.svg")
    {


      file1=backfile.split("SVG/");

      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      fileid=file3[0];
      mainloc=file3[1];
      subloc=file3[2];

    }


    else
    {
      // alert(backfile);
      file1=backfile.split("SVG/");
      file11=file1[1].split("/");
      file2=file11[2].split(".svg");
      file3=file2[0].split("---");
      fileid=file3[0];
      mainloc=file3[1];
      subloc=file3[2];
    }



    if(file=="SVG/1---21---21.svg")
    {


      file1=file.split("SVG/");
      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      fileid1=file3[0];
      mainloc1=file3[1];
      subloc1=file3[2];

    }
    else if(file=="SVG/1---21---1.svg")
    {


      file1=file.split("SVG/");
      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      fileid1=file3[0];
      mainloc1=file3[1];
      subloc1=file3[2];

    }


    else
    {
      file1=file.split("SVG/");
      file11=file1[1].split("/");
      file2=file11[2].split(".svg");
      file3=file2[0].split("---");
      fileid1=file3[0];
      mainloc1=file3[1];
      subloc1=file3[2];
    }
        // mapname(mainloc,subloc,mainloc1,subloc1,fileid);
        if(mainloc1==mainloc)
        {
          if(fileid==73 && mainloc==12 && subloc==12)
                {
                      fileid="14878";
                }
                     if(fileid==73 && mainloc==12 &&subloc==15)
                {
                      fileid="14878";
                }
          mapname1(mainloc,subloc,'','',fileid);
        }

        else if(mainloc=="21"&& subloc=="21")
        {
         $("#mapname").text("Globe");
        }

         else if(mainloc=="21"&& subloc=="1")
        {
            $("#mapname").text("Country");
        }
        else if (mainloc1!=mainloc)
        {
             if(fileid==73 &&mainloc==12&&subloc==12)
                {
                      fileid="14878";
                }
                     if(fileid==73 &&mainloc==12 &&subloc==15)
                {
                      fileid="14878";
                }
             mapname1(mainloc,subloc,'','',fileid);
        }


    //  if(historyarr[historyarr.length-2]=="SVG/91/5---7/91---5---7.svg")
    // {
    //       var xmlhttp = new XMLHttpRequest();
    //       xmlhttp.open('GET', 'indonesia-provinces.svg', false);
    //       xmlhttp.send();
    //       overlay = new SvgOverlay({
    //       content: xmlhttp.responseText,
    //       map: map
    //       });
    //       svg = overlay.getSvg();
    //       svg.setAttribute('opacity', 1);
    //       console.log('overlay.getContainer()');
    //       tes = overlay.getContainer();
    // }

    if(comb == 'S')
    {

      backfile=historyarr[historyarr.length-2];
      sessionStorage.setItem('id',fileid);
      sessionStorage.setItem('parentlvl',mainloc);
      sessionStorage.setItem('childlvl',subloc);

      goperv_svg = 'Y';
    }


    typeval=$("input[name=type]:checked").val();
    if(typeval=="circle")
    {
       //alert("back");

        if(comb == 'C')
        {
          backcircle();
        }
        else if(comb=='S')
        {
          removeAlllayer();
          filecp=historyarr[historyarr.length-2];
          initlayer(map,filecp,0,1,'');

        }
        else
        {
         backcircle();
        }


    }


    else
    {
      $('.spinner-wrapper').show();
      // alert("test1")
      removeAllcircles();
      backfile=historyarr[historyarr.length-2];
      zooml=zoomarr[zoomarr.length-2];
      centerpoint=cphistory[cphistory.length-2];

           setTimeout(function(){
        if(statuscode == true)
        {
          var callback = function(feature)
          {
          map.data.remove(feature);
          };
          map.data.forEach(callback);
          var length=historyarr.length-1;
          historyarr.splice(length, 1);
          var length1=zoomarr.length-1;
          zoomarr.splice(length, 1);
          var length2=cphistory.length-1;
          cphistory.splice(length2, 1);
           var length3=swbounds.length-1;
          swbounds.splice(length3, 1);
          var length4=nebounds.length-1;
          nebounds.splice(length4, 1);

          $('.spinner-wrapper').hide();
          // alert("test2")
          // alert()
          sessionStorage.setItem("currentloadfile", backfile);
          initlayer(map,backfile,1,0,zooml);
          view = sessionStorage.getItem('view');

          arr1=[];arr2=[];refid=[];mastername=[];

          //alert(mainloc+subloc+mainloc1+subloc1+fileid) ;

          view = sessionStorage.getItem('view');
          year = sessionStorage.getItem('year');
          menu_item_id = sessionStorage.getItem('categs');
          // alert(view+" / "+year+" / "+menu_item_id);
          if(view != '' && year != '' && menu_item_id != '')
          {
          // alert('sd');

             result= combinesplit_res(0,1,0);



          }
        }
        else
        {
          $.alert({
          title: '',
          content: 'Data Not Available',
          boxWidth: '30%',
          top:-500,
          offsetTop: 70,
          useBootstrap: false,
          });
        }
      },500);
    }
}
function placeMarker(location) {
              if(latlngarr.length==0){
                drag=false;
                 latlngarr[0]=location;
                 str=location.toString();
                 distancearr[0]=str;
              }
              else{
                 drag=true;
                 latlngarr[1]=location;
                 str=location.toString();
                 distancearr[1]=str;
              }
              if(markerarr.length<2)
                {
                    marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable:drag,
                    });
                   markerarr.push(marker);
                }
              if($("#markeropt").val()==1)
              {
                if(markerarr.length==2)
                {
                  str1=distancearr[0].split(",");
                  str2=str1[0].replace("(", "");
                  str3=str1[1].replace(")", "");
                  str4=distancearr[1].split(",");
                  str5=str4[0].replace("(", "");
                  str6=str4[1].replace(")", "");
                  r1=showresult(str2,str3,str5,str6);
                  infowindow1.setContent('Aerial Distance:' + r1);
                  infowindow1.setPosition(latlngarr[1]);
                  infowindow1.open(map, map.data);
                }
              }
              if($("#markeropt").val()==2 && markerarr.length==2)
              {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
                removeMarker();
              }
              marker.addListener('dragend', function(event){
                    if($("#markeropt").val()==1)
                    {
                      placeMarker(event.latLng);
                    }
              });
}
function removeMarker()
{
   for(i=0; i<markerarr.length; i++){
        markerarr[i].setMap(null);
    }
    $("#markeropt").val(0);
    infowindow1.close();
    distancearr=[];
    markerarr=[];
    latlngarr=[];
}
function createTooltip(marker, key) {
        //create a tooltip
        var tooltipOptions={
          marker:marker,
          content:places[key].tooltip_html,
          cssClass:'tooltip' // name of a css class to apply to tooltip
        };
        var tooltip = new Tooltip(tooltipOptions);
  }
function showresult(lat1,lon1,lat2,lon2)
{
      var R = 6371; // km (change this constant to get miles)
      var dLat = (lat2-lat1) * Math.PI / 180;
      var dLon = (lon2-lon1) * Math.PI / 180;
      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
        Math.sin(dLon/2) * Math.sin(dLon/2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      var d = R * c;
        return d;
}
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode ='DRIVING';
                  str1=distancearr[0].split(",");
                  str2=str1[0].replace("(", "");
                  str3=str1[1].replace(")", "");
                  str4=distancearr[1].split(",");
                  str5=str4[0].replace("(", "");
                  str6=str4[1].replace(")", "");
        directionsService.route({
          origin: {lat: parseFloat(str2), lng: parseFloat(str3)},  // Haight.
          destination: {lat: parseFloat(str5), lng: parseFloat(str6)},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        },function(response, status) {
          if (status === 'OK') {
            // console.log(response);
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            $("#right-panel").attr("style","display:block;");
            var summaryPanel = document.getElementById('right-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
}
function rgbToHex(R,G,B) {
  return toHex(R)+toHex(G)+toHex(B)
}
function toHex(n) {
 n = parseInt(n,10);
 if (isNaN(n)) return "00";
 n = Math.max(0,Math.min(n,255));
 return "0123456789ABCDEF".charAt((n-n%16)/16)
      + "0123456789ABCDEF".charAt(n%16);
}
function isEmpty(obj)
{
 for(var key in obj) { if(obj. hasOwnProperty(key)) return false; } return true;
}
function removeAlllayer()
{
   if(!isEmpty(namebuild))
    {

        delete myLatLng;
        delete markerm;
        fldarr=new Array();fldidarr=new Array();fldarrfinal=new Array();
      fldarrfinal=[];fldname=[];
        for(i=0;i<namebuild.length;i++)
        {
           if(!isEmpty(namebuild[i])) {


             namebuild[i].clearMarkers();


           }

        }

    }

   for(i=0; i<markerarr.length; i++){
        markerarr[i].setMap(null);
    }
    for(k=0; k<circlearr.length; k++){
        circlearr[k].setMap(null);
    }

    $("#legendcluster").html('');
    $("#markeropt").val(0);
   // infowindow1.close();
    distancearr=[];
    markerarr=[];
    latlngarr=[];
   // drawingManager.setMap(null);
     directionsDisplay.setMap(null);
     drawingTool.setMap(null);
     // drawingTool =   new google.maps.drawing.DrawingManager;
    delete myLatLng;
    delete markerm;


     if(!isEmpty(markerCluster))
     {
       markerCluster.clearMarkers();
       for(k=0; k<markcluster.length; k++){
        markcluster[k].setMap(null);
        }
        markcluster=[];
        for (var i=0; i < all_overlays.length; i++)
        {
          all_overlays[i].overlay.setMap(null);
        }
        all_overlays = [];
     }
     //map.data.remove(circle);
      $("#right-panel").html('');
      $("#right-panel").attr("style","display:none;");
       directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
         view1 = sessionStorage.getItem('view');
       if(view1=='')
       {
        map.data.setStyle(function(feature) {
                return {
                  strokeColor: '#000',
                  strokeOpacity: 1,
                  strokeWeight: 0.5,
                  fillColor: '#FFF',
                  fillOpacity: 1
                };
          });
       }
}
</script>
<!--EndMap-->
<!--Location layer model-->
<!--- modal  -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Location Layer</h4>
      </div>
      <div class="modal-body">
       <!--  <label><input type="radio" name="type" value="poly" checked> <span class="label-text"> Polygon</span> </label> -->
            <label><input type="radio" name="type" value="circle"><span class="label-text"> Circle </span> </label>
               <label><input type="radio" name="type" value="svg"><span class="label-text"> Svg </span> </label>

           <input type="text" id="rep" hidden="true" />
             <input type="text" id="rep1" hidden="true" value="100" />
         <!--  <input type='text' id="custom" />
            <p id="p1">Size </p> <div id="slider1" style="width:260px; margin:15px 0;">
              <div id="custom-handle1"  class="ui-slider-handle"></div>
            </div> -->
        <p id="p2">  Opacity </p> <div id="slider2" style="width:260px; margin:15px 0;">
              <div id="custom-handle2"  class="ui-slider-handle"></div>
            </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" id="apply" name="Apply" onclick="circpie()" >Apply</button>
         <button type="button" class="btn btn-default" id="clear" name="clear" onclick="removeAlllayer()" >Clear</button>
    <!--  <button type="button" class="btn btn-default" id="back" name="Back" onclick="backcircle()" >Back</button> -->
      </div>
    </div>
  </div>
</div>
<!-- end -->
<!--Toggle Location layer model-->
<!--- modal  -->
<div id="toggleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Toggle Location</h4>
      </div>
      <div class="modal-body" id="togglelocation">
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" id="apply" name="Apply" onclick="toggleshow()">Apply</button>
      </div>
    </div>
  </div>
</div>
<!-- end -->
<!--Search Location layer model-->
<!--- modal  -->
<div id="searchModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Search Data Sets</h4>
      </div>
      <div class="modal-body" id="search">
    <?php
         echo $searchls;
      ?>
      </div>
         <div class="modal-body">
      <label>Tools</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="tools" value="1" onclick="show()" checked><span class="label-text"> Circle</span></label>
    <label><input type="radio" name="tools" value="2" onclick="hide()"><span class="label-text">Rectangle</span></label>
  <label><input type="radio" name="tools" value="3" onclick="hide()"><span class="label-text">Polygon</span></label>
        </div>
         <div class="modal-body" id="shapingtype" style="">
                 <label><input type="radio" name="shape" value="1"><span class="label-text"> Near By </span></label>
            <label><input type="radio" name="shape" value="2" checked><span class="label-text"> Shape </span></label>
        </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" id="apply" name="Apply" onclick="drawcheck()">Apply</button>
      </div>
    </div>
  </div>
</div>
<!-- end -->
</html>
<script>
function show()
{
   $("#shapingtype").attr("style","");
}
function hide()
{
   $("#shapingtype").attr("style","display:none;");
}
function drawcheck()
{
  $(".close").click();
    $(".modal-backdrop.fade.in").remove();
    removeAlllayer();
  shape=$('input[name=tools]:checked').val();
  shapetype=$('input[name=shape]:checked').val();
  menu=$('#hul').val();
  type=$('input[name=shape]:checked').val();
  menus=$('#hul').val();
  $("#markeropt").val(5);
  if(shape==1) //Circle
  {
        initiateCircle(shapetype,menu);
  }
  else if(shape==2)
  {
    initiateRectangle(shapetype,menu);
  }
  else if(shape==3)
  {
    initiatePolygon(shapetype,menu);
  }
}
function toggleshow()
{
    $('.spinner-wrapper').show();

   //console.log($('input:radio[name=toggleshow]:checked').val());
   // var tfile=$('input:radio[name=toggleshow]:checked').val();
   // var res = tfile.split("---");


    setTimeout(function(){
       nextleveltoggle=$('input:radio[name=toggleshow]:checked').val()+".svg";
       statuscode=UrlExists(baseurl+nextleveltoggle);
       if(statuscode == true)
        {
          $(".close").click();
          $(".modal-backdrop.fade.in").remove();
          var callback1 = function(feature)
           {
              map.data.remove(feature);
           };
        map.data.forEach(callback1);
     sessionStorage.setItem("currentloadfile", nextleveltoggle);
        initlayer(map,nextleveltoggle,0,0,'');
        $('.spinner-wrapper').hide();
       }
       else
       {
         $('.spinner-wrapper').hide();
            $.alert({
                  title: '',
                  content: 'Data Not Available',
                  boxWidth: '30%',
                  top:-500,
                    offsetTop: 70,
                  useBootstrap: false,
              });
       }
    },500);
}
function togglelocationload(curfile){
 //alert(curfile);
   findlocid=curfile.split("/");
   findlocid1=findlocid[1].split(".");
   findlocid2=findlocid1[0].split("---");
    view=sessionStorage.getItem('view');
//     if(view)
//     {
// }
  $.ajax({
                   type: "POST",
                   url: "AjaxRequest.php",
                   data:{"toggle":"togglelevel","id":findlocid2[0],"currentlevel":curfile},
                   success: function (data) {
                     $("#togglelocation").html('');
                     $("#togglelocation").html(data);
                     // console.log(data);
                   }
              });
}
$(document).ready(function(){
    $('#myTable').DataTable();
    $("#custom").spectrum({
        color: "#f00"
 });
  $( function() {
     var iValue1 = 100;
    var handle = $( "#custom-handle1" );
    $( "#slider1" ).slider({
      create: function() {
        handle.text( $( this ).slider( "value" ,iValue1) );
         $ (handle).text("100");
      },
      slide: function( event, ui ) {
        handle.text( ui.value );
      }
    });
  } );
    $( function() {
       var iValue = 100;
    var handle = $( "#custom-handle2" );
    $( "#slider2" ).slider({
      create: function(event, ui) {
        $(handle).text($( this ).slider( "value",iValue ));
        $ (handle).text("100");
        //console.log( ui.value);
      },
      slide: function( event, ui ) {
        handle.text( ui.value );
      }
    });
  } );
});
 function datatable_combine(tabledata)
  {
    //alert('ok');
      issetsvg = 0;//use to check whether svg applied or not
        try {
      overlay.setMap(null);
      }
      catch(err) {
      //document.getElementById("demo").innerHTML = err.message;
      }
  beforedtble=  $("#report").html(tabledata);
//   var tdIndex = $td.index() + 1;
// var $th = $('#table tr').find('th:nth-child(' + tdIndex + ')');
//   alert($th);

// var data = [
//    ['Foo', 'programmer'],
//    ['Bar', 'bus driver'],
//    ['Moo', 'Reindeer Hunter']
// ];


// function download_csv(data) {
//     var csv = 'Name,Title\n';
//     data.forEach(function(row) {
//             csv += row.join(',');
//             csv += "\n";
//     });

//     console.log(csv);
//     var hiddenElement = document.createElement('a');
//     hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
//     hiddenElement.target = '_blank';
//     hiddenElement.download = 'bimenu.csv';
//     hiddenElement.click();
// }
console.log(tabledata);


          $("#example19  thead tr th").each(function(){
    console.log("heading",$(this).text());

    if($(this).text()=="Values")
    {
      $(this).text("rega");
         //alert("keerthana");
    }
});



       // colCount = table.columns()[0].length;
       // console.log("col_count",colCount);
      // $("#example19 table").find("tr:first td").length;
      // alert();
      ordlevl = beforedtble.find('#example19 thead tr').children().length;



      ordlevl = ordlevl -1;
    var table =  $('body').find('#example19').DataTable( {
            dom: 'Bfrtip',

            buttons: [
                        {
                          extend:    'excelHtml5',
                          text:      '<img src="../images/excel_icon.png" style="width:18px;">',
                          titleAttr: 'Excel'
                        },
                        {
                        extend:    'pdfHtml5',
                        text:      '<img src="../images/pdf_icon.png" style="width:14px;">',
                        titleAttr: 'PDF'
                        }
                    ],
            "scrollY":"34vh",
            "scrollResize": true,
            "scrollCollapse": true,
             "order": [[ordlevl, "desc" ]],
            "paging": false
            } );


            jquerydatatable = table;
  }
  function datatable_split(tblcontent)
  {
    console.log("table__contents?$$$");
    console.log(tblcontent);
    $('.buttonexcel').html();
    $('.buttonexcel').html('<button id="rep2" class="csv"><span><img src="../images/excel_icon.png" style="width:18px;"></span></button>');



        $("#report").html(tblcontent);


          $("#rep2").click(function()
  {
//alert("naanthan");
 spitdata = JSON.parse(splitarray);

   // console.log("keerthanaCsv",splitarray);


var csv = 'Location,SplitType,Value,Contrbtn Share(%)\n';
// $(splitarray).each(function(row) {
var totalcont=0; var sumoftot=0;total_arr=[];inn_arr=[];spit_total=[];cont_share=[];total_arr1=[];
var currtot=0;
function getSum(total, num) {
    return total + num;
}


// console.log(jquerydatatable);
// console.log(spitdata);


  $.each(spitdata, function(i, e) {


     $.each(e, function(i1, e1) {

     // totalcont=totalcont+sumoftot;
         $.each(e1, function(i2, e2) {
   //  console.log("h",totalcont=+e2['result']);
   stip1= e2['result'].replace(/,/g, '');

     total_arr[i2]=parseFloat(stip1);

    });
    spit_total[i1]=total_arr.reduce(getSum);

    });
     totalcont=total_arr.reduce(getSum);
     });
//console.log("***********");


         // console.log(totalcont);// full total
  $.each(spitdata, function(i, e) {


     $.each(e, function(i1, e1) {

    $.each(e1, function(i2, e2) {
   //  console.log("h",totalcont=+e2['result']);
   stip= e2['result'].replace(/,/g, '');

     inn_arr[i2]=parseFloat(stip);
   });

    a=parseFloat(inn_arr.reduce(getSum));
       // console.log((parseFloat(a)/parseFloat(totalcont))*100);//outer total
      $.each(e1, function(i2, e2) {
   //  console.log("h",totalcont=+e2['result']);
   stip= e2['result'].replace(/,/g, '');
    // //     cont_share[i2]=(stip/a)*100;
    //  console.log((stip/a)*100);
     csv += e2['location']+","+e2['title']+","+stip+","+(stip/a)*100;
        csv += "\n";
                       currtot = currtot +parseFloat(stip);


                       //tot=(parseFloat(currtot)/parseFloat(totalcont))*100;
                        currntloc = e2['location']+",Total,"+currtot;
   });
     // console.log(parseFloat(spit_total[i1])/parseFloat(totalcont));
         csv +=currntloc+","+parseFloat(inn_arr.reduce(getSum))/parseFloat(totalcont);
                      csv += "\n";

   });

    });

    //console.log(csv);
    labfin =  getmenulbl();
    var hiddenElement = document.createElement('a');
    hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
    hiddenElement.target = '_blank';
    hiddenElement.download = labfin+'.csv';
    hiddenElement.click();
    window.open(hiddenElement);
  });
        view=sessionStorage.getItem('view');

        if(view == 0)
              {
                var table =$('#example2').DataTable( {
                dom: 'Bfrtip',
                 "scrollY":        "34vh",
                 "scrollCollapse": true,
                buttons: [
                  {
                    extend:    'excelHtml5',
                    text:      '<img src="../images/excel_icon.png" style="width:18px;">',
                    titleAttr: 'Excel'
                  },
                  {
                  extend:    'pdfHtml5',
                  text:      '<img src="../images/pdf_icon.png" style="width:14px;">',
                  titleAttr: 'PDF'
                  }
                ], "order": [[ 2, "desc" ]], "paging": false
                } );
                jquerydatatable = table;
              }
              else
              {
                var lastindex = $('#example2').find('td:last').index();
                // alert(lastindex);
                var table =$('#example2').DataTable( {
                dom: 'Bfrtip',
                 "scrollY":        "34vh",
                 "scrollCollapse": true,
                buttons: [
                  {
                    extend:    'excelHtml5',
                    text:      '<img src="../images/excel_icon.png" style="width:18px;">',
                    titleAttr: 'Excel'
                  },
                  {
                  extend:    'pdfHtml5',
                  text:      '<img src="../images/pdf_icon.png" style="width:14px;">',
                  titleAttr: 'PDF'
                  }
                ], "order": [[ lastindex, "desc" ]], "paging": false
                } );
                jquerydatatable = table;
              }
              // console.log('A');
              // console.log(maplayer);
              // console.log('B');
              // maplayer.eachLayer(function(mylay) {
              //       alert(mylay.layerID);
              //     // if (mylay.layerID == worldid) {
              //     // }
              //   });
              // alert(splitarray);
              function explode(){
                 $('.buttons-excel').hide();
              }
              setTimeout(explode, 100);
  }
 function getmenulbl()
  {
      // alert('menust');
            labfin1=[]; hoder=[];
      reading =  sessionStorage.getItem('reading');
      superparent = sessionStorage.getItem('superparent');
      parentlbl1= sessionStorage.getItem('parentlbl');
      try {
       parentlbl = JSON.parse(parentlbl1);
      }
      catch(err) {
       parentlbl = parentlbl1;
      }
      menulbl= sessionStorage.getItem('menulbl');
       try
       {
          menulbl = JSON.parse(menulbl);
       }
       catch(err)
       {
          menulbl =menulbl;
       }
      labfin = menulbl.toString();
      if(menulbl.length<=5)
      {
        labfin = menulbl.toString()+' '+superparent.toString();
      }
      else
      {
        for(i=0;i<parentlbl.length;i++)
        {
          r=parentlbl[i];
          e=r.split("/");
          hoder.push(e[1]);
          if(e[1]==undefined)
          {
          labfin = parentlbl.toString()+' '+superparent.toString();
          }
          else
          {
            labfin1.push(e[1]);
                if(labfin1.length>5)
                {
                  labfin=e[0];
                }
             else
             {
             labfin=labfin1;
             }
          }
        }
      }
      return labfin;
  }
 // function higcharts_combine(chartcontent,mapcontent)
 //  {
 //       for(k=0; k<markerscharts.length; k++){
 //                markerscharts[k].setMap(null);
 //                }
 //        $("#chart").html(chartcontent);
 //        colorcode = colorgradientcreation(mapcontent,'0');
 //        // console.log(colorcode);
 //        // console.log(charts);
 //        if(view == 0 || view ==5 )
 //        {
 //         charts.update({ colors: colorcode[0] });
 //        }
 //        locdetail = []
 //        getpro_arr = [];
 //        map.data.forEach(function(feature) {
 //          getpro_arr[feature.getProperty('DB_ID')]=feature;
 //        });
 //        if(colorcode[1].length > 0)
 //        {
 //          //colorcode[1] = colorcode[1].reverse();
 //        }
 //        j=0;
 //        labfin =  getmenulbl();
 //        $.each(mapcontent, function(i, item)
 //        {
 //          percent = 0;
 //          var ite="";
 //          t=mapcontent[i].split("****");
 //          areavalue[t[0]] = t[1];
 //          if(t[1]> 0){
 //            colorcodeid[t[0]] = colorcode[0][i];
 //          }
 //          else
 //          {
 //            colorcodeid[t[0]] = colorcode[1][j];
 //            j++;
 //          }
 //        });
 //        //chartcolorfillgrowth = new Array();
 //        map.data.setStyle(function(feature)
 //        {
 //          if (typeof colorcodeid[feature.getProperty('DB_ID')] != 'undefined')
 //          {
 //            //chartcolorfillgrowth.push(colorcodeid[feature.getProperty('DB_ID')]);
 //            return({
 //            strokeColor: '#000',
 //            strokeOpacity:1,
 //            strokeWeight: 1,
 //            fillColor: colorcodeid[feature.getProperty('DB_ID')],
 //            fillOpacity: 1
 //            });
 //          }
 //          else
 //          return ({
 //          fillColor: 'white',
 //          strokeWeight:1
 //          });
 //        });
 //        // console.log(chartcolorfillgrowth);
 //        if(view == 3)
 //        {
 //          resetArr = colorcodeid.filter(function(){return true;});
 //          arr_g = colorcode[0];//green;
 //          arr_r = colorcode[1];//red
 //          arr_r.reverse();
 //          color_arry = arr_g.concat(arr_r);
 //          charts.update({ colors: color_arry });
 //        }
 //  }
  function higcharts_combine(chartcontent,mapcontent)
  {
        for(k=0; k<markerscharts.length; k++){
        markerscharts[k].setMap(null);
        }
         map.data.setStyle(function(feature)
      {
        // else
        return ({
        fillColor: 'white',
        strokeWeight:1
        });
      });
          //console.log("************");
             //console.log(mapcontent);
               console.log('FInal task');
             console.log(chartcontent);
        $("#chart").html(chartcontent);



        colorcode = colorgradientcreation(mapcontent,'0');

       labfin =  getmenulbl();

        // console.log('FInal task');
        // console.log(chartdupseries[0]['data']);
        // alert(view);
        if(view == 0 || view ==5 )
        {
            console.log('FIRRRRRRRRRRRRRst');
            console.log(charts.options.chart.type);
            // alert(charts.type);
            if(charts.options.chart.type != 'bubble')
            {
              charts.update({ colors: colorcode[0] ,        subtitle: {
              text: labfin+' '+reading
              }
              });
            }

            console.log(charts);
         // $.each(chartdupseries[0]['data'], function(i, item)
         //  {
         //      // console.log(i);
         //      chartdupseries[0]['data'][i]['fillColor'] = colorcode[0][i];
         //      // console.log(item);

         //  });
         // charts.series[0].setData(chartdupseries);
         // console.log(chartdupseries);
        }
       // charts.redraw();

         //  console.log(chartcontent);
          // console.log("colors of chart ",colorcode[0]);
      locdetail = []
      getpro_arr = [];
      map.data.forEach(function(feature) {
        getpro_arr[feature.getProperty('DB_ID')]=feature;
      });
      if(colorcode[1].length > 0)
      {
        //colorcode[1] = colorcode[1].reverse();
      }
      j=0;
      // closest('table').find('th').eq(1).text();
      // alert();
      view = sessionStorage.getItem('view');
      var head_item = '';
      if(view == 0 || view == 5)
      {
         head_item =   jquerydatatable.columns(1).header();
      }
      else
      {
        head_item =   jquerydatatable.columns(0).header();
      }
      // console.log(jquerydatatable.columns().header());
      // .find('th').eq(1).text()


      $.each(mapcontent, function(i, item)
      {
        percent = 0;
        var ite="";
        t=mapcontent[i].split("****");
          var tval = t[1];
          var resco12 = tval.toString().split('.');
          var resco1 =resco12[0].replace(/\,/g,'');
          var amtcomma =moneyFormatIndia((resco1));
          // if ( resco1[1] !== void 0 )
          // {
          //   amtcomma = amtcomma+'.'+resco12[1];
          // }
          // alert(t[0]);
          t[0]=(t[0]==14878) ? 73 :t[0];
        areavalue[t[0]] = labfin+':'+amtcomma+' '+reading;//t[1];
        if(t[1]> 0){
          colorcodeid[t[0]] = colorcode[0][i];
        }
        else
        {
          colorcodeid[t[0]] = colorcode[1][j];
          j++;
        }
      });
      // if(view == 0 || view == 5)
      // {
      //    $(head_item ).html('sdufhsdhfjk');//html(labfin+' '+reading);
      // }
      // else
      // {
      //     $(head_item).parent().siblings(':first-child').html('Values');//html(labfin+' '+reading)
      //    // $(head_item).parent().parent().children(':first-child').html(labfin+' '+reading);
      // }
       $("#chartname").text(labfin+' '+reading);

        $("#reportname").text(labfin+' '+reading);

      map.data.setStyle(function(feature)
      {
        if (typeof colorcodeid[feature.getProperty('DB_ID')] != 'undefined')
        {
          //chartcolorfillgrowth.push(colorcodeid[feature.getProperty('DB_ID')]);
          return({
          strokeColor: '#000',
          strokeOpacity:1,
          strokeWeight: 0.5,
          fillColor: colorcodeid[feature.getProperty('DB_ID')],
          fillOpacity: 1
          });
        }
        else
        return ({
        fillColor: 'white',
        strokeWeight:1
        });
      });
      // console.log(chartcolorfillgrowth);
      if(view == 3)
      {
        resetArr = colorcodeid.filter(function(){return true;});
        arr_g = colorcode[0];//green;
        arr_r = colorcode[1];//red
        arr_r.reverse();
        color_arry = arr_g.concat(arr_r);
        charts.update({ colors: color_arry });
      }
  }
  function higcharts_split(chartcontent,mapcontent)
  {
     $("#chart").html(chartcontent);
    // console.log("jhhjhh",chartcontent);
     //charts.legendHide();
      // var legend = charts.legend;

      //   if(legend.display) {
      //       legend.group.hide();
      //       legend.box.hide();
      //       legend.display = false;
      //   } else {

      //       legend.group.show();
      //       legend.box.show();
      //       legend.display = true;
      //   }
     // for(n=0;n<charts.series.length;n++)
     // {

     //   charts.series[n].userOptions.showInLegend=false;
     //  console.log(charts.series[n].userOptions.showInLegend);
     // }

        labfin =  getmenulbl();
       $("#reportname").text(labfin);
       $("#chartname").text(labfin);
      // globalcharts = charts;
      for(var k=0;k<charts.length;k++)
      {
        //console.log(charts.series[k].userOptions.showInLegend);
       // charts.series[k].userOptions.showInLegend=false;
        globalcharts[charts.series[k].split_id] = charts.series[k].color;
        //console.log(charts.series[k].userOptions.showInLegend);
      }

     // console.log( charts.series);
      // charts.series[i].remove();
  }
function removeAllPiemarker()
{
  for(var i in markerscharts) {
  markerscharts[i].setMap(null);
  }
  markerscharts = [];
}




  function setsplitmarker(valuesar,colorsar,lats,longs,dataf,presentkey,rev) //piechart creation for split
      {
        file1=file.split("SVG/");
      file11=file1[1].split("/");
      file2=file11[2].split(".svg");
      file3=file2[0].split("---");
      fileid=file3[0];
      mainloc=file3[1];
      subloc=file3[2];
     //   zoomarr=[];
      //  loc_type(mainloc,subloc,fileid);
      // name= sessionStorage.getItem("loctype");
      map.data.setStyle(function(feature)
      {
      // else
      return ({
      fillColor: 'white',
      fillOpacity:0,
      strokeOpacity:0,
      strokeWeight:0
      });
      });


      if(valuesar.length == 1)
      {

      valuesar.push(valuesar[0]);
      colorsar.push(colorsar[0]);
      }

      so=valuesar.reduce(function(acc, val) { return acc + val; });
      var pieData = { values: valuesar, colors: colorsar, radius: splitradius(mainloc,subloc,so
      ), stroke: 0 };

      const _icon = {
      url: 'data:image/svg+xml;charset=UTF-8,' + svgCharts().generatePieChartSVG(pieData.values, pieData.colors, pieData.radius, pieData.stroke)
      }

      var markerchart = new google.maps.Marker({
      position: { lat: lats, lng: longs },
      map: map,
      id:presentkey,
      icon: _icon
      });
           //loc_type(mainloc,subloc,fileid);


      markerchart.addListener('mouseover', function(event)

      {

        //name = sessionStorage.getItem("loctype")+"-"+""+":"+dataf;
      s="<b>"+jquerydatatable.row().context[0].aIds[this.id]._aData[1]+"</b>"+":"+dataf;
     // t= jquerydatatable.row().context[0].aIds[this.id]._aData[1];
      deleteTooltip(event);
      injectTooltip(event,s);

      });



      markerchart.addListener('mouseout', function(event) {

      deleteTooltip(event);
      });
      markerchart.addListener('dblclick', function(event) {
      map.panTo(this.getPosition());


        $.ajax({
        type: "POST",
        url: "AjaxRequest.php",
        data:{"nextlevel":"nextlevel","id":this.id,"currentlevel":file},
        async:false,
        success: function (data)
        {
        // console.log(data);
        filecp=data
       initlayer(map,filecp,0,1,'');
        if(filecp=="SVG/1---21---21.svg")
        {


        file1=filecp.split("SVG/");
        file2=file1[1].split(".svg");
        file3=file2[0].split("---");
        fileidcp=file3[0];
        mainloccp=file3[1];
        subloccp=file3[2];

        }
        else if(filecp=="SVG/1---21---1.svg")
        {


        file1=filecp.split("SVG/");

        file2=file1[1].split(".svg");
        file3=file2[0].split("---");
        fileidcp=file3[0];
        mainloccp=file3[1];
        subloccp=file3[2];

        }


        else
        {
        file1=filecp.split("SVG/");
        file11=file1[1].split("/");
        file2=file11[2].split(".svg");
        file3=file2[0].split("---");
        fileidcp=file3[0];
        mainloccp=file3[1];
        subloccp=file3[2];
        }

        sessionStorage.setItem("id",fileidcp);
        sessionStorage.setItem("parentlvl",mainloccp);
        sessionStorage.setItem("childlvl",subloccp);


        }
        });


      });
      markerscharts.push(markerchart);



  }

 function colorgradientcreation(testarr,codeprocess)
  {
    view=sessionStorage.getItem('view');
    coloshades =[];
    coloshadesnegative= [];
    colornegapply = 0;
    colorpsapply = 0;
    negativecnt = 0;
    let colorsg = new GradientArray();
    if(view!="3")
    {
      HexFrom = "#004000";
      HexTo = "#1aff1a";
      // alert(testarr.length);
      coloshades.push(colorsg.gradientList(HexFrom, HexTo, testarr.length));
      // coloshades.push(generateGradient(HexFrom, HexTo, testarr.length));
      // alert(coloshades);
      coloshades = coloshades[0];
    }
    else
    {
      if(codeprocess == '0')  //check whether call from filter or report
      {
        negativecnt = testarr.filter(function(e) {
          var s = e.split("****");
          return s[1] < 0;
        }).length;
      }
      else
      {
         negativecnt = testarr.filter(function(e) {
                                        return e < 0;
                                        }).length;
      }
          // alert(negativecnt);
          if(negativecnt > 0)
          {
            ngtval = negativecnt;
            if(negativecnt == 1)
            {
              //ngtval = ngtval +1;
            }
            // "#AC0F13","#FEE7DC"
            // alert(negativecnt);
             coloshadesnegative.push(colorsg.gradientList("#ff0000","#ffcccc", ngtval));
            //coloshadesnegative.push(generateGradient("#ff0000","#ffcccc", ngtval));
            coloshadesnegative = coloshadesnegative[0];
            // alert(coloshadesnegative);
            HexFrom = "#004000";
            HexTo = "#1aff1a";
            var postivecnt = testarr.length - negativecnt;
            //alert(postivecnt);
            if(postivecnt > 0){
            postivecnt = Math.abs(postivecnt);
            coloshades.push(colorsg.gradientList(HexFrom,HexTo,postivecnt));
            // coloshades.push(generateGradient(HexFrom,HexTo,postivecnt));
            coloshades = coloshades[0];
            }
          }
          else
          {
             HexFrom = "#004000";
            HexTo = "#1aff1a";
            // alert(testarr.length);
            coloshades.push(colorsg.gradientList(HexFrom,HexTo,testarr.length));
            // coloshades.push(generateGradient(HexFrom,HexTo,testarr.length));
            coloshades = coloshades[0];
            // alert(coloshades);
          }
    }
      colorsmap = new Array();
       colorsmap.push(coloshades);

      colorsmap.push(coloshadesnegative);

//       console.log("Graphcolor");
// console.log(coloshades);

      return colorsmap;
  }
 function moneyreadconversion(num,ext)
  {
    //number_of_digits = num.length; //this is call :)
    if(ext == 'Cr') //cr
    {
     divider = 10000000;
    }
    else if (ext == 'lac')
    {
      divider = 100000;
    }
    else if (ext == 'k')
    {
     divider = 1000;
    }
    else
    divider=1;
    // echo $divider;die;
    // echo $num/$divider; die;
    fraction=num/divider;
    fraction=fraction.toFixed(2);
    // if($number_of_digits==4 ||$number_of_digits==5)
    //     $ext="k";
    // if($number_of_digits==6 ||$number_of_digits==7)
    //     $ext="Lac";
    // if($number_of_digits==8 ||$number_of_digits==9)
    //     $ext="Cr";
    return  fraction;//+" "+ext;
  }
  function moneyformatNew(x)
  {
      x=x.toString();
      var afterPoint = '';
      if(x.indexOf('.') > 0)
      afterPoint = x.substring(x.indexOf('.'),x.length);
      x = Math.floor(x);
      x=x.toString();
      var lastThree = x.substring(x.length-3);
      var otherNumbers = x.substring(0,x.length-3);
      if(otherNumbers != '')
      lastThree = ',' + lastThree;
      var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
      return res;
  }
  function numDifferentiation(val) {
    if(val >= 10000000) val = (val/10000000) + ' Cr';
    else if(val >= 100000) val = (val/100000) + ' Lac';
    else if(val >= 1000) val = (val/1000) + ' K';
    return val;
}
  function moneyFormatIndia(num)
  {
    // $num =75020320335;
    // return num;
    // alert(num); 1770738990
    var explrestunits = "" ;
    var cmtcnt =0;
    if(num.length <=6)
    {
       var amtcomma =moneyformatNew(num);//moneyFormatIndia((resco1));
       return amtcomma;
    }
    if((num.length)>3)
    {
       // $lastthree = substr($num, strlen($num)-3, strlen($num));
        lastthree = num.substring(num.length, num.length-3); //substr($num, strlen($num)-3, strlen($num));

        // testmid = num.substring(num.length, num.length-);
        //return lastthree;
        restunits = num.substring( 0, num.length-3);
        // return restunits;
        // $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        // return $restunits;
         // (isMember ? "$2.00" : "$10.00");
         // restunits= (((restunits.length)%2 == 1) ? "0"+restunits : restunits);
         // return restunits;
        //$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        firstrestunits =  restunits.substring(0,restunits.length-4);//substr($restunits, 0, -4);
        //return firstrestunits;
         firstrestunits = firstrestunits;
         // return firstrestunits;
         midrestunits =  num.substring(restunits.length, restunits.length-4);//substr($restunits, strlen($restunits)-4);
         // alert(firstrestunits+" // "+midrestunits);
       //  sss = firstrestunits+' / '+midrestunits+' / '+lastthree;
       // return sss;
       // if(num == 1770738990)
       //  {
       //   alert(midrestunits);
       //   //0738
       //  }
        expunit= midrestunits.match(/.{2}/g);// $expunit = str_split($midrestunits, 2);
        // return expunit;
        // alert(expunit);
        if(expunit == null)
        {
          return num;
        }
        // alert(expunit);
        for(i=0; i<expunit.length; i++) {
          // if($cmtcnt == 3)
          // {
          //   continue;
          // }
        // creates each of the 2's group and adds a comma to the end
        if(i==0) {
        explrestunits += (expunit[i])+","; // if is first value , convert into integer

        } else {
        explrestunits += expunit[i]+",";

        }
        cmtcnt = cmtcnt+1;
        }
        if(firstrestunits == 0)
        {
          thecash =explrestunits+lastthree;

        }
        else
        {
          thecash =firstrestunits+','+explrestunits+lastthree;

        }
    }
    else
    {
        thecash = num;
    }
        // alert(thecash);
    return thecash; // writes the final format where $currency is the currency symbol.
  }
  function moneyconprocess(newval)
  {
          view = sessionStorage.getItem('view');
          if(view != 3)
          {
            var resco12 = newval.split('.');
            if(resco12.length > 1)
            {
              var resco1 =resco12[0].replace(/\,/g,'');
            }
            else
            {
              var resco1 =newval.replace(/\,/g,'');
            }
            // alert(resco1);
            if(resco1.length == 1)
            {
             var amtcomma = newval;
            }
            else
            {
              if(resco1.length <=6)
              {
                var amtcomma =moneyformatNew(resco1);//moneyFormatIndia((resco1));
              }
              else
              {
                var amtcomma =moneyFormatIndia(resco1);
              }
            }
            if ( resco1[1] !== void 0 )
            {
              if(resco12[1] != undefined)
              {
              amtcomma = amtcomma+'.'+resco12[1];
              }
            }
          }
          else
          {
            amtcomma = newval;
          }
          return amtcomma
  }
 function makeRequest(myData,myData1,splidids)
  {
      // if(mnidfileter != '')
      // {
      //     mnid = mnidfileter;
      // }
      // else
      // {
      //
      // }
      // alert("Sds");
      tbl=sessionStorage.getItem('tbl');
      view=sessionStorage.getItem('view');
      comb = sessionStorage.getItem('groupby');
      // alert(view);
      parentlevel = sessionStorage.getItem('parentlvl');
      childlevel = sessionStorage.getItem('childlvl');
      // if(splitname3[0]=="0"){ parentlevel=21;childlevel=5;}
      // if(splitname3[0]=="1"){ parentlevel=5;childlevel=5;}
      // if(splitname3[0]=="2"){parentlevel=5;childlevel=7;}
      // if(splitname3[0]=="3"){parentlevel=7;childlevel=7;}
      // if(splitname3[0]=="4"){parentlevel=7;childlevel=9;}
      // if(splitname3[0]=="5"){parentlevel=9;childlevel=9;}
      // if(splitname3[0]=="6"){parentlevel=12;childlevel=15;}
      // if(splitname3[0]=="7"){parentlevel=15;childlevel=15;}
      var th = $("#example2 thead tr th").eq(0).text();
      year=sessionStorage.getItem('year');
      splityear = year.split(",");
       console.log(splitarray);
      spitdata = JSON.parse(splitarray);


      // alert(splitarray);
      var tablestr ='';
      // if(splityear.length > 1)
      //{
           combv1 = sessionStorage.getItem('split_combine_id');
       //     var tbv='#'+combv1+'_anchor';

       // console.log($(tbv).val());

      objitems =  JSON.parse(itemobj);
      var itemdts =[];
      tablestr +="<table id ='subtableexp' cellpadding='5' cellspacing='0' border='0' style='padding-left:50px;'><thead><tr>";
      tablestr +="<th id='subhead'>"+sessionStorage.getItem("selectedname")+"</th>";
      if(view == 2)
      {
        for(j=splityear[0];j<=splityear[1];j++)
        {
        tablestr +="<th><b>"+j+"</b></th>";
        }
        tablestr +="<th><b>Total</b></th>";
      }
      else if(view == 0 || view == 5)
      {
        tablestr +="<th><b>Cummaltive ("+splityear.toString()+")</b></th>";
        // if(comb == 'C'){
        tablestr +="<th><b>Contrbtn Share(%)</b></th>";//}
      }
      else
      {
        for(j=0;j<splityear.length;j++)
        {
        tablestr +="<th><b>"+splityear[j]+"</b></th>";
        }
        if(view != 3){
        tablestr +="<th><b>Total</b></th>";} //temp fix for cummatli
      }
      if(view == 3)
      {
        tablestr +="<th><b>Growth</b></th>";
        grwth = new Array();
      }
      tablestr +="</tr></thead><tbody id ='subtable'>";
      variable_filter = sessionStorage.getItem("variable_fiter");
      resfill =[];
      if(variable_filter === null)
      {
         resfill = [];
      }
      else
      {
           resfill = variable_filter.split(",");
      }
      //var resfill = variable_filter.split(",");
      if(view == 0 || view == 5)// view == 0 || temp solution for cummaltive and growth
      {
        if(splityear.length ==1)
        {
          itemdts  =spitdata;
          splitid = splidids.split(",");
          var arrdata = $.map(itemdts, function(el) { return el });
          // newdata = arrdata[0][myData];
          // console.log(objitems);
          for(kl=0;kl<objitems.length;kl++)
          {
            splitobj = objitems[kl].split('/');
            if(variable_filter) // != ''
            {
               // alert(variable_filter);
              var checkindex = resfill.indexOf(splitobj[0]);
              // console.log(objitems[kl]+" *** "+checkindex);
              if (checkindex > -1)
              {
              tablestr += "<tr>";
              tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
              for(y=0;y<splityear.length;y++)
              {
                // moneyFormatIndia
                //moneyFormatIndia
                // alert(splityear[y]);
                tablestr += "<td align = 'right' id = '"+splityear[y]+"'></td>";
                //class ='cntbr'
                // tablestr += "<td id = '"+newdata[splitobj[0]]['result']+"'></td>";
                // console.log(newdata[splitobj[0]]['result']);
              }
              tablestr +="<td align = 'right' class ='cntbr'></td>";
              // tablestr +="<td align = 'right' ></td>";
              // tablestr += "<td class = 'tot'>"+newdata[splitobj[0]]['result']+"</td>";
              tablestr += "</tr>";
              }
            }
            else
            {
              tablestr += "<tr>";
              tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
              for(y=0;y<splityear.length;y++)
              {
              //moneyFormatIndia
              // alert(splityear[y]);
              // alert(splityear[y]);
                tablestr += "<td align = 'right' id = '"+splityear[y]+"'></td>";
              }
              tablestr +="<td align = 'right' class ='cntbr'></td>";
              tablestr += "</tr>";
            }
          }
        }
        else
        {
          // alert('cumm');
          //cummaltive multiple years
        itemdts  =spitdata[myData];
        splitid = splidids.split(",");
        // console.log(spitdata);
        // console.log(myData);
        var arrdata = $.map(itemdts, function(el) { return el });
        // console.log(itemdts);
        if(variable_filter != '')
        {
          for(kl=0;kl<objitems.length;kl++)
          {
            splitobj = objitems[kl].split('/');
            var checkindex = resfill.indexOf(splitobj[0]);
            if (checkindex > -1)
            {
              tablestr += "<tr>";
              tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
              tablestr += "<td align = 'right' class = 'tot'></td>";
                if(comb == 'C'){
               tablestr +="<td align = 'right' class ='cntbr'></td>";}
              tablestr += "</tr>";
            }
          }
        }
        else
          {
          // console.log(objitems);
          for(kl=0;kl<objitems.length;kl++)
          {
          tablestr += "<tr>";
          splitobj = objitems[kl].split('/');
          tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
          tablestr += "<td align = 'right' class = 'tot'></td>";
            if(comb == 'C'){
           tablestr +="<td align = 'right' class ='cntbr'></td>";}
          tablestr += "</tr>";
          }
        }
        }
      }
      else
      {
        itemdts  =spitdata[myData];
        splitid = splidids.split(",");
        // console.log(spitdata);
        // console.log(myData);
        var arrdata = $.map(itemdts, function(el) { return el });
        // console.log(itemdts);
        // alert(variable_filter);
        goahead = 1;
        if(variable_filter.length > 0)
        {
          goahead = 0;
        }
        // if(variable_filter != '')
        // {
        //   goahead = 0;
        // }
        // alert(goahead);
        if(goahead != 1)//if(variable_filter != null && resfill.length > 0)
        {
          // alert("Sdfs");
          for(kl=0;kl<objitems.length;kl++)
          {
            splitobj = objitems[kl].split('/');
            // alert("A / "+splitobj[0]);
            var checkindex = resfill.indexOf(splitobj[0]);
            if (checkindex > -1)
            {
              tablestr += "<tr>";
              tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
              if(view == 1 || view == 3)
              {
                for(y=0;y<splityear.length;y++)
                {
                //moneyFormatIndia
                // alert(splityear[y]);
                tablestr += "<td align = 'right' id = '"+splityear[y]+"'></td>";
                }
              }
              else
              {
                // for($i=$periods[0];$i<=$periods[1];$i++)
                for(y=splityear[0];y<=splityear[1];y++)
                {
                tablestr += "<td align = 'right' id = '"+y+"'></td>";
                }
              }
              tablestr += "<td align = 'right' class = 'tot'></td>";
              tablestr += "</tr>";
            }
          }
        }
        else
        {
          // alert(variable_filter);
          // console.log('sss');
          // console.log(objitems);
          for(kl=0;kl<objitems.length;kl++)
          {
            tablestr += "<tr>";
            splitobj = objitems[kl].split('/');
            tablestr += "<td id = '"+splitobj[0]+"'>"+splitobj[1]+"</td>";
            if (view == 1 || view == 3)
            {
              for(y=0;y<splityear.length;y++)
              {
              tablestr += "<td align = 'right' id = '"+splityear[y]+"'></td>";
              }
            }
            else
            {
             // for($i=$periods[0];$i<=$periods[1];$i++)
              for(y=splityear[0];y<=splityear[1];y++)
              {
              // console.log(y);
              tablestr += "<td align = 'right' id = '"+y+"'></td>";
              }
            }
            tablestr += "<td align = 'right' class = 'tot'></td>";
            tablestr += "</tr>";
          }
        }
      }
      tablestr +="</tbody></table>";
      tablestr.replace("<tr></tr>", "");
      // console.log(tablestr);
      r = tablestr;
      return r;
  }

//   $("#rep2").click(function()
//   {
// alert("naanthan");
//  spitdata = JSON.parse(splitarray);

//    // console.log("keerthanaCsv",splitarray);


// var csv = 'Location,SplitType,Value,Contrbtn Share(%)\n';
// // $(splitarray).each(function(row) {
// var totalcont=0; var sumoftot=0;total_arr=[];inn_arr=[];spit_total=[];cont_share=[];total_arr1=[];
// var currtot=0;
// function getSum(total, num) {
//     return total + num;
// }


// // console.log(jquerydatatable);
// // console.log(spitdata);


//   $.each(spitdata, function(i, e) {


//      $.each(e, function(i1, e1) {

//      // totalcont=totalcont+sumoftot;
//          $.each(e1, function(i2, e2) {
//    //  console.log("h",totalcont=+e2['result']);
//    stip1= e2['result'].replace(/,/g, '');

//      total_arr[i2]=parseFloat(stip1);

//     });
//     spit_total[i1]=total_arr.reduce(getSum);

//     });
//      totalcont=total_arr.reduce(getSum);
//      });
// //console.log("***********");


//          // console.log(totalcont);// full total
//   $.each(spitdata, function(i, e) {


//      $.each(e, function(i1, e1) {

//     $.each(e1, function(i2, e2) {
//    //  console.log("h",totalcont=+e2['result']);
//    stip= e2['result'].replace(/,/g, '');

//      inn_arr[i2]=parseFloat(stip);
//    });

//     a=parseFloat(inn_arr.reduce(getSum));
//        // console.log((parseFloat(a)/parseFloat(totalcont))*100);//outer total
//       $.each(e1, function(i2, e2) {
//    //  console.log("h",totalcont=+e2['result']);
//    stip= e2['result'].replace(/,/g, '');
//     // //     cont_share[i2]=(stip/a)*100;
//     //  console.log((stip/a)*100);
//      csv += e2['location']+","+e2['title']+","+stip+","+(stip/a)*100;
//         csv += "\n";
//                        currtot = currtot +parseFloat(stip);


//                        //tot=(parseFloat(currtot)/parseFloat(totalcont))*100;
//                         currntloc = e2['location']+",Total,"+currtot;
//    });
//      // console.log(parseFloat(spit_total[i1])/parseFloat(totalcont));
//          csv +=currntloc+","+parseFloat(inn_arr.reduce(getSum))/parseFloat(totalcont);
//                       csv += "\n";

//    });

//     });

//     //console.log(csv);
//     labfin =  getmenulbl();
//     var hiddenElement = document.createElement('a');
//     hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
//     hiddenElement.target = '_blank';
//     hiddenElement.download = labfin+'.csv';
//     hiddenElement.click();
//     window.open(hiddenElement);
//   });

  function addvl(a, b)
  {
    return a + b;
  }
  function zeffect(circle)
  {
      var myZoom = {
        start:  map.getZoom(),
        end: map.getZoom()
      };
map.data.addListener('zoomstart', function(event) {
     // map.on('zoomstart', function(e) {
         myZoom.start = map.getZoom();
      });
map.data.addListener('zoomend', function(event) {
     // map.on('zoomend', function(e) {
          myZoom.end = map.getZoom();
          var diff = myZoom.start - myZoom.end;
          if (diff > 0) {
              circle.setRadius(circle.getRadius() * 2);
          } else if (diff < 0) {
              circle.setRadius(circle.getRadius() / 2);
          }
      });
  }
  function findgrowth(valuesarr)
  {
    sumoftwo = valuesarr[1]-valuesarr[0];
    // alert(sumoftwo);
    if(sumoftwo == 0)
    {
     return 0;
    }
    growthrate = ((sumoftwo)/valuesarr[0])*100;
    return growthrate;
  }
  $('body').on('click', '.details-control', function (e)
  {
        e.stopImmediatePropagation();
        var tr = $(this).closest('tr');
        var row = jquerydatatable.row( tr );//var row = table.row( tr );
        if ( row.child.isShown() )
         {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
        }
        else
        {
            // Open this row
            var myData=$(this).attr('count');
            // alert(myData);
            var myData1=$(this).attr('level');
            var splidids = $(this).attr('splitids');
            row.child(makeRequest(myData,myData1,splidids)).show();
            view=sessionStorage.getItem('view');
            year=sessionStorage.getItem('year');
             lvid=sessionStorage.getItem('levelid');
            splityear = year.split(",");
            // alert(view);
            var indexre = parseInt( window.parent.$('.reading-conv').attr("data-value"));//parseInt( window.parent.$('.reading-conv').val());
            var inrreading  = {1:"Cr", 2:"lac", 3:"k",4:"Nos."};
              //moneyFormatIndia
              if(view ==1 || view ==2 || view ==3)
              {
                splityear = year.split(",");
                // alert(splityear);
                itemdts  =spitdata[myData];
                var arrdata = $.map(itemdts, function(el) { return el });
                objitems =  JSON.parse(itemobj);
                if(view == 1 || view == 3)
                {
                  // console.log(itemdts);
                  for(zx=0;zx<splityear.length;zx++)
                  {
                    // alert(splityear[zx])
                    // console.log(splityear[zx]);
                    itemdetails =itemdts[splityear[zx]];
                    // console.log(itemdetails);
                    var itemdetails = $.map(itemdetails, function(el) { return el }); //error
                    for(xy=0;xy<itemdetails.length;xy++)
                    {
                      var subtable = $(this).parent().next().find('#subtable');//$('#subtable');//robin
                      var maintbl = subtable.find('#'+myData);
                      // indexre = 4;
                      if(indexre !=4)
                      {
                        valnew = itemdetails[xy]['result']
                        valnew = valnew.replace(/\,/g,'');
                        valnew = moneyreadconversion(valnew,inrreading[indexre]);
                        var resco12 = valnew.toString().split('.');
                            var resco1 =resco12[0].replace(/\,/g,'');
                            var amtcomma =moneyFormatIndia((resco1));
                             kl=lvid.split(",");

                      if ( resco1[1] !== void 0 )
                      {
                         if(kl[0]==238)
                                {

                                  amtcomma = amtcomma ;// population round off by keerthana
                                }
                        if(resco12[1] != undefined && kl[0]!=238)
                              {


                                  amtcomma = amtcomma+'.'+resco12[1];

                              }
                      }
                        subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+splityear[zx]).text(amtcomma);
                      }
                      else
                      {
                           var resco12 = itemdetails[xy]['result'].toString().split('.');
                            var resco1 =resco12[0].replace(/\,/g,'');
                            var amtcomma =moneyFormatIndia((resco1));
                             kl=lvid.split(",");

                      if ( resco1[1] !== void 0 )
                      {
                         if(kl[0]==238)
                                {

                                  amtcomma = amtcomma ;// population round off by keerthana
                                }
                        if(resco12[1] != undefined && kl[0]!=238)
                              {


                                  amtcomma = amtcomma+'.'+resco12[1];

                              }
                      }
                            subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+splityear[zx]).text(amtcomma);
                      }
                     //alert(moneyreadconversion(itemdetails[xy]['result'],inrreading[indexre]));
                    }
                  }
                }
                else
                {
                  //alert('i m here');
                  // alert(splityear);
                  for(zx=splityear[0];zx<=splityear[1];zx++)
                  {
                    itemdetails =itemdts[zx];
                    //alert(itemdetails);
                    var itemdetails = $.map(itemdetails, function(el) { return el });
                    // alert(itemdetails);
                    // console.log(itemdetails);
                    for(xy=0;xy<itemdetails.length;xy++)
                    {
                      var subtable = $(this).parent().next().find('#subtable');//$('#subtable');//robin
                      var maintbl = subtable.find('#'+myData);
                      // console.log(maintbl);
                      // console.log('busted');
                      // moneyreadconversion(itemdetails[xy]['result'],inrreading[indexre])
                      // indexre = 4;
                        if(indexre !=4)
                        {
                          valnew = itemdetails[xy]['result']
                          valnew = valnew.replace(/\,/g,'');
                          valnew = moneyreadconversion(valnew,inrreading[indexre]);
                          var resco12 = valnew.toString().split('.');
                          var resco1 =resco12[0].replace(/\,/g,'');
                          var amtcomma =moneyFormatIndia((resco1));
                          if ( resco1[1] !== void 0 )
                          {
                            if(resco12[1] != undefined)
                              {
                                  amtcomma = amtcomma+'.'+resco12[1];
                              }
                          }
                          subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+zx).text(amtcomma);
                        }
                        else
                        {
                            var resco12 = itemdetails[xy]['result'].toString().split('.');
                            var resco1 =resco12[0].replace(/\,/g,'');
                            var amtcomma =moneyFormatIndia((resco1));
                           kl=lvid.split(",");

                      if ( resco1[1] !== void 0 )
                      {
                         if(kl[0]==238)
                                {

                                  amtcomma = amtcomma ;// population round off by keerthana
                                }
                        if(resco12[1] != undefined && kl[0]!=238)
                              {


                                  amtcomma = amtcomma+'.'+resco12[1];

                              }
                      }                           subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+zx).text(amtcomma);
                        }
                    }
                  }
                }
                $(this).parent().next().find(".tot").each(function()
                {
                //$(".tot").each(function(){  //$(this).parent().next().find("#tot").each(function(){
                valuesarr = [];
                if(view == 1 || view == 3) //mixed and continues
                {
                  for(zx=0;zx<splityear.length;zx++)
                  {
                  val =  $(this).parent().find('#'+splityear[zx]).text();;//$(this).parent().find('#'+splityear[zx]).text();
                  var find = ',';
                  var re = new RegExp(find, 'g');
                  sumofval =val.replace(re, '');
                  if(isNaN(parseFloat(sumofval)))
                  {
                  sumofval =0;
                  }
                  valuesarr.push(parseFloat(sumofval));
                  }
                }
                else
                {
                  // for(j=splityear[0];j<=splityear[1];j++)
                  for(zx=splityear[0];zx<=splityear[1];zx++)
                  {
                  // console.log(zx);
                  val =  $(this).parent().find('#'+zx).text();//$(this).parent().find('#'+splityear[zx]).text();
                  var find = ',';
                  var re = new RegExp(find, 'g');
                  sumofval =val.replace(re, '');
                  if(isNaN(parseFloat(sumofval)))
                  {
                  sumofval =0;
                  }
                  valuesarr.push(parseFloat(sumofval));
                  }
                }
                if(view == 3)
                {
                  var count = valuesarr.reduce(function(n, val) {
                  return n + (val === 0);
                  }, 0);
                  if(valuesarr.length == 1)
                  {
                  var sum = 'NA';
                  }
                  else if(valuesarr.length == 0)
                  {
                  var sum = 'NA';
                  }
                  else if(count == 2)
                  {
                  var sum = 'NA';
                  }
                  else
                  {
                  var sum = findgrowth(valuesarr);
                  }
                // alert(valuesarr+" / / "+sum);
                }
                else
                {
                  var sum = valuesarr.reduce(addvl, 0);
                }
                // else
                // {
                if(view == 3)
                {
                  if(isFinite(sum) == false)
                  {
                  $(this).text("NA");
                  }
                  else if(isNaN(sum))
                  {
                  $(this).text("NA");
                  }
                  else
                  {
                  $(this).text(sum.toFixed(2)+" %");
                  }
                }
                else
                {
                  $(this).text(new Intl.NumberFormat('en-IN').format(sum));
                }
                // }
                });
                $('#subtable td:empty').append('NA');
              }
              else if(view ==0)
              {
                splityear = year.split(",");
                cummaltid = new Array();
                subtblsum = 0;
                if(splityear.length == 1)
                {
                  // alert(myData);
                   console.log('athu natha');
                   console.log(spitdata);
                  itemdts  =spitdata[splityear[0]][myData];//[myData];
                     console.log(itemdts);
                  var arrdata = $.map(itemdts, function(el) { return el });
                  objitems =  JSON.parse(itemobj);
                  // alert("Sfsd");
                  // alert(splityear);
                  for(zx=0;zx<splityear.length;zx++)
                  {
                    var itemdetails = $.map(itemdts, function(el) { return el });
                    // console.log(itemdetails);
                    for(xy=0;xy<itemdetails.length;xy++)
                    {
                      var subtable = $(this).parent().next().find('#subtable');//$('#subtable');//robin
                      // console.log(itemdetails[xy]['split_id']);
                      // alert(myData);
                      var maintbl = subtable.find('#'+myData);
                      //var test12 = String(itemdetails[xy]['result'])//.replace(",", "");
                      resco =  itemdetails[xy]['result'];
                      // alert($('#'+itemdetails[xy]['split_id']).length);
                      if(subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+splityear[zx]).length !=0 )
                      {
                      subto = resco;
                      subto = subto.replace(/\,/g,'');
                      subtblsum = subtblsum+Number(subto);
                      }
                      // subto = resco;
                      // subto = subto.replace(/\,/g,'');
                      // subtblsum = subtblsum+Number(subto);
                      var resco12 = resco.split('.');
                      var resco1 =resco12[0].replace(/\,/g,'');
                      if(indexre !=4)
                      {
                        converval =resco1+'.'+resco12[1];
                        converval = parseFloat(converval);
                        resco1 = moneyreadconversion(converval,inrreading[indexre]);
                         resco12 = resco1.split('.');
                         resco1 =resco12[0].replace(/\,/g,'');
                      }
                      var amtcomma =moneyFormatIndia((resco1));
                        kl=lvid.split(",");

                      if ( resco1[1] !== void 0 )
                      {
                         if(kl[0]==238)
                                {

                                  amtcomma = amtcomma ;// population round off by keerthana
                                }
                        if(resco12[1] != undefined && kl[0]!=238)
                              {


                                  amtcomma = amtcomma+'.'+resco12[1];

                              }
                      }
                      // alert(amtcomma);
                      // alert(itemdetails[xy]['result']);
                      // alert(tes);
                      // new Intl.NumberFormat('en-IN').format(sumoftot)
                      //cntbr
                      subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+splityear[zx]).text(amtcomma);
                      // subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+splityear[zx]).text(itemdetails[xy]['result']);
                    }
                  }
                   subtblsum = moneyreadconversion(subtblsum,inrreading[indexre]);
                }
                else
                {
                  // console.log(spitdata);
                  for(zx=splityear[0];zx<=splityear[1];zx++)
                  //for(zx=0;zx<splityear.length;zx++)
                  {
                  itemdts  =spitdata[myData][zx];//[myData];
                  // console.log(itemdts);
                  var itemdetails = $.map(itemdts, function(el) { return el });
                  for(xy=0;xy<itemdetails.length;xy++)
                  {
                    var subtable = $(this).parent().next().find('#subtable');//$('#subtable');//robin
                    if (typeof cummaltid[itemdetails[xy]['split_id']] == 'undefined')
                    {
                    cummaltid[itemdetails[xy]['split_id']] = 0.00;
                    }
                    var find = ',';
                    var re = new RegExp(find, 'g');
                    val =itemdetails[xy]['result'].replace(re, '');
                    cummaltid[itemdetails[xy]['split_id']] = cummaltid[itemdetails[xy]['split_id']] + parseFloat(val);
                  }
                  }
                      var subtable = $(this).parent().next().find('#subtable');
                for (key in cummaltid) {
                cummaltid[key]= cummaltid[key].toFixed(2)
                subtable.find('#'+key).next().text(new Intl.NumberFormat('en-IN').format( cummaltid[key]));
                }
                }
                // console.log(cummaltid);
                // subtablecntr = subtable.find('.cntbr');
                // alert(subtblsum);
                $(".cntbr").each(function()
                {
                  mathval = $(this).prev().text();
                  mathval =  mathval.replace(/\,/g,'');
                  mathval = Number(mathval);
                  // alert(mathval);
                  cntshare = ((mathval/subtblsum)*100).toFixed(2);
                  $(this).text(cntshare);
                  //alert($(this).prev().text());
                });
                $('#subtable td:empty').append('0.00');
              }
              else if(view == 5)
              {
                splityear = year.split(",");
                cummaltid = new Array();
                // for(zx=splityear[0];zx<=splityear[1];zx++)
                for(zx=0;zx<splityear.length;zx++)
                {
                itemdts  =spitdata[myData][splityear[zx]];//[myData];
                var itemdetails = $.map(itemdts, function(el) { return el });
                for(xy=0;xy<itemdetails.length;xy++)
                {
                var subtable = $(this).parent().next().find('#subtable');//$('#subtable');//robin
                if (typeof cummaltid[itemdetails[xy]['split_id']] == 'undefined')
                {
                cummaltid[itemdetails[xy]['split_id']] = 0.00;
                }
                var find = ',';
                var re = new RegExp(find, 'g');
                val =itemdetails[xy]['result'].replace(re, '');
                cummaltid[itemdetails[xy]['split_id']] = cummaltid[itemdetails[xy]['split_id']] + parseFloat(val);
                }
                }
                var subtable = $(this).parent().next().find('#subtable');
                for (key in cummaltid) {
                cummaltid[key]= cummaltid[key].toFixed(2)
                subtable.find('#'+key).next().text(new Intl.NumberFormat('en-IN').format( cummaltid[key]));
                }
                $('#subtable td:empty').append('0.00');
              }
              else
              {
                //view == 3 Growth
              }
              // }
              if(view == 0)
              {
                $(this).parent().next().find('#subtable').parent().DataTable( {
                scrollY: 100,
                "order": [[ 1, "desc" ]]
                } );
              }
              else
              {
                var lastindex = $(this).parent().next().find('#subtable td:last').index();//$(this).parent().next().find('#subtable').parent().index();
                $(this).parent().next().find('#subtable').parent().DataTable( {
                scrollY: 200,
                "order": [[ lastindex, "desc" ]]
                } );
              }
              tr.addClass('shown');
        }
  });
  $(document).ajaxStart(function(){
      $(".spinner-wrapper").css("display", "block");
  });
  $(document).ajaxComplete(function(){
      $(".spinner-wrapper").css("display", "none");
  });


  function combinesplit_res(circle,history,rev)
  {
    // alert("idiotssssss");
    groupby = sessionStorage.getItem('groupby');
    areavalue =[];
    window.parent.$('.reading-conv').val('4');
    try
    {
    map.data.setStyle({});//map.data.revertStyle();
    map.data.setStyle(function(feature) {
    return {
    strokeColor: '#000',
    strokeOpacity:1,
    strokeWeight: 2,
    fillColor: '#FFF',
    fillOpacity: 1
    };
    });
    }
    catch(err) {
    // document.getElementById("demo").innerHTML = err.message;
    }

    for(k=0; k<markerscharts.length; k++){
    markerscharts[k].setMap(null);
    }

    $('#chart').children().last().html('');
    $('#report').html('');
    resulttype =sessionStorage.getItem('resulttype');
    grid_path = sessionStorage.getItem('getpath');
    tableids = sessionStorage.getItem('tableids');
    //alert("jl");

    if(resulttype == 'C')
    {
      file11 = sessionStorage.getItem('maplevel');


      if(file11=="SVG/1---21---21.svg")
      {


      file1=file11.split("SVG/");
      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      locid=file3[0];
      parentlvl=file3[1];
      childlvl=file3[2];

      }
      else if(file11=="SVG/1---21---1.svg")
      {


      file1=file11.split("SVG/");
      file2=file1[1].split(".svg");
      file3=file2[0].split("---");
      locid =file3[0];
      parentlvl=file3[1];
      childlvl=file3[2];

      }


      else
      {
      file1=file11.split("SVG/");
      file11=file1[1].split("/");
      file2=file11[2].split(".svg");
      file3=file2[0].split("---");
      locid =file3[0];
      parentlvl=file3[1];
      childlvl=file3[2];
      }


    }
    else
    {
        file11 = sessionStorage.getItem('maplevel');
           // alert(file11);
        if(file11=="SVG/1---21---21.svg")
        {


        file1=file11.split("SVG/");
        file2=file1[1].split(".svg");
        file3=file2[0].split("---");
        locid=file3[0];
        parentlvl=file3[1];
        childlvl=file3[2];

        }
        else if(file11=="SVG/1---21---1.svg")
        {


        file1=file11.split("SVG/");
        file2=file1[1].split(".svg");
        file3=file2[0].split("---");
        locid =file3[0];
        parentlvl=file3[1];
        childlvl=file3[2];

        }


        else
        {
        file1=file11.split("SVG/");
        file11=file1[1].split("/");
        file2=file11[2].split(".svg");
        file3=file2[0].split("---");
        locid =file3[0];
        parentlvl=file3[1];
        childlvl=file3[2];
        }
        // file1 = file1.substring(0, file1.indexOf('.'));
        // file1 = file1.split('/');
        // mapids = file1[1].split('---');
        // parentlvl = mapids[1];
        // childlvl =mapids[2];
        // locid = mapids[0];

        //    typeval=$("input[name=type]:checked").val();
        // if(typeval=="circle")
        // {
        //  locid=  sessionStorage.getItem('idcp');
        // parentlvl = sessionStorage.getItem('pcp');
        // childlvl =sessionStorage.getItem('ccp');
        // }
        // else
        // {
        //following code has been hided by robin
        // locid=  sessionStorage.getItem('id');
        // parentlvl = sessionStorage.getItem('parentlvl');
        // childlvl =sessionStorage.getItem('childlvl');
    }
    year = sessionStorage.getItem('year');//'2015,2016';
    view = sessionStorage.getItem('view');//0;//0;
    combv = sessionStorage.getItem('split_combine_id');
    levelid = sessionStorage.getItem('lastname');
    // levelid = levelid.split(",");
    menu_ids = sessionStorage.getItem('tbl');
    menu_item_id = sessionStorage.getItem('categs');
    r3= $.ajax({
    type: "POST",
    url: grid_path,//"consum_report.php",
    async:false,
    data:{"year":year,"categs":menu_item_id,"chart":"chart","id":locid,parentlvl:parentlvl,childlvl:childlvl,"groupby":resulttype,"tbl":menu_ids,"mnid":'',"level":levelid,"view":view,"combv":combv,"tbldata":tableids},
    // async:false,
    success:function(data)
    {

    sessionStorage.setItem("loc_filter",'');
    sessionStorage.setItem("variable_fiter",'');
    sessionStorage.setItem("range_filter",'');
    sessionStorage.setItem('selectval','');
    clusterclear();

    // console.log("regacluster");
    console.log(data);

    // removealllayer();
    // sessionStorage.setItem("clickresult",dat[2]);
    map.data.revertStyle();
    if(data != 'data not available')
    {
      dat = JSON.parse(data);
      sessionStorage.setItem('getstate_data', JSON.stringify(dat[2]));
      sessionStorage.setItem('reading',dat[4]);
      // alert(resulttype);
      if(resulttype == 'S')
      {
         // console.log("kkkkkkkkkkkkk");
          console.log(dat[1]);
          pk=dat[1].replace("<script>","");

          pk=pk.replace("</\script>","");
          pk=pk.replace("series: { ,",  'legend: {  enabled: false}, series: { ,' );


          // pk= pk.replace(//\;
          console.log(pk);
          dat[1]="<script>"+" charts = "+pk+"</\script>";
          //console.log(dat[1]);

          // var res = dat[1].match(/series/);
          //  console.log("pppppppppp");
          //  console.log(res);
          //console.log($('.jstree-anchor jstree-clicked').val());
          if(view == 3)
          {//3148
          if(combv==2491 ) {


          locationshow(dat[7],parentlvl,childlvl);
          }
          else if(combv==3148)
          {
          locationshow(dat[4],parentlvl,childlvl);
          }

           else if(combv== 2642)
                   {
                     locationshow(dat[8],parentlvl,childlvl);
                   }
          else{
            map_split(dat[2],0,"",0);
          }
          }//

          else if(circle==1)
          {
          if(combv==2491 ) {

          locationshow(dat[7],parentlvl,childlvl);
          }
          else if(combv==3148)
          {
          locationshow(dat[4],parentlvl,childlvl);
          }
           else if(combv== 2642)
                   {
                     locationshow(dat[8],parentlvl,childlvl);
                   }

          else{
          map_split(dat[2],1,"",0);
          datatable_split(dat[0]);
          higcharts_split(dat[1],dat[2]);
          }
          }//

          else
          {


          locationid=locid;
          svgname = locationid+'---'+parentlvl+'---'+childlvl;
          if(combv==2491 ) {

          locationshow(dat[7],parentlvl,childlvl);
          }
          else if(combv==3148)
          {
          locationshow(dat[4],parentlvl,childlvl);
          }
           else if(combv== 2642)
                   {
                     locationshow(dat[8],parentlvl,childlvl);
                   }
          else{
          map_split(dat[2],0,"",0);
          }

          svgexecution_st_combine(svgname,dat[2],'onclick',history);


          }//
          // alert(svgname);
          datatable_split(dat[0]);
          higcharts_split(dat[1],dat[2]);
      }

      else
      {
             console.log("combine",dat);
            if(combv==2491 || combv==3148)
            {

                locationid=locid;
                svgname = locationid+'---'+parentlvl+'---'+childlvl;
                svgexecution_st_combine(svgname,dat[2],'cluster',history);
                // initlayer(map,nextlevelfile,0,0,'');
                // initlayer(map,initfile,0,0,'');

                 if(combv==2491 ) {

                locationshow(dat[7],parentlvl,childlvl);
                }
                else if(combv==3148)
                {
                locationshow(dat[4],parentlvl,childlvl);
                }
                else if(combv==2642)
                {
                 locationshow(dat[8],parentlvl,childlvl); 
                }
                //locationshow(dat[4],parentlvl,childlvl);

            }
            else
            {

              // locationid=(locid==73) ? 14878 :locid;
              locationid=locid;
              svgname = locationid+'---'+parentlvl+'---'+childlvl;


              svgexecution_st_combine(svgname,dat[2],'onclick',history);
            }
            // alert(svgname);
            // datatable_split(dat[0]);
            // higcharts_split(dat[1],dat[2]);
          datatable_combine(dat[0]);
          console.log("map_content for chart");
          console.log(dat[2]);


          higcharts_combine(dat[1],dat[2]);

      }
      }
     // alert(resulttype);
    //   if(resulttype == 'S') // split
    //       {

    //           console.log($('.jstree-anchor jstree-clicked').val());
    //                  //alert(combv);
    //           if(view == 3)// growth
    //           {
    //             if(combv==2491){

    //             locationshow(dat[7],parentlvl,childlvl);
    //             }
    //             else if(combv==3148)
    //             {
    //                 locationshow(dat[4],parentlvl,childlvl);
    //             }

    //              else
    //             {
    //             map_split(dat[2],"","");
    //             }
    //           }
    //           else if(circle==1)// circle
    //           {
    //             if(combv==2491)
    //             {

    //             locationshow(dat[7],parentlvl,childlvl);

    //             }
    //              else if(combv==3148)
    //             {
    //                 locationshow(dat[4],parentlvl,childlvl);
    //             }
    //             else
    //             {
    //             map_split(dat[2],1,"");
    //             datatable_split(dat[0]);
    //             higcharts_split(dat[1],dat[2]);
    //           }
    //           }
    //           else // normal split
    //           {
    //             //alert("keerthana");

    //             //console.log("lllll");
    //             if(combv==2491)
    //             {

    //             locationshow(dat[7],parentlvl,childlvl);
    //             }
    //              else if(combv==3148)
    //             {
    //                 locationshow(dat[4],parentlvl,childlvl);
    //             }
    //             else
    //             {

    //             // locationid=(locid==73) ? 14878 :locid;
    //             locationid=locid;
    //            // svgname = locationid+'---'+parentlvl+'---'+childlvl;
    //             //console.log(dat);
    //            // alert(file);
    //             svgexecution_st(svgname,dat[2]);
    //             }

    //             datatable_split(dat[0]);
    //             higcharts_split(dat[1],dat[2]);
    //           }
    //       }
    //   else
    //   {
    //     // $("#report").html(dat[0])
    //     // sessionStorage.setItem('mapdata',mapsjson);
    //     svgname = locid+'---'+parentlvl+'---'+childlvl;


    //     svgexecution_st_combine(svgname,dat[2],'onclick',history);
    //     datatable_combine(dat[0]);
    //     higcharts_combine(dat[1],dat[2]);
    //   }
    // }
    else
    {
      $(".spinner-wrapper").hide();
      $('#charts').html();
      $('#report').html();
      alert(data);
      locationid=locid;
      svgname = locationid+'---'+parentlvl+'---'+childlvl;
      svgexecution_st_combine(svgname,dat[2],'cluster',history);
      // alert(data);
      // initlayer(map,nextlevelfile,0,0,'');
    }
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    // $(".loading").hide();
    try
    {
    ms.data.revertStyle();
    }
    catch(err) {
    // document.getElementById("demo").innerHTML = err.message;
    }
    alert('data not available');
    // alert("Status: " + textStatus); alert("Error: " + errorThrown);
    }
    });
    $.when(r3).done(function(){


    setTimeout(function(){  $('.spinner-wrapper').hide(); }, 500);


    });




  }
function clusterclear()
{
    if(!isEmpty(namebuild))
            {

                delete myLatLng;
                delete markerm;
                fldarr=new Array();fldidarr=new Array();fldarrfinal=new Array();
              fldarrfinal=[];fldname=[];markcluster=[]; var imagearr=new Array(); strj='';
                for(i=0;i<namebuild.length;i++)
                {
                   if(!isEmpty(namebuild[i])) {


                     namebuild[i].clearMarkers();


                   }

                }

            }
}
  //Locationmap
  function unique(list) {
      var result = [];
      $.each(list, function(i, e) {
          if ($.inArray(e, result) == -1) result.push(e);
      });
      return result;
  }
//Cluster Function by Regagandhi
// function locationshow(jsonarr,parent,child)
// {
// 	// alert('sd');
//  if(!isEmpty(namebuild))
//   {

//       delete myLatLng;
//       delete markerm;
//       fldarr=new Array();fldidarr=new Array();fldarrfinal=new Array();
//     fldarrfinal=[];fldname=[];markcluster=[]; var imagearr=new Array(); strj='';
//       for(i=0;i<namebuild.length;i++)
//       {
//          if(!isEmpty(namebuild[i])) {


//            namebuild[i].clearMarkers();


//          }

//       }

//   }
//   console.log(jsonarr);
//   arrformat=JSON.parse(jsonarr);
//   markcluster=[]; var imagearr=new Array(); strj='';
//   for(i=0;i<arrformat.length;i++)
//   {
//      lati=parseFloat(arrformat[i]['lat']); loni=parseFloat(arrformat[i]['lon']); addr=arrformat[i]['address']; ccp=arrformat[i]['title'];
//      fld=arrformat[i]['fld'];name=arrformat[i]['name']
//        if(fldarr.indexOf(fld) == -1)
//        {
//            fldarr.push(fld);
//            fldidarr[fld]=fldarr.length-1;
//            fldarrfinal[fldarr.length-1]=new Array();
//            fldname[fldarr.length-1]=name;
//            imagearr[fldarr.length-1]=arrformat[i]['image_name'];


//        }


//       img= defaulturl+'/Icons/'+arrformat[i]['image_name'];
//       googleimg= defaulturl+'/Icons/iconloc.png';
//       iconi=(img == '') ? googleimg : img;
//       var image = {
//                                 url: iconi,
//                                 scaledSize: new google.maps.Size(20, 20), // scaled size
//                                 origin: new google.maps.Point(0,0), // origin
//                                 anchor: new google.maps.Point(0, 0)
//                                 // This marker is 20 pixels wide by 32 pixels high.
//                                // size: new google.maps.Size(30, 30),
//                  };

//       myLatLng = {lat: lati, lng: loni};
//       markerm = new google.maps.Marker({
//       position:myLatLng,
//       map: map,
//       icon:image,
//       address: "<i><img src='"+defaulturl+"Icons/m"+parseInt(fldidarr[fld]+1)+"53x53.png' style='height:15px;width:15px'></img></i><b>&nbsp;"+ccp+"</b><br>"+addr
//     });
//     fldarrfinal[fldidarr[fld]].push(markerm);
//     google.maps.event.addListener(markerm, 'click', function() {
//                   infowindowm.setContent(this.address);
//                   infowindowm.open(map, this);
//               });


//   }
//   if(parseInt(parent) != 15)
//   {
//      incrcluster=1;
//     for(i=0;i<fldarrfinal.length;i++) {
//         incrclusterst ='';
//         incrclusterst =incrcluster;
//         mcOptions = {gridSize: 50, maxZoom: 15,
//         styles: [{
//         height: 53,
//         url: defaulturl+"Icons/m"+incrclusterst+"53x53.png",
//         width: 53
//         },
//         {
//         height: 56,
//         url: defaulturl+"Icons/m"+incrclusterst+"56x56.png",
//         width: 56
//         },
//         {
//         height: 66,
//         url: defaulturl+"Icons/m"+incrclusterst+"66x66.png",
//         width: 66
//         },
//         {
//         height: 78,
//         url: defaulturl+"Icons/m"+incrclusterst+"78x78.png",
//         width: 78
//         },
//         {
//         height: 90,
//         url: defaulturl+"Icons/m"+incrclusterst+"90x90.png",
//         width: 90
//         }]
//       }

//         //init clusterer with your options
//         namebuild[incrcluster] = new MarkerClusterer(map, fldarrfinal[i], mcOptions);
//          // minClusterZoom = 14;
//          // namebuild[incrcluster].setMaxZoom(minClusterZoom);
//          // google.maps.event.addListener(namebuild[incrcluster], 'clusterclick', function(cluster) {
//          // map.fitBounds(cluster.getBounds());
//          // if( map.getZoom() > minClusterZoom+1 )
//          //        map.setZoom(minClusterZoom+1);
//          // });

//          incrcluster= incrcluster+1;
//      }
//   }
//   for(i=0;i<fldname.length;i++)
//   {
//        j=i+1;
//       //  if(parseInt(parent) != 15)
//       // {

//               strj += '<p><u><i><img src="'+defaulturl+'Icons/m'+j+'53x53.png" style="height:15px;width:15px"></img></i></u> &nbsp;&nbsp;'+ fldname[i]+'</p>';
//        // }
//        // else
//        // {
//        //      strj += '<p><u><i><img src="http://192.168.10.82/biapp/web/sales/Icons/'+imagearr[i]+'" style="height:15px;width:15px"></img></i></u> &nbsp;&nbsp;'+ fldname[i]+'</p>';
//        // }
//    }
//  $("#legendcluster").html(strj);
//  $("#legendcluster").show();
// }
function locationshow(jsonarr,parent,child)
{
		 if(!isEmpty(namebuild))
		  {

		      delete myLatLng;
		      delete markerm;
		      fldarr=new Array();fldidarr=new Array();fldarrfinal=new Array();
		      fldarrfinal=[];fldname=[];markcluster=[]; var imagearr=new Array(); strj='';
		      for(i=0;i<namebuild.length;i++)
		      {
		         if(!isEmpty(namebuild[i])) {


		           namebuild[i].clearMarkers();


		         }

		      }
		      $.each(fldarrfinal,function(k,v){
		            v.clearMarkers();
		      });

		  }


			  console.log(jsonarr);
			  console.log(typeof(jsonarr));
			  if(typeof(jsonarr)=='object')
			  {
			    arrformat=jsonarr;
			  }
			  else
			  {
			   
			  arrformat=JSON.parse(jsonarr); 
			  }

		  markcluster=[]; var imagearr=new Array(); strj='';
		  for(i=0;i<arrformat.length;i++)
		  {
		     lati=parseFloat(arrformat[i]['lat']); loni=parseFloat(arrformat[i]['lon']); addr=arrformat[i]['address']; ccp=arrformat[i]['title'];
		     fld=arrformat[i]['fld'];name=arrformat[i]['name']
		       if(fldarr.indexOf(fld) == -1)
		       {
		           fldarr.push(fld);
		           fldidarr[fld]=fldarr.length-1;
		           fldarrfinal[fldarr.length-1]=new Array();
		           fldname[fldarr.length-1]=name;
		           imagearr[fldarr.length-1]=arrformat[i]['image_name'];


		       }


		      img= defaulturl+'/Icons/'+arrformat[i]['image_name'];
		      googleimg= defaulturl+'/Icons/iconloc.png';
		      iconi=(img == '') ? googleimg : img;
		      var image = {
		                                url: iconi,
		                                scaledSize: new google.maps.Size(30, 30), // scaled size
		                                origin: new google.maps.Point(0,0), // origin
		                                anchor: new google.maps.Point(0, 0)
		                                // This marker is 20 pixels wide by 32 pixels high.
		                               // size: new google.maps.Size(30, 30),
		                 };

		      myLatLng = {lat: lati, lng: loni};
		      markerm = new google.maps.Marker({
		      position:myLatLng,
		      map: map,
		      icon:image,
		      address: "<i><img src='"+defaulturl+"Icons/m"+parseInt(fldidarr[fld]+1)+"53x53.png' style='height:15px;width:15px'></img></i><b>&nbsp;"+ccp+"</b><br>"+addr
		    });
		    fldarrfinal[fldidarr[fld]].push(markerm);
		    google.maps.event.addListener(markerm, 'click', function() {
		                  infowindowm.setContent(this.address);
		                  infowindowm.open(map, this);
		              });


		  }
		  if(parseInt(parent) != 15)
		  {
		     incrcluster=1;
		    for(i=0;i<fldarrfinal.length;i++) {
		        incrclusterst ='';
		        incrclusterst =incrcluster;
		        mcOptions = {gridSize: 50, maxZoom: 15,
		        styles: [{
		        height: 26,
		        url: defaulturl+"Icons/m"+incrclusterst+"53x53.png",
		        width: 26
		        },
		        {
		        height: 36,
		        url: defaulturl+"Icons/m"+incrclusterst+"56x56.png",
		        width: 36
		        },
		        {
		        height: 46,
		        url: defaulturl+"Icons/m"+incrclusterst+"66x66.png",
		        width: 46
		        },
		        {
		        height: 56,
		        url: defaulturl+"Icons/m"+incrclusterst+"78x78.png",
		        width: 56
		        },
		        {
		        height: 66,
		        url: defaulturl+"Icons/m"+incrclusterst+"90x90.png",
		        width: 66
		        }]
		      }

		        //init clusterer with your options
		        namebuild[incrcluster] = new MarkerClusterer(map, fldarrfinal[i], mcOptions);
		         // minClusterZoom = 14;
		         // namebuild[incrcluster].setMaxZoom(minClusterZoom);
		         // google.maps.event.addListener(namebuild[incrcluster], 'clusterclick', function(cluster) {
		         // map.fitBounds(cluster.getBounds());
		         // if( map.getZoom() > minClusterZoom+1 )
		         //        map.setZoom(minClusterZoom+1);
		         // });

		         incrcluster= incrcluster+1;
		     }
		  }
		  for(i=0;i<fldname.length;i++)
		  {
		       j=i+1;
		      //  if(parseInt(parent) != 15)
		      // {
		      console.log();


		              strj += '<p><u><i><img src="'+defaulturl+'Icons/m'+j+'53x53.png" style="height:15px;width:15px"></img></i></u> &nbsp;&nbsp;'+ fldname[i]+'</p>';
		       // }
		       // else
		       // {
		       //      strj += '<p><u><i><img src="http://192.168.10.82/biapp/web/sales/Icons/'+imagearr[i]+'" style="height:15px;width:15px"></img></i></u> &nbsp;&nbsp;'+ fldname[i]+'</p>';
		       // }
		   }
		 $("#legendcluster").html(strj);
		 $("#legendcluster").show();
}

// function uncovered_outlets(jsonarr)
// {
	
// 	arrformat=jsonarr;
// 	for(i=0;i<arrformat.length;i++)
// 	{


// 	lati=parseFloat(arrformat[i]['lat']); 
// 	loni=parseFloat(arrformat[i]['lon']);
// 	lati=parseFloat(arrformat[i]['lat']); 
// 	loni=parseFloat(arrformat[i]['lon']);
// 	var  locations = ["{lat:"+ lati +",lng:" loni+"}"];

//   console.log(locations);

// 	}


// 	// var markers = locations.map(function(location, i) {
// 	// return new google.maps.Marker({
// 	// position: location,
// 	// label: "abc"
// 	// });
// 	// });

// 	// // Add a marker clusterer to manage the markers.


// 	// var markerCluster = new MarkerClusterer(map, markers,
// 	// {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});  
// }


// Cluster function End

  window.parent.$('.reading-conv').click(function (e) {
    // alert(tablebck);
    // e.preventDefa
    e.preventDefault();
    var inrreading  = {1:"Cr", 2:"lac", 3:"k",4:"Nos."};
    var indexre = parseInt($(this).attr("data-value"));//parseInt($(this).val());
    yearchk = sessionStorage.getItem('year');
    view = sessionStorage.getItem('view');
    // alert(view);
    yeararr1 =yearchk.split(",");
    yeararr = [];
     //view == 2 =>
     if(view == 2)
     {
         for(i=yeararr1[0];i<=yeararr1[1];i++)
         {
            yeararr.push(i);
         }
     }
     else if (view ==1)
     {
          yeararr = yeararr1;
     }
     else
     {
          yeararr = yeararr1;
     }
    convertype = sessionStorage.getItem('conversiontype');
    sourcedata  = jquerydatatable.rows().nodes();
    locidss = new Array();
    locvalue = [];
    trdataContent = new Array();
    $(sourcedata).map(function(i, cell) {
    trdataContent[$(cell).attr('id')] = $(cell);
    locidss.push($(cell).attr('id'));
    locvalue[$(cell).attr('id')] = trdataContent[$(cell).attr('id')].find('td:first-child').text();
    });
    // console.log('dum');
    // console.log(trdataContent);
    var graphdata = [];
    // alert(view);
    // alert(comb);
    labfin =  getmenulbl();
    reading = sessionStorage.getItem('reading');
    // if(reading == 'Nos')
    // {
    //     reading= '';
    // }
    comb =sessionStorage.getItem('groupby');
    // alert(comb);
    if(comb == 'C')
    {
      if(view == 0 || view == 5 || view == 3) //cummaltive 3->growth,5-cummaltive mixed,0->cummaltive continue and single
       {
            // console.log(tablebck);
            // console.log('B');
            for(var i =0;i<locidss.length;i++)
            {
                num  = trdataContent[locidss[i]].find('.resultfield').text();
                num = parseFloat(num.replace(/\,/g,''));
                if(yeararr.length > 1)//checking continues cummaltive
                {
                    num = parseInt(tablebck[locidss[i]][parseInt(yeararr[0])]['result']);
                }
                else
                {
                  num = parseInt(tablebck[locidss[i]][yearchk]['result']);
                }
                if(indexre != 4){
                  // alert(num);
                    newval = moneyreadconversion(num,inrreading[indexre]);
                }
                else
                {
                  if(yeararr.length > 1)//checking continues cummaltive
                  {
                     newval = tablebck[locidss[i]][parseInt(yeararr[0])]['result'];//moneyreadconversion(num,inrreading[indexre]);
                  }
                  else
                  {
                     newval = tablebck[locidss[i]][yearchk]['result'];//moneyreadconversion(num,inrreading[indexre]);
                     // alert(newval);
                  }
                }
                if(view != 3)
                {
                  // alert(newval);
                  var resco12 = newval.split('.');
                  // alert(resco12);
                  if(resco12.length > 1){
                  var resco1 =resco12[0].replace(/\,/g,'');
                  }
                  else
                  {
                     var resco1 =newval.replace(/\,/g,'');
                  }
                  // alert(resco1);
                  if(resco1.length == 1)
                  {
                     var amtcomma = newval;
                  }
                  else
                  {
                     // else
                      //{
                        var amtcomma =moneyFormatIndia(resco1);
                      //}
                  }
                  if ( resco1[1] !== void 0 )
                  {
                    if(resco12[1] != undefined)
                    {
                      amtcomma = amtcomma+'.'+resco12[1];
                    }
                  }
                }
                else
                {
                  amtcomma = newval;
                }
                //labfin+':'+amtcomma+' '+reading;
                // if()
                areavalue[locidss[i]]  = labfin+':'+amtcomma+' '+inrreading[indexre]+' '+reading;//amtcomma;//set map value array
                trdataContent[locidss[i]].find('.resultfield').text(amtcomma);
                if(view  != 3)
                {
                  graphdata[locidss[i]] = Number(newval);
                }
            }
            // the array to be sorted
            var list =graphdata;// [0, 2, 1, 3];
            // temporary array holds objects with position and sort-value
            var mapped = list.map(function(el, i) {
                return { index: i, value: el };
            })
            // sorting the mapped array containing the reduced values
            mapped.sort(function(a, b) {
                return b.value - a.value;
            });
            // container for the resulting order
            var result = mapped.map(function(el){
                return list[el.index];
            });
            // console.log(result);
            // console.log(mapped);
            if(view == 0 || view == 5 )
            {
                jsonObj1 = []
                jsonc=[];
                $.each( mapped, function( key, value )
                {
                  // alert(mapped[key]);
                  if(mapped[key] != undefined)
                  {
                    item ={};
                    item [0] = locvalue[mapped[key]['index']];
                    item ["y"] = mapped[key]['value'];
                    item ["mydata"] = mapped[key]['index'];
                    jsonObj1.push(item);
                    jsonc.push(locvalue[mapped[key]['index']]);
                  //console.log(mapped[key]);
                  }
                });
                typechart = 'column';
                jsonObj = {};
                jsonObj["showInLegend"]="false";
                jsonObj["name"] = "";
                jsonObj["data"] = jsonObj1;
               // $b=array("showInLegend"=> "false",  "name"=>$v,"data"=>$a);
                 title2 = 'values';
                relevel = 1;
                try{
                var seriesLength = charts.series.length;
                }
                catch(e){
                  // console.log(Highcharts.charts);
                  charts = chartsingle;
                var seriesLength = charts.series.length;
                }
                //alert(seriesLength);
                for(var i = seriesLength -1; i > -1; i--) {
                    charts.series[i].remove();
                }
                  charts.addSeries({
                  type: 'column',
                  data: jsonObj1
                  });
                  // charnewhead = chartshead;
                  // charnewhead = charnewhead+" "+inrreading[indexre];
                  // charts.setTitle({text: charnewhead});
                  // charts.yAxis[0].axisTitle.attr({
                  // text: charnewhead
                  // });
                  // charts.setTitle({text: labfin+' '+inrreading[indexre]+' '+reading });
                  // charts.yAxis[0].axisTitle.attr({
                  // text: labfin+' '+reading
                  // });
                  charnewhead = '';
            }
            sessionStorage.setItem('conversiontype',inrreading[indexre]);
       }
       else  if(view == 2 || view == 1)
       {
            // console.log('A');
            // console.log(tablebck);
            tablebck1 = JSON.parse(tablebck);
            getorgchart = sessionStorage.getItem('chartseries12');
            getorgchart = JSON.parse(getorgchart);
            var graphdata = [];
             jsonObj1 = [];
                jsonc=[];
            for(var i =0;i<locidss.length;i++)
            {
                      totsum = 0;
                      var k =0;
                       graphdata[locidss[i]] = [];
                      trdataContent[locidss[i]].find('.resultfield').each(function()
                      {
                        // alert('i am in');
                        num = $(this).text();
                        num = parseFloat(num.replace(/\,/g,''));
                        num = tablebck1[locidss[i]][yeararr[k]]['result'];
                        if(indexre != 4){
                        newval = moneyreadconversion(num,inrreading[indexre]);
                        }
                        else
                        {
                           newval = tablebck1[locidss[i]][yeararr[k]]['result'];//moneyreadconversion(num,inrreading[indexre]);
                        }
                          // alert(newval);
                          graphdata[locidss[i]][yeararr[k]] = newval;
                          totsum = totsum+parseFloat(newval);
                          k++;
                          var resco12 = newval.toString().split('.');
                          var resco1 =resco12[0].replace(/\,/g,'');
                          var amtcomma =moneyFormatIndia((resco1));
                          if ( resco1[1] !== void 0 )
                          {
                          amtcomma = amtcomma+'.'+resco12[1];
                          }
                          $(this).text(amtcomma);
                      });
                        totsum = totsum.toFixed(2);
                        var resco12 = totsum.toString().split('.');
                        var resco1 =resco12[0].replace(/\,/g,'');
                        var amtcomma =moneyFormatIndia((resco1));
                        if ( resco1[1] !== void 0 )
                        {
                        amtcomma = amtcomma+'.'+resco12[1];
                        }
                        trdataContent[locidss[i]].find('.totalsum').text(amtcomma);
                        if(inrreading[indexre] != 4){
                        areavalue[locidss[i]]  = amtcomma+' '+inrreading[indexre]+' '+reading;
                        }
                        else
                        {
                          areavalue[locidss[i]]  = amtcomma+' '+reading;
                        }
            }
            // console.log(graphdata);
            // console.log(charts.series[0].data[0].y); //charts.series[0].userOptions.mydata
             var list =graphdata;// [0, 2, 1, 3];
            // temporary array holds objects with position and sort-value
            var mapped = list.map(function(el, i) {
                return { index: i, value: el };
            })
            // sorting the mapped array containing the reduced values
            mapped.sort(function(a, b) {
                return b.value - a.value;
            });
            // container for the resulting order
            var result = mapped.map(function(el){
                return list[el.index];
            });
            // console.log(result);
            // console.log(mapped);
              $.each( mapped, function( key, value )
                {
                  // alert(mapped[key]);
                  if(mapped[key] != undefined)
                  {
                    resetArr = mapped[key]['value'].filter(function(){return true;});
                    resetArr = resetArr.map(Number);
                    item ={};
                    item ["name"] = locvalue[mapped[key]['index']];
                    item ["data"] =resetArr; //mapped[key]['value'];
                    item ["mydata"] = mapped[key]['index'];
                    jsonObj1.push(item);
                    jsonc.push(locvalue[mapped[key]['index']]);
                  //console.log(mapped[key]);
                  }
                });
              // yeararr= yearchk.split(',');
              // console.log(yeararr);
              typechart = 'line';
              title2 = 'values';
              relevel = 1;
                if(inrreading[indexre] != 4){
                  finaltitle = labfin+' '+inrreading[indexre]+' '+reading;
                }
                else
                {
                  finaltitle = labfin+' '+reading;
                }
              //finaltitle = labfin+' '+reading;
              chart_conversion_combine(typechart,title2,yeararr,jsonObj1,relevel);
               // charts.setTitle({text:finaltitle});
               //    charts.yAxis[0].axisTitle.attr({
               //    text: finaltitle
               //    });
              sessionStorage.setItem('conversiontype',inrreading[indexre]);
       }
    }
    else
    {
        splitdata = JSON.parse(splitarray);
        tablebckspl = JSON.parse(tablebck);
        // console.log(tablebckspl);
        // console.log(locidss);
        if(view == 0 || view == 5 ) //|| view == 3
        {
              //yeararr =yearchk.split(",");
              var graphdata = [];
              for(var i =0;i<locidss.length;i++)
              {
              num  = trdataContent[locidss[i]].find('.resultfield').text();
              num = parseFloat(num.replace(/\,/g,''));
              if(yeararr.length > 1)//checking continues cummaltive
              {
               num = parseInt(tablebckspl[locidss[i]][parseInt(yeararr[0])]['result']);
              }
              else
              {
               num = parseInt(tablebckspl[locidss[i]]);
              }
              // alert(indexre);
              if(indexre != 4){
                newval = moneyreadconversion(num,inrreading[indexre]);
              }
              else
              {
                if(yeararr.length > 1)//checking continues cummaltive
                {
                  newval = tablebckspl[locidss[i]][parseInt(yeararr[0])]['result'];//
                }
                else
                {
                  newval = tablebckspl[locidss[i]];//moneyreadconversion(num,inrreading[indexre]);
                }
              }
               // alert(newval);
                  var resco12 = newval.toString().split('.');
                  var resco1 =resco12[0].replace(/\,/g,'');
                  // alert(resco1);
                  var amtcomma =moneyFormatIndia((resco1));
                  if ( resco1[1] !== void 0 )
                  {
                    if(resco12[1] != undefined)
                    {
                      amtcomma = amtcomma+'.'+resco12[1];
                    }
                    // else
                  }
                  newval = amtcomma;
              trdataContent[locidss[i]].find('.resultfield').text(newval);
              }
              chartarraysrce = sessionStorage.getItem('chartseries12');
              chartarraysrce = JSON.parse(chartarraysrce);
              jsonc = charts.xAxis[0].categories;
              mapcnt =0;
              for(var k=0;k<(chartarraysrce).length;k++)
              {
              round =0;ite=0;
              split_id = parseInt(chartarraysrce[k]['split_id']);
              for(var l=0;l<(chartarraysrce[k]['data']).length;l++)
              {
              num = chartarraysrce[k]['data'][l]['y'];
              newval = moneyreadconversion(num,inrreading[indexre]);
              chartarraysrce[k]['data'][l]['y'] = parseFloat(newval);
              }
              }
              typechart = 'column';
              title2 = 'values';
              relevel = 1;
              if(jsonc.length > 5)//if(colors.length > 5)
              {
              minmax=" min : 1,max : 10,";
              }
              else
              {
              minmax="";
              }
              if(view !=3)
              {
                charttit = '';
                // alert(reading);
                if(reading !=undefined)
                {
                    charttit = labfin+' '+inrreading[indexre]+' '+reading;
                }
                else
                {
                  charttit = labfin+' '+inrreading[indexre];
                }
                chart_conversion_split(typechart,title2,jsonc,chartarraysrce,relevel,minmax);
                 // charts.setTitle({text: charttit });
                 //  charts.yAxis[0].axisTitle.attr({
                 //  text: charttit
                 //  });
                map_conversion_split(inrreading,indexre);
              }
        }
        else if(view == 2 || view == 1 || view == 3)//continues and mixed
        {
            // alert('imhere');
            for(var i =0;i<locidss.length;i++)
            {
              k=0;
              totsum = 0;
              trdataContent[locidss[i]].find('.resultfield').each(function() {
                num = tablebckspl[locidss[i]][yeararr[k]];
                // alert(locidss[i]+" // "+yeararr[k]);
                if(indexre != 4){
                        newval = moneyreadconversion(num,inrreading[indexre]);
                        }
                        else
                        {
                           newval = tablebckspl[locidss[i]][yeararr[k]];
                        }
                         graphdata[locidss[i]] = [];
                         graphdata[locidss[i]][yeararr[k]] = newval;
                         if(view !=3)
                         {
                           totsum = totsum+parseFloat(newval);
                         }
                            var resco12 = newval.toString().split('.');
                            var resco1 =resco12[0].replace(/\,/g,'');
                            // alert(resco1);
                            var amtcomma =moneyFormatIndia((resco1));
                            if ( resco1[1] !== void 0 )
                            {
                              if(resco12[1] != undefined)
                              {
                              amtcomma = amtcomma+'.'+resco12[1];
                              }
                            }
                            $(this).text(amtcomma);
                k++;
              });
              if(view !=3)
              {
                totsum = totsum.toFixed(2);
                  var resco12 = totsum.toString().split('.');
                  var resco1 =resco12[0].replace(/\,/g,'');
                  // alert(resco1);
                  var amtcomma =moneyFormatIndia((resco1));
                  if ( resco1[1] !== void 0 )
                  {
                     if(resco12[1] != undefined)
                    {
                      amtcomma = amtcomma+'.'+resco12[1];
                    }
                  }
                trdataContent[locidss[i]].find('.totalsum').text(amtcomma);
              }
            }
            if(view !=3)
            {
              chartseris = sessionStorage.getItem('chartseries12');
              chartseris = JSON.parse(chartseris);
              // console.log(chartseris);
              for(var k=0;k<chartseris.length;k++)
              {
                for(var j=0;j<(chartseris[k]['data']).length;j++)
                {
                    num = chartseris[k]['data'][j];
                    // console.log(num);
                    newval = moneyreadconversion(num,inrreading[indexre]);
                      // console.log(newval);
                    chartseris[k]['data'][j] = parseFloat(newval);
                }
              }
                map_conversion_split(inrreading,indexre);
                var seriesLength = charts.series.length;
                //alert(seriesLength);
                 if(indexre != 4){
                  finaltitle = labfin+' '+inrreading[indexre]+' '+reading;
                }
                else
                {
                  finaltitle = labfin+' '+reading;
                }
                // charts.setTitle({text: finaltitle});
                // charts.yAxis[0].axisTitle.attr({
                // text: finaltitle
                // });
                for(var i = seriesLength -1; i > -1; i--) {
                    charts.series[i].remove();
                }
                for(var k=0;k<chartseris.length;k++){
                  charts.addSeries(chartseris[k], false);
                 }
                 charts.redraw();
             }
        }
    }
    //trdataContent[locationids[lc]].find('td:nth-child('+indextbl+')').text(new Intl.NumberFormat('en-IN').format(gridtot[indx]));
     // console.log(trdataContent);
 });
  function map_conversion_split(inrreading,indexre)
  {
                testarr = sessionStorage.getItem('getstate_data');
                testarr = JSON.parse(testarr);
                for (i = 0; i < piechartmarker.length; i++)
                {
                //alert(i);
                  map.removeLayer(piechartmarker[i]);
                }
                viewing=sessionStorage.getItem('view');
                var total =new Array();
                var total1 =new Array();
                var lastval=new Array();
                var sum1;
                var dataf;
                var data22;
                var center=0;
                if( viewing != 3)
                {
                // alert('ds');
                $.each(testarr, function(i, item)
                {
                  total[i]=0;
                  round=0;
                  // alert(testarr[i]);
                  $.each(testarr[i], function(j, item)
                  {
                  var value1=testarr[i][j].value;
                  if(round<10){
                  total[i] = parseInt(total[i])+parseInt(testarr[i][j].value);// sum of state
                  }
                  });
                });
                sum1 = total.reduce(add, 0);// sum of all state
                sum1=parseInt(sum1);
                function add(a, b) {
                return a + b;
                }
                sum1 = moneyreadconversion(sum1,inrreading[indexre])
                // console.log(sum1);
                    markerclsarr =[];
                  var accident_LatLng ='';
                reading = sessionStorage.getItem('reading')
                if(reading == 'Nos.')
                {
                  reading = '';
                }
                $.each(testarr, function(i, item)
                {
                   valuesar = [];
                    colorsar=[];
                data1=new Array();str="";sum=0;ite=0;data2=new Array(); round=0;data22="[";
                str='<div class="info legend1">';
                $.each(testarr[i], function(j, item)
                {
                   // alert(i+" // "+j);
                  var name =testarr[i][j].name;
                  var value=testarr[i][j].value;
                  valuesar.push(value);
                  value = moneyreadconversion(value,inrreading[indexre]);
                  if(round<10){
                      var resco12 = value.toString().split('.');
                  var resco1 =resco12[0].replace(/\,/g,'');
                  var amtcomma =moneyFormatIndia((resco1));
                  if ( resco1[1] !== void 0 )
                  {
                    amtcomma = amtcomma+'.'+resco12[1];
                  }
                  if(indexre !=4)
                  {
                    amtcomma = amtcomma+' '+inrreading[indexre]+' '+reading;
                  }
                  else
                  {
                     amtcomma = amtcomma+' '+inrreading[indexre];
                  }
                  center=testarr[i][j].center.split(",");
                  lats= parseFloat(center[0]);
                  longs = parseFloat(center[1]);
                  var fills=getsplitcolour(parseInt(ite));
                   colorsar.push(fills);
                  data22 +="{name:"+"'"+name+"',value:'"+amtcomma+"',style:{fillStyle:'"+fills+"'}},";
                  // center=testarr[i][j].center.split(",");
                  //str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+amtcomma+'<br>';
                  ite=parseInt(ite)+1;
                  round=parseInt(round)+1;
                  }
                });
                str+='</div>';
                data22 +="]";
                dataf = eval(data22);
                avg=(moneyreadconversion(total[i],inrreading[indexre])/sum1)*100;
                avg =parseInt(avg);
                //console.log(i,avg);
                //lastval.push(avg);
                // alert(valuesar);
                // setsplitmarker(valuesar,colorsar,lats,longs,str,"");
                // charrr= L.piechartMarker(
                // L.latLng([center[0],center[1]]),
                // {
                // radius: getradious(avg,splitname3[0]),
                // data: dataf
                // }).addTo(map);
                // piechartmarker.push(charrr);
                // charrr.bindTooltip(str);
                //console.log(lastval);
                });
                //jsonpiechart = JSON.stringify(piechartmarker);
                }
  }
   function chart_conversion_split(typechart,title2,json,json1,relevel,minmax)
  {
      charts = Highcharts.chart('chart', {
        chart: {
            type: typechart
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: json,
             // $minmax
        },
        // $c
         credits: {
               enabled: false
        },
        yAxis: {
            min: 0,
             labels: {
                formatter: function () {
                return numDifferentiation(this.value);
                  }
            },
        },
        scrollbar: {
            enabled: true
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                                           requestlevel=relevel;
                                          if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                    statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                       if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                        initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'');
                                                       }
                                                      else
                                                      {
                                                        alert("Data Not available");
                                                      }
                                          }
                                          else
                                          {
                                               requestlevel1=requestlevel+1;
                                               statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                             if(statuscode1 == true)
                                               {
                                                 map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                  initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata);
                                               }
                                              else
                                              {
                                                alert("Data Not available");
                                              }
                                        }
                        }
                    }
                }
            }
        },
        series: json1
    });
    if((minmax != '') && (typechart !='line')){
      charts.xAxis[0].update({
      max: 10
      }); }


  }
  function chart_conversion_combine(typechart,title2,jsonc,jk,relevel)
  {
    //jsonc ->catagoris
    //jk->values
    // alert("SDfsd");
    // console.log(color_arry);
    // console.log(typechart);
    // console.log(title2);
    // console.log(jsonc);
    // console.log(jk);
    charts = Highcharts.chart('chart', {
     yAxis: {
          labels: {
                formatter: function () {
                return numDifferentiation(this.value);
                  }
          },
          title: {
              text: ''
          },
      },
      chart: {
          type: typechart
      },
      title: {
          text: title2
      },
      credits: {
             enabled: false
      },
       //$retail
      // colors:color_arry,
      plotOptions: {
          column: {
              pointPadding: 0.2,
              borderWidth: 0,
              colorByPoint: true
          },
          series: {
              cursor: 'pointer',
              point: {
                  events: {
                      click: function () {
                          // console.log(this.y);
                                         requestlevel=relevel;
                                        if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                  statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                     if(statuscode1 == true)
                                                     {
                                                       map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                      initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'');
                                                     }
                                                    else
                                                    {
                                                      alert("Data Not available");
                                                    }
                                        }
                                        else
                                        {
                                             requestlevel1=requestlevel+1;
                                             statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                           if(statuscode1 == true)
                                             {
                                               map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata);
                                             }
                                            else
                                            {
                                              alert("Data Not available");
                                            }
                                      }
                      }
                  }
              }
          }
      },
      xAxis: {
         //$minmax
             categories:jsonc,
               scrollbar: {
          enabled: true
      },
          },
      series: jk
        },
        );
  }
  function createcontent()
  {
    comb = sessionStorage.getItem('groupby');
    yearchk = sessionStorage.getItem('year');
    view = sessionStorage.getItem('view');
    var contents ='';
     // alert(yearchk.length);
    if(comb=='C' && yearchk.length > 4) //combine timeseries
      {
       if(view == 3)
        {
          contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-rank">Rank</button>  </br></br><span></span>' +
                                '</br></br>';
        }
        else
        {
          contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-rank">Rank</button>  <button class="btn btn-success" id="by-range">Range</button></br></br><span></span>' +
                                '</br></br>';
        }
      }
      else if(comb=='S' && yearchk.length > 4) //split timeseries
        {
          if(view == 3)
          {
            contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-variable">Variable</button> </br></br><span></span>' +
                                '</br></br>';
          }
          else
          {
             contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-variable">Variable</button> <button class="btn btn-success" id="by-range">Range</button></br></br><span></span>' +
                                '</br></br>';
          }
                                // <button class="btn btn-success" id="by-rank">Rank</button>
        }
       else if(comb=='C' && yearchk.length == 4)//combine
       {
             contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-rank">Rank</button>  <button class="btn btn-success" id="by-range">Range</button></br></br><span></span>' +
                              '</br></br>';
       }
       else if(comb=='S' && yearchk.length == 4)//split
       {
            contents='<button class="btn btn-success" id="by-name">Location</button> <button class="btn btn-success" id="by-variable">Variable</button> <button class="btn btn-success" id="by-range">Range</button>  </br></br><span></span>' +
                              '</br></br>';
                              //<button class="btn btn-success" id="by-range">Range</button>
       }
       return contents;
  }
function filter_circle(file,dict)
{
  opacityon=$("#custom-handle2").html();
  data1 = [];data2 = [];refid=[]; mastername=[];geo=[];lanlat=[];iddb=[];locationname=[];
  center_coordinates=[];circle_name=[];      colorcodeid1=[];
  if(file=="SVG/1---21---21.svg")
  {


  file1=file.split("SVG/");
  file2=file1[1].split(".svg");
  file3=file2[0].split("---");
  fileid=file3[0];
  mainloc=file3[1];
  subloc=file3[2];

  }
  else if(file=="SVG/1---21---1.svg")
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

  // filesplit(file,"")
  // file1=file.split("SVG/");
  // file2=file1[1].split(".svg");
  // file3=file2[0].split("---");
  // fileid=file3[0];
  // mainloc=file3[1];
  // subloc=file3[2];
  //console.log(mainloc+","+subloc);
  removeAllcircles();
  $.ajax({
  url:'AjaxRequest.php' ,
  type:"POST",
  data:{
  "drawshape":1,
  "mainlocation": mainloc,
  "sublocation": subloc
  },
  success: function(response)
  {
  // console.log(response);
  // k=JSON.parse(response);
  // for(i=0;i<k.length;i++)
  // {
  // name1=k[i].split(",");
  // refid.push(name1[0]);
  // mastername.push(name1[1]);
  // }
  //console.log(mastername3);
  mastername3=response.toString();
  mastername3=mastername3.split("_");
  if(mainloc!=subloct)
  {
  passid='';
  if(mainloc=='12'&& subloct=='15')
  {
  passid="city_id";
  }
  else if(mainloc=='5'&& subloct=='7')
  {
  passid="country_id";
  }
  else if(mainloc=='7'&& subloct=='9')
  {
  passid="state_id";
  }
  else if(mainloc=='9'&& subloct=='10')
  {
  passid="district_id";
  }
  else if(mainloc=='10'&& subloct=='14')
  {
  passid="taluk_id";
  }
  else
  {
  passid="";
  }
  }
  else
  {
  passid= "refid";
  }

  for(i=0;i<dict.length;i++)
  {
  data1[i]=dict[i].key1;
  data2[i]=dict[i].value1;
  }
  colorcodeid1=colorgradientcreation(data2,0);

  if(fileid==676)
  {
  fileid=13346;
  }
  if(fileid==73)
  {
  fileid=14878;
  }
  if(fileid==25)
  {
  fileid=13623;
  }
  if(mainloc=='10'&& subloct=='14')
  {
  mast="village_master";

  }
  else if(mainloc=='14'&& subloct=='14')
  {
  mast="village_master";
  }

  else if(mainloc=='13'&& subloct=='13')
  {
  mast="village_master";
  }
  else
  {
  mast=mastername3[0];

  }
  $.ajax({
  url:'AjaxRequest.php' ,
  type:"POST",
  data:{
  "circle_result":1,
  "mastername1":mast,
  "fileid1":fileid,
  "passid1":passid,
  },
  success: function(response)
  {
  t=JSON.parse(response);
  for(i=0;i<t.length;i++)
  {
  geo = t[i].split(',');
  lanlat.push(geo[0]+","+geo[1]);
  locationname.push(geo[3]);
  iddb.push(geo[2]);
  }

  if(fileid==676)
  {
  if(passid=="refid" && mainloc==12 && subloc==12)
  {
  fileid="13346 ";
  //alert(key[i]+","+"check1");
  }
  }
  if(fileid==73)
  {
  if(passid=="refid" && mainloc==12 && subloc==12)
  {
  fileid="14878 ";
  // alert(key[i]+","+"check1");
  }
  }
  if(fileid==25)
  {
  if(passid=="refid" && mainloc==12 && subloc==12)
  {
  fileid="13623 ";
  // alert(key[i]+","+"check1");
  }
  }
  for(i=0;i<data1.length;i++)
  {
  for(j=0;j<iddb.length;j++)
  {
  if(data1[i]==iddb[j])
  {
  center_coordinates[j]=lanlat[j];
  //console.log(center_coordinates);
  coord=center_coordinates[j].split(',');
  circle_name[j]=locationname[j];
  }
  }

  if(mainloc==5 && subloc==5)

  {
  poprad=190000;

  }
  else if(mainloc==5 && subloc==7)

  {
  poprad=data2[i]/1000;

  }
  else if(mainloc==7 && subloc==7)

  {
  poprad=data2[i]/1000;

  }
  else if(mainloc==7 && subloc==9)

  {
  poprad=data2[i]/100;

  }
  else if(mainloc==9 && subloc==9)

  {
  poprad=data2[i]/1000;

  }
  else if(mainloc==12 && subloc== 12)

  {
  poprad=data2[i]/1000;

  }
  else
  {
  poprad=data2[i]/100;
  }
  circle= new google.maps.Circle({
  strokeColor: colorcodeid1[0][i],
  strokeOpacity: 0.8,
  strokeWeight: 2,
  fillColor:colorcodeid1[0][i],
  fillOpacity:opacityon,
  map: map,
  center:new google.maps.LatLng(coord[0],coord[1]),
  radius:poprad,
  id:data1[i],
  name:circle_name[i],
  value:data2[i]
  });
  //zeffect(circle);
  circles.push(circle);
  loc_type(mainloc,subloc,fileid);
  circle.addListener('mouseover',function(event)
  {

  var type_loc="";
  type_loc = sessionStorage.getItem("loctype");
  var title1 = this.name;
  title1 =" <b> "+title1+"-"+ " </b>"+ type_loc+":"+Math.round(this.get('value'))+"<br>";
  // title1 =" <b > "+ this.name+"- </b>"+this.value+"<br>";
  injectTooltip(event, title1);
  title1="";
  });
  circle.addListener('mouseout',function(event)
  {
  deleteTooltip(event);
  });
  circle.addListener('dblclick',function(event)
  {
  removeAllcircles();
  mapname="";
  mapname=this.name;
  //sessionStorage.setItem('mname',mapname);
  $.ajax({
  type: "POST",
  url: "AjaxRequest.php",
  data:{"nextlevel":"nextlevel","id":this.id,"currentlevel":file},
  async:false,
  success: function (data)
  {
  map.data.forEach(function(feature) {
  map.data.remove(feature);
  });
  nextlevelfile = data;

  if( nextlevelfile=="SVG/1---21---21.svg")
  {


  file1= nextlevelfile.split("SVG/");
  file2=file1[1].split(".svg");
  file3=file2[0].split("---");
  fileid=file3[0];
  mainloc=file3[1];
  subloc=file3[2];

  }
  else if( nextlevelfile=="SVG/1---21---1.svg")
  {


  file1= nextlevelfile.split("SVG/");

  file2=file1[1].split(".svg");
  file3=file2[0].split("---");
  fileid=file3[0];
  mainloc=file3[1];
  subloc=file3[2];

  }


  else
  {
  file1= nextlevelfile.split("SVG/");
  file11=file1[1].split("/");
  file2=file11[2].split(".svg");
  file3=file2[0].split("---");
  fileid=file3[0];
  mainloc=file3[1];
  subloc=file3[2];
  }

  sessionStorage.setItem("next",nextlevelfile);
  if (nextlevelfile && nextlevelfile !=undefined)
  {
  statuscode=UrlExists(baseurl+nextlevelfile);
  if(statuscode == statuscode)
  sessionStorage.setItem("currentloadfile", nextlevelfile);
  initlayer(map,nextlevelfile,0,1,'');
  //

  if(mainloc=="21"&&subloc=="1")
  {
  $("#mapname").text("Country");
  }
    else if(mainloc==subloc)
  {
  $("#mapname").text(mapname);
  general_name =mapname;
  }
  else
  {
  $("#mapname").text(general_name);
  }

  map.data.forEach(function(feature) {
  map.data.remove(feature);
  });
  $('.spinner-wrapper').hide();
  }
  else
  {
  $('.spinner-wrapper').hide();
  $.alert({
  title: '',
  content: 'Data Not Available',
  boxWidth: '30%',
  top:-500,
  offsetTop: 70,
  useBootstrap: false,
  });
  }
  }
  });
  });
  }
  //console.log(center_coordinates);console.log(circle_name);
  }
  });
  }
  });
}
  function dialog(circle) //filter function
    {
      contents = createcontent();
      $.confirm({
                  title: 'Filter',
                  content: contents,
                  buttons: {
                      someButton: {
                          text: 'Apply',
                          btnClass: 'btn-green',
                          action: function ()
                          {
                            // console.log(charts);
                            comb =  sessionStorage.getItem('groupby');
                            filteryear = sessionStorage.getItem('year');
                            view = sessionStorage.getItem('view');
                            var resyear = filteryear.split(",");
                            // alert(comb);
                            var highlightStyle ={
                            color: '#000000',
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 1,
                            fillColor: '#FFFF00'
                            };
                            if($('#example3').length > 0) //location
                            {
                                variable_fil =  sessionStorage.getItem("variable_fiter");
                                // console.log(chartseries);
                                if(variable_fil != '')
                                {
                                  variable_fil = variable_fil.split(",");
                                }
                                var chidlvlfilter = [];
                                checkrow =$( rowstable ).find('input[name="filcheckbox"]:checked')
                                checkrow.each(function(){
                                chidlvlfilter.push($(this).val());
                                });
                                // console.log(chidlvlfilter);
                                sessionStorage.setItem("loc_filter",chidlvlfilter);
                                if(comb =='C')//Combine
                                {
                                  var relevel ='';
                                  cnt =0;
                                  var locarray = [];
                                  jsonObj = [];
                                  var colors =[];
                                  var oneArray =[];    j=0;
                                  // console.log(charts);
                                  var  colorlocid = new Array();
                                  var colorlocid1=new Array();
                                  var dict = new Array();
                                   var getlocbasedchar = [];
                                   areavalue =[];
                                  locationvalindex = new Array();
                                  locationvalsort = new Array();
                                   $.fn.dataTable.ext.search.push(
                                  function( settings, searchData, index, rowData, counter ) {
                                      var find = ',';
                                       if((resyear.length > 1) && view == 3)
                                        {
                                            var find = '%';
                                        }
                                        else
                                        {
                                          var find = ',';
                                        }
                                      var re = new RegExp(find, 'g');
                                      var combinddata = [];
                                      var rowsdatane =0;
                                      if(settings['sInstance'] == 'example19')
                                      {
                                        // console.log( searchData);
                                        if(chidlvlfilter.indexOf(rowData['DT_RowId']) != -1)
                                        {
                                                 getlocbasedchar[rowData['DT_RowId']] =rowData[0];
                                                  if((resyear.length > 1) && view == 0)
                                                  {
                                                    str = searchData[1].replace(re, '');
                                                     rowsdatane = str;
                                                  }
                                                  else if((resyear.length > 1) && view == 5)
                                                  {
                                                    str = searchData[1].replace(re, '');
                                                     rowsdatane = str;
                                                  }
                                                  else if((resyear.length > 1) && view == 3)
                                                  {
                                                        str = searchData[resyear.length+1].replace(re, '');
                                                        rowsdatane = str;
                                                  }
                                                 else if(resyear.length > 1)
                                                  {
                                                      //for(var rs = 0;rs.length)
                                                          cnt =0;
                                                          if (view ==2){
                                                         for(j=resyear[0];j<=resyear[1];j++)
                                                         {
                                                            cnt++;
                                                         }
                                                         }
                                                         else
                                                         {
                                                            cnt = resyear.length;
                                                         }
                                                       for(jk=1;jk<=cnt;jk++)
                                                        {
                                                           str = searchData[jk].replace(re, '');
                                                           rowsdatane = parseFloat(rowsdatane)+parseFloat(str);
                                                           combinddata.push(parseFloat(str));
                                                        }
                                                  }
                                                  else
                                                  {
                                                     str = searchData[1].replace(re, '');
                                                     rowsdatane = str;
                                                  }
                                                  // console.log(rowData['DT_RowId']);
                                                  worldcount = rowsdatane;
                                                  // console.log(worldcount+"//Pre");
                                                  worldid=rowData['DT_RowId'];worldcount=worldcount;totalcount=sessionStorage.getItem("totalcount");
                                                  percent=(worldcount/totalcount)*100;///(worldcount/rowsdatane)*100;
                                                   areavalue[worldid] =  worldcount;
                                                             //keerthana
                                                 dict.push({
                                                          key1: worldid,
                                                          value1: worldcount
                                                          });
                                                          colorstore.push(worldcount);
                                                          colorlocid.push(worldid);
                                                          locationvalsort.push({
                                                          key1: rowData['DT_RowId'],
                                                          loc: rowData[0]
                                                          });
                                                           //locationvalsort[] = rowData[0];
                                                 if((resyear.length > 1) && (view == 0))//cont cummal
                                                  {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                      locationvalindex[rowData['DT_RowId']] = searchData[0];
                                                      jsonObj.push(item);
                                                      // colors.push(colorcount(percent));
                                                  }
                                                  else if((resyear.length > 1) && (view == 5))//mixed cummaltive
                                                  {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                      locationvalindex[rowData['DT_RowId']] = searchData[0];
                                                      jsonObj.push(item);
                                                      // colors.push(colorcount(percent));
                                                  }
                                                  else if((resyear.length > 1) && view == 3)//growth
                                                   {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                      locationvalindex[rowData['DT_RowId']] = searchData[0];
                                                      // console.log(percent);
                                                       // item["color"]=colorcount(percent);
                                                      jsonObj.push(item);
                                                      // colors.push(colorcount(percent));
                                                   }
                                                 else if(resyear.length > 1)
                                                  {
                                                     // console.log(combinddata);
                                                      item ={};
                                                      item ["name"] = searchData[0];
                                                      item ["data"] = combinddata;
                                                      jsonObj.push(item);
                                                      // colors.push(getsplitcolourchart(percent));
                                                  }
                                                  else
                                                  {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                      jsonObj.push(item);
                                                      // colors.push(colorcount(percent));
                                                  }
                                            return true;
                                        }
                                        j++;
                                      }
                                       //alert(settings);
                                  return false;
                                  }
                                   );
                                    jquerydatatable.draw();
                                    $.fn.dataTable.ext.search.pop();
                                     jsonObj = jsonObj.sort(function(a,b) {
                                    return b['y'] - a['y'];
                                    });
                                        dict.sort(function sortval(a,b){
                                        return parseFloat(b.value1)-parseFloat(a.value1);
                                        });
                                      coloshades =[];
                                      coloshadesnegative = [];
                                      flyingcolors = colorgradientcreation(colorstore,'1');
                                      coloshades = flyingcolors[0];
                                      coloshadesnegative = flyingcolors[1];
                                      // console.log(flyingcolors);
                                      j=0;
                                      if(view == 3)
                                      {
                                        j = coloshadesnegative.length-1;
                                      }
                                      jk =0;
                                                 locarray=[];
                                      // console.log('A');
                                      // console.log(getlocbasedchar);
                                      // console.log('B');
                                      newcolorshad = [];
                                      color_arry = [];
                                    for (i=0;i<dict.length;i++)
                                       {
                                          locarray.push(getlocbasedchar[dict[i].key1]);
                                            //  key[i] = dict[i].key1;
                                            // value[i]=dict[i].value1;
                                        if(dict[i].value1 < 0 )
                                        {
                                          newcolorshad[dict[i].key1] = coloshadesnegative[j];
                                          color_arry.push(coloshadesnegative[j]);
                                           if(view == 3)
                                            {
                                              j--;
                                            }
                                            else
                                            {
                                              j++;
                                            }
                                        }
                                        else
                                        {
                                           newcolorshad[dict[i].key1] = coloshades[jk];
                                          color_arry.push(coloshades[jk]);
                                          // alert(coloshades);
                                           // colorfill(mylayer, dict[i].key1,dict[i].value1,coloshades[jk]);
                                           jk++;
                                        }
                                        //colors = color_arry;
                                       // colorfill(mylayer, colorlocid[i],colorstore[i],datainfo[i]);
                                      }
                                      // alert(color_arry);
                                      // getlocbasedchar = [];
                                      coloshadesnegative = [];
                                    if(colorstore.length > 5)//if(colors.length > 5)
                                    {
                                      minmax=" min : 1,max : 10,";
                                    }
                                    else
                                    {
                                     minmax="";
                                    }
                                      colorlocid = [];
                                      colorstore = [];
                                    jsonObj = jsonObj.sort(function(a,b) {
                                    return b['y'] - a['y'];
                                    });
                                    jsonObj1 = [];
                                    item1 ={};
                                    item1["showInLegend"] = "false";
                                    item1["name"] = "Bevrgs,Deodorant";
                                    item1["data"] = jsonObj;
                                    jk = jsonObj1.push(item1)
                                    // console.log(jsonObj1);
                                    // console.log(resyear);
                                    if(resyear.length>1)
                                    {
                                      typechart = "line";
                                    }
                                    else
                                    {
                                      typechart = "column";
                                    }
                                    // console.log(jsonObj1);
                                    if((resyear.length > 1) && view == 0)
                                    {
                                      colors = color_arry;
                                       filterhighchart("column","Sales",splitname3[0],locarray,jsonObj1,colors,minmax);
                                         // charts.update({ colors: color_arry });
                                          color_arry = [];
                                    }
                                    else if((resyear.length > 1) && view == 5)
                                    {
                                       filterhighchart("column","Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                    }
                                     else if((resyear.length > 1) && view == 3)
                                     {
                                          //  alert("SDFsd");
                                          // console.log(jsonObj1);
                                           // console.log(jsonObj1);
                                          filterhighchart("column","Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                          color_arry = [];
                                     }
                                    else if(resyear.length > 1)
                                    {
                                      // console.log(splitname3);
                                      // console.log(charts);
                                      // console.log(resyear);
                                      yrs = [];
                                      if (view ==2)
                                      {
                                        for(j=resyear[0];j<=resyear[1];j++)
                                        {
                                          yrs.push(j);
                                        }
                                      }
                                      else
                                      {
                                         yrs = resyear;
                                      }
                                       filterhighchart_time(typechart,"Sales",splitname3[0],yrs,jsonObj,color_arry,minmax);
                                    }
                                    else
                                    {
                                       colors = color_arry;
                                       filterhighchart(typechart," Sales",splitname3[0],locarray,jsonObj1,colors,minmax);
                                        // charts.update({ colors: color_arry });
                                          // color_arry = [];
                                    }
                                    //map part
                                    // co
                                    // alert(circle);
                                   if(circle==0)
                                   {
                                    map.data.setStyle(function(feature)
                                    {
                                      // testtt++;
                                      if ( typeof newcolorshad[feature.getProperty('DB_ID')] != 'undefined' )
                                      {
                                        return({
                                        strokeColor: '#000',
                                        strokeOpacity: 0.8,
                                        strokeWeight: 1,
                                        fillColor:newcolorshad[feature.getProperty('DB_ID')],
                                        //fillColor: colorcodeid[feature.getProperty('DB_ID')],
                                        fillOpacity: 1
                                        });
                                      }
                                      else
                                      return ({
                                      fillColor: 'white',
                                      strokeWeight:0.5
                                      });
                                      // console.log(testtt);
                                    });
                                    // newcolorshad

                                     // $.each(newcolorshad, function(i, item)
                                     //  {
                                     //      console.log(typeof newcolorshad[i]);
                                     //      if(typeof newcolorshad[i] == 'undefined')
                                     //      {
                                     //        if(chidlvlfilter.indexOf(newcolorshad[i]) == -1)
                                     //        {
                                     //          $('#solids'+i).html('<!--'+$('#solids'+i).html()+'--!>');
                                     //        }
                                     //        else
                                     //        {
                                     //          str = $('#solids'+i).html();
                                     //          str = str.replace("<!--", "");
                                     //          str = str.replace("--!>", "");
                                     //          $('#solids'+i).html(str);
                                     //        }
                                     //      }

                                     //  });

                                        locidsvg = Object.keys(getlocbasedchar);
                                        console.log(locidsvg);
                                      for(jk=0;jk<locidsvg.length;jk++)
                                      {
                                        if(chidlvlfilter.indexOf(parseInt(locidsvg[jk])) != -1)
                                        {
                                          $('#solids'+locidsvg[jk]).html('<!--'+$('#solids'+locidsvg[jk]).html()+'--!>');
                                        }
                                        // else
                                        // {
                                        //       str = $('#solids'+locidsvg[jk]).html();
                                        //       str = str.replace("<!--", "");
                                        //       str = str.replace("--!>", "");
                                        //       $('#solids'+locidsvg[jk]).html(str);
                                        // }

                                      }

                                  }
                                  else
                                  {
                                      removeAllcircles();
                                      filter_circle(file,dict);
                                  }
                                  getlocbasedchar = [];
                                }
                                else //Split

                                {





                                  variable_fil = sessionStorage.getItem("variable_fiter");
                                  if(variable_fil !='')
                                  {
                                    variable_fil = variable_fil.split(',');
                                  }
                                  for (i = 0; i < piechartmarker.length; i++) {
                                  map.removeLayer(piechartmarker[i]);
                                  }
                                  categries = [];
                                    mapdata = sessionStorage.getItem('getstate_data');
                                    mapdata = JSON.parse(mapdata);
                                    // console.log('JAya');
                                    // console.log(mapdata);
                                    mapnewdata = [];jj=0;
                                     if((resyear.length > 1) && view == 3)
                                        {
                                            var find = '%';
                                        }
                                        else
                                        {
                                          var find = ',';
                                        }
                                       var growthdatamap =new Array();
                                       var categries_array = new Array();//07-May-2018
                                       var postivecnt = 0;
                                       var negativecnt = 0;
                                       var coloshadesnegative = [];
                                        var  coloshades =[];
                                         areavalue =[];
                                  $.fn.dataTable.ext.search.push(
                                  function( settings, searchData, index, rowData, counter )
                                  {
                                      //console.log(settings['sInstance']);
                                      // var find = ',';
                                      var re = new RegExp(find, 'g');
                                      var combinddata = [];
                                      var rowsdatane =0;
                                      // var grpercent = [];
                                     // areavalue=[];
                                      if(settings['sInstance'] == 'example2')
                                      {
                                        if(chidlvlfilter.indexOf(rowData['DT_RowId']) != -1)
                                        {
                                             if((resyear.length > 1) && view == 3) //growth
                                                  {
                                                        s = parseFloat(rowData[4].replace("%", ""));
                                                        if(s > 0)
                                                          {
                                                            postivecnt++;
                                                          }
                                                          else
                                                          {
                                                            negativecnt++;
                                                          }
                                                         growthdatamap.push({
                                                            key1:rowData['DT_RowId'] ,
                                                            value1:s
                                                            });
                                                         areavalue[rowData['DT_RowId']]=s;
                                                        str = searchData[resyear.length+2].replace(re, '');
                                                        rowsdatane = str;
                                                        worldcount = rowsdatane;
                                                        worldid=rowData['DT_RowId'];worldcount=worldcount;totalcount=sessionStorage.getItem("totalcount");
                                                        percent=(worldcount/totalcount)*100;
                                                  }
                                                  else
                                                  {
                                                     // categries_array.push({
                                                     //        key1:rowData['DT_RowId'] ,
                                                     //        value1:rowData[1]
                                                     //        });
                                                     categries_array[rowData['DT_RowId']] = rowData[1];
                                                    categries.push(rowData[1]);
                                                    mapnewdata[rowData['DT_RowId']] = mapdata[rowData['DT_RowId']];
                                                    str = searchData[2].replace(re, '');
                                                    rowsdatane = str;
                                                  }
                                          return true;
                                        }
                                      }
                                     if(resyear.length > 1)
                                      {
                                      }
                                       return false;
                                  }
                                  );
                                  jquerydatatable.draw();
                                  $.fn.dataTable.ext.search.pop();
                                    // alert("sdf");
                                    // console.log(grpercent);
                                        if(view == 3)
                                        {
                                          growthdatamap.sort(function sortval(a,b){
                                          return b.value1-a.value1;
                                          });
                                          coloshades = colorgenerator(negativecnt,postivecnt,coloshadesnegative,coloshades);
                                          // console.log(coloshades);
                                          newcolorshad = [];
                                          for(var j=0;j<growthdatamap.length;j++)
                                          {
                                              worldid=growthdatamap[j].key1;worldcount=growthdatamap[j].value1;//totalcount=t[2];
                                              newcolorshad[worldid] = coloshades[j];
                                              // colornegforgrowth = coloshadesnegative.length - 1;
                                              // colorfill(mylayer,worldid,worldcount,coloshades[j]);
                                          }
                                          // console.log(newcolorshad);
                                        }
                                  testarray = [];
                                  vt = sessionStorage.getItem('chartseries12');
                                  // console.log(vt);
                                  vat = JSON.parse(vt);
                                  // console.log(vat);
                                  // console.log(chartseries);
                                  var chartdupseries = vat;
                                  var total =new Array();
                                  var lastval=new Array();
                                  var sum1;
                                  var dataf;
                                  var data22;
                                  var center=0;
                                  vt = sessionStorage.getItem('chartseries12');
                                  vat = JSON.parse(vt);
                                  // console.log(vat);
                                  testarr= mapnewdata;
                                  testarr = testarr.filter(function(n){ return n != undefined });
                                  // console.log('testarr');
                                  // console.log(testarr);
                                 // console.log(colorgradientcreation(testarr));
                                 if(view == 1 || view == 2) //mixed and contiues
                                 {
                                    //variable_fil = sessionStorage.getItem("variable_fiter");
                                    if(variable_fil != '')
                                    {
                                      // loose
                                      // vararr =variable_fil.split(",");
                                        var vararr = variable_fil.map(function (x) {
                                        return parseInt(x, 10);
                                        });
                                        // console.log('vararr');
                                        // console.log(vararr);
                                          newtestarr = new Array();
                                          testorg = new Array();
                                         $.each(testarr, function(i, item)
                                           {
                                            $.each(testarr[i], function(j, item)
                                                {
                                                  if(vararr.indexOf(parseInt(j)) != -1)
                                                  {
                                                    newtestarr.push(testarr[i][j]);
                                                  }
                                                });
                                              testorg.push(newtestarr);
                                                    newtestarr = [];
                                           });
                                        // testarr = testorg;
                                        map_split(testorg,0,"",0);
                                    }
                                    else
                                    {
                                      // map_split(testarr,"","");

                                        // console.log(mapdata);
                                      locidsvg = Object.keys(mapdata);
                                      for(jk=0;jk<locidsvg.length;jk++)
                                      {
                                        if(chidlvlfilter.indexOf(locidsvg[jk]) == -1)
                                        {
                                          $('#solids'+locidsvg[jk]).html('<!--'+$('#solids'+locidsvg[jk]).html()+'--!>');
                                        }
                                        else
                                        {
                                              str = $('#solids'+locidsvg[jk]).html();
                                              str = str.replace("<!--", "");
                                              str = str.replace("--!>", "");
                                              $('#solids'+locidsvg[jk]).html(str);
                                        }

                                      }
                                    }
                                 }
                                 else if(view == 0 || view == 5) //cummaltive
                                 {
                                    variable_fil = sessionStorage.getItem("variable_fiter");
                                    // console.log('AAAAA');
                                    // console.log(mapnewdata);
                                    // console.log('BBBBBB');
                                    var variblcnt = 0;

                                    if(variable_fil != '')//if(variable_fil != '')
                                    {
                                      // loose

                                          vararr =variable_fil.split(",");
                                          var vararr = vararr.map(function (x) {
                                          return parseInt(x, 10);
                                          });
                                          //circle part

                                          resultforsvg = [];
                                          rsvg=[];
                                          newtestarr = new Array();
                                          testorg = new Array();
                                          $.each(testarr, function(i, item)
                                          {
                                          $.each(testarr[i], function(j, item)
                                          {
                                          if(vararr.indexOf(parseInt(j)) != -1)
                                          {
                                          newtestarr.push(testarr[i][j]);
                                          // resultforsvg[j] = testarr[i][j];

                                          }
                                          });
                                          // rsvg[i] =resultforsvg;
                                          testorg.push(newtestarr);

                                          newtestarr = [];
                                          // resultforsvg = [];
                                          });
                                          testarr = testorg;
                                          // console.log('testarr');
                                          // console.log(vararr);
                                          // console.log(rsvg);
                                          //circle part ends here



                                          //SVG part

                                        locidsvg = Object.keys(mapdata);
                                        var chart_filter = sessionStorage.getItem('chartseries12');
                                        chart_filtersvg=JSON.parse(chart_filter);
                                        unsetid_map_svg = new Array();
                                        for(jk=0;jk<chart_filtersvg[0]['data'].length;jk++)
                                        {
                                          // console.log(chart_filter[0][jk]);
                                          if(chidlvlfilter.indexOf(parseInt(chart_filtersvg[0]['data'][jk]['mydata'])) == -1)
                                          {
                                          // unsetid.push(jk);
                                          unsetid_map_svg.push(parseInt(chart_filtersvg[0]['data'][jk]['mydata'])); //getting itemid to be skipped
                                          }
                                        }
                                          console.log('mapdata');
                                          console.log(mapdata);
                                          // console.log(chidlvlfilter);
                                          // console.log(locidsvg);
                                          $.each(mapdata, function(i, item) //map load
                                          {
                                            data1=new Array();str="";sum=0;ite=0;data2=new Array();data22="[";
                                            round=0;
                                            str='<div class="info legend1">';
                                             filchk = 1;

                                                var checkindexLOC = chidlvlfilter.indexOf(i);
                                                // alert(checkindexLOC);
                                                if(checkindexLOC > -1)
                                                {
                                                  if(filchk == 1)
                                                    {
                                                      valuesar = [];
                                                      colorsar=[];
                                                      valuesvg =[];
                                                      colorsvg = [];
                                                      colorindx_r = [];
                                                      $.each(mapdata[i], function(j, item)
                                                      {
                                                          var checkindex = unsetid_map_svg.indexOf(parseInt(j));

                                                          if (checkindex > -1) {
                                                          }
                                                          else
                                                          {
                                                            // alert(checkindex);
                                                            var name =mapdata[i][j].name;
                                                            var value=mapdata[i][j].value;
                                                            if(round<10)
                                                            {

                                                               // colorindx_r[j] = value;
                                                              sum = parseInt(sum) + parseInt(mapdata[i][j].value);
                                                              center=mapdata[i][j].center.split(",");
                                                              lats= parseFloat(center[0]);
                                                              longs = parseFloat(center[1]);
                                                              if(set_map_color[j] != undefined)
                                                              {
                                                                var fills=set_map_color[j];//getsplitcolour(parseInt(ite));
                                                                valuesar.push(value);
                                                                valuesvg[i] = value;
                                                                  // console.log()a
                                                                  // alert(fills);
                                                                colorsar.push(fills);//for circle pie
                                                                colorindx_r[j] = value;
                                                                 colorsvg[i] = fills;//for svg map
                                                                data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"' }},";
                                                                center=mapdata[i][j].center.split(",");
                                                                str+='<i class="circle" style="background:'+fills+'"></i>'+mapdata[i][j].name+'-'+mapdata[i][j].value+'<br>';
                                                                ite=parseInt(ite)+1;
                                                                round=parseInt(round)+1;
                                                              }
                                                            }
                                                          }
                                                      });
                                                      str+='</div>';
                                                      data22 +="]";
                                                      var dataf = eval(data22);
                                                      avg=(total[i]/sum1)*100;
                                                      avg =parseInt(avg);
                                                      typeval='';

                                                      // console.log('lazy');
                                                      // //console.log(set_map_color);
                                                      // console.log(valuesar);
                                                      // console.log(colorsar);
                                                      // console.log(lats);
                                                      // console.log(longs);
                                                      // console.log(str);


                                                     var mapped = colorindx_r.map(function(el, k) {
                                                      return { index: k, value: el };
                                                      })
                                                      // sorting the mapped array containing the reduced values
                                                      mapped.sort(function(a, b) {
                                                      return b.value - a.value;
                                                      });
                                                      // container for the resulting order
                                                      var result = mapped.map(function(el){
                                                      return colorindx_r[el.index];
                                                      });
                                                      console.log('Robin');
                                                      console.log(unsetid_map_svg);

                                                      mapdata_svg = sessionStorage.getItem('getstate_data')
                                                      mapdata_svg = JSON.parse(mapdata_svg);
                                                        newxlrsvg = [];
                                                        $.each(mapped, function(m, item)
                                                        {
                                                              // console.log(item);
                                                              if(typeof item != 'undefined')
                                                              newxlrsvg.push(mapdata_svg[i][item.index].colr);
                                                        });

                                                        console.log('newxlrsvg');
                                                        console.log(newxlrsvg);

                                                      paramarr = [];
                                                      paramarr.push(valuesvg);
                                                      paramarr.push(colorsvg);
                                                      // alert('d');
                                                      // console
                                                      if(newxlrsvg.length != 0){
                                                      // filter_svg_color(valuesar,newxlrsvg,str,i);
                                                      }
                                                      // filter_svg_color(valuesvg,colorsvg,str,i);



                                                      // charrr =  L.piechartMarker(
                                                      // L.latLng([center[0],center[1]]),
                                                      // {
                                                      // radius:getradious(avg,splitname3[0]),
                                                      // data: dataf
                                                      // }
                                                      // ).addTo(map);
                                                      // piechartmarker.push(charrr);
                                                      // charrr.bindPopup(str);
                                                    }
                                                }


                                          });


                                            locidsvg = Object.keys(mapdata);
                                            console.log('locidsvg');
                                            console.log(locidsvg);
                                            console.log(chidlvlfilter);
                                            for(jk=0;jk<locidsvg.length;jk++)
                                            {
                                              if(chidlvlfilter.indexOf(locidsvg[jk]) == -1)
                                              {
                                                $('#solids'+locidsvg[jk]).html('<!--'+$('#solids'+locidsvg[jk]).html()+'--!>');
                                              }
                                              else
                                              {
                                                    str = $('#solids'+locidsvg[jk]).html();
                                                    if(typeof str != 'undefined'){
                                                    str = str.replace("<!--", "");
                                                    str = str.replace("--!>", "");
                                                    console.log(str);
                                                    $('#solids'+locidsvg[jk]).html(str);}else{
                                                      console.log('#solids'+locidsvg[jk]);
                                                    }

                                              }

                                            }


                                          //Svg part ends here













                                    }
                                    else
                                    {

                                      // console.log('chidlvlfilter');
                                      // console.log(chidlvlfilter);
                                      // console.log(Object.keys(mapdata));
                                      console.log(mapdata);
                                      locidsvg = Object.keys(mapdata);
                                      console.log(locidsvg);
                                      console.log(chidlvlfilter);
                                      for(jk=0;jk<locidsvg.length;jk++)
                                      {
                                        if(chidlvlfilter.indexOf(String(locidsvg[jk])) == -1)
                                        {
                                          $('#solids'+locidsvg[jk]).html('<!--'+$('#solids'+locidsvg[jk]).html()+'--!>');
                                        }
                                        else
                                        {
                                              str = $('#solids'+locidsvg[jk]).html();
                                              console.log('#solids'+locidsvg[jk]);
                                              console.log(str);
                                              if(typeof str !='undefined')
                                              {
                                              str = str.replace("<!--", "");
                                              str = str.replace("--!>", "");
                                              $('#solids'+locidsvg[jk]).html(str);}
                                        }

                                      }
                                    }


                                     // map_split(testarr,"",""); // circle pie... function.currently hidden



                                 }
                                 // alert('sd');
                                  var gettotloc = [];
                                  var cummative = 0;
                                  if(view == 0 || view == 5)
                                  {
                                     cummative = 1;
                                  }
                                  if(view == 3)//growth chart and map filter
                                  {
                                      finalres = new Array();
                                      spitdata = JSON.parse(splitarray);
                                      split_dts = sessionStorage.getItem('split_dts');
                                      split_dts = $.parseJSON(split_dts);
                                      objitems =  JSON.parse(itemobj);
                                      item_name = [];
                                      chartseries12 = sessionStorage.getItem('chartseries12');
                                      chartseries12  = $.parseJSON(chartseries12);
                                       var sumyear = [],cols = 2;
                                        for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                            for(yp = 0;yp<resyear.length;yp++)
                                            {
                                              for(sp = 0;sp<objitems.length;sp++)
                                                {
                                                    split_dts = objitems[sp].split('/');
                                                    splitname = split_dts[1];
                                                    split_dts = split_dts[0];
                                                    // alert("sfsf");
                                                  proce = 0;
                                                  if(variable_fil != '')
                                                  {
                                                    if(variable_fil.indexOf((split_dts)) == -1)
                                                    {
                                                      proce = 1;
                                                    }
                                                  }
                                                  // alert(proce);
                                                    var find = ',';
                                                    var re = new RegExp(find, 'g');
                                                    // console.log(chidlvlfilter[chf]+" // "+resyear[yp]+" // "+split_dts);
                                                    // console.log(spitdata[chidlvlfilter[chf]][resyear[yp]][split_dts]['result']);
                                                    if(proce == 0)
                                                    {
                                                      // alert(spitdata[chidlvlfilter[chf]][resyear[yp]][split_dts]['result']);
                                                        try{
                                                          str = spitdata[chidlvlfilter[chf]][resyear[yp]][split_dts]['result'].replace(re, '');
                                                           str = parseFloat(str);
                                                           ind = ""+resyear[yp]+split_dts;
                                                           if(isNaN(sumyear[ind]))
                                                          {
                                                            sumyear[ind] =  str;
                                                            item_name[ind] = splitname;//split_dts[sp]['name'];
                                                          }
                                                          else
                                                          {
                                                            sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                          }
                                                        }
                                                       catch(e)
                                                       {
                                                         ind = ""+resyear[yp]+split_dts;
                                                           if(isNaN(sumyear[ind]))
                                                          {
                                                            sumyear[ind] =  0;
                                                            item_name[ind] = splitname;//split_dts[sp]['name'];
                                                          }
                                                          else
                                                          {
                                                            sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                          }
                                                       }
                                                    }
                                                }
                                            }
                                        }
                                        // console.log(sumyear);
                                        splitname = [];
                                        chartclpostiv = 0;
                                        chartclnegat = 0;
                                        for(i=0;i<objitems.length;i++)
                                        {
                                          split_dts = objitems[i].split('/');
                                          splitname.push(split_dts[1]);
                                          split_dts = split_dts[0];
                                          // console.log(split_dts[1]);
                                          proce = 0;
                                            if(variable_fil != '')
                                            {
                                              if(variable_fil.indexOf((split_dts)) == -1)
                                              {
                                                proce = 1;
                                              }
                                            }
                                            // console.log(objitems[i]);
                                            // console.log(variable_fil);
                                          if(proce == 0)
                                          {
                                            newresultarr = new Array();
                                            indx = resyear[0]+split_dts;//[i]['refid'];
                                            //newresultarr.push(sumyear[indx]);//.toFixed(2)
                                            indx1 = resyear[1]+split_dts;
                                            percentgr=((sumyear[indx1] - sumyear[indx])/sumyear[indx])*100;
                                            if(percentgr> 0)
                                                {
                                                  chartclpostiv++;
                                                }
                                                else
                                                {
                                                  chartclnegat++;
                                                }
                                            item2 ={};
                                            item2['y'] = percentgr;
                                            item2['mydata'] = split_dts;
                                            // item2['color']  = colorcount(percentgr);
                                            // item2["name"] = item_name[indx];
                                            //item2["data"] = newresultarr;
                                            finalres.push(item2);
                                          }
                                            coloshadesnegative =[];
                                            coloshades = [];
                                            coloshades = colorgenerator(chartclnegat,chartclpostiv,coloshadesnegative,coloshades);
                                            // console.log(coloshades);
                                            // console.log('neg '+chartclnegat);
                                            // console.log('post '+chartclpostiv);
                                        }
                                        item4 = new Array();
                                        item3 = {};
                                        // console.log(splitname);\
                                          finalres.sort(function sortval(a,b){
                                                      return b.y-a.y;
                                                    });
                                         categries = splitname.toString();
                                        item3['name'] = categries;
                                        item3['data'] = finalres;
                                        item4.push(item3);
                                        filter_chart_growth_split(splitname,item4,coloshades);
                                        //map filling
                                    map.data.setStyle(function(feature)
                                    {
                                      // testtt++;
                                      if ( typeof newcolorshad[feature.getProperty('DB_ID')] != 'undefined' )
                                      {
                                        return({
                                        strokeColor: '#000',
                                        strokeOpacity: 0.8,
                                        strokeWeight: 0.5,
                                        fillColor:newcolorshad[feature.getProperty('DB_ID')],
                                        //fillColor: colorcodeid[feature.getProperty('DB_ID')],
                                        fillOpacity: 1
                                        });
                                      }
                                      else
                                      return ({
                                      fillColor: 'white',
                                      strokeWeight:0.5
                                      });
                                      // console.log(testtt);
                                    });
                                        // filter_highcharts_split(categries,item4);
                                  }
                                  else if(resyear.length > 1 && cummative == 0)//else if(resyear.length > 1 && view != 0) //timeseries
                                  {
                                      // console.log("Robin");
                                     // console.log(chidlvlfilter);
                                      spitdata = JSON.parse(splitarray);
                                      split_dts = sessionStorage.getItem('split_dts');
                                      split_dts = $.parseJSON(split_dts);
                                      objitems =  JSON.parse(itemobj);

                                      var sumyear = [],cols = 2;
                                      objitems =  JSON.parse(itemobj);
                                      item_name = [];
                                      for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                          // console.log(view);
                                          if(view == 2)//continues period
                                          {
                                              for(yp = resyear[0];yp<=resyear[1];yp++)
                                              {
                                               for(sp = 0;sp<objitems.length;sp++)
                                                {
                                                    split_dts = objitems[sp].split('/');
                                                    splitname = split_dts[1];
                                                    split_dts = split_dts[0];
                                                    var find = ',';
                                                    var re = new RegExp(find, 'g');
                                                    // console.log(chidlvlfilter[chf]+" // "+yp+" // "+split_dts);
                                                    // console.log(typeof spitdata[chidlvlfilter[chf]][yp][split_dts]['result']);
                                                // alert(variable_fil+" // "+split_dts);
                                                if(variable_fil !='')
                                                {
                                                  // alert("Sdf");
                                                  // vararr =variable_fil.split(",");
                                                  // var vararr = variable_fil.map(function (x) {
                                                  // return parseInt(x, 10);
                                                  // });
                                                  if(variable_fil.indexOf(split_dts) != -1)
                                                  {
                                                     // alert(split_dts);
                                                      try{
                                                      str = spitdata[chidlvlfilter[chf]][yp][split_dts]['result'].replace(re, '');
                                                       str = parseFloat(str);
                                                       ind = ""+yp+split_dts;
                                                       if(isNaN(sumyear[ind]))
                                                      {
                                                        sumyear[ind] =  str;
                                                        item_name[ind] = splitname;//split_dts[sp]['name'];
                                                      }
                                                      else
                                                      {
                                                        sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                      }
                                                    }
                                                     catch(e)
                                                     {
                                                       ind = ""+yp+split_dts;
                                                         if(isNaN(sumyear[ind]))
                                                        {
                                                          sumyear[ind] =  0;
                                                          item_name[ind] = splitname;//split_dts[sp]['name'];
                                                        }
                                                        else
                                                        {
                                                          sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                        }
                                                     }
                                                     sumyear[ind] = parseFloat(sumyear[ind]).toFixed(2);
                                                  }
                                                }
                                                else
                                                {
                                                    try{
                                                      str = spitdata[chidlvlfilter[chf]][yp][split_dts]['result'].replace(re, '');
                                                       str = parseFloat(str);
                                                       ind = ""+yp+split_dts;
                                                       if(isNaN(sumyear[ind]))
                                                      {
                                                        sumyear[ind] =  str;
                                                        item_name[ind] = splitname;//split_dts[sp]['name'];
                                                      }
                                                      else
                                                      {
                                                        sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                      }
                                                    }
                                                     catch(e)
                                                     {
                                                       ind = ""+yp+split_dts;
                                                         if(isNaN(sumyear[ind]))
                                                        {
                                                          sumyear[ind] =  0;
                                                          item_name[ind] = splitname;//split_dts[sp]['name'];
                                                        }
                                                        else
                                                        {
                                                          sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                        }
                                                     }
                                                }
                                                }
                                              }
                                          }
                                          else if(view == 1)//mixed period
                                          {
                                            for(yp = 0;yp<resyear.length;yp++)
                                            {
                                              for(sp = 0;sp<objitems.length;sp++)
                                                {
                                                    split_dts = objitems[sp].split('/');
                                                    splitname = split_dts[1];
                                                    split_dts = split_dts[0];
                                                    var find = ',';
                                                    var re = new RegExp(find, 'g');
                                                    // console.log(chidlvlfilter[chf]+" // "+resyear[yp]+" // "+split_dts);
                                                    // console.log(typeof spitdata[chidlvlfilter[chf]][yp][split_dts]['result']);
                                                    try{
                                                      str = spitdata[chidlvlfilter[chf]][resyear[yp]][split_dts]['result'].replace(re, '');
                                                       str = parseFloat(str);
                                                       ind = ""+resyear[yp]+split_dts;
                                                       if(isNaN(sumyear[ind]))
                                                      {
                                                        sumyear[ind] =  str;
                                                        item_name[ind] = splitname;//split_dts[sp]['name'];
                                                      }
                                                      else
                                                      {
                                                        sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                      }
                                                    }
                                                     catch(e)
                                                     {
                                                       ind = ""+yp+split_dts;
                                                         if(isNaN(sumyear[ind]))
                                                        {
                                                          sumyear[ind] =  0;
                                                          item_name[ind] = splitname;//split_dts[sp]['name'];
                                                        }
                                                        else
                                                        {
                                                          sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                        }
                                                     }
                                                }
                                            }
                                          }
                                        }

                                        finalres = new Array();
                                        for(i=0;i<objitems.length;i++)
                                        {
                                          split_dts = objitems[i].split('/');
                                          split_dts = split_dts[0];
                                          newresultarr = new Array();
                                          if(view == 2)
                                          {
                                            for(j = resyear[0];j<=resyear[1];j++)
                                            {
                                                  indx = j+split_dts;//j+split_dts[i]['refid'];
                                                  newresultarr.push(parseFloat(sumyear[indx]));
                                            }
                                            item2 ={};
                                            item2["name"] = item_name[indx];
                                            item2["data"] = newresultarr;
                                            finalres.push(item2);
                                          }
                                          else
                                          {
                                            for(j=0;j<resyear.length;j++)
                                            {
                                                  indx = resyear[j]+split_dts;//[i]['refid'];
                                                  newresultarr.push(sumyear[indx]);//.toFixed(2)
                                            }
                                            item2 ={};
                                            item2["name"] = item_name[indx];
                                            item2["data"] = newresultarr;
                                            finalres.push(item2);
                                          }
                                        }

                                         if(view == 2)
                                         {
                                          newcatorgies = new Array();
                                           for(j = resyear[0];j<=resyear[1];j++)
                                           {
                                              newcatorgies.push(j);
                                           }
                                           resyear = newcatorgies;
                                         }
                                        filter_highcharts_split_timeline(resyear,finalres);
                                        // alert("sdf");
                                        // alert("sdf");
                                  }
                                  // else if()
                                  else
                                  {
                                    // alert('sdf');
                                    // console.log(variable_fil);
                                    spitdata = JSON.parse(splitarray);
                                   // console.log(spitdata);
                                      objitems =  JSON.parse(itemobj);
                                      // console.log(objitems);
                                      // console.log(chartseries);
                                      var bdata = [];
                                      // alert("Sdfsd");
                                      for(chs=0;chs<chartseries.length;chs++)
                                      {
                                        chartitms = chartseries[chs]['data'];
                                        // console.log(chartitms);
                                        // console.log(chartitms);
                                          var incindex = 0;
                                          for(chf = 0;chf<chidlvlfilter.length;chf++)
                                          {
                                            // alert(chartseries[chs]['split_id']);
                                            if(variable_fil !='')
                                            {
                                              if(variable_fil.indexOf(chartseries[chs]['split_id'].toString()) != -1)
                                              {
                                                // console.log(chidlvlfilter[chf]);
                                                 temparv = (chartitms.filter(function (person) {
                                                 if(person !== null){ return person.mydata == chidlvlfilter[chf] }}));
                                                  temparv[0]['x'] = incindex;
                                                   if(Number.isNaN(gettotloc[temparv[0].mydata]))// == 'NaN')
                                                  {
                                                    gettotloc[temparv[0].mydata] = 0;
                                                  }
                                                   gettotloc[temparv[0].mydata] = gettotloc[temparv[0].mydata] + parseFloat(temparv[0].y);
                                                   // console.log('aas');
                                                   // console.log(gettotloc[temparv[0].mydata]);
                                                   // console.log(parseFloat(temparv[0].y));
                                                  // if(typeof bdata[incindex][temparv[0]['mydata']] == 'undefined')
                                                  // {
                                                  //   bdata[incindex][temparv[0]['mydata']] = 0;
                                                  // }
                                                  // bdata[temparv[0]['mydata']] = temparv;
                                                   // alert(temparv[0]);
                                                   // console.log(gettotloc);
                                                   // console.log('gettotloc');
                                                      bdata[temparv[0].mydata] = temparv[0];
                                                  testarray.push(temparv[0]);
                                                  incindex++;
                                              }
                                            }
                                            else
                                            {
                                                 temparv = (chartitms.filter(function (person)
                                                  {  if(person !== null){return person.mydata == chidlvlfilter[chf] }}));
                                                 if(typeof temparv[0] !== 'undefined'){
                                                  temparv[0]['x'] = incindex;
                                                  if(typeof gettotloc[temparv[0]['mydata']] == 'undefined')
                                                  {
                                                    gettotloc[temparv[0]['mydata']] = 0;
                                                  }
                                                  // alert(gettotloc[temparv[0]['mydata']]);
                                                  gettotloc[temparv[0]['mydata']] = gettotloc[temparv[0]['mydata']] + parseFloat(temparv[0]['y']);
                                                  bdata[temparv[0]['mydata']] = temparv[0];
                                                  // alert(temparv[0]);
                                                  // console.log('temp');
                                                  // console.log(temparv[0]);
                                                  // console.log(gettotloc);
                                                  // testarray[temparv[0]['mydata']] =
                                                testarray.push(temparv[0]);
                                                    incindex++;
                                                  }
                                            }
                                          }
                                          // console.log('temp');
                                          // console.log(bdata);
                                          // alert('1');
                                          testarray = testarray.filter(Boolean);
                                          // bdata = bdata.filter(Boolean);
                                          // console.log('temp1')
                                          // console.log(testarray);
                                          chartdupseries[chs]['data'] = bdata;//testarray;
                                          testarray = [];
                                          bdata = [];
                                      }
                                      // alert("s");
                                    // console.log('dfd');
                                    // console.log(bdata);
                                    // console.log(chartdupseries);
                                    // console.log(gettotloc);
                                    var mapped = gettotloc.map(function(el, i) {
                                    return { index: i, value: el };
                                    })
                                    // sorting the mapped array containing the reduced values
                                    mapped.sort(function(a, b) {
                                    return b.value - a.value;
                                    });
                                    // container for the resulting order
                                    var result = mapped.map(function(el){
                                    return gettotloc[el.index];
                                    });
                                      finelcat = [];
                                      fineseries = [];
                                      // console.log('mapped');
                                      // console.log(mapped);
                                      // console.log(gettotloc);
                                      // console.log(chartdupseries);
                                      chartdupseries1 = chartdupseries;
                                      newcat = [];
                                      stprepr = 0;
                                      tempdataarr = [];
                                      for(chs=0;chs<chartdupseries.length;chs++)
                                      {
                                          chartitms = chartdupseries[chs]['data'];
                                           if(variable_fil !='')
                                            {
                                              if(variable_fil.indexOf(chartseries[chs]['split_id'].toString()) != -1)
                                              {
                                                    // alert('sds');
                                                    var cntind = 0;
                                                    for (var key in mapped)
                                                    {
                                                    if (mapped.hasOwnProperty(key)) {
                                                    // console.log(key, mapped[key].index);
                                                    chartitms[mapped[key].index]['x'] = cntind;
                                                    if(stprepr == 0){
                                                    newcat.push(categries_array[mapped[key].index]);
                                                    }
                                                    cntind++
                                                    }
                                                    }
                                                    stprepr++;
                                              }
                                            }
                                            else
                                            {
                                              var cntind = 0;
                                              // co
                                              // console.log('96');
                                              // console.log(chartitms);
                                              for (var key in mapped)
                                              {
                                                if (mapped.hasOwnProperty(key)) {
                                                // console.log(key, mapped[key].index);
                                                if(chartitms[mapped[key].index] != undefined)
                                                {
                                                    chartitms[mapped[key].index]['x'] = cntind;
                                                  if(stprepr == 0){
                                                  newcat.push(categries_array[mapped[key].index]);
                                                  }
                                                  cntind++
                                                }
                                                }

                                              }
                                              stprepr++;
                                            }
                                          chartitms = chartitms.filter(Boolean);
                                          chartdupseries1[chs]['data'] = chartitms;//chartitms;
                                      }
                                      sessionStorage.setItem('filterpt','loc');
                                    // console.log('new');
                                    // console.log(newcat);
                                    // console.log(chartdupseries1);
                                    // console.log('old')
                                    // console.log(categries);
                                    // console.log(chartdupseries);
                                      filter_highcharts_split(newcat,chartdupseries1);//categries,chartdupseries
                                  }
                                }
                            }
                            else if($('#example4').length > 0) //variable
                            {
                                if((resyear.length > 1) && view == 3)
                                {
                                  var find = '%';
                                }
                                objitems =  JSON.parse(itemobj);
                                spitdataforloc = JSON.parse(splitarray);//All row data
                                var chidlvlfilter = [];
                                maprmitms = [];
                                checkrow =$( rowstable ).find('input[name="filcheckbox"]:checked')
                                checkrow.each(function(){
                                  chidlvlfilter.push(parseInt($(this).val()));
                                  maprmitms.push(parseInt($(this).val()));
                                });
                                sessionStorage.setItem("variable_fiter",chidlvlfilter);
                                // alert(view);
                                if(view != 0 )  //== 1 || view ==2 ||view ==3
                                {
                                    // alert("b1");
                                    var chart_filter = sessionStorage.getItem('chartseries12');
                                    chart_filter=JSON.parse(chart_filter);
                                    // console.log(chart_filter);
                                    var var_map_filer  = sessionStorage.getItem('getstate_data');
                                    testarr=JSON.parse(var_map_filer);
                                    // console.log(chart_filter);
                                         // alert("b2");
                                         // console.log(chart_filter);
                                        unsetid_map = new Array();
                                         for(jk=0;jk<chart_filter[0]['data'].length;jk++)
                                          {
                                            // console.log(chart_filter[0][jk]);
                                            if(chidlvlfilter.indexOf(parseInt(chart_filter[0]['data'][jk]['mydata'])) == -1)
                                            {
                                             // unsetid.push(jk);
                                              unsetid_map.push(parseInt(chart_filter[0]['data'][jk]['mydata'])); //getting itemid to be skipped
                                            }
                                          }
                                           // maprmitms = chidlvlfilter;
                                           // console.log(testarr);
                                            // alert("b4");
                                           loc_filter = sessionStorage.getItem("loc_filter");
                                           if(loc_filter !='')
                                           {
                                            loc_filter = loc_filter.split(",");
                                            var arrayOfNumbers = loc_filter.map(Number);
                                           }
                                           // console.log(loc_filter);
                                        if(view !=3)
                                        {
                                          // console.log('robin');
                                          // console.log(testarr);
                                          // alert(chidlvlfilter);
                                          if(chidlvlfilter != '')
                                          {
                                            // loose
                                            // vararr =variable_fil.split(",");
                                              var vararr = chidlvlfilter.map(function (x) {
                                              return parseInt(x, 10);
                                              });
                                              // console.log('vararr');
                                              // console.log(vararr);
                                                newtestarr = new Array();
                                                testorg = new Array();
                                               $.each(testarr, function(i, item)
                                                 {
                                                    filchk = 1;
                                                    if(loc_filter != '')
                                                    {
                                                      if(arrayOfNumbers.indexOf(parseInt(i)) == -1)
                                                      {
                                                       filchk =0;
                                                      }
                                                    }
                                                  if(filchk == 1)
                                                  {
                                                      $.each(testarr[i], function(j, item)
                                                      {
                                                        if(vararr.indexOf(parseInt(j)) != -1)
                                                        {
                                                          newtestarr.push(testarr[i][j]);
                                                        }
                                                      });
                                                    testorg.push(newtestarr);
                                                          newtestarr = [];
                                                  }
                                                 });
                                              // testarr = testorg;
                                              // alert('12');
                                              map_split(testorg,0,"",0);
                                          }
                                          else
                                          {
                                            // alert('1');
                                            map_split(testarr,0,"",0);
                                          }
                                          var total=new Array();
                                            var sum1;
                                           $.each(testarr, function(i, item)
                                              {
                                                 // console.log(testarr);
                                                  total[i]=0;
                                                  round=0;
                                                  $.each(testarr[i], function(j, item)
                                                  {
                                                    var value1=testarr[i][j].value;
                                                    if(round<10)
                                                    {
                                                      total[i] = parseInt(total[i])+parseInt(testarr[i][j].value);// sum of state
                                                    }
                                                  });
                                              });
                                             sum1 = total.reduce(add, 0);// sum of all state
                                              sum1=parseInt(sum1);
                                              function add(a, b) {
                                              return a + b;
                                              }
                                                // console.log(sum1);
                                              $.each(testarr, function(i, item)  //Map filter
                                              {
                                                data1=new Array();str="";sum=0;ite=0;data2=new Array(); round=0;data22="[";
                                                str='<div class="info legend1">';
                                                filchk = 1;
                                                if(loc_filter != '')
                                                {
                                                    if(arrayOfNumbers.indexOf(parseInt(i)) == -1)
                                                    {
                                                      filchk =0;
                                                    }
                                                }
                                                if(filchk == 1){
                                                $.each(testarr[i], function(j, item){
                                                  if(chidlvlfilter.indexOf(parseInt(j)) != -1)
                                                  {
                                                    var name =testarr[i][j].name;
                                                    var value=testarr[i][j].value;
                                                     // alert(name+" // "+value);
                                                    if(round<10)
                                                    {
                                                      sum = parseInt(sum) + parseInt(testarr[i][j].value);
                                                      var fills=getsplitcolour(parseInt(ite));
                                                      data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"'}},";
                                                      center=testarr[i][j].center.split(",");
                                                      //str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
                                                      //  str+=testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
                                                      ite=parseInt(ite)+1;
                                                      round=parseInt(round)+1;
                                                    }
                                                  }
                                                });
                                                str+='</div>';
                                                data22 +="]";
                                                var dataf = eval(data22);
                                                // console.log(data22);
                                                 avg=(total[i]/sum1)*100;
                                                        avg =parseInt(avg);
                                                // charrr= L.piechartMarker(
                                                // L.latLng([center[0],center[1]]),
                                                // {
                                                // radius: getradious(avg,splitname3[0]),
                                                // data: dataf
                                                // }).addTo(map);
                                               // piechartmarker.push(charrr);
                                                //charrr.bindTooltip(str);
                                              }
                                              });
                                        }
                                        else
                                        {
                                          // alert("b5");
                                          loc_filter = sessionStorage.getItem("loc_filter");
                                          if(loc_filter !='')
                                          {
                                            loc_filter = loc_filter.split(",");
                                            var arrayOfNumbers = loc_filter.map(Number);
                                          }
                                          unsetid = new Array();
                                          unsetid_map = new Array();
                                          set_map_color = new Array();
                                          chart_filter_dp =chart_filter;
                                          // console.log(chart_filter);
                                          // alert("b6");
                                          for(jk=0;jk<chart_filter[0]['data'].length;jk++)
                                          {
                                            // console.log(chart_filter[0][jk]);
                                            if(chidlvlfilter.indexOf(parseInt(chart_filter[0]['data'][jk]['mydata'])) == -1)
                                            {
                                            unsetid.push(jk);
                                            unsetid_map.push(parseInt(chart_filter[0]['data'][jk]['mydata'])); //getting itemid to be skipped
                                            }
                                          }
                                          // console.log(chart_filter_dp);
                                          // console.log(unsetid);
                                          for (var i = unsetid.length -1; i >= 0; i--) //unset unselected variable
                                          chart_filter_dp[0]['data'].splice(unsetid[i],1);
                                          // console.log(chart_filter_dp);
                                          // filter_highcharts_split(categoryN,chart_filter_dp);
                                          maprmitms = unsetid_map;
                                          // alert("b7");
                                        }
                                       // alert("b8");
                                      locationids = new Array();
                                      sourcedata  = jquerydatatable.rows().nodes();
                                      trdataContent = new Array();
                                      $(sourcedata).map(function(i, cell) {
                                      trdataContent[$(cell).attr('id')] = $(cell);
                                      locationids.push(parseInt($(cell).attr('id')));
                                      });
                                      // console.log(trdataContent);
                                      // console.log(maprmitms);
                                       // alert("b9");
                                    if(resyear.length > 1) //&& view != 3) //timeseries  chart filter
                                    {
                                        spitdata = JSON.parse(splitarray);
                                        // console.log(spitdata);
                                        split_dts = sessionStorage.getItem('split_dts');
                                        split_dts = $.parseJSON(split_dts);
                                        objitems =  JSON.parse(itemobj);
                                        var sumyear = [],cols = 2;
                                        var gridtot =new Array(); //
                                        var gridrowtot = new Array();
                                        objitems =  JSON.parse(itemobj);
                                        item_name = [];
                                        // alert("b10");
                                            if(view == 2)//continues period
                                            {   yrindex =1;
                                                for(yp = resyear[0];yp<=resyear[1];yp++)
                                                {
                                                 for(sp = 0;sp<objitems.length;sp++)
                                                  {
                                                      split_dts = objitems[sp].split('/');
                                                      splitname = split_dts[1];
                                                      split_dts = split_dts[0];
                                                      var find = ',';
                                                      var re = new RegExp(find, 'g');
                                                    if(chidlvlfilter.indexOf(parseInt(split_dts)) != -1)
                                                    {
                                                      var tblindex = 1;
                                                       $.each(spitdata, function(i, item)
                                                        {
                                                            // console.log(spitdata[i][yp][parseInt(split_dts)]['result']);
                                                            // console.log(trdataContent[i].eq(tblindex+yrindex).text());
                                                          try{
                                                          // console.log("ere");
                                                          str = spitdata[i][yp][parseInt(split_dts)]['result'].replace(re, '');
                                                          // console.log("ere");
                                                          str = parseFloat(str);
                                                          ind = ""+yp+split_dts;
                                                          grdinx = yp+i;
                                                          // if(gridloc[i])
                                                           if(isNaN(gridtot[grdinx])) //grid total
                                                           {
                                                              gridtot[grdinx] = str;
                                                           }
                                                           else
                                                           {
                                                               gridtot[grdinx] = parseFloat(gridtot[grdinx])+str;
                                                           }
                                                           if(isNaN(gridrowtot[i])) //grid total
                                                           {
                                                              gridrowtot[i] = str;
                                                           }
                                                           else
                                                           {
                                                               gridrowtot[i] = parseFloat(gridrowtot[i])+str;
                                                           }
                                                          if(isNaN(sumyear[ind]))//graph total array
                                                          {
                                                            sumyear[ind] =  str;
                                                            item_name[ind] = splitname;//split_dts[sp]['name'];
                                                          }
                                                          else
                                                          {
                                                           sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                          }
                                                          }
                                                          catch(e)
                                                          {
                                                          ind = ""+yp+split_dts;
                                                          if(isNaN(sumyear[ind]))
                                                          {
                                                            sumyear[ind] =  0;
                                                            item_name[ind] = splitname;//split_dts[sp]['name'];
                                                          }
                                                          else
                                                          {
                                                           sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                          }
                                                          }
                                                        });
                                                    }
                                                  }
                                                  yrindex++;
                                                }
                                            }
                                            else if(view == 1 || view ==3)//mixed period and growth
                                            {
                                               // alert("b11");
                                                for(yp = 0;yp<resyear.length;yp++)
                                                {
                                                 for(sp = 0;sp<objitems.length;sp++)
                                                  {
                                                      split_dts = objitems[sp].split('/');
                                                      splitname = split_dts[1];
                                                      split_dts = split_dts[0];
                                                      var find = ',';
                                                      var re = new RegExp(find, 'g');
                                                       // alert("b10");
                                                    if(chidlvlfilter.indexOf(parseInt(split_dts)) != -1)
                                                    {
                                                      var tblindex = 1;
                                                       $.each(spitdata, function(i, item)
                                                        {
                                                            // console.log(spitdata[i][yp][parseInt(split_dts)]['result']);
                                                            // console.log(trdataContent[i].eq(tblindex+yrindex).text());
                                                            proceed = 1;
                                                            if(loc_filter != '')
                                                            {
                                                              if(arrayOfNumbers.indexOf(parseInt(i)) == -1)
                                                                    {
                                                                      proceed = 0;
                                                                    }
                                                            }
                                                            // alert(proceed);
                                                          if(proceed == 1)
                                                          {
                                                            try
                                                            {
                                                              str = spitdata[i][resyear[yp]][parseInt(split_dts)]['result'].replace(re, '');
                                                              str = parseFloat(str);
                                                              ind = ""+resyear[yp]+split_dts;
                                                              grdinx = resyear[yp]+i;
                                                               if(isNaN(gridtot[grdinx])) //grid total
                                                               {
                                                                  gridtot[grdinx] = str;
                                                               }
                                                               else
                                                               {
                                                                   gridtot[grdinx] = parseFloat(gridtot[grdinx])+str;
                                                               }
                                                               if(isNaN(gridrowtot[i])) //grid total
                                                               {
                                                                  gridrowtot[i] = str;
                                                               }
                                                               else
                                                               {
                                                                   gridrowtot[i] = parseFloat(gridrowtot[i])+str;
                                                               }
                                                              if(isNaN(sumyear[ind]))//graph total array
                                                              {
                                                                sumyear[ind] =  str;
                                                                item_name[ind] = splitname;//split_dts[sp]['name'];
                                                              }
                                                              else
                                                              {
                                                               sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                              }
                                                            }
                                                            catch(e)
                                                            {
                                                              ind = ""+resyear[yp]+split_dts;
                                                              if(isNaN(sumyear[ind]))
                                                              {
                                                                sumyear[ind] =  0;
                                                                item_name[ind] = splitname;//split_dts[sp]['name'];
                                                              }
                                                              else
                                                              {
                                                               sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                              }
                                                            }
                                                          }
                                                        });
                                                    }
                                                  }
                                                }
                                            }
                                          if(view !=3)
                                          {
                                            finalres = new Array();
                                            for(i=0;i<objitems.length;i++)
                                            {
                                              split_dts = objitems[i].split('/');
                                                        split_dts = split_dts[0];
                                              newresultarr = new Array();
                                              if(chidlvlfilter.indexOf(parseInt(split_dts)) != -1)
                                              {
                                                if(view == 2)
                                                {
                                                  for(j = resyear[0];j<=resyear[1];j++)
                                                  {
                                                        indx = j+split_dts;//j+split_dts[i]['refid'];
                                                        newresultarr.push(parseFloat(sumyear[indx]));
                                                  }
                                                  item2 ={};
                                                  item2["name"] = item_name[indx];
                                                  item2["data"] = newresultarr;
                                                  finalres.push(item2);
                                                }
                                                else
                                                {
                                                  for(j=0;j<resyear.length;j++)
                                                  {
                                                        indx = resyear[j]+split_dts;//[i]['refid'];
                                                        // console.log(indx+' index');
                                                        newresultarr.push(sumyear[indx]);//.toFixed(2)
                                                  }
                                                  item2 ={};
                                                  item2["name"] = item_name[indx];
                                                  item2["data"] = newresultarr;
                                                  finalres.push(item2);
                                                }
                                              }
                                            }
                                          }
                                          // console.log(resyear);
                                          // console.log(finalres);
                                          if(view == 2)
                                           {
                                              newcatorgies = new Array();
                                             for(j = resyear[0];j<=resyear[1];j++)
                                             {
                                                newcatorgies.push(j);
                                             }
                                             // resyear = newcatorgies;
                                             // console.log(newcatorgies);
                                             filter_highcharts_split_timeline(newcatorgies,finalres);
                                           }
                                           else if(view ==1)
                                           {
                                              filter_highcharts_split_timeline(resyear,finalres);
                                           }
                                           else if (view == 3) //growth chart
                                           {
                                              chartclnegat = 0
                                              chartclpostiv = 0;
                                              finalres = new Array();
                                              splitname = [];
                                              for(i=0;i<objitems.length;i++)
                                              {
                                                split_dts = objitems[i].split('/');
                                                //splitname.push(split_dts[1]);
                                                spltnm = split_dts[1];
                                                split_dts = split_dts[0];
                                                // console.log(split_dts[1]);
                                                proce = 0;
                                                if(chidlvlfilter.indexOf(parseInt(split_dts)) == -1)
                                                {
                                                  proce = 1;
                                                }
                                                if(proce == 0)
                                                {
                                                  splitname.push(spltnm);
                                                  newresultarr = new Array();
                                                  indx = resyear[0]+split_dts;//[i]['refid'];
                                                  //newresultarr.push(sumyear[indx]);//.toFixed(2)
                                                  indx1 = resyear[1]+split_dts;
                                                  percentgr=((sumyear[indx1] - sumyear[indx])/sumyear[indx])*100;
                                                  item2 ={};
                                                  if(percentgr> 0)
                                                  {
                                                    chartclpostiv++;
                                                  }
                                                  else
                                                  {
                                                    chartclnegat++;
                                                  }
                                                  item2['y'] = percentgr;
                                                  item2['mydata'] = split_dts;
                                                  // item2['color']  = colorcount(percentgr);
                                                  // item2["name"] = item_name[indx];
                                                  //item2["data"] = newresultarr;
                                                  finalres.push(item2);
                                                }
                                                coloshadesnegative =[];
                                                coloshades = [];
                                                coloshades = colorgenerator(chartclnegat,chartclpostiv,coloshadesnegative,coloshades);
                                              }
                                              item4 = new Array();
                                              item3 = {};
                                              // console.log('AB');
                                              finalres.sort(function sortval(a,b){
                                                        return b.y-a.y;
                                                      });
                                              // console.log(finalres);
                                              categries = splitname.toString();
                                              item3['name'] = categries;
                                              item3['data'] = finalres;
                                              item4.push(item3);
                                              // console.log(item4);
                                              filter_chart_growth_split(splitname,item4,coloshades);
                                              // console.log(coloshades);
                                               // charts.update({ colors: coloshades });
                                           }
                                            // console.log(trdataContent);
                                          if(view == 2)//continues period //grid table
                                            {
                                              dynamicrangeval = [];
                                               //dynamicrangeval = gridrowtot.filter(function(){return true;});
                                               // console.log(dynamicrangeval);
                                                tdindex =2;
                                                yindex = 1;
                                                zindex = 1;
                                                for(yp = resyear[0];yp<=resyear[1];yp++)
                                                {
                                                    // locationids
                                                    for(lc=0;lc<locationids.length;lc++)
                                                    {
                                                      indx = [yp]+""+[locationids[lc]];
                                                      indextbl = tdindex+yindex;
                                                      // alert(indextbl);
                                                         trdataContent[locationids[lc]].find('td:nth-child('+indextbl+')').text(new Intl.NumberFormat('en-IN').format(gridtot[indx]));
                                                         if(yindex == 1)
                                                         {
                                                             trdataContent[locationids[lc]].find('td:last').text(new Intl.NumberFormat('en-IN').format(gridrowtot[locationids[lc]]));
                                                                if(loc_filter != '')
                                                                {
                                                                  if(arrayOfNumbers.indexOf(parseInt(locationids[lc])) != -1)
                                                                  {
                                                                    dynamicrangeval[locationids[lc]] = gridrowtot[locationids[lc]];
                                                                    // dynamicrangeval.push(gridrowtot[locationids[lc]]);
                                                                  }
                                                                }
                                                         }
                                                    }
                                                    yindex++;
                                                }
                                                // alert("buser");
                                                // console.log(dynamicrangeval);
                                            }
                                            else if(view == 1)//mixed period grid table
                                            {
                                                // console.log('kai ray');
                                                // console.log(gridrowtot);
                                               dynamicrangeval = [];//gridrowtot.filter(function(){return true;});
                                               // dynamicrangeval = gridrowtot.filter(function(){return true;});
                                               // console.log(dynamicrangeval);
                                                tdindex =2;
                                                yindex = 1;
                                                zindex = 1;
                                                for(yp=0;yp<resyear.length;yp++)//for(yp = resyear[0];yp<=resyear[1];yp++)
                                                {
                                                    // locationids
                                                    for(lc=0;lc<locationids.length;lc++)
                                                    {
                                                      indx = resyear[yp]+""+[locationids[lc]];
                                                      indextbl = tdindex+yindex;
                                                         trdataContent[locationids[lc]].find('td:nth-child('+indextbl+')').text(new Intl.NumberFormat('en-IN').format(gridtot[indx]));
                                                         if(yindex == 1)
                                                         {
                                                             trdataContent[locationids[lc]].find('td:last').text(new Intl.NumberFormat('en-IN').format(gridrowtot[locationids[lc]]));
                                                              if(loc_filter != '')
                                                                {
                                                                  if(arrayOfNumbers.indexOf(parseInt(locationids[lc])) != -1)
                                                                  {
                                                                    dynamicrangeval[locationids[lc]] = gridrowtot[locationids[lc]];
                                                                    // dynamicrangeval.push(gridrowtot[locationids[lc]]);
                                                                  }
                                                                }
                                                         }
                                                    }
                                                    yindex++;
                                                }
                                            }
                                            else if(view == 3)//growth period grid table  and map
                                            {
                                              growthdatamap = new Array();
                                              arrayOfNumbers = [];
                                              postivecnt = 0;
                                              negativecnt = 0;
                                              coloshadesnegative = [];
                                              coloshades =[];
                                              loc_filter = sessionStorage.getItem("loc_filter");
                                              if(loc_filter !='')
                                              {
                                                loc_filter = loc_filter.split(",");
                                                arrayOfNumbers = loc_filter.map(Number);
                                              }
                                               dynamicrangeval = gridrowtot.filter(function(){return true;});
                                                tdindex =2;
                                                yindex = 1;
                                                zindex = 1;
                                                for(lc=0;lc<locationids.length;lc++)
                                               //for(yp = resyear[0];yp<=resyear[1];yp++)
                                                {
                                                    // locationids
                                                    proceed = 1;
                                                    if(loc_filter != '')
                                                    {
                                                      if(arrayOfNumbers.indexOf(parseInt(locationids[lc])) == -1)
                                                            {
                                                              proceed = 0;
                                                            }
                                                    }
                                                    if(proceed == 1)
                                                    {
                                                      twoyeardata = new Array();
                                                      yindex = 1;
                                                      for(yp=0;yp<resyear.length;yp++)
                                                      {
                                                        indx = resyear[yp]+""+[locationids[lc]];
                                                        indextbl = tdindex+yindex;
                                                           trdataContent[locationids[lc]].find('td:nth-child('+indextbl+')').text(new Intl.NumberFormat('en-IN').format(gridtot[indx]));
                                                           twoyeardata.push(gridtot[indx]);
                                                            yindex++;
                                                      }
                                                        grw1 = twoyeardata[1]-twoyeardata[0];
                                                        grw2 = grw1/twoyeardata[0];
                                                        grw = grw2*100;
                                                          if(grw > 0)
                                                          {
                                                            postivecnt++;
                                                          }
                                                          else
                                                          {
                                                            negativecnt++;
                                                          }
                                                           growthdatamap.push({
                                                            key1: locationids[lc],
                                                            value1:grw
                                                            });
                                                         // growthdatamap[locationids[lc]] =grw;
                                                        grw = grw.toFixed(2)+" %";
                                                      trdataContent[locationids[lc]].find('td:last').text(grw);
                                                    }
                                                  }
                                                  //map growth for split
                                                  growthdatamap.sort(function sortval(a,b){
                                                    return b.value1-a.value1;
                                                  });
                                                  coloshades = colorgenerator(negativecnt,postivecnt,coloshadesnegative,coloshades);
                                                       // console.log('gw map');
                                                       // console.log(growthdatamap);
                                                       newcolorshad  =[];
                                                       areavalue = [];
                                                    for(var j=0;j<growthdatamap.length;j++)
                                                    {
                                                      worldid=growthdatamap[j].key1;worldcount=growthdatamap[j].value1;//totalcount=t[2];
                                                      newcolorshad[worldid] = coloshades[j];
                                                      areavalue[worldid] = worldcount;
                                                      //colornegforgrowth = coloshadesnegative.length - 1;
                                                      // colorfill(mylayer,worldid,worldcount,coloshades[j]);
                                                    }
                                                    //map growth for split ends here
                                                    jquerydatatable.destroy();
                                                    jquerydatatable=  $('#example2').DataTable( {
                                                    dom: 'Bfrtip',
                                                     "scrollY":        "200px",
                                                    "scrollCollapse": true,
                                                    buttons: [
                                                      {
                                                        extend:    'excelHtml5',
                                                        text:      '<img src="../images/excel_icon.png" style="width:18px;">',
                                                        titleAttr: 'Excel'
                                                      },
                                                      {
                                                      extend:    'pdfHtml5',
                                                      text:      '<img src="../images/pdf_icon.png" style="width:14px;">',
                                                      titleAttr: 'PDF'
                                                      }
                                                    ], "order": [[ 4, "desc" ]], "paging": false
                                                    } );
                                                    colorval =[];
                                                   $.fn.dataTable.ext.search.push(
                                              function( settings, searchData, index, rowData, counter )
                                              {
                                                  proceed =1;
                                                   if(loc_filter != '')
                                                      {
                                                        if(arrayOfNumbers.indexOf(parseInt(rowData['DT_RowId'])) == -1)
                                                              {
                                                                proceed = 0;
                                                              }
                                                      }
                                                      if(proceed == 1)
                                                      {
                                                        var find = '%';
                                                        var re = new RegExp(find, 'g');
                                                        var combinddata = [];
                                                        var rowsdatane =0;
                                                        if(settings['sInstance'] == 'example2')
                                                        {
                                                          // if(chidlvlfilter.indexOf(rowData['DT_RowId']) != -1)
                                                          // {
                                                               if((resyear.length > 1) && view == 3) //growth
                                                                    {
                                                                          str = searchData[resyear.length+2].replace(re, '');
                                                                          rowsdatane = str;
                                                                          worldcount = rowsdatane;
                                                                          // console.log(worldcount);
                                                                          worldid=rowData['DT_RowId'];
                                                                          // worldid=rowData['DT_RowId'];worldcount=worldcount;totalcount=sessionStorage.getItem("totalcount");
                                                                          // percent=(worldcount/totalcount)*100;
                                                                          // console.log(datainfo[i]+"***"+i+"***"+percent);
                                                                         // colorfill(mylayer, worldid,worldcount,datainfo[i]);
                                                                          if(splitname3[0] == "6")
                                                                          {
                                                                         // colorfill(mylayer, worldid,worldcount,datainfo1[i]);
                                                                          }
                                                                          if(splitname3[0] == "2")
                                                                          {
                                                                         // colorfill(mylayer, worldid,worldcount,datainfo1[i]);
                                                                          }
                                                                          colorval[parseInt(worldid)]=percent;
                                                                          // map.fitBounds(mylayer.getBounds());
                                                                          return true;
                                                                    }
                                                                // console.log('busted');
                                                          // }
                                                        }
                                                       if(resyear.length > 1)
                                                        {
                                                        }
                                                      }
                                                   return false;
                                              }
                                              );
                                              jquerydatatable.draw();
                                              $.fn.dataTable.ext.search.pop();
                                                  map.data.setStyle(function(feature)
                                                  {
                                                    // testtt++;
                                                    if ( typeof newcolorshad[feature.getProperty('DB_ID')] != 'undefined' )
                                                    {
                                                      return({
                                                      strokeColor: '#000',
                                                      strokeOpacity: 0.8,
                                                      strokeWeight: 1,
                                                      fillColor:newcolorshad[feature.getProperty('DB_ID')],
                                                      //fillColor: colorcodeid[feature.getProperty('DB_ID')],
                                                      fillOpacity: 1
                                                      });
                                                    }
                                                    else
                                                    return ({
                                                    fillColor: 'white',
                                                    strokeWeight:1
                                                    });
                                                    // console.log(testtt);
                                                  });
                                            }
                                    }
                                }
                                else //cummalative single year
                                {
                                      // alert(view);
                                      var arrayOfNumbers =0;
                                      loc_filter = sessionStorage.getItem("loc_filter");
                                      // alert(loc_filter);
                                           if(loc_filter !='')
                                           {
                                              loc_filter = loc_filter.split(",");
                                              arrayOfNumbers = loc_filter.map(Number);
                                             // alert(arrayOfNumbers);
                                           }
                                      var var_map_filer  = sessionStorage.getItem('getstate_data');
                                      var chart_filter = sessionStorage.getItem('chartseries12');
                                      chart_filter=JSON.parse(chart_filter);
                                      unsetid = new Array();
                                      unsetid_map = new Array();
                                      set_map_color = new Array();
                                      chart_filter_dp =chart_filter;
                                      // console.log(chart_filter);
                                      for(jk=0;jk<chart_filter.length;jk++)
                                      {
                                        if(chidlvlfilter.indexOf(parseInt(chart_filter[jk]['split_id'])) == -1)
                                        {
                                          unsetid.push(jk);
                                          unsetid_map.push(parseInt(chart_filter[jk]['split_id']));
                                        }
                                        else
                                        {
                                          if (typeof  set_map_color[chart_filter[jk]['split_id']] == 'undefined')
                                          {
                                            set_map_color[chart_filter[jk]['split_id']] = chart_filter[jk]['color'];
                                          }
                                        }
                                      }
                                       maprmitms = unsetid_map;
                                      chart_filter_dp =chart_filter;
                                      for (var i = unsetid.length -1; i >= 0; i--) //unset unselected variable
                                      chart_filter_dp.splice(unsetid[i],1);
                                      loctiontotal = new Array();
                                      // alert("SDf");
                                      // console.log(chart_filter_dp);
                                      for(cf=0;cf<chart_filter_dp.length;cf++)
                                      {
                                        // console.log(chart_filter_dp[cf]['data']);
                                        if (chart_filter_dp[cf] !== null)
                                        {
                                          for(fc=0;fc<chart_filter_dp[cf]['data'].length;fc++)
                                          {
                                             if(chart_filter_dp[cf]['data'][fc] !== null)
                                             {
                                              if (typeof  loctiontotal[chart_filter_dp[cf]['data'][fc]['mydata']] == 'undefined')
                                              {
                                              loctiontotal[chart_filter_dp[cf]['data'][fc]['mydata']] = 0.0;
                                              }
                                              loctiontotal[chart_filter_dp[cf]['data'][fc]['mydata']] = loctiontotal[chart_filter_dp[cf]['data'][fc]['mydata']]+ parseFloat(chart_filter_dp[cf]['data'][fc]['y']);
                                            }
                                          }
                                        }
                                      }
                                        for(cf=0;cf<chart_filter_dp.length;cf++)
                                        {
                                          chart_filter_dp[cf]['data'] = chart_filter_dp[cf]['data'].filter(Boolean);
                                          //console.log(chart_filter_dp[cf]['data']);
                                          // chart_filter_dp[cf]['data'].filter(function(val) { return val !== null; }).join(", ");
                                        }
                                      rowsids = new Array();
                                      mapdata = sessionStorage.getItem('getstate_data');
                                      mapdata = JSON.parse(mapdata);
                                      // alert(mapdata);
                                      // alert("Sd");
                                      // console.log(set_map_color);
                                      // console.log(mapdata);
                                      testarr = mapdata;
                                      mapdata_dp = mapdata;
                                      // console.log(testarr);
                                          var total=new Array();
                                            var sum1;
                                       $.each(testarr, function(i, item)
                                        {
                                                // console.log(testarr);
                                                total[i]=0;
                                                   round=0;
                                                  $.each(testarr[i], function(j, item)
                                                  {
                                                  var value1=testarr[i][j].value;
                                                  if(round<10){
                                                  total[i] = parseInt(total[i])+parseInt(testarr[i][j].value);// sum of state
                                                  }
                                                  });
                                        });
                                        robintotal = total;
                                        sum1 = total.reduce(add, 0);// sum of all state
                                        sum1=parseInt(sum1);
                                        sessionStorage.setItem('tsum',sum1);
                                        function add(a, b) {
                                        return a + b;
                                        }
                                          // console.log(sum1);
                                          // alert("SDF");
                                          // console.log(testarr);
                                          // areavalue =[];
                                      for(k=0; k<markerscharts.length; k++)
                                      {
                                       markerscharts[k].setMap(null);
                                      }
                                      // console.log('grazy');
                                      // console.log(testarr);


                                      chartcatgrnew = new Array();
                                      chartcatgrnewT = new Array();
                                      rowstable1 = jquerydatatable.cells().nodes();
                                      // jquerydatatable.columns( { filter : 'applied'} ).data()
                                      sourcedata  = jquerydatatable.rows().nodes();
                                      trdataContent = new Array();
                                      $(sourcedata).map(function(i, cell) {
                                      trdataContent[$(cell).attr('id')] = $(cell);
                                      });
                                      // console.log(trdataContent);
                                      var cummaltivedata = 0
                                      if(view == 0 || view == 5)
                                      {
                                        cummaltivedata =1;
                                      }
                                      if(view == 0 && resyear.length == 1)//&& resyear.length == 1
                                      {
                                        rowidsdel = [];
                                        dynamicrangeval = [];
                                        // rowsids
                                        var find = ',';
                                        var re = new RegExp(find, 'g');
                                        $.each(spitdataforloc, function(i, item)
                                        {
                                          $.each(spitdataforloc[i], function(j, item)
                                          {
                                            var sumoftot = 0;
                                            $.each(spitdataforloc[i][j], function(k, item)
                                            {
                                              var checkindex = unsetid_map.indexOf(parseInt(spitdataforloc[i][j][k]['split_id']));
                                              if (checkindex > -1)
                                              {
                                              }
                                              else
                                              {
                                                ressum = spitdataforloc[i][j][k]['result'].replace(re, '');
                                                sumoftot = sumoftot+ parseFloat(ressum);
                                              }
                                            });
                                            //resultfield
                                            // alert(sumoftot);
                                            contributeshare = (sumoftot/sum1)*100;
                                            //sessionStorage.setItem("contshare",contributeshare);
                                            var resco12 = sumoftot.toString().split('.');
                                            var resco1 =resco12[0].replace(/\,/g,'');
                                            var amtcomma =moneyFormatIndia((resco1));
                                            if ( resco1[1] !== void 0 )
                                            {

                                              if(resco12[1] != undefined){
                                             amtcomma = amtcomma+'.'+resco12[1];
                                              }
                                              // else
                                              // {

                                              // }
                                            }
                                            // alert(amtcomma);
                                            // trdataContent[j].find('.resultfield').text(new Intl.NumberFormat('en-IN').format(sumoftot));
                                            trdataContent[j].find('.resultfield').text(amtcomma);
                                            // trdataContent[j].find('.contrbute_share').text(new Intl.NumberFormat('en-IN').format(contributeshare));
                                            dynamicrangeval[j] = sumoftot;
                                            rowidsdel.push(j);
                                            // dynamicrangeval.push(sumoftot);
                                            // $(trdataContent).find('#'+j+' td:last').text(new Intl.NumberFormat('en-IN').format(sumoftot));
                                            // t.row("#"+rowId).remove().draw();
                                          });
                                        });
                                          sumallvals = 0;
                                           $.each(chart_filter_dp, function(j, item)
                                           {
                                              // console.log(item['data']);
                                              //dt = item['data'];
                                              $.each(item['data'],function(l,itm)
                                              {
                                                sumallvals = sumallvals + parseFloat(itm['y']);
                                                //   //alert(itm)
                                                  // console.log(itm);
                                              });
                                           });
                                           // console.log('A');
                                           // console.log(sumallvals);
                                           //  console.log('B');
                                          // var sumres = 0;
                                          // $('.resultfield').each(function(){
                                          //  flval =  $(this).text();
                                          //  flval = flval.replace(/,/g , '');
                                          //  // alert(flval);
                                          // sumres += parseFloat(flval);  // Or this.innerHTML, this.innerText
                                          // });
                                          // alert(sumres);
                                           $('.contrbute_share').each(function(){
                                             flval =  $(this).parent().find('.resultfield').text();
                                           flval = flval.replace(/,/g , '');
                                           //console.log(flval);
                                           contribure_Sh = ((parseFloat(flval)/sumallvals)*100).toFixed(2);
                                           $(this).text(contribure_Sh);
                                          });
                                        // rowidsdel.toString();
                                        // var selector = 'tr' + makeNotEquals('id',rowidsdel);
                                        // $(selector).remove();
                                        // console.log(trdataContent);
                                        jquerydatatable.destroy();
                                         jquerydatatable=  $('#example2').DataTable( {
                                            dom: 'Bfrtip',
                                            "scrollY":        "200px",
                                            "scrollCollapse": true,
                                            buttons: [
                                              {
                                                extend:    'excelHtml5',
                                                text:      '<img src="../images/excel_icon.png" style="width:18px;">',
                                                titleAttr: 'Excel'
                                              },
                                              {
                                              extend:    'pdfHtml5',
                                              text:      '<img src="../images/pdf_icon.png" style="width:14px;">',
                                              titleAttr: 'PDF'
                                              }
                                            ], "order": [[ 2, "desc" ]], "paging": false
                                            } );
                                      }
                                      else  if(cummaltivedata == 1 && resyear.length > 1)//else  if(view == 0 && resyear.length > 1)//cummaltive more than a year
                                      {
                                        dynamicrangeval = [];
                                        var find = ',';
                                        var re = new RegExp(find, 'g');
                                        $.each(spitdataforloc, function(i, item)
                                        {
                                        // console.log(spitdataforloc[i]);
                                        var sumoftot = 0;
                                        $.each(spitdataforloc[i], function(j, item)
                                        {
                                        // console.log(spitdataforloc[i][j]);
                                        $.each(spitdataforloc[i][j], function(k, item)
                                        {
                                        // console.log(spitdataforloc[i][j][k]);
                                        var checkindex = unsetid_map.indexOf(parseInt(spitdataforloc[i][j][k]['split_id']));
                                        if (checkindex > -1)
                                        {
                                        }
                                        else
                                        {
                                        ressum = spitdataforloc[i][j][k]['result'].replace(re, '');
                                        sumoftot = sumoftot+ parseFloat(ressum);
                                        }
                                        });
                                        });
                                        trdataContent[i].find('td:last').text(new Intl.NumberFormat('en-IN').format(sumoftot));
                                        dynamicrangeval[i] = sumoftot;
                                        // dynamicrangeval.push(sumoftot);
                                        });
                                      }
                                      newcatorgiesM = new Array();
                                      $.fn.dataTable.ext.search.push(
                                      function( settings, searchData, index, rowData, counter )
                                      {
                                          if(settings['sInstance'] == 'example2')
                                          {
                                              filchk = 1;
                                                if(loc_filter != '')
                                                {
                                                    if(arrayOfNumbers.indexOf(parseInt(rowData['DT_RowId'])) == -1)
                                                    {
                                                      filchk =0;
                                                    }
                                                }
                                              //console.log();
                                              // alert(filchk);
                                              if(filchk == 1)
                                              {
                                                 newcatorgiesM[rowData['DT_RowId']]=searchData[1];
                                                var rownumber = parseInt(rowData['DT_RowId']);
                                                rowsids.push(rownumber);
                                                if (typeof  loctiontotal[rownumber] != 'undefined')
                                                {
                                                chartcatgrnew.push(rowData[1]);
                                                chartcatgrnewT[rowData['DT_RowId']] = rowData[1];
                                                return true;
                                                }
                                             }
                                          }
                                          return false;
                                      }
                                      );
                                      jquerydatatable.draw();
                                      // console.log(newcatorgiesM);
                                      // console.log(rowsids);
                                      // console.log(spitdataforloc);
                                      $.fn.dataTable.ext.search.pop();
                                      // console.log(chartcatgrnewT);
                                      // alert("1");
                                      if(chart_filter_dp.length)
                                      {
                                        //(unsetid.length){
                                        if(view ==2 || view == 1)
                                        {
                                          filter_highcharts_split_timeline(chartcatgrnew,chart_filter_dp);
                                        }
                                        else
                                        {
                                          // alert("2");
                                          // console.log(chartcatgrnewT);
                                          // alert("ASdas");
                                          // loctiontotal
                                          categoryN = new Array();
                                          categoryN1 = new Array();
                                          chart_filter_dp2 = chart_filter_dp;
                                          chart_data = [];
                                          gettotloc =[];
                                          k=0;
                                           $.each(chart_filter_dp, function(i, item)
                                           {
                                              // alert(i);
                                              // for (var j = item['data'].length; j > 0; j--)
                                              // chart_data[item]
                                               // chart_filter_dp2[i]['data']=[];
                                              for(var j=0;j<item['data'].length;j++)
                                              {
                                                if(item['data'][j] !== null){
                                                    categoryN1.push(chartcatgrnewT[item['data'][j]['mydata']]);}
                                                // if(i == 0)
                                                // {
                                                //   // console.log(item['data'][j]);
                                                //   if(item['data'][j] !== null){
                                                //     categoryN1.push(chartcatgrnewT[item['data'][j]['mydata']]);
                                                //   categoryN.push(chartcatgrnewT[item['data'][j]['mydata']]);
                                                //   }
                                                // }
                                                // chart_filter_dp2[i]
                                                filchk = 1;
                                                if(loc_filter != '')
                                                {
                                                    if(rowsids.indexOf(parseInt(item['data'][j]['mydata'])) == -1)
                                                    {
                                                      delete item['data'][j];
                                                      // item['data'].splice(item['data'][j], 1);
                                                      // filchk =0;
                                                    }
                                                    else
                                                    {
                                                       // chart_filter_dp2 [i]['data'][item['data'][j]['mydata']] = item['data'][j];
                                                      if(typeof gettotloc[item['data'][j]['mydata']] == 'undefined')
                                                      {
                                                      gettotloc[item['data'][j]['mydata']] = 0;
                                                      }
                                                      gettotloc[item['data'][j]['mydata']] = gettotloc[item['data'][j]['mydata']] + item['data'][j]['y'];
                                                    }
                                                }
                                                else
                                                {
                                                    // chart_filter_dp3[i]['data'][item['data'][j]['mydata']] = item['data'][j];
                                                    if(typeof gettotloc[item['data'][j]['mydata']] == 'undefined')
                                                    {
                                                      gettotloc[item['data'][j]['mydata']] = 0;
                                                    }
                                                    gettotloc[item['data'][j]['mydata']] = gettotloc[item['data'][j]['mydata']] + item['data'][j]['y'];
                                                }
                                              }
                                           });
                                           // console.log('categoryN1');
                                            // console.log(chart_filter_dp2);
                                            var mapped = gettotloc.map(function(el, i) {
                                            return { index: i, value: el };
                                            })
                                            // sorting the mapped array containing the reduced values
                                            mapped.sort(function(a, b) {
                                            return b.value - a.value;
                                            });
                                            // container for the resulting order
                                            var result = mapped.map(function(el){
                                            return gettotloc[el.index];
                                            });
                                         // console.log(mapped);
                                         // console.log(result);
                                              categoryN = categoryN1.filter( function( item, index, inputArray ) {
                                              return inputArray.indexOf(item) == index;
                                              });
                                          //console.log(arr);
                                          categoryN = categoryN.filter(function( element ) {
                                          return element !== undefined;
                                          });
                                          // console.log(categoryN);
                                          // console.log(chart_filter_dp);
                                          maporder = [];
                                          // order = 0;
                                          for (var key in mapped)
                                          {
                                            maporder[mapped[key].index] = key;
                                            // order++;
                                          }
                                          // chartcatgrnewT
                                          // console.log(maporder);
                                          var robintest = chart_filter_dp;
                                          // console.log('robintest');
                                          // console.log(robintest);
                                          catrevised = [];
                                          // catgcnt = 0;
                                           $.each(chart_filter_dp, function(i, item) //reseting index
                                           {
                                                item['data'] = item['data'].filter(function(){return true;});
                                                 for(var j=0;j<item['data'].length;j++)
                                                 {
                                                      item['data'][j]['x'] = parseInt(maporder[item['data'][j]['mydata']]);
                                                      catrevised.push(chartcatgrnewT[item['data'][j]['mydata']]);
                                                 }
                                              //    var cntind = 0;
                                              // for (var key in mapped)
                                              // {
                                              //   if (mapped.hasOwnProperty(key)) {
                                              //   // console.log(key, mapped[key].index);
                                              //   chartitms[mapped[key].index]['x'] = cntind;
                                              //   if(stprepr == 0){
                                              //   newcat.push(categries_array[mapped[key].index]);
                                              //   }
                                              //   cntind++
                                              //   }
                                              // }
                                              // stprepr++;
                                           });
                                           // console.log(catrevised);
                                            // console.log(chart_filter_dp);
                                            chart_filter_dp.filter(function(val) { return val !== null; }).join(", ");
                                            filter_highcharts_split(categoryN,chart_filter_dp);
                                        // charts.redraw();
                                        }
                                      }
                                      else
                                      {
                                        var chart_filter12 = sessionStorage.getItem('chartseries12');
                                        chart_filter12=JSON.parse(chart_filter12);
                                        // console.log(chart_filter12);
                                        if(view ==2 || view == 1)
                                        {
                                         filter_highcharts_split_timeline(chartcatgrnew,chart_filter_dp);
                                        }
                                        else
                                        {
                                          // alert("busted");
                                          // console.log('busted');
                                          chartcatgr = chartcatgr.filter(function( element ) {
                                          return element !== undefined;
                                          });
                                          filter_highcharts_split(chartcatgr,chart_filter12);
                                        }
                                      }

                                      $.each(testarr, function(i, item) //map load
                                      {
                                        data1=new Array();str="";sum=0;ite=0;data2=new Array();data22="[";
                                        round=0;
                                        str='<div class="info legend1">';
                                         filchk = 1;
                                            if(loc_filter != '')
                                            {
                                              // alert(arrayOfNumbers);
                                               // alert(i);
                                                if(arrayOfNumbers.indexOf(parseInt(i)) == -1)
                                                {
                                                  filchk =0;
                                                }
                                            }
                                          if(filchk == 1)
                                          {
                                            valuesar = [];
                                            colorsar=[];
                                            valuesvg =[];
                                            colorsvg = [];
                                            colorindx_r =[];
                                            colorindx_c = [];
                                            $.each(testarr[i], function(j, item)
                                            {
                                                var checkindex = unsetid_map.indexOf(parseInt(j));
                                                if (checkindex > -1) {
                                                }
                                                else
                                                {
                                                var name =testarr[i][j].name;
                                                var value=testarr[i][j].value;
                                                if(round<10)
                                                {
                                                  valuesar.push(value);
                                                  valuesvg[i] = value;

                                                  sum = parseInt(sum) + parseInt(testarr[i][j].value);
                                                  center=testarr[i][j].center.split(",");
                                                  lats= parseFloat(center[0]);
                                                  longs = parseFloat(center[1]);
                                                var fills=set_map_color[j];//getsplitcolour(parseInt(ite));
                                                // console.log()a
                                                // alert(fills);
                                                colorsar.push(fills);//for circle pie
                                                colorindx_r[j] = value;
                                                // colorindx_c[j] = fills;
                                                 colorsvg[i] = fills;//for svg map
                                                data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"' }},";
                                                center=testarr[i][j].center.split(",");
                                               // str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
                                                ite=parseInt(ite)+1;
                                                round=parseInt(round)+1;
                                                }
                                                }
                                            });
                                            str+='</div>';
                                            data22 +="]";
                                            var dataf = eval(data22);
                                            avg=(total[i]/sum1)*100;
                                            avg =parseInt(avg);
                                            // alert('d');
                                            // console.log('lazy');
                                            // console.log(set_map_color);
                                            // console.log(valuesar);
                                            // console.log(colorsar);
                                            // console.log(lats);
                                            // console.log(longs);
                                            // console.log(str);

                                            var mapped = colorindx_r.map(function(el, k) {
                                            return { index: k, value: el };
                                            })
                                            // sorting the mapped array containing the reduced values
                                            mapped.sort(function(a, b) {
                                            return b.value - a.value;
                                            });
                                            // container for the resulting order
                                            var result = mapped.map(function(el){
                                            return colorindx_r[el.index];
                                            });

                                            mapdata_svg = sessionStorage.getItem('getstate_data')
                                            mapdata_svg = JSON.parse(mapdata_svg);
                                              newxlrsvg = [];
                                              $.each(mapped, function(m, item)
                                              {

                                                    if(typeof item != 'undefined')
                                                    newxlrsvg.push(mapdata_svg[i][item.index].colr);
                                              });
                                              //   if($("input[name=type]:checked").val()=="circle")
                                              // {

                                              //           alert("keerthana");
                                              //   //setsplitmarker(valuesar,colorsar,lats,longs,str,presentkey[0]);
                                              // }

                                            // paramarr = [];
                                            // paramarr.push(valuesvg);
                                            // paramarr.push(colorsvg);
                                            // alert('d');


                                            // for(var t=0;t<charts.series.length;t++)
                                            // {
                                            //     newxlrsvg.push(charts.series[t].color);
                                            // }
                                            // console.log(charts.series);
                                            // console.log(newxlrsvg);
                                            if(newxlrsvg.length != 0)
                                            {
                                              newxlrsvg = newxlrsvg.reverse();
                                              filter_svg_color(valuesar,newxlrsvg,str,i);

                                            }
                                            //,mapped,set_map_color
                                            // filter_svg_color(valuesvg,colorsvg,str,i);

                                            // setsplitmarker(valuesar,colorsar,lats,longs,str,""); //circle pie charter

                                            // charrr =  L.piechartMarker(
                                            // L.latLng([center[0],center[1]]),
                                            // {
                                            // radius:getradious(avg,splitname3[0]),
                                            // data: dataf
                                            // }
                                            // ).addTo(map);
                                            // piechartmarker.push(charrr);
                                            // charrr.bindPopup(str);
                                          }
                                      });
                                }
                                // spitdataforloc
                            }
                            else if( $('#byrange1').length > 0)//range
                            {
                              // sessionStorage.getItem("range_filter",'rangefilloc');
                              if(comb == 'C')
                              {
                                      rangefilloc = new Array();
                                      // var defaultStyle={
                                      // fillColor: "00FFFFFF",
                                      // weight: 1,
                                      // opacity: 1,
                                      // color: "#000000",
                                      // fillOpacity:0.0
                                      // };
                                      // mylayer.setStyle(defaultStyle);
                                      var relevel ='';
                                      cnt =0;
                                      var locarray = [];
                                      jsonObj = [];
                                      var color =[];
                                      var oneArray =[];
                                      var colors = [];
                                      var combinddata =[];jl=0;
                                        var colorlocid = new Array();
                                        var colorlocid1=new Array();
                                        var dict = new Array();
                                        areavalue =[];
                                      $.fn.dataTable.ext.search.push(
                                      function( settings, searchData, index, rowData, counter ) {
                                      var min =$('#byrange1').val(); // 4844423.64 parseInt( 4844423.64, 10 );
                                      var max =$('#byrange2').val(); //parseInt( 51958474.79, 10 );
                                      // console.log(searchData);
                                      var find = ',';
                                      var re = new RegExp(find, 'g');
                                       if(resyear.length > 1 && view ==5)
                                       {
                                          str = searchData[1].replace(re, '');
                                       }
                                     else if(resyear.length > 1 && view !=0)
                                      {
                                      rangeindex =resyear.length+1
                                      str = searchData[rangeindex].replace(re, '');
                                      }
                                      else
                                      {
                                      // console.log("else");
                                      str = searchData[1].replace(re, '');
                                      }
                                      rowsdatane = str;
                                      // console.log(rowData['DT_RowId']);
                                      //alert(settings);
                                      var age = parseFloat( str ) || 0; // using the data from the 4th
                                      if ( ( isNaN( min ) && isNaN( max ) ) ||
                                      ( isNaN( min ) && age <= max ) ||
                                      ( min <= age   && isNaN( max ) ) ||
                                      ( min <= age   && age <= max ) )
                                      {
                                         rangefilloc.push(rowData['DT_RowId']);
                                      worldcount = rowsdatane;
                                      worldid=rowData['DT_RowId'];worldcount=worldcount;totalcount=sessionStorage.getItem("totalcount");
                                      percent=(worldcount/totalcount)*100;
                                         //keerthana
                                          dict.push({
                                           key1: worldid,
                                             value1: worldcount
                                          });
                                          colorstore.push(worldcount);
                                          colorlocid.push(worldid);
                                          areavalue[rowData['DT_RowId']] =  worldcount;
                                      jl++;
                                      loc_filter = rangefilloc;
                                      loc_filter = loc_filter.toString();
                                      sessionStorage.setItem("loc_filter",loc_filter);
                                      //
                                      if(resyear.length > 1 && view !=0 && view !=5)
                                      {
                                        // for(jk=1;jk<=resyear.length;jk++)
                                        // {
                                        // str = searchData[jk].replace(re, '');
                                        // rowsdatane = parseFloat(rowsdatane)+parseFloat(str);
                                        // combinddata.push(parseFloat(str));
                                        // }
                                          cnt =0;
                                                            if (view ==2){
                                                           for(j=resyear[0];j<=resyear[1];j++)
                                                           {
                                                              cnt++;
                                                           }
                                                           }
                                                           else
                                                           {
                                                              cnt = resyear.length;
                                                           }
                                                         for(jk=1;jk<=cnt;jk++)
                                                          {
                                                             str = searchData[jk].replace(re, '');
                                                             rowsdatane = parseFloat(rowsdatane)+parseFloat(str);
                                                             combinddata.push(parseFloat(str));
                                                          }
                                      }
                                      if(resyear.length > 1 && view !=0 && view !=5)
                                      {
                                        item ={};
                                        item ["name"] = searchData[0];
                                        item ["data"] = combinddata;
                                        jsonObj.push(item);
                                        // colors.push(getsplitcolourchart(percent));
                                      }
                                      else
                                      {
                                        locarray.push(rowData[0]);
                                        oneArray.push(worldcount);
                                        item ={};
                                        item ["0"] = 0;
                                        item ["y"] = parseFloat(worldcount);
                                        item ["mydata"] = rowData['DT_RowId'];
                                        // item["color"]=colorcount(percent);
                                        jsonObj.push(item);
                                      //colors.push(colorcount(percent));
                                      }
                                      combinddata =[];
                                      // return true;
                                      return true;
                                      }
                                      return false;
                                      }
                                      );
                                      jquerydatatable.draw();
                                      $.fn.dataTable.ext.search.pop();
                                      //code by keerthana
                                       // for (var i=0; i < colorstore.length-1; i++)
                                       //    {
                                       //        if (colorstore[i] < colorstore[i+1])
                                       //        {
                                       //          temp = colorstore[i];
                                       //          colorstore[i] = colorstore[i+1];
                                       //          colorstore[i+1] = temp;
                                       //          temp1 =colorlocid[i];
                                       //          colorlocid[i] = colorlocid[i+1];
                                       //          colorlocid[i+1] = temp1;
                                       //        }
                                       //    }
                                      dict.sort(function sortval(a,b){
                                         return parseFloat(b.value1)-parseFloat(a.value1);
                                                       });
                                      coloshades =[];
                                      coloshadesnegative = [];
                                      color_arry = [];
                                       flyingcolors = colorgradientcreation(colorstore,'1');
                                      coloshades = flyingcolors[0];
                                      coloshadesnegative = flyingcolors[1];
                                      j=0;
                                      jk =0;
                                      // for (var i=0; i < colorstore.length; i++)
                                      // {
                                        newcolorshad =[];
                                      for (i=0;i<dict.length;i++)
                                         {
                                            if(colorstore[i] < 0 )
                                            {
                                              color_arry.push(coloshadesnegative[j]);
                                              newcolorshad[dict[i].key1] = coloshadesnegative[j];
                                               j++;
                                            }
                                            else
                                            {
                                              color_arry.push(coloshades[jk]);
                                                newcolorshad[dict[i].key1] = coloshades[jk];
                                               jk++;
                                            }
                                          }
                                      // console.log(jsonObj);
                                      title2 = 'Total Sales in Rs';
                                      if(rangefilloc.length > 5)
                                      {
                                      minmax=" min : 1,max : 10,";
                                      }
                                      else
                                      {
                                      minmax="";
                                      }
                                      // console.log(relevel);
                                      // console.log(jsonc);
                                      //  console.log(jk);
                                      jsonObj1 = [];
                                      item1 ={};
                                      item1["showInLegend"] = "false";
                                      item1["name"] = "title";//"Bevrgs,Deodorant";
                                      item1["data"] = jsonObj;
                                      jk = jsonObj1.push(item1)
                                      if(resyear.length>1 && view !=0 && view !=5)
                                      {
                                       typechart = "line";
                                      }
                                      else
                                      {
                                       typechart = "column";
                                      }
                                      if(resyear.length > 1 && view !=0 && view !=5)
                                      {
                                          yrs = [];
                                        if (view ==2)
                                        {
                                          for(j=resyear[0];j<=resyear[1];j++)
                                          {
                                            yrs.push(j);
                                          }
                                        }
                                        else
                                        {
                                           yrs = resyear;
                                        }
                                      filterhighchart_time(typechart," Sales",splitname3[0],yrs,jsonObj,colors,minmax);
                                      }
                                      else
                                      {
                                        console.log(jsonObj);
                                       // colors = color_arry;
                                        //color_arry=[];
                                        // alert(color_arry);
                                      filterhighchart(typechart," Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                       //chartsingle.update({ colors: color_arry });
                                       color_arry = [];
                                      }
                                      rangefilloc = rangefilloc.toString();
                                      sessionStorage.setItem("range_filter",'rangefilloc');
                                      if(circle==0)
                                       {
                                          map.data.setStyle(function(feature)
                                          {
                                            // testtt++;
                                            if ( typeof newcolorshad[feature.getProperty('DB_ID')] != 'undefined' )
                                            {
                                              return({
                                              strokeColor: '#000',
                                              strokeOpacity: 0.8,
                                              strokeWeight: 1,
                                              fillColor:newcolorshad[feature.getProperty('DB_ID')],
                                              //fillColor: colorcodeid[feature.getProperty('DB_ID')],
                                              fillOpacity: 1
                                              });
                                            }
                                            else
                                            return ({
                                            fillColor: 'white',
                                            strokeWeight:0.5
                                            });
                                            // console.log(testtt);
                                          });
                                      }
                                      else
                                      {
                                        // alert("circle");
                                        removeAllcircles();
                                        // alert(file);
                                        filter_circle(file,dict);
                                        // console.log(worldid);
                                        // console.log( areavalue);
                                        //console.log(dict);
                                      }
                              }
                              else
                              {
                                var chidlvlfilter = [];
                                // for (i = 0; i < piechartmarker.length; i++) {
                                // map.removeLayer(piechartmarker[i]);
                                // }
                                  areavalue =[];
                                  for(k=0; k<markerscharts.length; k++){
                                  markerscharts[k].setMap(null);
                                  }
                                  categries = [];
                                  categrieslist = [];
                                  mapdata = sessionStorage.getItem('getstate_data')
                                  mapdata = JSON.parse(mapdata);
                                  mapnewdata = [];
                                  var relevel ='';
                                $.fn.dataTable.ext.search.push(
                                    function( settings, searchData, index, rowData, counter ) {
                                    var min =$('#byrange1').val(); // 4844423.64 parseInt( 4844423.64, 10 );
                                    var max =$('#byrange2').val(); //parseInt( 51958474.79, 10 );
                                      var find = ',';
                                      var re = new RegExp(find, 'g');
                                      if(resyear.length > 1 && view !=0 && view !=5)
                                      {
                                        rangeindex =resyear.length+2
                                        str = searchData[rangeindex].replace(re, '');
                                      }
                                      else
                                      {
                                          str = searchData[2].replace(re, '');
                                      }
                                      rowsdatane = str;
                                      // console.log(rowData['DT_RowId']);
                                    var age = parseFloat( str ) || 0; // using the data from the 4th
                                    if ( ( isNaN( min ) && isNaN( max ) ) ||
                                    ( isNaN( min ) && age <= max ) ||
                                    ( min <= age   && isNaN( max ) ) ||
                                    ( min <= age   && age <= max ) )
                                    {
                                        categries.push(rowData[1]);
                                        categrieslist[rowData['DT_RowId']] = rowData[1];
                                        mapnewdata[rowData['DT_RowId']] = mapdata[rowData['DT_RowId']];
                                        chidlvlfilter.push(rowData['DT_RowId']);
                                         return true;
                                    }
                                    return false;
                                    }
                                  );
                                jquerydatatable.draw();
                                $.fn.dataTable.ext.search.pop();

                                testarray = [];
                                vt = sessionStorage.getItem('chartseries12');
                                vat = JSON.parse(vt);
                                var chartdupseries = vat;
                                  loc_filter = chidlvlfilter;
                                  loc_filter = loc_filter.toString();
                                  sessionStorage.setItem("loc_filter",loc_filter);
                                vt = sessionStorage.getItem('chartseries12');
                                vat = JSON.parse(vt);
                                // console.log(vat);
                                variable_fil = sessionStorage.getItem("variable_fiter");
                                if(variable_fil !='')
                                {
                                  variable_fil = variable_fil.split(',');
                                }
                                testarr= mapnewdata;
                                testarr = testarr.filter(function(n){ return n != undefined });
                               // console.log(variable_fil);
                               // alert("sfsdf");
                                // console.log(testarr);
                                 var total=new Array();
                                            var sum1;
                                      $.each(testarr, function(i, item)
                                        {
                                          // console.log(testarr);
                                            total[i]=0;
                                               round=0;
                                              $.each(testarr[i], function(j, item)
                                              {
                                                var value1=testarr[i][j].value;
                                                if(round<10){
                                                total[i] = parseInt(total[i])+parseInt(testarr[i][j].value);// sum of state
                                                }
                                              });
                                        });
                                      sum1 = total.reduce(add, 0);// sum of all state
                                      sum1=parseInt(sum1);
                                      function add(a, b) {
                                      return a + b;
                                      }
                                                // console.log(sum1);
                                    $.each(testarr, function(i, item)
                                    {
                                      valuesar = [];
                                      colorsar=[];
                                      data1=new Array();str="";sum=0;ite=0;data2=new Array();data22="[";
                                      round=0;
                                      str='<div class="info legend1">';
                                      if(variable_fil != '') //checking variable filter ,if so following loop wil excuted
                                      {
                                        $.each(testarr[i], function(j, item)
                                        {
                                          if(variable_fil.indexOf(j) != -1){
                                          var name =testarr[i][j].name;
                                          var value=testarr[i][j].value;
                                          if(round<10)
                                          {
                                             valuesar.push(value);
                                            sum = parseInt(sum) + parseInt(testarr[i][j].value);
                                            var fills=getsplitcolour(parseInt(ite));
                                            colorsar.push(fills);
                                            data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"' }},";
                                            center=testarr[i][j].center.split(",");
                                            lats= parseFloat(center[0]);
                                            longs = parseFloat(center[1]);
                                           // str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
                                            ite=parseInt(ite)+1;
                                            round=parseInt(round)+1;
                                          }
                                          }
                                        });
                                      }
                                      else
                                      {
                                        $.each(testarr[i], function(j, item)
                                        {
                                          // if(variable_fil.indexOf(j) != -1){
                                          var name =testarr[i][j].name;
                                          var value=testarr[i][j].value;
                                          if(round<10)
                                          {
                                            valuesar.push(value);
                                            sum = parseInt(sum) + parseInt(testarr[i][j].value);
                                            var fills=getsplitcolour(parseInt(ite));
                                             colorsar.push(fills);
                                            data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"' }},";
                                            center=testarr[i][j].center.split(",");
                                              lats= parseFloat(center[0]);
                                            longs = parseFloat(center[1]);
                                            //str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
                                            ite=parseInt(ite)+1;
                                            round=parseInt(round)+1;
                                          }
                                          // }
                                        });
                                      }
                                      str+='</div>';
                                      data22 +="]";
                                      var dataf = eval(data22);
                                       avg=(total[i]/sum1)*100;
                                      avg =parseInt(avg);
                                      // console.log('valuesar');
                                      // setsplitmarker(valuesar,colorsar,lats,longs,str,"");//call for circel pie ,,currently hidden due to svg
                                    });
                                  if(resyear.length > 1 && view != 0 && view != 5) //timeseries
                                  {
                                      spitdata = JSON.parse(splitarray);
                                      split_dts = sessionStorage.getItem('split_dts');
                                      split_dts = $.parseJSON(split_dts);
                                      objitems =  JSON.parse(itemobj);
                                      // console.log(spitdata);
                                      // console.log(chartseries);
                                      // console.log(split_dts);
                                      var sumyear = [],cols = 2;
                                      objitems =  JSON.parse(itemobj);
                                      item_name = [];
                                      for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                          if(view == 2)//continues period
                                          {
                                              for(yp = resyear[0];yp<=resyear[1];yp++)
                                              {
                                               for(sp = 0;sp<objitems.length;sp++)
                                                {
                                                    split_dts = objitems[sp].split('/');
                                                    splitname = split_dts[1];
                                                    split_dts = split_dts[0];
                                                    var find = ',';
                                                    var re = new RegExp(find, 'g');
                                                    // console.log(chidlvlfilter[chf]+" // "+yp+" // "+split_dts);
                                                    // console.log(typeof spitdata[chidlvlfilter[chf]][yp][split_dts]['result']);
                                                    try{
                                                      str = spitdata[chidlvlfilter[chf]][yp][split_dts]['result'].replace(re, '');
                                                       str = parseFloat(str);
                                                       ind = ""+yp+split_dts;
                                                       if(isNaN(sumyear[ind]))
                                                      {
                                                        sumyear[ind] =  str;
                                                        item_name[ind] = splitname;//split_dts[sp]['name'];
                                                      }
                                                      else
                                                      {
                                                        sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                      }
                                                    }
                                                     catch(e)
                                                     {
                                                       ind = ""+yp+split_dts;
                                                         if(isNaN(sumyear[ind]))
                                                        {
                                                          sumyear[ind] =  0;
                                                          item_name[ind] = splitname;//split_dts[sp]['name'];
                                                        }
                                                        else
                                                        {
                                                          sumyear[ind] = parseFloat(sumyear[ind])+ 0;
                                                        }
                                                     }
                                                }
                                              }
                                          }
                                          else if(view == 3)//mixed period
                                          {
                                            for(yp = 0;yp<resyear.length;yp++)
                                            {
                                             for(sp = 0;sp<objitems.length;sp++)
                                              {
                                                   split_dts = objitems[sp].split('/');
                                                    splitname = split_dts[1];
                                                    split_dts = split_dts[0];
                                                  var find = ',';
                                                  var re = new RegExp(find, 'g');
                                                  str = spitdata[chidlvlfilter[chf]][resyear[yp]][split_dts[sp]['refid']]['result'].replace(re, '');
                                                  str = parseFloat(str);
                                                   ind = ""+resyear[yp]+split_dts[sp]['refid'];
                                                  if(isNaN(sumyear[ind]))
                                                  {
                                                    sumyear[ind] =  str;
                                                    item_name[ind] = split_dts[sp]['name'];
                                                  }
                                                  else
                                                  {
                                                    sumyear[ind] = parseFloat(sumyear[ind])+ str;
                                                  }
                                                }
                                            }
                                          }
                                        }
                                        // console.log(sumyear);
                                        finalres = new Array();
                                        for(i=0;i<objitems.length;i++)
                                        {
                                           split_dts = objitems[i].split('/');
                                                    split_dts = split_dts[0];
                                                    chartfill = 0;
                                             if(variable_fil != '')
                                             {
                                                  if(variable_fil.indexOf(split_dts) == -1)
                                                  {
                                                      chartfill = 1;
                                                     // unsetitemchart.push(chs);
                                                       // unsetchartitem =
                                                  }
                                             }
                                          if(chartfill == 0)
                                          {
                                            newresultarr = new Array();
                                            if(view == 2)
                                            {
                                              for(j = resyear[0];j<=resyear[1];j++)
                                              {
                                                    indx = j+split_dts;//j+split_dts[i]['refid'];
                                                    newresultarr.push(parseFloat(sumyear[indx]));
                                              }
                                              item2 ={};
                                              item2["name"] = item_name[indx];
                                              item2["data"] = newresultarr;
                                              finalres.push(item2);
                                            }
                                            else
                                            {
                                              for(j=0;j<resyear.length;j++)
                                              {
                                                    indx = resyear[j]+split_dts[i]['refid'];
                                                    newresultarr.push(sumyear[indx].toFixed(2));
                                              }
                                              item2 ={};
                                              item2["name"] = item_name[indx];
                                              item2["data"] = newresultarr;
                                              finalres.push(item2);
                                            }
                                          }
                                        }
                                        // console.log(finalres);
                                        // for(i=0;i<split_dts.length;i++)
                                        // {
                                        //   newresultarr = new Array();
                                        //   if(view == 2)
                                        //   {
                                        //     for(j = resyear[0];j<=resyear[1];j++)
                                        //     {
                                        //           indx = j+split_dts[i]['refid'];
                                        //           newresultarr.push(parseFloat(sumyear[indx]));
                                        //     }
                                        //     item2 ={};
                                        //     item2["name"] = item_name[indx];
                                        //     item2["data"] = newresultarr;
                                        //     finalres.push(item2);
                                        //   }
                                        //   else
                                        //   {
                                        //     for(j=0;j<resyear.length;j++)
                                        //     {
                                        //           indx = resyear[j]+split_dts[i]['refid'];
                                        //           newresultarr.push(sumyear[indx].toFixed(2));
                                        //     }
                                        //     item2 ={};
                                        //     item2["name"] = item_name[indx];
                                        //     item2["data"] = newresultarr;
                                        //     finalres.push(item2);
                                        //   }
                                        // } //09102017
                                        // console.log(resyear);
                                        // console.log(finalres);
                                        filter_highcharts_split_timeline(resyear,finalres);
                                        // alert("sdf");
                                        // alert("sdf");
                                  }
                                  else
                                  {
                                    // console.log('variable_fil');
                                    // console.log(variable_fil);
                                    unsetitemchart = new Array();
                                    gettotloc =[];
                                    // console.log(chartseries);
                                    for(chs=0;chs<chartseries.length;chs++)
                                    {
                                      chartfill = 0;
                                       if(variable_fil != '')
                                       {
                                            if(variable_fil.indexOf(chartseries[chs]['split_id'].toString()) == -1)
                                            {
                                                chartfill = 1;
                                                unsetitemchart.push(chs);
                                                 // unsetchartitem =
                                            }
                                       }
                                       // alert(chartseries[chs]['split_id']+" // "+chartfill);
                                      if(chartfill == 0)
                                      {
                                        chartitms = chartseries[chs]['data'];
                                        // console.log('marvel');
                                        // console.log(chidlvlfilter);
                                        // console.log(chartitms);
                                        var incindex =0;
                                        for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                          temparv = (chartitms.filter(function (person) {
                                          if(person !== null){ return person.mydata == chidlvlfilter[chf] }}));
                                             if(typeof temparv[0] !== 'undefined'){
                                                  // console.log('AAAa');
                                                 // console.log(temparv[0]);
                                                  if(typeof gettotloc[temparv[0]['mydata']] == 'undefined')
                                                  {
                                                    gettotloc[temparv[0]['mydata']] = 0;
                                                  }
                                                 // console.log(temparv[0]);
                                                gettotloc[temparv[0]['mydata']] =  temparv[0]['y'];
                                                temparv[0]['x'] = incindex;
                                                // console.log(temparv[0]);
                                                testarray.push(temparv[0]);
                                                incindex++;
                                              }
                                        }
                                        testarray = testarray.filter(Boolean);
                                        // for(var kk=0;kk<testarray.length;kk++)
                                        // {
                                        //     if(typeof gettotloc[testarray[kk]['mydata']] == 'undefined')
                                        //     {
                                        //       gettotloc[testarray[kk]['mydata']] = 0;
                                        //     }
                                        //    gettotloc[testarray[kk]['mydata']] = gettotloc[testarray[kk]['mydata']]+testarray[kk]['y'];
                                        // }
                                        // console.log(testarray);
                                        chartdupseries[chs]['data'] = testarray;
                                        testarray = [];
                                      }
                                    }
                                    // console.log('gettotloc');
                                    // console.log(unsetitemchart);
                                    // // console.log(gettotloc);
                                    var mapped = gettotloc.map(function(el, i) {
                                    return { index: i, value: el };
                                    })
                                    // sorting the mapped array containing the reduced values
                                    mapped.sort(function(a, b) {
                                    return b.value - a.value;
                                    });
                                    maporder = [];
                                    // order = 0;
                                    for (var key in mapped)
                                    {
                                      maporder[ mapped[key].index] = key;
                                      // order++;
                                    }
                                    // // categrieslist
                                    // console.log('unsetitemchart');
                                    // console.log(mapped);
                                    for(h=0;h<unsetitemchart.length;h++)
                                    {
                                       // chartdupseries.splice(unsetitemchart[h], 1);
                                       delete chartdupseries[unsetitemchart[h]];
                                       // delete chartdupseries[unsetitemchart[h]];
                                    }
                                    var compactArray = chartdupseries.filter(function (item) {
                                    return item !== undefined;
                                    });
                                   chartdupseries = compactArray;
                                    // categoryrevis = [];
                                    // for(chs=0;chs<chartdupseries.length;chs++)
                                    // {
                                    //        //   // categrieslist
                                    //   for(jk=0;jk<chartdupseries[chs]['data'].length;jk++)
                                    //   {
                                    //     if(categoryrevis.indexOf(categrieslist[chartdupseries[chs]['data'][jk]['mydata']]) == -1)
                                    //     {
                                    //          //     // element found3
                                    //        chartdupseries[chs]['data'][jk]['x'] = maporder[chartdupseries[chs]['data'][jk]['x']];
                                    //       categoryrevis.push(categrieslist[chartdupseries[chs]['data'][jk]['mydata']]);
                                    //     }
                                    //   }
                                    // }
                                    // console.log('thanos');
                                    // console.log(chartdupseries);
                                    // console.log(categries);
                                    filter_highcharts_split(categries,chartdupseries);//(categries,chartdupseries);
                                  }

                                  //svg filer range

                                   locidsvg = Object.keys(mapdata);
                                      for(jk=0;jk<locidsvg.length;jk++)
                                      {
                                        if(chidlvlfilter.indexOf(locidsvg[jk]) == -1)
                                        {
                                          $('#solids'+locidsvg[jk]).html('<!--'+$('#solids'+locidsvg[jk]).html()+'--!>');
                                        }
                                        else
                                        {
                                              str = $('#solids'+locidsvg[jk]).html();
                                              str = str.replace("<!--", "");
                                              str = str.replace("--!>", "");
                                              $('#solids'+locidsvg[jk]).html(str);
                                        }

                                      }

                                        //svg filer range ends here


                              }
                              updaterange();
                            }
                            else if( $('#byrank1').length > 0)//rank
                            {
                              sessionStorage.getItem("rank_filter",'');
                              rank1=$('#byrank1').val();
                              rank2=$('#byrank2').val();
                              tablcolmns = jquerydatatable.columns( { filter : 'applied'} ).data();//jquerydatatable.columns().data();
                              // console.log(tablcolmns);
                              var arrayint = [];
                              if((resyear.length > 1) && view == 0)
                              {
                                var arr = tablcolmns[1];
                              }
                              else if((resyear.length > 1) && view == 5)
                              {
                                var arr = tablcolmns[1];
                              }
                              else if(resyear.length > 1)
                              {
                                 var arrindex = 1+resyear.length
                                 var arr = tablcolmns[arrindex];
                              }
                              else
                              {
                                 var arr = tablcolmns[1];
                              }
                              // console.log(arr);
                              for(jk=0;jk<arr.length;jk++)
                              {
                                var find = ',';
                                var re = new RegExp(find, 'g');
                                arr[jk] = arr[jk].replace(re, '');
                                arrayint.push(parseFloat(arr[jk]));
                              }
                              arrayint.sort(sortFloat);
                              var ranks = $.grep(arrayint, function(item, idx) {
                              return item != arrayint[idx - 1];
                              }).reverse();
                              var rankdet = [];
                              $.each(arrayint, function(idx, item) {
                                var rank= $.inArray( item, ranks)+1;
                                if (rank >= rank1 && rank <= rank2)
                                {
                                  rankdet.push(item);
                                }
                                //console.log('Rank of '+item+ ' is '+ rank+'<br>');
                              });
                              // console.log(rankdet);
                              if((resyear.length > 1) && view ==3)
                              {
                                 var find = '%';
                              }
                              else
                              {
                                 var find = ',';
                              }
                              var colors = new Array();
                                 var locarray = [];
                              jsonObj = [];
                              var color =[];
                              var oneArray =[];
                              // var defaultStyle={
                              // fillColor: "00FFFFFF",
                              // weight: 1,
                              // opacity: 1,
                              // color: "#000000",
                              // fillOpacity:0.0
                              // };
                              // mylayer.setStyle(defaultStyle);
                              combinddata =[];jv=0;
                              rankfilterArr = new Array();
                              // locfilter = sessionStorage.getItem("loc_filter");
                              // if(locfilter != '')
                              // {
                              //   locfilter = locfilter.split(',');
                              // }
                              // alert(locfilter);
                              var colorlocid1=new Array();
                               var colorlocid=new Array();
                               var dict = new Array();
                               var getlocbasedchar = [];
                                areavalue =[];
                              $.fn.dataTable.ext.search.push(
                              function( settings, searchData, index, rowData, counter ) {
                              // console.log(rowData[1]);
                              var re = new RegExp(find, 'g');
                              if((resyear.length > 1) && view == 3)
                               {
                                    var arrindex = 1+resyear.length
                                    rowsdatane = rowData[arrindex].replace(re, '');
                               }
                              else if((resyear.length > 1) && view == 0)
                                {
                                  rowsdatane = rowData[1].replace(re, '');
                                }
                                else if((resyear.length > 1) && view == 5)
                                {
                                  rowsdatane = rowData[1].replace(re, '');
                                }
                              else if(resyear.length > 1)
                              {
                                var arrindex = 1+resyear.length
                                rowsdatane = rowData[arrindex].replace(re, '');
                              }
                              else
                              {
                                 rowsdatane = rowData[1].replace(re, '');
                              }
                              if(settings['sInstance'] == 'example19')
                              {
                                getlocbasedchar[rowData['DT_RowId']] =rowData[0];
                                if(rankdet.indexOf(parseFloat(rowsdatane)) != -1)
                                {
                                                rankfilterArr.push(rowData['DT_RowId']);
                                                if((resyear.length > 1) && view == 3)
                                                  {
                                                        str = searchData[resyear.length+1].replace(re, '');
                                                        rowsdatane = str;
                                                  }
                                                else if((resyear.length > 1) && view !=0)
                                                  {
                                                     if(view != 5)
                                                     {
                                                        cnt =0;
                                                        if (view ==2){
                                                        for(j=resyear[0];j<=resyear[1];j++)
                                                        {
                                                         cnt++;
                                                        }
                                                        }
                                                        else
                                                        {
                                                        cnt = resyear.length;
                                                        }
                                                        for(jk=1;jk<=cnt;jk++)
                                                         {
                                                        str = searchData[jk].replace(re, '');
                                                          combinddata.push(parseFloat(str));
                                                        }
                                                      }
                                                  }
                                                 worldcount = rowsdatane;
                                                 areavalue[rowData['DT_RowId']] =  worldcount;
                                                worldid=rowData['DT_RowId'];worldcount=worldcount;totalcount=sessionStorage.getItem("totalcount");
                                                percent=(worldcount/totalcount)*100;
                                              //keerthana
                                                        dict.push({
                                         key1: worldid,
                                           value1: worldcount
                                        });
                                             colorstore.push(worldcount);
                                              colorlocid.push(worldid);
                                                jv++;
                                                if((resyear.length > 1) && view == 3)
                                                    {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                      // console.log(percent+" Pre");
                                                        // item["color"]=colorcount(percent);
                                                      jsonObj.push(item);
                                                     // colors.push(colorcount(percent));
                                                    }
                                                  else if((resyear.length > 1) && view == 5)
                                                  {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                        // item["color"]=colorcount(percent);
                                                      jsonObj.push(item);
                                                     // colors.push(colorcount(percent));
                                                  }
                                                 else if(resyear.length > 1 && view !=0)
                                                  {
                                                      // locarray.push(rowData[0]);
                                                      // oneArray.push(worldcount);
                                                      item ={};
                                                      item ["name"] = searchData[0];
                                                      // item ["y"] = parseFloat(worldcount);
                                                      item ["data"] = combinddata;
                                                      jsonObj.push(item);
                                                      //colors.push(getsplitcolourchart(percent));
                                                      // console.log(combinddata);
                                                      // alert("i m");
                                                  }
                                                  else
                                                  {
                                                      locarray.push(rowData[0]);
                                                      oneArray.push(worldcount);
                                                      item ={};
                                                      item ["0"] = 0;
                                                      item ["y"] = parseFloat(worldcount);
                                                      item ["mydata"] = rowData['DT_RowId'];
                                                        // item["color"]=colorcount(percent);
                                                      jsonObj.push(item);
                                                     // colors.push(colorcount(percent));
                                                  }
                                                combinddata =[];
                                                return true;
                                }
                              }
                              return false;
                              }
                              );
                               //alert("busted "+rankfilterArr);
                               //console.log(rankfilterArr);
                              // loc_filter = rankfilterArr;
                              // loc_filter = loc_filter.toString();
                              // sessionStorage.setItem("loc_filter",loc_filter);
                              jquerydatatable.draw();
                              $.fn.dataTable.ext.search.pop();
                               jsonObj = jsonObj.sort(function(a,b) {
                                    return b['y'] - a['y'];
                                    });
                                      dict.sort(function sortval(a,b){
                                      return parseFloat(b.value1)-parseFloat(a.value1);
                                      });
                                      coloshades =[];
                                      coloshadesnegative = [];
                                      color_arry = [];
                                      j=0;
                                      jk =0;
                                       flyingcolors = colorgradientcreation(colorstore,'1');
                                      coloshades = flyingcolors[0];
                                      coloshadesnegative = flyingcolors[1];
                                      // console.log(flyingcolors);
                                      // for (var i=0; i < colorstore.length; i++)
                                      // {
                                      if(view == 3)
                                      {
                                        j = coloshadesnegative.length-1;
                                      }
                                      locarray=[];
                                      // console.log('A');
                                      // console.log(getlocbasedchar);
                                      // console.log('B');
                                      newcolorshad = [];
                                    for (i=0;i<dict.length;i++)
                                       {
                                          locarray.push(getlocbasedchar[dict[i].key1]);
                                            //  key[i] = dict[i].key1;
                                            // value[i]=dict[i].value1;
                                        if(dict[i].value1 < 0 )
                                        {
                                          newcolorshad[dict[i].key1] = coloshadesnegative[j];
                                          color_arry.push(coloshadesnegative[j]);
                                           // colorfill(mylayer, dict[i].key1,dict[i].value1,coloshadesnegative[j]);
                                           if(view == 3)
                                            {
                                              j--;
                                            }
                                            else
                                            {
                                              j++;
                                            }
                                        }
                                        else
                                        {
                                           newcolorshad[dict[i].key1] = coloshades[jk];
                                          color_arry.push(coloshades[jk]);
                                          // alert(coloshades);
                                           // colorfill(mylayer, dict[i].key1,dict[i].value1,coloshades[jk]);
                                           jk++;
                                        }
                                        //colors = color_arry;
                                       // colorfill(mylayer, colorlocid[i],colorstore[i],datainfo[i]);
                                      }
                                      colorlocid = [];
                                      colorstore = [];
                              if(rankfilterArr.length > 5)
                              {
                                minmax=" min : 1,max : 10,";
                              }
                              else
                              {
                               minmax="";
                              }
                              // alert(minmax);
                                jsonObj1 = [];
                                item1 ={};
                                item1["showInLegend"] = "false";
                                item1["name"] = "test";//"Bevrgs,Deodorant";
                                item1["data"] = jsonObj;
                                jk = jsonObj1.push(item1)
                                // console.log(jsonObj1);
                                   if(resyear.length>1 && view ==5)
                                   {
                                       typechart = "column";
                                   }
                                   else if(resyear.length>1 && view !=0)
                                    {
                                      typechart = "line";
                                    }
                                    else
                                    {
                                      typechart = "column";
                                    }
                                     if(resyear.length > 1 && view ==3)
                                     {
                                         filterhighchart("column"," Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                         color_arry = [];
                                     }
                                     else if(resyear.length > 1 && view ==5)
                                    {
                                        filterhighchart(typechart," Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                        color_arry = [];
                                    }
                                    else if(resyear.length > 1 && view !=0)
                                    {
                                      yrs = [];
                                      if (view ==2)
                                      {
                                        for(j=resyear[0];j<=resyear[1];j++)
                                        {
                                          var yr = j.toString();
                                          yrs.push(yr);
                                        }
                                      }
                                      else
                                      {
                                         yrs = resyear;
                                      }
                                      // console.log(yrs);
                                      // console.log(jsonObj);
                                      // console.log(colors);
                                      // console.log(typechart);
                                       filterhighchart_time(typechart," Sales",splitname3[0],yrs,jsonObj,colors,minmax);
                                    }
                                    else
                                    {
                                      // colors = color_arry;
                                        // alert(jsonObj1);
                                        // console.log(jsonObj1);
                                        filterhighchart(typechart," Sales",splitname3[0],locarray,jsonObj1,color_arry,minmax);
                                          color_arry= [];
                                    }
                                     color_arry= [];
                                    rankfilterArr = rankfilterArr.toString();
                                    // console.log(rankfilterArr);
                                    sessionStorage.setItem("rank_filter",rankfilterArr);
                                    sessionStorage.setItem("loc_filter",rankfilterArr);
                                     updaterank();
                                     //  console.log("AA");
                                     // console.log(newcolorshad);
                                     //  console.log(areavalue);
                                     //  console.log("BB");
                                   if(circle==0)
                                   {
                                    map.data.setStyle(function(feature)
                                    {
                                      // testtt++;
                                      if ( typeof newcolorshad[feature.getProperty('DB_ID')] != 'undefined' )
                                      {
                                        return({
                                        strokeColor: '#000',
                                        strokeOpacity: 0.8,
                                        strokeWeight: 1,
                                        fillColor:newcolorshad[feature.getProperty('DB_ID')],
                                        //fillColor: colorcodeid[feature.getProperty('DB_ID')],
                                        fillOpacity: 1
                                        });
                                      }
                                      else
                                      return ({
                                      fillColor: 'white',
                                      strokeWeight:1
                                      });
                                      // console.log(testtt);
                                    });
                                  }
                                  else
                                  {
                                   // alert("circle");
                                   removeAllcircles();
                                 // alert(file);
                                 filter_circle(file,dict);
                                // console.log(worldid);
                                // console.log( areavalue);
                                     //console.log(dict);
                                  }
                            }
                            //console.log(jsonObj);
                            return false; // prevent dialog from closing.
                         }
                      },
                      someOtherButton: {
                          text: 'Cancel',
                          btnClass: 'btn-green',
                          action: function () {
                              alert($("#byname1").val());
                              return false; // prevent dialog from closing.
                          }
                      },
                      close: function () {
                          //alert('Closed !!!');
                          //return false; // prevent dialog from closing.
                          // lets the user close the modal.
                      }
                  },
                  boxWidth:'100%',
                  onOpen: function () {
                      // onOpen attach the events.
                      var that = this;
                      // this.$content.find('#by-name').click(function () {
                      //   $.ajax({
                      //     type: "POST",
                      //     url: "getstate.php",
                      //     data:{"menuitem":menuitem},
                      //    success:function(data){
                      //        that.$content.find('span').html(data);
                      //    }
                      //   });
                      //   //alert("XXXXXXXXXXX");
                      // });
                      this.$content.find('#by-variable').click(function () {
                          // split_dts
                          isfilter = sessionStorage.getItem("variable_fiter");
                          split_dts = sessionStorage.getItem('split_dts');
                          // split_dts = $.parseJSON(split_dts);
                           split_dts =  JSON.parse(itemobj);
                          // console.log(charts);
                          tablestr ="<table id='example4'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                          tablestr +='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Variable</b></th></tr></thead>';
                          tablestr +="<tbody>";
                          for(k=0;k<(split_dts.length);k++)
                          {
                              split_dts1 = split_dts[k].split('/');
                                                    splitname = split_dts1[1];
                                                    split_id = split_dts1[0];
                            tablestr +="<tr id='"+split_id+"'>";
                            tablestr += "<td><input type='checkbox' name='filcheckbox' value = '"+split_id+"'></td> <td> "+splitname+"</td>";
                            tablestr += "</tr>";
                          }
                          tablestr +="</tbody></table>";
                          that.$content.find('span').html(tablestr);
                          var table1 =$('#example4').DataTable( {"language": {
                          "search": "Variable:"},  "scrollY": 200,"scrollX":true} );
                          var data = table1.rows().data();
                          // rowstable = table1;//table1.rows().data();
                          tblcnt = data.length;
                          rowstable = table1.cells().nodes();
                          // console.log(isfilter);
                          if(isfilter != '')
                          {
                            var resfill = isfilter.split(",");
                             for(k=0;k<(resfill.length);k++)
                            {
                              // console.log(isfilter[k]);
                               $('#example4 tbody').find('#'+resfill[k]).eq(0).find('input').prop('checked', true);
                            }
                          }
                          // $('#example4').find()
                          // console.log(rowstable);
                      });
                      this.$content.find('#by-shape').click(function () {
                        //alert("YYYYYYYYYY");
                           that.$content.find('span').html('Tools : <img id="bypolygon" src="icons/draw_polygon.png" width="30px" height="30px" title="Polygon"/>&nbsp;&nbsp;&nbsp;<img id="bysquare" src="icons/square.png" width="30px" height="30px" title="Square"/>&nbsp;&nbsp;&nbsp;<img id="bycircle" src="icons/circle.png" width="30px" height="30px" title="Circle"/>');
                      });
                      this.$content.find('#by-rank').click(function () {
                          //alert("YYYYYYYYYY");
                         // alert(tblcnt);
                           $('#by-name').find('span').empty();
                          $('#by-range').find('span').empty();
                          $('#example3').empty();
                          that.$content.find('span').html('From : <input id="byrank1" size="5" type="text" placeholder="000"/>&nbsp;&nbsp;&nbsp;To : <input id="byrank2" size="5" type="text" placeholder="000"/><div id="slider-range"></div>');
                            // that.$content.find('span').html('<p><label for="amount">Price range:</label><input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"></p><div id="slider-range"></div>');
                           // that.$content.find('span').html('From : <input id="byrank1" size="5" type="text" placeholder="000"/>&nbsp;&nbsp;&nbsp;To : <input id="byrank2" size="5" type="text" placeholder="000"/><p><label for="amount">Price range:</label><input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"></p><div id="slider-range"></div>');
                           filteryear = sessionStorage.getItem('year');
                           var resyear = filteryear.split(",");
                             tablcolmns = jquerydatatable.columns( { filter : 'applied'} ).data();
                          // tablcolmns = jquerydatatable.columns().data();
                              // console.log(tablcolmns);
                                var arrayint = [];
                              if(resyear.length > 1 && (view ==5))
                              {
                                if(comb != 1)
                                {
                                  // alert("Sdfsd");
                                 var arr = tablcolmns[1];
                                }
                                else
                                {
                                  var arr = tablcolmns[2];
                                }
                              }
                              else if(resyear.length > 1 && (view !=0))
                              {
                                 var arrindex = 1+resyear.length
                                 var arr = tablcolmns[arrindex];
                              }
                              else
                              {
                                if(comb != 1)
                                {
                                 var arr = tablcolmns[1];
                                }
                                else
                                {
                                  var arr = tablcolmns[2];
                                }
                                 //var arr = tablcolmns[1];
                              }
                              // console.log(arr);
                              for(jk=0;jk<arr.length;jk++)
                              {
                                var find = ',';
                                var re = new RegExp(find, 'g');
                                arr[jk] = arr[jk].replace(re, '');
                                arrayint.push(parseFloat(arr[jk]));
                              }
                              // console.log(arrayint);
                             // arrayint.sort(sortFloat);
                              var sorted = arrayint.slice().sort(function(a,b){return b-a})
                              // console.log(sorted);
                              var ranks = arrayint.slice().map(function(v){ return sorted.indexOf(v)+1 });
                              ranks = ranks.sort(sortFloat);
                              // console.log(ranks);
                              $('#byrank1').val(ranks[0]);
                              $('#byrank2').val(ranks[ranks.length-1]);
                              rank2 = ranks[ranks.length-1];
                              // console.log(ranks[0]+','+ranks[ranks.length-1]);
                              // alert("Sdfsd");
                               createslider(1,ranks[ranks.length-1],1);
                               $('#byrank1').val(ranks[0]);
                              $('#byrank2').val(ranks[ranks.length-1]);
                             // $('body').find( "#slider" ).slider("value", 50);//slider( "option", "max", 50);
                            // $(function () {
                            // $("#slider").slider({
                            // value: 50,
                            // // setup the rest ...
                            // });
                            // });
                      });
                      this.$content.find('#by-range').click(function () {
                          //alert("YYYYYYYYYY");
                          //console.log(jquerydatatable.columns().data());
                           //console.log(jquerydatatable.rows().data());
                         //var   dynamicrangeval="";
                            comb = sessionStorage.getItem('groupby');
                           filteryear = sessionStorage.getItem('year');
                           var resyear = filteryear.split(",");
                            if(dynamicrangeval.length == 0)
                            {
                                  // alert('s');
                                  dattablesoure = jquerydatatable.columns( { filter : 'applied'} ).data();//jquerydatatable.columns().data();
                                   // console
                                   // console.log(dattablesoure);
                                   if(resyear.length > 1 && view == 5)
                                   {
                                        if(comb != 1)
                                        {
                                          sourceindx = 1;
                                        }
                                        else
                                        {
                                           sourceindx = (resyear.length);
                                        }
                                   }
                                   else if(resyear.length > 1 && view !=0 && comb == 'C')
                                   {
                                    sourceindx = (resyear.length)+1;
                                   }
                                   else  if(resyear.length > 1 && view > 0 && comb == 'S')
                                   {
                                      sourceindx = (resyear.length)+2;
                                   }
                                   else
                                   {
                                      if(comb == 'C')
                                          {
                                             if(resyear.length > 1 && view ==0){
                                               sourceindx = 1;
                                             }
                                             else
                                             {
                                                 sourceindx = (resyear.length);
                                             }
                                          }
                                          else
                                          {
                                             sourceindx = (resyear.length)+1;
                                          }
                                   }
                                   //console.log(dattablesoure);
                                   //alert(dattablesoure[sourceindx]);
                                   if(dattablesoure[sourceindx] != undefined)
                                   {
                                      dattablesoure = dattablesoure[sourceindx];
                                    }else
                                    {
                                      dattablesoure = dattablesoure[sourceindx-1];//temporay fix for cummlative with more than year
                                    }
                                  var find = ',';var re = new RegExp(find, 'g'); //str = searchData[jk].replace(re, '');
                                   for(dt=0;dt<dattablesoure.length;dt++)
                                   {
                                      dattablesoure[dt] = parseFloat(dattablesoure[dt].replace(re,''));
                                   }
                              // console.log(dattablesoure);
                            }
                            else
                            {
                              // alert(dynamicrangeval);
                              // alert("SDfsdf");
                               dattablesoure=new Array();//dynamicrangeval;
                               // dynamicrangeval=[];
                               // alert("SDfs");
                               dattablesourechk = jquerydatatable.rows( { filter : 'applied'} ).data();
                                    // alert(dattablesourechk);
                                    // console.log('dattablesourechk');
                                    // console.log(dynamicrangeval);
                                    $.each(dattablesourechk, function(idx, item) {
                                      // console.log(dattablesourechk[idx]);
                                      // console.log(dynamicrangeval[parseInt(dattablesourechk[idx]['DT_RowId'])]);
                                          dattablesoure.push(dynamicrangeval[parseInt(dattablesourechk[idx]['DT_RowId'])]);
                                    });
                               // console.log(jquerydatatable.rows( { filter : 'applied'} ).data());
                               // console.log( jquerydatatable.columns( { filter : 'applied'} ).data());
                            }
                          // alert(dattablesoure);
                          // alert(dynamicrangeval);
                          max = Math.max.apply(Math,dattablesoure); // 3
                          min = Math.min.apply(Math,dattablesoure)
                          $('#by-rank').find('span').empty();
                          $('#by-name').find('span').empty();
                          $('#byrank1').val('');
                          $('#byrank2').val('');
                            delayMillis = 1000;
                          that.$content.find('span').html('From : <input id="byrange1" size="10" type="text" placeholder="000"/>&nbsp;&nbsp;&nbsp;To : <input id="byrange2" size="10" type="text" placeholder="000"/><div id="slider-range"></div>');
                              $("#byrange1").val(min);
                              $("#byrange2").val(max);
                               createslider(min,max,2);
                      });
                      this.$content.find('#by-name').click(function () {
                          //console.log(jquerydatatable.rows( { filter : 'applied'} ).nodes().length);
                           // console.log(jquerydatatable.columns( { filter : 'applied'} ).data());
                          jquerydatatable.rows( { search:'applied' } ).data().each(function(value, index) {
                          // console.log(value, index);
                          // console.log("ds");
                          });
                          locfilter =   sessionStorage.getItem("loc_filter");
                          rangefilter =  sessionStorage.getItem("range_filter");
                          rankfilter =   sessionStorage.getItem("rank_filter");
                          $('#by-rank').find('span').empty();
                          $('#by-range').find('span').empty();
                          comb = sessionStorage.getItem('groupby');
                            // locallvl = sessionStorage.getItem("fileloc");
                            // var javaScriptVar = "<?php echo $_SERVER['REQUEST_URI'] ?>";
                            // // alert(javaScriptVar);
                            // var split1 = javaScriptVar.split("?");
                            // var variables = split1[1].split("&");
                            // var level = locallvl.split("---");
                            // var levelids = level[1];
                            // var queryid = level[0];
                            // var loc_variable = 0;
                            parentlevel = sessionStorage.getItem('parentlvl');
                            childlevel = sessionStorage.getItem('childlvl');
                          // if(levelids=="0"){ parentlevel=21;childlevel=5;}
                          // if(levelids=="1"){ parentlevel=5;childlevel=5;}
                          // if(levelids=="2"){parentlevel=5;childlevel=7;}
                          // if(levelids=="3"){parentlevel=7;childlevel=7;}
                          // if(levelids=="4"){parentlevel=7;childlevel=9;}
                          // if(levelids=="5"){parentlevel=9;childlevel=9;}
                          // if(levelids=="6"){parentlevel=12;childlevel=15;}
                          // if(levelids=="7"){parentlevel=15;childlevel=15;}
                            //console.log(variables);
                            var category =   sessionStorage.getItem('categs');//variables[2].split("=");
                            // category = category[1];
                            var year = sessionStorage.getItem('year');//variables[3].split("=");
                            // year = year[1];
                            var tbl =sessionStorage.getItem('tbl');//variables[5].split("=");
                            // tbl =tbl[1];
                            // var mnid =variables[6].split("=");
                            // mnid =mnid[1];
                            var view =sessionStorage.getItem('view');//variables[7].split("=");
                            // view =view[1];
                            //  var ptype =variables[8].split("=");
                            // ptype =ptype[1];
                            // var groupby = variables[4].split("=");
                            var groupby1 = "";
                            comb = sessionStorage.getItem('groupby');
                          if(comb=='C'){groupby="";}else if(comb=='S'){groupby=1;}else{groupby="";}
                              // queryid = sessionStorage.getItem("queryid");
                              // var findata = '';
                              // var filter = 1;
                              // var delayMillis = 1000;
                              // if (groupby == "")
                              // {
                              //   data1 = {"year":year,"categs":mnid,"chart":"chart","id":queryid,"groupby":groupby,"level":levelids,"filter":filter,parentlvl:parentlevel,childlvl:childlevel,"mnid":category,"tbl":tbl,view:"view"};
                              // }
                              // else
                              // {
                              //  // data1 =  {"year":year,"categs":category,"chart":"chart","id":queryid,"groupby":groupby,"level":levelids,"filter":filter,"splitview":"splitview","tbl":tbl,};
                              //  data1 = {"year":year,"categs":mnid,"chart":"chart","id":queryid,"groupby":groupby,"level":levelids,"filter":filter,parentlvl:parentlevel,childlvl:childlevel,"mnid":category,"tbl":tbl,view:"view"};
                              // }
                              //jquerydatatable.search( '' ).columns().search( '' ).draw();
                               // jquerydatatable.fnFilterClear();
                               // $("#example19").DataTable().search("").draw();
                                // jquerydatatable.search( '' ).columns().search( '' ).draw();
                               var data = jquerydatatable.rows().data();
                               //console.log(data);
                                //console.log(jquerydatatable.rows( {search:'applied'} ).nodes());
                                //jquerydatatable.rows( {search:'removed'} ).nodes();
                              tablestr ="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                              tablestr +='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Variable</b></th></tr></thead>';
                              tablestr +="<tbody>";
                              datainx = 0;
                              if(comb == 'S')
                              {
                                datainx = 1;
                              }
                              // alert(locfilter);
                              if(locfilter == '')
                              {
                                data.each(function (value, index) {
                                   tablestr +="<tr id='"+data[index]['DT_RowId']+"'>";
                                                 tablestr += "<td><input type='checkbox' name='filcheckbox' value = '"+data[index]['DT_RowId']+"' checked></td> <td> "+data[index][datainx]+"</td>";
                                                 tablestr += "</tr>";
                                });
                              }
                              else
                              {
                                splilocfil = locfilter.split(",");
                                // console.log(splilocfil);
                                data.each(function (value, index) {
                                  if(splilocfil.indexOf(data[index]['DT_RowId']) != -1)
                                  {
                                    tablestr +="<tr id='"+data[index]['DT_RowId']+"'>";
                                                 tablestr += "<td><input type='checkbox' name='filcheckbox' value = '"+data[index]['DT_RowId']+"' checked></td> <td> "+data[index][datainx]+"</td>";
                                                 tablestr += "</tr>";
                                  }
                                  else
                                  {
                                    tablestr +="<tr id='"+data[index]['DT_RowId']+"'>";
                                                 tablestr += "<td><input type='checkbox' name='filcheckbox' value = '"+data[index]['DT_RowId']+"'></td> <td> "+data[index][datainx]+"</td>";
                                                 tablestr += "</tr>";
                                  }
                                });
                                 // console.log(splilocfil);
                              }
                              tablestr +="</tbody></table>";
                              // console.log("asdasa");
                               that.$content.find('span').empty();
                                that.$content.find('span').html(tablestr);
                                //console.log("1");
                                $.fn.dataTable.ext.search.pop();
                                 //$.fn.dataTable.ext.search.splice(index,1);
                                // $.fn.dataTableExt.afnFiltering.splice(index,1);
                                var table1 =$('body').find('#example3').DataTable( {"language": {
                                "search": "Location:"},  "scrollY": 200,"scrollX":true} );
                                //console.log("2");
                                var data1 = table1.rows().data();
                                rowstable = table1.cells().nodes();//rows().nodes().select();
                      });
                  },
                  draggable: true,
              });
     }
    $('body').on('change', 'input[name = "filcheckboxall"]', function() {
    $( rowstable ).find(':checkbox').prop('checked', $(this).is(':checked'));
    });
    function filterhighchart(typechart,title2,relevel,jsonc,jk,c,minmax)
   {
        // console.log(jk)
          chartsingle = Highcharts.chart('chart', {
           yAxis: {
                labels: {
                      formatter: function () {
                        return numDifferentiation(this.value);
                  }
                },
                title: {
                    text: 'Total Sales in Rs'
                },
            },
            chart: {
                type: typechart
            },
            title: {
                text: title2
            },
            credits: {
                   enabled: false
            },
            colors:c,
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    colorByPoint: true
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                // console.log(this.y);
                                               requestlevel=relevel;
                                              if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                        statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                           if(statuscode1 == true)
                                                           {
                                                             map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                            initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                           }
                                                          else
                                                          {
                                                            alert("Data Not available");
                                                          }
                                              }
                                              else
                                              {
                                                   requestlevel1=requestlevel+1;
                                                   statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                                 if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                      initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }
                                            }
                            }
                        }
                    }
                }
            },
            xAxis: {
                   categories:jsonc,
                     scrollbar: {
                enabled: true
            },
                },
            series: jk
        },
        );
         if((minmax != '') && (typechart !='line')){
        chartsingle.xAxis[0].update({
        max: 10
        }); }
           // minmax
   }
   function filterhighchart_time(typechart,title2,relevel,jsonc,jk,c,minmax)
   {
        // alert(typechart);
        // console.log(jsonc);
        chartsingle = Highcharts.chart('chart', {
           yAxis: {
                labels: {
                      formatter: function () {
                        return numDifferentiation(this.value);
                  }
                },
                title: {
                    text: 'Total Sales in Rs'
                },
            },
            chart: {
                type: typechart
            },
            title: {
                text: title2
            },
            credits: {
                   enabled: false
            },
            // colors:c,
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    colorByPoint: true
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                console.log(this.y);
                                               requestlevel=relevel;
                                              if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                        statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                           if(statuscode1 == true)
                                                           {
                                                             map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                            initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                           }
                                                          else
                                                          {
                                                            alert("Data Not available");
                                                          }
                                              }
                                              else
                                              {
                                                   requestlevel1=requestlevel+1;
                                                   statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                                 if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                      initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }
                                            }
                            }
                        }
                    }
                }
            },
            xAxis: {
                   categories:jsonc,
                     scrollbar: {
                enabled: true
            },
                },
            series: jk
        },
        );
          if((minmax != '') && (typechart !='line')){
        chartsingle.xAxis[0].update({
        max: 10
        }); }
           // minmax
   }
  function filter_highcharts_split(categries,seriesdata)
  {
    // console.log('Aei');
    // console.log(categries);
    // console.log(seriesdata);
    // filterpt = sessionStorage.getItem('filterpt');
    // if(filterpt != 'loc'){
    // for(var i=0;i<seriesdata.length;i++)
    // {
    //     for(var j=0;j<seriesdata[i]['data'].length;j++)
    //     {
    //         seriesdata[i]['data'][j]['x'] = j;
    //     }
    // }
    // }
    // console.log(seriesdata);
    if(categries.length > 5)
    {
        charts = Highcharts.chart('chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            min : 1,
            max:10,
            categories: categries,
        },
         credits: {
               enabled: false
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Sales in Rs'
            },
             labels: {
                 formatter: function () {
                    return numDifferentiation(this.value);
                      }
            },
        },
        scrollbar: {
            enabled: true
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                events: {
                legendItemClick: function() {
                  var chart = this.chart,
                  series = this,
                  hide = !this.visible;
                  chart.series.forEach(function(s) {
                  if (series.name === s.name) {
                  s.update({
                  visible: hide
                  }, false);
                  }
                  });
                  chart.redraw();
                  return false;
                }
                }
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                                           requestlevel=2;
                                          if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                    statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                       if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                        initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                       }
                                                      else
                                                      {
                                                        alert("Data Not available");
                                                      }
                                          }
                                          else
                                          {
                                               requestlevel1=requestlevel+1;
                                               statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                             if(statuscode1 == true)
                                               {
                                                 map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                  initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                               }
                                              else
                                              {
                                                alert("Data Not available");
                                              }
                                        }
                        }
                    }
                }
            }
        },
        series: prepareSeries(seriesdata),
        originalSeries:seriesdata
        });
    }
    else
    {
      charts = Highcharts.chart('chart', {
      chart: {
          type: 'column'
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: categries,
      },
       credits: {
             enabled: false
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Total Sales in Rs'
          },
           labels: {
                formatter: function () {
                  return numDifferentiation(this.value);
                    }
          },
      },
      scrollbar: {
          enabled: true
      },
      tooltip: {
          headerFormat: '<b>{point.x}</b><br/>',
          pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
      },
      plotOptions: {
          column: {
              stacking: 'normal',
                events: {
                legendItemClick: function() {
                  var chart = this.chart,
                  series = this,
                  hide = !this.visible;
                  chart.series.forEach(function(s) {
                  if (series.name === s.name) {
                  s.update({
                  visible: hide
                  }, false);
                  }
                  });
                  chart.redraw();
                  return false;
                }
                }
          },
          series: {
              cursor: 'pointer',
              point: {
                  events: {
                      click: function () {
                                         requestlevel=2;
                                        if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                  statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                     if(statuscode1 == true)
                                                     {
                                                       map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                      initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                     }
                                                    else
                                                    {
                                                      alert("Data Not available");
                                                    }
                                        }
                                        else
                                        {
                                             requestlevel1=requestlevel+1;
                                             statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                           if(statuscode1 == true)
                                             {
                                               map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                             }
                                            else
                                            {
                                              alert("Data Not available");
                                            }
                                      }
                      }
                  }
              }
          }
      },
      series: prepareSeries(seriesdata),
      originalSeries:seriesdata
      });
    }
  }
  function filter_highcharts_split_timeline(categries,seriesdata)
  {
   charts =  Highcharts.chart('chart', {
    chart: {
        type: 'line'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: categries,
    },
     credits: {
           enabled: false
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Sales in Rs'
        },
         labels: {
              formatter: function () {
                return numDifferentiation(this.value);
                  }
        },
    },
    scrollbar: {
        enabled: true
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
        },
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                                       requestlevel=2;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }
                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;
                                           statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                           }
                                          else
                                          {
                                            alert("Data Not available");
                                          }
                                    }
                    }
                }
            }
        }
    },
    series: seriesdata
    });
  }
  function filter_chart_growth_split(categries,seriesdata,color)
  {
    // color = color.reverse
    charts = Highcharts.chart('chart', {
       yAxis: {
            labels: {
                  formatter: function () {
                return numDifferentiation(this.value);
                  }
            },
            title: {
                text: 'Total Sales in Rs'
            },
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        credits: {
               enabled: false
        },
        colors:color,
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
                colorByPoint:true
            },
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            // console.log(this.y);
                                           requestlevel=2;
                                          if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {
                                                    statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel+".svg");
                                                       if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                        initial("IndiaSVG/"+this.mydata+"---"+requestlevel+".svg",requestlevel,'','');
                                                       }
                                                      else
                                                      {
                                                        alert("Data Not available");
                                                      }
                                          }
                                          else
                                          {
                                               requestlevel1=requestlevel+1;
                                               statuscode1=UrlExists(baseurl+"/IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg");
                                             if(statuscode1 == true)
                                               {
                                                 map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                  initial("IndiaSVG/"+this.mydata+"---"+requestlevel1+".svg",requestlevel1,this.mydata,'');
                                               }
                                              else
                                              {
                                                alert("Data Not available");
                                              }
                                        }
                        }
                    }
                }
            }
        },
        xAxis: {
               categories:categries,
                 scrollbar: {
            enabled: true
        },
            },
        series: seriesdata
    },
    );
    //   chartseries = [{"name":"Bevrgs,Deodorant","data":[{"y":-6,"mydata":"1","color":"#ff0000"},{"y":-26,"mydata":"3","color":"#ff0000"}]}];
    // chartcatgr = ["Bevrgs","Deodorant"];
    // chartdupseries = [{"name":"Bevrgs,Deodorant","data":[{"y":-6,"mydata":"1","color":"#ff0000"},{"y":-26,"mydata":"3","color":"#ff0000"}]}];
    // // fullcnt = ;
    //  sessionStorage.setItem('chartseries12', JSON.stringify(chartdupseries));
    //  sessionStorage.setItem('split_dts', JSON.stringify([{"refid":"1","name":"Bevrgs"},{"refid":"3","name":"Deodorant"}]));
  }
  function reset_reading()
  {
    //      map.data.forEach(function(feature) {
    //     // If you want, check here for some constraints.
    //     map.data.remove(feature);
    // });
        // console.log(sessionStorage.getItem("currentloadfile"));
           //  sessionStorage.getItem('currcenterco');
           // sessionStorage.getItem('sw');
           // sessionStorage.getItem('ne');


        // $('.legendcluster').css('display:one')

        clusterclear();
        //legendcluster
        //$("#legendcluster").html('');
        $("#legendcluster").hide();
        filepath = sessionStorage.getItem("currentloadfile");
        filepath = filepath.replace('KML','SVG');
        filepath = filepath.replace('kml','svg');

        // parentlevel = sessionStorage.getItem('parentlvl');
        // childlevel = sessionStorage.getItem('childlvl');
        // id  = sessionStorage.getItem("id");
    groupby = sessionStorage.getItem('groupby');
     areavalue =[];
     window.parent.$('.reading-conv').val('4');
            try
            {
              map.data.setStyle({});//map.data.revertStyle();
               map.data.setStyle(function(feature) {
                  return {
                  strokeColor: '#000',
                  strokeOpacity:0.5,
                  strokeWeight: 0.5,
                  fillColor: '#FFF',
                  fillOpacity: 1
                  };
                  });
              }
            catch(err) {
            // document.getElementById("demo").innerHTML = err.message;
            }
    //else
   // {
         for(k=0; k<markerscharts.length; k++){
              markerscharts[k].setMap(null);
              }
   // }
   $('#chart').children().last().html('');
    // $('#chart').html('');
    $('#report').html('');


      try {
      overlay.setMap(null); //removing svg
      }
      catch(err) {
      //document.getElementById("demo").innerHTML = err.message;
      }
         var ajax = new XMLHttpRequest();
          ajax.open("GET", filepath, true);
          ajax.send();

        ajax.onload = function(e)
        {

            overlay = new SvgOverlay({
            content: ajax.responseText,
            map: map,

            });

              // geolvl = sessionStorage.getItem('geolvl');
              // geo=geolvl.split(",");
              // // console.log
              // latlng = new google.maps.LatLng(geo[0], geo[1]);
              // map.setCenter(latlng);
                sw = sessionStorage.getItem('sw');
                sw=sw.split(",");
                sw = new google.maps.LatLng(sw[0], sw[1]);
                ne = sessionStorage.getItem('ne');
                ne=ne.split(",");
                ne = new google.maps.LatLng(ne[0], ne[1]);
                var bounds = new google.maps.LatLngBounds(sw,ne);

                map.fitBounds(bounds);



        }


      $('#jstreeSplit', window.parent.document).html('');
      issetsvg = 0;//clearing mouseover popup
      // $('body').find("jstreeSplit").html('');
  }
  function reset_reading_split()
  {
    map.data.forEach(function(feature) {
    // If you want, check here for some constraints.
    map.data.remove(feature);
    });
    groupby = sessionStorage.getItem('groupby');
    areavalue =[];
    window.parent.$('.reading-conv').val('4');
    try
    {
    map.data.setStyle({});//map.data.revertStyle();
    map.data.setStyle(function(feature) {
    return {
    strokeColor: '#000',
    strokeOpacity:0.5,
    strokeWeight: 0.5,
    fillColor: '#FFF',
    fillOpacity: 1
    };
    });
    }
    catch(err) {
    // document.getElementById("demo").innerHTML = err.message;
    }
    //else
    // {
    for(k=0; k<markerscharts.length; k++){
    markerscharts[k].setMap(null);
    }
    // }
    $('#chart').children().last().html('');
    // $('#chart').html('');
    $('#report').html('');
  }
  function map_split(mapcontent,circle,presentkey,rev)
  {
  // alert('vdf');
    map.data.setStyle(function(feature)
    {
    // else
    return ({
    fillColor: 'white',
    strokeWeight:1
    });
    });
    areavalue =[];
    for(k=0; k<markerscharts.length; k++){
    markerscharts[k].setMap(null);
    }
    testarr=mapcontent;
    // alert(testarr);
    viewing=sessionStorage.getItem('view');
    var total =new Array();
    var total1 =new Array();
    var lastval=new Array();
    var sum1;
    var dataf;
    var data22;
    var center=0;
    var its = new Array();
    var colorsvg_arr = new Array();
    var valsvg_arr = new Array();
    i=0;
    if( viewing != 3) //other than growth
    {
    // console.log(testarr);
    $.each(testarr, function(i, item)
    {
    // console.log(testarr);
    // alert(testarr[i]);
    total[i]=0;
    round=0;


    $.each(testarr[i], function(j, item)
    {
    var value1=testarr[i][j].value;
    if(round<10){
    total[i] = parseInt(total[i])+parseInt(testarr[i][j].value);// sum of state
    }
    });
    //
    });
    sum1 = total.reduce(add, 0);// sum of all state
    sum1=parseInt(sum1);

    function add(a, b) {
    return a + b;
    }
    markerclsarr =[];
    var accident_LatLng ='';
    $.each(testarr, function(i, item)
    {
    //console.log(i);

    //place_name=jquerydatatable.row().context[0].aIds[i]._aData[1];
    data1=new Array();str="";sum=0;ite=0;data2=new Array(); round=0;data22="[";
    // str='<div class="info legend1"><p><b>'+ place_name +'</b></p>';
    str='<div class="info legend1">';
    valuesar = [];
    colorsar=[];
    presentkey=[];
    //longs = [];
    // console.log(jquerydatatable.row().context[0].aIds[i]._aData[1]);
    $.each(testarr[i], function(j, item)
    {
    var id=i;

    var name =testarr[i][j].name;
    var value=testarr[i][j].value;
    if(round<10){
    valuesar.push(value);
    presentkey.push(id);
    //console.log(id);
    accident_title = testarr[i][j].name;
    center=testarr[i][j].center.split(",");
    lats= parseFloat(center[0]);
    longs = parseFloat(center[1]);
    var fills=getsplitcolour(parseInt(ite));
    colorsar.push(fills);
    tval =testarr[i][j].value;
    var resco12 = tval.toString().split('.');
    var resco1 =resco12[0].replace(/\,/g,'');
    var amtcomma =moneyFormatIndia((resco1));
    // reading
    if ( resco1[1] !== void 0 )
    {
    if(resco12[1] != undefined)
    {
    amtcomma = amtcomma+'.'+resco12[1];
    }
    // amtcomma = amtcomma+'.'+resco12[1];
    }
    // its.push(j);
    its[j] = testarr[i][j].name;
    colorsvg_arr[j] = fills;
    valsvg_arr[j] = amtcomma;
    data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"'}},";
    str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+amtcomma+'<br>';
    ite=parseInt(ite)+1;
    round=parseInt(round)+1;
    }
    });

    str+='</div>';
    data22 +="]";
    dataf = eval(data22);
    avg=(total[i]/sum1)*100;
    avg =parseInt(avg);


  // alert(typeval);
  if(circle==1)
  {

    //alert(str);
      setsplitmarker(valuesar,colorsar,lats,longs,str,presentkey[0],0);


 //setsplitmarker(valuesar,colorsar,lats,longs,str,presentkey[0],0);
   overlay.setMap(null);
  }
  // typeval='';
  //  typeval=$("input[name=type]:checked").val();



    its = [];
    colorsvg_arr= [];
    valsvg_arr = [];
    });
    }
    else
    {
    colorcode = colorgradientcreation(mapcontent,'0');
    // alert('d');
    locdetail = []
    getpro_arr = [];
    map.data.forEach(function(feature) {
    getpro_arr[feature.getProperty('DB_ID')]=feature;
    });
    if(colorcode[1].length > 0)
    {
    colorcode[1] = colorcode[1].reverse();
    }
    j=0;
    // console.log('mapcontent');
    // console.log(mapcontent);
    $.each(mapcontent, function(i, item)
    {
    percent = 0;
    var ite="";
    t=mapcontent[i].split("****");
    areavalue[t[0]] = t[1];
    if(t[1]> 0){
    colorcodeid[t[0]] = colorcode[0][i];
    }
    else
    {
    colorcodeid[t[0]] = colorcode[1][j];
    j++;
    }
    });

    map.data.setStyle(function(feature)
    {
    if (typeof colorcodeid[feature.getProperty('DB_ID')] != 'undefined')
    {
    //chartcolorfillgrowth.push(colorcodeid[feature.getProperty('DB_ID')]);
    return({
    strokeColor: '#000',
    strokeOpacity: 0.8,
    strokeWeight: 1,
    fillColor: colorcodeid[feature.getProperty('DB_ID')],
    fillOpacity: 1
    });
    }
    else
    return ({
    fillColor: 'white',
    strokeWeight:1
    });
    });
    }
  // initialize_chart();
  }
</script>
<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<!-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> -->
<script>
$(function() {
       $( ".dragme" ).resizable();
        // $('#chart')
        // $('body').on('click', '#chart', function() {
        //   // alert('sds');
        //   $( ".dragme" ).draggable({ disabled: true });
        // });
        //ondrag="myFunction(event)"
         // $('body').on('mousedown', '.highcharts-scrollbar-thumb', function() {
         //         $(".dragme").draggable({ disabled: true });
         // });
         //   $('body').on('mouseup', '.highcharts-scrollbar-thumb', function() {
         //        $(".dragme").draggable("enable");
         // });
       // $('')
       // $( ".dragme" ).draggable( "disable" );
    });
function clear_selection()
{
    // sessionStorage.setItem('view','');
    // year = sessionStorage.setItem('year','');
    sessionStorage.setItem('categs','');
}
</script>
<script src="js/jquery.jspanel.bs-1.4.0.js"></script>
<script>


        // create a default jsPanel
       //  var nextlevelfile=sessionStorage.getItem("currentloadfile");
       //  file1= nextlevelfile.split("SVG/");
       //  file11=file1[1].split("/");
       //  file2=file11[2].split(".svg");
       //  file3=file2[0].split("---");
       //  fileid=file3[0];
       //  mainloc=file3[1];
       //  subloc=file3[2];

       // mapname(mainloc,subloc,"","",fileid);
       // var maprefresh=sessionStorage.getItem("refreshMapname");
        jsPanel.create({
      id: 'panel-1',
      onwindowresize: true,
      theme:       'primary',
      headerTitle: '<div class="widget-tittle"><h5 id="mapname">'+''+'</h5> </div>',
      headerControls: {close: "remove"},
      panelSize: {width: '49.5vw', height: '50vh'},
      minimizeTo: 'parent',
      position: {
        my:      "left-top",
        at:      "left-top",
        offsetX: '0.4%',
        offsetY: '0.5%'
    },
      content:  '<div id="legendlabel">legend</div><div id="legendcluster" >LifeStyle Indictrs</div><div id="style-selector-control"  class="map-control"></div><input type="text" placeholder="Location" id="customerAutocomplte"  /><div id="map"><div id="tool"></div></div>',
      onwindowresize: function(event, panel) {
          panel.reposition(panel.options.position);


      },
      callback: function () {
          this.content.style.padding = '20px';
      },
      onbeforeclose: function () {
          return confirm('Do you really want to close the panel?');
      }

  });
        jsPanel.create({
      id: 'panel-2',
      onwindowresize: true,
      theme:       'primary',
      headerTitle: '<div class="widget-tittle"><h5 id="chartname">Chart</h5><div class="dropdown char-dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart" aria-hidden="true"></i></a><ul class="dropdown-menu chart-dropdown-menu"><li><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>  Bar Chart</a></li><li><a href="#"><i class="fa fa-pie-chart" aria-hidden="true"></i>  Bubble chart</a></li></ul></div></div>',
      panelSize: {width: '49.5vw', height: '50vh'},
      minimizeTo: 'parent',
      headerControls: {close: "remove"},
      position: {
        my:      "left-top",
        at:      "left-top",
        offsetX: '50.2%',
        offsetY: '0.5%'
    },
    // <div id="cl"></div>
      content:     '<div id="chart"><img id="imgh"/></div>',
      onwindowresize: function(event, panel) {
          panel.reposition(panel.options.position);
      },
      callback: function () {
          this.content.style.padding = '20px';
      },
      onbeforeclose: function () {
          return confirm('Do you really want to close the panel?');
      }
  });
        jsPanel.create({
      id: 'panel-3',
      onwindowresize: true,
      theme:       'primary',
      headerTitle: '<div class="report-header"><h5 id="reportname">Data view</h5></div>',
      panelSize: {width: '99.3vw', height: '49vh'},
      minimizeTo: 'parent',
      headerControls: {close: "remove"},
      position: {
        my:      "left-top",
        at:      "left-top",
        offsetX: '0.4%',
        offsetY: '51.2%'
    },
      content:     '<div class="buttonexcel"></div><div class="report-container"><div id="report" class=""> </div></div>',
      onwindowresize: function(event, panel) {
          panel.reposition(panel.options.position);
      },
      callback: function () {
          this.content.style.padding = '20px';
      },
      onbeforeclose: function () {
          return confirm('Do you really want to close the panel?');
      }

  });
  document.addEventListener('jspanelbeforemaximize', function (event) {
    if (event.detail === 'panel-3') {
        $('.dataTables_scrollBody').removeAttr("style");
        $('.dataTables_scrollHeadInner').removeAttr("style");
        $('.dataTable').removeAttr("style");
    }
      // $('.gm-style-mtc').each(function(){

      // alert($(this).css('display'));// == 'none')
      // //    {
      // //do something
      // //  }
      // });
    //alert()

  });
 // $("#mapname").text(sessionStorage.name);
  document.addEventListener('jspanelnormalized', function (event) {
  // do your things ...
  // would be executed whenever the 'jspanelnormalized' event fires
    $("#panel-1").css("width","49.5vw");
    $("#panel-1").css("height","50vh");
    $("#panel-2").css("width","49.5vw");
    $("#panel-2").css("height","50vh");
    $("#panel-3").css("width","99.3vw");
    $("#panel-3").css("height","49vh");
    if (event.detail === 'panel-3') {
          $('.dataTables_scrollBody').css('position', 'relative');
          $('.dataTables_scrollBody').css('max-height', '200px');
          $('.dataTables_scrollBody').css('overflow', 'auto');
          $('.dataTables_scrollBody').css('width', '100%');
          $('.dataTables_scrollHeadInner').css("box-sizing", "content-box");
          $('.dataTables_scrollHeadInner').css("width", "99%");
          $('.dataTables_scrollHeadInner').css("padding-right", "17px");
          $('.dataTable').css("width", "100%");
          $('.dataTable').css("margin-left", "0px");

      }
  });



 $('body').find('#customerAutocomplte').autocomplete({
      source: function( request, response ) {


        $.ajax({
          url: "searchloc.php",
          dataType: "json",
          data: {
            q: request.term
          },
          async:false,
          success: function( data ) {
            response( data );
          }
        });
      },
      // focus: function (event, ui) {
      //   event.preventDefault() // <-- prevent the textarea from being updated.
      // },
      minLength: 3,
      select: function( event, ui ) {
         $(this).val(ui.item.label);
         $("#mapname").text(ui.item.label);
         str = ui.item.center_coordinates;
         strt = str.toString().split(",");
         // alert(strt[0]);
        //  var uluru = {lat:  parseFloat(str[0]), lng: parseFloat(str[1])};
        // var map = new google.maps.Map(document.getElementById('map'), {
        //   zoom: 4,
        //   center: uluru
        // });
           lat = parseFloat(strt[0]);
           lang = parseFloat(strt[1]);

           sessionStorage.setItem('geolvl',str);
           locid = ui.item.data;
           locid = locid.toString();
           loclvl = ui.item.loc;
           loclvl= loclvl.toString();

           initfile = 'SVG/'+ui.item.country_id+"/"+loclvl+'---'+loclvl +'/'+locid+'---'+loclvl+'---'+loclvl+'.svg';

           sessionStorage.setItem('currcenterco',ui.item.center_coordinates);
           sessionStorage.setItem('sw',ui.item.southwest);
           sessionStorage.setItem('ne',ui.item.northeast);
          //filesplit(initfile,"");
          statuscode = true;
            // statuscode=UrlExists(baseurl+initfile);
                       // console.log(statuscode);
                       if(statuscode == true)
                        {
                             var callback1 = function(feature) {
                             map.data.remove(feature);
                             removeAllcircles();
                           };
                         map.data.forEach(callback1);
                      }
                        sessionStorage.setItem("currentloadfile", initfile);
                           typeval=$("input[name=type]:checked").val();
                         //alert(typeval);
                        if(typeval=="circle")
                        {

                               removeAllcircles1();
                                initlayer(map,initfile,0,1,'');
                        }

                        else if (typeval=="svg")
                        {
                          removeAllcircles();
                           initlayer(map,initfile,0,0,'');
                        }
                        else
                        {
                          removeAllcircles();
                           initlayer(map,initfile,0,0,'');
                          // initlayer(map,nextlevelfile,0,0,'');
                        }
               view = sessionStorage.getItem('view');
              year = sessionStorage.getItem('year');
              menu_item_id = sessionStorage.getItem('categs');
            // alert(view+" / "+year+" / "+menu_item_id);
            if(view != '' && year != '' && menu_item_id != '')
            {
               // $('.loading', window.parent.document).show();
              // alert(view);
              map.data.revertStyle();
               if(typeval=="circle")
                        {

                         combinesplit_res(1,0,0);
                        }
                          else if(typeval=="svg")
                        {

                         combinesplit_res(0,0,0);
                        }
                      else
                      {
                        combinesplit_res(0,0,0);
                      }

            }
          // console.log(ui.item.refid);
            // alert(initfile);
        // if(initfile=="SVG/1/5---5/1---5---5.svg")
        // {
        //       overlay.setMap(null);
        //       var xmlhttp = new XMLHttpRequest();
        //       xmlhttp.open('GET', 'SVG/1/5---7/1---5---7-lat.svg', false);
        //       xmlhttp.send();
        //       overlay = new SvgOverlay({
        //       content: xmlhttp.responseText,
        //       map: map
        //       });
        //       svg = overlay.getSvg();
        //       svg.setAttribute('opacity', 1);
        //       console.log('overlay.getContainer()');
        //       tes = overlay.getContainer();
        // }
        // console.log( ui.item ?
        //   "Selected: " + ui.item.label :
        //   "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    }).focus(function () {
    $(this).autocomplete("search");
});
function prepareSeries(series)
  {
    // console.log('before');
    // console.log(series);

      var newSeriesArr = [];
      series.forEach(function(series) {
        // create new series for every point

        series.data.forEach(function(point) {
          var newSeries = {};
          for (prop in series) {
            if (prop !== 'data') {
              newSeries[prop] = series[prop]; // copy properties to a new series
              // console.log('series[prop]');
              // console.log(series);
            }
          }
          newSeries.data = [point];
          // alert(newSeriesArr.find((s) => s.name === newSeries.name) );
          // eliminate duplicates in the legend
          newSeries.showInLegend = typeof newSeriesArr.find((s) => s.name === newSeries.name) === 'undefined';
          newSeriesArr.push(newSeries);
        });

      });

      newSeriesArr.sort(function(s1, s2) {
        // console.log(s2.data[0].y);
        if(s2 == null)
        {
          return s2;
        }
        else
        {
          return s1.data[0].y - s2.data[0].y;
        }
      });
      // console.log('after');
      // console.log(newSeriesArr);
      //  console.log('csk');
      //    var seriesLength = charts.series.length;
      //      for(var i = seriesLength -1; i > -1; i--) {
      //               charts.series[i].remove();
      //           }
      //           for(var k=0;k<newSeriesArr.length;k++){
      //             charts.addSeries(newSeriesArr[k], false);
      //            }
      //            charts.redraw();
      console.log('newSeriesArr');
      console.log(newSeriesArr);
      return newSeriesArr;
  }
  // function prepareSeries(series)
  // {
  //     var newSeriesArr =series;
  //     series.forEach(function(series) {
  //       // create new series for every point
  //       series.data.sort(function(s1, s2) {
  //       console.log(s2.y);
  //       if(s2 == null)
  //       {
  //         return s2;
  //       }
  //       else
  //       {
  //         return s2.y - s1.y;
  //       }
  //     });
  //     });
  //     console.log('jsk');
  //     console.log(newSeriesArr);
  //     return newSeriesArr;
  // }
  //     var initfile='SVG/<?php echo $fileloc?>.svg';
  // var fs = require("fs");
  // outputFileName = "SVG/<?php echo $fileloc?>.svg";
  // var kml = fs.readFileSync(initfile, 'utf8');
  // fs.writeFileSync(outputFileName, KPTS(kml));
  function create_svglaytag()
{
  alert('a');
   var script1 = document.createElement('script');
  script1.type = 'text/javascript';
  script1.src = "js/svgoverlay.js";
  document.body.appendChild(script1);
}
// function initMap()
// {
//    // create_svglaytag(initMap_t());
//   initMap_t();
//   //alert('d');
//   //alert('1');
//   // svgexecution();
// }

        function svg_opacity(typeval)
        {
          if(typeval=='svg')
          {
            opacityon=$("#custom-handle2").html();
          v=opacityon/100;
         svg = overlay.getSvg();
         svg.setAttribute('opacity', v);
         }
         else if(typeval=='circle')
          {
            opacityon=$("#custom-handle2").html();
          v=opacityon/100;
         svg = overlay.getSvg();
         svg.setAttribute('opacity', v);
         }
          }
  function svgexecution()
  {
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.open('GET', 'world.svg', false);
        xmlhttp.send();
        overlay = new SvgOverlay({
          content: xmlhttp.responseText,
          map: map
        });
        //sessionStorage.setItem("overlay",overlay);


        //   v=opacityon/100;
        // svg = overlay.getSvg();
         typeval=$("input[name=type]:checked").val();
         // if(typeval=='circle')
         // {
         //  overlay.set(null);
         // }
          svg.setAttribute('opacity', 1);


        // svg.setAttribute('opacity', 1);
        // console.log('overlay.getContainer()');
        tes = overlay.getContainer();
  }

    // $("body").on("dblclick", ".gtag", function(e)
    // {
    //   e.stopImmediatePropagation();
    //   // alert('s');
    //   // console.log(this);
    //   // console.log(this.parentElement);
    //   var k = this.parentElement;
    //   console.log(k.parentElement);
    //   // alert(k);
    //   console.log($(this).attr('id'));
    //   var k1 = $(this).parent();

    //   console.log($(this).parent());
    //   // alert();
    //   // k1.parent().parent().append(' <defs><linearGradient id="MyGradient"><stop offset="5%" stop-color="#F60" /><stop offset="95%" stop-color="#FF6" /></linearGradient></defs>');
    //   //  k1.parent().attr("fill", "url(#MyGradient)");
    //   console.log(k.parentNode.getAttribute("id"));
    //   // alert(k.parentNode.getAttribute("id"));
    //    alert(k.getAttribute("id"));
    //   if(k.parentNode.getAttribute("id") == null)
    //   {
    //     alert(k.getAttribute("id"));
    //   }




    //        removeAlllayer();
    //         fileid="";
    //        refid=[];mastername=[];

    //        var nextlevelfile=null;
    //        $('.loading', window.parent.document).show();
    //     setTimeout(function(){
    //       $.ajax({
    //                type: "POST",
    //                url: "AjaxRequest.php",
    //                data:{"nextlevel":"nextlevel","id":k.parentNode.getAttribute("id"),"currentlevel":file,"viewmode":"svg"},
    //                async:false,
    //                   success: function (data) {
    //                   nextlevelfile = data;
    //                         if( nextlevelfile=="SVG/14878---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/73---12---15.svg";
    //                         }
    //                           if( nextlevelfile=="SVG/13346---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/676---12---15.svg";
    //                         }
    //                    if (nextlevelfile && nextlevelfile !=undefined)
    //                     {
    //                        statuscode=UrlExists(baseurl+nextlevelfile);
    //                        console.log(statuscode);
    //                        if(statuscode == true)
    //                         {
    //                           var callback1 = function(feature) {
    //                           map.data.remove(feature);
    //                           removeAllcircles();
    //                           };
    //                           map.data.forEach(callback1);
    //                           sessionStorage.setItem("currentloadfile", nextlevelfile);
    //                           console.log(sessionStorage.getItem("currentloadfile"));
    //                           // $('#map').attr("style", "display: none !important");
    //                           typeval=$("input[name=type]:checked").val();
    //                           if(typeval=="circle")
    //                           {
    //                           initlayer(map,nextlevelfile,0,1,'');
    //                           //initlayer(map,nextlevelfile,0,1,'');
    //                           }
    //                           else
    //                           {
    //                           initlayer(map,nextlevelfile,0,0,'');
    //                           // initlayer(map,nextlevelfile,0,0,'');
    //                           }
    //                           // $('#map').attr("style", "display: block !important");
    //                           //map1.clearInstanceListeners(data);
    //                           $('.loading', window.parent.document).hide();
    //                           file1=nextlevelfile.split("SVG/");
    //                           file2=file1[1].split(".svg");
    //                           file3=file2[0].split("---");
    //                           fileid=file3[0];
    //                           mainloc=file3[1];
    //                           subloc=file3[2];
    //                           file11=file.split("SVG/");
    //                           file12=file11[1].split(".svg");
    //                           file13=file12[0].split("---");
    //                           fileid1=file13[0];
    //                           mainloc1=file13[1];
    //                           subloc1=file13[2];
    //                           // console.log(mainloc1,"---------",mainloc);
    //                           arr1=[];arr2=[];
    //                           if(mainloc1==mainloc)
    //                           {
    //                           mapname(mainloc,subloc,mainloc1,subloc1,fileid);
    //                           }
    //                           if(mainloc=="21"&&subloc=="1")
    //                           {
    //                           $("#mapname").text("Country");
    //                           }
    //                        }
    //                       else
    //                       {
    //                         $('.loading', window.parent.document).hide();
    //                         $.alert({
    //                         title: '',
    //                         content: 'Data Not Available',
    //                         boxWidth: '30%',
    //                         top:-500,
    //                         offsetTop: 70,
    //                         useBootstrap: false,
    //                         });
    //                       }
    //                  }
    //               }
    //           });
    //           view = sessionStorage.getItem('view');
    //           year = sessionStorage.getItem('year');
    //           menu_item_id = sessionStorage.getItem('categs');
    //         // alert(view+" / "+year+" / "+menu_item_id);
    //         if(view != '' && year != '' && menu_item_id != '')
    //         {
    //           // $('.loading', window.parent.document).show();
    //           // alert(view);
    //           map.data.revertStyle();
    //           comb = sessionStorage.getItem('groupby');
    //           // if(comb != 'S'){
    //           combinesplit_res("");//}
    //           if(issetsvg == 1)
    //           {
    //           // alert(issetsvg);
    //           map.data.setStyle(function(feature)
    //           {
    //           // else
    //           return ({
    //           fillColor: 'white',
    //           strokeWeight:0
    //           });
    //           });
    //           }
    //       }
    //     },500);



    //   // console.log($( this ).parent());
    // });

    // $("body").on("dblclick", "svg g", function(e)
    // {
    //   e.stopImmediatePropagation();
    //   // alert('s');
    //   // console.log(this);
    //   // console.log(this.parentElement);
    //   var k = this.parentElement;
    //   console.log(k.parentElement);
    //   // alert(k);
    //   console.log("$(this).attr('id')");
    //   console.log($(this).attr('id'));
    //   var k1 = $(this).parent();

    //   console.log($(this).parent());
    //   // alert();
    //   // k1.parent().parent().append(' <defs><linearGradient id="MyGradient"><stop offset="5%" stop-color="#F60" /><stop offset="95%" stop-color="#FF6" /></linearGradient></defs>');
    //   //  k1.parent().attr("fill", "url(#MyGradient)");
    //   console.log(k.parentNode.getAttribute("id"));
    //   // alert(k.parentNode.getAttribute("id"));
    //   // alert(k.getAttribute("id"));
    //   // if(k.parentNode.getAttribute("id") == null)
    //   // {
    //   //   alert(k.getAttribute("id"));
    //   // }

    //     locid = k.parentNode.getAttribute("id");
    //     // locid = parseInt(locid);
    //     console.log('locid');
    //     // console.log(locid);
    //     if(isNaN(parseInt(locid)))
    //     {
    //       // alert('dfd');
    //       locid = $(this).attr('id');
    //     }
    //     console.log(locid);
    //        removeAlllayer();
    //         fileid="";
    //        refid=[];mastername=[];

    //        var nextlevelfile=null;
    //        $('.loading', window.parent.document).show();
    //     setTimeout(function(){
    //       $.ajax({
    //                type: "POST",
    //                url: "AjaxRequest.php",
    //                data:{"nextlevel":"nextlevel","id":locid,"currentlevel":file,"viewmode":"svg"},
    //                async:false,
    //                   success: function (data) {
    //                   nextlevelfile = data;
    //                         if( nextlevelfile=="SVG/14878---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/73---12---15.svg";
    //                         }
    //                           if( nextlevelfile=="SVG/13346---12---15.svg")
    //                         {
    //                           nextlevelfile="";
    //                           nextlevelfile="SVG/676---12---15.svg";
    //                         }
    //                    if (nextlevelfile && nextlevelfile !=undefined)
    //                     {
    //                        statuscode=UrlExists(baseurl+nextlevelfile);
    //                        console.log(statuscode);
    //                        if(statuscode == true)
    //                         {
    //                           var callback1 = function(feature) {
    //                           map.data.remove(feature);
    //                           removeAllcircles();
    //                           };
    //                           map.data.forEach(callback1);
    //                           sessionStorage.setItem("currentloadfile", nextlevelfile);
    //                           console.log(sessionStorage.getItem("currentloadfile"));
    //                           // $('#map').attr("style", "display: none !important");
    //                           typeval=$("input[name=type]:checked").val();
    //                           if(typeval=="circle")
    //                           {
    //                           initlayer(map,nextlevelfile,0,1,'');
    //                           //initlayer(map,nextlevelfile,0,1,'');
    //                           }
    //                           else
    //                           {
    //                           initlayer(map,nextlevelfile,0,0,'');
    //                           // initlayer(map,nextlevelfile,0,0,'');
    //                           }
    //                           // $('#map').attr("style", "display: block !important");
    //                           //map1.clearInstanceListeners(data);
    //                           $('.loading', window.parent.document).hide();
    //                           file1=nextlevelfile.split("SVG/");
    //                           file2=file1[1].split(".svg");
    //                           file3=file2[0].split("---");
    //                           fileid=file3[0];
    //                           mainloc=file3[1];
    //                           subloc=file3[2];
    //                           file11=file.split("SVG/");
    //                           file12=file11[1].split(".svg");
    //                           file13=file12[0].split("---");
    //                           fileid1=file13[0];
    //                           mainloc1=file13[1];
    //                           subloc1=file13[2];
    //                           // console.log(mainloc1,"---------",mainloc);
    //                           arr1=[];arr2=[];
    //                           if(mainloc1==mainloc)
    //                           {
    //                           mapname(mainloc,subloc,mainloc1,subloc1,fileid);
    //                           }
    //                           if(mainloc=="21"&&subloc=="1")
    //                           {
    //                           $("#mapname").text("Country");
    //                           }
    //                        }
    //                       else
    //                       {
    //                         $('.loading', window.parent.document).hide();
    //                         $.alert({
    //                         title: '',
    //                         content: 'Data Not Available',
    //                         boxWidth: '30%',
    //                         top:-500,
    //                         offsetTop: 70,
    //                         useBootstrap: false,
    //                         });
    //                       }
    //                  }
    //               }
    //           });
    //           view = sessionStorage.getItem('view');
    //           year = sessionStorage.getItem('year');
    //           menu_item_id = sessionStorage.getItem('categs');
    //         // alert(view+" / "+year+" / "+menu_item_id);
    //         if(view != '' && year != '' && menu_item_id != '')
    //         {
    //           // $('.loading', window.parent.document).show();
    //           // alert(view);
    //           map.data.revertStyle();
    //           comb = sessionStorage.getItem('groupby');
    //           // if(comb != 'S'){
    //           combinesplit_res("");//}
    //           if(issetsvg == 1)
    //           {
    //           // alert(issetsvg);
    //           map.data.setStyle(function(feature)
    //           {
    //           // else
    //           return ({
    //           fillColor: 'white',
    //           strokeWeight:0
    //           });
    //           });
    //           }
    //       }
    //     },500);



    //   // console.log($( this ).parent());
    // });
    // $("body").on("click", "svg g", function(e)
    // {
    //   alert('df');
    // });


  $("body").on("click",".biwinch",function(e)
  {
          // e.preventDefault();
          // alert('dfssfdfsdds');

          // $('body').find('.gm-style-mtc').each(function(){
          // alert($(this).css('display'));
          // // if ( $(this).css('display') == 'none')
          // // {

          // // }
          // });
          //-80.72052061518963, -180
          //86.94556807925831, 180

          // alert(parentlvl);

          // -52.7583653915395, -180), (77.36713192729601, 180
        file11 = sessionStorage.getItem('maplevel');
        if(file11=="SVG/1---21---21.svg")
        {


              // file1=file11.split("SVG/");
              // file2=file1[1].split(".svg");
              // file3=file2[0].split("---");
              // locid=file3[0];
              // parentlvl=file3[1];
              // childlvl=file3[2];

          sw = new google.maps.LatLng(-52.7583653915395, -180);
          ne = new google.maps.LatLng(77.36713192729601, 180);
          var bounds = new google.maps.LatLngBounds(sw,ne);
          map.fitBounds(bounds);
          map.setZoom(map.getZoom()+1);

        }
        else if(file11=="SVG/1---21---1.svg")
        {

          sw = new google.maps.LatLng(-52.7583653915395, -180);
          ne = new google.maps.LatLng(77.36713192729601, 180);
          var bounds = new google.maps.LatLngBounds(sw,ne);
          map.fitBounds(bounds);
          map.setZoom(map.getZoom()+1);

        }
        else
        {
                sw = sessionStorage.getItem('sw');
                sw=sw.split(",");
                sw = new google.maps.LatLng(sw[0], sw[1]);
                ne = sessionStorage.getItem('ne');
                ne=ne.split(",");
                ne = new google.maps.LatLng(ne[0], ne[1]);
                var bounds = new google.maps.LatLngBounds(sw,ne);
                 map.fitBounds(bounds);
                  // map.setZoom(map.getZoom()-1);
        }









  });
  $("body").on("dblclick", "#fotos g", function(e)
    {
        goprevy = 0;
        // historyarr.push(file);
        // sessionStorage.setItem("hist", JSON.stringify(historyarr));
        // zoomarr.push(map.getZoom());
        // sessionStorage.setItem("zoom", JSON.stringify(zoomarr));
        // cphistory.push(sessionStorage.getItem('geolvl'));
        // console.log(historyarr);

      e.stopImmediatePropagation();

      var k = this.parentElement;

      var k1 = $(this).parent();
      // console.log("BBBBBBSDSSSSSSF");
      //   console.log( k.parentNode.getAttribute("id"));


        locid = k.parentNode.getAttribute("id");
        if(isNaN(parseInt(locid)))
        {
          locid = $(this).attr('id');
        }
           removeAlllayer();
            fileid="";
           refid=[];mastername=[];

           var nextlevelfile=null;
           $('.spinner-wrapper').show();
        setTimeout(function(){
          $.ajax({
                   type: "POST",
                   url: "AjaxRequest.php",
                   data:{"nextlevel":"nextlevel","id":locid,"currentlevel":file,"viewmode":"svg"},
                   async:false,
                      success: function (data) {
                        // console.log(data);
                      data = data.split("//");
                      // sessionStorage.setItem('geolvl',data[1]);
                      sessionStorage.setItem('geolvl',data[1]);
                      sessionStorage.setItem('sw',data[2]);
                      sessionStorage.setItem('ne',data[3]);
                      cenpoints[locid] = data[1];
                      data = data[0];
                      nextlevelfile = data;
                     // alert(nextlevelfile);

                            // if( nextlevelfile=="SVG/14878---12---15.svg")
                            // {
                            //   nextlevelfile="";
                            //   nextlevelfile="SVG/73---12---15.svg";
                            // }
                            //   if( nextlevelfile=="SVG/13346---12---15.svg")
                            // {
                            //   nextlevelfile="";
                            //   nextlevelfile="SVG/676---12---15.svg";
                            // }
                            // alert(nextlevelfile);
                       if (nextlevelfile && nextlevelfile !=undefined)
                        {
                           // statuscode=UrlExists(baseurl+nextlevelfile);
                           // console.log(statuscode);

                           statuscode = true;
                           if(statuscode == true)
                            {
                              if(nextlevelfile=="SVG/1---21---21.svg")
                              {


                              file1=nextlevelfile.split("SVG/");
                              file2=file1[1].split(".svg");
                              file3=file2[0].split("---");
                              fileid=file3[0];
                              mainloc=file3[1];
                              subloc=file3[2];

                              }
                              else if(nextlevelfile=="SVG/1---21---1.svg")
                              {


                              file1=nextlevelfile.split("SVG/");

                              file2=file1[1].split(".svg");
                              file3=file2[0].split("---");
                              fileid=file3[0];
                              mainloc=file3[1];
                              subloc=file3[2];

                              }


                              else
                              {
                              file1=nextlevelfile.split("SVG/");
                              file11=file1[1].split("/");
                              file2=file11[2].split(".svg");
                              file3=file2[0].split("---");
                              fileid=file3[0];
                              mainloc=file3[1];
                              subloc=file3[2];
                              }
                                  if(mainloc=="21"&&subloc=="1")
                                  {
                                  $("#mapname").text("Country");
                                  }


                                  else
                                  {
                                  mapname1(mainloc,subloc,'','',fileid);
                                  }
                              // alert('1');
                              // var callback1 = function(feature) {
                              // map.data.remove(feature);
                              // removeAllcircles();
                              // };
                              // map.data.forEach(callback1);
                              sessionStorage.setItem("currentloadfile", nextlevelfile);
                              // console.log(sessionStorage.getItem("currentloadfile"));
                              // $('#map').attr("style", "display: none !important");
                              typeval=$("input[name=type]:checked").val();
                              if(typeval=="circle")
                              {
                              initlayer(map,nextlevelfile,0,1,'');
                              //initlayer(map,nextlevelfile,0,1,'');
                              }
                              else
                              {


                              view = sessionStorage.getItem('view');
                              year = sessionStorage.getItem('year');
                              menu_item_id = sessionStorage.getItem('categs');

                              console.log(view+" / "+year+" / "+menu_item_id);
                                if(view != '' && year != '' && menu_item_id != '')
                                {
                                  sessionStorage.setItem('svgnxt','1');
                                  // initlayer(map,nextlevelfile,0,0,'');

                                  files = nextlevelfile;
                                  history = 0;circle = 0;zoomlevel = '';
                                  try {
                                  overlay.setMap(null);
                                  }
                                  catch(err) {
                                  //document.getElementById("demo").innerHTML = err.message;
                                  }
                                  fetaurearr=[];
                                  // console.log('rose');
                                  // console.log(files);
                                  fileloc1=files.split("/");
                                  fileloc12=fileloc1[1].split(".svg");
                                  filesplit16 =fileloc12[0].split("---");
                                  if(typeof filesplit16[1] == 'undefined')
                                  {
                                  fileloc12=fileloc1[2].split(".svg");
                                  filesplit16 =fileloc12[0].split("---");
                                  // alert(filesplit16);
                                  }



                                   file=files;
                                  sessionStorage.setItem('maplevel',file);
                                  var conversion=[];
                                  var allMarkers = [];
                                  centerpoint=[];
                                  if(circle==1)
                                  {
                                    overlay.set(null);

                                      circpie();
                                      if(file=="SVG/1---21---21.svg")
                                      {
                                      $("#mapname").text("Global");
                                      }

                                  }
                                  else
                                  {
                                      $("#rep").val("")
                                      if(file=="SVG/1---21---21.svg")
                                      {
                                      $("#mapname").text("Global");
                                      }



                                      // if (svgnxt != '')
                                      // {
                                      //    svgpath = svgpath.replace(".svg", "---a.svg");
                                      // }
                                      // alert(svgpath);

                                      // Append the SVG to the target





                                      if(file=="SVG/1---21---21.svg")
                                      {


                                      file1=file.split("SVG/");
                                      file2=file1[1].split(".svg");
                                      file3=file2[0].split("---");
                                      fileid=file3[0];
                                      mainloc=file3[1];
                                      subloc=file3[2];

                                      }
                                      else if(file=="SVG/1---21---1.svg")
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



                                      //filesplit(file,"");
                                      // console.log(mainloc,"----",subloc)

                                      loc_type(mainloc,subloc,fileid);

                                  }

                                  if(history==0)
                                  {
                                    historyarr.push(files);
                                    sessionStorage.setItem("hist", JSON.stringify(historyarr));
                                    zoomarr.push(map.getZoom());
                                    sessionStorage.setItem("zoom", JSON.stringify(zoomarr));
                                    cphistory.push(sessionStorage.getItem('geolvl'));
                                     sessionStorage.setItem("cphistory", JSON.stringify(cphistory));
                                      swbounds.push(sessionStorage.getItem('sw'));
                                      sessionStorage.setItem("swbounds", JSON.stringify(swbounds));
                                      nebounds.push(sessionStorage.getItem('ne'));
                                      sessionStorage.setItem("nebounds", JSON.stringify(nebounds));
                                  }
                                //  togglelocationload(files);



                                  comb = sessionStorage.getItem('groupby');
                                  // if(comb != 'S'){
                                  combinesplit_res(0,0,0);//}
                                   //initlayer(map,nextlevelfile,0,0,'');
                                    // if(issetsvg == 1)
                                    // {
                                    //   // alert(issetsvg);
                                    //   map.data.setStyle(function(feature)
                                    //   {
                                    //     // else
                                    //     return ({
                                    //     fillColor: 'white',
                                    //     strokeWeight:0
                                    //     });
                                    //   });
                                    // }
                                }
                                else
                                {
                                  initlayer(map,nextlevelfile,0,0,'');
                                }

                              // initlayer(map,nextlevelfile,0,0,'');
                              }
                              // geolt=data[1];
                              // geo=geolt.split(',');
                              // console.log(geolt);

                              // $('#map').attr("style", "display: block !important");
                              //map1.clearInstanceListeners(data);
                              $('.spinner-wrapper').hide();
                              file1=nextlevelfile.split("SVG/");
                              file2=file1[1].split(".svg");
                              file3=file2[0].split("---");
                              fileid=file3[0];
                              mainloc=file3[1];
                              subloc=file3[2];
                              file11=file.split("SVG/");
                              file12=file11[1].split(".svg");
                              file13=file12[0].split("---");
                              fileid1=file13[0];
                              mainloc1=file13[1];
                              subloc1=file13[2];
                              // console.log(mainloc1,"---------",mainloc);
                              arr1=[];arr2=[];
                              if(mainloc1==mainloc)
                              {
                              // mapname(mainloc,subloc,mainloc1,subloc1,fileid);
                              }
                              if(mainloc=="21"&&subloc=="1")
                              {
                              $("#mapname").text("Country");
                              }
                           }
                          else
                          {
                            $('.spinner-wrapper').hide();
                            $.alert({
                            title: '',
                            content: 'Data Not Available',
                            boxWidth: '30%',
                            top:-500,
                            offsetTop: 70,
                            useBootstrap: false,
                            });
                          }
                     }
                  }
              });
              view = sessionStorage.getItem('view');
              year = sessionStorage.getItem('year');
              menu_item_id = sessionStorage.getItem('categs');
              console.log(view+" / "+year+" / "+menu_item_id);
            // alert(view+" / "+year+" / "+menu_item_id);

          //   if(view != '' && year != '' && menu_item_id != '')
          //   {
          //     // $('.loading', window.parent.document).show();
          //     // alert(view);
          //     // map.data.revertStyle();
          //     comb = sessionStorage.getItem('groupby');
          //     // if(comb != 'S'){
          //     combinesplit_res("");//}
          //     if(issetsvg == 1)
          //     {
          //     // alert(issetsvg);
          //     map.data.setStyle(function(feature)
          //     {
          //     // else
          //     return ({
          //     fillColor: 'white',
          //     strokeWeight:0
          //     });
          //     });
          //     }
          // }
        },500);



      // console.log($( this ).parent());
    });




   $("body").on("dblclick", "polygon", function(){
    var contid = $(this).attr('next_level');
        // alert(contid);
      // if(contid=="IND") {
        if(contid != undefined)
        {
          view = sessionStorage.getItem('view');
          year = sessionStorage.getItem('year');
          menu_item_id = sessionStorage.getItem('categs');
          // alert(view+"/"+year+"/"+menu_item_id);
          if(view != '' && year != '' && menu_item_id != '')
                {
                   // $('.loading', window.parent.document).show();
                  // alert('pathclicked');
                  // map.data.revertStyle();
                  overlay.setMap(null);
                  maplevel = contid.split("_");
                   svgname = maplevel[0]+'---'+maplevel[1]+'---'+maplevel[2];
                  // historyarr.push('SVG/'+svgname+'.svg');
                  sessionStorage.setItem('id',maplevel[0]);
                  sessionStorage.setItem('parentlvl',maplevel[1]);
                  sessionStorage.setItem('childlvl',maplevel[2]);
                  // combinesplit_res("");//calling twice thats y i am just hiding
              }
         }
      //     alert("Yesssssssssssss");
      //     $("#map_canvas").hide();
         // map.data.forEach(function(feature) {
         //  // If you want, check here for some constraints.
         //  map.data.remove(feature);
         //  // console.log(feature);
         //  });
          // console.log(overlay);
          // $('body').find('path').parent().empty();
           // svgexecution_st(contid);
      // }
  });


   $("body").on("mouseout", "#fotos g", function(e)
    {

        deleteTooltip(e);

    });
    //Mouse over for svg given by map
    $("body").on("mouseover", "#fotos g", function(e)
    {
        // e.stopImmediatePropagation();
        name = sessionStorage.getItem("loctype");
        locid =  $(this).attr('id');

        //console.log($(this).attr('id'));
        getitem = sessionStorage.getItem('getstate_data');
        mpdata = JSON.parse(getitem);
         // console.log('locid');
          // console.log(locid);
            console.log(typeof $("#chart").highcharts());
            console.log($('#chart').find('.highcharts-series-group').length);
            resulttype1 =sessionStorage.getItem('groupby');//sessionStorage.getItem('resulttype');
          if(typeof locid != 'undefined')
          {

            if($('#chart').find('.highcharts-series-group').length != 0)//typeof $("#chart").highcharts() != 'undefined')
            {


                if(resulttype1 == 'C' || typeof resulttype1 == 'undefined' || resulttype1 == '')
                {
                  if(areavalue.length > 0)
                  {
                    mmd = mpdata[locid];
                  }


                  var_fil = sessionStorage.getItem("variable_fiter");

                  str ='';
                  str+='<div class = "legend1">';
                  if(areavalue.length > 0 && typeof areavalue[locid] != 'undefined')
                  {
                    // str +=jquerydatatable.row().context[0].aIds[locid]._aData[0]+' - <b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1] +'</b><br>';
                    str +='<b>'+$(this).attr('name')+' - '+areavalue[locid] +'</b><br>';
                  }
                  else
                  {
                    str+=$(this).attr('name');
                  }



                  str+='</div>';
                  console.log(str);
                  if(typeof $(this).attr('name') !='undefined')
                  {
                    deleteTooltip(e);
                    injectTooltip(e,str);
                  }
                }
                else if (resulttype1 == 'S')
                {

                    // console.log(locid);
                    mmd='';
                    mmd = mpdata[locid];
                    var_fil = sessionStorage.getItem("variable_fiter");

                    // console.log(mmd);
                    if(typeof mpdata[locid] != 'undefined')
                    {


                    var arr = Object.keys(mmd).map(function(k) { return mmd[k] });
                    arr.sort(function(a,b) {
                    return b.value-a.value
                    });

                    str ='';
                    str+='<div class = "legend1"><b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1]+"-"+name+'</b><br>';
                    for(var ij =0;ij<arr.length;ij++)
                    {
                    // str ='';
                    if(ij<10){
                    fills=arr[ij].colr;//getsplitcolour(parseInt(ij));
                    tval =arr[ij].value;
                    var resco12 = tval.toString().split('.');
                    var resco1 =resco12[0].replace(/\,/g,'');
                    var amtcomma =moneyFormatIndia((resco1));
                    // reading
                    if ( resco1[1] !== void 0 )
                    {
                    if(resco12[1] != undefined)
                    {
                    amtcomma = amtcomma+'.'+resco12[1];
                    }
                    // amtcomma = amtcomma+'.'+resco12[1];
                    }
                    //split view legend
                    //str_leg +='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+'<br>';
                    // str+='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+':'+amtcomma+'<br>';
                    str+= '<b>'+arr[ij].name+'</b>:'+amtcomma+'<br>';
                    }
                    // console.log(str);
                    }
                    str+='</div>';
                    deleteTooltip(e);
                    injectTooltip(e,str);
                    // str+='<div class = "legend1">';
                    }
                }

            }
            else
            {
                // e.stopImmediatePropagation();
                str ='';
                str+='<div class = "legend1">';
                str+=$(this).attr('name');
                str+='</div>';
                console.log(str);
                if(typeof $(this).attr('name') !='undefined')
                {
                  deleteTooltip(e);
                  injectTooltip(e,str);
                }
            }

          }
          // else

          // {
          //     str ='';
          //       str+='<div class = "legend1">';
          //       str+=$(this).attr('name');
          //       str+='</div>';
          //       console.log(str);
          //       if(typeof $(this).attr('name') !='undefined')
          //       {
          //         deleteTooltip(e);
          //         injectTooltip(e,str);
          //       }
          // }





        // console.log('dd');
    });
    //mouse over for svg ,,which we got from internet
    $("body").on("mouseover", "path", function(e)
    {
        e.stopImmediatePropagation();
        name = sessionStorage.getItem("loctype");
        locid =  $(this).attr('id');

        console.log($(this).attr('id'));
        getitem = sessionStorage.getItem('getstate_data');
        mpdata = JSON.parse(getitem);
         // console.log('locid');
          // console.log(locid);
          levelid = sessionStorage.getItem('lastname');
          console.log(typeof $("#chart").highcharts());
          // if(levelid != '' && levelid = '')
          // {
          //       locid=(locid==14878) ? 73 :locid;
          // }
           console.log(typeof $("#chart").highcharts());
            console.log($('#chart').find('.highcharts-series-group').length);
            resulttype1 =sessionStorage.getItem('groupby');//sessionStorage.getItem('resulttype');
          if(typeof locid != 'undefined')
          {

            if($('#chart').find('.highcharts-series-group').length != 0)//typeof $("#chart").highcharts() != 'undefined')
            {


                if(resulttype1 == 'C' || typeof resulttype1 == 'undefined' || resulttype1 == '')
                {
                  if(areavalue.length > 0)
                  {
                    mmd = mpdata[locid];
                  }


                  var_fil = sessionStorage.getItem("variable_fiter");

                  str ='';
                  str+='<div class = "legend1">';
                  if(areavalue.length > 0 && typeof areavalue[locid] != 'undefined')
                  {
                    // str +=jquerydatatable.row().context[0].aIds[locid]._aData[0]+' - <b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1] +'</b><br>';
                    str +='<b>'+$(this).attr('name')+' - '+areavalue[locid] +'</b><br>';
                  }
                  else
                  {
                    str+=$(this).attr('name');
                  }



                  str+='</div>';
                  //console.log(str);
                  if(typeof $(this).attr('name') !='undefined')
                  {
                    deleteTooltip(e);
                    injectTooltip(e,str);
                  }
                }
                else if (resulttype1 == 'S')
                {

                    // console.log(locid);
                    mmd='';
                    mmd = mpdata[locid];
                    var_fil = sessionStorage.getItem("variable_fiter");

                    // console.log(mmd);
                    var arr = Object.keys(mmd).map(function(k) { return mmd[k] });
                    arr.sort(function(a,b) {
                    return b.value-a.value
                    });

                    str ='';
                    str+='<div class = "legend1"><b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1]+"-"+name+'</b><br>';
                    for(var ij =0;ij<arr.length;ij++)
                    {
                    // str ='';
                    if(ij<10){
                    fills=arr[ij].colr;//getsplitcolour(parseInt(ij));
                    tval =arr[ij].value;
                    var resco12 = tval.toString().split('.');
                    var resco1 =resco12[0].replace(/\,/g,'');
                    var amtcomma =moneyFormatIndia((resco1));
                    // reading
                    if ( resco1[1] !== void 0 )
                    {
                    if(resco12[1] != undefined)
                    {
                    amtcomma = amtcomma+'.'+resco12[1];
                    }
                    // amtcomma = amtcomma+'.'+resco12[1];
                    }
                    //split view legend
                    //str_leg +='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+'<br>';
                    // str+='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+':'+amtcomma+'<br>';
                      str+= '<b>'+arr[ij].name+'</b>:'+amtcomma+'<br>';
                   // str+= arr[ij].name+':'+amtcomma+'<br>';
                    }
                    // console.log(str);
                    }
                    str+='</div>';
                    deleteTooltip(e);
                    injectTooltip(e,str);
                    // str+='<div class = "legend1">';

                }

            }
            else
            {
                // e.stopImmediatePropagation();
                str ='';
                str+='<div class = "legend1">';
                str+=$(this).attr('name')
                str+='</div>';
                console.log(str);
                if(typeof $(this).attr('name') !='undefined')
                {
                  deleteTooltip(e);
                  injectTooltip(e,str);
                }
            }

          }






      //}
    });

  //   $("body").on("mouseover", "g", function(e)
  // {
  //   //location_type="";
  //       locid =  $(this).attr('id');
  //       getitem = sessionStorage.getItem('getstate_data');
  //      // console.log("keerthana",getitem);
  //        if(file=="SVG/1---21---21.svg")
  //                {


  //                   file1=file.split("SVG/");
  //                   file2=file1[1].split(".svg");
  //                   file3=file2[0].split("---");
  //                   fileid=file3[0];
  //                   mainloc=file3[1];
  //                   subloc=file3[2];

  //                }
  //                else if(file=="SVG/1---21---1.svg")
  //                {


  //                   file1=file.split("SVG/");

  //                   file2=file1[1].split(".svg");
  //                   file3=file2[0].split("---");
  //                   fileid=file3[0];
  //                   mainloc=file3[1];
  //                   subloc=file3[2];

  //                }


  //               else
  //               {
  //                 file1=file.split("SVG/");
  //                 file11=file1[1].split("/");
  //                 file2=file11[2].split(".svg");
  //                 file3=file2[0].split("---");
  //                 fileid=file3[0];
  //                 mainloc=file3[1];
  //                 subloc=file3[2];
  //               }

  //                  // filesplit(file,"");
  //                   // location_type=sessionStorage.getItem("location_type");
  //                     //gh=sessionStorage.getItem("currentloadfile");

  //            // console.log("keerthana", gh,namegh);
  //        // function loc_names(str1)
  //        // {
  //         //console.log("kkk",str1);
  //       mpdata = JSON.parse(getitem);
  //       // console.log(mpdata);
  //       locid=(locid==73) ? 14878 :locid;
  //       mmd = mpdata[locid];
  //       console.log(locid);


  //        locfilter = sessionStorage.getItem("loc_filter");
  //       // if(locfilter.indexOf(locid) != -1)
  //       // {
  //       var arr = Object.keys(mmd).map(function(k) { return mmd[k] });
  //       arr.sort(function(a,b) {
  //       return b.value-a.value
  //       });
  //       // arr.length = 10;
  //       // console.log();//.row('row-'+locid) " " +str1+
  //          name="";
  //          name = sessionStorage.getItem("loctype");
  //          console.log(name);
  //       str ='';
  //       str+='<div class = "legend1"><b>'+jquerydatatable.row().context[0].aIds[locid]._aData[1] +"-"+name+'</b><br>';
  //         console.log(str);


  //       for(var ij =0;ij<arr.length;ij++)
  //       {
  //           // str ='';
  //           if(ij<10){
  //           fills=getsplitcolour(parseInt(ij));
  //           tval =arr[ij].value;
  //           var resco12 = tval.toString().split('.');
  //           var resco1 =resco12[0].replace(/\,/g,'');
  //           var amtcomma =moneyFormatIndia((resco1));
  //           // reading
  //           if ( resco1[1] !== void 0 )
  //           {
  //           if(resco12[1] != undefined)
  //           {
  //           amtcomma = amtcomma+'.'+resco12[1];
  //           }
  //           // amtcomma = amtcomma+'.'+resco12[1];
  //           }
  //           str+='<i class="circle" style="background:'+fills+'"></i>'+arr[ij].name+'-'+amtcomma+'<br>';
  //         }
  //        console.log(str);
  //       }
  //        str+='</div>';
  //        deleteTooltip(e);
  //         injectTooltip(e,str);//}
  //       //}
  // });
  $("body").on("mouseout", "path", function(e)
  {
      deleteTooltip(e);
  });
  function svgexecution_st(svgname,mapcontent)
  {

    var new_arr=[];
    issetsvg = 1;
    map.data.setStyle(function(feature)
    {
    // else
    return ({
    fillColor: 'white',
    strokeWeight:0
    });
    });
    // console.log(mapcontent);
    try {
    overlay.setMap(null);
    }
    catch(err) {
    //document.getElementById("demo").innerHTML = err.message;
    }
    // if(goperv_svg == 'Y')
    // {
    //       backfile=historyarr[historyarr.length-2];
    //       file1=backfile.split("SVG/");
    //       file2=file1[1].split(".svg");
    //       file3=file2[0].split("---");
    //       fileid=file3[0];
    //       mainloc=file3[1];
    //       subloc=file3[2];
    // }
    // else
    // {
    // historyarr.push('SVG/'+svgname+'.svg');
    // alert(file);
    //alert(svgname);
      svgpath = file.replace('kml','svg');
      svgreplic = svgpath.replace('KML','SVG');

    // svgnm = svgname+'.svg';
     svgreplic = svgpath.replace('.svg','---a.svg');
     svgreplic = svgpath.replace('KML','SVG');
    svgreplic = 'SVG/'+svgname+'---a.svg';
    // }
    // alert(svgreplic);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('GET', svgreplic, false);
    xmlhttp.send();
    overlay = new SvgOverlay({
    content: xmlhttp.responseText,
    map: map
    });
    svg = overlay.getSvg();
    svg.setAttribute('opacity', 1);
    // console.log('overlay.getContainer()');
    tes = overlay.getContainer();

    getitem = sessionStorage.getItem('getstate_data');
    colorsvg = sessionStorage.getItem('colorsvg');
    colorsvg = JSON.parse(colorsvg);
    mpdata = JSON.parse(getitem);

    var arr = Object.keys(mpdata).map(function(k) { return mpdata[k] });
    //console.log( Array.isArray(arr[0]));
    // console.log( typeof arr[0]);
    // objdata= JSON.parse(arr[0]);
    var arrobj = Object.keys(arr[0]).map(function(k) { return arr[0][k] });
    // console.log(arrobj);


  }

   function svgexecution_st_combine(svgname,mapcontent,ipmode,history)
  {


        if(history==0)
        {
          historyarr.push(file);
          sessionStorage.setItem("hist", JSON.stringify(historyarr));
          zoomarr.push(map.getZoom());
          sessionStorage.setItem("zoom", JSON.stringify(zoomarr));
          cphistory.push(sessionStorage.getItem('geolvl'));
          sessionStorage.setItem("cphistory", JSON.stringify(cphistory));
          swbounds.push(sessionStorage.getItem('sw'));
          sessionStorage.setItem("swbounds", JSON.stringify(swbounds));
          nebounds.push(sessionStorage.getItem('ne'));
          sessionStorage.setItem("nebounds", JSON.stringify(nebounds));
        }


    svgpath = file.replace('kml','svg');
      svgpath = svgpath.replace('KML','SVG');
    var new_arr=[];
    issetsvg = 1;
    map.data.setStyle(function(feature)
    {
    // else
    return ({
    fillColor: 'white',
    strokeWeight:0
    });
    });
    // console.log(mapcontent);
    try {
    overlay.setMap(null);
    }
    catch(err) {
    //document.getElementById("demo").innerHTML = err.message;
    }

    svgnm = svgname+'.svg';

    svgreplic = svgname+'---a.svg';
    // }

     if(ipmode == 'cluster')
    {
       svgreplic = svgpath;//.replace('.svg','---a.svg');
    }
    else
    {
        svgreplic = svgpath.replace('.svg','---a.svg');
    }
    // svgreplic = svgpath.replace('.svg','---a.svg');
    // svgrep
    // console.log('ROSE');
    console.log(filesplit16);
    console.log("svg_path",svgreplic);

    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.open('GET', svgreplic, false);
    // xmlhttp.send();

    var ajax = new XMLHttpRequest();
      ajax.open("GET", svgreplic, true);
      ajax.send();


 ajax.onload = function(e)
              {

                    overlay = new SvgOverlay({
                    content: ajax.responseText,
                    map: map,

                    });
                    svg = overlay.getSvg();
                    svg.setAttribute('opacity', 1);
                    // console.log('overlay.getContainer()');
                    tes = overlay.getContainer();

                    getitem = sessionStorage.getItem('getstate_data');
                    colorsvg = sessionStorage.getItem('colorsvg');
                    colorsvg = JSON.parse(colorsvg);
                    mpdata = JSON.parse(getitem);
                      var arr1=[]; var arr2=[]; var arr3=[];
                    var arr = Object.keys(mpdata).map(function(k) { return mpdata[k] });

                    var arrobj = Object.keys(arr[0]).map(function(k) { return arr[0][k] });
                  comb = sessionStorage.getItem('groupby');
                  var topten=[];
                  if(comb=='C')
                   {
                        // overlay.set(null);
                        // reset_reading();''
                                    typeval=$("input[name=type]:checked").val();

                                    if(typeval == 'circle')
                                    {
                                          try {
                                    overlay.setMap(null); //removing svg
                                    }
                                    catch(err) {
                                    //document.getElementById("demo").innerHTML = err.message;
                                    }
                                    }



                              var str_leg =''; var str_leg1 ='';
                                str_leg += '<div class = "legend1"><b>';
                                str_leg1 += '<div class = "legend2"><b>';
                                  str_leg1 +="<ul>";
                      labfin =  getmenulbl();
                   // console.log("rnnnnnnnnn",labfin);
                    str_leg +='<i class="circle" style="background:green"></i>'+labfin+'<br>';
                   str_leg1 +='<li><i class="circle1" style="background:green"></i>'+labfin+"</li>";
                      str_leg1 +="</ul>";
                                str_leg1+='</div>';
                                str_leg+='</div>';
                                $("#legendlabel").html(str_leg);
                                $("#cl").html(str_leg1);
                                $("#cl").hide();
                                $("#legendlabel").show(str_leg);
                    //var arr2=[];
                     // arr2= JSON.parse(colorsvg);
                     // var array1 = $.map(arr1, function(value, index) {
                     //            return [value];
                     //            });
                     //console.log(colorsvg);
                  // {                var str_leg =''; var str_leg1 ='';
                  //               str_leg += '<div class = "legend1"><b>';
                  //               str_leg1 += '<div class = "legend2"><b>';
                  //                 str_leg1 +="<ul>";
                  //                for(i=0;i<array1.length;i++)
                  //               {
                  //               if(i<10)
                  //               {

                  //               str_leg +='<i class="circle" style="background:'+array[i]+'"></i>'+array1[i]+'<br>';
                  //               str_leg1 +='<li><i class="circle1" style="background:'+array[i]+'"></i>'+array1[i]+"</li>";
                  //               }
                  //             }
                  //                       str_leg1 +="</ul>";
                  //               str_leg1+='</div>';
                  //               str_leg+='</div>';
                  //               $("#legendlabel").html(str_leg);
                  //               $("#cl").html(str_leg1);
                  //               $("#cl").hide();
                  //               $("#legendlabel").show(str_leg);

                  }
                  //console.log(arr);
                 else  if(comb != 'C')
                  {


                                      typeval=$("input[name=type]:checked").val();

                                    if(typeval == 'circle')
                                    {
                                          try {
                                    overlay.setMap(null); //removing svg
                                    }
                                    catch(err) {
                                    //document.getElementById("demo").innerHTML = err.message;
                                    }
                                    }

                                // console.log(arrobj);
                                 //overlay.set(null);
                                // reset_reading();
                                var str_leg =''; var str_leg1 ='';
                                str_leg += '<div class = "legend1"><b>';
                                str_leg1 += '<div class = "legend2"><b>';
                                arr1=JSON.parse(itemobj);
                                arr2= JSON.parse(colorsvg);
                                console.log("%%%%%%%%%%%%%%");
                                console.log(charts);
                                $('.highcharts-legend').hide();
                                // $('tspan').hide();

                                var array = $.map(arr2, function(value, index) {
                                return [value];
                                });

                                var array1 = $.map(arr1, function(value, index) {
                                return [value];
                                });str2='';
                                for(i=0;i<array1.length;i++)
                                {

                                if(array1[i].match("age_"))
                                {
                                array1[i] = array1[i].replace(/[0-9]/, "");
                                array1[i] = array1[i].replace("/", "");
                                array1[i] = array1[i].replace("age_", "");
                                array1[i]=array1[i].replace("_","-");
                                array1[i]=array1[i]+"yrs";
                                //arr1[i]=res;
                                }
                                else
                                {


                                array1[i] = array1[i].replace(/[0-9]/g, '');
                                array1[i] = array1[i].replace("/", '');
                                }

                                }

                                res='';
                                str_leg1 +="<ul>";
                                for(i=0;i<array1.length;i++)
                                {
                                if(i<10)
                                {

                                str_leg +='<i class="circle" style="background:'+array[i]+'"></i>'+array1[i]+'<br>';
                                str_leg1 +='<li><i class="circle1" style="background:'+array[i]+'"></i>'+array1[i]+"</li>";
                                }
                                }
                                str_leg1 +="</ul>";
                                str_leg1+='</div>';
                                str_leg+='</div>';

                                $("#legendlabel").html(str_leg);
                                $("#cl").html(str_leg1);
                                $("#cl").hide();
                                $("#legendlabel").show(str_leg);


                  }


                      sw = sessionStorage.getItem('sw');
                      sw=sw.split(",");
                      sw = new google.maps.LatLng(sw[0], sw[1]);
                      ne = sessionStorage.getItem('ne');
                      ne=ne.split(",");
                      ne = new google.maps.LatLng(ne[0], ne[1]);

                    // console.log('filesplit16');
                    // console.log(filesplit16)
                    // console.log(filesplit16[0]);
                    // console.log(filesplit16[1]);
                    // console.log(ipmode);
                  geolvl = sessionStorage.getItem('geolvl');
                  geo=geolvl.split(",");
                  geo=geolvl.split(",");
                  console.log(geolvl);
                  latlng = new google.maps.LatLng(geo[0], geo[1]);
                  if(goprevy != 0)
                  {
                    map.setCenter(latlng);
                  }

                  if(ipmode != '')
                  {

                    if(filesplit16[1]!=21 && filesplit16[2]!=21 ) //&& (filesplit16[0]==filesplit16[1])
                    {
                       // map.setZoom(map.getZoom()+2.2);

                        console.log(filesplit16);
                        console.log('SSSSSSSSS');
                        var center = latlng;
                        var centerPt = overlay.getProjection().fromLatLngToDivPixel(center);

                        if ((parseInt(filesplit16[0])==12) && (parseInt(filesplit16[1]) == 12))
                        {
                               // alert('sd');


                              // var topRightPt = new google.maps.Point(centerPt.x+10, centerPt.y+10);
                              // var botLeftPt = new google.maps.Point(centerPt.x-10, centerPt.y-10);
                              // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                              // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                              var bounds = new google.maps.LatLngBounds(sw,ne);

                              map.fitBounds(bounds);
                        }
                        else if((parseInt(filesplit16[0])==12) && (parseInt(filesplit16[1]) == 15))
                        {

                              // var topRightPt = new google.maps.Point(centerPt.x+15, centerPt.y+15);
                              // var botLeftPt = new google.maps.Point(centerPt.x-15, centerPt.y-15);
                              // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                              // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                              var bounds = new google.maps.LatLngBounds(sw,ne);
                              map.fitBounds(bounds);

                        }

                         else if(parseInt(filesplit16[0])==parseInt(filesplit16[1]))
                        {

                          xpoint = 20;
                          ypoint =20;

                          // var topRightPt = new google.maps.Point(centerPt.x+xpoint, centerPt.y+ypoint);
                          // var botLeftPt = new google.maps.Point(centerPt.x-xpoint, centerPt.y-ypoint);
                          // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                          // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                          var bounds = new google.maps.LatLngBounds(sw,ne);
                              if(goprevy != 0 )
                              {

                                // if(((filesplit16[0] == 7) && (filesplit16[1] = 7) && (fileid == 17)))
                                // {
                                //   // console.log('RRRRRRRRRRRRRRRRRRRRR');
                                // var bounds = new google.maps.LatLngBounds(

                                // new google.maps.LatLng(11.593352,74.04960609999999),
                                // new google.maps.LatLng(18.4411689,78.5860101)
                                // );
                                // map.fitBounds(bounds);
                                // }
                                //  if(((filesplit16[0] == 5) && (filesplit16[1] =5) && (fileid == 1)))
                                // {
                                //   var bounds = new google.maps.LatLngBounds(
                                //   new google.maps.LatLng(7.798000,68.14712),
                                //   new google.maps.LatLng(37.090000,97.34466));
                                //   map.fitBounds(bounds);
                                // }

                                 map.fitBounds(bounds);

                              }
                              else
                              {

                                   map.fitBounds(bounds);
                                    // zoomsvgarray.push(map.getZoom());
                              }




                        }
                        else
                        {
                              // console.log('dumb');
                              // var topRightPt = new google.maps.Point(centerPt.x+50, centerPt.y+50);
                              // var botLeftPt = new google.maps.Point(centerPt.x-50, centerPt.y-50);
                              // var sw = overlay.getProjection().fromDivPixelToLatLng(botLeftPt);
                              // var ne = overlay.getProjection().fromDivPixelToLatLng(topRightPt);
                              var bounds = new google.maps.LatLngBounds(sw,ne);
                              // if(goprevy == 0 )
                              //   {map.fitBounds(bounds);}

                            if(goprevy != 0 )
                              {

                               //  if(((filesplit16[0] == 7) && (filesplit16[1] = 9) && (fileid == 17)))
                               //  {
                               //    var bounds = new google.maps.LatLngBounds(

                               //    new google.maps.LatLng(11.593352,74.04960609999999),
                               //    new google.maps.LatLng(18.4411689,78.5860101)
                               //    );
                               //    map.fitBounds(bounds);
                               //  }
                               // if(((filesplit16[0] == 5) && (filesplit16[1] = 7) && (fileid == 1)))
                               //          {
                               //            var bounds = new google.maps.LatLngBounds(
                               //            new google.maps.LatLng(7.798000,68.14712),
                               //            new google.maps.LatLng(37.090000,97.34466));
                               //            map.fitBounds(bounds);
                               //          }

                               map.fitBounds(bounds);
                              }
                              else
                              {
                                map.fitBounds(bounds);
                                // zoomsvgarray.push(map.getZoom());
                              }
                        }





                    }
                    else
                    {


                        latlng = new google.maps.LatLng(30.36037059235898, -1.847078402945954);
                        map.setCenter(latlng);
                        map.setZoom(1);
                    }
                  }
                  // map.setCenter(new google.maps.LatLng(geo[0], geo[1]));

                  // directionsDisplay = new google.maps.DirectionsRenderer({
                  // draggable: true
                  // });

                  // directionsDisplay.setMap(map);
                  // console.log('Rose');
                  // var bounds = new google.maps.LatLngBounds();
                  // console.log(overlay.geometry.viewport);

                   // map.data.forEach(function(feature) {
                   //  console.log(feature.getGeometry());
                   // });

                    // map.setZoom(map.getZoom()+2.2);
              }

  }

  function filter_svg_color(valuesar,colorsar,str,locid)
  {


      cp = [];
       function getSum(total, num) {
      return total + num;
      }
     totsum = valuesar.reduce(getSum);
     console.log('totsum');
     console.log(totsum)
      for(var j = 0;j<valuesar.length;j++)
      {
          if(j == 10)
          {
            break;
          }
          cp.push(Math.round((valuesar[j]*100)/totsum));
      }



      cp1 = cp;
      // cp1 = cp1.sort();
      // cp1 = cp1.reverse();

        function sortNumber(a,b) {
        return a - b;
        }
        cp1.sort(sortNumber);
      // alert(cp1.join(","));
      cpfinal = [];

      for(var j =0;j<cp1.length;j++)
      {
          if(j == 0)
          {
            cpfinal.push(cp1[j]);
          }
          else
          {
            cpj = cp1[j-1]+cp1[j];
             cpfinal.push(cpj)
          }
      }

       // cp = cp.sort();


      // console.log('CP');
      // console.log(cp);

      // console.log(cp1);
      // console.log(cpfinal);
      // console.log(colorsar);
      // var strs = '<stop offset="0%" style="stop-color:'+colorsar[0]+';stop-opacity:1" />';
      // for(var k =0;k<cpfinal.length;k++)
      // {
      //     if(k == 10)
      //     {
      //       break;
      //     }
      //     strs += '<stop offset="'+cpfinal[k]+'%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
      //     if(typeof colorsar[k+1] != "undefined"){
      //       if(colorsar[k+1] == 10)
      //       {
      //         strs += '<stop offset="100%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
      //         break;
      //       }
      //       else
      //       {
      //         strs += '<stop offset="'+cpfinal[k]+'%" style="stop-color:'+colorsar[k+1]+';stop-opacity:1" />';
      //       }

      //     }
      //     else
      //     {
      //         strs += '<stop offset="100%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
      //         break;
      //     }
      // }
      // $('#solids'+locid).html(strs);
      // console.log(strs);

      // valuesvg = paramarr[0];
      // colorsvg = paramarr[1];
      cp2 = cp;
      cpfinal_t = [];
        for(var j =0;j<cp2.length;j++)
      {
          if(j == 0)
          {
            cpfinal_t.push(cp2[j]);
          }
          else
          {
            var k = j;
            cpj = 0;//cp1[j];
              while (k >= 0) {
                cpj = cpj + cp1[k];
                k--;
              // text += "The number is? " + i;
              // i++;
              }
            // cpj = cp1[j-1]+cp1[j];
             cpfinal_t.push(cpj)
          }
      }
      // console.log(cpfinal_t);


       var strs1 = '';
      for(var k =0;k<cpfinal_t.length;k++)
      {
              if(k==0){
                strs1 = '<stop offset="0%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
                strs1 += '<stop offset="'+cpfinal_t[k]+'%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
             }
             else
             {
                strs1 += '<stop offset="'+cpfinal_t[k-1]+'%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
                strs1 += '<stop offset="'+cpfinal_t[k]+'%" style="stop-color:'+colorsar[k]+';stop-opacity:1" />';
             }
      }
      $('#solids'+locid).html(strs1);
      console.log(strs1);
      // '<stop offset="0%" style="stop-color:'+$cc[0]+';stop-opacity:1" />'
  }
  function toptenseries(vall)
  {

    // getitem = sessionStorage.getItem('getstate_data');
    // mpdata = JSON.parse(getitem);
      // console.log('vall');
      // console.log(vall);
  }
  // loadsvg();
  function loadsvg()
  {
      var tst = sessionStorage.getitem("currentloadfile");
      alert('robinson');
      //sessionStorage.setItem('svgpath',file);
      // alert('loadsvg');
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open('GET', '1---5---7.svg', false);
      xmlhttp.send();
      overlay = new SvgOverlay({
      content: xmlhttp.responseText,
      map: map
      });
      svg = overlay.getSvg();
      svg.setAttribute('opacity', 1);
  }
  function testpath()
  {
   alert('I am here');
   }

    </script>
