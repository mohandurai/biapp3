<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChannelMaster */

$this->title = $model->channel_id;
$this->params['breadcrumbs'][] = ['label' => 'Channel Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-master-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->channel_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->channel_id], [
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
            'channel_id',
            'channel_code',
            'channel_name',
           // 'channel_function_type_id',
		      [                     
            'label' => 'Channel Function Type',
            'value' => $model->channelfuntiontype->channel_function_name,
        ],  
		   
		   
            'description',
            'created_date',
            'modified_date',
             //   'created_by',
		  [                     
            'label' => 'Created By',
            'value' => $model->createdbyuser->username,
        ],
           // 'modified_by',
		   
		    [  'label' => 'Modified By',
            'value' => $model->modifiedbyuser->username,
        ],
		     
          //  'channel_parent',
			
			   [  'label' => 'Channel Parent',
            'value' => $model->channelmaster->channel_name,
        ],
			
        ],
    ]) ?>

</div>