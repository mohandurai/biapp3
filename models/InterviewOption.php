<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "interview_option".
 *
 * @property string $id
 * @property string $role
 * @property string $name
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 * @property string $status
 */
class InterviewOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interview_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'modified_by', 'status'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['role', 'name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'name' => 'Candidate Name',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'status' => 'Status',
        ];
    }
     public function getCreatedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getModifiedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
    
public function beforeSave($insert)
           {
          if (parent::beforeSave($insert))
               {
            $common = $_REQUEST['InterviewOption'];
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
