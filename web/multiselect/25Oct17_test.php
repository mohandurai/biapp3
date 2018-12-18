<?php
ini_set('display_errors', 'Off');
ini_set('display_startup_errors', 'Off');
error_reporting(0);
//echo "AAAAAAAAAAAAA";
//exit;
?>


<html>
  <head>
    <title>Tree Multiselect test</title>

    <meta charset="UTF-8">

    <style>
      * {
        font-family: sans-serif;
        font-size:13px;
        color:black;
      }

    .aaa {
        display: block;
        color: white;
        margin-bottom: 4px;
    }

  .bbb {
          display: block;
        margin-bottom: 4px;
    }

  .combsplit {
      margin-bottom: 4px;
  }

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

        $("#showSelected").click(function(e) {  

          //alert("Combine is selected . ... . ");
          $("#showSelected1").prop( "checked", false );

          $(".split-options").hide();
          $(".cobine-options").toggle();

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
                finfit = filts.slice(0,-1);
                
                //alert(finfit+"   QQQQQQQQQQQ");
                //return false;

                $.get("combsplit_options.php",{finfit:finfit, combsp:"C"},function(getting)
                {
                    //alert(getting+" RRRRRRRRRRRRR");
                    $("#load-cobmopt").html(getting);
                    //return false;
                });

            }

        });

        $("#showSelected1").click(function(e) {  

          //alert("Split is selected . ... . ");
          $("#showSelected").prop( "checked", false );

          $(".cobine-options").hide();
          $(".split-options").toggle();

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
                finfit = filts.slice(0,-1);
                
                //alert(finfit+"   QQQQQQQQQQQ");
                //return false;

                $.get("combsplit_options.php",{finfit:finfit, combsp:"S"},function(getting)
                {
                    //alert(getting+" RRRRRRRRRRRRR");
                    $("#load-splitopt").html(getting);
                    //return false;
                });

            }

        });


$('#load-cobmopt').on('change','input[type=radio]',  function () {
   //alert("AAAAAAAAA");

   var val3 = $(this).val();
            var res = val3.split("~~");

            //alert(val3+" <<<<==== "+res[0]);
            //return false;
            
                var filts = "";
                $("#test-select-3 option:selected").each(function() {
                   var aa = $(this).val();
                   //alert(aa);
                   filts = filts + aa + "_";
                });
                finfit = filts.slice(0,-1);
                
                var finstr = finfit + "&comb="+res[0]+"&optselect=" + res[1];

                //alert(finstr+"   SSSSSSSSSSSS");
                parent.hello(finstr);

});



$('#load-splitopt').on('change','input[type=radio]',  function () {
   //alert("BBBBBBBBBBBBBBB");

    var val3 = $(this).val();
    var res = val3.split("~~");

           //alert(val3+" <<<<==== "+res[0]);
           //return false;
            
                var filts = "";
                $("#test-select-3 option:selected").each(function() {
                   var aa = $(this).val();
                   //alert(aa);
                   filts = filts + aa + "_";
                });
                finfit = filts.slice(0,-1);
                
                var finstr = finfit + "&comb="+res[0]+"&optselect=" + res[1];

                //alert(finstr+"   SSSSSSSSSSSS");
                parent.hello(finstr);

});

      });





    </script> 
  </head>

  <body>

<?php

  //echo $_SERVER['HTTP_REFERER'] . " <<<===</br>";
  $parurl = $_SERVER['HTTP_REFERER'];
  $query_str = parse_url($parurl, PHP_URL_QUERY);
  parse_str($query_str, $query_params);
  $checked = explode("_",$query_params['categs']);

  $comb = explode("_",$query_params['comb']);
  
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

$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT max(level) as low2 FROM bi_menus where active=1 and category=".$categ;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$curlev = $row['low2']; 

//echo $sql . " <<<=== </br>"; 


$sql3 = "select id, title from bi_menus where parent_id=0 and category= " . $categ ." and id NOT IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0)";
//echo $sql3 . " <<<=== </br>"; 

$result3 = $conn->query($sql3);

echo '<select id="test-select-3" multiple="multiple">';

while($row3 = $result3->fetch_assoc()) {
  //echo $row3['id'] . "</br>";  
  $sql3a = "SELECT id, title FROM bi_menus where active=1 and category= " . $categ ." and id=".$row3['id'];
  $result3a = $conn->query($sql3a);
  $row3a = $result3a->fetch_assoc();
  //echo "option value='".$row3a["id"]."'>".$row3a["title"]." option";
  //echo "</br>";
  $ee = "";
  foreach($checked as $cc) {
    if($cc==$row3a["id"]) {
      echo "<option value='".$row3a["id"]."' selected='selected'>".$row3a["title"]."</option>";
      $ee = "Yes";
      continue;
    } 
  }

  if($ee!="Yes") {
    echo "<option value='".$row3a["id"]."'  >".$row3a["title"]."</option>";
  }

}

//echo "<pre>"; 
//print_r($row3);
//echo "</pre>"; 
//exit;

for($cc=2; $cc<=$curlev; $cc++)
{

//echo $cc . " <<<=== </br>"; 

    $sql2 = "SELECT id, title, parent_id, level FROM bi_menus where active=1 and category= " . $categ ." and level=".$cc;
    $result2 = $conn->query($sql2);

    //echo $sql2 . " <<<=== </br>"; 

    $datasec="";

    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            //echo "id: " . $row2["id"]. " - Name: " . $row2["title"] . "<br>";

              $sql3 = "SELECT id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
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
                 //echo "</br>";
                 //echo "option value='".$row2["id"]."' data-section='".$datasec."' ".$row2["title"]." option";
                 //echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
                 //echo "</br>";

                  $ff = "";
                  foreach($checked as $ef) {
                    if($ef==$row2["id"]) {
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."' selected='selected'>".$row2["title"]."</option>";
                      $ff = "Yes";
                      continue;
                    } 
                  }

                  if($ff!="Yes") {
                    echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
                  }
                
               
                 

               }

              } elseif($cc==3) {
                $datasec = "";
                $sql3 = "SELECT id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT id, title FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
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
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."' selected='selected'>".$row2["title"]."</option>";
                      $gg = "Yes";
                      continue;
                    } 
                  }

                  if($gg!="Yes") {
                    echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
                  }


              }


              elseif($cc==4) {
                $datasec = "";
                $sql3 = "SELECT id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT id, title FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
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
                      echo "<option value='".$row2["id"]."' data-section='".$datasec."' selected='selected'>".$row2["title"]."</option>";
                      $gg = "Yes";
                      continue;
                    } 
                  }

                  if($gg!="Yes") {
                    echo "<option value='".$row2["id"]."' data-section='".$datasec."'>".$row2["title"]."</option>";
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
if(isset($query_params['comb']) && isset($query_params['optselect'])) {
  $radval = $query_params['comb'];
  $optselect = $query_params['optselect']; 
  //echo $radval . " <<<==== " . $optselect . " <<<<<============= </br>";
?>

<?php if($radval==0) { ?>

<input id="showSelected" class="combsplit" name="combsplit" type="checkbox" checked="checked" > Combine </input></br>

  <div id="load-cobmopt" class="cobine-options" style="margin-left: 20px; font-size: 14px; font-weight: bold;">

    <?php

    $sql6 = "SELECT id, labels FROM `combine_split_options` WHERE `combine_split` = 'C'";
    $result6 = $conn->query($sql6);
    while($row6 = $result6->fetch_assoc()) 
    {
       if($optselect==$row6['id']) { $showchek = 'checked="checked"'; } else { $showchek = ""; }
       echo '<span class="aaa"><input type="radio" value="0~~'.$row6['id'].'" name="combinesel" '.$showchek.' /> ' . $row6['labels'] .  ' </span>';
    }

    ?>

    </div>

    <input id="showSelected1" name="combsplit" type="checkbox" > Split </input></br>

    <div id="load-splitopt" class="split-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
    
    <?php

    $sql6 = "SELECT id, labels FROM `combine_split_options` WHERE `combine_split` = 'S'";
    $result6 = $conn->query($sql6);
    while($row6 = $result6->fetch_assoc()) 
    {
       if($optselect==$row6['id']) { $showchek = 'checked="checked"'; } else { $showchek = ""; }
       echo '<span class="aaa"><input type="radio" value="1~~'.$row6['id'].'" name="combinesel" '.$showchek.' /> ' . $row6['labels'] .  ' </span>';
    }

    ?>

    </div>

<?php  } ?>

<?php if($radval==1) { ?>

  <input id="showSelected" class="combsplit" name="combsplit" type="checkbox" > Combine </input></br>

  <div id="load-cobmopt" class="cobine-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
       
    <?php

    $sql6 = "SELECT id, labels FROM `combine_split_options` WHERE `combine_split` = 'C'";
    $result6 = $conn->query($sql6);
    while($row6 = $result6->fetch_assoc()) 
    {
       if($optselect==$row6['id']) { $showchek = 'checked="checked"'; } else { $showchek = ""; }
       echo '<span class="aaa"><input type="radio" value="0~~'.$row6['id'].'" name="combinesel" '.$showchek.' /> ' . $row6['labels'] .  ' </span>';
    }

    ?>

    </div>

  <input id="showSelected1" name="combsplit" type="checkbox" checked='checked' > Split </input></br>

  <div id="load-splitopt" class="split-options" style="margin-left: 20px; font-size: 14px; font-weight: bold;">
     
     <?php

    $sql6 = "SELECT id, labels FROM `combine_split_options` WHERE `combine_split` = 'S'";
    $result6 = $conn->query($sql6);
    while($row6 = $result6->fetch_assoc()) 
    {
       if($optselect==$row6['id']) { $showchek = 'checked="checked"'; } else { $showchek = ""; }
       echo '<span class="aaa"><input type="radio" value="1~~'.$row6['id'].'" name="combinesel" '.$showchek.' /> ' . $row6['labels'] .  ' </span>';
    }

    ?>

  </div>

<?php 
}  

} else {
?>

  <input id="showSelected" class="combsplit" name="combsplit" type="checkbox" value="0"> Combine </input> </br>
  
  <div id="load-cobmopt" class="cobine-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
  </div>

  <input id="showSelected1" class="combsplit" name="combsplit" type="checkbox" value="1"> Split </input></br>

  <div id="load-splitopt" class="split-options" style="display:none; margin-left: 20px; font-size: 14px; font-weight: bold;">
  </div>

<?php 
}  

$conn->close();

?>
  
</div>

</body>
</html>
