<?php

namespace app\models;

use yii\helpers\ArrayHelper;

use yii\helpers\Url;
use Yii;



 




/**
 * This is the model class for table "oac_joborder".
 *
 * @property integer $Job_id
 * @property string $Jobtitle
 * @property string $Department
 * @property string $Designation
 * @property string $Dealership
 * @property string $LastDateApplication
 * @property string $Location
 * @property string $Experiencemin
 * @property string $Experiencemax
 * @property string $Desirededucation
 * @property string $Description
 * @property string $Status
 * @property string $Status1
 * @property string $Status2
 * @property string $gapcount
 * @property string $created_date
 */
class OacJoborder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oac_joborder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jobtitle', 'Department', 'Designation', 'Dealership', 'LastDateApplication', 'Location', 'Experiencemin', 'Experiencemax', 'Desirededucation', 'Description', 'gapcount'], 'required'],
            [['Description'], 'string'],
            [['created_date'], 'safe'],
            [['Jobtitle', 'Desirededucation'], 'string', 'max' => 55],
            [['Department', 'Designation', 'Dealership', 'Experiencemin', 'Experiencemax', 'gapcount'], 'string', 'max' => 15],
            [['LastDateApplication', 'Location'], 'string', 'max' => 45]
        ];
    }
public function getDealername1()
    {
    return $this->hasOne(DealershipMaster::className(), ['dealership_id' => 'Dealership']);
    }

     public function getDesignation1()
    {
    return $this->hasOne(AudiNeevDesignation::className(), ['id' => 'Jobtitle']);
    }
 public function getDesignation2()
    {
    return $this->hasOne(DesignationMaster::className(), ['designation_id' => 'Designation']);
    }


    public function getDepartment1()
    {
    return $this->hasOne(DepartmentMaster::className(), ['department_id' => 'Department']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Job_id' => 'Job ID',
            'Jobtitle' => 'Job Title',
            'Department' => 'Department',
            'Designation' => 'Designation',
         
 'Dealership' => 'Dealership',
            'LastDateApplication' => 'Last Date Application',
            'Location' => 'Location',
            'Experiencemin' => 'Experience min',
            'Experiencemax' => 'Experience max',
            'Desirededucation' => 'Desired Education',
            'Description' => 'Description',
            'Status' => 'Status',
            'Status1' => 'Status1',
            'Status2' => 'Status2',
            'gapcount' => 'Gapcount',
            'created_date' => 'Created Date',
        ];
    }
}
