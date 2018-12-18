<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "file_transfer".
 *
 * @property integer $f_id
 * @property string $f_code
 * @property string $f_name
 * @property string $f_description
 * @property string $created_date
 * @property integer $created_by
 * @property string $modified_date
 * @property integer $modified_by
 */
class FileTransfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_transfer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['f_code', 'f_name', 'f_description', 'created_by', 'modified_by'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['created_by', 'modified_by'], 'integer'],
            [['f_code'], 'string', 'max' => 100],
            [['f_name'], 'string', 'max' => 30],
            [['f_description'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'f_id' => 'Content ID',
            'f_code' => 'Content Code',
            'f_name' => 'Content Name',
            'f_description' => 'Content Description',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
        ];
    }
    
    public function getSurveytype()
	{
	  return $this->hasMany(ContentMaster::className(), ['content_type' => 'f_id']);
	}    
        public function getNuggetstype1()
    {
      return $this->hasMany(ContentMaster::className(), ['content_id' => 'f_id']);
    }
 
 public function getNuggetstype()
	{
	  return $this->hasMany(ContentMaster::className(), ['content_type' => 'f_id']);
	}      
    
    public function beforeSave($insert)
    {
  //  $this->emp_id = \Yii::$app->user->identity->id;
    $this->created_by = \Yii::$app->user->identity->id;
    $this->modified_by = \Yii::$app->user->identity->id;
    $this->created_date = date('Y-m-d H:i:s');
    $this->modified_date = date('Y-m-d H:i:s');


      if (parent::beforeSave($insert)) {

        if(array_key_exists($this->created_by,ArrayHelper::map(User::getsharing_access('')->all(),'id','username')))
        {
            return true;
        }
        else
        {
            throw new ForbiddenHttpException('Created By Field is having incorrect value');
            return false;
        }

      } else {
            return false;
      }
    }
public function getCreatedby()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getModifiedby()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
}
