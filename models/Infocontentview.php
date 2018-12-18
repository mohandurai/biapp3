<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "allocation_master".
 *
 * @property string $allocation_id
 * @property string $related_question_id
 * @property string $mod_record_id
 * @property integer $emp_id
 * @property string $response
 * @property string $marks
 * @property string $comments
 * @property string $module
 * @property string $created_time
 * @property string $modified_time
 *
 * @property User $emp
 */
class Infocontentview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'allocation_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mod_record_id', 'emp_id', 'module'], 'required'],
            [['emp_id', 'marks', 'module'], 'integer'],
            [['comments'], 'string'],
            [['created_time', 'modified_time'], 'safe'],
            [['related_question_id', 'mod_record_id', 'response'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'allocation_id' => 'Allocation ID',
            'related_question_id' => 'Related Question ID',
            'mod_record_id' => 'Mod Record ID',
            'emp_id' => 'Emp ID',
            'response' => 'Response',
            'marks' => 'Marks',
            'comments' => 'Comments',
            'module' => 'Module',
            'created_time' => 'Created Time',
            'modified_time' => 'Modified Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmp()
    {
        return $this->hasOne(User::className(), ['id' => 'emp_id']);
    }
	public function getInfo()
	{
	return $this->hasOne(InfoNuggets::className(), ['info_nuggest_id' => 'mod_record_id']);
	}

 


	public function getContent()
	{
	
	/*return $this->hasOne(SubjectMaster::className(), ['subject_id' => 'mod_record_id']); 
	
	SubjectMaster::find()->joinwith('fans')->joinWith(['comments', 'comments.fan'])->all()
	
	echo "<pre>"; 
		$infonuggestlist= $this->hasOne(InfoNuggets::className(), ['info_nuggest_id' => 'mod_record_id']);
		
		print_r(ArrayHelper::map($infonuggestlist,'info_nuggest_id','subject'));
		echo "</pre>";*/

	$list= ArrayHelper::map(SubjectMaster::find()->joinwith('nuggets')->andWhere(['info_nuggest_id' => $this->mod_record_id])->all(),'subject_id', 'subject_name');
	
	return  implode(",",$list);
	}
	
	
	

	
	
public function getContenttype()
	{
	  
	   
	    
    $conid= ArrayHelper::map(InfoNuggets::find()->andWhere(['info_nuggest_id' =>$this->mod_record_id])->all(),'info_nuggest_id', 'content');
	    $list1= ArrayHelper::map(FileTransfer::find()->joinwith('nuggetstype')->andWhere(['content_id' =>implode(",",$conid)])->all(),'f_id', 'f_name');	    
	    
	
	return  implode(",",$list1);
	}	
	

	public function getScheduledate()
	{
	  
	  $conid= ArrayHelper::map(InfoNuggets::find()->andWhere(['info_nuggest_id' =>$this->mod_record_id])->all(),'schedule_start_date', 'schedule_start_date');
	 
	
	return  implode(",",$conid);
	}
	
	
	
	
}
