<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DealershipMaster;

/**
 * DealershipMasterSearch represents the model behind the search form about `app\models\DealershipMaster`.
 */
class DealershipMasterSearch extends DealershipMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dealership_id', 'dealear_des_id', 'zone_id', 'category_id', 'AudiSales', 'AudiService'], 'integer'],
            [['dealership_code', 'dealership_name', 'audi_dealer_code', 'id_external_dealer_shop', 'parent_id', 'dealer_type', 'audi_code', 'partner_number', 'audi_sales', 'audi_service', 'responsible_persons', 'email', 'location_number', 'street_house', 'post_code', 'coordinates', 'longitude', 'phone_number', 'fax_number', 'external_city_id', 'external_dealer_area_id', 'website_url', 'created_date', 'created_by', 'modified_date', 'modified_by', 'tms_status', 'activestatus', 'Primarycode', 'KVPSPartnernummer', 'OfficialNameAudiPartner', 'centralAudiParhomepage', 'Group1', 'Groupstreetnumber', 'GroupCentralEmailadress'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DealershipMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'dealership_id' => $this->dealership_id,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'dealear_des_id' => $this->dealear_des_id,
            'zone_id' => $this->zone_id,
            'category_id' => $this->category_id,
            'AudiSales' => $this->AudiSales,
            'AudiService' => $this->AudiService,
        ]);

        $query->andFilterWhere(['like', 'dealership_code', $this->dealership_code])
            ->andFilterWhere(['like', 'dealership_name', $this->dealership_name])
            ->andFilterWhere(['like', 'audi_dealer_code', $this->audi_dealer_code])
            ->andFilterWhere(['like', 'id_external_dealer_shop', $this->id_external_dealer_shop])
            ->andFilterWhere(['like', 'parent_id', $this->parent_id])
            ->andFilterWhere(['like', 'dealer_type', $this->dealer_type])
            ->andFilterWhere(['like', 'audi_code', $this->audi_code])
            ->andFilterWhere(['like', 'partner_number', $this->partner_number])
            ->andFilterWhere(['like', 'audi_sales', $this->audi_sales])
            ->andFilterWhere(['like', 'audi_service', $this->audi_service])
            ->andFilterWhere(['like', 'responsible_persons', $this->responsible_persons])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'location_number', $this->location_number])
            ->andFilterWhere(['like', 'street_house', $this->street_house])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            ->andFilterWhere(['like', 'coordinates', $this->coordinates])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'fax_number', $this->fax_number])
            ->andFilterWhere(['like', 'external_city_id', $this->external_city_id])
            ->andFilterWhere(['like', 'external_dealer_area_id', $this->external_dealer_area_id])
            ->andFilterWhere(['like', 'website_url', $this->website_url])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'tms_status', $this->tms_status])
            ->andFilterWhere(['like', 'activestatus', $this->activestatus])
            ->andFilterWhere(['like', 'Primarycode', $this->Primarycode])
            ->andFilterWhere(['like', 'KVPSPartnernummer', $this->KVPSPartnernummer])
            ->andFilterWhere(['like', 'OfficialNameAudiPartner', $this->OfficialNameAudiPartner])
            ->andFilterWhere(['like', 'centralAudiParhomepage', $this->centralAudiParhomepage])
            ->andFilterWhere(['like', 'Group1', $this->Group1])
            ->andFilterWhere(['like', 'Groupstreetnumber', $this->Groupstreetnumber])
            ->andFilterWhere(['like', 'GroupCentralEmailadress', $this->GroupCentralEmailadress]);

        return $dataProvider;
    }
}
