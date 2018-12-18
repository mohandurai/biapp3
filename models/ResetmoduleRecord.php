<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resetmodule_record".
 *
 * @property string $resetmodule_id
 * @property string $related_question_id
 * @property string $mod_record_id
 * @property integer $emp_id
 * @property string $response
 * @property string $marks
 * @property string $comments
 * @property string $module
 * @property string $role
 * @property string $assigned_role
 * @property string $created_time
 * @property string $modified_time
 */
class ResetmoduleRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resetmodule_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['mod_record_id', 'emp_id', 'module', 'role', 'assigned_role'], 'required'],

         [['mod_record_id'], 'required'],

            [['emp_id', 'marks', 'module'], 'integer'],
            [['comments'], 'string'],
            [['created_time', 'modified_time'], 'safe'],
            [['related_question_id', 'mod_record_id', 'response'], 'string', 'max' => 45],
            [['role'], 'string', 'max' => 60],
            [['assigned_role'], 'string', 'max' => 100]
        ];
    }
public function getModulestabelname()
    {
        return $this->hasOne(Modules::className(), ['id' => 'module']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resetmodule_id' => 'Resetmodule ID',
            'related_question_id' => 'Related Question ID',
            'mod_record_id' => 'Mod Record ',
            'emp_id' => 'Emp ID',
            'response' => 'Response',
            'marks' => 'Marks',
            'comments' => 'Comments',
            'module' => 'Module',
            'role' => 'Role',
            'assigned_role' => 'Assigned Role',
            'created_time' => 'Created Time',
            'modified_time' => 'Modified Time',
        ];
    }
}