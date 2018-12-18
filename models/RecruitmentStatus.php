<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oac_jobapplicant".
 *
 * @property integer $Ja_id
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $mobileno
 * @property string $DateofBirth
 * @property string $Gender
 * @property string $LanguageCode
 * @property string $JobID
 * @property string $PartnerIDs
 * @property string $City
 * @property string $State
 * @property string $PostalCode
 * @property string $Country
 * @property string $CoverLetter
 * @property string $Conertempname
 * @property string $Resume
 * @property string $Resumetempname
 * @property string $status
 * @property string $status1
 * @property integer $oacdesignation_id
 * @property string $oacstatus
 * @property string $status2
 * @property string $score
 * @property string $address
 * @property string $Street
 * @property string $update_at
 * @property string $phone_number
 * @property string $createddatetime
 * @property string $date_of_joining
 */
class RecruitmentStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oac_jobapplicant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_of_joining'], 'required'],
            [['oacdesignation_id'], 'integer'],
            [['address', 'Street'], 'string'],
            [['update_at'], 'safe'],
            [['FirstName', 'LastName', 'Email', 'DateofBirth', 'LanguageCode', 'City', 'State', 'PostalCode', 'CoverLetter', 'Conertempname', 'Resume', 'Resumetempname', 'status', 'status1', 'oacstatus', 'status2', 'score', 'createddatetime', 'date_of_joining'], 'string', 'max' => 55],
            [['mobileno', 'Gender', 'JobID', 'Country'], 'string', 'max' => 15],
            [['PartnerIDs'], 'string', 'max' => 85],
            [['phone_number'], 'string', 'max' => 12]
        ];
    }



//LanguageCode
    public function getLanguageCode()
    {
    return $this->hasOne(OacLanguage::className(), ['id' => 'LanguageCode']);
    }
    public function getDealername1()
    {
    return $this->hasOne(DealershipMaster::className(), ['dealership_id' => 'PartnerIDs']);
    }

     public function getDesignation1()
    {
    return $this->hasOne(DesignationMaster::className(), ['designation_id' => 'JobID']);
    }

    public function getDepartment1()
    {
    return $this->hasOne(DepartmentMaster::className(), ['department_id' => 'department']);
    }
    public function getOacdesignation()
    {
    return $this->hasOne(AudiNeevDesignation::className(), ['id' => 'oacdesignation_id']);
    }







    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Ja_id' => 'Ja ID',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Email' => 'Email',
            'mobileno' => 'Mobileno',
            'DateofBirth' => 'Dateof Birth',
            'Gender' => 'Gender',
            'LanguageCode' => 'Language Code',
            'JobID' => 'Job ID',
            'PartnerIDs' => 'Partner Ids',
            'City' => 'City',
            'State' => 'State',
            'PostalCode' => 'Postal Code',
            'Country' => 'Country',
            'CoverLetter' => 'Cover Letter',
            'Conertempname' => 'Conertempname',
            'Resume' => 'Resume',
            'Resumetempname' => 'Resumetempname',
            'status' => 'Status',
            'status1' => 'Status1',
            'oacdesignation_id' => 'Oacdesignation ID',
            'oacstatus' => 'Oacstatus',
            'status2' => 'Status2',
            'score' => 'Score',
            'address' => 'Address',
            'Street' => 'Street',
            'update_at' => 'Update At',
            'phone_number' => 'Phone Number',
            'createddatetime' => 'Createddatetime',
            'date_of_joining' => 'Date Of Joining',
        ];
    }
}
