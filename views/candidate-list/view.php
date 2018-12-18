<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CandidateList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Candidate Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?> 
<div class="candidate-Create-view ie-botscrol">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'first_name',
            'last_name',
            'email:email',
            //'role_id',
           [                     
            'label' => 'Role',
            'value' => $model->role->description,
            ],
            [                     
            'label' => 'Created Date',
            'value' => date('d-M-Y',strtotime($model->created_date)),
            ],
            //'created_by',
            //'created_date',
            
            

            //'modified_by',
            //'modified_date',
            'status',
        ],
    ]) ?>

</div>
