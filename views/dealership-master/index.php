<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DealershipMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dealership Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealership-master-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dealership Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'dealership_id',
            'dealership_code',
            'dealership_name',
             [
               'attribute'=>'category_id',
               'label' => 'Category',
                'value'=>'category.category_name',
            ],
            //'dealership_code',
          //  'id_external_dealer_shop',
            // 'parent_id',
            // 'dealer_type',
            // 'audi_code',
            // 'partner_number',
            // 'audi_sales',
            // 'audi_service',
            // 'responsible_persons',
            // 'email:email',
            // 'location_number',
            // 'street_house',
            // 'post_code',
            // 'coordinates',
            // 'longitude',
            // 'phone_number',
            // 'fax_number',
            // 'external_city_id',
            // 'external_dealer_area_id',
            // 'website_url:url',
            // 'created_date',
            // 'created_by',
            // 'modified_date',
            // 'modified_by',
            // 'dealear_des_id',
             'zone_id',
            // 'tms_status',
            // 'category_id',
            // 'activestatus',
            // 'Primarycode',
            // 'KVPSPartnernummer',
            // 'OfficialNameAudiPartner',
            // 'centralAudiParhomepage',
            // 'Group1',
            // 'Groupstreetnumber',
            // 'GroupCentralEmailadress:email',
            // 'AudiSales',
            // 'AudiService',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
