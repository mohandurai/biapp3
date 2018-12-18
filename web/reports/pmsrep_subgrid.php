<?php

//$grid->debug = true;

//require_once"../class/db.php";
require_once 'jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);
$conn->query("SET NAMES utf8");

// Create the jqGrid instance
$grid = new jqGridRender($conn);

$conn->query("SET NAMES utf8");

// Get the needed parameters passed from the main grid
$subtable = jqGridUtils::Strip($_REQUEST["subgrid"]);
$rowid = jqGridUtils::Strip($_REQUEST["rowid"]);
//if(!$subtable && !$rowid) die("Missed parameters");

//echo $subtable . " <<=== " . $rowid . "</br>";
//exit;

$new_qry = "select 'Qtr-1' as Period, '518866528.83' as Amount 
UNION ALL 
select 'Qtr-2' as Period, '477322667.79' as Amount 
UNION ALL 
select 'Qtr-3' as Period, '608564722.36' as Amount 
UNION ALL 
select 'Qtr-4' as Period, '474614248.23' as Amount";

//echo $new_qry;
//exit;

// Create the jqGrid instance
$grid = new jqGridRender($conn);

// Write the SQL Query
$grid->SelectCommand = $new_qry;

// set the ouput format to json
$grid->dataType = 'json';

$grid->setColModel(null, array(&$rowid));


//$grid->toolbarfilter = true;
// Enable operation search
//$grid->setFilterOptions(array("searchOperators"=>true));

// Set the url from where we obtain the data
$grid->setUrl('pmsrep_subgrid.php');

$grid->setGridOptions(array(
    "width"=>900,
    "rowNum"=>15,
    "height"=>'auto',
    "postData"=>array("subgrid"=>$subtable,"rowid"=>$rowid)
));


	$grid->setColProperty("Period", array("label"=>"Period","width"=>"20","align"=>"center"));
	$grid->setColProperty("Amount", array("label"=>"Amount (Rs.)","width"=>"75","align"=>"center"));

/*
$grid->setColProperty("Employee_Name", array("label"=>"Employee Name","width"=>"75","align"=>"left"));
$grid->setColProperty("Assigned", array("label"=>"Assigned","width"=>"30","align"=>"center"));
$grid->setColProperty("Saved", array("label"=>"Saved","width"=>"30","align"=>"center"));
$grid->setColProperty("Sent_for_Review", array("label"=>"Sent for Review","width"=>"32","align"=>"center"));
$grid->setColProperty("Review_Saved", array("label"=>"Review Saved","width"=>"30","align"=>"center"));
$grid->setColProperty("Closed", array("label"=>"Closed","width"=>"30","align"=>"center"));*/

//$grid->toolbarfilter = true;
// Enable operation search
//$grid->setFilterOptions(array("searchOperators"=>true));

//$grid->setColProperty("emp_name", array("label"=>"Employee Name","width"=>"100","align"=>"left"));

//Change some property of the field(s)
// $grid->setColProperty("emp_name", array(
//     "formatter"=>"string",
//     "search"=>true
//     )
// );


$grid->setSubGridGrid("pmsrep_subsubgrid.php");


// Enjoy

$grid->navigator = true;
$grid->setNavOptions('navigator', array("excel"=>false,"csv"=>true,"add"=>false,"edit"=>false,"search"=>false,"del"=>false,"view"=>false));
$grid->csvfile ='report.csv';
$grid->csvsep =",";

// Enjoy
$subtable = $subtable."_t";
$pager = $subtable."_p";
$grid->renderGrid($subtable,$pager, true, null, array(&$rowid), true,true);

?>
