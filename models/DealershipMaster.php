<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dealership_master".
 *
 * @property integer $dealership_id
 * @property string $dealership_code
 * @property string $dealership_name
 * @property string $audi_dealer_code
 * @property string $id_external_dealer_shop
 * @property string $parent_id
 * @property string $dealer_type
 * @property string $audi_code
 * @property string $partner_number
 * @property string $audi_sales
 * @property string $audi_service
 * @property string $responsible_persons
 * @property string $email
 * @property string $location_number
 * @property string $street_house
 * @property string $post_code
 * @property string $coordinates
 * @property string $longitude
 * @property string $phone_number
 * @property string $fax_number
 * @property string $external_city_id
 * @property string $external_dealer_area_id
 * @property string $website_url
 * @property string $created_date
 * @property string $created_by
 * @property string $modified_date
 * @property string $modified_by
 * @property integer $dealear_des_id
 * @property integer $zone_id
 * @property string $tms_status
 * @property integer $category_id
 * @property string $activestatus
 * @property string $Primarycode
 * @property string $KVPSPartnernummer
 * @property string $OfficialNameAudiPartner
 * @property string $centralAudiParhomepage
 * @property string $Group1
 * @property string $Groupstreetnumber
 * @property string $GroupCentralEmailadress
 * @property integer $AudiSales
 * @property integer $AudiService
 */
class DealershipMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     
     public $mode;
    public static function tableName()
    {
        return 'dealership_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zone_id','tms_status','category_id' ], 'required'],
            [['created_date', 'modified_date','segment','subcategory'], 'safe'],
            [['dealear_des_id', 'zone_id', 'category_id','audi_sales'], 'integer'],
            [['dealership_code', 'dealership_name', 'audi_dealer_code', 'created_by', 'modified_by', 'tms_status'], 'string', 'max' => 45],
            [['id_external_dealer_shop', 'parent_id', 'dealer_type', 'audi_code', 'partner_number', 'audi_sales', 'audi_service', 'responsible_persons', 'email', 'location_number', 'street_house', 'post_code', 'coordinates', 'longitude', 'phone_number', 'fax_number', 'external_city_id', 'external_dealer_area_id', 'website_url', 'Primarycode', 'KVPSPartnernummer', 'OfficialNameAudiPartner', 'centralAudiParhomepage', 'Group1', 'GroupCentralEmailadress'], 'string', 'max' => 55],
            [['activestatus'], 'string', 'max' => 15],
            [['Groupstreetnumber'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function getCategory()
    {
        return $this->hasOne(DealershipCategory::className(), ['category_id' => 'category_id']);
    }
 
 public function beforeSave($insert)
           {
	 	 
		          $common = $_REQUEST['DealershipMaster'];
			         if ($this->isNewRecord)
			         {
	                        $this->created_date =  date('Y-m-d h:i:s');
                            $this->modified_date =  date('Y-m-d h:i:s');
				            $this->created_by = Yii::$app->user->id;
			         }
			         else
			         {
		
				            $this->modified_date =  date('Y-m-d h:i:s');
				            $this->modified_by = Yii::$app->user->id;
			         }


                      if(isset($this->dealership_id))
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
			          //return parent::beforeSave();
                }
	          else 
                {
		          return false;
                }
	     }

     
      public function afterSave($insert, $changedAttributes)
    {

        if($this->mode=='create')
        {  

                $connection=Yii::$app->db;
                 
                $id=$this->dealership_id;
                $dealership_code='DER'.$id;
              
  /*   $connection=Yii::$app->db;
                $id=$model->subject_id;
                $subject_code='SUB'.$id;
                $sql='update subject_master set subject_code=:subject_code where subject_id=:subject_id';
                $command=$connection->createCommand($sql);
                $command->bindParam(":subject_code",$subject_code);
                $command->bindParam(":subject_id",$id);
                $command->execute();*/

                 $sql='update dealership_master set dealership_code="'.$dealership_code.'" where  dealership_id="'.$id.'"';
                $command=$connection->createCommand($sql);
               
                $command->execute();






        }

         parent::afterSave($insert, $changedAttributes);
    }  
     
     
     
     
     
     
     
     
    public function attributeLabels()
    {
        return [
            'dealership_id' => 'Dealership ID',
            'dealership_code' => 'Dealership Code',
            'dealership_name' => 'Dealership Name',
            'audi_dealer_code' => 'Audi Dealer Code',
            'id_external_dealer_shop' => 'External dealer shop name',
            'parent_id' => 'Dealer Group Name',
            'dealer_type' => 'Dealer Type',
            'audi_code' => 'Audi Code',
            'partner_number' => 'Partner Number',
            'audi_sales' => 'Audi Sales',
            'audi_service' => 'Audi Service',
            'responsible_persons' => 'Responsible Persons',
            'email' => 'Group central homepage	',
            'location_number' => 'Location Number',
            'street_house' => 'Group Street',
            'post_code' => 'Group Post code',
            'coordinates' => 'Latitude',
            'longitude' => 'Longitude',
            'phone_number' => 'Group Telephone',
            'fax_number' => 'Group Fax',
            'external_city_id' => 'City ',
            'external_dealer_area_id' => 'Area',
            'website_url' => 'Website Url',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'modified_date' => 'Modified Date',
            'modified_by' => 'Modified By',
            'dealear_des_id' => 'Dealear Des ID',
            'zone_id' => 'Region',
            'tms_status' => 'Consider for TMS',
            'category_id' => 'Dealer Category',
            'activestatus' => 'Activestatus',
            'Primarycode' => 'Audi code/Primary code',
            'KVPSPartnernummer' => 'KVPS Partnernummer',
            'OfficialNameAudiPartner' => 'Official Name Audi Partner',
            'centralAudiParhomepage' => ' Dealer Principal',
            'Group1' => 'Group',
            'Groupstreetnumber' => 'Group Street',
            'GroupCentralEmailadress' => 'Group street number',
            'AudiSales' => 'Audi Type',
            'AudiService' => 'Audi Service',
            'subcategory'=>'sub Category',
        ];
    }
}
