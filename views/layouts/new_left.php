 ﻿<?php
use mdm\admin\components\MenuHelper;
use yii\bootstrap\Nav;
use kartik\sidenav\SideNav;
use yii\helpers\Url;
$name = @Yii::$app->user->identity->username;
$pass1 = @Yii::$app->user->identity->password_hash;
$pass = hash('md4',$pass1); 
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<style type="text/css">
.ojt{
margin-left:-2px;margin-right:5px;width: 22px;height: 22px;
}
.crt{
margin-left:-2px;margin-right:10px;width: 18px;height: 18px;
}
.addon{
margin-left:-2px;margin-right:10px;width: 18px;height: 18px;
}
.nblimg{
 margin-right: 5px; margin-top: -30px;	
}
.alertimg{
position:absolute;
margin-left: 3px;
margin-top: -10px;
}

</style>



<script>
function esn()
{
document.esn1.submit();
}


</script>






<aside class="left-side sidebar-offcanvas" style="max-height: 300px; overflow: auto;">

    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="user-panel">
                <div class="pull-left image">
                   <img src="<?= @Yii::$app->user->identity->profile_image_url?>" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>Hello, <?= @Yii::$app->user->identity->first_name  ?> </p>
                    <a href="<?= $directoryAsset ?>/#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
        <?php endif ?>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                                        class="fa fa-search"></i></button>
                            </span>
            </div>
        </form>

<?php


$_SESSION['login_id']= @Yii::$app->user->identity->username;



$items = [
                    [
                        'label' => '<span class="fa fa-angle-down"></span><span class="text-info">Menu Yii2</span>',
                        'url' => '#'
                    ],
                    ['label' => '<span class="fa fa-file-code-o"></span> Gii', 'url' => ['/gii']],
                    ['label' => '<span class="fa fa-dashboard"></span> Debug', 'url' => ['/debug']],
	             ['label' => '<span class="fa fa-dashboard"></span> Leads', 'url' => ['/leads/index']],
 ['label' => '<span class="fa fa-dashboard"></span> Users', 'url' => ['/user/index']],
 ['label' => '<span class="fa fa-dashboard"></span> Contact', 'url' => ['/site/contact']],
];






if(Yii::$app->user->can('create-lead'))
{

$items[]= ['label' =>'Permissions' , 'url' => ['/admin/']];
}
?>

<?php

function  admincheck2()
{
if( !empty(Yii::$app->user->identity->username))
return  false;
}



function  admincheck()
{
if(Yii::$app->user->identity->role != "admin")
return  false;
}





function  admincheck1()
{
if(Yii::$app->user->identity->role == "admin")
return true;
else
return(

     Yii::$app->controller->module->controller->id =='import' && Yii::$app->controller->module->controller->action->id == 'log'
   

	)? true : false;



}














$callback = function($menu){
    $data = eval($menu['data']);
    return [
        'label' => $menu['name'], 
        'url' => [$menu['route']],
        'options' => $data,
        'items' => $menu['children']
    ];
};

// $cmenus=MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback);



$newitems=MenuHelper::getAssignedMenu(Yii::$app->user->id,null,null,true);



echo SideNav::widget([
    'type' => SideNav::TYPE_DEFAULT,
    'encodeLabels' => false,
 //  'heading' => '<i class="glyphicon glyphicon-superscript"></i> Operations',
   'items' => [
        [
            'url' => ['/site/index'],
             'label' => Yii::t('app', 'Home'),
            'icon' => 'home',
	   //  'active' =>true ,
        ],

 /* [
            'label' => 'CRM',
            'icon' => 'object-align-bottom',
             'url' => "http://tuneem.com/ageaslms/log.php?username=$name&pass=$pass",
             	 //'visible' =>  admincheck2()
],*/
 
        
				[   'label' => 'Organization Structure',
				   'icon' => 'object-align-bottom',
				   'items' => [

['label' => 'Dealer Principal Master', 'icon'=>'', 'url'=>['/business-unit-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/business-unit-master/index')||Yii::$app->user->can('/business-unit-master/view')||Yii::$app->user->can('/business-unit-master/update')||Yii::$app->user->can('/business-unit-master/*')||Yii::$app->user->can('/*')) ? true : false,],

						   ['label' => 'Dealer Master', 'icon'=>'', 'url'=>['/dealership-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/dealership-master/index')||Yii::$app->user->can('/dealership-master/view')||Yii::$app->user->can('/dealership-master/update')||Yii::$app->user->can('/dealership-master/*')||Yii::$app->user->can('/*')) ? true : false,],

						   ['label' => 'Manpower Norm', 'icon'=>'', 'url'=>['/manpower-norms/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('/manpower-norms/delete')||Yii::$app->user->can('/manpower-norms/index')||Yii::$app->user->can('/manpower-norms/view')||Yii::$app->user->can('/manpower-norms/update')||Yii::$app->user->can('/neev-kpi-category/*')||Yii::$app->user->can('/*')) ? true : false,],

						   ['label' => 'Manpower Gap', 'icon'=>'', 'url'=>['/site/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						   ['label' => 'Org Chart', 'icon'=>'', 'url'=>['/site/rolestucture'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						    ['label' => 'Segment Master', 'icon'=>'', 'url'=>['/segmant-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/channel-master/index')||Yii::$app->user->can('/segmant-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/segmant-master/*')||Yii::$app->user->can('/*')) ? true : false,],
					  
					      ['label' => 'Geography Master', 'icon'=>'', 'url'=>['/geography-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/geography-master/index')||Yii::$app->user->can('/geography-master/view')||Yii::$app->user->can('/geography-master/update')||Yii::$app->user->can('/geography-master/*')||Yii::$app->user->can('/*')) ? true : false,],
				   ]
		   ],
		
		    [
				   'label' => 'Roles &Manpower Norms',
				   'icon' => 'cog',
				   'items' => [

						   ['label' => 'Job Descriptions', 'icon'=>'', 'url'=>['/job-description/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/job-description/index')||Yii::$app->user->can('/job-description/view')||Yii::$app->user->can('/dealership-master/update')||Yii::$app->user->can('/job-description/*')||Yii::$app->user->can('/*')) ? true : false,],


						 

						   ['label' => 'Competency', 'icon'=>'', 'url'=>['/competency-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/competency-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/competency-master/update')||Yii::$app->user->can('/competency-master/*')||Yii::$app->user->can('/*')) ? true : false,],

						   ['label' => 'Sub Competency', 'icon'=>'', 'url'=>['/sub-competency-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/sub-competency-master/index')||Yii::$app->user->can('/sub-competency-master/view')||Yii::$app->user->can('/sub-competency-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						   
    ['label' => 'Competency with SubCompetency Master', 'icon'=>'', 'url'=>['/competency-subcompetency/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],


						     ['label' => 'Role Mapping With Competency', 'icon'=>'', 'url'=>['/role-competency/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/role-competency/index')||Yii::$app->user->can('/role-competencyr/view')||Yii::$app->user->can('/role-competency/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						       ['label' => 'Recruitment Profile Sheet', 'icon'=>'', 'url'=>['site/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/index')||Yii::$app->user->can('#')||Yii::$app->user->can('/site/update')||Yii::$app->user->can('/site/*')||Yii::$app->user->can('/*')) ? true : false,],
						   ['label' => 'View Masters', 'icon'=>'', 'url'=>['/sub-competency-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						    ['label' => 'Neev Related Work', 'icon'=>'', 'url'=>['/new-related-work/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/new-related-work/index')||Yii::$app->user->can('/new-related-work/view')||Yii::$app->user->can('/new-related-work/update')||Yii::$app->user->can('/new-related-work/*')||Yii::$app->user->can('/*')) ? true : false,],

						  
					  
				   ]
		   ],
        [
				   'label' => 'Performance Management',
				   'icon' => 'object-align-vertical',
				   'items' => [

						   ['label' => 'KPI Category', 'icon'=>'', 'url'=>['/neev-kpi-category/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-category/index')||Yii::$app->user->can('/dealership-master/view')||Yii::$app->user->can('/dealership-master/update')||Yii::$app->user->can('/neev-kpi-category/*')||Yii::$app->user->can('/*')) ? true : false,],


						 

				

						   ['label' => 'KPI Elements', 'icon'=>'', 'url'=>['/neev-kpi-category-lineitems/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-category-lineitems/index')||Yii::$app->user->can('/neev-kpi-category-lineitems/view')||Yii::$app->user->can('/neev-kpi-category-lineitems/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						   
						     ['label' => 'Local KPI Elements', 'icon'=>'', 'url'=>['/neev-kpi-local-category-lineitems/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-local-category-lineitems/index')||Yii::$app->user->can('/neev-kpi-local-category-lineitems/view')||Yii::$app->user->can('/neev-kpi-local-category-lineitems/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						   
						   
						   
						   		 /*  ['label' => ' Local KPI Elements ', 'icon'=>'', 'url'=>['/neev-kpi-lineitems/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-lineitems/index')||Yii::$app->user->can('/neev-kpi-lineitems/view')||Yii::$app->user->can('/neev-kpi-lineitems/update')||Yii::$app->user->can('/neev-kpi-lineitems/*')||Yii::$app->user->can('/*')) ? true : false,],*/
						   		   
						     ['label' => 'MBO Rolewise Allocation', 'icon'=>'', 'url'=>['/rolewise-mbo-template/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/rolewise-mbo-template/index')||Yii::$app->user->can('/rolewise-mbo-template/view')||Yii::$app->user->can('/rolewise-mbo-template/update')||Yii::$app->user->can('/rolewise-mbo-template/*')||Yii::$app->user->can('/*')) ? true : false,],
/*
						       ['label' => 'Create MBO Rolewise Allocation', 'icon'=>'', 'url'=>['/rolewise-mbo-template/templateshow'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/rolewise-mbo-template/templateshow')||Yii::$app->user->can('/rolewise-mbo-template/templateshow')||Yii::$app->user->can('/rolewise-mbo-template/templateshow')||Yii::$app->user->can('/rolewise-mbo-template/templateshow/*')||Yii::$app->user->can('/*')) ? true : false,],
*/
						         ['label' => 'Fill MBO Achievement', 'icon'=>'', 'url'=>['/mbo-entry-sheet/create'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						         
						         ['label' => 'View MBO By Employee', 'icon'=>'', 'url'=>['/rolewise-mbo-template/userviewmbo'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/rolewise-mbo-template/userviewmbo')||Yii::$app->user->can('/rolewise-mbo-template/userviewmbo')||Yii::$app->user->can('/rolewise-mbo-template/userviewmbo')||Yii::$app->user->can('/rolewise-mbo-template/*')||Yii::$app->user->can('/*')) ? true : false,],

						           ['label' => 'Role wise MBO Review Frequency', 'icon'=>'', 'url'=>['/competency-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
						   ['label' => 'MBO Calendar', 'icon'=>'', 'url'=>['/sub-competency-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/venue-master/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],

					  
					  
				   ]
		   ],
		   
		   
	[
				   'label' => 'Recruitment',
				   'icon' => 'cog',
				   'items' => [

	['label' => 'Manpower Norm', 'icon'=>'', 'url'=>['/manpower-norms/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('/manpower-norms/delete')||Yii::$app->user->can('/manpower-norms/index')||Yii::$app->user->can('/manpower-norms/view')||Yii::$app->user->can('/manpower-norms/update')||Yii::$app->user->can('/neev-kpi-category/*')||Yii::$app->user->can('/*')) ? true : false,],


						 

						   ['label' => 'Job Opening ', 'icon'=>'', 'url'=>['/oac-joborder/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/oac-joborder/index')||Yii::$app->user->can('/oac-joborder/view')||Yii::$app->user->can('/oac-joborder/update')||Yii::$app->user->can('/oac-joborder/*')||Yii::$app->user->can('/*')) ? true : false,],

						   ['label' => 'Job Application', 'icon'=>'', 'url'=>['/oac-jobapplicant/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/oac-jobapplicant/index')||Yii::$app->user->can('/oac-jobapplicant/view')||Yii::$app->user->can('/oac-jobapplicant/update')||Yii::$app->user->can('/oac-jobapplicant/*')||Yii::$app->user->can('/*')) ? true : false,],
						     ['label' => 'Interview Sheet & Hygiene Sheet', 'icon'=>'', 'url'=>['/site/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-measured-variabl/index')||Yii::$app->user->can('/neev-measured-variabl/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/neev-measured-variabl/*')||Yii::$app->user->can('/*')) ? true : false,],
						       ['label' => 'Recruitment Status ', 'icon'=>'', 'url'=>['/recruitment-status/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/recruitment-status/index')||Yii::$app->user->can('/recruitment-status/view')||Yii::$app->user->can('/recruitment-status/update')||Yii::$app->user->can('/recruitment-status/*')||Yii::$app->user->can('/*')) ? true : false,],
						     
						   ['label' => 'View OAC Reports', 'icon'=>'', 'url'=>['/site/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/site/index')||Yii::$app->user->can('/venue-master/view')||Yii::$app->user->can('/venue-master/update')||Yii::$app->user->can('/site/*')||Yii::$app->user->can('/*')) ? true : false,],
  ['label' => 'Factor Category', 'icon'=>'', 'url'=>['/neev-factor-category/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-factor-category/create')||Yii::$app->user->can('/neev-factor-category/view')||Yii::$app->user->can('/neev-factor-category/update')||Yii::$app->user->can('/neev-factor-category/*')||Yii::$app->user->can('/*')) ? true : false,],
					   ['label' => 'Factor LineItem', 'icon'=>'', 'url'=>['/neev-kpi-factor-lineitem/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-factor-lineitem/create')||Yii::$app->user->can('/neev-kpi-factor-lineitem/view')||Yii::$app->user->can('/neev-kpi-factor-lineitem/update')||Yii::$app->user->can('/neev-kpi-factor-lineitem/*')||Yii::$app->user->can('/*')) ? true : false,],
					    ['label' => 'Hygiene sheet ', 'icon'=>'', 'url'=>['/hygiene-factor/create'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-kpi-factor-lineitem/create')||Yii::$app->user->can('/neev-kpi-factor-lineitem/view')||Yii::$app->user->can('/neev-kpi-factor-lineitem/update')||Yii::$app->user->can('/neev-kpi-factor-lineitem/*')||Yii::$app->user->can('/*')) ? true : false,],
						  
					  
				   ]
		   ],
		   
		   
		   
		   
		   
		   
		   [
		     'label' => 'Career Path',
				   'icon' => 'cog',
				   'items' => [

						
						     
						   ['label' => 'Standard Career Path', 'icon'=>'', 'url'=>['/neev-careerpath/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-careerpath/create')||Yii::$app->user->can('/neev-careerpath/view')||Yii::$app->user->can('/neev-careerpath/update')||Yii::$app->user->can('/neev-careerpath/*')||Yii::$app->user->can('/*')) ? true : false,],

 ['label' => 'Dealer Career Path', 'icon'=>'', 'url'=>['/neev-dealer-careerpath/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-dealer-careerpath/create')||Yii::$app->user->can('/neev-dealer-careerpath/view')||Yii::$app->user->can('/neev-dealer-careerpath/update')||Yii::$app->user->can('/neev-dealer-careerpath/*')||Yii::$app->user->can('/*')) ? true : false,],
						  
			
            ]
       ],
        [
		     'label' => 'Audi Standard Template ',
				   'icon' => 'cog',
				   'items' => [

						
					['label' => 'MBO Templates', 'icon'=>'', 'url'=>['/audineev-mbo-templates/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/audineev-mbo-templates/index')||Yii::$app->user->can('/audineev-mbo-templates/view')||Yii::$app->user->can('/audineev-mbo-templates/update')||Yii::$app->user->can('/audineev-mbo-templates/*')||Yii::$app->user->can('/*')) ? true : false,],
		  
					  
				   ]
		   ],
   [
            'label' => 'Picklist',
            'icon' => 'object-align-bottom',
 'items' => [


    

['label' => 'Measured Variable Type', 'icon'=>'', 'url'=>['/neev-measured-vartype/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-measured-vartype/index')||Yii::$app->user->can('/neev-measured-vartype/view')||Yii::$app->user->can('/neev-measured-vartype/update')||Yii::$app->user->can('/neev-measured-vartype/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Measured Variables', 'icon'=>'', 'url'=>['/neev-measured-variable/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/neev-measured-variable/index')||Yii::$app->user->can('/neev-measured-variable/view')||Yii::$app->user->can('/neev-measured-variable/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => ' Frequency Master', 'icon'=>'', 'url'=>['/contest-frequency/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/contest-frequency/index')||Yii::$app->user->can('/contest-frequency/view')||Yii::$app->user->can('/contest-frequency/update')||Yii::$app->user->can('/venue-master/*')||Yii::$app->user->can('/*')) ? true : false,],
['label' => 'Subcategory Master', 'icon'=>'', 'url'=>['/subcategory-master/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/subcategory-master/index')||Yii::$app->user->can('/subcategory-master/view')||Yii::$app->user->can('/subcategory-master/update')||Yii::$app->user->can('/subcategory-master/*')||Yii::$app->user->can('/*')) ? true : false,],
]
],
		
  [
            'label' => 'Settings',
            'icon' => 'cog',
 'items' => [

 ['label' => 'Mobile Icons', 'icon'=>'', 'url'=>['/mobile-icons'], 
 'active'=>(Yii::$app->controller->module->controller->id == 'mobile-icons'), 
 'visible' => (Yii::$app->user->can('/mobile-icons/create')||Yii::$app->user->can('/mobile-icons/index')||
 Yii::$app->user->can('/mobile-icons/view')||
  Yii::$app->user->can('/mobile-icons/update')||Yii::$app->user->can('/*')) ? true : false,],

 ['label' => 'Instance Theme Roller ', 'icon'=>'', 'url'=>['/instance-setting'], 
 'active'=>(Yii::$app->controller->module->controller->id == 'instance-setting'), 
 'visible' => (Yii::$app->user->can('/instance-setting/create')||Yii::$app->user->can('/instance-setting/index')||
 Yii::$app->user->can('/instance-setting/view')||
  Yii::$app->user->can('/instance-setting/update')||Yii::$app->user->can('/*')) ? true : false,],

 ['label' => 'Related Lists', 'icon'=>'', 'url'=>['/related-lists'], 
 'active'=>(Yii::$app->controller->module->controller->id == 'mobile-icons'), 
 'visible' => (Yii::$app->user->can('/related-lists/create')||Yii::$app->user->can('/related-lists/index')||
 Yii::$app->user->can('/related-lists/view')||Yii::$app->user->can('http://tuneem.com/ageaslms/log.php?username=$name&pass=$pass')||
  Yii::$app->user->can('/related-lists/update')||Yii::$app->user->can('/*')) ? true : false,],

]
],






 [
            'label' => 'Admin panel',
            'icon' => 'cog',
	    
            'items' => [
             ['label' => 'User Master', 'icon'=>'', 'url'=>['/user/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'user'), 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/user/index')||Yii::$app->user->can('/user/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/user/*')) ? true : false,],

             
                ['label' => 'Roles And Profiles', 'icon'=>'', 'target'=>"_blank", 'url'=>['/admin/'], 'active'=>(Yii::$app->controller->module->controller->id == 'admin'), 'visible' => (Yii::$app->user->can('/admin/role/*')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Sharing Access/Rules', 'icon'=>'', 'url'=>['/sharing-rules/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'sharing-rules'), 'visible' => (Yii::$app->user->can('/sharing-rules/create')||Yii::$app->user->can('/sharing-rules/index')||Yii::$app->user->can('/sharing-rules/view')||Yii::$app->user->can('/sharing-rules/update')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'Import CSV', 'icon'=>'', 'url'=>['/import/step1'], 'active'=>((Yii::$app->controller->module->controller->id == 'import' && Yii::$app->controller->module->controller->action->id == 'step1') || Yii::$app->controller->module->controller->id == 'step2' || Yii::$app->controller->module->controller->id == 'step3'), 'visible' => (Yii::$app->user->can('/import/step1')||Yii::$app->user->can('/import/step1')||Yii::$app->user->can('/import/step1')||Yii::$app->user->can('/import/step1')||Yii::$app->user->can('/*')) ? true : false,],

['label' => 'CSV Log', 'icon'=>'', 'url'=>['/import/log'], 'active'=>(Yii::$app->controller->module->controller->id == 'import' && Yii::$app->controller->module->controller->action->id == 'log'), 'visible' => (Yii::$app->user->can('/import/log')||Yii::$app->user->can('/import/log')||Yii::$app->user->can('/import/log')||Yii::$app->user->can('/import/log')||Yii::$app->user->can('/*')) ? true : false,],

		['label' => 'Export Records', 'icon'=>'', 'url'=>['/csv-export/index'], 'active'=>(Yii::$app->controller->module->controller->id == 'csv-export'), 'visible' => (Yii::$app->user->can('/csv-export/create')||Yii::$app->user->can('/csv-export/index')||Yii::$app->user->can('/csv-export/view')||Yii::$app->user->can('/csv-export/update')||Yii::$app->user->can('/*')) ? true : false,],

 
            ],
        ],








		
    ],
	
	
//	'items'=>$newitems,
]);


?>



            

        

    </section>

</aside>

<form name="esn1" id="esn1" action="https://tuneem.com/Tuneemesn/login" method="post" target="_blank">


 <input type='hidden' name='uname' id="uname" value="admin1" />
<input type='hidden' name='pass' id="pass" value="rew@2014"/>


<?  /*

<input type='text' name='uname' id="uname" value="<? echo $_SESSION['login_id']; ?>" />
<input type='text' name='pass'

['label' => 'Import CSV', 'icon'=>'', 'url'=>['/import/step1'], 'active'=>(
 	(Yii::$app->controller->module->controller->id =='import' &&
 	Yii::$app->controller->module->controller->action->id == 'step1') 
    || Yii::$app->controller->module->controller->id == 'step2' || Yii::$app->controller->module->controller->id == 'step3'),
     'visible' =>  admincheck()],             
 id="pass" value="rew@2014"/>

<input type='hidden' name='uname' id="uname" value="<?= $_SESSION['login_id']; ?>" />

<input type='hidden' name='pass' id="pass" value="rew@2014!"/> 
*/?>


</form>
