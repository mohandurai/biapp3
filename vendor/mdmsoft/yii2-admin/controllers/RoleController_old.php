<?php

namespace mdm\admin\controllers;



use mdm\admin\models\AuthItem;
use mdm\admin\models\searchs\AuthItem as AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\Item;
use Yii;
use mdm\admin\components\MenuHelper;
use yii\helpers\Html;
use yii\db\Query;
/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class RoleController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch(['type' => Item::TYPE_ROLE]);


        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param  string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $authManager = Yii::$app->getAuthManager();
        $avaliable = $assigned = [
            'Roles' => [],
            'Permission' => [],
            'Routes' => [],
        ];
        $children = array_keys($authManager->getChildren($id));
        $children[] = $id;
        foreach ($authManager->getRoles() as $name => $role) {
            if (in_array($name, $children)) {
                continue;
            }
            $avaliable['Roles'][$name] = $name;
        }
        foreach ($authManager->getPermissions() as $name => $role) {
            if (in_array($name, $children)) {
                continue;
            }
            $avaliable[$name[0] === '/' ? 'Routes' : 'Permission'][$name] = $name;
        }

        foreach ($authManager->getChildren($id) as $name => $child) {
            if ($child->type == Item::TYPE_ROLE) {
                $assigned['Roles'][$name] = $name;
            } else {
                $assigned[$name[0] === '/' ? 'Routes' : 'Permission'][$name] = $name;
            }
        }
        $avaliable = array_filter($avaliable);
        $assigned = array_filter($assigned);

        return $this->render('view', ['model' => $model, 'avaliable' => $avaliable, 'assigned' => $assigned]);
    }

    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem(null);
        $model->type = Item::TYPE_ROLE;
        
    
        
        
        if ($model->load(Yii::$app->getRequest()->post())&& $model->save() ) {
        
        $connection = \Yii::$app->db;	        	
	$command = $connection->createCommand("update auth_item set name = '".$_POST['AuthItem']['dealer']."_".$_POST['AuthItem']['name']."' where name = '".$_POST['AuthItem']['name']."'");
	$command->execute() ;
        
            MenuHelper::invalidate();         
            
            

            return $this->redirect(['view', 'id' => $_POST['AuthItem']['dealer']."_".$_POST['AuthItem']['name']]);
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }


 public function actionSavetree()
{

$connection = \Yii::$app->db;	

//print_r(json_decode($_REQUEST['flat']));




if($_POST['mode']=="delete_tree")
{


$_POST['data'] =str_replace("[","",$_POST['data']);


$_POST['data'] =str_replace("]","",$_POST['data']);



$command = $connection->createCommand("update auth_item set reports_to_role='".$_POST['newnode']."' where name in (".$_POST['data'].")");
$command->execute() ;



echo "delete from auth_item where name in (".$_POST['data'].")";
$command = $connection->createCommand("delete from auth_item where name in (".$_POST['data'].")");
$command->execute() ;



}



if($_POST['mode']=="update_node")
{
echo "update auth_item set name='".$_POST['newname']."' where name='".$_POST['oldname']."'";
$command = $connection->createCommand("update auth_item set name='".$_POST['newname']."' where name='".$_POST['oldname']."'");
$command->execute() ;
}

if($_POST['mode']=="save_tree")
{


			$command = $connection->createCommand("UPDATE role_structure SET role_structure='".$_POST['data']."' WHERE id=1");
			$command->execute();
			$roleflat=json_decode($_POST['rolelist']);


			for($i=0; $i < sizeof($roleflat);$i++)
			{



			$command = $connection->createCommand(
					"insert into  auth_item(name,type,reports_to_role,root_path, leaf_path,leaf_html)
			VALUES ('".$roleflat[$i]->rolename."',1,'".$roleflat[$i]->parent."','".$roleflat[$i]->rootpath."','".$roleflat[$i]->leafpath."','".$roleflat[$i]->leafhtml."') 
			ON DUPLICATE KEY
				UPDATE reports_to_role='".$roleflat[$i]->parent."',root_path='".$roleflat[$i]->rootpath."',leaf_path='".$roleflat[$i]->leafpath."',leaf_html='".$roleflat[$i]->leafhtml."'");

				

				
			$command->execute() ;




			}
}


/*
$connection->createCommand()
	->insert('role_structure', [
			'role_structure' => $_POST['data'],
			])
	->execute();*/
}

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
            MenuHelper::invalidate();

            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param  string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Yii::$app->getAuthManager()->remove($model->item);
        MenuHelper::invalidate();

        return $this->redirect(['index']);
    }

    /**
     * Assign or remove items
     * @param string $id
     * @param string $action
     * @return array
     */
    public function actionAssign($id, $action)
    {
        $post = Yii::$app->getRequest()->post();
        $roles = $post['roles'];
        $manager = Yii::$app->getAuthManager();
        $parent = $manager->getRole($id);
        $error = [];
        if ($action == 'assign') {
            foreach ($roles as $role) {
                $child = $manager->getRole($role);
                $child = $child ? : $manager->getPermission($role);
                try {
                    $manager->addChild($parent, $child);
                } catch (\Exception $e) {
                    $error[] = $e->getMessage();
                }
            }
        } else {
            foreach ($roles as $role) {
                $child = $manager->getRole($role);
                $child = $child ? : $manager->getPermission($role);
                try {
                    $manager->removeChild($parent, $child);
                } catch (\Exception $e) {
                    $error[] = $e->getMessage();
                }
            }
        }
        MenuHelper::invalidate();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [$this->actionRoleSearch($id, 'avaliable', $post['search_av']),
            $this->actionRoleSearch($id, 'assigned', $post['search_asgn']),
            $error];
    }

    /**
     * Search role
     * @param string $id
     * @param string $target
     * @param string $term
     * @return array
     */
    public function actionRoleSearch($id, $target, $term = '')
    {
        $result = [
            'Roles' => [],
            'Permission' => [],
            'Routes' => [],
        ];
        $authManager = Yii::$app->authManager;
        if ($target == 'avaliable') {
            $children = array_keys($authManager->getChildren($id));
            $children[] = $id;
            foreach ($authManager->getRoles() as $name => $role) {
                if (in_array($name, $children)) {
                    continue;
                }
                if (empty($term) or strpos($name, $term) !== false) {
                    $result['Roles'][$name] = $name;
                }
            }
            foreach ($authManager->getPermissions() as $name => $role) {
                if (in_array($name, $children)) {
                    continue;
                }
                if (empty($term) or strpos($name, $term) !== false) {
                    $result[$name[0] === '/' ? 'Routes' : 'Permission'][$name] = $name;
                }
            }
        } else {
            foreach ($authManager->getChildren($id) as $name => $child) {
                if (empty($term) or strpos($name, $term) !== false) {
                    if ($child->type == Item::TYPE_ROLE) {
                        $result['Roles'][$name] = $name;
                    } else {
                        $result[$name[0] === '/' ? 'Routes' : 'Permission'][$name] = $name;
                    }
                }
            }
        }

        return Html::renderSelectOptions('', array_filter($result));
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  string        $id
     * @return AuthItem      the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $item = Yii::$app->getAuthManager()->getRole($id);
        if ($item) {
            return new AuthItem($item);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}