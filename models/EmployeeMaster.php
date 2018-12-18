<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_master".
 *
 * @property integer $emp_id
 * @property string $emp_code
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $reports_to
 * @property string $mobile_no
 * @property string $email_address
 * @property string $password
 * @property string $date_of_birth
 * @property string $qualification
 * @property integer $status
 * @property string $created_date
 * @property string $created_by
 * @property string $modified_date
 * @property string $modified_by
 * @property integer $c_id
 * @property integer $zone_id
 * @property integer $s_id
 * @property integer $city_id
 * @property integer $area_id
 * @property integer $tertiary_id
 * @property integer $dealership_id
 * @property integer $role_id
 * @property string $competency
 * @property string $subcompetency
 * @property integer $department_id
 * @property string $device_key
 * @property string $imei
 * @property string $version
 * @property integer $group_id
 * @property integer $supervisor_id
 * @property integer $mentor_id
 * @property string $profile_image_url
 * @property integer $supervisor
 * @property integer $trainer
 * @property integer $reports_to_role
 * @property string $user_name
 */
class EmployeeMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'c_id', 'zone_id', 's_id', 'city_id', 'area_id', 'tertiary_id', 'dealership_id', 'role_id', 'department_id', 'group_id', 'supervisor_id', 'mentor_id', 'supervisor', 'trainer', 'reports_to_role'], 'integer'],
            [['created_date', 'modified_date'], 'safe'],
            [['c_id', 'zone_id', 's_id', 'city_id', 'area_id', 'tertiary_id', 'dealership_id', 'role_id', 'department_id', 'supervisor_id', 'mentor_id', 'reports_to_role', 'user_name'], 'required'],
            [['emp_code', 'first_name', 'middle_name', 'last_name', 'reports_to', 'email_address', 'qualification', 'created_by', 'modified_by', 'version'], 'string', 'max' => 45],
            [['mobile_no'], 'string', 'max' => 15],
            [['password', 'profile_image_url', 'user_name'], 'string', 'max' => 200],
            [['date_of_birth'], 'string', 'max' => 25],
            [['competency', 'subcompetency'], 'string', 'max' => 55],
            [['device_key', 'imei'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'emp_code' => 'Emp Code',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'reports_to' => 'Reports To',
            'mobile_no' => 'Mobile No',
            'email_address' => 'Email Address',
            'password' => 'Password',
            'date_of_birth' => 'Date Of Birth',
            'qualification' => 'Qualification',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
            'c_id' => 'C ID',
            'zone_id' => 'Zone ID',
            's_id' => 'S ID',
            'city_id' => 'City ID',
            'area_id' => 'Area ID',
            'tertiary_id' => 'Tertiary ID',
            'dealership_id' => 'Dealership ID',
            'role_id' => 'Role ID',
            'competency' => 'Competency',
            'subcompetency' => 'Subcompetency',
            'department_id' => 'Department ID',
            'device_key' => 'Device Key',
            'imei' => 'Imei',
            'version' => 'Version',
            'group_id' => 'Group ID',
            'supervisor_id' => 'Supervisor ID',
            'mentor_id' => 'Mentor ID',
            'profile_image_url' => 'Profile Image Url',
            'supervisor' => 'Supervisor',
            'trainer' => 'Trainer',
            'reports_to_role' => 'Reports To Role',
            'user_name' => 'User Name',
        ];
    }
}
