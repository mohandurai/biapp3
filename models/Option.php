<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "option".
 *
 * @property string $option_id
 * @property string $option
 */
class Option extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option'], 'required'],
            [['option'], 'string', 'max' => 999]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => 'Option ID',
            'option' => 'Option',
        ];
    }
}
