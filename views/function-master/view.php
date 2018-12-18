<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FunctionMaster */

$this->title = $model->function_id;
$this->params['breadcrumbs'][] = ['label' => 'Function Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="function-master-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->function_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->function_id], [
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
            'function_id',
            'function_code',
            'function_name',
			[                     
            'label' => 'Parent Company ',
            'value' => $model->company->company_name,
        ],
		[                     
            'label' => 'Parent Buinit',
            'value' => $model->bunit->business_unit_name,
        ],
[                     
            'label' => 'Parent Function',
            'value' => $model->fun->function_name,
        ],
          //  'company_id',
           // 'bunit_id',
            'desc',
            'created_date',
            'modified_date',
             [                     
            'label' => 'Created By',
            'value' => $model->createdBy->username,
        ],
             [  'label' => 'Modified By',
            'value' => $model->modifiedBy->username,
        ],
        ],
    ]) ?>

</div>
