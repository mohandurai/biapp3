<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "sub_competency_master".
 *
 * @property integer $subcompetency_id
 * @property string $subcompetency_code
 * @property string $subcompetency_name
 * @property string $sub_competency_description
 * @property integer $status
 * @property string $created_date
 * @property integer $created_by
 * @property string $modified_date
 * @property integer $modified_by
 * @property integer $bunit_id
 */
class SubCompetencyMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_competency_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'subcompetency_name'], 'required'],
            [['sub_competency_description'], 'string'],
            [['status', 'created_by', 'modified_by', 'bunit_id'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['subcompetency_code'], 'string', 'max' => 45],
            [['subcompetency_name'], 'string', 'max' => 155]
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
    
     public function getBunituser()
    {
          return $this->hasOne(BusinessUnitMaster::className(), ['bunit_id' =>'bunit_id']);      
    }

  public static function getOptions()
    {
       //$data=  static::getsharing_access('')->all();
	    // 'data'=>ArrayHelper::map(SubCompetencyMaster::find()->all(),'subcompetency_id','subcompetency_name'),
       $value= ArrayHelper::map(SubCompetencyMaster::find()->all(),'subcompetency_id','subcompetency_name');
	  // echo '<pre>';
//print_r( $value);

       return $value;
    }

	
	 public function beforeSave($insert)
           {
	 	  if (parent::beforeSave($insert))
	           {
		    $common = $_REQUEST['SubCompetencyMaster'];
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
	
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subcompetency_id' => 'Subcompetency ID',
            'subcompetency_code' => 'Subcompetency Code',
            'subcompetency_name' => 'Subcompetency Name',
            'sub_competency_description' => 'Sub Competency Description',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
             'bunit_id' => 'Business Unit',
        ];
    }
}
