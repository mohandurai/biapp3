<?php
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
// Write the SQL Query
$grid->SelectCommand = 'SELECT assessment_title as AssessmentTitle ,role_name AS Role,competency_name as CompetencyName,sum(test_completed) as total FROM tam_assessments_candidates f
inner join tam_assessments_schedule g on g.id=f.assessment_schedule_id
right join tam_assessments d on d.id=g.assessment_id
inner join tam_roles_competencies a on a.id=d.roles_competencies_id
inner join tam_competencies b on b.id=a.competency_id
inner join tam_roles c on c.id=a.role_id group by d.id';

// set the ouput format to json
$grid->dataType = 'json';
// Let the grid create the model
$grid->setColModel();
// Set the url from where we obtain the data
$grid->setUrl('grid.php');
// Set some grid options
$grid->setGridOptions(array("rowNum"=>10,"rowList"=>array(10,30,130),"sortname"=>"AssessmentTitle"));
// Enable footerdata an tell the grid to obtain it from the request
$grid->setGridOptions(array("footerrow"=>true,"userDataOnFooter"=>true));
$grid->navigator = true;
$grid->toolbarfilter = true;

// Change some property of the field(s)
//$grid->setColProperty("RequiredDate", array("formatter"=>"date","formatoptions"=>array("srcformat"=>"Y-m-d H:i:s","newformat"=>"m/d/Y")));
// At end call footerData to put total  label
$grid->callGridMethod('#grid', 'footerData', array("set",array("CompetencyName"=>"total Number Of Participants:")));
// Set which parameter to be sumarized
$grid->setNavOptions('search', array(
    "multipleGroup"=>true,
    "showQuery"=>true
));
$summaryrows = array("total"=>array("total"=>"SUM"));
$grid->renderGrid('#grid','#pager',true,$summaryrows , null, true,true);
$conn = null;
?>
