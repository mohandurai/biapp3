<?php
session_start();

use yii\helpers\Url;

$site1 = $_GET['r'];

$site2 = explode("/",$site1);
// echo $viewno;
// $tee1 = sprintf("%u",0x00F22B);
// $tee2 = sprintf("%u",0x01875B);
// echo $tee1." // ".$tee2;

// echo dechex((float) $tee);
// echo sprintf("%u",0x00F22B);die;
// echo " ==============> ". Yii::$app->user->identity->id . " <<<==== ";
 // print_r($_COOKIE);die;
if(isset($_COOKIE['categs']))
{
  // print_r($_SESSION);//die;
      // $_SESSION = $_COOKIE;

      $_REQUEST['categs'] = $_COOKIE['categs'];
      $_REQUEST['comb'] = $_COOKIE['comb'];
      $_REQUEST['mnid'] = $_COOKIE['mnid'];
      $_REQUEST['combby'] = $_COOKIE['combby'];
      $_REQUEST['tbl'] = $_COOKIE['tbl'];
      $_REQUEST['antype'] = $_COOKIE['antype'];
      $_REQUEST['ptype'] = $_COOKIE['ptype'];
      $_REQUEST['year'] = $_COOKIE['year'];
      $_REQUEST['view'] = $_COOKIE['view'];
      $_REQUEST['locid'] = $_COOKIE['locid'];
      $_REQUEST['proceed'] = 'yes';

      $_SESSION['categs'] = $_COOKIE['categs'];
      $_SESSION['comb'] = $_COOKIE['comb'];
      $_SESSION['mnid'] = $_COOKIE['mnid'];
      $_SESSION['combby'] = $_COOKIE['combby'];
      $_SESSION['tbl'] = $_COOKIE['tbl'];
      $_SESSION['antype'] = $_COOKIE['antype'];
      $_SESSION['ptype'] = $_COOKIE['ptype'];
      $_SESSION['year'] = $_COOKIE['year'];
      $_SESSION['view'] = $_COOKIE['view'];
      $_SESSION['locid'] = $_COOKIE['locid'];

      setcookie('categs', '', time()-100);
      setcookie('comb', '', time()-100);
      setcookie('mnid', '', time()-100);
      setcookie('combby', '', time()-100);
      setcookie('tbl', '', time()-100);
      setcookie('antype', '', time()-100);
      setcookie('ptype', '', time()-100);
      setcookie('year', '', time()-100);
      setcookie('view', '', time()-100);
      setcookie('locid', '', time()-100);


}


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


if(isset($_REQUEST['categs']))
{
    $str="&categs=".$_REQUEST['categs'];

}
else
{
  $str="";
}
if(isset($_REQUEST['year']))
{
    $str1="&year=".$_REQUEST['year'];

}
else
{
  $str1="";
}
if(isset($_REQUEST['comb']))
{
    $strc="&comb=".$_REQUEST['comb'];

}
else
{
  $strc="";
}
if(!isset($_REQUEST['locid'])) {
  $strl = "";

} else {
  $strl ="&locid=".$_REQUEST['locid'];
}
if(!isset($_REQUEST['tbl'])) {
  $strtbl = "";
} else {
  $strtbl ="&tbl=".$_REQUEST['tbl'];
}

if(!isset($_REQUEST['mnid'])) {
  $strmn = "";
} else {
  $strmn ="&mnid=".$_REQUEST['mnid'];
}

if(!isset($_REQUEST['view'])) {
  $strmn1 = "";
} else {
  $strmn1 ="&view=".$_REQUEST['view'];
}

if(!isset($_REQUEST['ptype'])) {
  $strmn11 = "";
} else {
  $strmn11 ="&ptype=".$_REQUEST['ptype'];
}
if(!isset($_REQUEST['item'])) {
  $strmn112 = "";
} else {
  $strmn112 ="&comb=".$_REQUEST['item'];
}
if(!isset($_REQUEST['item1'])) {
  $strmn113 = "";
} else {
  $strmn113 ="&viewopt=".$_REQUEST['item1'];
}
if(!isset($_REQUEST['combby'])) {
  $strmn1135 = "";
} else {
  $strmn1135 ="&combby=".$_REQUEST['combby'];
}
// if($_REQUEST['tbl'] != 0){
$urlmap5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/sales/outline-world.php?populate=yes".$strl.$str.$str1.$strc.$strtbl.$strmn.$strmn1.$strmn11.$strmn112.$strmn113.$strmn1135 ;
// echo $urlmap5;//die;
// }
// else
// {
  // $urlmap5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/mapsv6/outline-world.php?populate=yes".$strl.$str.$str1.$strc.$strtbl.$strmn.$strmn1.$strmn11.$strmn112.$strmn113.$strmn1135 ;

// }
// $urlmap5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/mapsv6/outline-world.php?populate=yes".$strl.$str.$str1.$strc;

// echo $urlmap5;//die;
$url3 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/reports/report1.php?populate=yes".$strl.$str.$str1.$strc;

$urlchart = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/highcharts/sample.php?populate=yes".$strl.$str.$str1.$strc;

$url5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1];

//echo $urlmap5 . "</br>" . $url3 . "</br>" . $_GET['cityid'] . "</br>" . $urlchart;
?>

<script type="text/javascript">

function hello(string,newarr)
{

//document.getElementById('myAnchor').value=name;

    var locid = localStorage.getItem("fileloc");

  // alert(string);
  //return false;

      var anztype = $("#anlztype").val();  //////// Single=1, continous=2, mixed=3
      var prdtype = $("#prdtype").val();
      var chosen1 = $("#w1").val();
      var chosen2 = $("#w0").val();   ///////// view i.e Cumulative=0, time series=2, growth=3

      //alert(anztype+ "  "+prdtype+ "  "+chosen1+ "  "+chosen2+ "  "+string);
      //return false;

      if(anztype==0){
          alert("Select Period Type ....."); return false;
      }

      if(prdtype=="" || chosen1==null || chosen1==0) {

        if(chosen1==1 && $("#w1").val().length <=1 ){
          alert("Choose more than a year"); return false;

        }
        if(chosen2==2 && $("#w1").val().length <=1 && $("#w1").val().length !=2 ){
          alert("Choose two years ...."); return false;

        }
        alert("Select period !!!");
        return false;
      }





      if(chosen1!="")
{
  <?php

  //$url = Yii::$app->urlManager->createAbsoluteUrl('site/validate');
   $url1 = Yii::$app->urlManager->createAbsoluteUrl('site/validatemark');
  // $url2 = Yii::$app->urlManager->createAbsoluteUrl('site/getid');

   // if($viewno==1)
   // {
   //  echo "marketpotential";
   // }
$this->registerJs(

  '
                              var menu_id="";
             $("#test-select-3 option:selected").each(function() {
                   menu_id = $(this).val();
                   });

         $("#w1").change(function(){
           var s=$("#w1").select2("data");

                     if(s!=0)
                       {



                        $.ajax({
                        url: "'.$url1.'",
                        type:"POST",
                        data:{"year":$("#w1").val()
                          },
                       success: function(result){

                         if(result!=0)
                         {alert(result);
                         $("#w1").select2("val", "");

                           }
                           }

                          });

                        }

                               });


            $("#w4").change(function(){
           var p=$("#w4").select2("data");

                     if(p!=0)
                       {
                        $.ajax({
                        url: "'.$url1.'",
                        type:"POST",
                        data:{"year":$("#w4").val()
                          },
                       success: function(result){

                         if(result!=0)
                         {alert(result);
                         $("#w4").select2("val", "");

                           }
                           }

                          });

                        }

                               });



            $("#w6").change(function(){
           var q=$("#w6").select2("data");

                     if(q!=0)
                       {
                        $.ajax({
                        url: "'.$url1.'",
                        type:"POST",
                        data:{"year":$("#w6").val()
                          },
                       success: function(result){

                         if(result!=0)
                         {alert(result);
                         $("#w6").select2("val", "");

                           }
                           }

                          });

                        }

                               });

                               '
                                 );


                                     ?>

                                            }




var tempurl = window.location.href.split('marketingpotential');
// alert(tempurl[0]);
//return false;

//alert(anztype+ "  "+chosen2);
//return false;

      if(anztype==3 && chosen2==2) {
          chosen2 = 1;
      } else if(anztype==3 && chosen2==0) {
          chosen2 = 5;
      }

var new1 = tempurl[0]+"marketingpotential&categs="+string+"&antype="+anztype+"&ptype="+prdtype+"&year="+chosen1+"&view="+chosen2;

//alert(new1);
//return false;

locnew = new1+"&locid="+locid+"&proceed=yes";
// alert(locnew);
//return false;
<?php
$url = Yii::$app->urlManager->createAbsoluteUrl('site/renderpostval');
$this->registerJs();?>

            document.cookie = "categs = " + newarr[0];
            document.cookie = "comb = " + newarr[1];
            document.cookie = "mnid = " + newarr[2];
            document.cookie = "combby = " + newarr[3];
            document.cookie = "tbl = " + newarr[4];
            document.cookie = "antype = " + anztype;
            document.cookie = "ptype = " + prdtype;
            document.cookie = "year = " + chosen1;
            document.cookie = "view = " + chosen2;
            document.cookie = "locid = " + locid;



location = location;
return false;

}

  function customCheckbox(checkboxName)
        {
        var checkBox = $('input[name="'+ checkboxName +'"]');
        $(checkBox).each(function(){
            $(this).wrap( "<span class='custom-checkbox'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function(){
            $(this).parent().toggleClass("selected");
        });
       }


</script>


<?php if(Yii::$app->user->identity->id!=null) {

//echo $_REQUEST['year']  . " <<<==== " . $_REQUEST['ptype'] . " <<<==== ". $_REQUEST['locid'] . " <<<==== ". $_REQUEST['comb'] . " <<<==== " . $_REQUEST['categs'] . "</br></br>";

//echo $_SESSION['CATEG'] . " <<<==== " . $_REQUEST['categs'] . "</br></br>";

if(isset($_REQUEST['categs'])) {
  if($_SESSION['CATEG'] != $_REQUEST['categs']) {
      // echo "Nooooooooooo  ooooo";
      //START CREATING TEMPORARY TABLES .....
      //include("create_temp_tables.php");
      // if(isset($_REQUEST['proceed']))
      // {
      //    unset($_REQUEST['proceed']);
      // }

     // print_r($_SESSION['CATEG']);die;
      $_SESSION['CATEG'] = $_REQUEST['categs'];
  }
} else {
  $_SESSION['CATEG'] = "";
}

?>

<div style="width:100%; height:100%; overflow: auto;">

<div class="iframe-container" style=" text-align:left; float:left;">


<iframe id="mapframe" src="<?php echo $urlmap5; ?>" frameborder="0" height="100%" width="100%" style="text-align:left; float:left;"></iframe>
</div>

<?php
if(isset($_GET['year']) && isset($_GET['categs'])) {

  $yrs = explode(",",$_GET['year']);
  $cats = str_replace("_", ",", $_GET['categs']);

  //echo " </br></br> <<==== ";
  //echo count($yrs) . " <<==== ";

  if(count($yrs)==1) {
      $partn = "p".$_GET['year'];

      if($_GET['comb']==0) {
        $qry = "SELECT ". $_GET['year'] . " as 'year', ROUND(SUM(sub2_Q1+sub2_Q2+sub2_Q3+sub2_Q4),2) as totcol FROM 14878_sales PARTITION (".$partn.") WHERE fld627 IN (".$cats.") AND fld640 IN (1,2,3,4)";
      } elseif($_GET['comb']==1) {
        $qry = "SELECT ". $_GET['year'] . " as 'year', count(*) as totcol FROM (select DISTINCT loc15 from 14878_sales PARTITION (".$partn.") ) as totcnt";
      }
  }
  elseif(count($yrs)>1)
  {
      foreach($yrs as $yr) {
          $partn = "p".$yr;

          if($_GET['comb']==0) {
              $qry .="select ".$yr." as 'year',count(*) as totcol from area_life_style_indicator_final where related_menu_id in (".$cats.")";
          } elseif($_GET['comb']==1) {
              $qry .= "SELECT ". $yr . " as 'year', count(*) as totcol FROM (select DISTINCT loc15 from 14878_sales PARTITION (".$partn.") ) as totcnt UNION ALL ";
          }
      }

    $qry = substr($qry,0,-10);
  }


$_SESSION['gridqry'] = $qry;

if($locid != "world---0") {

?>

<?php
} else {
?>
  <script type="text/javascript">
    alert("Select Region/Location before proceed !!!");
    //window.location.href = '<?php echo $url5; ?>';
  </script>

<?php

}


}

} else {
  //echo "=========================> Not Authorized to View or UnAuthorized login or Session Timeout !!! ";
  header("Refresh:0; url=index.php?r=site/login");
}

?>

</div>
