<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state_master".
 *
 * @property integer $s_id
 * @property string $state_code
 * @property string $state_name
 * @property integer $c_id
 * @property integer $zone_id
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 */
class StateMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_name', 'state_code'], 'required'],
            [['c_id', 'zone_id'], 'integer'],
            [['created_date', 'modified_date','state_code', 'state_name', 'created_by', 'modified_by'], 'safe'],
           // [['state_code', 'state_name', 'created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            's_id' => 'S ID',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
            'c_id' => 'C ID',
            'zone_id' => 'Zone ID',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
        ];
    }
}
