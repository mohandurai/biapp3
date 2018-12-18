<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "geography_master".
 *
 * @property string $geo_id
 * @property string $country_code
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $area
 * @property string $territory
 * @property string $pincode
 * @property string $continental
 * @property string $bunit_id
 */
class GeographyMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geography_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'country', 'state', 'city', 'area', 'territory', 'pincode', 'continental', 'bunit_id','zone'], 'required'],
            [['bunit_id','country', 'state', 'city'], 'integer'],
            [['country_code',  'area', 'territory', 'pincode', 'continental' ,'created_date','modified_date', 'created_by', 'modified_by','village'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'geo_id' => 'Geo ID',
            'country_code' => 'Country Code',
            'country' => 'Country',
            'state' => 'State',
            'city' => 'City',
            'area' => 'District',
            'territory' => 'Town',
            'pincode' => 'Pincode',
            'continental' => 'Continet',
            'bunit_id' => 'Bunit ID',
		' village'=>'Village',
'zone'=>'Zone',
        ];
    }
	 public function getCreatedby()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
 public function getCity1()
    {
        return $this->hasOne(CityMaster::className(), ['city_id' => 'city']);
    }
 public function getState1()
    {
        return $this->hasOne(StateMaster::className(), ['s_id' => 'state']);
    }
public function getCountry1()
    {
        return $this->hasOne(CountryMaster::className(), ['id' => 'country']);
    }
    public function getModifiedby()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
	public function beforeSave($insert)
           {
	 	  if (parent::beforeSave($insert))
	           {
		    $common = $_REQUEST['BusinessUnitMaster'];
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
