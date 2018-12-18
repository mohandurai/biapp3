<?php
session_start();

use yii\helpers\Url;


use yii\widgets\ActiveForm;


$site1 = $_GET['r'];

$site2 = explode("/",$site1);

//echo " ==============> ". Yii::$app->user->identity->id . " <<<==== ";

//echo $site2[1];
// print_r(Yii::$app->user->identity->client_user_id);die;
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
      // $_SESSION['proceed'] = 'yes';

     // $_SESSION['comb'] = $_COOKIE['comb'];

      //$_SESSION['combby'] = $_COOKIE['combby'];

      // print_r($_REQUEST);die;
      // $_REQUEST= $_COOKIE;
        // unset($_COOKIE['categs']);
        // unset($_COOKIE['comb']);
        // unset($_COOKIE['mnid']);
        // unset($_COOKIE['combby']);
        // unset($_COOKIE['tbl']);
        // unset($_COOKIE['antype']);
        // unset($_COOKIE['ptype']);
        // unset($_COOKIE['year']);
        // unset($_COOKIE['view']);
        // unset($_COOKIE['locid']);
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

  // print_r($_REQUEST);//die;
}


/*
$this->registerJs(
    '$("document").ready(function() {

$("#toggle-Period").show();
$("#toggle-Category").show();

       var mod3 = "'. $site2[1] . '"
      //alert(mod3);
         if(mod3=="marketingpotential") {
            //alert("Yesssssss");
            $("#admin").hide();
            $("#sales").hide();
            $("#secsales").hide();
            $("#tersales").hide();
            $("#brandidea").hide();
            $("#media").hide();

            $("#filter-area").show();
            $("#filter-area1").show();
          }
          else if(mod3=="secondarysales") {
            //alert("Yesssssss");
            $("#admin").hide();
            $("#markpot").hide();
            $("#sales").hide();
            $("#tersales").hide();
            $("#brandidea").hide();
            $("#media").hide();

            $("#filter-area").show();
            $("#filter-area1").show();
          }
          else if(mod3=="sales") {
            //alert("Yesssssss");
            $("#admin").hide();
            $("#markpot").hide();
            $("#secsales").hide();
            $("#tersales").hide();

            $("#filter-area").show();
          }
          else if(mod3=="tertiarysales") {
            //alert("Yesssssss");
            $("#admin").hide();
            $("#markpot").hide();
            $("#secsales").hide();
            $("#sales").hide();

            $("#filter-area").show();
          }

        $("#toggle-Period").click(function(e) {
            $("#filter-area").toggle();
            return false;
        });

        $("#toggle-Category").click(function(e) {
            $("#filter-area1").toggle();
            return false;
        });


        $("#proceed").click(function(e) {
            //alert("Yesssssss");
            $("#chartview").show();
            $("#gridview").show();
            //alert($("#w0").val()+" <<==== "+$("#w2").val()+" <<==== "+$("#discover").val()+" <<==== "+$("#gender").val()+" <<==== "+$("#profiles").val());
            return false;
        });

        $("#fix-period").click(function(e) {
            var url6 = window.location.href;
            var prdtype = $("#prdtype").val();
            var chosen1 = $("#w0").val();
            //alert(prdtype+ "  "+chosen1);
            if(prdtype=="" || chosen1==null || chosen1==0) {
               if(chosen2==1 && $("#w2").val().length <=1 ){
          alert("choose  more one year"); return false;

        }
        if(chosen2==2 && $("#w2").val().length <=1 && $("#w2").val().length !=2 ){
          alert("choose two year"); return false;

        }
              alert("Select some Period !!!");
              return false;
            }

            //chosen1 = chosen1.trim();
            //chosen1 = chosen1.replace(/  +/g, " ");
            //yrs = chosen1.split(" ").join(",");
            //alert(chosen1);
            //chosen1 = chosen1.split();
            //fLen = chosen1.length;
            //var yrs = ""
            //for (i = 0; i <= fLen; i++) {
            //    if(splitted[i]==="        " || splitted[i]==="                ") { continue; }
            //    else { yrs += $.trim(splitted[i]) + ","; }
            //}
            //alert(url6+" <<==== "+prdtype+" <<==== "+yrs);
            var newUrl7 = url6+"&ptype="+prdtype+"&year="+chosen1;
            window.location.href = newUrl7;
            return false;
        });


         $("#prdtype").change(function(e) {
            //alert("Yesssssss");
            var t1 = $(this).val();
            if(t1==5) {
              $("#date-area").hide();
              $("#mth-area").hide();
              $("#qty-area").hide();
              $("#hly-area").hide();
              $("#year-area").show();
              $("#year-view").show();

            }
            else if(t1==1) {
              $("#date-area").hide();
              $("#mth-area").hide();
              $("#qty-area").hide();
              $("#year-area").hide();
              $("#hly-area").show();
            }
            else if(t1==2) {
              $("#date-area").hide();
              $("#mth-area").hide();
              $("#year-area").hide();
              $("#hly-area").hide();
              $("#qty-area").show();
            }
            else if(t1==3) {
              $("#date-area").hide();
              $("#qty-area").hide();
              $("#year-area").hide();
              $("#hly-area").hide();
              $("#mth-area").show();
            }
            else if(t1==4) {
              $("#mth-area").hide();
              $("#qty-area").hide();
              $("#year-area").hide();
              $("#hly-area").hide();
              $("#date-area").show();
            }
            return false;
        });

        $("#w9").change(function(e) {
            var catid = $(this).val();
            //alert(catid);
            $.get("'.Url::to(['/site/depdd1']).'", {catid: catid}, function (data) {
                $("#w10").html(data);
            });
        });

        $("#expand-menu-width").click(function(e) {
          //  alert("Yesssssss");
            $(".left-side").css("width", "560px;");
        });

          $("#prdtype").change(function(e) {
          var anztype = $("#anlztype").val();
              var ptype=$("#prdtype").val();
            $("#w1").prop("disabled",false);

            if(anztype==1 && ptype==5) {
              $("#w0").val("0").change();
              $("#w0").prop("disabled",true);
              return false;
            } else {
              $("#w0").prop("disabled",false);
            }
        });

 $("#w1").change(function(e) {
            // var yrcnt = $(this).val().length;
            // var antype = $("#anlztype").val();
            // //alert(yrcnt+" <<==== AAAAAA"+antype);
            // if(antype==1 && yrcnt > 1) {
            //     alert("For Period type Single multiple years selection not allowed !!!");
            //     $("#anlztype").val("0").change();
            //     $("#w1").prop("disabled",true);

            //     return false;
           // }
  var anztype = $("#anlztype").val();


var ptype=$("#prdtype").val();
if(anztype==1 && ptype==5 )
{
var data1 = $("#w1").select2("data");

var year_single=data1[0].id;
if(data1.length>1 )
{
  alert("more than a year selection is not allowed!!!!!!!!!!");
  $("#w1").select2("val", "");

}

}

 if(anztype==2 && ptype==5)
{   var data3=new Array();
  var data4=new Array();
  var data2 = $("#w1").select2("data");
  if(data2.length<3)
  {
  for(i=0;i<data2.length;i++)
  {
  data4.push(data2[i].id);
  data3=data4.sort();


  if(data2[i].id!=data3[i])
  {
alert("Select Continuous Years!!!!!!!!!!");
 $("#w1").select2("val", "");
  }
        }
    }

    else
    {
      alert("Select only From and To Years");
$("#w1").select2("val", "");

    }

    }




        });

//1-single,2-continuous,3-mixed


 $("#w4").change(function(e) { //periods 0-none, 5-year,3-month,2-quarter

var anztype = $("#anlztype").val();
  var ptype=$("#prdtype").val();
  var qtype=$("#w5").val();
  var qyear=$("#w4").val();


if(anztype==1&&ptype==2){   //single and quarter
if(qyear.length>1)
{
alert("more than a year-quarter selection is not allowed!!!!!!!!!!");
  $("#w5").select2("val", "");
 $("#w4").select2("val", "");

}

  }


 if(anztype==2 && ptype==2)
{   var data3=new Array();
  var data4=new Array();
  var data2 = $("#w4").select2("data");

if(data2.length<3)
{
  for(i=0;i<data2.length;i++)
  {
  data4.push(data2[i].id);
  data3=data4.sort();


  if(data2[i].id!=data3[i])
  {
alert("Select Continuous Years!!!!!!!!!!");
  $("#w5").select2("val", "");
 $("#w4").select2("val", "");
  }
   }

}
else
{
alert("Select only From and To Years-Quarters");
  $("#w5").select2("val", "");
 $("#w4").select2("val", "");
}


}



  });

$("#w5").change(function(e) { //periods 0-none, 5-year,3-month,2-quarter

var anztype = $("#anlztype").val();
  var ptype=$("#prdtype").val();
  var qtype=$("#w5").val();
  var qyear=$("#w4").val();
  var myear=$("#w6").val();
   var mtype=$("#w7").val();
  var stype=$("#w0").val();

if(anztype==1 && ptype==2 && stype==0 && stype!= 2 && stype!=3)              //single and quarter//cum
  {

if(qtype.length>1 )
{
alert("more than a year-quarter selection is not allowed!!!!!!!!!!");
  $("#w5").select2("val", "");


}


  }


});



$("#w6").change(function(e) {


var anztype = $("#anlztype").val();
var ptype=$("#prdtype").val();
var mtype=$("#w7").val();
var myear=$("#w6").val();

if(anztype==1&&ptype==3){ //single and month
if(myear.length>1)
{
alert("more than a year-month selection is not allowed!!!!!!!!!!");
  $("#w7").select2("val", "");
 $("#w6").select2("val", "");

}

  }


 if(anztype==2 && ptype==3)

  {

  var data3=new Array();
  var data4=new Array();
  var data2 = $("#w6").select2("data");
if(data2.length<3)
  {
  for(i=0;i<data2.length;i++)
  {
  data4.push(data2[i].id);
  data3=data4.sort();


  if(data2[i].id!=data3[i])
  {
alert("Select Continuous Years!!!!!!!!!!");
  $("#w7").select2("val", "");
 $("#w6").select2("val", "");

  }
        }
    }

    else
    {

    alert("Select only From and To Years-Months");
    $("#w7").select2("val", "");
   $("#w6").select2("val", "");
         }
    }


});




$("#w7").change(function(e) { //periods 0-none, 5-year,3-month,2-quarter

var anztype = $("#anlztype").val();
  var ptype=$("#prdtype").val();
  var qtype=$("#w5").val();
  var qyear=$("#w4").val();
  var myear=$("#w6").val();
   var mtype=$("#w7").val();
  var stype=$("#w0").val();

if(anztype==1 && ptype== 3 && stype==0 && stype!= 2 && stype!=3)              //single and quarter//cum
  {

if(mtype.length>1 )
{
alert("more than a year-month selection is not allowed!!!!!!!!!!");
$("#w7").select2("val", "");

}

  }

});


    $("#w0").change(function(e){
$("#w1").select2("val", "");
$("#w4").select2("val", "");
$("#w5").select2("val", "");
$("#w6").select2("val", "");
$("#w7").select2("val", "");
// var ty=$("#test-select-3").select2("data");
// alert(ty[0].id);

    });



    });'
  );

*/

use yii\helpers\Html;
$this->title = 'Secondary Sales';
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
$urlmap5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1] . "/web/sales/outline-world.php?populate=yes".$strl.$str.$str1.$strc.$strtbl.$strmn.$strmn1.$strmn11.$strmn112.$strmn113.$strmn1135 ;


$url5 = $protocol . $_SERVER['HTTP_HOST'] . "/" . $p1[1];

//echo $url5 . "/web/index.php?r=site%2Fsecondarysales";
?>

<script type="text/javascript">

function hello(string,newarr)
{
//document.getElementById('myAnchor').value=name;

    var locid = sessionStorage.getItem("fileloc");

  //alert(string);
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

  $url = Yii::$app->urlManager->createAbsoluteUrl('site/validate');
  if($viewno==2)
   {
    echo "sales";
   }
  // $url1 = Yii::$app->urlManager->createAbsoluteUrl('site/validatemark');
  // $url2 = Yii::$app->urlManager->createAbsoluteUrl('site/getid');
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
                        url: "'.$url.'",
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
                        url: "'.$url.'",
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
                        url: "'.$url.'",
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

   // $variable= "<script>document.write(menu_id)</script>" ;
   //   //variablephp is php variable
   // echo $variable;
?>

                                            }

var tempurl = window.location.href.split('secondarysales');
//alert(tempurl[0]);
//return false;

//alert(anztype+ "  "+chosen2);
//return false;

      if(anztype==3 && chosen2==2) {
          chosen2 = 1;
      } else if(anztype==3 && chosen2==0) {
          chosen2 = 5;
      }

var new1 = tempurl[0]+"secondarysales&categs="+string+"&antype="+anztype+"&ptype="+prdtype+"&year="+chosen1+"&view="+chosen2;

//alert(new1);
//return false;

locnew = new1+"&locid="+locid+"&proceed=yes";
//alert(locnew);
//return false;

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
// window.location.href = locnew;
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
      //echo "Nooooooooooo  ooooo";
      //START CREATING TEMPORARY TABLES .....
      //include("create_temp_tables.php");

      $_SESSION['CATEG'] = $_REQUEST['categs'];
  }
} else {
  $_SESSION['CATEG'] = "";
}?>




<div style="width:100%; height:100%; overflow: auto;">

<div class="iframe-container" style=" text-align:left; float:left;">

<iframe id="mapframe" src="<?php echo $urlmap5; ?>" frameborder="0" height="100%" width="100%" style="text-align:left; float:left;"></iframe>

</div>

<?php



} else {
  //echo "=========================> Not Authorized to View or UnAuthorized login or Session Timeout !!! ";
  header("Refresh:0; url=index.php?r=site/login");
}

?>

</div>
