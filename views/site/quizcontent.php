<style>
h1
{
display:none;
}
</style>

<?
session_start();
$contentid=$_REQUEST['id'];
$_SESSION['userid'] = @Yii::$app->user->identity->id ;
  $actual_link = "$_SERVER[REQUEST_URI]";
 $name=explode('/',$actual_link );
  $url="/".$name[1];
?>
<div>
<iframe class="" src="<?=$url ?>/quiz/infonuggetsquiz.php?id=<?= $contentid ?>" width="100%" height="700px" style="border:none;"></iframe>
</div>







