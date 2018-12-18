<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

      <div class="content-header">
        <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i>Create Profile Log', ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',

            [
                'attribute' => 'category',
                'value'=>'categorym.category',
            ],
             [
                'label'=>'Profile Name',
                'format' => 'raw',
                'value'=>function ($model) {


                        if(!empty($model->json_query)){
                            $test="";
                         $r=json_decode($model->json_query);
                         $test="";

                         foreach ($r as $key => $value) {
                            if($key=='locid'){
                            $v=explode("---",$value);
                            $l="";
                            if($v[1]==0){$l="World"; $test .="Map Level : ".$l;}
                            else if($v[1]==1){$l="Country"; $test .="Map Level : ".$l;}
                            else if($v[1] ==2){$l="Country State"; $test .="Map Level : ".$l;}
                            else if($v[1]==3){$l="State"; $test .="Map Level : ".$l;}
                            else if($v[1]==4){$l="State District"; $test .="Map Level : ".$l;}
                            else if($v[1]==5){$l="District "; $test .="Map Level : ".$l;}
                            else if($v[1]==6){$l="District Ward"; $test .="Map Level : ".$l;}
                            else if($v[1]==7){$l="Ward"; $test .="Map Level : ".$l;}else{$l="Unknown";}


                         }
                             if($key=='year'){

                             $test .="<br>Year : ".$value;}
                              if($key=='categs'){
                                $v2=explode("_",$value);
                                $v3=implode(",",$v2);
                                $sql="select title from bi_menus where id in (".$v3.")";
                                $mapdata1=yii::$app->db->createCommand($sql)->queryAll();

                                 for($l=0;$l<count($mapdata1);$l++)
                                 {
                                    $combine .=$mapdata1[$l]['title'].',';
                                 }

                                 $combine1=trim($combine,",");

                                 $test .="<br>Category : ".$combine1;
                            }
                             if($key=='comb'){
                                if($value==0){
                                 $test .="<br>View : Combine";
                                }else if($value ==1){
                                   $test .="<br>View : Split";
                                }
                            }
                         }


                            return $test;
                        }
                        else{
                            return '';
                        }

                },

            ],
            //'json_query:ntext',
            [
                'attribute' => 'userid',
                'value'=>'user.username',
            ],
           // 'status',
            [
                'label'=>'view',
                'format' => 'raw',
                'value'=>function ($model) {

                            $url = ['index.php?r=site/secondarysales', 'id' => $model->id];
                        if(!empty($model->json_query)){
                            $test="";
                         $r=json_decode($model->json_query);
                         foreach ($r as $key => $value) {
                             $test .="&".$key."=".$value;
                         }

                            return Html::a('Click here', 'index.php?r=site/secondarysales'.$test, [
                                    'title' => Yii::t('yii', 'Select'),'target'=>'_blank','class' => 'btn btn-primary-sel'
                            ]);
                        }
                        else{
                            return '';
                        }

                },

            ],
            [
            'attribute' => 'created_date',
                'label'=>'Created Date',
                'value'=>function ($model) {

                                $datetime=$model->created_date;
               $datetime1=strtotime($datetime);
              $date=date('d-M-Y  H:i:s',$datetime1);
                            return $date;
                            }

             ],
           // 'created_date',
            // 'modified_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
