<?php

namespace app\models;

use Yii;

use \app\models\ExitInterviewSheet;

/**
 * This is the model class for table "exit_interview_sheet".
 *
 * @property integer $id
 * @property string $job_holder_name
 * @property string $job_title
 * @property string $department
 * @property string $position_type
 * @property string $reporting_manager
 * @property string $date_of_joining
 * @property string $date_of_leaving
 * @property integer $higher_education
 * @property integer $better_job_opportunites
 * @property integer $personal_family_commitments
 * @property integer $relocation
 * @property integer $starting_own_business
 * @property integer $conflit_with_peers
 * @property integer $career_changes
 * @property integer $health_reason
 * @property integer $management_decision
 * @property integer $lack_of_role_clarity_conflicty
 * @property integer $no_motivation_challenge_learning
 * @property integer $style_of_boss
 * @property integer $role_stress
 * @property integer $pay_package_low
 * @property integer $lake_of_indepedance
 * @property integer $low_growth_salaries
 * @property integer $no_career_path
 * @property integer $other
 * @property integer $manager_decision_quit
 * @property integer $help_stay_organization
 * @property string $adout_discussion
 * @property string $experience_organization
 * @property string $our_company
 * @property string $people
 * @property string $work
 * @property string $work_environment
 * @property string $career
 * @property string $engagement
 * @property string $performance_rewards
 * @property integer $working_future
 * @property integer $recommend_friends
 * @property string $signature_emp
 * @property string $signature_hr
 * @property string $jobholder_name
 * @property string $hr_name
 * @property string $hr_feedback
 */
class Feedback extends ExitInterviewSheet
{



    /**
     * @inheritdoc
     */
  
    /**
     * @inheritdoc
     */
     public function rules()
    {
        return [
           [['jobholder_name','job_holder_name', 'job_title', 'reporting_manager'], 'required'],
           [['working_future','recommend_friends'], 'integer'],
           
            [['job_title', 'department', 'position_type', 'reporting_manager'], 'string', 'max' => 65],
            [['our_company', 'people', 'work_environment', 'career', 'engagement', 'performance_rewards', 'signature_emp', 'signature_hr', 'jobholder_name', 'hr_name', 'hr_feedback'], 'string', 'max' => 100],
            [['work'], 'string', 'max' => 45],
            [['job_holder_name'], 'validateCheck'],
            [['job_title'], 'validateHr'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'our_company' => 'Our Company',
            'people' => 'People',
            'work' => 'Work',
            'work_environment' => 'Work Environment',
            'career' => 'Career',
            'engagement' => 'Engagement',
            'performance_rewards' => 'Performance Rewards',
            'working_future' => 'Working Future',
            'recommend_friends' => 'Recommend Friends',
            'signature_emp' => 'Signature Emp',
            'signature_hr' => 'Signature Hr',
            'jobholder_name' => 'Jobholder Name',
            'hr_name' => 'Hr Name',
            'hr_feedback' => 'Hr Feedback',
        ];
    }
 public function validateCheck($attribute, $params)
    {
        if(!isset($this->our_company) || $this->our_company == '' || $this->people == '' || $this->work == '' || $this->work_environment == '' || $this->career == '' || $this->engagement == '' || $this->performance_rewards == ''){
            $this->addError($attribute, 'Please fill all the parameters before proceeding...');
        }
}

     public function validateHr($attribute, $params)
    {
        if($this->hr_feedback == ''){
            $this->addError($attribute, 'HR Feedback cannot be blank.');
        }
        //$this->addError($attribute, 'HR Feedback cannot be blank.');
    }
}
