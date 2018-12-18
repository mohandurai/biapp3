<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property string $id
 * @property string $roles
 * @property string $filetype
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 */
class Profile extends \yii\db\ActiveRecord
{


    public $file;
   public $upload_image;
   public $sharingmode;
   public $position_type; 
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    

 
    public function rules()
    {
        return [
            //[['roles'], 'integer'],
             [['file'],'file','skipOnEmpty' => true,'checkExtensionByMimeType' => false,  'extensions' => 'gif,png,doc,jpeg,jpg,csv,pdf,avi,mp3,mp4,mpeg,xls,zip','maxFiles' => 10],
            [['upload_image'],'file','skipOnEmpty' => true,'checkExtensionByMimeType' => false,  'extensions' => 'gif,png,doc,jpeg,jpg,csv,pdf,avi,mp3,mp4,mpeg,xls,zip','maxFiles' => 10],
	    [['emp_id'], 'required'],
            [['created_date', 'modified_date','roles'], 'safe'],
            [['filetype', 'created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roles' => 'Roles',
            'filetype' => 'Content Type',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'file' => 'File',
            'emp_id'=>'Employees',
              
        ];
    }
     public function getFiletransfer()
    {
        return $this->hasOne(FileTransfer::className(), ['f_id' => 'filetype']);
    }

    public function getRole()
    {
        return $this->hasOne(Authitem::className(), ['name' => 'roles']);
    }
   
   public function getCreatedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getModifiedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
    public function getDocument()
    {
        return $this->hasOne(Documentsupload::className(),['modid' => 'id'])->onCondition('module="Profile"');
    }
    
public function beforeSave($insert)
           {
          if (parent::beforeSave($insert))
               {
            $common = $_REQUEST['Profile'];
            if ($this->isNewRecord)
            {
    
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



      

}
