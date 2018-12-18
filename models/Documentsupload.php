<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentsupload".
 *
 * @property integer $id
 * @property string $module
 * @property string $filepath
 * @property string $filename
 * @property integer $modid
 * @property string $mime_type
 */
class Documentsupload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documentsupload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['modid'], 'integer'],
            //[['mime_type'], 'required'],
            [['module'], 'string', 'max' => 50],
            [['filepath'], 'string', 'max' => 255],
            [['filename'], 'string', 'max' => 100],
            [['mime_type'], 'string', 'max' => 45]
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
            'filepath' => 'Filepath',
            'filename' => 'Filename',
            'modid' => 'Modid',
            'mime_type' => 'Mime Type',
        ];
    }
}
