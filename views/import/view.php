<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Import;
/* @var $this yii\web\View */
/* @var $model app\models\PlainSurvey */

$this->title = 'Import CSV Log';
$this->params['breadcrumbs'][] = ['label' => 'Import CSV Log', 'url' => ['log']];
//$this->params['breadcrumbs'][] = $this->title;
//id, model, total_records, success_records, error_records, success_path, success_file,error_path, error_file, created_by, created_date
function get_user($id)
{
return Import::getCreatedBy($id);
}
?>
<div class="import-csv-view">

    <?= DetailView::widget([
        'model' => $model[0],
        'attributes' => [
            'id',
            'model',
            'total_records',
            'success_records',
			'error_records',
			//'success_file',
			[
			'attribute' => 'success_file',
			'value' => Html::a(Html::encode($model[0]['success_file']),'index.php?r=import/step7&file='.$model[0]['success_path'],['target'=>'_blank']),
			'format' => 'raw'
			],
			[
			'attribute' => 'error_file',
			'value' => Html::a(Html::encode($model[0]['error_file']),'index.php?r=import/step7&file='.$model[0]['error_path'],['target'=>'_blank']),
			'format' => 'raw'
			],
			[
			'attribute' => 'created_by',
			'format' => 'raw',
			'value'=>get_user($model[0]['id']),
			],
			'created_date',
        ],
    ]) ?>

</div>
