<?php

use yii\helpers\Html;
use yii\grid\GridView;
use  app\models\User;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php


$userlist=ArrayHelper::map(User::find()->all(),'id','username');


?>

<div class="user-index ie-botscrol">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="content-header">
        <?= Html::a('<i class="glyphicon glyphicon-user"></i>Create User', ['site/createuser'], ['class' => 'btn btn-success']) ?>
 <?= Html::a('<i class="glyphicon glyphicon-download-alt"></i>Export', ['export'], ['class' => 'btn btn-success']) ?>
</div>

<?php

//echo "<pre>";
//print_r($searchModel);
//echo "</pre>";
?>
 <?php //Pjax::begin(['clientOptions' => ['method' => 'POST','url'=> 'index.php?r=user/index']])  ;?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'username',
            'first_name',
            'last_name',
           // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
             'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',
	  // 'role',
 /*[
              'attribute' => 'role',
	      'value'=>'rolename.description',

	    ],*/


	    [
              'attribute' => 'reports_to',
	      'value'=>'userreportsto.username',
	      'filter'=>$userlist,
	    ],



		//'reports_to',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
			'template' => '{view}{update}{rejoin}',

			'buttons' => [


	 'rejoin' => function ($url, $model) {
            return Html::a('<span class="glyphicon glyphicon-eye-close"></span>', Url::toRoute(['/site/rejoin', 'did' => $model->id]), [
                        'title' => Yii::t('app', 'DeActivate'),
            ]);
        },



    ]

			//  test
			],

        ],
    ]); ?>

</div>
