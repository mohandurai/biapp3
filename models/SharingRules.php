<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sharing_rules".
 *
 * @property string $id
 * @property string $module
 * @property string $sharing_access
 */
class SharingRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sharing_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['module', 'sharing_access'], 'required'],

	    [['module'],'unique'],
            [['module', 'sharing_access'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'sharing_access' => 'Sharing Access',
        ];
    }
}
