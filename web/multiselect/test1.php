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
      }
    </style>
    <link rel="stylesheet" href="jquery.tree-multiselect.min.css">

    <script src="jquery-1.11.3.min.js"></script>
    <script src="jquery-ui.min.js"></script>
    <script src="jquery.tree-multiselect.js"></script>
    <script type="text/javascript">
      $("document").ready(function() {
        //alert("CCCCCCCCCC");
//setTimeout(function(){
      // console.log($("iframe#mapframe").contents());
       //  alert($("iframe#mapframe").contents().find("path[stroke=green]").attr("id"));},500);
        //var url3 = document.referrer;
        //alert(url3);
         
        $(".selected").hide();

        $("#combine").click(function(e) { 
            //alert("ZZZZZZZZZZZ");
            $("#com-split").show();
        });

        $("#split").click(function(e) { 
            //alert("ZZZZZZZZZZZ");
            $("#com-split").show();
        });

        $("div.tree-multiselect, input.search").click(function() {
              //alert("XXXXXXXXXXXXXX");
              $('#showSelected').attr('checked', false);
              $('#showSelected1').attr('checked', false);
        });

        $("#showSelected, #showSelected1").click(function(e) {  

            var contid = localStorage.getItem("contid");  
            var geolevel = localStorage.getItem("geolevel");  
            var locid = localStorage.getItem("locid"); 
           // alert(contid+" <<<=== "+geolevel+" <<<=== "+locid); 
          
            var cnt = $("#test-select-3 option:selected").length;
            if(cnt==0) {
              alert("Select some Category !!!");
              return false;
            }
            //var url3 = document.referrer;
            var filts = "";
            $("#test-select-3 option:selected").each(function() {
               var aa = $(this).val();
               //alert(aa);
               filts = filts + aa + "_";
            });
            finfit = filts.slice(0,-1);
            var radioValue = $("input[name='combsplit']:checked"). val();
            var finstr = finfit + "&comb=" + radioValue;

            //alert(finstr);
            //return false;
            //var url5 = "&catids="+filts;
            //alert(filts);
            //$("#showurl").val(filts);
            parent.hello(finstr);

            //window.location.href = url5;
            
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
  //print_r($query_params);
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


$sql3 = "select tblrowid as id, title from bi_menus where parent_id=0 and category= " . $categ ." and id NOT IN (SELECT DISTINCT parent_id FROM `bi_menus` where parent_id !=0)";
//echo $sql3 . " <<<=== </br>"; 

$result3 = $conn->query($sql3);

echo '<select id="test-select-3" multiple="multiple">';

while($row3 = $result3->fetch_assoc()) {
  //echo $row3['id'] . "</br>";  
  $sql3a = "SELECT tblrowid as id, title FROM bi_menus where active=1 and category= " . $categ ." and id=".$row3['id'];
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

    $sql2 = "SELECT tblrowid as id, title, parent_id, level FROM bi_menus where active=1 and category= " . $categ ." and level=".$cc;
    $result2 = $conn->query($sql2);

    //echo $sql2 . " <<<=== </br>"; 

    $datasec="";

    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {
            //echo "id: " . $row2["id"]. " - Name: " . $row2["title"] . "<br>";

              $sql3 = "SELECT tblrowid as id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
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
                $sql3 = "SELECT tblrowid as id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT tblrowid as id, title FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
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
                $sql3 = "SELECT tblrowid as id, title, parent_id FROM bi_menus where category= " . $categ ." and id=".$row2["parent_id"];
                $result3 = $conn->query($sql3);
                $row3 = $result3->fetch_assoc();

                $sql4 = "SELECT tblrowid as id, title FROM bi_menus where category= " . $categ ." and id=".$row3["parent_id"];
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
        $("#test-select-3").treeMultiselect({ enableSelectAll: true, sortable: true, searchable: true, startCollapsed: true
 });
    </script>

<!--
    <center></br>
        <button id="combine">Combine</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="split">Split</button>
    </center>
-->
    </br>
    <input type="hidden" id='showurl' />

<div id="com-split" style="height:500px; margin-left: 30px; font-size: 14px; color: white; font-weight: bold;">  

 
<?php
if(isset($query_params['comb'])) {
  $radval = $query_params['comb'];  
?>
    <input id="showSelected" name="combsplit" type="radio" value="0" <?php if($radval==0) echo "checked='checked'"; ?> > Combine </input></br>
    <input id="showSelected1" name="combsplit" type="radio" value="1" <?php if($radval==1) echo "checked='checked'"; ?> > Split </input></br></br>
<?php
} else {
?>

  <input id="showSelected" name="combsplit" type="radio" value="0"> Combine </input></br>
  <input id="showSelected1" name="combsplit" type="radio" value="1"> Split </input></br></br>

<?php
}
?>
  
</div>

</body>
</html>
