<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bi_menus".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_id
 * @property string $remarks
 * @property integer $active
 * @property integer $level
 */
class BiMenus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bi_menus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'parent_id', 'remarks', 'level'], 'required'],
            [['parent_id', 'active', 'level','category'], 'integer'],
            [['remarks'], 'string'],
            [['title'], 'string', 'max' => 250],
        ];
    }
public function getParent()
    {
        return $this->hasOne(BiMenus::className(), ['id' => 'parent_id']);
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'parent_id' => 'Parent ID',
            'remarks' => 'Remarks',
            'active' => 'Active',
            'level' => 'Level',
        ];
    }
}
