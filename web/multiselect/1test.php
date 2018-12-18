<!DOCTYPE html5>
<html>
  <head>
    <title>Tree Multiselect test</title>

    <meta charset="UTF-8">

    <style>
      * {
        font-family: sans-serif;
      }
    </style>
    <link rel="stylesheet" href="jquery.tree-multiselect.min.css">

    <script src="jquery-1.11.3.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="jquery.tree-multiselect.js"></script>
    <script type="text/javascript">
      $("document").ready(function() {
        //alert("CCCCCCCCCC");

        //var url3 = document.referrer;
        //alert(url3);

        $(".selected").hide();

        $("#showSelected").click(function(e) {  
            //alert("Yesssssss");
            //var url3 = document.referrer;
            var filts = "";
            $("#test-select-3 option:selected").each(function() {
               var aa = $(this).val();
               //alert(aa);
               filts = filts + aa + "_";
            });
            //alert(filts);
            //var url5 = "&catids="+filts;
            //alert(filts);
            //$("#showurl").val(filts);
            parent.hello(filts);
            //window.location.href = url5;
            //return false;
        });

      });

    </script> 
  </head>

  <body>

<?php
error_reporting(0);

  //echo $_SERVER['HTTP_REFERER'] . " <<<===</br>";
  $parurl = $_SERVER['HTTP_REFERER'];
  $query_str = parse_url($parurl, PHP_URL_QUERY);
  parse_str($query_str, $query_params);
  $checked = explode("_",$query_params['categs']);
  //echo "<pre>";
  //print_r($checked);
  //echo "</pre>";
?>

<select id="test-select-3" multiple="multiple">

<?php

$host = "localhost";    
$username = "root";   
$password = "";   
$dbname = "biweb";    
    
//echo $host . " <<== " . $dbname . " <<== " . $username  . " <<== " . $password;   
//exit;   
   
$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());  
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());  
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT max(level) as low2 FROM bi_menus where active=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$curlev = $row['low2']; 
//echo $row['low2'] . " <<<=== </br>"; 


$sql3 = "select id, title from bi_menus where parent_id=0 and id NOT IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0)";
$result3 = $conn->query($sql3);

while($row3 = $result3->fetch_assoc()) {
  //echo $row3['id'] . "</br>";  
  $sql3a = "SELECT id, title FROM bi_menus where active=1 and id=".$row3['id'];
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

    $sql2 = "SELECT id, title, parent_id, level FROM bi_menus where active=1 and level=".$cc;
    $result2 = $conn->query($sql2);

    //echo $sql2 . " <<<=== </br>"; 

    $datasec="";

    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            //echo "id: " . $row2["id"]. " - Name: " . $row2["title"] . "<br>";

              $sql3 = "SELECT id, title, parent_id FROM bi_menus where id=".$row2["parent_id"];
              $result3 = $conn->query($sql3);
              $row3 = $result3->fetch_assoc();
              if($cc==2) {

                $sql3b = "SELECT count(*) as cnt FROM bi_menus where id IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0) and id=".$row2["id"];
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
                $sql3 = "SELECT id, title, parent_id FROM bi_menus where id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT id, title FROM bi_menus where id=".$row3["parent_id"];
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

$conn->close();

?>

</select>

    <script type="text/javascript">
        $("#test-select-3").treeMultiselect({ enableSelectAll: true, sortable: true, searchable: true });
    </script>


    <center><button id='showSelected'>Proceed</button></center>
    <input type="hidden" id='showurl' />

  </body>
</html>
