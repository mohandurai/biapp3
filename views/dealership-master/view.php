<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DealershipMaster */

$this->title = $model->dealership_id;
$this->params['breadcrumbs'][] = ['label' => 'Dealership Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dealership-master-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->dealership_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->dealership_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'dealership_code',
            'dealership_name',
             [
               'attribute'=>'category_id',
               'label' => 'Category',
                'value'=>$model->category->category_name,
            ],
            'id_external_dealer_shop',
            //'parent_id',
            'dealer_type',
            'audi_code',
            'partner_number',
          
            'responsible_persons',
            'email:email',
            'location_number',
            'street_house',
            'post_code',
            'coordinates',
            'longitude',
            'phone_number',
            'fax_number',
            
            'Primarycode',
            'KVPSPartnernummer',
            'OfficialNameAudiPartner',
            'centralAudiParhomepage',
            'Group1',
            'Groupstreetnumber',
            'GroupCentralEmailadress:email',
           
        ],
    ]) ?>

</div>
