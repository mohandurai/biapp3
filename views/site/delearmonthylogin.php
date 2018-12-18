<?php
require_once "db.php";
 $month = $_REQUEST['month'];
 if(isset($month)){
 header('location:http://localhost/audi/web/index.php?r=site/dealermonthy&month='$month);
}
?>

