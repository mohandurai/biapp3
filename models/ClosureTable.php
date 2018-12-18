<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "closure_table".
 *
 * @property string $id
 * @property integer $uid
 * @property integer $rid
 *
 * @property User $u
 */
class ClosureTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'closure_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'rid'], 'required'],
            [['uid', 'rid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'rid' => 'Rid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
	public function getLeads()
    {
        return $this->hasMany(Lead::className(), ['assignedto' => 'uid']);
    }
}
