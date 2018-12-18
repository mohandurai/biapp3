<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

include("db.php");
$conn = mysqli_connect($host, $username, $password) or die(mysqli_error());
$db = mysqli_select_db($conn, $dbname) or die (mysqli_error());
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<style type="text/css">
.modal-dialog{
margin-right: 0;
}
.modal-content{
background:#d5d9d8;
border-radius: 0;
}
.modal-footer{
border-top: none;
padding-right:30px;
}
.panel{
border:none;
border-radius: 0;
background:#b0b6b8;
box-shadow: 0 1px 1px rgba(0, 0, 0, 5);
color: #fff;
font-weight: bold;
}
.panel-body{
	padding-bottom: 0px;
	padding-top: 0px;
}
.text-muted{
color: #715d49;
font-weight: bold;
padding-top: 17px;
}
.imgbot{
margin-bottom:10px;
}
.content {
/*padding: 50px 15px 0px 15px !important;*/
}
.pull-center{
text-align: center;
}
	.selectRow {
    display : block;
    padding : 0px;
}
.select2-container {
    width: 200px;
}
/*loader css*/


/* Absolute Center Spinner */
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.5) -1.5em 0 0 0, rgba(255, 255, 255, 0.5) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

/*loader css ends here*/
</style>
<link rel="stylesheet" href="https://rawgit.com/select2/select2/master/dist/css/select2.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery-1.9.1.min.js"></script>

<script src="https://rawgit.com/select2/select2/master/dist/js/select2.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
var testyear ='';
$(document).ready(function() {
    sessionStorage.setItem('view',0);
    sessionStorage.setItem('year',2017)
    sessionStorage.setItem('categs','');
    sessionStorage.setItem('id','');
    sessionStorage.setItem('parentlvl','');
    sessionStorage.setItem('childlvl','');
    sessionStorage.setItem('groupby','');
    sessionStorage.setItem('tbl','');
    sessionStorage.setItem('level','');
    sessionStorage.setItem('levelid','');
    sessionStorage.setItem('menu_id','');
    sessionStorage.setItem('menu_item_id','');
    sessionStorage.setItem('split_combine_id','');

    $('body').find(".By_Cal_Yr").prop("checked", true).trigger("click");
    $('body').find(".Single").prop("checked", true).trigger("click");


    period_type=$('input[type=radio][name="periodtype"]:checked').attr('id');
    period =$('input[type=radio][name="period"]:checked').attr('id');
    calchange(period_type,period);

    // alert($('body').find(".Single").parent().parent().next().find('#selectId1').val());
    // $('body').find('#3d #selectId1').val('2017');
    // $('body').find('option[value="2017"]').attr('selected', 'selected');

   // $('body').find("#2").prop("checked", true).trigger("click");
  // $("input[name='period']").trigger('select');
	 $(".profile").click(function() {
  	$("#profile").show();
   $(".congra").hide();
});

    $(".user-menu" ).click(function() {
        $(".homepaimgov" ).toggle();
    });
    $(".innpaimg").click(function() {
        $(".homepaimgov" ).hide();
    });
    $(".homepaimgov").click(function()
    {
        $(".homepaimgov" ).hide();
    });

});
</script>
<header class="header">
<!--
<div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='demo_wait.gif' width="64" height="64" /><br>Loading..</div> -->
<nav class="navbar navbar-static-top" role="navigation">
<div class="col-md-2 logo">
	<img src="images/brandideaAnalytics.png" alt="BrandIdea Analytics">
	<a id="sidebarCollapse" class="pull-right">  <i class="fa fa-bars"></i></a>
</div>
<div class=" llor  header-nav">
	<div class="row">
<?php
        $itemsop=array();
        // print_r(yii::$app->user->identity->module_ids);die;
        // $selectuser = "select module_ids from "
        $selectdata ="select level_id,menu_name,file_name,image_path from bi_menu WHERE parent_id='0' and client_id=
        '89' and refid in (".yii::$app->user->identity->module_ids.") and stat!='R' order by order_fld ";
       $query = yii::$app->db->createCommand($selectdata)->queryAll();
       // echo "<pre>";
      // print_r($query);die;
      for($i=0;$i<count($query);$i++)
        {
                $r[$i]= $query[$i]['level_id'].",".$query[$i]['menu_name'].",".$query[$i]['file_name'].",".$query[$i]['image_path'];
                 $menu_name[$i]= $query[$i]['menu_name'];
                 $level_id[$i]=$query[$i]['level_id'];
                 $file_name[$i]=$query[$i]['file_name'];
                 $image_path[$i]=$query[$i]['image_path'];
                $cat='category';
               // $string[$i] = preg_replace('/\s+/', '', $level_id[$i]);
                  $item[$i] =[
                  'label' => '<span><img src= '.$image_path[$i].' alt=""></span> '.$menu_name[$i],
                  'icon '=>'hand-left',
                   'url'=>['/site/'.$file_name[$i],$cat=>$level_id[$i]],
                   'options' => ['id'=>$menu_name[$i] ,'category'=>$level_id[$i],'class'=>'menu-nav'],
                    'active'  => (Yii::$app->controller->module->controller->id == 'user'),
                      'visible' =>(1==1 )? true : false
                             ];
          array_push($itemsop, $item[$i]);
        }
// 'visible' =>(Yii::$app->user->can('/site/"'.$file_name[$i].'"')||
//                                    Yii::$app->user->can('/site/"'.$file_name[$i].'"')||
//                                    Yii::$app->user->can('/site/"'.$file_name[$i].'"')||
//                                    Yii::$app->user->can('/site/"'.$file_name[$i].'" /* ')||
//                                    Yii::$app->user->can('/*') )? true : false
// echo "<pre>";
// print_r($itemsop);die;

 //      $test =  [
 //            'label' => '<span><img src="images/icons/setting.png" alt="miaro project "></span> Admin panel',
 //            'icon' => 'cog',
 //            'options'=> ['id'=>'admin','class'=>'menu-nav admin-dropdown'],
 //
 //            'items' => [
 //             ['label' => 'User Master', 'icon'=>'', 'url'=>['/user/index'], /*'active'=>(Yii::$app->controller->module->controller->id == 'user'),*/ 'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/user/index')||Yii::$app->user->can('/user/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/user/*')) ? true : false,],
 //             ['label' => 'Menu Master', 'icon'=>'', 'url'=>['/bi-menus/index'], 'visible' =>  (Yii::$app->user->can('user-signup') || Yii::$app->user->can('/bi-menus/index')||Yii::$app->user->can('/bi-menus/view')||Yii::$app->user->can('/bi-menus/*')) ? true : false,],
 //              ['label' => 'Profile Log', 'icon'=>'', 'url'=>['/profile-log/index'], 'visible' => (Yii::$app->user->can('user-signup') || Yii::$app->user->can('/profile-log/index')||Yii::$app->user->can('/profile-log/view')||Yii::$app->user->can('/profile-log/*')) ? true : false,],
 // ['label' => 'Menu Allocation ', 'icon'=>'', 'url'=>['/menu-allocation/index'],  'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/menu-allocation/index')||Yii::$app->user->can('/menu-allocation/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/menu-allocation/*')) ? true : false,],
 //    ['label' => 'Location Master', 'icon'=>'', 'url'=>['/location-master/index'],  'visible' => (Yii::$app->user->can('user-signup')||Yii::$app->user->can('/location-master/index')||Yii::$app->user->can('/location-master/view')||Yii::$app->user->can('update-user')||Yii::$app->user->can('/location-master/*')) ? true : false,],
 //                ['label' => 'Roles And Profiles', 'icon'=>'', 'target'=>"_blank", 'url'=>['/admin/'], 'active'=>(Yii::$app->controller->module->controller->id == 'admin'), 'visible' => (Yii::$app->user->can('/admin/role/*')||Yii::$app->user->can('/*')) ? true : false,],
 //            ],
 //        ];
 //      if(yii::$app->user->identity->id == 1)
 //      {
 //        array_push($itemsop, $test);
 //      }

      echo Nav::widget([

          'encodeLabels' =>false ,
              'items' =>$itemsop,
      ]);
 ?>

<!-- <input type='text' id="custom" /> -->
<div class="col-md-1 clint-logo pull-right">
    <img src="images/client-logo.png" alt="" width="110">
</div>
<ul class="nav navbar-nav pull-right">

<?php
if (Yii::$app->user->isGuest) {
    ?>
    <li class="dropdown tasks-menu">
        <?= Html::a('Login', ['/site/login']) ?>
    </li>
<?php
} else {
$role = @Yii::$app->user->identity->role;
$arr = explode("_",$role);
unset($arr[0]);
?>
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" title="User Info" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i>
            <!-- <span><?= ucfirst(@Yii::$app->user->identity->first_name) . " " . ucfirst(@Yii::$app->user->identity->last_name) ?>
            <i class="caret"></i> -->
     <!-- <span style="padding-left:16%;font-size:11px;"><?= implode($arr); ?></span> -->
            <!-- </span> -->
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
      <img src="images/user.png" class="img-circle" alt="User Image"/>
      <!-- <img src="<?= @Yii::$app->user->identity->profile_image_url?>" class="img-circle" alt="User Image"/> -->

                <p>
     <?= ucfirst(@Yii::$app->user->identity->first_name) . " " . ucfirst(@Yii::$app->user->identity->last_name) ?> - <?= ucfirst(@Yii::$app->user->identity->role) ?>
                    <?php
                    $cdate = @Yii::$app->user->identity->created_at;
                    ?>
                    <small>Member since <?php echo date('F j, Y', $cdate) ?></small>
                </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">

            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
                <!--<div class="pull-left profile">
                    <a class="btn btn-default btn-flat">Profile</a>
                </div>-->

                <div class="pull-center">
                    <?= Html::a(
                            'Sign out',
                            ['/site/logout'],
                            ['data-method' => 'post','class'=>'btn btn-success','id'=>'logout']
                        ) ?>
                </div>
            </li>
        </ul>
    </li><?php
}
?>
</ul>
<div class="dropdown digits pull-right">
  <a class="btn btn-default dropdown-toggle dig-button" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="Units Convertion">
    <img src="images/unit_icon.png" height="22px" width="22px" >

  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a class="reading-conv" data-value="4" href="#">Hundreds.</a></li>
    <li><a class="reading-conv" data-value="1" href="#">Crs.</a></li>
    <li><a class="reading-conv" data-value="2" href="#">lacs.</a></li>
    <li><a class="reading-conv" data-value="3" href="#">Thousands</a></li>
  </ul>
</div>
<div class="dropdown currency pull-right">
  <a class="btn btn-default dropdown-toggle dig-button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" title="Currency Convertion">
    <!-- <i class="fa fa-money" aria-hidden="true"></i> -->
      <img src="images/units.svg" height="22px" width="22px" >
    <!-- <span class="caret"></span> -->
  </a>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <li><a class="currency-conv" data-value="11" href="#">INR-Indian Rupee</a></li>
    <li><a class="currency-conv" data-value="12" href="#">USD-U.S Dollar</a></li>
    <li><a class="currency-conv" data-value="13" href="#">EUR-Euro</a></li>
    <li><a class="currency-conv" data-value="14" href="#">GBP-British Pound</a></li>
    <li><a class="currency-conv" data-value="15" href="#">JPY-Japanese Yen</a></li>
    <li><a class="currency-conv" data-value="16" href="#">CNY-Chinese Yuan</a></li>
  </ul>
</div>
<button class="chat pull-right" title="Chat" data-toggle="modal" data-target="#myModal"><i class="fa fa-comments" aria-hidden="true"></i></button>
<button class="report_iframe pull-right" title="Custom Pivot Report" data-toggle="modal" data-target="#myModal_report"><i class="fa fa-file-text" aria-hidden="true"></i></button>
</div>
</div>
<!--
<div class="llogo"></div>
<div class="logo"></div>
-->
</nav>
</header>

<script>
// $('.selbox').on('click', function() {
//   // alert($('input[name=period]:checked').val());
//     // $("#currentval").text($("#selectId1 option:selected").text());
//     $('.selectId1').val('2017');
// });
  // $(document).ajaxStart(function(){
  //     $(".loading").css("display", "block");
  // });
  // $(document).ajaxComplete(function(){
  //     $(".loading").css("display", "none");
  // });
  // function showLoader() {
  //   $(".loading").css("display", "block");
  // }
  // function hideLoader() {
  //   // setTimeout(function () {
  //       $(".loading").css("display", "none");
  //   // }, 1000);
  // }

</script>
