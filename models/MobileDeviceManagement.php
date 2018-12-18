<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mobile_device_management".
 *
 * @property string $id
 * @property string $user_id
 * @property string $username
 * @property string $device_key
 * @property string $status
 * @property string $created_by
 * @property string $created_date
 * @property string $modified_by
 * @property string $modified_date
 * @property string $imei_no
 * @property string $delivered_status
 */
class MobileDeviceManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mobile_device_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'device_key', 'status', 'created_by', 'created_date', 'modified_by', 'modified_date', 'imei_no', 'delivered_status'], 'required'],
            [['user_id', 'delivered_status'], 'integer'],
            [['device_key'], 'string'],
            [['created_date', 'modified_date'], 'safe'],
            [['username', 'status', 'created_by', 'modified_by', 'imei_no'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'device_key' => 'Device Key',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'modified_by' => 'Modified By',
            'modified_date' => 'Modified Date',
            'imei_no' => 'Imei No',
            'delivered_status' => 'Delivered Status',
        ];
    }
}
