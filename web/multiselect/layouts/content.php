<?php
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use app\models\RelatedLists;
use yii\db\Query;
AppAsset::register($this);
$connection = \Yii::$app->db;

?>
<script type="text/javascript">
$(document).keydown(function (e)
{
    var keycode1 = (e.keyCode ? e.keyCode : e.which);
    if (keycode1 == 0 || keycode1 == 9) {
        e.preventDefault();
        e.stopPropagation();
    }
});

</script>

<!-- <div class="homepaimgov"></div> -->
<div  id="content" class="col-md-10">


<aside class="right-side " >
    <section class="content-header">
        <h4>
            <?php
            if ($this->title !== null) {
                //echo "</br>Year (2015) -> Cumulative -> Sales -> Categrys -> Bevrgs -> Combine -> Value";
            } else {
                echo \yii\helpers\Inflector::camel2words(\yii\helpers\Inflector::id2camel($this->context->module->id));
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
            } ?>
        </h4>
        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?php
        //echo "<<<=== </br> " . $_REQUEST['categs'];
        if(isset($_REQUEST['categs']) && Yii::$app->user->identity->id!=null) {

          if($_REQUEST['antype']==1) { $para3 = "Single"; } else if($_REQUEST['antype']==2) { $para3 = "Continuous"; } else if($_REQUEST['antype']==3) { $para3 = "Mixed"; } else { $para3 = ""; }

          if($_REQUEST['ptype']==5) { $para1 = "By Cal. Yr."; } else if($_REQUEST['ptype']==1) { $para1 = "Half-Yearly"; } else if($_REQUEST['ptype']==2) { $para1 = "By Qtr."; } else if($_REQUEST['ptype']==3) { $para1 = "By Mth."; } else if($_REQUEST['ptype']==4) { $para1 = "Date"; } else { $para1 = ""; }

          if($_REQUEST['view']==0) { $para2 = "Cumulative"; } else if($_REQUEST['view']==1) { $para2 = "None"; } else if($_REQUEST['view']==2) { $para2 = "Time Series"; } else if($_REQUEST['view']==3) { $para2 = "Growth"; }  else { $para2 = ""; }

          if($_REQUEST['comb']==0) { $comsplit = "Combine"; } else if($_REQUEST['comb']==1) { $comsplit = "Split"; } else { $comsplit = ""; }

          $qry6 = "SELECT title, parent_id FROM `bi_menus` WHERE `id` IN (".str_replace("_",",",$_REQUEST['categs']).")";
          $sql6 = $connection->createCommand($qry6);
          $orderList=$sql6->queryAll();
          $menus1 = "";
          foreach($orderList as $menus) {
            $menus1 = $menus1 . $menus['title'] . ",";
            $parentid = $menus['parent_id'];
          }

          //echo $menus1 . "</br><pre>";
          //print_r($orderList);
          //echo "</pre>";

          $qry7 = "SELECT parent_id, category, title FROM `bi_menus` WHERE `id` = ". $parentid;
          $sql7 = $connection->createCommand($qry7);
          $res7 = $sql7->queryAll();
          foreach($res7 as $res) {
            $categ = $res['title'];
            $catid = $res['category'];
            $parid = $res['parent_id'];
          }

        if (strpos($categ, '/') !== false) {
          $categArr = explode("/",$categ);
          $categ = $categArr[1];
        }

          if($catid==1) { $categ6 = "Mktg.Pot."; } else if($catid ==2) { $categ6 = "Sales"; } else if($catid ==3) { $categ6 = "Secondary Sales"; } else { $categ6 = ""; }

        if($catid==1) {
          $qry8a = "SELECT title FROM `bi_menus` WHERE `id` = ". $parid;
          $sql8a = $connection->createCommand($qry8a);
          $res8a = $sql8a->queryAll();
          foreach($res8a as $re1) {
            $label = $re1['title'];
          }

          $qry8b = "SELECT label FROM `split_combine_view` WHERE `refid`=" . $_REQUEST['combby'];
          $sql8b = $connection->createCommand($qry8b);
          $res8b = $sql8b->queryAll();
          foreach($res8b as $re1b) {
            $val_nos = $re1b['label'];
          }

          echo "<span class='my-selection'>".$categ6." &rArr; " . $label . " &rArr; " . $categ." &rArr; ".substr($menus1,0,-1)." &rArr; ".$comsplit." &rArr; ". $val_nos ."</span>";
        }
        else {
          $qry8 = "SELECT label FROM `split_combine_view` WHERE `refid` = ". $_REQUEST['combby'];
          $sql8 = $connection->createCommand($qry8);
          $res8 = $sql8->queryAll();
            foreach($res8 as $re) {
              $label = $re['label'];
            }

              echo "<span class='my-selection'>".$para3." &rArr; ".$para1." (".$_REQUEST['year'].") &rArr; ".$para2." &rArr; ".$categ6." &rArr; ".$categ." &rArr; ".substr($menus1,0,-1)." &rArr; ".$comsplit." &rArr; ".$label."</span>";

          }

        }
        ?>
    </section>

    <section class="content">



    <!--<img src="images/homepage.jpg" class="mytesthomeimg">-->
        <!--        --><?//= Alert::widget() ?>
        <?= $content ?>
        <?php
        if(Yii::$app->session->getFlash('success') != '')
        {
            $this->registerJs('


            toastr.success("'.Yii::$app->session->getFlash('success').'");
        ');

        }
        if(Yii::$app->session->getFlash('error') != '')
        {
            $this->registerJs('
                toastr.error("'.Yii::$app->session->getFlash('error').'");
            ');
        }
        if(Yii::$app->session->getFlash('warning') != '')
        {
            $this->registerJs('
                toastr.warning("'.Yii::$app->session->getFlash('warning').'");
            ');
        }
        if(Yii::$app->session->getFlash('info') != '')
        {
            $this->registerJs('
                    toastr.info("'.Yii::$app->session->getFlash('info').'");
                ');
        }
        ?>
    </section>



    <section>

<?php

if(yii::$app->controller->action->id =="view")
{
	$qry=RelatedLists::find()->where(['controller' => Yii::$app->controller->id])->asArray()->all();
	$cc=0;
	foreach($qry as $relkey=>$relval)
      {
		$cc=$cc+1;
	      echo "<a id='".$cc."' class='pointer2' onclick='showContent(\"".$relval['field_label']."\");'></a>";
      	$sql = $connection->createCommand($relval['query']);
			$sql->bindValue(':id', $_REQUEST['id']);

         $orderList=$sql->queryAll();

        if(!isset( $orderList[0]))
        {
			$str1 = str_replace(' ', '', $relval['field_label']);
 			echo '<div id="'.$str1.'" style="display:block;" name="'.$cc.'">';
			echo '<table class="table table-striped table-bordered" ><tbody><tr>';
			echo "<td>No records Found</td>";
			echo "</tr>";
			echo '</tbody></table>';
			echo '</div>';
        }
	else
	{

   $str2 = str_replace(' ', '', $relval['field_label']);
	echo '<div id="'.$str2.'" style="display:block;" name="'.$cc.'">';
	$columns=array_keys($orderList[0]);
	echo '<table class="table table-striped table-bordered" ><tbody><tr>';
		  foreach($columns as $k=>$v)
		  {

			echo "<th>".$v."</th>";
		  }
		  echo "</tr>";

		foreach($orderList as $k=>$rellist)
		{
		     echo "<tr>";
		     foreach($rellist as $mk=>$mv)
		     {
			 echo "<td>".$mv."</td>";
		     }
		echo "</tr>";

		}
		echo '</tbody></table>';
		echo '</div>';


       }

       }

}


//echo "<br>";
//echo "</br>";

?>
</section>

<style type="text/css">
.pointer2{
	cursor: pointer;
	text-align: left;
}
</style>


<script type="text/javascript">
$( document ).ready(function() {
$("#NeevRelatedWork").css('display','none');
$("#Competency").css('display','none');
$("#JobDescription").css('display','none');
});
var getId;
$('.pointer2').click(function() {
  getId =$(this).attr('id');
  if(getId == $("#NeevRelatedWork").attr('name'))
  {
  	$("#NeevRelatedWork").css('display','block');
   $("#Competency").css('display','none');
   $("#JobDescription").css('display','none');
  }
 if(getId == $("#Competency").attr('name'))
  {
  	$("#NeevRelatedWork").css('display','none');
   $("#JobDescription").css('display','none');
  	$("#Competency").css('display','block');
  }
 if(getId == $("#JobDescription").attr('name'))
  {
	  $("#Competency").css('display','none');
     $("#NeevRelatedWork").css('display','none');
     $("#JobDescription").css('display','block');
  }

});
$('.pointer').click(function() {
 getId =$(this).attr('id');
  if(getId == $("#NeevRelatedWork").attr('name'))
  {
  	$("#NeevRelatedWork").css('display','block');
   $("#Competency").css('display','none');
   $("#JobDescription").css('display','none');
  }
 if(getId == $("#Competency").attr('name'))
  {
  	$("#NeevRelatedWork").css('display','none');
   $("#JobDescription").css('display','none');
  	$("#Competency").css('display','block');
  }
 if(getId == $("#JobDescription").attr('name'))
  {
	  $("#Competency").css('display','none');
     $("#NeevRelatedWork").css('display','none');
     $("#JobDescription").css('display','block');
  }

  if(getId == 0)
  {
	  $("#Competency").css('display','none');
     $("#NeevRelatedWork").css('display','none');
     $("#JobDescription").css('display','none');
  }


});

function showContent(val) {
  var lTable = document.getElementById(val);
  if(lTable.style.display=="block")
  {
		$("#"+testshow+"hideimg").css('display','none');
			$("#"+testshow).css('display','block');
  }
  else
  {
  		$("#"+testshow+"hideimg").css('display','block');
		$("#"+testshow).css('display','none');
  }
     lTable.style.display = (lTable.style.display == "block") ? "none" : "block";

}
</script>
</aside>

</div>
