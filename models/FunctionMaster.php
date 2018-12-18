<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "function_master".
 *
 * @property string $function_id
 * @property string $function_code
 * @property string $function_name
 * @property string $company_id
 * @property integer $bunit_id
 * @property string $desc
 * @property string $created_date
 * @property string $modified_date
 * @property integer $created_by
 * @property integer $modified_by
 *
 * @property CompanyMaster $company
 * @property User $createdBy
 * @property User $modifiedBy
 */
class FunctionMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'function_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['function_code', 'function_name', 'company_id', 'bunit_id', 'desc', 'created_date', 'modified_date', 'created_by', 'modified_by'], 'required'],
            [['company_id', 'bunit_id', 'created_by', 'modified_by'], 'integer'],
            [['created_date', 'company_id','modified_date','function_parent'], 'safe'],
            [['function_code', 'function_name', 'desc'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'function_id' => 'Function ID',
            'function_code' => 'Function Code',
            'function_name' => 'Function Name',
            'company_id' => 'Parent Company',
            'bunit_id' => 'Parent Buinit',
            'desc' => 'Desc',
	    'function_parent'=>'Function Parent',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(CompanyMaster::className(), ['company_id' => 'company_id'])->from(CompanyMaster::tableName(). ' u2');
    }
public function getFun()
    {
        return $this->hasOne(FunctionMaster::className(), ['function_id' => 'function_parent']);
    }
 public function getBunit()
    {
        return $this->hasOne(BusinessUnitMaster::className(), ['bunit_id' => 'bunit_id'])->from(BusinessUnitMaster::tableName().' u3');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
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
}
