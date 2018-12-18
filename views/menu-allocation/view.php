<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuAllocation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Menu Allocations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-allocation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
        //    'categoryid',
            [
               'attribute'=>'categoryid',
               'label' => 'Category',
                'value'=>$model->category->category,
            ],
             [
               'attribute'=>'parentmenu',
               'label' => 'Parent Menu',
                'value'=>$model->parent,
            ],
          
            [
               'attribute'=>'childmenu',
               'label' => 'Child Menu',
                'value'=>$model->child,
            ],
             [
               'attribute'=>'created_by',
               'label' => 'Created By ',
                'value'=>$model->createdbyuser->username,
            ],
             [
               'attribute'=>'modified_by',
               'label' => 'Modified By',
                'value'=>$model->modifiedbyuser->username,
            ],
           
            'created_date',
            'modified_date',
        ],
    ]) ?>

</div>
