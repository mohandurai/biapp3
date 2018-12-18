<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "related_lists".
 *
 * @property string $id
 * @property string $first_table
 * @property string $second_table
 * @property string $first_table_columns
 * @property string $second_table_coumns
 * @property string $query
 */
class RelatedLists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'related_lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['query','field_label','model_name'], 'required'],
          //  [['query'], 'string'],
	     [['display_columns','controller','model_name','query'], 'safe'],	
            [['first_table', 'second_table', 'first_table_key', 'second_table_key'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_table' => 'First Table',
            'second_table' => 'Second Table',
            'first_table_key' => 'First Table Key',
            'second_table_key' => 'Second Table Key',
            'query' => 'Query',
        ];
    }
}
