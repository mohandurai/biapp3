<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;
/**
 * This is the model class for table "mobile_icons".
 *
 * @property string $icon_id
 * @property string $module
 * @property string $img_path
 */
class MobileIcons extends \yii\db\ActiveRecord
{
  public $file;
 public $upload_image;
public $mode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mobile_icons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module'], 'required'],
	    [['file','model_label_name'],'safe'],
	    [['file'],'file','skipOnEmpty' => true,'checkExtensionByMimeType' => false,  'extensions' => 'gif,png,jpeg,jpg,bmp'],
	  //  [['file'],'file','skipOnEmpty' => true,'on'=>'create'],
	    ['module', 'unique', 'targetClass' => '\app\models\MobileIcons', 'message' => 'Cannot Create more than one icon for a module' ],
            
            [['img_path','file_name'], 'safe'], 
            [['module'], 'string', 'max' => 45]
        ];
    } 

   public function scenarios()
    {
		$scenarios = parent::scenarios();
        $scenarios['create'] = ['module','file','img_path'];//Scenario Values Only Accepted
        return $scenarios;
    }

   function myfilevalid($attribute, $param) {

      	
	if(isset($this->icon_id))
	{
	
	   	 if (\yii\web\UploadedFile::getInstance($model, 'logo')->size !== 0)
		{
	
		}
		else
		{
		        $this->addError($attribute, 'Please Upload A File');	
		}
	}
	else
	{
		  
       		  $this->addError($attribute, 'Please Upload A File u');
	}
		

      
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'icon_id' => 'Icon ID',
            'module' => 'Module',
            'img_path' => 'Img Path',
        ];
    }
	public function beforeSave($insert)
    	{    
		     
		 if(isset($this->icon_id))
		 {
		      $this->mode='update';
		 }
		 else
		 {
		   $this->mode='create';
		   	
		 }

		 if (parent::beforeSave($insert)) 
		 {
		   return true;
		  }
		  else
		  {
		      return false;
		  }
        
         }

      public function afterSave($insert, $changedAttributes)
      {
            $title = $this->icon_id;      
          
            if($this->mode=='create')
            {
               $this->file =UploadedFile::getInstances($this,'file');
            }
            else
            {
   		$this->file =UploadedFile::getInstances($this,'file');
            }

            foreach ($this->file as $file) 
            {
                            
                 $file->saveAs('mobile_icons/'. $this->icon_id.'_'.$file->baseName.'.'.$file->extension);
                 $filepath='mobile_icons/'.$this->icon_id.'_'.$file->baseName.'.'.$file->extension;
                 $filetype=$file->type;

            }

	    if($this->mode=='create')
     	    {
            
            	    $this->img_path=$filepath;
                    $this->file_name=$file->baseName;
                    $connection=Yii::$app->db;
                    $filename_attach=$this->icon_id.'_'.$file->baseName.'.'.$file->extension;
                    $connection ->createCommand()
		    ->update('mobile_icons', ['img_path' =>  $filepath, 'file_name'=>$this->icon_id.'_'.$file->baseName.'.'.$file->extension], 'icon_id = '.$this->icon_id )
		    ->execute();
            }
   

	    if($this->mode=='update')
            {         
		    $ev= array_filter($this->file);           
		    if(!empty($ev))
		    {

		    $this->img_path=$filepath;
                    $this->file_name=$file->baseName;
                    $connection=Yii::$app->db;
                    $filename_attach=$this->icon_id.'_'.$file->baseName.'.'.$file->extension;
                    $connection ->createCommand()
		    ->update('mobile_icons', ['img_path' =>  $filepath, 'file_name'=>$this->icon_id.'_'.$file->baseName.'.'.$file->extension], 'icon_id = '.$this->icon_id)
		    ->execute();
            	    }
		
             }       


              parent::afterSave($insert, $changedAttributes);


      }





}
