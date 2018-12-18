<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_process".
 *
 * @property integer $r_id
 * @property integer $role_id
 * @property integer $process_id
 * @property string $status
 * @property integer $bunit
 */
class RoleProcess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id','process_id', 'status'], 'required'],
            [['process_id', 'bunit'], 'integer'],
            [['status'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */

public function getCreatedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getModifiedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
   public function getBunitname()
    {
          return $this->hasOne(BusinessUnitMaster::className(), ['bunit_id' =>'bunit']);      
    }
 public function getRoleuser()
			{
				return $this->hasOne(Authitem::className(), ['type' => 'role_id']);
			}
					
			public function getRoleNames()
			{
				$getprocess_id=$this->role_id;
				echo 	$mod_sql = "SELECT name  FROM auth_item where type='".$getprocess_id."'";

				
						$mod_connection = Yii::$app->db;
				$mod_command = $mod_connection->createCommand($mod_sql);
				$role_id_results = $mod_command->queryAll(); 
				return $role_id_results ;
			}
			
			public function getCompNames()
    {
		
      	$getprocess_id=$this->process_id;

     	$mod_sql = "SELECT process_name as name FROM process_master where
		process_id in (".$getprocess_id.")";
        //echo $mod_sql;
        //exit;
				$mod_connection = Yii::$app->db;
				$mod_command = $mod_connection->createCommand($mod_sql);
				$process_id_results = $mod_command->queryAll(); 
			 	
                $snames = "";
            foreach($process_id_results as $aaaa)
            {
                $snames .= $aaaa['name'] . ", ";
            }
            
            //echo $snames;
            //exit;
			return 	substr($snames,0,-2);

   }
			
			
			
			
			
			
			
		
 public function beforeSave($insert)
      {
	
		  if(is_array($this->process_id))
		  {
			  $test =   $this->process_id=implode(",",$this->process_id);
		  }
		return true;
     }  
    public function attributeLabels()
    {
        return [
            'r_id' => 'R ID',
            'role_id' => 'Role ID',
            'process_id' => 'Process ID',
            'status' => 'Status',
            'bunit' => 'Bunit',
        ];
    }
}
