<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelFunctionType */

$this->title = $model->channel_function_id;
$this->params['breadcrumbs'][] = ['label' => 'Channel Function Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-function-type-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->channel_function_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->channel_function_id], [
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
            'channel_function_id',
            'channel_function_name',
            'channel_function_description',
			
         //  'created_by',
		    [                     
           'label' => 'Created By',
            'value' => $model->createdbyuser->username,
        ],
		   
            'created_date',
           //'modified_by',
		  
		    [  'label' => 'Modified By',
           'value' => $model->modifiedbyuser->username,
        ],
		     
		  
            'modified_date',
        //    'bunit_id',
        ],
    ]) ?>

</div>
