<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_allocation".
 *
 * @property integer $id
 * @property string $categoryid
 * @property string $subcategory
 * @property string $parentmenu
 * @property string $childmenu
 * @property string $created_by
 * @property string $modified_by
 * @property string $created_date
 * @property string $modified_date
 */
class MenuAllocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_allocation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        [[ 'userid','categoryid'], 'required'],
            [['created_date', 'userid','modified_date','categoryid', 'parentmenu', 'childmenu', 'created_by', 'modified_by'], 'safe'],
           // [['userid', 'categoryid'], 'unique','attribute' => ['userid', 'categoryid']]
                [['userid'], 'unique', 'targetAttribute' => ['userid', 'categoryid'],'message' => 'Already Allocated'],
           // [['categoryid', 'subcategory', 'parentmenu', 'childmenu', 'created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }
    public function getRole()
    {
        return $this->hasOne(Authitem::className(), ['name' => 'userid']);
    }
   
 public function getCategory()
    {
        return $this->hasOne(CategoryMaster::className(), ['id' => 'categoryid']);
    }
  public function getParent()
    {
        $getsubcompetency_id=rtrim($this->parentmenu,',');
        
        if($getsubcompetency_id == '')
            $getsubcompetency_id = '0';
      
        $mod_sql = "SELECT title FROM bi_menus where
                    id in (".$getsubcompetency_id.")";
                //echo $mod_sql;
                //exit;
                $mod_connection = Yii::$app->db;
                $mod_command = $mod_connection->createCommand($mod_sql);
                $subcompetency_id_results = $mod_command->queryAll(); 
                //$subcompetency_id_name= $subcompetency_id_results[0]['name'];

                //echo "<pre>";
                $snames = "";
        foreach($subcompetency_id_results as $aaaa)
        {
            $snames .= $aaaa['title'] . ", ";
        }
            
        //echo $snames;
        //exit;
        return  substr($snames,0,-2);

    }
    public function getChild()
    {
        $getsubcompetency_id=rtrim($this->childmenu,',');
        
        if($getsubcompetency_id == '')
            $getsubcompetency_id = '0';
      
        $mod_sql = "SELECT title FROM bi_menus where
                    id in (".$getsubcompetency_id.")";
                //echo $mod_sql;
                //exit;
                $mod_connection = Yii::$app->db;
                $mod_command = $mod_connection->createCommand($mod_sql);
                $subcompetency_id_results = $mod_command->queryAll(); 
                //$subcompetency_id_name= $subcompetency_id_results[0]['name'];

                //echo "<pre>";
                $snames = "";
        foreach($subcompetency_id_results as $aaaa)
        {
            $snames .= $aaaa['title'] . ", ";
        }
            
        //echo $snames;
        //exit;
        return  substr($snames,0,-2);

    }
     public function getCreatedbyuser()
     {
         return $this->hasOne(User::className(),['id' => 'created_by']);
     }


    
     public function getModifiedbyuser()
     {
         return $this->hasOne(User::className(),['id' => 'modified_by']);
     }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryid' => 'Category',
            'userid' => 'Profile',
            'parentmenu' => 'Parentmenu',
            'childmenu' => 'Childmenu',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'created_date' => 'Created Date',
            'modified_date' => 'Modified Date',
        ];
    }
    public function beforeSave($insert)
           {
          if (parent::beforeSave($insert))
               {
            $common = $_REQUEST['MenuAllocation'];
            if ($this->isNewRecord)
            {
    
                $this->created_date =  date('Y-m-d h:i:s');
                $this->created_by = Yii::$app->user->id;
            }
            else
            {
        
                $this->modified_date =  date('Y-m-d h:i:s');
                $this->modified_by = Yii::$app->user->id;
            }
            return true; 
            //return parent::beforeSave();

               }
              else 
                  {
        return false;
                 }
       }

}
