
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
    dmstr\web\AdminLteAsset::register($this);
    app\assets\AppAsset::register($this);
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@bower') . '/admin-lte';
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <style type="text/css">
            .submenucolor { background-color: red !important; }
        </style>
    </head>
    <body class="skin-black">
    <?php $this->beginBody() ?>




    <div class="wrapper row-offcanvas row-offcanvas-left">


        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>


    </div>



    <?php  $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
<?php

$instance_settings=InstanceSetting::find()->one();
$instance_settings->header_color=$instance_settings->header_color;

?>
<script>
    ///Javascript code for color picker ////
    /*
     $("#custom").spectrum({
     color: "#f00",
     change: function(color) {
     console.log(color.toHexString()); // #ff0000

     $.ajax({
     type     :'POST',
     cache    : false,
     url  : 'index.php?r=site/savecolor',
     data:  {color:color.toHexString()},
     success  : function(response) {
     $('#close').html(response);
     }
     });



     },
     move: function(color) {
     $(".skin-black .navbar").css("background-color",  color.toHexString());   // #ff0000
     $(".skin-black .left-side").css("background",  color.toHexString());   // #ff0000
     $(".nav.nav-pills.nav-stacked > li.active > a, .nav.nav-pills.nav-stacked > li.active > a:hover").css("");   // #ff0000
     }
     });*/


    //$('.logo').css("background", "url(\" <?= Yii::$app->request->hostInfo.Yii::$app->getUrlManager()->getBaseUrl()?>/images/rsa.png\")  50% 50% no-repeat");
    //$('.logo').css("background-size","180px");
    //
    //if("<?= $instance_settings->header_color ?>" !="")
    //{
    //$(".skin-black .navbar").css("background-color",  "<?= $instance_settings->header_color ?>");
    //$(".bg-light-blue").css("background-color",  "<?= $instance_settings->header_color ?>");
    //$(".bg-light-blue").attr("style",  "background-color: <?= $instance_settings->header_color ?>"+" !important");
    //}
    //if("<?= $instance_settings->header_color ?>" !="")
    //{
    //$(".skin-black .left-side").css("background",  "<?= $instance_settings->sidebar_color ?>");
    //}
    //if(!$(".kv-sidenav").hasClass("class-name")){
    //$('.kv-sidenav').addClass('forsubmenu');
    //}
    //$('.forsubmenu li ul').attr('style',"background:<?= $instance_settings->child_sidebar_color ?> !important");
    //
    //
    //
    //$(".forsubmenu li a").hover(function(){
    //    $(this).css("background","<?= $instance_settings->hover_color ?>");
    //  },function(){
    //    $(this).css("background","");
    //});
    //
    //$(".nav.nav-pills.nav-stacked > li > a").css("color","<?= $instance_settings->font_color ?>");
    //$(".nav.nav-pills.nav-stacked > li > a").css("font-size","<?= $instance_settings->font_size ?>");
    //
    //$("table thead tr:first-child th").css("background-color","<?= $instance_settings->table_color ?>");
    //
    //$('table thead tr:first-child').css("border-left", "5px solid <?= $instance_settings->table_color ?>");
    //$('table thead tr:first-child').css("border-right", "5px solid <?= $instance_settings->table_color ?>");
    //$('.table tbody').css("border-left", "5px solid <?= $instance_settings->table_color ?>");
    //$('.table tbody').css("border-right", "5px solid <?= $instance_settings->table_color ?>");
    //$('.table tbody').css("border-bottom", "5px solid <?= $instance_settings->table_color ?>");
    //$('.table tbody').css("border-top", "5px solid <?= $instance_settings->table_color ?>");
    //
    //$('.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td').css("border", "1px solid <?= $instance_settings->table_color ?>");
    //
    //$('.filters').css("border-left", "5px solid <?= $instance_settings->table_color ?>");
    //$('.filters').css("border-right", "5px solid <?= $instance_settings->table_color ?>");
    //
    //$('.btn.btn-success').css("border-color","<?= $instance_settings->button_color ?>");
    //$('.btn.btn-success').css("background-color","<?= $instance_settings->button_color ?>");





    /*

     if("<?= \Yii::$app->user->identity->color ?>" !="")
     {
     $(".skin-black .navbar").css("background-color",  "<?= \Yii::$app->user->identity->color ?>");   // #ff0000
     $(".skin-black .left-side").css("background",  "<?= \Yii::$app->user->identity->color ?>");   // #ff0000

     }*/

</script>
