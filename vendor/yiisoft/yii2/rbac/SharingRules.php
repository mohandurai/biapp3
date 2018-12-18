<?php

namespace yii\rbac;

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//use  app\models\User;
//use  app\models\Leads;
/**
 * This is the model class for table "sharing_rules".
 *
 * @property string $id
 * @property string $module
 * @property string $sharing_access
 */
class SharingRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sharing_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'sharing_access'], 'required'],
            [['module', 'sharing_access'], 'string', 'max' => 45]
        ];
    }

function __autoload($className)
{
    require_once 'myclasses/'.$className.'.php';
}

    static function getsharingrules($modulename)
	{
	return SharingRules::find()->where(['module'=>$modulename])->one();
	}
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'sharing_access' => 'Sharing Access',
        ];
    }
   
	static function getsharing_access($modname)
	{
			
	
		switch(self::getsharingrules($modname)->sharing_access)
		{
		case "PrivateEX":
			if(is_object($modname))
			{
	 
	
				foreach ($modname::relatedmodules() as $obj=>$var)
				{
				$query_obj->joinWith($var);
				}
			$query_obj->joinWith('closure_table');
			$query_obj->andWhere(['rid' => Yii::$app->user->identity->id]);
			}
			else
			{
 			$modname="\app\models\\". $modname;


//$query=call_user_func(array('SharingRules', '::find'));


			$query= $modname::find();   

		    
				foreach ($modname::relatedmodules() as $obj=>$var)
				{
				$query->joinWith($var);
				}
			$query->joinWith('closure_table');
			$query->andWhere(['rid' => Yii::$app->user->identity->id]);

			return $query;
		//return Leads::getclosure_leads();
			}
		break;


		case "Public":
			if(is_object($modname))
			{
			//$query_obj->joinWith('closure_table');
			//$query_obj->where(['rid' => Yii::$app->user->identity->id]);
			}
			else
			{
			$modname="\app\models\\". $modname;
			return $modname::find();
			}
		break;
	
	
		}
	}




}
