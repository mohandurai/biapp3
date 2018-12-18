

<?php
use yii\helpers\Html;
use app\models\InstanceSetting;




/* @var $this \yii\web\View */
/* @var $content string */
if (Yii::$app->controller->action->id === 'login') {
    echo $this->render(
        'wrapper-black',
        ['content' => $content]
    );
} else {
    //dmstr\web\AdminLteAsset::register($this);
    //app\assets\AppAsset::register($this);
    //$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/admin-lte';
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
    <!--    <title><?= Html::encode($this->title) ?></title>  -->
        <title>Welcome to BI</title>
        <?php $this->head() ?>
        
        <style type="text/css">
        .submenucolor { background-color: red !important; }
        </style>
    </head>
    <body class="skin-black">
    
    <?php $this->beginBody() ?>


    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <div class="wrapper row-offcanvas row-offcanvas-left">

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
             
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    
                 
    </div>
    
     <?= $this->render(
        'footer.php',
        ['directoryAsset' => $directoryAsset]
    ) ?>

    <?php  $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
<?php

$instance_settings=InstanceSetting::find()->one();

?> 
<script>


console.log($(".kv-sidenav .active > ul"));


</script>



