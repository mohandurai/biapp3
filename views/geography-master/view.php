<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeographyMaster */

$this->title = $model->geo_id;
$this->params['breadcrumbs'][] = ['label' => 'Geography Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geography-master-view">

  
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->geo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->geo_id], [
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
            'geo_id',
            'country_code',
            'country',
            'state',
            'city',
            'area',
            'territory',
            'pincode',
            'continental',
	    'village',
          //  'bunit_id',
			'created_date',
			 'modified_date',
			 [                     
            'label' => 'Created By',
            'value' => $model->createdby->username,
        ],
             [  'label' => 'Modified By',
            'value' => $model->modifiedby->username,
        ],
        ],
    ]) ?>

</div>
