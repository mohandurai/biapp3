<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

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
padding: 50px 15px 0px 15px !important;
}
</style>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	 $(".profile").click(function() {
  	$("#profile").show();
   $(".congra").hide();
});
});
</script>

<header class="header">



<!-- <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'logo']) ?> -->


<nav class="navbar navbar-static-top" role="navigation">

<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>

<div class="navbar-left">
<!-- <input type='text' id="custom" /> -->
<ul class="nav navbar-nav">

<?php
if (Yii::$app->user->isGuest) {
    ?>
    <li class="dropdown tasks-menu">
        <?= Html::a('Login', ['/site/login']) ?>
    </li>
<?php
} else {
    ?>
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="glyphicon glyphicon-user"></i>
            <span><?= ucfirst(@Yii::$app->user->identity->username) ?> <i class="caret"></i></span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
      <img src="<?= @Yii::$app->user->identity->profile_image_url?>" class="img-circle" alt="User Image"/>

                <p>
     <?= ucfirst(@Yii::$app->user->identity->username) ?> - <?= ucfirst(@Yii::$app->user->identity->role) ?>
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
                <div class="pull-left profile">
                    <a class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <?= Html::a(
                            'Sign out',
                            ['/site/logout'],
                            ['data-method' => 'post','class'=>'btn btn-default btn-flat']
                        ) ?>
                </div>
            </li>
        </ul>
    </li><?php
}
?>
<!-- User Account: style can be found in dropdown.less -->
<?php
///used for color picker ///

//$this->registerJsFile(Yii::$app->request->baseUrl.'/js/spectrum.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
</ul>
</div>

<div class="logo"></div>


</nav>
</header>


