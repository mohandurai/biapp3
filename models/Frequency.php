<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frequency".
 *
 * @property integer $f_id
 * @property string $period
 * @property integer $status
 * @property string $created_date
 * @property string $created_by
 * @property string $modified_date
 * @property string $modified_by
 */
class Frequency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frequency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period'],'required'],
           // [['status'], 'integer'],
            [['status','created_date', 'modified_date'], 'safe'],
            [['period'], 'string', 'max' => 100],
            [['created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'f_id' => 'F ID',
            'period' => 'Period',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
        ];
    }
    public function getCreatedbyuser()
    {
    return $this->hasOne(user::className(),['id'=>'created_by']);
    } 
    
    public function getModifiedbyuser()
    {
        // return $this->Yii::$app->User, ['id' =>'modified_by'];      
        return $this->hasOne(User::className(), ['id' =>'modified_by']);      
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
                 $common = $_REQUEST['EligibilitySettingMaster'];
                 if($this->isNewRecord)
                 {
                     $this->status='ACTIVE';
                     $this->created_date=date('Y-m-d h:i:s');
                     $this->created_by=Yii::$app->user->id;
                     $this->modified_date=date('Y-m-d h:i:s');
                 }
                 else
                 {
                     $this->modified_date=date('Y-m-d h:i:s');
                     $this->modified_by=Yii::$app->user->id;
                 }
                return true;
        }
        else
        {
                 return false;  
        }
    }
}
