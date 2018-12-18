<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_master".
 *
 * @property integer $city_id
 * @property string $city_name
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 * @property integer $s_id
 * @property string $postal_code
 */
class CityMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_name', 'postal_code'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['s_id'], 'integer'],
            [['city_name', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['postal_code'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'city_name' => 'City Name',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            's_id' => 'S ID',
            'postal_code' => 'Postal Code',
        ];
    }
}
