<?php
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
error_reporting(1);
//echo "AAAAAAAAAAAAA";
//exit;
// use yii\helpers\Url;
// use app\models\User;
// use yii\data\SqlDataProvider;
// require_once "db.php";
// use yii\base\ErrorException;




include("db.php");

//$url1 = Yii::$app->urlManager->createAbsoluteUrl('site/validatemark');

$domname = $_GET['domname'];


?>


<html>
  <head>
    <title>Tree Multiselect test</title>

    <meta charset="UTF-8">

    <style>
      * {
        /* font-family: sans-serif;
        font-size:13px;
        color:black; */
      }

  .sub1, .sub2 { display: none; }

    :checked ~ .sub1 {
        display: block;
        margin-left: 20px;
    }


   span {
        color: blue;
        margin-bottom: 4px;
    }


  .combsplit {
      margin-bottom: 4px;
  }

    </style>

    <style type="text/css">

    </style>

    <link rel="stylesheet" href="jquery.tree-multiselect.min.css">

    <script src="jquery-1.11.3.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="jquery.tree-multiselect.js"></script>
    <script type="text/javascript">

$("document").ready(function() {

       //alert("CCCCCCCCCC");

        $(".selected").hide();

        $("div.tree-multiselect, input.search").click(function() {
              //alert("XXXXXXXXXXXXXX");
              $('#showSelected').attr('checked', false);
              $('#showSelected1').attr('checked', false);
        });


// $("#w1").change(function(){

// var m =$(this).val();
// alert(m);
// });


        $("#showSelected").click(function(e) {


                                     var anztype =window.parent. $("#anlztype").val();
                                    var ptype=window.parent. $("#prdtype").val();

                         var b=    window.parent.  $("#w1").select2("data");
                         var c=    window.parent.  $("#w4").select2("data");

                         var e=    window.parent.  $("#w6").select2("data");
                       if(anztype==2 || anztype==3)
                       {
                   if(b.length==1)
                   {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w1").select2("val","");
                   }

                 else  if(c.length==1)
                   {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w4").select2("val","");
                   }


                 else    if(e.length==1)
                   {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w6").select2("val","");
                   }


                     else
                   {
                    console.log("valid");
                   }
                   }
          $("#showSelected1").prop( "checked", false );

          $(".split-options").hide();
          $(".cobine-options").toggle();
          // market -consumptionYear Validation
          var menu_id="";
          //alert(window.parent.$('#w1').val());
         $("#test-select-3 option:selected").each(function() {
                   menu_id = $(this).val();



                   });
                if(menu_id != "")
                 {


                       $.ajax({
                        url:"levelid.php",
                        type:"post",
                        data:{
                          "menu_id":menu_id
                          },
                       success: function(data){

                      t= JSON.parse(data);
                         // alert(t);
                         if(t==780)
                         {
                        var anztype =window.parent. $("#anlztype").val();
                           var ptype=window.parent. $("#prdtype").val();
                           if(anztype==2)
                           {
                            alert("Invalid selection only single year-cumulative is allowed");
                          window.parent. $("#anlztype").select2("val", "");
                          window.parent.  $("#prdtype").select2("val", "");
                          window.parent.  $("#w0").select2("val", "");
                          window.parent.  $("#w1").select2("val", "");
                          window.parent.  $("#w4").select2("val", "");
                          window.parent.  $("#w5").select2("val", "");
                          window.parent.  $("#w6").select2("val", "");
                          window.parent.  $("#w7").select2("val", "");
                       }
                         else if(anztype==3)
                         {
                            alert("Invalid selection only single year-cumulative is allowed");
                          window.parent. $("#anlztype").select2("val", "");
                         window.parent.  $("#prdtype").select2("val", "");
                          window.parent.  $("#w0").select2("val", "");
                          window.parent.  $("#w1").select2("val", "");
                           window.parent.  $("#w4").select2("val", "");
                          window.parent.  $("#w5").select2("val", "");
                          window.parent.  $("#w6").select2("val", "");
                          window.parent.  $("#w7").select2("val", "");
                         }
                       else
                       {
                       	console.log("valid");
                       }
                        }
                      }
                     });
                    }

                var cnt = $("#test-select-3 option:selected").length;
              if(cnt==0) {
                alert("Select some Category !!!");
                this.checked = false;
                $(".cobine-options").toggle();
                return false;
              } else {

                var filts = "";

                $("#test-select-3 option:selected").each(function() {
                   var aa = $(this).val();
                   filts = filts + aa + "_";

                });

                var menuids = filts.slice(0,-1);

               //  alert(menuids+" <<==== ");
                //return false;

                $.get("combsplit_options.php",{menuids:menuids, combsp:"C"},function(getting)
                {
                 // alert(getting);
                    //return false;


                   if(getting=="MktPot")
                    {

                        parent.hello(menuids+"~~~0");
                    }


                    else
                     {
                      $("#load-cobmopt").html(getting);
                      return false;
                    }

                    });

                       }

                        });

              $("#showSelected1").click(function(e) {

          //alert("Split is selected . ... . ");
                                     var anztype =window.parent. $("#anlztype").val();
                                    var ptype=window.parent. $("#prdtype").val();

                         var b=    window.parent.  $("#w1").select2("data");
                         var c=    window.parent.  $("#w4").select2("data");

                         var e=    window.parent.  $("#w6").select2("data");
                        if(anztype==2 || anztype==3)
                        {
                    if(b.length==1)
                    {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w1").select2("val","");
                   }

                  else  if(c.length==1)
                   {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w4").select2("val","");
                   }



                  else    if(e.length==1)
                   {
                    alert("select more than a year!!!!!!!!!!");
                    window.parent.  $("#w6").select2("val","");
                   }


                     else
                   {
                    console.log("valid");
                   }
                 }

         $("#showSelected").prop( "checked", false );

           $(".cobine-options").hide();
          $(".split-options").toggle();

           var menu_id="";
          //alert(window.parent.$('#w1').val());
      $("#test-select-3 option:selected").each(function() {
                   menu_id = $(this).val();

                       });
                if(menu_id != "")
                 {


                       $.ajax({
                        url:"levelid.php",
                        type:"post",
                        data:{
                          "menu_id":menu_id
                          },
                       success: function(data){

                      t= JSON.parse(data);
                         // alert(t);
                         if(t==780)
                         {
                        var anztype =window.parent. $("#anlztype").val();
                         var ptype=window.parent. $("#prdtype").val();
                           if(anztype==2)
                           {
                            alert("Invalid selection only single year-cumulative is allowed");
                          window.parent. $("#anlztype").select2("val", "");
                          window.parent.  $("#prdtype").select2("val", "");
                          window.parent.  $("#w0").select2("val", "");
                          window.parent.  $("#w1").select2("val", "");
                          window.parent.  $("#w4").select2("val", "");
                          window.parent.  $("#w5").select2("val", "");
                          window.parent.  $("#w6").select2("val", "");
                          window.parent.  $("#w7").select2("val", "");
                         }
                         else if(anztype==3)
                         {
                            alert("Invalid selection only single year-cumulative is allowed");
                           window.parent. $("#anlztype").select2("val", "");
                          window.parent.  $("#prdtype").select2("val", "");
                          window.parent.  $("#w0").select2("val", "");
                          window.parent.  $("#w1").select2("val", "");
                          window.parent.  $("#w4").select2("val", "");
                          window.parent.  $("#w5").select2("val", "");
                          window.parent.  $("#w6").select2("val", "");
                          window.parent.  $("#w7").select2("val", "");
                         }
                       else
                       {
                       	console.log("valid");
                       }
                        }
                      }
                     });
                    }


           var cnt = $("#test-select-3 option:selected").length;
              if(cnt==0) {
                alert("Select some Category !!!");
                this.checked = false;
                $(".cobine-options").toggle();
                return false;
              } else {

                var filts = "";
                $("#test-select-3 option:selected").each(function() {
                   var aa = $(this).val();
                   //alert(aa);
                   filts = filts + aa + "_";
                });
                var menuids = filts.slice(0,-1);



                $.get("combsplit_options.php",{menuids:menuids, combsp:"S"},function(getting)
                {
                    //alert(getting+" Mkt Pot and Split option response...."+menuids);
                if(getting=="MktPot") {
                        parent.hello(menuids+"~~~1");
                    } else {
                        $("#load-splitopt").html(getting);
                        return false;
                    }
                });

            }

        });


    $('#load-cobmopt').on('change','input[type=radio][name=level1]',  function () {
    // alert("AAAAAAAAA");

    var val3 = $(this).val();
    var res = val3.split("~~");

       // alert(val3+" <<<<==== "+res[1]);
       //return false;

                var filts = "";
                $("#test-select-3 option:selected").each(function() {
                   var aa = $(this).val();
                   //alert(aa);
                   filts = filts + aa + "_";
                });
                finfit = filts.slice(0,-1);
                //alert()
                var finstr = finfit + "&comb="+res[0]+"&mnid="+res[4]+"&combby=" + res[1]+"&tbl=" + res[2];

                // http://192.168.10.82/biweb7/web/index.php?r=site%2Fmarketingpotential&categs=2109_2110&comb=0&mnid=5_6&combby=3071&tbl=572_572_&antype=1&ptype=5&year=2015&view=0&locid=1---0&proceed=yes

                newarr = new Array();
                newarr.push(finfit);
                newarr.push(res[0]);
                newarr.push(res[4]);
                newarr.push(res[1]);
                newarr.push(res[2]);


 //     document.cookie = "comb = " + res[0];
 //      document.cookie = "comb = " + res[0];
 //       document.cookie = "comb = " + res[0];
                // document.cookie = "myJavascriptVar = " + myJavascriptVar
                //alert(finstr+"   SSSSSSSSSSSS");
                //return false;
                parent.hello(finstr,newarr);

    });


  $('#load-splitopt').on('change','input[type=radio][name=level1]',  function () {


       //alert("BBBBBBBBBBBBBBB");

        var val3 = $(this).val();
        var res = val3.split("~~");

        //alert(res[0]+" <<<<==== "+res[1]+" <<<<==== "+res[2]+" <<<<==== "+res[3]+" <<<<==== "+res[4]);
        //return false;

                    var filts = "";
                    $("#test-select-3 option:selected").each(function() {
                       var aa = $(this).val();
                       //alert(aa);
                       filts = filts + aa + "_";
                    });
                    finfit = filts.slice(0,-1);

                    var finstr = finfit + "&comb="+res[0]+"&mnid="+res[4]+"&combby=" + res[1]+"&tbl=" + res[2];

                    //alert(finstr+"   SSSSSSSSSSSS");
                    //return false;
                    newarr = new Array();
                newarr.push(finfit);
                newarr.push(res[0]);
                newarr.push(res[4]);
                newarr.push(res[1]);
                newarr.push(res[2]);
                    parent.hello(finstr,newarr);

    });


});

</script>

</head>

<body>

<?php
  // print_r($_SESSION);//die;
// print_r("expression");die;
  // echo $_SERVER['HTTP_REFERER'] . " <<<===</br>";
  $parurl = $_SERVER['HTTP_REFERER'];
  $query_str = parse_url($parurl, PHP_URL_QUERY);
  parse_str($query_str, $query_params);
  $checked = explode("_",$_REQUEST['categs']);

  $comb = explode("_",$_REQUEST['comb']);

  //   $checked = explode("_",$_REQUEST['categs']);

  // $comb = explode("_",$_REQUEST['comb']);

  //echo "<pre>";
  //print_r($checked);
  //echo "</pre>";

include("db.php");

//$host = "localhost";
//$username = "root";
//$password = "1111";
//$dbname = "biweb";

//echo $query_params['r'] . " <<== ";

//echo $host . " <<== " . $dbname . " <<== " . $username  . " <<== " . $password;
//exit;

if($query_params['r']=='site/marketingpotential') {
  $categ = 1;
} elseif ($query_params['r']=='site/secondarysales') {
  $categ = 2;
}

//$categ = 2;

$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT max(level) as low2 FROM bi_menus where active=1 and category=".$categ;
// echo $sql . " <<<=== </br>";
//exit;

$result = $conn->query($sql);
if (!$result) {
   // $_SESSION['is_menu']='N';
   // echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;

}
else
{
  // $_SESSION['is_menu']='Y';
}
$row = $result->fetch_assoc();
$curlev = $row['low2'];




$sql3 = "select id, title, tblrowid, tblid, levelid from bi_menus where parent_id=0 and category= " . $categ ." and id NOT IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0)";
// echo $sql3 . " <<<=== </br>";

$result3 = $conn->query($sql3);

echo '<select id="test-select-3" multiple="multiple">';

while($row3 = $result3->fetch_assoc()) {
  //echo $row3['id'] . "</br>";
  $sql3a = "SELECT id, title,tblrowid,tblid,levelid FROM bi_menus where active=1 and category= " . $categ ." and id=".$row3['id'];
  $result3a = $conn->query($sql3a);
  $row3a = $result3a->fetch_assoc();
  // echo "option value='".$row3a["id"]."'>".$row3a["title"]." option";
  //echo "</br>";
  $ee = "";
  foreach($checked as $cc) {
    if($cc==$row3a["id"]) {
      echo "<option value='".$row3a["id"]."' selected='selected' level='".$row3a["levelid"]."'  master='".$row3a["tblrowid"]."' table='".$row3a["tblid"]."'>".$row3a["title"]."</option>";
      $ee = "Yes";
      continue;
    }
  }

  if($ee!="Yes") {
    echo "<option value='".$row3a["id"]."'  master='".$row3a["tblrowid"]."'  level='".$row3a["levelid"]."' table='".$row3a["tblid"]."'>".$row3a["title"]."</option>";
  }

}

//echo "<pre>";
//print_r($row3);
//echo "</pre>";
//exit;

for($cc=2; $cc<=$curlev; $cc++)
{

//echo $cc . " <<<=== </br>";

    $sql2 = "SELECT id, title, parent_id, level,tblrowid,tblid,levelid FROM bi_menus where active=1 and category= " . $categ ." and level=".$cc;
    $result2 = $conn->query($sql2);

    //echo $sql2 . " <<<=== </br>";

    $datasec="";

    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            //echo "id: " . $row2["id"]. " - Name: " . $row2["title"] . "<br>";

              $sql3 = "SELECT id, title, parent_id,tblrowid,tblid,levelid FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
              $result3 = $conn->query($sql3);
              $row3 = $result3->fetch_assoc();
              if($cc==2) {

                $sql3b = "SELECT count(*) as cnt FROM bi_menus where id IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0) and category= " . $categ ." and id=".$row2["id"];
                //echo $sql3b . "</br>";
                $result3b = $conn->query($sql3b);
                $row3b = $result3b->fetch_assoc();
                if($row3b['cnt'] > 0) { continue; }
                else {
                $datasec = "";
                $datasec = $row3['title'];


                  $ff = "";
                  foreach($checked as $ef) {
                    if($ef==$row2["id"]) {
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."' table='".$row2["tblid"]."' master='".$row2["tblrowid"]."'  level='".$row2["levelid"]."' selected='selected'>".$row2["title"]."</option>";
                      $ff = "Yes";
                      continue;
                    }
                  }

                  if($ff!="Yes") {
                     echo "<option value='".$row2["id"]."' data-section='".$datasec."' table='".$row2["tblid"]."'  level='".$row2["levelid"]."' master='".$row2["tblrowid"]."'>".$row2["title"]."</option>";
                  }




               }

              } elseif($cc==3) {
                $datasec = "";
                $sql3 = "SELECT id, title, parent_id,tblrowid,tblid,levelid FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT id, title,tblrowid,tblid,levelid FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();

                $datasec .= $row4['title']."/".$row3['title'];
                //echo "</br>";
                //echo "option value='".$row2["id"]."' data-section='".$datasec."' ".$row2["title"]." option";
                //echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
                //echo "</br>";

                  $gg = "";
                  foreach($checked as $eg) {
                    if($eg==$row2["id"]) {
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."'  table='".$row2["tblid"]."' master='".$row2["tblrowid"]."'  level='".$row2["levelid"]."' selected='selected'>".$row2["title"]."</option>";
                      $gg = "Yes";
                      continue;
                    }
                  }

                  if($gg!="Yes") {
                    echo "<option value='".$row2["id"]."' data-section='".$datasec."' table='".$row2["tblid"]."'  level='".$row2["levelid"]."' master='".$row2["tblrowid"]."'>".$row2["title"]."</option>";
                  }


              }


              elseif($cc==4) {
                $datasec = "";
                 $sql3 = "SELECT id, title, parent_id,tblrowid,tblid,levelid FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT id, title,tblrowid,tblid FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
                $result4 = $conn->query($sql4);
                $row4 = $result4->fetch_assoc();

                $datasec .= $row4['title']."/".$row3['title'];
                //echo "</br>";
                //echo "option value='".$row2["id"]."' data-section='".$datasec."' ".$row2["title"]." option";
                //echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
                //echo "</br>";

                  $gg = "";
                  foreach($checked as $eg) {
                    if($eg==$row2["id"]) {
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."' table='".$row2["tblid"]."'  level='".$row2["levelid"]."' master='".$row2["tblrowid"]."' selected='selected'>".$row2["title"]."</option>";
                      $gg = "Yes";
                      continue;
                    }
                  }

                  if($gg!="Yes") {
                    echo "<option value='".$row2["id"]."' data-section='".$datasec."' table='".$row2["tblid"]."'  level='".$row2["levelid"]."' master='".$row2["tblrowid"]."'>".$row2["title"]."</option>";
                  }


              }


        }
    } else {
        echo "0 results";
    }

}

?>

</select>

<script type="text/javascript">
 $("#test-select-3").treeMultiselect({ enableSelectAll: true, sortable: true, searchable: true, startCollapsed: true });
</script>

</br>

<input type="hidden" id='showurl' />

<div id="com-split" style="font-size: 13px; color: white; font-weight: bold;">

<?php
// print_r($_SESSION);
if(isset($_REQUEST['comb']) && isset($_REQUEST['combby'])) {
  $radval = $_REQUEST['comb'];
  $optselect = $_REQUEST['combby'];
  // unset($_SESSION['comb']);
  // unset($_SESSION['combby']);
  // $_SESSION['comb']
  // echo $radval . " <<<==== " . $optselect . " <<<<<============= </br>";
?>

<?php if($radval==0) { ?>

<div class="col-md-6"><input id="showSelected" class="combsplit" name="combsplit" type="checkbox" checked="checked" > Combine </input></div>

  <div id="load-cobmopt" class="cobine-options" style="margin-left: 20px; font-size: 14px; font-weight: bold;">

    <?php
    $str2b = "";
    $sql6 = "SELECT refid, parent_id, label FROM `split_combine_view` where refid=".$optselect;
    $result6 = $conn->query($sql6);
    while($row6 = $result6->fetch_assoc())
    {
      $sql6a = "SELECT refid, label FROM `split_combine_view` where refid=".$row6['parent_id'];
      $result6a = $conn->query($sql6a);
      while($row6a = $result6a->fetch_assoc())
      {
        $str2b .= '<div><input type="radio" name="aa" value="'.$radval.'~~'.$row6a['refid'] .'" checked="checked" /> <label>'.$row6a['label'].'</label></div>';
      }

       $str2b .= '<div style="margin-left: 20px;"><input type="radio" name="bb" value="'.$radval.'~~'.$row6['refid'].'" checked="checked" /> <label>'.$row6['label'].'</label></div>';
    }

    echo $str2b;

    ?>

    </div>

    <div class="col-md-6"><input id="showSelected1" name="combsplit" type="checkbox" > Split </input></div>

    <div id="load-splitopt" class="split-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">


    </div>

<?php  } ?>

<?php if($radval==1) { ?>

  <div class="col-md-6"><input id="showSelected" class="combsplit" name="combsplit" type="checkbox" > Combine </input></div>

  <div id="load-cobmopt" class="cobine-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">


    </div>

  <input id="showSelected1" name="combsplit" type="checkbox" checked='checked' > Split </input></br>

  <div id="load-splitopt" class="split-options" style="margin-left: 20px; font-size: 14px; font-weight: bold;">

  </div>

<?php
}

} else {
?>

  <div class="col-md-6"><input id="showSelected" class="combsplit" name="combsplit" type="checkbox" value="0"> Combine </input> </div>

  <div id="load-cobmopt" class="cobine-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
  </div>

  <div class="col-md-6"><input id="showSelected1" class="combsplit" name="combsplit" type="checkbox" value="1"> Split </input></div>

  <div id="load-splitopt" class="split-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
  </div>

<?php
}

$conn->close();

?>

</div>

</body>
</html>
