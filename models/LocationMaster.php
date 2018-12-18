<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location_master".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $lat
 * @property string $lng
 */
class LocationMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'lat', 'lng'], 'required'],
            [['name'], 'string', 'max' => 250],
            [['code'], 'string', 'max' => 3],
            [['lat', 'lng'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'lat' => 'Latitude',
            'lng' => 'Longitude',
        ];
    }
}
