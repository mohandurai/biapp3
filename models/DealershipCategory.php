<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dealership_category".
 *
 * @property integer $category_id
 * @property string $Category_name
 */
class DealershipCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealership_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
        ];
    }
    public function getCreatedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getModifiedbyuser()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }
}
