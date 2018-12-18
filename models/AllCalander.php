<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "all_calander".
 *
 * @property integer $calander_id
 * @property integer $year
 * @property integer $quarter
 * @property string $quarter_name
 * @property string $month
 * @property string $month_name
 * @property string $week
 * @property string $week_name
 * @property string $day_name
 * @property string $date
 */
class AllCalander extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'all_calander';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'quarter', 'month', 'week', 'date'], 'required'],
            [['year', 'quarter'], 'integer'],
            [['date'], 'safe'],
            [['quarter_name', 'week_name', 'day_name'], 'string', 'max' => 45],
            [['month', 'week'], 'string', 'max' => 25],
            [['month_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'calander_id' => 'Calander ID',
            'year' => 'Year',
            'quarter' => 'Quarter',
            'quarter_name' => 'Quarter Name',
            'month' => 'Month',
            'month_name' => 'Month Name',
            'week' => 'Week',
            'week_name' => 'Week Name',
            'day_name' => 'Day Name',
            'date' => 'Date',
        ];
    }
}
