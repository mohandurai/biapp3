<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country_master".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 * @property string $status
 */
class CountryMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'country_name'], 'required'],
            [['id'], 'integer'],
            [['created_date', 'country_code', 'country_name', 'created_by', 'modified_by', 'status'], 'safe'],
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            
            'status' => 'Status',
        ];
    }
 
}
