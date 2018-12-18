<!DOCTYPE html>
<html>
<head>
<link href="../web/css/login.css" rel="stylesheet" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//$(document).ready(function(){
//	$(document).keydown(function(event) {
//	    	    if (event.ctrlKey==true && (event.which == '61' || event.which == '107' || event.which == '173' || event.which == '109'  || event.which == '187'  || event.which == '189'  ) ) {
//		event.preventDefault();
//	     }
//	});
//
//	$(window).bind('mousewheel DOMMouseScroll', function (event) {
//	       if (event.ctrlKey == true) {
//		   event.preventDefault();
//	       }
//	});
//});
</script>

</head>




<body>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper">
<!--<div class="header-tun"><img src="../web/images/bklogo.png" width="100" height="100"></div>-->

		<div class="container">
		   <div class="lbanner"></div>
			<div class="form-box" id="login-box">
				<!--<div class="form-head-tun"><?= Html::encode($this->title) ?></div>-->
				<!--<div class="header"><?= Html::encode($this->title) ?></div>-->
				
				<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
				<div class="body bg-gray">
				<div class=""><img src="../web/images/bklogo.svg" class="avatar-logo"></div>
					<!--<p>Please fill out the following fields to login:</p>-->
<!--					<?= $form->field($model, 'username')->label(false)->textInput(array('placeholder="&#61447; User Name"' => 'User Name')) ?>
					<?= $form->field($model, 'password')->passwordInput()->label(false)->passwordInput(array('placeholder=" &#xf13e; Password"' => 'Password')) ?>
-->					<?= $form->field($model, 'username')->label(false)->textInput(array('placeholder="User Name"' => 'User Name')) ?>
					<?= $form->field($model, 'password')->passwordInput()->label(false)->passwordInput(array('placeholder="Password"' => 'Password')) ?>
					<?= $form->field($model, 'rememberMe')->checkbox() ?>
				</div>
				<div class="footer">

					<?= Html::submitButton('Login', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>
					
					<?= Html::a('I forgot My Password', ['site/request-password-reset']) ?>

				</div>
				<?php ActiveForm::end(); ?>
			</div>

	  </div>
</div>
</body>
</html>
