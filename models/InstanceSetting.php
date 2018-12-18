<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\web\UploadedFile;
/**
 * This is the model class for table "instance_setting".
 *
 * @property string $id
 * @property string $header_color
 * @property string $sidebar_color
 * @property string $img_path
 */
class InstanceSetting extends \yii\db\ActiveRecord
{
  public $file;
 public $upload_image;
public $mode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'instance_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['header_color', 'sidebar_color','font_color','font_size','table_color','button_color','child_sidebar_color','hover_color'], 'required'],
            //[['font_size'],'integer'],
 	    [['file', 'img_path','file_name'],'safe'],
	    [['file'],'file','skipOnEmpty' => true,'checkExtensionByMimeType' => false,  'extensions' => 'gif,png,jpeg,jpg,bmp'],
            [['header_color', 'sidebar_color'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'header_color' => 'Header Color',
            'sidebar_color' => 'Sidebar Color',
            'img_path' => 'Img Path',
        ];
    }

    public function beforeSave($insert)
    	{    
		     
		 if(isset($this->id))
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
            $title = $this->id;      
          
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
                            $file->saveAs('images/rsa.png');
                 
                 $filepath='images/rsa.png';
                 $filetype=$file->type;
		

            }

	    if($this->mode=='create')
     	    {
            
            	    $this->img_path=$filepath;
                    $this->file_name=$file->baseName;
                    $connection=Yii::$app->db;
                    $filename_attach="rsa.png";
                    $connection ->createCommand()
		    ->update('instance_setting', ['img_path' =>  $filepath, 'file_name'=>"rsa.png"], 'id = '.$this->id )
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
                   $filename_attach="rsa.png";
                    $connection ->createCommand()
		    ->update('instance_setting', ['img_path' =>  $filepath, 'file_name'=>"rsa.png"], 'id = '.$this->id )
		    ->execute();
            	    }
		
             }       


              parent::afterSave($insert, $changedAttributes);


      }

}
