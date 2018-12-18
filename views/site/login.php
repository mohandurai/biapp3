<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Welcome to BI Discovery';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/css/bootstrap.min.css");
$this->registerCssFile("@web/css/bimain.css");
?>
<div class="homepaimg"></div>
<div class="homepaimgov"></div>
<div class="login-section">
		<div class="container">
				<div class="form-box card card-login" id="login-box">
					<div ><!--<?= Html::encode($this->title) ?>-->
						<img src="images/brandideaAnalytics_logo.png" alt="BrandIdea Analytics">
					</div>
					<?php $form = ActiveForm::begin(['id' => 'login-form'], ['class' => 'login-form']); ?>
					<div class="body">
						<!--<p>Please fill out the following fields to login:</p>-->
						<?= $form->field($model, 'username')->textInput(['placeholder' => "Enter Usename"])->label(false) ?>
						<?= $form->field($model, 'password')->passwordInput(['placeholder' => "Enter Password"])->label(false) ?>
						<?= $form->field($model, 'rememberMe')->checkbox(['class' => '']) ?>
					</div>
					<div class="">

						<?= Html::submitButton('Login', ['class' => 'btn bg-olive btn-block', 'name' => 'login-button']) ?>

						<?= Html::a('Forgot My Password', ['site/request-password-reset'], ['class'=>'forgot-password']) ?>
						<?= Html::a('Create Account', ['site/request-password-reset'], ['class'=>'create-account']) ?>

					</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
</div>
