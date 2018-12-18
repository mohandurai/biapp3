<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department_master".
 *
 * @property integer $department_id
 * @property string $department_code
 * @property string $department_name
 * @property string $created_date
 * @property string $created_by
 * @property string $modified_date
 * @property string $modified_by
 */
class DepartmentMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_date', 'modified_date'], 'safe'],
            [['department_code', 'department_name', 'created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_code' => 'Department Code',
            'department_name' => 'Department Name',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
        ];
    }
}
