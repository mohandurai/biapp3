<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessUnitMaster */

$this->title = $model->bunit_id;
$this->params['breadcrumbs'][] = ['label' => 'Business Unit Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-unit-master-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bunit_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bunit_id], [
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
            'bunit_id',
            'business_unit_code',
            'business_unit_name',
           

           // 'business_unit_parent',
		 [
                'label' => 'Parent Company',
                'value'=> $model->company->company_name,
            ],
             [
                'label' => 'Business Unit Parent',
                'value'=> $model->parentuser->business_unit_name,
            ],



          [                     
            'attribute' => 'created_date',
            'value' => date("d-M-Y",  strtotime($model->created_date)),
        ],


           // 'created_by',

             [
                'label' => 'Created By',
                'value'=> $model->createdbyuser->username,
            ],


         [                     
            'attribute' => 'modified_date',
            'value' => date("d-M-Y",  strtotime($model->modified_date)),
        ],


            //'modified_by',
            [
                'label' => 'Modified By',
                'value'=> $model->modifiedbyuser->username,
                
            ],
		

        ],
    ]) ?>

</div>
