<?php


namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;


/**
 * This is the model class for table "company_master".
 *
 * @property string $company_id
 * @property string $company_code
 * @property string $company_desc
 * @property string $company_parent
 * @property string $created_date
 * @property string $modified_date
 * @property integer $created_by
 * @property integer $modified_by
 *
 * @property User $modifiedBy
 * @property User $createdBy
 */
class CompanyMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_code', 'company_desc',  'created_date', 'modified_date', 'created_by', 'modified_by'], 'required'],
            [['created_date', 'company_parent','company_name','modified_date'], 'safe'],
            [['created_by', 'modified_by'], 'integer'],
            [['company_code', 'company_desc'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_code' => 'Company Code',
            'company_desc' => 'Company Desc',
            'company_parent' => 'Company Parent',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    
	

    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


	public function getCompany()
    {

        return $this->hasOne(CompanyMaster::className(), ['company_id' => 'company_parent']) ->from(CompanyMaster::tableName() . ' u2');
    }





    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
	 public function getCom()
    {
        return $this->hasOne(CompanyMaster::className(), ['company_id' => 'company_parent']);
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


 public function afterSave($insert, $changedAttributes)
    {

			$connection = \Yii::$app->db;
			$id=$this->company_id;
			$emp_code='CMP'.$id;
			$sql='update company_master set company_code=:company_code where company_id=:company_id';
			$command=$connection->createCommand($sql);
			$command->bindParam(":company_code",$emp_code);
			$command->bindParam(":company_id",$id);
			$command->execute();   

  parent::afterSave($insert, $changedAttributes);
  }


}
