<?php

namespace app\models;
use yii\helpers\ArrayHelper;

use Yii;


/**
 * This is the model class for table "empspeak".
 *
 * @property integer $empspkID
 * @property string $title
 * @property string $description
 * @property string $file_name
 * @property string $emp_id
 * @property string $created_date
 * @property string $modified_date
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $status
 */

class Authitem extends \yii\db\ActiveRecord
{

   public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','type','created_at'], 'required'],
            [['reports_to_role', 'updated_at'], 'integer'],
            [['description','rule_name','data'], 'string', 'max' => 50]
        ];
    }


    public static function getOptions()
    {
       //$data=  static::getsharing_access('')->all();
       $value= ArrayHelper::map(Authitem::find()->all(),'data','name');

       return $value;
    }

    /**
     * @inheritdoc
     */

}
