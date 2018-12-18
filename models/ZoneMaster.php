<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zone_master".
 *
 * @property integer $id
 * @property string $zone_name
 * @property string $created_date
 * @property string $modified_date
 * @property integer $created_by
 * @property integer $modified_by
 */
class ZoneMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zone_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_name'], 'required'],
            [['created_date', 'modified_date', 'created_by', 'modified_by'], 'safe'],
            [['created_by', 'modified_by'], 'integer'],
            [['zone_name','zone_code'], 'string', 'max' => 65]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zone_name' => 'Zone Name',
'zone_code'=>'Zone Code',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
        ];
    }
}
