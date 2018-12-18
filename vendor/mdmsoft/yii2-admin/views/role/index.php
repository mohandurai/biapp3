<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\db\Query;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var mdm\admin\models\AuthItemSearch $searchModel
 */
$this->title = Yii::t('rbac-admin', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">


     <p class="headblockdetails">Roles</p>
 
<div class="fieldsblock">

    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Role'), ['create'], ['class' => 'btn btn-success btnmove']) ?>
    </p>

<?php


$connection = \Yii::$app->db;	
$sql = $connection->createCommand('SELECT distinct name as id,name as text FROM auth_item where type=1 and reports_to_role=""');
$auth_roles1 = $sql->queryAll();

$sql = $connection->createCommand('SELECT role_structure FROM role_structure where id=1');
$auth_roles = $sql->queryOne();

echo "<pre>";
$coredata[0]=json_decode($auth_roles['role_structure']);
for($k=0;$k<sizeof($auth_roles1);$k++)
{
$coredata[0][]=(object)$auth_roles1[$k];
}


//print_r($coredata[0]);

?>
	<?= \iutbay\yii2jstree\JsTree::widget([
    'name' => 'test',
		"id"=>"mytree",
   // 'value' => '1,2',
	'clientOptions' => ["plugins"=>['contextmenu', 'dnd', 'state',"themes","html_data","types"],'themes'=>[
                'name'=> 'proton',
                'responsive'=> true
            ],],
	'check_callback'=>new JsExpression(
                        "function (operation, node, parent, position, more) {
       // console.log(operation);
if(operation === 'copy_node' || operation === 'move_node') {
      //console.log(node.id);
	if(node.id == 'admin')
	{
	return false;
	}
      }
      return true; // allow everything else
                        }"),
    'items' => $coredata[0],
]) ?>
	<?= "</pre>"; ?>
	
	
	<?php

echo Html::button('Save Role Tree', [ 'class' => 'btn btn-primary btnmove', 'id'=>"save_tree" ]);
 $this->registerJsFile(Yii::$app->request->BaseUrl.'/custom_scripts/save_tree.js',['depends' => [\yii\web\JqueryAsset::className()]]); 

/*


 


 ?>

<?= \yiidreamteam\jstree\JsTree::widget([
    'containerOptions' => [
        'class' => 'data-tree',
    ],
    'jsOptions' => [
        'core' => [
            'multiple' => false,
            'data' => [
                ["text"=> "SM 1" ,"id"=> "SM1", "children"=> "s"]  
            ],
            'themes' => [
                'name' => 'foobar',
              //  'url' => "/yii_org_new/vendor/bower/jstree/dist/themes/default",
                'dots' => true,
                'icons' => false,
		'responsive'=> true
            ]
        ],
    ]
]) 

*/

?>
</div>
    <?php
    Pjax::begin([
        'enablePushState'=>false,
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]);
    Pjax::end();
    ?>

</div>
