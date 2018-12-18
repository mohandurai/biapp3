<?php
session_start();

//require_once"../class/db.php";
require_once 'jq-config.php';
// include the jqGrid Class
require_once ABSPATH."php/jqGrid.php";
// include the driver class
require_once ABSPATH."php/jqGridPdo.php";
// Connection to the server
$conn = new PDO(DB_DSN,DB_USER,DB_PASSWORD);

$conn->query("SET NAMES utf8");

// Get the needed parameters passed from the main grid
$subtable = jqGridUtils::Strip($_REQUEST["subgrid"]);
$rowid = jqGridUtils::Strip($_REQUEST["rowid"]);
if(!$subtable && !$rowid) die("Missed parameters");

//echo $_SESSION['repid'] . " <<=== " . $subtable . " <<=== " . $rowid . "</br>" . $subsubgrdQry;

SELECT * 14878_sales PARTITION (p2015) WHERE fld627 IN (7,41) AND fld640 IN (1,2,3,4) and sub2_Q1 != 0

if($_SESSION['repid']==1) {
    $subsubgrdQry = "select m.name as `Employee_Name`,m.total as pms_to,ifnull(n.No_of_PMS,0) as `No_of_PMS`,ifnull(n.Assigned,0) as `Assigned`,
ifnull(n.Saved,0) as `Saved`,ifnull(n.Sent_for_Review,0) as `Sent_for_Review`,ifnull(n.Review_Saved,0) as `Review_Saved`,
ifnull(n.Closed,0) as `Closed` from
(select a.id as emp_id,concat(a.first_name,' ',a.last_name)as name,c.id,((count(distinct a.id))*(truncate((
case when c.mbo_frequency='Monthly' then (period_diff(month(str_to_date('". $_SESSION['tomth'] . "','%b')),month(str_to_date('". $_SESSION['month'] . "','%b')))+1)
when c.mbo_frequency='Quaterly' then (period_diff(month(str_to_date('". $_SESSION['tomth'] . "','%b')),month(str_to_date('". $_SESSION['month'] . "','%b')))+1)/3
when c.mbo_frequency='Half-Yearly' then (period_diff(month(str_to_date('". $_SESSION['tomth'] . "','%b')),month(str_to_date('". $_SESSION['month'] . "','%b')))+1)/6
end),0)))as total,substring_index(a.role,'_',-1) as role,c.mbo_frequency
from user as a,audineev_mbo_templates as b,audi_neev_designation as c
where substring_index(a.role,'_',-1)=c.neev_designation and b.role_id=c.neev_designation AND a.status='Active' and a.dp=" . $_SESSION['dpid'] . " group by a.id) as m
left join
(select b.id, a.emp_id,count(a.id) as `No_of_PMS`,
 sum(case when a.status = 'Assigned' then 1 else 0 end) as `Assigned`,
 sum(case when a.status = 'Saved' then 1 else 0 end) as `Saved`,
 sum(case when a.status = 'Sent for Review' then 1 else 0 end) as `Sent_for_Review`,
 sum(case when a.status = 'Review Saved' then 1 else 0 end) as `Review_Saved`,
 sum(case when a.status = 'Closed' then 1 else 0 end) as `Closed`
from mbo_employees as a, audi_neev_designation as b where substring_index(a.role_name,'_',-1)=b.neev_designation and a.year='". $_SESSION['year'] . "'
AND month(str_to_date((case when month='1-Qtr' then 'Mar'
                               when month='2-Qtr' then 'Jun'
                               when month='3-Qtr' then 'Sep'
                               when month='4-Qtr' then 'Dec'
                               when month='1-Half' then 'Jun'
                               when month='2-Half' then 'Dec' else month end) ,'%b')) Between month(str_to_date('". $_SESSION['month'] . "','%b')) and month(str_to_date('". $_SESSION['tomth'] . "','%b')) group by a.emp_id) as n
on m.id=n.id and m.emp_id=n.emp_id where m.id=". $rowid;
} else {
    $subsubgrdQry = "";
}

//exit;

// Create the jqGrid instance
$grid = new jqGridRender($conn);

// Write the SQL Query
$grid->SelectCommand = $subsubgrdQry;

// set the ouput format to json
$grid->dataType = 'json';

// Let the grid create the model
$grid->setColModel(null, array(&$rowid));

// Set the url from where we obtain the data
$grid->setUrl('pmsrep_subsubgrid.php');

// Set some grid options
$grid->setGridOptions(array(
    "width"=>840,
    "rowNum"=>10,
    "height"=>'auto',
    "postData"=>array("subgrid"=>$subtable,"rowid"=>$rowid)));
    

$grid->setColProperty("Employee_Name", array("label"=>"Employee Name","width"=>"75","align"=>"left"));
$grid->setColProperty("pms_to", array("label"=>"No of PMS </br> To be Conducted","width"=>"45","align"=>"center"));
$grid->setColProperty("No_of_PMS", array("label"=>"No of PMS </br> Actual","width"=>"30","align"=>"center"));
$grid->setColProperty("Assigned", array("label"=>"Assigned","width"=>"30","align"=>"center"));
$grid->setColProperty("Saved", array("label"=>"Saved","width"=>"30","align"=>"center"));
$grid->setColProperty("Sent_for_Review", array("label"=>"Sent for </br> Review","width"=>"34","align"=>"center"));
$grid->setColProperty("Review_Saved", array("label"=>"Review </br> Saved","width"=>"30","align"=>"center"));
$grid->setColProperty("Closed", array("label"=>"Closed","width"=>"30","align"=>"center"));


    
// Enable toolbar searching
//$grid->toolbarfilter = true;
//$grid->setFilterOptions(array("stringResult"=>true));
    
// Change some property of the field(s)
$grid->navigator = true;
$grid->setNavOptions('navigator', array("excel"=>false,"csv"=>true,"add"=>false,"edit"=>false,"del"=>false,"view"=>false));
$grid->csvfile ='report.csv';
$grid->csvsep =",";

// Enjoy
$subtable = $subtable."_t";
$pager = $subtable."_p";
$grid->renderGrid($subtable,$pager, true, null, array(&$rowid), true,true);
$conn = null;