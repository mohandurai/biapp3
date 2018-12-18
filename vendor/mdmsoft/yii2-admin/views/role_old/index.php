<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\select2\Select2;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var mdm\admin\models\AuthItemSearch $searchModel
 */
$this->title = Yii::t('rbac-admin', 'Roles');
$this->params['breadcrumbs'][] = $this->title;


//print_r($coredata[0]);






?>


<div class="role-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php


$connection = \Yii::$app->db;	
$sql = $connection->createCommand('SELECT name as id,name as text FROM auth_item where type=1 and reports_to_role=""');
$auth_roles1 = $sql->queryAll();





$sql = $connection->createCommand('SELECT role_structure FROM role_structure where id=1');
$auth_roles = $sql->queryOne();

echo "<pre>";
$coredata[0]=json_decode($auth_roles['role_structure']);
for($k=0;$k<sizeof($auth_roles1);$k++)
{
$coredata[0][]=(object)$auth_roles1[$k];
}

$sql = $connection->createCommand('SELECT name as id,name as text FROM auth_item where type=1 ');
$auth_roles1 = $sql->queryAll();




Modal::begin([

'header'=>'<h4> <b> Transfer Related Users To  </b></h4>',
'id'=>'modal',
'size'=>'modal-lg'


]);

echo "<div id='modalContent'>";
?>
    <div class="alert alert-danger" role="alert">
      <b>NOTE ! This Action Cannot be Revert Back</b>
      </div>
<?
//echo "<input type=\"text\" id=\"suren\" value=\"10\"/>";

echo Select2::widget([
    'name' => 'roles',
	'id'=>'roles',
    'value' => '',
    'data' =>  ArrayHelper::map($auth_roles1,'id','id'),
    'options' => ['multiple' => false, 'placeholder' => 'Select Role']
]);

echo "<br>";
echo '<div>';


 echo Html::Button('Save', ['class' =>'btn btn-success','id'=>'role_select']);

 echo"</div>";
 
echo "</div>";

   


Modal::end();


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
if(operation === 'delete_node' || operation === 'delete_node') {
console.log(node);
console.log(parent);
console.log(position);
console.log(more);





function get_name_from_id(id)
{

 var nodInfo = $('#' + id);
 var node_text       = nodInfo.children('a').text();
 return node_text;

}


function leafpath(nodeid)
{
		

var str=new Array();

			
str.push(get_name_from_id(nodeid));

	$('#'+nodeid).find('li').each(function (i) 
	{


		      if(this.id.startsWith('j1_'))
			 {
			
			var node_name= get_name_from_id(this.id);
			
			
		 	str.push(node_name);

			}
			else
			{
			
				str.push(this.id);
			}
	
			//data.inst.open_node($(this));
	});

return str;

}


var deletenodelist=leafpath(node.id);



$('#roles > option').each(function() {
	if(deletenodelist.indexOf(this.text)!='-1')
	{
	 console.log(this.text + ' ' + this.value);
	this.remove();	
	}
});


 $('.modal').on('hidden.bs.modal', function(e)
{ 
     
    $('#modalContent').html('');
    location.reload();    
});

$(\"#role_select\").click(function(){



$.ajax({
  type: 'POST',
  async:false,	
  url: 'index.php?r=admin%2Frole%2Fsavetree',
  data: { data: JSON.stringify(deletenodelist) , newnode:$('#roles').val()  ,mode:'delete_tree'} 
})
  .done(function( msg ) {
console.log(msg);

  });



    $('#save_tree').click();	
	 		

   $('#modal').modal('toggle');

});

$('#modal').modal('show')
.find(\"#modalContent\")
.load();



	

} 
	  
	  
      return true; // allow everything else
                        }"),
    'items' => $coredata[0],
]) ?>
	<?= "</pre>"; ?>
	
	
	<?php

echo Html::button('Save Role Tree', [ 'class' => 'btn btn-primary', 'id'=>"save_tree" ]);
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
           // ['class' => 'yii\grid\ActionColumn',],


[
	'class' => 'yii\grid\ActionColumn',
	'template' => '{view} {update}',
	'buttons' => [
		'update' => function ($url,$model) {
			return Html::a(
				'<span class="glyphicon glyphicon-user"></span>', 
				$url,['data-pjax'=>"0"]);

		},
		'link' => function ($url,$model,$key) {
				return Html::a('Action', $url);
		},
	],
],

        ],
    ]);
    Pjax::end();
    ?>

</div>
