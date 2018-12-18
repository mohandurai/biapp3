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
include("function.php");

$mapload=new Loadmap();
$fileloc=$mapload->init($clientuserid);
$searchls=$mapload->search();
?>
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
<link rel='stylesheet' href='css/spectrum.css' />
<link rel="stylesheet" href="css/jquery-confirm.min.css">
<!-- <link rel="stylesheet" href="tipped.css"> -->

<!-- <link rel="stylesheet" type="text/css" href="tipped.css"/> -->

<script src="js/jquery.js"></script>
<script src="js/highstock.js"></script>
<script src="js/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="togeojson.js"></script>
<script src="geoxml3.js"></script>
<script src="js/jquery-confirm.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/tooltip.js"></script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src='js/spectrum.js'></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/piecharts_new.js"></script>
<script type="text/javascript" language="javascript" src="js/gradient.js"></script>
<!-- <script type="text/javascript" language="javascript" src="tipped.js"></script> -->
<!-- <script type="text/javascript" src="custom_tooltip.js"></script> -->
<!-- <script src="http://maptooltip.googlecode.com/files/mapTooltip.js" type="text/javascript"></script> -->




<!--Geo json conversion End-->
<style type='text/css'>

    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0;}
    .map { height: 100% }

    #map {
        position: relative;
        top:0;
        left: 0;
        right: 0;
        bottom:0;
        width: 100%; height: 100%; float: left;
    }
    #map div {
	 cursor:default !important;
	}
    #chart {
        position: relative;

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
        padding: 0 1px 0 0;
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

	ul{
	    background-color:#eee;
	    cursor:pointer;
	}
	li{
	    padding:12px;
	}


  .legend1 {
text-align: left;
width: 200px;
line-height: 18px;
color: #555;
}

.legend1 .circle {
float: left;
  width: 10px;
  height: 10px;
  margin: 0 5px 0 0;
  border: 1px solid rgba(0, 0, 0, .2);
}

.report-container
{
    padding: 0 0;
    margin: 10px 5px 80px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    -webkit-box-shadow:0 2px 10px rgba(0, 0, 0, 0.2);
    display: block;
    float: left;
    width: 99%;
      border: 1px solid #000;
}
.report-header
{
  background: #333;
  display: block;
  float: left;
  width: 100%;

}
.report-container h4
{
  margin: 0;
  padding: 5px 10px;
  color: #ffffff;
  display:  inline-block;
  font-size: 14px;
}
.report-header select.form-control
{
  width: auto;
  display: inline;
  float: right;

  color: #000;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background: url('../images/icons/dropdown.png') no-repeat 96% 50% #fff;
  border-radius: 0;
  border: none;
  outline: none;
  margin: 3px 7px;
  padding: 0 5px;
  min-width: 150px;
  font-size: 14px;
  height: 20px;
}
#tool{
text-align: center;
    border: 3px solid green;


}
/* a[href^="http://maps.google.com/maps"]{display:none !important}
a[href^="https://maps.google.com/maps"]{display:none !important}
.gm-style-cc
{
  display: none;
} */
</style>

<script type="text/javascript">

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
sessionStorage.setItem("loc_filter",'');
sessionStorage.setItem("variable_fiter",'');
sessionStorage.setItem("range_filter",'');
sessionStorage.setItem('selectval','');

</script>




  <body onload="loadScript()">
<!-- <div class="loading" >Loading&#8230;</div> -->
  <input type="text" id="markeropt" hidden="true" value="0"/>

      <div class="map-container">
          <div class="widget-tittle">
          <h5 id="mapname">Map</h5>
          </div>
            <div id="style-selector-control"  class="map-control">
                <select id="style-selector" class="selector-control">
                  <option value="default">Default</option>
                  <option value="silver">Silver</option>
                  <option value="night">Night mode</option>
                  <option value="retro" selected="selected">Retro</option>
                  <option value="hiding">Hide features</option>
                </select>
              </div>
               <!-- <input id="pac-input" class="controls" type="text" placeholder="Search Box"> -->
               <input type="text" placeholder="Name" id="customerAutocomplte" class="ui-autocomplete-input" autocomplete="off" />

              <div id="map">
               <div id="tool"></div>
              </div>
      </div>

          <div class="chart-container">
              <div class="widget-tittle">
                  <h5 id="chartname">Chart</h5>
              </div>
              <div id="chart">
              <img id="imgh"/>
              </div>
          </div>


<br>

<div class="report-container">
  <div class="report-header">
           <h4 id="reportname">Data view</h4>

              <select name="language" class="form-control reading-conv">
                  <option value="4">Hundreds.</option>
                  <option value="1">Crs.</option>
                  <option value="2">lacs.</option>
                  <option value="3">Thousands</option>
              </select>

  </div>
    <div id="report" class="">

    </div>
</div>
<div id="info"></div>
 <div id="right-panel">
      <span class="close">X</span>
 </div>

</body>
<!--MAP-->

<script>

// var fakedata = ['test1','test2','test3','test4','ietsanders'];
// $("#customerAutocomplte").autocomplete({source:fakedata})

baseurl='<?php echo  $fileurl;?>';
 $( "#customerAutocomplte" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "searchloc.php",
          dataType: "json",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
         $(this).val(ui.item.label);
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
           locid = ui.item.data
           locid = locid.toString();
           loclvl = ui.item.loc;
           loclvl= loclvl.toString();
           // alert(lat);
           initfile = 'KML/'+locid+'---'+loclvl+'---'+loclvl+'.kml';

            statuscode=UrlExists(baseurl+initfile);
                       console.log(statuscode);
                       if(statuscode == true)
                        {

                            var callback1 = function(feature) {
                            map.data.remove(feature);
                            removeAllcircles();
                        };
                        map.data.forEach(callback1);
                      }


           initlayer(map,initfile,0,0,'');


           view = sessionStorage.getItem('view');
              year = sessionStorage.getItem('year');
              menu_item_id = sessionStorage.getItem('categs');
            // alert(view+" / "+year+" / "+menu_item_id);
            if(view != '' && year != '' && menu_item_id != '')
            {

               // $('.loading', window.parent.document).show();
              // alert(view);
              map.data.revertStyle();
              combinesplit_res();
          }


           // initlayer(map,nextlevelfile,0,0,'');
          // var center = new google.maps.LatLng(  lat,lang);
          // map.panTo(center);

          // map.setZoom(17);
          // zoom(map);
          console.log(ui.item.refid);
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
    });
  // });

//console.log

// $('#customerAutocomplte').autocomplete({
//     serviceUrl: '/autocomplete/countries',
//     onSelect: function (suggestion) {
//         alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
//     }
// });

var $info = $('#info');
var map;
var file;
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
var map;
var historyarr=[];
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
           // console.log(jquerydatatable.rows( { filter : 'applied'} ).data());
           // console.log( jquerydatatable.columns( { filter : 'applied'} ).data());

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
var initfile='KML/<?php echo $fileloc?>.kml';
//initialize map
function initMap() {

        drawingTool =   new google.maps.drawing.DrawingManager;
        directionsService = new google.maps.DirectionsService;

        map = new google.maps.Map(document.getElementById('map'),
         {

        center: {lat: 23, lng: 78},
        zoom: 1,
        gestureHandling: 'greedy',
        preserveViewport: true,
        zoomControl: true,
        panControl:true,
        disableDoubleClickZoom: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        draggable: false,
        scrollwheel: false,

        streetViewControl: false,

        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: true,
        mapTypeControlOptions: {
        //   mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
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
         // document.getElementById("myDIV").style.display = "none";
       //css('width', '100px !important');
      initlayer(map,initfile,0,0,'');
       // $('#map').attr("style", "display: block !important");
      // $('#map').css('display','block !important');
      // initlayer('KML/1---5---7.kml',0,0);
      maptraverse(map,initfile);
      lisenter();
              var styleControl = document.getElementById('style-selector-control');
              map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

              // Set the map's style to the initial value of the selector.
              var styleSelector = document.getElementById('style-selector');
              map.setOptions({styles: styles[styleSelector.value]});

              // Apply new JSON when the user selects a different style.
              styleSelector.addEventListener('change', function() {
                map.setOptions({styles: styles[styleSelector.value]});
              });


}

//initialize layer fn
function initlayer(map,files,history,circle,zoomlevel) //initlayer(map,initfile,0,0,'');
{
  // alert(zoomlevel);

	 fetaurearr=[];
	 fileloc1=files.split("/");
     fileloc12=fileloc1[1].split(".kml");
     filesplit16 =fileloc12[0].split("---");
        if(zoomlevel != '')
        {
          var bounds = map.getBounds();
          var ne = bounds.getNorthEast(); // LatLng of the north-east corner
          var sw = bounds.getSouthWest(); // LatLng of the south-west corder
          var nw = new google.maps.LatLng(ne.lat(), sw.lng());
          var se = new google.maps.LatLng(sw.lat(), ne.lng());
 		      map.setZoom(zoomlevel);


        }

        file=files;
        sessionStorage.setItem('maplevel',file);
        var conversion=[];
        var allMarkers = [];
        centerpoint=[];
        if(circle==1)
        {
          locationlayer();
          $("#rep").val("circle")
        }
        else
        {        $("#rep").val("")
                if(file=="KML/1---21---21.kml")
             {
                   $("#mapname").text("Global");
              }
            $.ajax(file).done(function(xml)
            {

              conversion = toGeoJSON.kml(xml);
              layer=map.data.addGeoJson(conversion);

               if(filesplit16[1]!=21 && filesplit16[2]!=21){
                zoom(map);
              }

            });


        }




        if(history==0)
        {
           historyarr.push(files);
           zoomarr.push(map.getZoom());
        }
        togglelocationload(files);
        // $('#map').css('display','block');

}

function zoom(map) {
        var bounds = new google.maps.LatLngBounds();
        // map = new google.maps.Map(el, {animatedZoom: false});
        map.data.forEach(function(feature) {
          processPoints(feature.getGeometry(), bounds.extend, bounds);
        });
        map.fitBounds(bounds);

    if($("#map").attr("style")!='height:100%;width:100%;position: relative; overflow: hidden;')
    {
        // $("body").css('display','none');
        if(map.getZoom()<6)
        {
          map.setZoom(map.getZoom()+0.7);
        }
        // $("body").css('display','block');
    }
      }
function maptraverse(map1)
{



    // Set the  style

    map1.data.setStyle(function(feature) {


          return {

          	strokeColor: '#000',
            strokeOpacity:1,
            strokeWeight: 2,
            fillColor: '#FFF',
            fillOpacity: 1,

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

      	map1.setOptions({ draggable : false });

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
                fileloc2=fileloc[1].split(".kml");
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
    map1.data.addListener('mouseover', function(event) {

    //change


        if(colorcodeid.length > 0)
        {
          if(areavalue[event.feature.getProperty('DB_ID')] != undefined)
          {
             var title = event.feature.getProperty('Name');
              title =" <b> "+title+"- </b>"+areavalue[event.feature.getProperty('DB_ID')]+"<br>";
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
        else
        {
            if($("#markeropt").val()==0)
            {

                  // map.data.setStyle({title: 'Hovering here???'});
                // Tipped.create('#map', $('<b/>').html(event.feature.getProperty('Name')), { position: 'bottomright' });
              // var title = event.feature.getProperty('Name');
              // infowindow.setContent(title);
              // infowindow.setPosition(event.latLng);
              // infowindow.open(map, map.data);
             // map1.data.overrideStyle(event.feature, {fillColor: '#ffff00'});
             console.log(event.feature.getProperty('Name'));
             // $( "#markeropt" ).tooltip({ content: '<img src="http://icdn.pro/images/fr/a/v/avatar-barbe-brun-homme-utilisateur-icone-9665-128.png" />' });
              injectTooltip(event, event.feature.getProperty('Name'));
             console.log(event);
            }
        }
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
    map1.data.addListener('dblclick', function(event) {
            fileid="";


           refid=[];mastername=[];
      //map.disableScrollWheelZoom();
    	//$('.loading', window.parent.document).show();
    	//$(".loading").show();
      // if(filesplit6[1] == filesplit6[2]){

      //     map.setZoom(map.getZoom()+1);
      // }

		//	$('.loading', window.parent.document).show();
           //alert(event.feature.getProperty('DB_ID'));
           var nextlevelfile=null;
           $('.loading', window.parent.document).show();
        setTimeout(function(){
        	$.ajax({
                   type: "POST",
                   url: "AjaxRequest.php",
                   data:{"nextlevel":"nextlevel","id":event.feature.getProperty('DB_ID'),"currentlevel":file},
                   async:false,

                  success: function (data) {

                      nextlevelfile = data;

                            if( nextlevelfile=="KML/14878---12---15.kml")
                            {
                              nextlevelfile="";
                              nextlevelfile="KML/73---12---15.kml";
                            }
                              if( nextlevelfile=="KML/13346---12---15.kml")
                            {
                              nextlevelfile="";
                              nextlevelfile="KML/676---12---15.kml";
                            }
                       if (nextlevelfile && nextlevelfile !=undefined)
                        {
                       statuscode=UrlExists(baseurl+nextlevelfile);
                       console.log(statuscode);
                       if(statuscode == true)
                        {

                            var callback1 = function(feature) {
                            map1.data.remove(feature);
                            removeAllcircles();
                        };
                        map1.data.forEach(callback1);

                          // $('#map').attr("style", "display: none !important");
                       initlayer(map,nextlevelfile,0,0,'');
                         // $('#map').attr("style", "display: block !important");
                       //map1.clearInstanceListeners(data);
                     $('.loading', window.parent.document).hide();

                                         file1=nextlevelfile.split("KML/");
                                            file2=file1[1].split(".kml");
                                             file3=file2[0].split("---");
                                             fileid=file3[0];
                                              mainloc=file3[1];
                                             subloc=file3[2];


                                              file11=file.split("KML/");
                                            file12=file11[1].split(".kml");
                                             file13=file12[0].split("---");
                                             fileid1=file13[0];
                                              mainloc1=file13[1];
                                             subloc1=file13[2];
                                  console.log(mainloc1,"---------",mainloc);

                                  arr1=[];arr2=[];
                                  if(mainloc1==mainloc)
                                  {
                              mapname(mainloc,subloc,mainloc1,subloc1,fileid);
                            }


                              if(mainloc=="21"&&subloc=="1")
                                               {
                                                   $("#mapname").text("Country");
                                               }

                       }
                       else
                       {
							$('.loading', window.parent.document).hide();
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
            // alert(view+" / "+year+" / "+menu_item_id);
            if(view != '' && year != '' && menu_item_id != '')
            {

			         // $('.loading', window.parent.document).show();
              // alert(view);
              map.data.revertStyle();
              combinesplit_res();
          }

        },500);




    });
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
        var centerControl = new BackControl(themeControlDiv,showhideControlDiv,screenControlDiv,backControlDiv,addControlDiv,deleteControlDiv,routeControlDiv,downloadControlDiv,locationControlDiv,toggleControlDiv,searchControlDiv,filterControlDiv,handmoveControlDiv, map);
        themeControlDiv.index=1;
        screenControlDiv.index = 2;
        backControlDiv.index = 3;
        addControlDiv.index = 4;
        deleteControlDiv.index = 5;
        routeControlDiv.index=6;
        downloadControlDiv.index=7;
        locationControlDiv.index=8;
        toggleControlDiv.index=9;
        searchControlDiv.index=10;
        filterControlDiv.index=11;
        handmoveControlDiv.index=12;
        showhideControlDiv.index=13;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(themeControlDiv);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(showhideControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(screenControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(backControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(addControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(deleteControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(routeControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(downloadControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(locationControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(toggleControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(searchControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(filterControlDiv);
        map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(handmoveControlDiv);


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
                                    url: 'http://192.168.10.82/biweb9/web/sales/'+iconi,
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
                                    url: 'http://192.168.10.82/biweb9/web/sales/'+iconi,
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
                                    url: 'http://192.168.10.82/biweb9/web/sales/'+iconi,
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
function BackControl(themecontrolDiv,showhidecontrolDiv,screencontrolDiv,controlDiv,controlDivadd,controlDivdelete,controlDivroute,controlDivdownload,controlDivlocation,controlDivtoggle,controlDivsearch,filterControlDiv,handControlDiv, map) {
          //showhide control start
        // Set CSS for the control border.
        var controlUIshowhide = document.createElement('div');
        controlUIshowhide.style.backgroundColor = '#fff';
        controlUIshowhide.style.border = '2px solid #fff';
        //controlUIshowhide.style.borderRadius = '3px';
        controlUIshowhide.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIshowhide.style.cursor = 'pointer';
        controlUIshowhide.style.marginBottom = '0px';
        controlUIshowhide.style.textAlign = 'center';
        controlUIshowhide.title = 'Show/Hide Toolbar';
        showhidecontrolDiv.appendChild(controlUIshowhide);

        // Set CSS for the control interior.
        var controlTextshowhide = document.createElement('div');
        controlTextshowhide.style.color = 'rgb(25,25,25)';
        controlTextshowhide.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextshowhide.style.fontSize = '25px';
        controlTextshowhide.style.lineHeight = '18px';
        // controlTextshowhide.style.paddingLeft = '4px';
        // controlTextshowhide.style.paddingRight = '5px';
        controlTextshowhide.innerHTML = '<img src="images/close.svg" class="select-icon" width="16" height="16" id = "showhide" />';
        controlUIshowhide.appendChild(controlTextshowhide);
        //showhide control End
         //Screen control start
        // Set CSS for the control border.
        var controlUIscreen = document.createElement('div');
        controlUIscreen.style.backgroundColor = '#fff';
        controlUIscreen.style.border = '2px solid #fff';
        //controlUIscreen.style.borderRadius = '3px';
        controlUIscreen.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIscreen.style.cursor = 'pointer';
        controlUIscreen.style.marginBottom = '0px';
        controlUIscreen.style.textAlign = 'center';
        controlUIscreen.title = 'zoomchange';
        screencontrolDiv.appendChild(controlUIscreen);

        // Set CSS for the control interior.
        var controlTextscreen = document.createElement('div');
        controlTextscreen.style.color = 'rgb(25,25,25)';
        controlTextscreen.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextscreen.style.fontSize = '25px';
        controlTextscreen.style.lineHeight = '18px';
        controlTextscreen.style.paddingLeft = '4px';
        controlTextscreen.style.paddingRight = '4px';
        controlTextscreen.innerHTML = '<img src="images/if_fullscreen_118670.svg" class="select-icon" width="16" height="16" id = "zoomchange" title="Full Screen" type="image"/>';
        controlUIscreen.appendChild(controlTextscreen);



        //filter control
        var filtercontrolUI = document.createElement('div');
        filtercontrolUI.style.backgroundColor = '#fff';
        filtercontrolUI.style.border = '2px solid #fff';
        //controlUIscreen.style.borderRadius = '3px';
        filtercontrolUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        filtercontrolUI.style.cursor = 'pointer';
        filtercontrolUI.style.marginBottom = '0px';
        filtercontrolUI.style.textAlign = 'center';
        filtercontrolUI.title = 'filter';
        filterControlDiv.appendChild(filtercontrolUI);



         // Set CSS for the filter interior.
        var filterTextscreen = document.createElement('div');
        filterTextscreen.style.color = 'rgb(25,25,25)';
        filterTextscreen.style.fontFamily = 'Roboto,Arial,sans-serif';
        filterTextscreen.style.fontSize = '25px';
        filterTextscreen.style.lineHeight = '18px';
        filterTextscreen.style.paddingLeft = '4px';
        filterTextscreen.style.paddingRight = '4px';
        filterTextscreen.innerHTML = '<img src="images/57164.svg" class="select-icon" width="16" height="16" id = "filtercontr" title="Filter"/>';
        filtercontrolUI.appendChild(filterTextscreen);







        //Screen Control End
        //Back control start
        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        //controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '0px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Back';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '25px';
        controlText.style.lineHeight = '18px';
        controlText.style.paddingLeft = '4px';
        controlText.style.paddingRight = '4px';
        controlText.innerHTML = '<img src="images/back.svg" class="select-icon" width="16" height="16" id = "bakc" title="Back"/>';
        controlUI.appendChild(controlText);
        //Back Control End
        //Add marker Control Start
        var controlUId = document.createElement('div');
        controlUId.style.backgroundColor = '#fff';
        controlUId.style.border = '2px solid #fff';
       // controlUId.style.borderRadius = '3px';
        controlUId.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUId.style.cursor = 'pointer';
        controlUId.style.marginBottom = '0px';
        controlUId.style.textAlign = 'center';
        controlUId.title = 'Add Marker';
        controlDivadd.appendChild(controlUId);

        // Set CSS for the control interior.
        var controlTextd = document.createElement('div');
        controlTextd.style.color = 'rgb(25,25,25)';
        controlTextd.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextd.style.fontSize = '25px';
        controlTextd.style.lineHeight = '18px';
        controlTextd.style.paddingLeft = '4px';
        controlTextd.style.paddingRight = '4px';
        controlTextd.innerHTML = '<img src="images/aerial_dist.svg" width="16" height="16" title="Aerial distance" id = "colordist"/>';
        controlUId.appendChild(controlTextd);
        //Addmarker Control End

        //delete Control Start
        var controlUIdelete = document.createElement('div');
        controlUIdelete.style.backgroundColor = '#fff';
        controlUIdelete.style.border = '2px solid #fff';
       // controlUIdelete.style.borderRadius = '3px';
        controlUIdelete.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdelete.style.cursor = 'pointer';
        controlUIdelete.style.marginBottom = '0px';
        controlUIdelete.style.textAlign = 'center';
        controlUIdelete.title = 'Delete Overlay';
        controlDivdelete.appendChild(controlUIdelete);

        // Set CSS for the control interior.
        var controlTextddelete = document.createElement('div');
        controlTextddelete.style.color = 'rgb(25,25,25)';
        controlTextddelete.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextddelete.style.fontSize = '25px';
        controlTextddelete.style.lineHeight = '18px';
        controlTextddelete.style.paddingLeft = '4px';
        controlTextddelete.style.paddingRight = '4px';
        controlTextddelete.innerHTML = '<img src="images/60761.svg" width="16" height="16" title="Remove All Layers" id = "colorremove"/>';
        controlUIdelete.appendChild(controlTextddelete);
        //Delete  Control End

        //Find the route Control Start
        var controlUIroute = document.createElement('div');
        controlUIroute.style.backgroundColor = '#fff';
        controlUIroute.style.border = '2px solid #fff';
       // controlUIroute.style.borderRadius = '3px';
        controlUIroute.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIroute.style.cursor = 'pointer';
        controlUIroute.style.marginBottom = '0px';
        controlUIroute.style.textAlign = 'center';
        controlUIroute.title = 'Find the route Overlay';
        controlDivroute.appendChild(controlUIroute);

        // Set CSS for the control interior.
        var controlTextdroute = document.createElement('div');
        controlTextdroute.style.color = 'rgb(25,25,25)';
        controlTextdroute.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextdroute.style.fontSize = '25px';
        controlTextdroute.style.lineHeight = '28px';
        controlTextdroute.style.paddingLeft = '4px';
        controlTextdroute.style.paddingRight = '4px';
        controlTextdroute.innerHTML = '<img src="images/25386.svg" width="16" height="16" title="Show Distance" id = "colorshowdist" />';
        controlUIroute.appendChild(controlTextdroute);
        //Find the route  Control End

         // download Control Start
        var controlUIdownload = document.createElement('div');
        controlUIdownload.style.backgroundColor = '#fff';
        controlUIdownload.style.border = '2px solid #fff';
       // controlUIdownload.style.borderRadius = '3px';
        controlUIdownload.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdownload.style.cursor = 'pointer';
        controlUIdownload.style.marginBottom = '0px';
        controlUIdownload.style.textAlign = 'center';
        controlUIdownload.title = 'Export to image';
        controlDivdownload.appendChild(controlUIdownload);

        // Set CSS for the control interior.
        var controlTextddownload = document.createElement('div');
        controlTextddownload.style.color = 'rgb(25,25,25)';
        controlTextddownload.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextddownload.style.fontSize = '25px';
        controlTextddownload.style.lineHeight = '18px';
        controlTextddownload.style.paddingLeft = '4px';
        controlTextddownload.style.paddingRight = '4px';
        controlTextddownload.innerHTML = '<img src="images/128472.svg" width="16" height="16" id="colorexptoimg" title="Export To image"/>';
        controlUIdownload.appendChild(controlTextddownload);
        // download  Control End


        // Location Control Start
        var controlUILocation = document.createElement('div');
        controlUILocation.style.backgroundColor = '#fff';
        controlUILocation.style.border = '2px solid #fff';
       // controlUILocation.style.borderRadius = '3px';
        controlUILocation.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUILocation.style.cursor = 'pointer';
        controlUILocation.style.marginBottom = '0px';
        controlUILocation.style.textAlign = 'center';
        controlUILocation.title = 'Location Layer';
        controlDivlocation.appendChild(controlUILocation);

        // Set CSS for the control interior.
        var controlTextdLocation = document.createElement('div');
        controlTextdLocation.style.color = 'rgb(25,25,25)';
        controlTextdLocation.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextdLocation.style.fontSize = '25px';
        controlTextdLocation.style.lineHeight = '18px';
        controlTextdLocation.style.paddingLeft = '4px';
        controlTextdLocation.style.paddingRight = '4px';
        controlTextdLocation.innerHTML = ' <a  class="colorloc" data-backdrop="static" data-toggle="modal" data-target="#myModal"><img src="images/69399.svg" width="16" height="16" title="Location Layer" id = "colorloc" /></a>';
        controlUILocation.appendChild(controlTextdLocation);
        // Location  Control End

         // Toggle Control Start
        var controlUIToggle = document.createElement('div');
        controlUIToggle.style.backgroundColor = '#fff';
        controlUIToggle.style.border = '2px solid #fff';
       // controlUIToggle.style.borderRadius = '3px';
        controlUIToggle.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIToggle.style.cursor = 'pointer';
        controlUIToggle.style.marginBottom = '0px';
        controlUIToggle.style.textAlign = 'center';
        controlUIToggle.title = 'Toggle Layer';
        controlDivtoggle.appendChild(controlUIToggle);

        // Set CSS for the control interior.
        var controlTextdToggle = document.createElement('div');
        controlTextdToggle.style.color = 'rgb(25,25,25)';
        controlTextdToggle.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextdToggle.style.fontSize = '25px';
        controlTextdToggle.style.lineHeight = '18px';
        controlTextdToggle.style.paddingLeft = '4px';
        controlTextdToggle.style.paddingRight = '4px';
        controlTextdToggle.innerHTML = ' <a  class="colortogg" data-backdrop="static" data-toggle="modal" data-target="#toggleModal"><img src="images/77756.svg" width="16" height="16" title="Toggle Location" id ="colortogg"/></a>';
        controlUIToggle.appendChild(controlTextdToggle);
        // Toggle  Control End

         // Search Data set Control Start
        var controlUISearch = document.createElement('div');
        controlUISearch.style.backgroundColor = '#fff';
        controlUISearch.style.border = '2px solid #fff';
       // controlUISearch.style.borderRadius = '3px';
        controlUISearch.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUISearch.style.cursor = 'pointer';
        controlUISearch.style.marginBottom = '0px';
        controlUISearch.style.textAlign = 'center';
        controlUISearch.title = 'Search Data set Layer';
        controlDivsearch.appendChild(controlUISearch);

        // Set CSS for the control interior.
        var controlTextdSearch = document.createElement('div');
        controlTextdSearch.style.color = 'rgb(25,25,25)';
        controlTextdSearch.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextdSearch.style.fontSize = '25px';
        controlTextdSearch.style.lineHeight = '18px';
        controlTextdSearch.style.paddingLeft = '4px';
        controlTextdSearch.style.paddingRight = '4px';
        controlTextdSearch.innerHTML = ' <a  class="colorsearch" data-backdrop="static" data-toggle="modal" data-target="#searchModal"><img src="images/54554.svg" width="16" height="16" title="Search Data Set" id = "colorsearch"/></a>';
        controlUISearch.appendChild(controlTextdSearch);
        // Search Data set  Control End
         //Move control start
        // Set CSS for the control border.
        var controlUIdrag = document.createElement('div');
        controlUIdrag.style.backgroundColor = '#fff';
        controlUIdrag.style.border = '2px solid #fff';
        //controlUIdrag.style.borderRadius = '3px';
        controlUIdrag.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUIdrag.style.cursor = 'pointer';
        controlUIdrag.style.marginBottom = '0px';
        controlUIdrag.style.textAlign = 'center';
        controlUIdrag.title = 'Back';
        handControlDiv.appendChild(controlUIdrag);

        // Set CSS for the control interior.
        var controlTextdrag = document.createElement('div');
        controlTextdrag.style.color = 'rgb(25,25,25)';
        controlTextdrag.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlTextdrag.style.fontSize = '25px';
        controlTextdrag.style.lineHeight = '18px';
        controlTextdrag.style.paddingLeft = '4px';
        controlTextdrag.style.paddingRight = '4px';
        controlTextdrag.innerHTML = '<img src="images/drag.svg" class="select-icon" width="16" height="16" id = "bakc" title="Drag Map"/>';
        controlUIdrag.appendChild(controlTextdrag);
        //Move Control End
        controlUIshowhide.addEventListener('click', function() {
        	if(controlUIdownload.style.display!='none')
        	{
        		controlUIshowhide.innerHTML='<img src="images/open.svg" class="select-icon" width="16" height="16" id = "showhide" />';
        		controlUIdownload.style.display='none';
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
        		controlUIshowhide.innerHTML='<img src="images/close.svg" class="select-icon" width="16" height="16" id = "showhide" />';
        		controlUIdownload.style.display='block';
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
            //$('#zoomchange').attr('src', 'images/if_fullscreen_118670.svg');
              $("img").parent('div').css({"background": "#ffffff"});
              $("a").parent('div').css({"background": "#ffffff"});
             $("#zoomchange").parent('div').css({"background": "#ffffff"});

          }
          else
          {
            $(".map-container").attr("style","height:100%;width:99%;position: relative; overflow: hidden;");
            $(".chart-container").attr("style","display:none;");
            $(".report-container").attr("style","display:none;");
            //$('#zoomchange').attr('src', 'images/active/if_fullscreen_118670.svg');
              $("img").parent('div').css({"background": "#ffffff"});
              $("a").parent('div').css({"background": "#ffffff"});
             $("#zoomchange").parent('div').css({"background": "#d93637"});
          }


        });
        // Back button the click event listeners
        controlUI.addEventListener('click', function() {
           $("img").parent('div').css({"background": "#ffffff"});
           $("a").parent('div').css({"background": "#ffffff"});
          $("#bakc").parent('div').css({"background": "#d93637"});
          goprev();

        });
        //Add Marker Control event
         controlUId.addEventListener('click', function() {
            $("img").parent('div').css({"background": "#ffffff"});
            $("a").parent('div').css({"background": "#ffffff"});
           $("#colordist").parent('div').css({"background": "#d93637"});
            $("#markeropt").val(1);

          });

         //Delete Control event
         controlUIdelete.addEventListener('click', function() {
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
           $("#colorremove").parent('div').css({"background": "#d93637"});
           removeAlllayer();
          });

         //Find the route Control event
         controlUIroute.addEventListener('click', function() {
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
           $("#colorshowdist").parent('div').css({"background": "#d93637"});
           $("#markeropt").val(2);

          });
          //Download Control event
         controlUIdownload.addEventListener('click', function() {
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
            $("#colorexptoimg").parent('div').css({"background": "#d93637"});
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
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
             $(".colorloc").parent('div').css({"background": "#d93637"});
           $("#markeropt").val(3);

          });

           //Toggle layer
         controlUIToggle.addEventListener('click', function() {
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
           $(".colortogg").parent('div').css({"background": "#d93637"});

          });
            //Search  layer
         controlUISearch.addEventListener('click', function() {
             $("img").parent('div').css({"background": "#ffffff"});
             $("a").parent('div').css({"background": "#ffffff"});
            $(".colorsearch").parent('div').css({"background": "#d93637"});

          });


          filtercontrolUI.addEventListener('click', function() {
              $("img").parent('div').css({"background": "#ffffff"});
              $("a").parent('div').css({"background": "#ffffff"});
              $(".filtercontr").parent('div').css({"background": "#d93637"});
              // alert('clicked');
              dialog();

          });
           controlUIdrag.addEventListener('click', function() {
               $("img").parent('div').css({"background": "#ffffff"});
             $("#bakc").parent('div').css({"background": "#d93637"});
           		map.setOptions({ draggable : true });

          });

}



  function getsplitcolour(d)
  {
    switch (d) {
    case 0: return 'rgb(243, 12, 12)';
    case 1: return 'rgb(27, 104, 7)';
    case 2: return 'rgb(0, 0, 255)';
    case 3: return 'rgb(17, 108, 223)';
    case 4: return 'rgb(172, 117, 7)';
    case 5: return 'rgb(226, 240, 13  )';
    case 6: return 'rgb(79, 84, 12)';
    case 7: return 'rgb(84, 12, 13)';
    case 8: return 'rgb(12, 84, 78)';
    case 9: return 'rgb(101, 12, 117 )';


    }
  }


</script>
<!--  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRESpBhv5lPuCXaoW-cWdZB2q0KKV-dwA&callback=initMap">
    </script> -->

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
              d=18;
              return d;
              }
              else if(d>40)
              {
              d=16;
              return d;
              }
              else if(d>30)
              {
              d=14;
              return d;
              }
              else if(d>20)
              {
              d=12;
              return d;
              }
              else if(d>10)
              {
              d=10;
              return d;
              }
              else if(d>5)
              {
              d=9;
              return d;
              }

              else if(d>0)
              {
              d=7;
              return d;
              }
              else
              {
              d=4;
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

function loadScript() {
    var myKey = "AIzaSyCWN1D6LyQlKiP63eBS3Mi4HZb8n1bBDlk";
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = "https://maps.googleapis.com/maps/api/js?callback=initMap&libraries=geometry,drawing";
    document.body.appendChild(script);



}
  </script>

 <script src="js/markerclusterer.js">
    </script>
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
function mapname(mainloc,subloc,mainloc1,subloc1,fileid)
{



            if(mainloc==mainloc1)
            {


                  $.ajax({
                url:'AjaxRequest.php' ,
                type:"POST",
                data:{"mainlocation":mainloc,
                "sublocation": mainloc1

                },

                success: function(response)
                 {
                         // alert("keerthana");

                  k=JSON.parse(response);
                  for(i=0;i<k.length;i++)
                  {

                            geo = k[i].split(',');
                       arr1.push(geo[0]);
                      arr2.push(geo[1]);
                  }
               console.log(arr1,arr2);
                if(fileid=="73"&&mainloc=="12"&&subloc=="12")
                {
                      fileid="14878";

                }
                     if(fileid=="73"&&mainloc=="12"&&subloc=="15")
                {
                      fileid="14878";

                }
               // grid_path = sessionStorage.getItem('getpath');
                    $.ajax({
                url: "report.php" ,
                type:"POST",
                data:{
                  "fileid":fileid,
                  "mastername":arr2[0],
                  "passid":"refid",
                    "mainloc":mainloc,
                    "subloc":subloc

                },

                success: function(response)
                 {

                    b = JSON.stringify(response);
                    b=JSON.stringify(b);

                      b= b.replace(/[^a-zA-Z ]/g, "")
                    // b=b.toString();



                          $("#mapname").text(b);

                           if ($("#mapname").text() == 'World') {
                            if(mainloc=="21"&&subloc=="21")
                            {
                             $("#mapname").text('Global');
                            }
                           else
                           {
                            $("#mapname").text('Country');
                           }
                           }

                     sessionStorage.setItem("name",b);

                      // if(mainloc!=subloc)
                      //   {$("#mapname").text(b);}

                 }});
                 }});

                  }

}
function goprev()
{
        if($("#rep").val()=="circle")
         {
        backcircle();

         }
      else
        {
     $('.loading', window.parent.document).show();
removeAllcircles();
      backfile=historyarr[historyarr.length-2];
      zooml=zoomarr[zoomarr.length-2];

      statuscode=UrlExists(baseurl+backfile);

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
			       $('.loading', window.parent.document).hide();

			       initlayer(map,backfile,1,0,zooml);
			       view = sessionStorage.getItem('view');
                      file1=backfile.split("KML/");
                                            file2=file1[1].split(".kml");
                                             file3=file2[0].split("---");
                                             fileid=file3[0];
                                              mainloc=file3[1];
                                             subloc=file3[2];

                                             file11=file.split("KML/");
                                            file12=file11[1].split(".kml");
                                             file13=file12[0].split("---");
                                             fileid1=file13[0];
                                              mainloc1=file13[1];
                                             subloc1=file13[2];
                                             arr1=[];arr2=[];refid=[];mastername=[];

                                       if(mainloc1==mainloc)
                                  {
                              mapname(mainloc,subloc,mainloc1,subloc1,fileid);
                            }


                              if(mainloc=="21"&&subloc=="1")
                                               {
                                                   $("#mapname").text("Country");
                                               }
			       if(view != '')
			       {

			             result= combinesplit_res();

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
            console.log(response);
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

 function locationlayer()
    {               var passid='';

                          typeval=$("input[name=type]:checked").val();
                          // alert(typeval);
                          colorpalat=$(".sp-preview-inner").attr("style");
                          replacol=colorpalat.replace("background-color: ","");
                          replacol1=replacol.replace(");","");
                          replacol2=replacol1.replace("rgb(","");
                          spl= replacol2.split(",");
                          col=rgbToHex(spl[0],spl[1],spl[2]);

                          // map.data.forEach(function(feature) {
                          // // If you want, check here for some constraints.
                          // map.data.remove(feature);
                                              // });
                               refid=[]; mastername=[];
                                  if(typeval == 'circle')
                                  {
                                       $("#p1").hide();

                                      $("#clear").trigger("click");
                                      size=$("#custom-handle1").html()*1000;
                                      opacityon=$("#custom-handle2").html();
                                       // console.log("keerthana");

                                       view = sessionStorage.getItem('view');
                                        // console.log(view);
                                          if(view != '')
                                          {

                                            filesplit3=[]; filesplit5=[]; filesplit7=[];
                                            //KML/1---5---7.kml
                                            file1=file.split("KML/");
                                            file2=file1[1].split(".kml");
                                            file3=file2[0].split("---");
                                            fileid=file3[0];
                                            mainloc=file3[1];
                                            subloct=file3[2];
                                             // console.log(mainloc,subloct);

                                               click=0;



                                            if(mainloc!= subloct)
                                            {
                                              console.log(historyarr);
                                          if(click>1)
                                          {
                                           subloc1=historyarr[parseInt(historyarr.length-1)];
                                           console.log(subloc1);
                                          }
                                          else
                                          {

                                           subloc1=historyarr[parseInt(historyarr.length-2)];

                                           console.log(subloc1);
                                          }

                                          // alert('1');
                                           filea= subloc1.split("KML/");
                                            fileb=filea[1].split(".kml");
                                             filec=fileb[0].split("---");
                                             subloc=file3[2];
                                         console.log("pervious",mainloc,filec[2]);
                                           $.ajax({
                                            url:'AjaxRequest.php' ,
                                            type:"POST",
                                            data:{"mainlocation": mainloc,
                                            "sublocation": filec[2]

                                            },

                                            success: function(response)
                                             {
                                                   console.log(response);

                                                    k=JSON.parse(response);
                                                    refid=[];mastername=[];
                                                    for(i=0;i<k.length;i++)
                                                    {

                                                    name1=k[i].split(",");
                                                    refid.push(name1[0]);
                                                    mastername.push(name1[1]);
                                                    }
                                                       mastername4='';

                                                    mastername4=mastername[0].toString();
                                                    mastername4=mastername4.split("_");
                                                    console.log(mastername4);
                                                   // alert(mastername4);
                                                    sessionStorage.setItem("master",mastername4[0]);

                                                  }
                                                });



               }
                else
                {
                  subloc=file3[2];

                }


               $.ajax({
                url:'AjaxRequest.php' ,
                type:"POST",
                data:{"mainlocation": mainloc,
                "sublocation": subloc

                },

                success: function(response)
                 {


                        k=JSON.parse(response);
                        refid=[];mastername=[];
                        for(i=0;i<k.length;i++)
                        {

                        name1=k[i].split(",");
                        refid.push(name1[0]);
                        mastername.push(name1[1]);
                        }
                        console.log(mastername[0]);
                        mastername3=mastername[0].toString();
                        mastername3=mastername3.split("_");
                       console.log(mainloc,subloct);


                        if(mainloc!=subloct)
                        {
                          //passid='';


                         // alert(mastername4[0]);



                             // if(mainloc="5" && subloct=="7")
                             // {

                             //  passid="country_id"
                             // }
                             // if(mainloc="7" && subloct=="9")
                             // {

                             //  passid="state_id"
                             // }
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
                       else
                       {
                        passid=mastername4[0].toString()+"_id";

                       }



                        }

                        else
                        {
                        passid= "refid";
                        }


                        map.data.forEach(function(feature) {

                        map.data.remove(feature);
                        });
                        combinesplit_res();
                        var s= sessionStorage.getItem('getstate_data');  //sessionStorage.getItem("clickresult");
                        s = JSON.parse(s);
                        s= s.toString();
                        s=s.split(",");

                        idvalue=[];key=[];value=[];id=[];valuearr=[];
                        for(i=0;i<s.length;i++)
                        {
                        s1=s[i].toString();
                        s1=s1.replace("****"," ,");
                        s1=s1.split(",");
                        s2=s1[1].toString();
                        s2=s2.replace("****",",");
                        s2=s2.split(",");

                        id.push(s1[0]);//map id

                        valuearr.push(s2[0]);//value of area



                        idvalue.push({
                        key1:id[i],//id
                        value1:valuearr[i]// area value
                        });

                        key[i]=idvalue[i].key1;
                        value[i]=idvalue[i].value1;

                        }

                       // alert(passid+","+fileid+','+mainloc+","+subloc);
                       if(passid=="refid" && fileid =='73' && mainloc=='12'&& subloc=='12')
                       {

                        fileid="14878";
                       }

                       if(passid=="city_id" && fileid =='73' && mainloc=='12'&& subloc=='15')
                       {

                        fileid="14878";

                       }


                       if(passid=="refid"&& fileid =='676' && mainloc=='12'&& subloc=='12')
                       {
                        fileid="13346";
                       }

                       if(passid=="city_id " && fileid ==676 && mainloc=='12'&&subloc=='15')
                       {
                        fileid="13346";
                        // alert(fileid);
                       }

                        //  +-
                 if(fileid=='676')
                 {
                 fileid=13346;
                 }


                $.ajax({
                url:'AjaxRequest.php' ,
                type:"POST",
                data:{"lan":1,
                "mastername":mastername[0],
                "refid":refid[0],
                "fileid":fileid,
                "passid":passid,
                },

                success: function(response)
                       {
                               console.log(response);
                            t =JSON.parse(response);
                            geo=[];lanlat=[];geoid=[];dblocname=[];key2=[];key4=[];value2=[];value4=[];
                            iddb=[];locationname=[];
                            for(i=0;i<t.length;i++)
                            {
                            geo = t[i].split(',');
                            lanlat.push(geo[0]+","+geo[1]);

                            iddb.push(geo[2]);
                            locationname.push(geo[3]);
                            geoid.push({
                            key1:iddb[i],//geocode
                            value1:lanlat[i]//db id
                            });
                            dblocname.push({
                            key1:iddb[i],//id
                            value1:locationname[i]// area value
                            });
                            key2[i]=geoid[i].key1;
                            value2[i]=geoid[i].value1;

                            key4[i]=dblocname[i].key1;
                            value4[i]=dblocname[i].value1;



                            }

                            geovalue=[];circleid=[];geolocname=[];circleid1=[]; value3 =[];  key3 =[];  value5 =[];
                            key5=[]; geocode=[]; lan=[]; lat=[];  colorcodeid=[];
                            colorcodeid=colorgradientcreation(s,0);
                            for(i=0;i<key.length;i++)
                            {
                                      for(j=0;j<key2.length;j++)
                                      {

                                      if(parseInt(key[i])==parseInt(key2[j]))
                                      {
                                      geovalue.push({
                                      key1:value2[j],//id
                                      value1:value[i]// area value
                                       });



                                      circleid.push({
                                      key1:key[i],//id
                                      value1:value[i]// area value
                                       });




                                      geolocname .push({
                                      key1:value[i],//value
                                      value1:value4[j]// location
                                      });


                                      }


                                      }
                                      circleid1[i]=circleid[i].key1;
                                      value3[i]=geovalue[i].value1;
                                      key3[i]=geovalue[i].key1;
                                      value5[i]=geolocname[i].value1;//location name
                                      key5[i]=geolocname[i].key1;

                                      geocode = key3[i].split(',');
                                      lan.push(geocode[0]);
                                      lat.push(geocode[1]);


                                      circle= new google.maps.Circle({
                                      strokeColor: colorcodeid[0][i],
                                      strokeOpacity: 0.8,
                                      strokeWeight: 2,
                                      fillColor:colorcodeid[0][i],
                                      fillOpacity:opacityon,
                                      map: map,
                                      center:new google.maps.LatLng(lan[i],lat[i]),
                                      radius: sizevalue(mainloc,subloc,value3[i]),
                                      id:circleid1[i],
                                      name:value5[i],
                                      value:value3[i]
                                      });


                                      circles.push(circle);


                            circle.addListener('mouseover',function(event)
                            {
                            var title1 = this.name;
                            title1 =" <b> "+title1+"- </b>"+this.value+"<br>";
                           injectTooltip(event, title1);
                            title="";
                            });
                             circle.addListener('mouseout',function(event)
                            {
                             deleteTooltip(event);
                            });

                            circle.addListener('dblclick',function(event)
                            {
                                // circle.set("fillOpacity",opacityon);
                $.ajax({
                      type: "POST",
                      url: "AjaxRequest.php",
                      data:{"nextlevel":"nextlevel","id":this.id.trim(),"currentlevel":file},
                      async:false,

                        success: function (data)
                        {           console.log(data);

                            map.data.forEach(function(feature) {

                            map.data.remove(feature);
                            });
                            nextlevelfile = data;


                            if( nextlevelfile=="KML/14878---12---15.kml")
                            {
                              nextlevelfile="";
                              nextlevelfile="KML/73---12---15.kml";
                            }
                              if( nextlevelfile=="KML/13346---12---15.kml")
                            {
                              nextlevelfile="";
                              nextlevelfile="KML/676---12---15.kml";
                            }

                              console.log(nextlevelfile);
                            sessionStorage.setItem("next",nextlevelfile);

                            if (nextlevelfile && nextlevelfile !=undefined)
                            {
                            statuscode=UrlExists(baseurl+nextlevelfile);
                            if(statuscode == statuscode)

                            initlayer(map,nextlevelfile,0,1,'');

                            map.data.forEach(function(feature) {

                            map.data.remove(feature);
                            });


                            $('.loading', window.parent.document).hide();

                            }
                            else
                            {
                            $('.loading', window.parent.document).hide();
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

                                         view = sessionStorage.getItem('view');

                                    if(view != '')
                                    {
                                    $('.loading', window.parent.document).show();

                                    combinesplit_res();
                                    }
                                    removeAllcircles();


                                  });
                                   }
                              var cirbounds = new google.maps.LatLngBounds();

                              $.each(circles, function(index, circle){
                              cirbounds.union(circle.getBounds());

                              });
                              map.fitBounds(cirbounds)
                                       }
                                             });
                                                  }});

                                             click++;
                              }


              }

            if(typeval =='poly')
            {
            opacity=$("#custom-handle2").html();
            opacity1=$("#custom-handle1").html();
            v=opacity/100;
            v1=opacity1/100;
            polycol=col;
             view = sessionStorage.getItem('view');
              year = sessionStorage.getItem('year');
              menu_item_id = sessionStorage.getItem('categs');
            // alert(view+" / "+year+" / "+menu_item_id);
            if(view != '' && year != '' && menu_item_id != '')
            {
                    // map.data.revertStyle();
                    map.data.setStyle(function(feature) {
                     // console.log(feature['f']); 
                        if (typeof colorcodeid[feature.getProperty('DB_ID')] != 'undefined')
                        {
                          return {
                          strokeColor:  "#"+polycol,
                          strokeOpacity: v1,
                          strokeWeight: 1,
                          fillColor: colorcodeid[feature.getProperty('DB_ID')],
                          fillOpacity: v,

                          };
                        }
                        else
                        {
                              return ({
                              fillColor: 'white',
                              strokeWeight:1
                              });
                        }
                    });
            }
            else
            {
                    map.data.revertStyle();
                    map.data.setStyle(function(feature) {
                     // console.log(feature['f']); 

                    return {
                    strokeColor:  "#"+polycol,
                    strokeOpacity: v1,
                    strokeWeight: 1,
                    fillColor: "#"+polycol,
                    fillOpacity: v,

                    };
                    });
            }
            //colorcodeid[feature.getProperty('DB_ID')]
             // if(view != '')

                // {
                  // alert("keerthana");
                  // next=  localStorage.setItem("next");
                    // removeAllcircles() ;
                  // initlayer(map,file,0,0,'');
               //  }
               //  else
               // {
                    // tstclrarry
              

              // }
                $(".close").click();
                $(".modal-backdrop.fade.in").remove();

                }
                }
function backcircle()
{
  removeAllcircles() ;
 $('.loading', window.parent.document).show();

      backfile=historyarr[historyarr.length-2];
      zooml=zoomarr[zoomarr.length-2];

      statuscode=UrlExists(baseurl+backfile);

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
             $('.loading', window.parent.document).hide();
             initlayer(map,backfile,1,1,zooml);
             view = sessionStorage.getItem('view');

             if(view != '')
             {

                   result= combinesplit_res();

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
function removeAllcircles()
                {
                for(var i in circles) {
                circles[i].setMap(null);
                }
                circles = [];
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

   for(i=0; i<markerarr.length; i++){
        markerarr[i].setMap(null);
    }
    for(k=0; k<circlearr.length; k++){
        circlearr[k].setMap(null);
    }


    $("#markeropt").val(0);
    infowindow1.close();
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
                  strokeWeight: 2,
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
      <input type="radio" name="type" value="poly" checked> Polygon &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="type" value="circle"> Circle &nbsp;&nbsp;&nbsp;&nbsp;
           <input type="text" id="rep" hidden="true" />
          <input type='text' id="custom" />
            <p id="p1">Size </p> <div id="slider1" style="width:260px; margin:15px;">
              <div id="custom-handle1"  class="ui-slider-handle"></div>
            </div>

        <p id="p2"> Shape Opacity </p> <div id="slider2" style="width:260px; margin:15px;">
              <div id="custom-handle2"  class="ui-slider-handle"></div>
            </div>

      </div>
      <div class="modal-footer">

         <button type="button" class="btn btn-default" id="apply" name="Apply" onclick="locationlayer()">Apply</button>
         <button type="button" class="btn btn-default" id="clear" name="clear" onclick="removeAlllayer()" >Clear</button>
       <button type="button" class="btn btn-default" id="back" name="Back" onclick="backcircle()" >Back</button>
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

                <input type="radio" name="tools" value="1" onclick="show()" checked>&nbsp;&nbsp; Circle &nbsp;&nbsp;&nbsp;&nbsp;
  <input type="radio" name="tools" value="2" onclick="hide()">&nbsp;&nbsp; Rectangle&nbsp;&nbsp;
<input type="radio" name="tools" value="3" onclick="hide()">&nbsp;&nbsp; Polygon


        </div>
         <div class="modal-body" id="shapingtype" style="">

               <input type="radio" name="shape" value="1"> Near By &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" name="shape" value="2" checked> Shape &nbsp;&nbsp;&nbsp;&nbsp;



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

		$('.loading', window.parent.document).show();
		setTimeout(function(){
			 nextleveltoggle="KML/"+$('input:radio[name=toggleshow]:checked').val()+".kml";

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

		    initlayer(map,nextleveltoggle,0,0,'');
		    $('.loading', window.parent.document).hide();
		   }
		   else
		   {
		   	 $('.loading', window.parent.document).hide();

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

  $.ajax({

                   type: "POST",
                   url: "AjaxRequest.php",
                   data:{"toggle":"togglelevel","id":findlocid2[0],"currentlevel":curfile},
                   success: function (data) {
                     $("#togglelocation").html('');
                     $("#togglelocation").html(data);
                     console.log(data);
                   }


              });
}
$(document).ready(function(){


    $('#myTable').DataTable();
    $("#custom").spectrum({
        color: "#f00"
 });

  $( function() {
    var handle = $( "#custom-handle1" );
    $( "#slider1" ).slider({
      create: function() {
        handle.text( $( this ).slider( "value" ) );
      },
      slide: function( event, ui ) {
        handle.text( ui.value );
      }
    });
  } );
    $( function() {
    var handle = $( "#custom-handle2" );
    $( "#slider2" ).slider({
      create: function() {
        handle.text( $( this ).slider( "value" ) );
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
    $("#report").html(tabledata);
     var table =  $('body').find('#example19').DataTable( {
            dom: 'Bfrtip',
            "scrollY":        "200px",
        "scrollCollapse": true,
            buttons: [

            'excelHtml5',

            ], "order": [[ 1, "desc" ]]
            } );
            jquerydatatable = table;
  }

  function datatable_split(tblcontent)

  {
        $("#report").html(tblcontent);
        view=sessionStorage.getItem('view');
        if(view == 0)
              {
                var table =$('#example2').DataTable( {
                dom: 'Bfrtip',
                 "scrollY":        "200px",
        "scrollCollapse": true,
                buttons: [

                'excelHtml5',

                ], "order": [[ 2, "desc" ]]
                } );


                jquerydatatable = table;
              }
              else
              {
                var lastindex = $('#example2').find('td:last').index();
                // alert(lastindex);
                var table =$('#example2').DataTable( {
                dom: 'Bfrtip',
                 "scrollY":        "200px",
        "scrollCollapse": true,
                buttons: [

                'excelHtml5',

                ], "order": [[ lastindex, "desc" ]]
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

        $("#chart").html(chartcontent);
        colorcode = colorgradientcreation(mapcontent,'0');
        // console.log(colorcode);
        // console.log(charts);
        if(view == 0 || view ==5 )
        {
        charts.update({ colors: colorcode[0] });
        }



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

      console.log(jquerydatatable.columns().header());
      // .find('th').eq(1).text()
      labfin =  getmenulbl();
       $("#reportname").text(labfin);
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
      if(view == 0 || view == 5)
      {
         $(head_item ).html('Values');//html(labfin+' '+reading);
      }
      else
      {
          $(head_item).parent().siblings(':first-child').html('Values');//html(labfin+' '+reading)
         // $(head_item).parent().parent().children(':first-child').html(labfin+' '+reading);

      }
       $("#chartname").text(labfin+' '+reading);
      //$(head_item ).html(labfin+' '+reading);
     //  charts.setTitle({text: labfin+' '+reading});
     //  charts.yAxis[0].axisTitle.attr({
     //    text: labfin+' '+reading
     // });
      //chartcolorfillgrowth = new Array();
      map.data.setStyle(function(feature)
      {
        if (typeof colorcodeid[feature.getProperty('DB_ID')] != 'undefined')
        {
          //chartcolorfillgrowth.push(colorcodeid[feature.getProperty('DB_ID')]);
          return({

          strokeColor: '#000',
          strokeOpacity:1,
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
  }

  function setsplitmarker(valuesar,colorsar,lats,longs,dataf) //piechart creation for split
  {
          //markerscharts = [];
          // alert(dataf);
          // if(valuesar.length == 1)
          // {
          //   valuesar.push(0)
          //   colorsar.push(colorsar[0] // }
              file11=file.split("KML/");
              file12=file11[1].split(".kml");
              file13=file12[0].split("---");
              fileid=file13[0];
              mainloc=file13[1];
              subloc=file13[2];

          if(valuesar.length == 1)
          {
            valuesar.push(valuesar[0]);
            colorsar.push(colorsar[0]);
          }

           var pieData = { values: valuesar, colors: colorsar, radius:splitradius(mainloc,subloc,valuesar[0]), stroke: 0 };
           // console.log('splitmarker');
           // console.log(valuesar);
           // console.log(colorsar);
           // console.log(rad);

           // console.log('endshere');
            const _icon = {
                url: 'data:image/svg+xml;charset=UTF-8,' + svgCharts().generatePieChartSVG(pieData.values, pieData.colors, pieData.radius, pieData.stroke)
            }
            // alert(_icon)
            // console.log(_icon);
            var markerchart = new google.maps.Marker({
                position: { lat: lats, lng: longs },
                map: map,
                // title: 'Hello World!',
                icon: _icon
            });
              // var infowindow = new google.maps.InfoWindow({
              // content: dataf
              // });
              markerchart.addListener('click', function(event) {
                // alert(dataf);
                deleteTooltip(event);
               injectTooltip(event,dataf);
              });

            markerscharts.push(markerchart);
            //robin
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
    // alert(num);
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
        explrestunits += parseInt(expunit[i])+","; // if is first value , convert into integer
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

      // console.log(splityear);
      spitdata = JSON.parse(splitarray);
      // alert(splitarray);
      var tablestr ='';
      // if(splityear.length > 1)
      //{
      objitems =  JSON.parse(itemobj);
      var itemdts =[];
      tablestr +="<table id ='subtableexp' cellpadding='5' cellspacing='0' border='0' style='padding-left:50px;'><thead><tr>";

      tablestr +="<th><b>"+th+"</b></th>";
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




      console.log(tablestr);
      r = tablestr;
      return r;


  }
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

        if ( row.child.isShown() ) {
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
            splityear = year.split(",");
            // alert(view);
            var indexre = parseInt($('.reading-conv').val());
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
                            if ( resco1[1] !== void 0 )
                            {
                              if(resco12[1] != undefined)
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
                            if ( resco1[1] !== void 0 )
                            {
                                if(resco12[1] != undefined)
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
                            if ( resco1[1] !== void 0 )
                            {
                              if(resco12[1] != undefined)
                              {
                                  amtcomma = amtcomma+'.'+resco12[1];
                              }
                            }
                           subtable.find('#'+itemdetails[xy]['split_id']).parent().find('#'+zx).text(amtcomma);
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
                  // console.log(spitdata);
                  itemdts  =spitdata[splityear[0]][myData];//[myData];
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
                      if ( resco1[1] !== void 0 )
                      {
                        if(resco12[1] != undefined)
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
      $(".loading").css("display", "block");
  });

  $(document).ajaxComplete(function(){
      $(".loading").css("display", "none");
  });



  function combinesplit_res()
  {


      //resulttype
      //reset_reading();


    groupby = sessionStorage.getItem('groupby');
     areavalue =[];
    $('.reading-conv').val('4');

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
    //else
   // {
         for(k=0; k<markerscharts.length; k++){
              markerscharts[k].setMap(null);
              }
   // }
   $('#chart').children().last().html('');
    // $('#chart').html('');
    $('#report').html('');

      resulttype =sessionStorage.getItem('resulttype');
      grid_path = sessionStorage.getItem('getpath');
      tableids = sessionStorage.getItem('tableids');

      // if(resulttype == '')
      // {
      //   groupby =
      // }
      file1 = sessionStorage.getItem('maplevel');
      file1 = file1.substring(0, file1.indexOf('.'));
      file1 = file1.split('/');
      mapids = file1[1].split('---');
      parentlvl = mapids[1];
      childlvl =mapids[2];
      locid = mapids[0];
      year = sessionStorage.getItem('year');//'2015,2016';
      view = sessionStorage.getItem('view');//0;//0;
      combv = sessionStorage.getItem('split_combine_id');
      levelid = sessionStorage.getItem('levelid');
      menu_ids = sessionStorage.getItem('tbl');
      menu_item_id = sessionStorage.getItem('categs');
      r3= $.ajax({
      type: "POST",
      url: grid_path,//"consum_report.php",
      async:false,
      data:{"year":year,"categs":menu_item_id,"chart":"chart","id":locid,parentlvl:parentlvl,childlvl:childlvl,"groupby":resulttype,"tbl":menu_ids,"mnid":'',"level":'',"view":view,"combv":combv,"tbldata":tableids},
      // async:false,
      success:function(data)
      {
            dat = JSON.parse(data);
            // removealllayer();
            // sessionStorage.setItem("clickresult",dat[2]);
            map.data.revertStyle();
          if(data != 'data not available')
         {
            sessionStorage.setItem('getstate_data', JSON.stringify(dat[2]));
            sessionStorage.setItem('reading',dat[4]);
           if(resulttype == 'S')
           {

             map_split(dat[2]);
             datatable_split(dat[0]);
             higcharts_split(dat[1],dat[2]);


           }
           else
           {

             // $("#report").html(dat[0])

              // sessionStorage.setItem('mapdata',mapsjson);
              datatable_combine(dat[0]);
              higcharts_combine(dat[1],dat[2]);
           }
         }
         else
         {
            $(".loading").hide();
            $('#charts').html();
            $('#report').html();
            alert(data);
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
          alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
      });
      $.when(r3).done(function(){

      setTimeout(function(){  $('.loading', window.parent.document).hide(); }, 500);
      });
  }

  $('.reading-conv').change(function (e) {
    // alert(tablebck);
    // e.preventDefa
    e.preventDefault();
    var inrreading  = {1:"Cr", 2:"lac", 3:"k",4:"Nos."};
    var indexre = parseInt($(this).val());
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

    //console.log(locvalue);
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
        console.log(tablebckspl);
        console.log(locidss);
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
                    console.log(num);
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
                  str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+amtcomma+'<br>';
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
                 setsplitmarker(valuesar,colorsar,lats,longs,str);
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

                                                    statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                       if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                        initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                       }
                                                      else
                                                      {
                                                        alert("Data Not available");
                                                      }

                                          }
                                          else
                                          {
                                               requestlevel1=requestlevel+1;

                                               statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                             if(statuscode1 == true)
                                               {
                                                 map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                  initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
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
    console.log(typechart);
    console.log(title2);
    console.log(jsonc);
    console.log(jk);
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

                                                  statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                     if(statuscode1 == true)
                                                     {
                                                       map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                      initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                     }
                                                    else
                                                    {
                                                      alert("Data Not available");
                                                    }

                                        }
                                        else
                                        {
                                             requestlevel1=requestlevel+1;

                                             statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                           if(statuscode1 == true)
                                             {
                                               map.eachLayer(function (layer) {
                                                              map.removeLayer(layer);
                                                              });
                                                initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
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



  function dialog()
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

                                      console.log(flyingcolors);

                                      j=0;
                                      if(view == 3)
                                      {
                                        j = coloshadesnegative.length-1;
                                      }
                                      jk =0;



                                                 locarray=[];
                                      console.log('A');
                                      console.log(getlocbasedchar);
                                      console.log('B');
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


                                      getlocbasedchar = [];
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
                                    console.log(jsonObj1);


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
                                          console.log(coloshades);
                                          newcolorshad = [];
                                          for(var j=0;j<growthdatamap.length;j++)
                                          {
                                              worldid=growthdatamap[j].key1;worldcount=growthdatamap[j].value1;//totalcount=t[2];


                                              newcolorshad[worldid] = coloshades[j];

                                              // colornegforgrowth = coloshadesnegative.length - 1;

                                              // colorfill(mylayer,worldid,worldcount,coloshades[j]);

                                          }

                                          console.log(newcolorshad);
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
                                        console.log('vararr');
                                        console.log(vararr);
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
                                        map_split(testorg);
                                    }
                                    else
                                    {
                                      map_split(testarr);
                                    }



                                 }
                                 else if(view == 0 || view == 5) //cummaltive
                                 {
                                    variable_fil = sessionStorage.getItem("variable_fiter");
                                    if(variable_fil != '')
                                    {
                                      // loose
                                      vararr =variable_fil.split(",");
                                        var vararr = vararr.map(function (x) {
                                        return parseInt(x, 10);
                                        });
                                        console.log('vararr');
                                        console.log(vararr);
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

                                        testarr = testorg;
                                    }
                                    // console.log('A');
                                    // console.log(testarr);
                                    // console.log(testorg);
                                    // console.log('B')
                                    map_split(testarr);

                                 }
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
                                            console.log(coloshades);
                                            console.log('neg '+chartclnegat);
                                            console.log('post '+chartclpostiv);
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
                                      console.log('spitdata');
                                      console.log(spitdata);
                                      // console.log(chartseries);
                                      // console.log(split_dts);

                                      var sumyear = [],cols = 2;
                                      objitems =  JSON.parse(itemobj);
                                      item_name = [];
                                      for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                          console.log(view);
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
                                                    console.log(chidlvlfilter[chf]+" // "+yp+" // "+split_dts);
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


                                        // console.log(objitems);
                                        console.log('Sumyear');
                                         console.log(sumyear);
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
                                        console.log('finalresult');
                                        console.log(finalres);
                                        console.log(resyear);


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
                                      console.log(chartseries);
                                      // alert("Sdfsd");
                                      for(chs=0;chs<chartseries.length;chs++)
                                      {
                                        chartitms = chartseries[chs]['data'];
                                        // console.log(chartitms);
                                        // console.log(chartitms);

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
                                                  testarray.push(temparv[0]);
                                              }
                                            }
                                            else
                                            {
                                                 temparv = (chartitms.filter(function (person)
                                                  {  if(person !== null){return person.mydata == chidlvlfilter[chf] }}));
                                                 if(typeof temparv[0] !== 'undefined'){
                                                testarray.push(temparv[0]);}
                                            }


                                          }
                                          // console.log(testarray);
                                          testarray = testarray.filter(Boolean);
                                          chartdupseries[chs]['data'] = testarray;
                                          testarray = [];


                                      }
                                      // alert("s");
                                      console.log(chartdupseries);
                                      filter_highcharts_split(categries,chartdupseries);
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

                                          if(chidlvlfilter != '')
                                          {
                                            // loose
                                            // vararr =variable_fil.split(",");
                                              var vararr = chidlvlfilter.map(function (x) {
                                              return parseInt(x, 10);
                                              });
                                              console.log('vararr');
                                              console.log(vararr);
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
                                              map_split(testorg);
                                          }
                                          else
                                          {
                                            map_split(testarr);
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
                                                      str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
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
                                            console.log(chart_filter);
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
                                      console.log(trdataContent);
                                      console.log(maprmitms);


                                       // alert("b9");

                                    if(resyear.length > 1) //&& view != 3) //timeseries  chart filter
                                    {

                                        spitdata = JSON.parse(splitarray);
                                        console.log(spitdata);
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
                                                console.log('kai ray');
                                                console.log(gridrowtot);
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

                                                       console.log('gw map');
                                                       console.log(growthdatamap);
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

                                                    'excelHtml5',

                                                    ], "order": [[ 4, "desc" ]]
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
                                      console.log(chart_filter);

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
                                          function add(a, b) {
                                          return a + b;
                                          }
                                          // console.log(sum1);
                                          // alert("SDF");
                                          console.log(testarr);
                                      // areavalue =[];
                                      for(k=0; k<markerscharts.length; k++){
                                      markerscharts[k].setMap(null);
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
                                                  sum = parseInt(sum) + parseInt(testarr[i][j].value);
                                                  center=testarr[i][j].center.split(",");
                                                  lats= parseFloat(center[0]);
                                                  longs = parseFloat(center[1]);


                                                var fills=set_map_color[j];//getsplitcolour(parseInt(ite));
                                                // console.log()a
                                                // alert(fills);

                                                colorsar.push(fills);
                                                data22 +="{name:"+"'"+name+"',value:'"+value+"',style:{fillStyle:'"+fills+"' }},";
                                                center=testarr[i][j].center.split(",");
                                                str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
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
                                        setsplitmarker(valuesar,colorsar,lats,longs,str);
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

                                            var resco12 = sumoftot.toString().split('.');
                                            var resco1 =resco12[0].replace(/\,/g,'');
                                            var amtcomma =moneyFormatIndia((resco1));
                                            if ( resco1[1] !== void 0 )
                                            {
                                             amtcomma = amtcomma+'.'+resco12[1];
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
                                           console.log('A');
                                           console.log(sumallvals);
                                            console.log('B');
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
                                        console.log(trdataContent);
                                        jquerydatatable.destroy();


                                         jquerydatatable=  $('#example2').DataTable( {
                                            dom: 'Bfrtip',
                                            "scrollY":        "200px",
                                            "scrollCollapse": true,
                                            buttons: [

                                            'excelHtml5',

                                            ], "order": [[ 2, "desc" ]]
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
                                           $.each(chart_filter_dp, function(i, item)
                                           {
                                              // for (var j = item['data'].length; j > 0; j--)
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

                                                filchk = 1;
                                                if(loc_filter != '')
                                                {
                                                    if(rowsids.indexOf(parseInt(item['data'][j]['mydata'])) == -1)
                                                    {
                                                      delete item['data'][j];
                                                      // item['data'].splice(item['data'][j], 1);
                                                      // filchk =0;
                                                    }
                                                }
                                              }
                                           });
                                         // console.log(categoryN1);

                                              categoryN = categoryN1.filter( function( item, index, inputArray ) {
                                              return inputArray.indexOf(item) == index;
                                              });
                                          //console.log(arr);

                                          categoryN = categoryN.filter(function( element ) {
                                          return element !== undefined;
                                          });
                                          // console.log(categoryN);
                                          // console.log(chart_filter_dp);
                                           $.each(chart_filter_dp, function(i, item) //reseting index
                                           {
                                                item['data'] = item['data'].filter(function(){return true;});

                                           });
                                           // console.log(categoryN);
                                            console.log(chart_filter_dp);
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
                                          chartcatgr = chartcatgr.filter(function( element ) {
                                          return element !== undefined;
                                          });
                                        filter_highcharts_split(chartcatgr,chart_filter12);
                                        }

                                      }
                                }



                                // spitdataforloc





                            }
                            else if( $('#byrange1').length > 0)//range
                            {
                              // localStorage.getItem("range_filter",'rangefilloc');
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

                                    map.data.setStyle(function(feature)
                                    {
                                      // testtt++;
                                      //alert(newcolorshad[feature.getProperty('DB_ID')]+' // '+areavalue[feature.getProperty('DB_ID')]);
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
                                var chidlvlfilter = [];
                                // for (i = 0; i < piechartmarker.length; i++) {
                                // map.removeLayer(piechartmarker[i]);

                                // }

                                  areavalue =[];
                                  for(k=0; k<markerscharts.length; k++){
                                  markerscharts[k].setMap(null);
                                  }


                                  categries = [];
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
                                                console.log(sum1);
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
                                        str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
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
                                        str+='<i class="circle" style="background:'+fills+'"></i>'+testarr[i][j].name+'-'+testarr[i][j].value+'<br>';
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
                                  console.log('valuesar');

                                  setsplitmarker(valuesar,colorsar,lats,longs,str);


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
                                        for(chf = 0;chf<chidlvlfilter.length;chf++)
                                        {
                                          temparv = (chartitms.filter(function (person) {
                                          if(person !== null){ return person.mydata == chidlvlfilter[chf] }}));

                                             if(typeof temparv[0] !== 'undefined'){
                                                testarray.push(temparv[0]);}

                                        }
                                        testarray = testarray.filter(Boolean);
                                        chartdupseries[chs]['data'] = testarray;
                                        testarray = [];
                                      }
                                    }
                                    // console.log(chartdupseries);
                                    for(h=0;h<unsetitemchart.length;h++)
                                    {
                                       chartdupseries.splice(unsetitemchart[h], 1);
                                    }
                                    // console.log(chartdupseries);
                                    filter_highcharts_split(categries,chartdupseries);
                                  }

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
                              // locfilter = localStorage.getItem("loc_filter");
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
                                                      console.log(percent+" Pre");
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
                                                      console.log(combinddata);

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
                              // localStorage.setItem("loc_filter",loc_filter);
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

                                      console.log(flyingcolors);

                                      // for (var i=0; i < colorstore.length; i++)
                                      // {
                                      if(view == 3)
                                      {
                                        j = coloshadesnegative.length-1;
                                      }
                                      locarray=[];
                                      console.log('A');
                                      console.log(getlocbasedchar);
                                      console.log('B');
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
                                      console.log("AA");
                                     console.log(newcolorshad);
                                      console.log(areavalue);
                                      console.log("BB");
                                    map.data.setStyle(function(feature)
                                    {
                                      // testtt++;
                                      //alert(newcolorshad[feature.getProperty('DB_ID')]+' // '+areavalue[feature.getProperty('DB_ID')]);
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
                          console.log(isfilter);

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
                              console.log(sorted);
                              var ranks = arrayint.slice().map(function(v){ return sorted.indexOf(v)+1 });
                              ranks = ranks.sort(sortFloat);
                              console.log(ranks);
                              $('#byrank1').val(ranks[0]);
                              $('#byrank2').val(ranks[ranks.length-1]);
                              rank2 = ranks[ranks.length-1];
                              console.log(ranks[0]+','+ranks[ranks.length-1]);
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
                           console.log(jquerydatatable.columns( { filter : 'applied'} ).data());


                          jquerydatatable.rows( { search:'applied' } ).data().each(function(value, index) {
                          console.log(value, index);
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

                                                        statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                           if(statuscode1 == true)
                                                           {
                                                             map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                            initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                           }
                                                          else
                                                          {
                                                            alert("Data Not available");
                                                          }

                                              }
                                              else
                                              {
                                                   requestlevel1=requestlevel+1;

                                                   statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                                 if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                      initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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

                                                        statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                           if(statuscode1 == true)
                                                           {
                                                             map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                            initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                           }
                                                          else
                                                          {
                                                            alert("Data Not available");
                                                          }

                                              }
                                              else
                                              {
                                                   requestlevel1=requestlevel+1;

                                                   statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                                 if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                                    map.removeLayer(layer);
                                                                    });
                                                      initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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

        },
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {


                                       requestlevel=2;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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

        },
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {


                                       requestlevel=2;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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
                            console.log(this.y);

                                           requestlevel=2;
                                          if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                    statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                       if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                        initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'','');
                                                       }
                                                      else
                                                      {
                                                        alert("Data Not available");
                                                      }

                                          }
                                          else
                                          {
                                               requestlevel1=requestlevel+1;

                                               statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                             if(statuscode1 == true)
                                               {
                                                 map.eachLayer(function (layer) {
                                                                map.removeLayer(layer);
                                                                });
                                                  initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata,'');
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
    //  localStorage.setItem('chartseries12', JSON.stringify(chartdupseries));

    //  localStorage.setItem('split_dts', JSON.stringify([{"refid":"1","name":"Bevrgs"},{"refid":"3","name":"Deodorant"}]));

  }
  function reset_reading()
  {
    groupby = sessionStorage.getItem('groupby');
     areavalue =[];
    $('.reading-conv').val('4');

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

  function map_split(mapcontent)
  {
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
              if( viewing != 3) //other than growth
              {

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

                    data1=new Array();str="";sum=0;ite=0;data2=new Array(); round=0;data22="[";
                    str='<div class="info legend1">';
                    valuesar = [];
                    colorsar=[];
                    //longs = [];

                    $.each(testarr[i], function(j, item)
                    {

                      var name =testarr[i][j].name;
                      var value=testarr[i][j].value;

                      if(round<10){
                        valuesar.push(value);

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
                    setsplitmarker(valuesar,colorsar,lats,longs,str);

                  });





              }
              else
              {
                colorcode = colorgradientcreation(mapcontent,'0');
                // alert('d');
                // console.log(colorcode);
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

                //chartcolorfillgrowth = new Array();
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
<!--
<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center=India&zoom=13&scale=1&size=600x300&maptype=roadmap&format=png&visual_refresh=true" alt="Google Map of Albany, NY"> -->
