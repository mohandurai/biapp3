<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_template".
 *
 * @property integer $id
 * @property string $template_name
 * @property string $subject
 * @property string $body
 * @property string $attachments
 * @property string $created_date
 * @property integer $created_by
 * @property string $modified_date
 * @property integer $modified_by
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_name', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['template_name'],'unique'],
            [['created_date', 'modified_date'], 'safe'],
            [['created_by', 'modified_by'], 'integer'],
            [['template_name', 'subject', 'attachments'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_name' => 'Template Name',
            'subject' => 'Subject',
            'body' => 'Body',
            'attachments' => 'Attachments',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord)
         {
             
             $this->created_date=date('Y-m-d h:i:s');
              $this->modified_date=date('Y-m-d h:i:s');
             $this->created_by=Yii::$app->user->id;
         }
         else
         {
             $this->modified_date=date('Y-m-d h:i:s');
             $this->modified_by=Yii::$app->user->id;
         }
        return true;
    }
}
