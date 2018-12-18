<?php

namespace app\models;

use Yii;
use yii\web\ForbiddenHttpException;
use yii\rbac\SharingRules;
/**
 * This is the model class for table "user_group_master".
 *
 * @property integer $group_id
 * @property string $title
 * @property string $description
 * @property string $group_code
 * @property string $modified_date
 * @property integer $modified_by
 * @property string $created_date
 * @property integer $created_by
 * @property string $status
 */
class UserGroupMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
       public $users;
    public static function tableName()
    {
        return 'user_group_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'modified_by', 'created_by', 'status'], 'required'],
            [['modified_date', 'created_date','assigned_role'], 'safe'],
            [['modified_by', 'created_by'], 'integer'],
            [['title', 'description', 'group_code'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
           {
                
                
                    
            if (parent::beforeSave($insert))
               {
                    $common = $_REQUEST['Crt'];
                        if ($this->isNewRecord)
                        {
                            $this->status='New';
                            $this->created_date =  date('Y-m-d h:i:s');
                            $this->created_by = Yii::$app->user->id;               
                        }
                        else
                        {
                        
                                $this->modified_date =  date('Y-m-d h:i:s');
                            $this->modified_by = Yii::$app->user->id;
                        }
                        
               
                          
                        return true; 
                        //return parent::beforeSave();

               }
              else 
                  {
        return false;
                 }
                 
       }

 public function getCreatedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
public function getFiletransfername()
    {
        return $this->hasOne(FileTransfer::className(), ['f_id' => 'file_type']);
    }
    public function getModifiedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'title' => 'Title',
            'description' => 'Description',
            'group_code' => 'Group Code',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'status' => 'Status',
            'role' => 'Select',
            'assigned_role' => 'Selected',
        ];
    }
}
