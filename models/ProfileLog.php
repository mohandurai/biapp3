<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_log".
 *
 * @property integer $id
 * @property string $json_query
 * @property integer $userid
 * @property string $status
 * @property string $created_date
 * @property string $modified_date
 */
class ProfileLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $profilename;
    public $view;
    public static function tableName()
    {
        return 'profile_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['json_query'], 'required'],
            [['json_query','category'], 'string'],
            [['userid'], 'integer'],
            [['status', 'created_date', 'modified_date'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'json_query' => 'Json Query',
            'userid' => 'UserName',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
            'category'=>'Category',
        ];
    }
     public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'userid']);
    }
     public function getCategorym()
    {
        return $this->hasOne(CategoryMaster::className(),['id' => 'category']);
    }


}
