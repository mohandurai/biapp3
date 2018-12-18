<?php
/**
 * comment-form.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 *
 * @var yii\web\View $this
 * @var Comments\forms\CommentCreateForm $CommentCreateForm
 */

use rmrevin\yii\module\Comments;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;






/** @var Comments\widgets\CommentFormWidget $Widget */
$this->registerJs(
   '$("document").ready(function(){ 
        $("#comment_form").on("pjax:end", function() {
         //   $.pjax.reload({container:"#paxcommentslist" ,async:false});  //Reload GridView

			
			alert();
			

        });
    });'
);

$Widget = $this->context;

?>

<a name="commentcreateform"></a>
<div class="row comment-form">
    <div class="col-xs-12 col-sm-9 col-md-6 col-lg-4">
<?php // yii\widgets\Pjax::begin(['id' => 'comment_form']) ?>
<?php $form = \yii\widgets\ActiveForm::begin(/*['options' => ['data-pjax' => true ] ] */ ['id'=>"pjaxcommentform"] ); 

        echo Html::activeHiddenInput($CommentCreateForm, 'id');
 echo Html::activeHiddenInput($CommentCreateForm, 'entity');
  echo Html::activeHiddenInput($CommentCreateForm, 'module');

        $options = [];
        if ($Widget->Comment->isNewRecord) {
            $options['data-role'] = 'new-comment';
        }
        echo $form->field($CommentCreateForm, 'text')
            ->textarea($options);

        ?>
        <div class="actions">
            <?php
            echo Html::Button(\Yii::t('app', 'Post comment'), [
                'class' => 'btn btn-primary com_save',
				'id'=>'save_comment',
            ]);
            echo Html::resetButton(\Yii::t('app', 'Cancel'), [
                'class' => 'btn btn-link',
            ]);
            ?>
        </div>
        <?php
        \yii\widgets\ActiveForm::end();
        ?>
	<?php  //yii\widgets\Pjax::end() ?>
    </div>
</div>


