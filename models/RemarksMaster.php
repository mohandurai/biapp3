<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remarks_master".
 *
 * @property string $id
 * @property string $remark_name
 * @property string $created_date
 * @property string $created_by
 * @property string $modified_date
 * @property string $modified_by
 */
class RemarksMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'remarks_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['remark_name', 'created_date', 'created_by', 'modified_date', 'modified_by'], 'required'],
            [['created_date', 'modified_date'], 'safe'],
            [['remark_name', 'created_by', 'modified_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'remark_name' => 'Remark Name',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
        ];
    }
}
