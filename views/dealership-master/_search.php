<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DealershipMasterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dealership-master-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'dealership_id') ?>

    <?= $form->field($model, 'dealership_code') ?>

    <?= $form->field($model, 'dealership_name') ?>

    <?= $form->field($model, 'audi_dealer_code') ?>

    <?= $form->field($model, 'id_external_dealer_shop') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'dealer_type') ?>

    <?php // echo $form->field($model, 'audi_code') ?>

    <?php // echo $form->field($model, 'partner_number') ?>

    <?php // echo $form->field($model, 'audi_sales') ?>

    <?php // echo $form->field($model, 'audi_service') ?>

    <?php // echo $form->field($model, 'responsible_persons') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'location_number') ?>

    <?php // echo $form->field($model, 'street_house') ?>

    <?php // echo $form->field($model, 'post_code') ?>

    <?php // echo $form->field($model, 'coordinates') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'fax_number') ?>

    <?php // echo $form->field($model, 'external_city_id') ?>

    <?php // echo $form->field($model, 'external_dealer_area_id') ?>

    <?php // echo $form->field($model, 'website_url') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified_date') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <?php // echo $form->field($model, 'dealear_des_id') ?>

    <?php // echo $form->field($model, 'zone_id') ?>

    <?php // echo $form->field($model, 'tms_status') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'activestatus') ?>

    <?php // echo $form->field($model, 'Primarycode') ?>

    <?php // echo $form->field($model, 'KVPSPartnernummer') ?>

    <?php // echo $form->field($model, 'OfficialNameAudiPartner') ?>

    <?php // echo $form->field($model, 'centralAudiParhomepage') ?>

    <?php // echo $form->field($model, 'Group1') ?>

    <?php // echo $form->field($model, 'Groupstreetnumber') ?>

    <?php // echo $form->field($model, 'GroupCentralEmailadress') ?>

    <?php // echo $form->field($model, 'AudiSales') ?>

    <?php // echo $form->field($model, 'AudiService') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
