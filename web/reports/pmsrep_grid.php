<?php

session_start();
error_reporting(0);


//echo "From grid1.php";
//$aaa = $_SESSION['gridqry'];

 // $aaa = "SELECT (select location_name from biweb.city_master where refid=loc12) as Location, count(*) as Outlets FROM `area_life_style_indicator_final` WHERE `related_menu_id` in ($relatedid1)";

//  group by `loc12`";


//$grid->debug = true;
//echo $aaa;
//exit;

//echo "From grid1.php";

//require_once"../class/db.php";
require_once 'jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
// Tell the db that we use utf-8
$conn->query("SET NAMES utf8");

// Create the jqGrid instance
$grid = new jqGridRender($conn);

//	$query1 = "select lead_no, email, lastname, company, leadstatus, leadsource from vtiger_leaddetails";
				$relate=$_SESSION['relate'];

// Write the SQL Query
$grid->SelectCommand ='SELECT "Total" as Location, count(*) as Outlets FROM 
		`area_life_style_indicator_final` WHERE  related_menu_id in ('.$relate.')';

// Set the table to where you update the data
//$grid->table = 'vtiger_leaddetails, vtiger_crmentity, vtiger_users';

// Set output format to json
$grid->dataType = 'json';
// Let the grid create the model
//$grid->setPrimaryKeyId($fld1);
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('pmsrep_grid.php');

$grid->setGridOptions(array(
    "width"=>'950',
    "rowNum"=>15,
    "height"=>'auto'
    ));

$grid->toolbarfilter = true;
// Enable operation search
$grid->setFilterOptions(array("searchOperators"=>true));

$grid->setColProperty("Location", array("label"=>"Location","width"=>"50","align"=>"left"));
$grid->setColProperty("Outlets", array("label"=>"Total Retailer Count","width"=>"50","align"=>"center"));

// Set the parameters for the subgrid
//$grid->setSubGrid("subgrid1.php", $array1, $array2, $array3);
//$grid->setSubGridGrid("pmsrep_subgrid.php");


// Enable navigator
$grid->navigator = true;
// Enable only editing
$grid->setNavOptions('navigator', array("excel"=>false,"csv"=>true,"add"=>false,"edit"=>false,"del"=>false,"view"=>false));
// Enjoy
$grid->renderGrid('#grid','#pager',true, null, null, true,true);
$conn = null;

?>
