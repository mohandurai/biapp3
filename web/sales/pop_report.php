<?php
error_reporting(0);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../../config/web.php');
new yii\web\Application($config);
use yii\helpers\ArrayHelper;
// $retilerschoice = array(2734,3074,2723,2604,2731,3083,2781,2724,2610,2729,2740,3604,2735,3086,3117,2611,2730,2722,3104);
// if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] < 6)
// {
//      echo "Retailers data available at ward level";die;
// }
$colorstor = array();
$final_resul_arry = array();
  function Gradient($HexFrom, $HexTo, $ColorSteps) //, $pers
      {
              $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
              $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
              $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
              $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
              $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
              $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

              $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
              $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
              $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
              $GradientColors = array();

              for($i = 0; $i <= $ColorSteps; $i++)
              {
                     // $i=$pers;
                      $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
                      $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
                      $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

                      $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
                      $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
                      $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

                      $GradientColors[] = '#'.(implode(NULL, $HexRGB));
            // $GradientColors[] = abs(round($RGB['r']))."_".abs(round($RGB['g']))."_".abs(round($RGB['b']));
              }
              return $GradientColors;
      }

     function Gradient_svg($HexFrom, $HexTo, $ColorSteps) //, $pers
      {
              $FromRGB['r'] = hexdec(substr($HexFrom, 0, 2));
              $FromRGB['g'] = hexdec(substr($HexFrom, 2, 2));
              $FromRGB['b'] = hexdec(substr($HexFrom, 4, 2));
              $ToRGB['r'] = hexdec(substr($HexTo, 0, 2));
              $ToRGB['g'] = hexdec(substr($HexTo, 2, 2));
              $ToRGB['b'] = hexdec(substr($HexTo, 4, 2));

              $StepRGB['r'] = ($FromRGB['r'] - $ToRGB['r']) / ($ColorSteps - 1);
              $StepRGB['g'] = ($FromRGB['g'] - $ToRGB['g']) / ($ColorSteps - 1);
              $StepRGB['b'] = ($FromRGB['b'] - $ToRGB['b']) / ($ColorSteps - 1);
              $GradientColors = array();

              for($i = 0; $i <= $ColorSteps; $i++)
              {
                     // $i=$pers;
                      $RGB['r'] = floor($FromRGB['r'] - ($StepRGB['r'] * $i));
                      $RGB['g'] = floor($FromRGB['g'] - ($StepRGB['g'] * $i));
                      $RGB['b'] = floor($FromRGB['b'] - ($StepRGB['b'] * $i));

                      $HexRGB['r'] = sprintf('%02x', ($RGB['r']));
                      $HexRGB['g'] = sprintf('%02x', ($RGB['g']));
                      $HexRGB['b'] = sprintf('%02x', ($RGB['b']));

                      // $GradientColors[] = '#'.(implode(NULL, $HexRGB));
            $GradientColors[] = abs(round($RGB['r']))."_".abs(round($RGB['g']))."_".abs(round($RGB['b']));
              }
              return $GradientColors;
      }
function getsplitcolourchart($d) {
    switch ($d) {
        case 0: return 'rgb(243, 12, 12)';
        case 1: return 'rgb(27, 104, 7)';
        case 2: return 'rgb(0, 0, 255)';
        case 3: return 'rgb(17, 108, 223)';
        case 4: return 'rgb(172, 117, 7)';
        case 5: return 'rgb(226, 240, 13  )';
        case 6: return 'rgb(79, 84, 12)';
        case 7: return 'rgb(84, 12, 13)';
        case 8: return 'rgb(12, 84, 78)';
        case 9: return 'rgb(101, 12, 117 )';

       // default: return 'rgb(183, 126, 223)';
    }
  }
    function cmp($a, $b) {
  //print_r($a["value"].' // '.$b["value"]);die;
        return $b["value"] - $a["value"];
}
function cmpgrowth($a, $b) {
  //print_r($a["value"].' // '.$b["value"]);die;
        return $b["growth"] - $a["growth"];
}

function colorcount($d){

           if($d > 100) return '#006600';
           else if($d > 90) return  '#007f00';
           else if($d > 80)  return '#009900';
           else if($d > 70)  return  '#00b200';
             else if($d > 60)  return '#00cc00';
               else if($d > 50)  return  '#00e500';
               else if($d > 40)  return '#00ff00';
               else if($d > 30)  return  '#19ff19';
                 else if($d > 20)  return '#32ff32';
                  else if($d > 20)  return  '#4cff4c';
                    else if($d < 0)  return '#ff0000';
                                              else return  '#66FF66';

            }

function graphwrk($res,$view_optnc,$perioddata)
{
   $combine="";
  //$_REQUEST['dfs']
  $view = $_REQUEST['view'];
   $relevel=$_REQUEST['level'];
  $rcnt =count($res);
      $titlearrgrowth =array();
      $titlearr=array();
      $titlearr2="";
      $dataarr=array();
      $dataarr1=array();
      $lastarr=array();
      $lastarr1=array();
      $retailers=array();
      $locationvalindex = array();//added by robin
    if($rcnt > 0)
    {
      $sum=0;
      if($view==0 || $view == 5)
      {
        for($k=0;$k<count($res);$k++)
        {


          if($res[$k]['location'] != '')
          {
            // print_r($res[$k]);die;
            $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location']; //added by robin
            array_push($titlearr,$res[$k]['location']);
            $titlearr2 .= '"'.$res[$k]['location'].'",';

            array_push($dataarr,$res[$k]['result']);
            array_push($dataarr1,$res[$k]['loclevel']);
            // if(isset($res[$k]['retail'])){
            array_push($retailers,$res[$k]['retail']);//}

            $sum=$sum+$res[$k]['result'];
          }


        }

        $titlearr3 =trim($titlearr2,",");
        $bc=array();

        $bc['color']=array();$a=array();
        for($k=0;$k<count($titlearr);$k++)
        {

          $s =(($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6 ) ? (int)$dataarr[$k] : (int)$dataarr[$k];

          // print_r($retailers[$k]);die;
          $a[$k]=array($titlearr[$k],'y'=>$s,'mydata'=>$dataarr1[$k]);
          $per=($dataarr[$k]/$sum)*100;
          array_push($bc['color'],colorcount((int)$per));

        }
        $v =(($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6 ) ? "Retailers" : $combine;
        $b=array("showInLegend"=> "false",  "name"=>$v,"data"=>$a);
        // print_r($b);die;
      }
      else if($view==1 || $view==2)
      {
        // print_r($res);die;
        $arr_new = array();
        $stand=array();$b=array();$bq=array();$sum=0;
        for($k=0;$k<count($res);$k++) {
        if($res[$k]['location'] != ''){

        $titlearr=$perioddata;

        if(!in_array($res[$k]['location'], $stand)){
        array_push($stand,$res[$k]['location']);
        $bq[$res[$k]['location']]=array();
        }
        $s =(($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6 ) ? (int)$res[$k]['result'] : (int)$res[$k]['result'];
        // $arr_new[]
        $arr_new[$res[$k]['loclevel']][$res[$k]['period_Y']] = $s;
        $arr_loc[$res[$k]['loclevel']] = $res[$k]['location'];
        array_push($bq[$res[$k]['location']],$s);

        }
        $sum=$sum+(int)$res[$k]['result'];
        }
        // print_r($arr_loc);die;
        $l=0;

        foreach ($arr_loc as $key => $value) {
          # code...
          $arreset = array_values($arr_new[$key]);
          $b[$l] = array("name"=>$value,"data"=>$arreset,"mydata"=>$key);
          $l++;
        }


      }
      else if($view==3)
      {
        // return $res;die;
        // print_r($res);//die;
        $period = $perioddata;
        $newresarr = array();
        foreach ($res as $key => $value)
        {
          $newresarr[$value['loclevel']] = $value['location'];
        }
        // print_r($newresarr);
        // print($dataarr);die;
        // return $newresarr;

        for($k=0;$k<count($res);$k++)
        {
          if($res[$k]['location'] != '' && !in_array($res[$k]['location'], $titlearr)){
          array_push($titlearr,$res[$k]['location']);
          $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location'];//added by robin
          }
          $titlearr2 .= '"'.$res[$k]['location'].'",';
          $s1 =(($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6 ) ? (int)$res[$k]['retail'] : (int)$res[$k]['result'];

          $dataarr[$res[$k]['location']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$s1;
          // $tesnew['location']
            $dataarrgrwoth[$res[$k]['loclevel']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$s1;
            // print_r($dataarr);die;
          array_push($dataarr1,$res[$k]['loclevel']);
        }
        // print_r($dataarrgrwoth);die;
        $arkey = 0;
        foreach ($newresarr as $key => $value) {
          # code...
          // print_r($value);die;
           $dataarrgrwoth[$key]['per']= (($dataarrgrwoth[$key][$period[count($period)-1]]-$dataarrgrwoth[$key][$period[0]])/$dataarrgrwoth[$key][$period[0]])*100;
            $a1[$arkey]=array('y'=>$dataarrgrwoth[$key]['per'],'mydata'=>$key);
            $arkey++;
        }
         $b=array("name"=>$combine,"data"=>$a1);
        // print_r($b);die;
        // array_unique($titlearr);
        // for($k=0;$k<count($titlearr);$k++)
        // {


        // $dataarr[$titlearr[$k]]['per']= (($dataarr[$titlearr[$k]][$period[count($period)-1]]-$dataarr[$titlearr[$k]][$period[0]])/$dataarr[$titlearr[$k]][$period[0]])*100;
        // }
        // // print_r($dataarr);die;
        // $titlearr3 =trim($titlearr2,",");
        // $bc=array();
        // $bc['color']=array();$a=array();
        // // return $dataarr;
        // for($k=0;$k<count($titlearr);$k++)
        // {

        //    // $a[$k]=array('y'=>(int)$dataarr[$titlearr[$k]]['per'],'mydata'=>$dataarr1[$k],'color'=>colorcount((int)$dataarr[$titlearr[$k]]['per']));

        //   $a[$k]=array('y'=>(int)$dataarr[$titlearr[$k]]['per'],'mydata'=>$dataarr1[$k]);

        //    array_push($bc['color'],colorcount((int)$dataarr[$titlearr[$k]]['per']));

        // }

        // $b=array("name"=>$combine,"data"=>$a);
        // return $b;

      }
    }

    else {
        echo "Error !!!!";
    }

    // print_r($b['data']);die;
    //coded by robin for sorting bar
    if(($_REQUEST['view'] == 0 )  || ($_REQUEST['view'] == 3 )  ||($_REQUEST['view'] == 5 ))//cummaltive || ($_REQUEST['view'] == 3 )
    {
      $sortarnew = array();
      $bdata = array();
      // print_r($b['data']);die;
      for($re=0;$re<count($b['data']);$re++)
      {
         // print_r($b['data'][$re]['mydata']);die;
        $sortarnew[$b['data'][$re]['mydata']] = $sortarnew[$b['data'][$re]['mydata']] +$b['data'][$re]['y'];


        $bdata[$b['data'][$re]['mydata']] = $b['data'][$re];
      }
      // print_r($sortarnew);die;
      asort($sortarnew, SORT_NUMERIC);

      $newcategrory = array();
      $newbdata = array();
      $tt = array_reverse($sortarnew, true);
      // print_r($tt);die;
      foreach ($tt as $key => $value)
      {
        array_push($newcategrory,$locationvalindex[$key]);
         //array_push($newbdata,$bdata[$key]);
         array_push($newbdata,$bdata[$key]);
        // $newbdata[$bdata[$key]['mydata']] = $bdata[$key];

      }
      $b['data'] = $newbdata;
      $titlearr = $newcategrory;
    }



      $jsonc=json_encode($titlearr);
      $jk1=json_encode($b);
     if($view<1 || $view == 5){$jk="[$jk1]";$colorn=json_encode($bc['color']); $c=  "colors:$colorn,";}
      else if($view==3){$jk="[$jk1]";$colorn=json_encode($bc['color']); $c=  "colors:$colorn,";}
     else{$jk="$jk1";$c="";}
    // echo $jk;die;
    if(count($titlearr)>10)
    {
      $minmax=" min : 0,
              max : 9,";
    }
    else  if(count($titlearr)>5 && count($titlearr)<10)
    {
         $minmax=" min : 0,
              max : ".count($titlearr).",";
    }
    else
    {
      $minmax="";
    }

    if($view==0 || $view == 3)
    {
    $typechart="column";
    }
     else if($view==1||$view == 2)
    {
      $typechart="line";
    }
    else
    {
      $typechart="column";
    }
// return $jk;
    // print_r($jk);die;
    $relevel=1;
$response = <<<response
<script>

charts = Highcharts.chart('chart', {
   yAxis: {
        labels: {
            format: '{value}'
        },
        title: {
            text: ''
        },
    },
    chart: {
        type: '$typechart'
    },
    title: {
        text: '$title2'
    },
    credits: {
           enabled: false
    },
        yAxis: {

        min: 0,

         labels: {
           formatter: function () {
                return numDifferentiation(this.value);
            }
        },



    },
     $retail
 legend: {enabled: false},
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            colorByPoint: true
        },
      
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        console.log(this.y);

                                       requestlevel=$relevel;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
                                           }
                                          else
                                          {
                                            alert("Data Not available");
                                          }
                                    }

                    }
                }
            }
        }
    },

    xAxis: {
       $minmax
           categories:$jsonc,
             scrollbar: {
        enabled: true
    },

        },

    series: $jk

},

);
chartorgin = charts;
chartdupseries = $jk;

 sessionStorage.setItem('chartseries12', JSON.stringify(chartdupseries));
 chartshead = "Total Sales in Rs";
</script>
response;
// print_r($response);die;
return $response;
}
// fullcnt = $tes;
function graphwrk_split($res,$view_optnc, $perioddata,$relatedid,$split_tble)
{
     $sql_splittable= "select refid,name from biweb.".$split_tble." where refid IN (".$relatedid.") and stat != 'R'";
     //echo $sql_splittable;die;
     $split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();

             $split_dts = json_encode($split_res);



        $rcnt = count($res);
        $cls =  '';
        // print_r($res);die;
        $view = $_REQUEST['view'];
          $str2a = ""; $str2=""; $titlearr="";
          $location=array();
          $countng=array();
          $split_ids = array();
          $namearr=array();
          $totalarr=array();
           $totalarr1=array();
          $locationvalindex=array();
          $itemlvlindex =array();
          $inr=0;$round=0;

          if($view == 0 || $view == 5)
          {
              $typechart="column";

             $trob = array();
             $split_name = array();
            foreach ($res as $key => $value) //{
             {

                    // $trob[$value['loclevel']][$value['split_id']]['name'] =   $value['title'];
               // $trob[$value['loclevel']][$value['split_id']]['name'] =
                    // $trob[$value['split_id']]['split_id'] =   $value['split_id'];

                // $trob[$value['loclevel']][$value['split_id']] =  $trob[$value['loclevel']][$value['split_id']] + $value['result'];
               if(!in_array($value['location'], $namearr))
                   {
                    $locationvalindex[$value['loclevel']] = $value['location'];
                    array_push($namearr,$value['location']);
                    // print_r($res[$j]);die;
                   }
                  $split_name[$value['split_id']]=$value['title'];
                  $trob[$value['split_id']][$value['loclevel']]['y'] =   $trob[$value['split_id']][$value['loclevel']]['y'] +$value['result'];
                   $trob[$value['split_id']][$value['loclevel']]['mydata'] = $value['loclevel'];
                 // $trob[$value['loclevel']]['name'] = $value['title'];
                 // $trob[$value['split_id']]['data'][$value['period_Y']] = $trob[$value['split_id']]['data'][$value['period_Y']]+$value['result'];
             }

              $r=0;
              foreach ($split_name as $key => $value)
              {

                 $dataval = array_values($trob[$key]);

                 array_push($totalarr,array('name'=>$value,'color'=>getsplitcolourchart($r),'split_id'=>$key,'data'=>$dataval));
                 $colorstor[$key] = getsplitcolourchart($r);
                 $r++;
                 if($r == 9)
                 {
                  $r=0;
                 }
              }

              // print_r($totalarr);die;
          }

        else if($view==1 || $view==2)
        {
            $typechart="line";
            $stand=array();$b=array();$bq=array();$sum=0; $namearr=array();
            $totalarr=array();
            $splitindex = array();//Added by robin
           // print_r("expression");die;
            $trob = array();
            foreach ($res as $key => $value) //{
             {

                    $trob[$value['split_id']]['name'] =   $value['title'];
                    $trob[$value['split_id']]['split_id'] =   $value['split_id'];
                    if(!in_array($value['period_Y'], $namearr)){
                    array_push($namearr,$value['period_Y']);

                    }
                 $trob[$value['split_id']]['data'][$value['period_Y']] = $trob[$value['split_id']]['data'][$value['period_Y']]+$value['result'];
             }
             // print_r($trob); die;
             $l=0;
             $r=0;
              foreach ($trob as $key => $value) {
                // print_r($value);die;
                $totalarr[$l]=array("name"=>$value['name'],"color"=>getsplitcolourchart($r),"data"=>array_values($value['data']));
                $l++;
                 $colorstor[$key] = getsplitcolourchart($r);
                 $r++;
                 if($r == 9)
                 {
                  $r=0;
                 }
              }
              // print_r($totalarr);die;


        }

        else if($view==3)
         {


            $period = $perioddata;
            $newresarr = array();
            foreach ($res as $key => $value)
            {
             $newresarr[$value['split_id']] = $value['title'];
            }








           $typechart="column";
           $namearr=array();
           $dataarr1 = array();
            // print_r($res);//die;
           for($k=0;$k<count($res);$k++) {
            if($res[$k]['title'] != '' && !in_array($res[$k]['title'], $namearr)){
              // print_r("expression");die;
              array_push($namearr,$res[$k]['title']);
               $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location'];
               $itemlvlindex[$res[$k]['split_id']] = $res[$k]['title'];

            }
              $namearr2 .= '"'.$res[$k]['title'].'",';
              $dataarr[$res[$k]['title']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$res[$k]['result'];

               //$dataarr[$res[$k]['location']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$s1;
            // $tesnew['location']
            $dataarrgrwoth[$res[$k]['split_id']][$res[$k]['period_Y']]=$dataarrgrwoth[$res[$k]['split_id']][$res[$k]['period_Y']]+$res[$k]['result'];



              // array_push($dataarr1,$res[$k]['loclevel']);

               array_push($dataarr1,$res[$k]['split_id']);
             //  var_dump($res[$k]['loclevel']);die;

            }
            // print_r($dataarrgrwoth);die;
            // $dataarr1 = array_unique($dataarr1);
            // print_r($dataarr1);die;
            $arkey = 0;
            $bc['color'] = array();
            $negativecnt = 0;
            $postivecnt = 0;
             foreach ($newresarr as $key => $value) {
            # code...
            // print_r($value);die;
           $dataarrgrwoth[$key]['per']= (($dataarrgrwoth[$key][$period[count($period)-1]]-$dataarrgrwoth[$key][$period[0]])/$dataarrgrwoth[$key][$period[0]])*100;
            $a1[$arkey]=array('y'=>(double)$dataarrgrwoth[$key]['per'],'mydata'=>$key);
            //print_r(colorcount((int)$dataarrgrwoth[$key]['per']));die;
            if($dataarrgrwoth[$key]['per'] < 0)
            {
                $negativecnt++;
            }
            else
            {
                $postivecnt++;
            }
            $t = colorcount((int)$dataarrgrwoth[$key]['per']);
             array_push($bc['color'],$t);

            $arkey++;
        }
        $postivecolor =array();
        $negativecolor = array();
        if($negativecnt > 0)
        {
            // print_r($negativecnt);die;
            // $temp = $negativecnt -1;
            // if($temp == 0)
            // {
            //     $negativecnt = $negativecnt;
            // }
            // else
            // {
            //     $negativecnt = $temp;
            // }
            // print_r($negativecnt);
            $negativecolor =  Gradient("ff0000","ffcccc", $negativecnt);
            array_pop($negativecolor);
            // print_r($negativecolor);die;
           $negativecolor= array_reverse($negativecolor);
        }
        //else
        //{
        if($postivecolor> 0)
        {
          $postivecolor =  Gradient("004000","1aff1a", $postivecnt);
        }
        //}
        // print_r($negativecolor);
        // print_r($postivecolor);die;
        array_pop($postivecolor);
        // print_r($negativecolor);
        $cls = array_merge($postivecolor,$negativecolor);

           $totalarr=array(array("name"=>$combine,"data"=>$a1));





        }
        // print_r($namearr);die;
        // $cls = array_reverse($cls);
        // print_r($cls);die;
    if($view==3){$colorn=json_encode($cls); $c=  "colors:$colorn,";}else{$c="";}

    // print_r($totalarr);die;
    if(($_REQUEST['view'] == 0 ) || ($_REQUEST['view'] == 3 ) || ($_REQUEST['view'] == 5 ))//cummaltive  || ($_REQUEST['view'] == 3 )
    {
      $bdata = array();
      for($f=0;$f<count($totalarr);$f++)
      {
        $bdatasp = $totalarr[$f]['data'];
          // print_r($bdatasp);//die;
        for($re=0;$re<count($bdatasp);$re++)
        {
          $sortarnew[$bdatasp[$re]['mydata']] = $sortarnew[$bdatasp[$re]['mydata']] +$bdatasp[$re]['y'];
          $bdata[$f][$bdatasp[$re]['mydata']] = $bdatasp[$re];
          // print_r($bdatasp[$re]);
        }
      }
      asort($sortarnew, SORT_NUMERIC);
      $newcategrory = array();

      $tt = array_reverse($sortarnew, true);
      $dummy = $totalarr;
      // print_r($bdata);die;

      for($f=0;$f<count($totalarr);$f++)
      {
        $tempt = 0;
         $bdatasp1 = $totalarr[$f]['data'];
         $newbdata = array();
        foreach ($tt as $key => $value)
        {

          if($f==0)
          {
              if($view == 3)
              {
                  array_push($newcategrory,$itemlvlindex[$key]);
              }
              else
              {
                array_push($newcategrory,$locationvalindex[$key]);
              }

          }
          $bdata[$f][$key]['x'] = $tempt;
          // $bdata[$f]['showInLegend'] ='true';
          $tempt++;
          array_push($newbdata,$bdata[$f][$key]);

        }
         // usort($newbdata, function($a, $b) {
         //  return $b['y'] - $a['y'];
         //  });
        $newbdata = array_filter($newbdata);
        $newbdata = array_values($newbdata);
        $dummy[$f]['data']=$newbdata;

      }

      $namearr = $newcategrory;
      $totalarr = $dummy;
    }


    if(count($namearr)>10)
    {
      $minmax=" min : 0,
              max : 9,";
    }
    else  if(count($namearr)>5 && count($namearr)<10)
    {
        $max = count($namearr)-1;
         $minmax=" min : 0,
              max : ".$max.",";
    }
    else
    {
      $minmax="";
    }
    $json=json_encode($namearr);


    $json1=json_encode($totalarr);
$relevel = 1;//$_REQUEST['level'];
if($view==3)
{
  // $retail
      $response = <<<response
<script>

charts = Highcharts.chart('chart', {
   yAxis: {
        labels: {
            formatter: function () {
                return numDifferentiation(this.value);
            }
        },
        title: {
            text: 'Total Sales in Rs'
        },
    },
    chart: {
        type: '$typechart'
    },
    title: {
        text: '$title2'
    },
    credits: {
           enabled: false
    },
  legend: {enabled: false},
   $c
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
             colorByPoint: true
        },
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        console.log(this.y);

                                       requestlevel=$relevel;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
                                           }
                                          else
                                          {
                                            alert("Data Not available");
                                          }
                                    }

                    }
                }
            }
        }
    },

    xAxis: {
       $minmax
           categories:$json,
             scrollbar: {
        enabled: true
    },

        },

    series: $json1

},

);
  chartseries = $json1;
chartcatgr = $json;
chartdupseries = $json1;
// fullcnt = $tes;
 sessionStorage.setItem('chartseries12', JSON.stringify(chartdupseries));

 sessionStorage.setItem('split_dts', JSON.stringify($split_dts));
</script>
response;
// // print_r($response);die;
// //print_r($json1);die
// return $response;
$returarrya = array();
array_push($returarrya, $response);
array_push($returarrya, $colorstor);
return $returarrya;
}
else if ($view == 0 || $view == 5){
  // print_r('expression');die;
    $response = <<<response
<script>
  charts = Highcharts.chart('chart', {
    chart: {
        type: '$typechart'
    },
    title: {
        text: ''
    },
    xAxis: {

        categories: $json,
         $minmax

    },
    $c
     credits: {
           enabled: false
    },
    yAxis: {

        min: 0,

         labels: {
           formatter: function () {
                return numDifferentiation(this.value);
            }
        },



    },
    scrollbar: {
        enabled: true

    },


    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
      legend: {enabled: false},
    plotOptions: {
        column: {
            stacking: 'normal',
            events: {
              legendItemClick: function() {
                var chart = this.chart,
                series = this,
                hide = !this.visible;
                chart.series.forEach(function(s) {
                if (series.name === s.name) {
                s.update({
                visible: hide
                }, false);
                }
                });

                chart.redraw();
                return false;
              }
            }
        },

        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {


                                       requestlevel=$relevel;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
                                           }
                                          else
                                          {
                                            alert("Data Not available");
                                          }
                                    }

                    },




                }
            }
        }
    },
      series: prepareSeries($json1),
      originalSeries: $json1


});
  chartseries = $json1;
chartcatgr = $json;
chartdupseries = $json1;
// fullcnt = $tes;
 sessionStorage.setItem('chartseries12', JSON.stringify(chartdupseries));

 sessionStorage.setItem('split_dts', JSON.stringify($split_dts));
// prepareSeries($json1);
</script>
response;
//prepareSeries    series: $json1
// print_r($response);die;
$returarrya = array();
array_push($returarrya, $response);
array_push($returarrya, $colorstor);
return $returarrya;
}
else
{
  // print_r($json1);die;
      $response = <<<response
<script>
  charts = Highcharts.chart('chart', {
    chart: {
        type: '$typechart'
    },
    title: {
        text: ''
    },
    xAxis: {

        categories: $json,
         $minmax

    },
    $c
     credits: {
           enabled: false
    },
    yAxis: {

        min: 0,

         labels: {
           formatter: function () {
                return numDifferentiation(this.value);
            }
        },



    },
    scrollbar: {
        enabled: true

    },


    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
      legend: {enabled: false},
    plotOptions: {
        column: {
            stacking: 'normal',

        },
        series: {
            cursor: 'pointer',

            point: {
                events: {
                    click: function () {


                                       requestlevel=$relevel;
                                      if(requestlevel!=0 && requestlevel!=2 && requestlevel!=4 && requestlevel!=6) {

                                                statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel+".kml");
                                                   if(statuscode1 == true)
                                                   {
                                                     map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                                    initial("IndiaKML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                   }
                                                  else
                                                  {
                                                    alert("Data Not available");
                                                  }

                                      }
                                      else
                                      {
                                           requestlevel1=requestlevel+1;

                                           statuscode1=UrlExists(baseurl+"/IndiaKML/"+this.mydata+"---"+requestlevel1+".kml");
                                         if(statuscode1 == true)
                                           {
                                             map.eachLayer(function (layer) {
                                                            map.removeLayer(layer);
                                                            });
                                              initial("IndiaKML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
                                           }
                                          else
                                          {
                                            alert("Data Not available");
                                          }
                                    }

                    }
                }
            }
        }
    },
      series: $json1


});
  chartseries = $json1;
chartcatgr = $json;
chartdupseries = $json1;
// fullcnt = $tes;
 sessionStorage.setItem('chartseries12', JSON.stringify(chartdupseries));

 sessionStorage.setItem('split_dts', JSON.stringify($split_dts));
// prepareSeries($json1);
</script>
response;
$returarrya = array();
array_push($returarrya, $response);
array_push($returarrya, $colorstor);
return $returarrya;
}



}

function mapwrk($res,$retail,$period)
{
   // print_r($res);die;
  // arsort($res);
    $resworld = $res;
    $view = $_REQUEST['view'];
    $sum=0;$locat=array();
    $retailers=array();
    $localworld=array();
    $world=array();
    $worldcount=array();
    if($view==3)
    {
      // return "damn";
       for($v=0;$v<count($resworld);$v++)
        {
           if(!in_array($resworld[$v]['loclevel'], $world)){
            array_push($world,$resworld[$v]['loclevel']);
            array_push($locat,$resworld[$v]['location']);
             array_push($retailers,$resworld[$v]['retailer']);
          }
          $s1 =(double)$resworld[$v]['result'];
            $dataarr[$resworld[$v]['location']][$resworld[$v]['period_Y']]=  $dataarr[$resworld[$v]['period_Y']]+$s1;
             $sum=$sum+$resworld[$v]['result'];


        }
          // return $world;
         for($k=0;$k<count($world);$k++)
                {
            //echo $dataarr[$locat[$k]][$period[count($period)-1]].'****'.$dataarr[$locat[$k]][$period[0]].'<br>';
                    $worldcount[$k]=(($dataarr[$locat[$k]][$period[count($period)-1]]-$dataarr[$locat[$k]][$period[0]])/$dataarr[$locat[$k]][$period[0]])*100;
                }

          natsort($worldcount);
          $worldcount = array_reverse($worldcount,true);
          // print_r($worldcount);//die;
          // return $worldcount;
          $j=0;
          foreach ($worldcount as $key => $value)
          {

            $r1234=$world[$key].'****'.$worldcount[$key].'****'.$sum.'****'.$worldcount[$key];
            $localworld[$j]=$r1234;
            $j++;
          //             $localworld[$i]=$r1234;
          }
        // for($i=0;$i<count($world);$i++)
        // {

        //           $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$worldcount[$i];
        //         $localworld[$i]=$r1234;


        // }
    }
    else{

        if($retail != 0)
        {
          $sumofy =array();
          $sumofrt = array();
          $sumallretail = 0;
          foreach ($resworld as $key => $value)
          {
            $sumofy[$value['loclevel']] = $sumofy[$value['loclevel']]  + $value['result'];
            $sumofrt[$value['loclevel']] = $sumofrt[$value['loclevel']]  + $value['retailer'];
            $sumallretail = $sumallretail + $value['retailer'];
          }
          $jj =0;
           foreach ($sumofy as $key => $value)
           {
            // print_r($value);die;
              $r1234=$key.'****'.$value.'****'.$sumallretail.'****'.$sumofrt[$key];
             // // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$sumofrt[$world[$i]];
                  $localworld[$jj]=$r1234;
                  $jj++;
           }

        }
        else
        {
          // return 'd';
          $locidarray = array();
          for($v=0;$v<count($resworld);$v++)
          {
              $locidarray[$resworld[$v]['loclevel']]['result'] = $locidarray[$resworld[$v]['loclevel']]['result']+$resworld[$v]['result'];
              // $locidarray[$resworld[$v]['loclevel']]['retailer'] =  $locidarray[$resworld[$v]['loclevel']]['retailer']+$resworld[$v]['retailer'];

              $sum=$sum+$resworld[$v]['result'];
          }
          $i = 0;
          foreach ($locidarray as $key => $value)
          {
            # code...

          //for($i=0;$i<count($world);$i++)
                     $r1234=$key.'****'.$value['result'].'****'.$sum.'****'.'0';//$retailers[$i];
                   // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$retailers[$i];
             // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$sumofrt[$world[$i]];
                  $localworld[$i]=$r1234;
                  $i++;


          }

         //rsort($localworld);
        }


      }

       // print_r($localworld);die;
      // echo json_encode($localworld);
      return $localworld;
}


function mapwrk_split($res,$retail,$periods,$view_optnc)

{
  $resdist = $res;
   if($_REQUEST['view'] != 3)
          {
            // print_r($resdist);die;
            if($view_optnc == 3 || $view_optnc == 5)
            {
              $summ_array = array();
              $items =array();
              $centerloc = array();
              foreach ($resdist as $key => $value)
              {
                // print_r($value);die;
                $summ_array[$value['loclevel']][$value['split_id']] =  $summ_array[$value['loclevel']][$value['split_id']]+$value['result'];
                $items[$value['split_id']] = $value['title'];
                $centerloc[$value['loclevel']] = $value['center'];
              }
              array_unique($items);
              array_unique($centerloc);
               foreach ($summ_array as $locid => $value)
               {
                  // print_r($value);die;
               //    // $world[$key][$items[$]]
                 foreach($value as $itmid => $val1)
                 {
                      $world[$locid][$itmid] = array("name"=>$items[$itmid],"value"=>$val1,"center"=>$centerloc[$locid]);
                 }
               }
            }
            else
            {
              for($v=0;$v<count($resdist);$v++)
              {


                   // $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']] = array("name"=>$resdist[$v]['title'],"value"=>$resdist[$v]['result'],"center"=>$resdist[$v]['center']);



                   $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['name'] = $resdist[$v]['title'];
                  $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['value'] = $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['value']+$resdist[$v]['result'];
                  $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['center'] = $resdist[$v]['center'];


              }
            }
            //

            foreach ($world as $key => $value) { //Sorting descending order based on value
              # code...

              uasort($value, 'cmp');
               // array_multisort(array_column($value, 'value'), SORT_DESC, $value);
               // print_r($value);die;
               $newword[$key] = $value;
              // print_r($value);die;
            // $value=  usort($value, 'cmp');
            }


            $world = $newword;
            // print_r($world);die;
            return  $world;//json_encode($world);
          }
        else
        {

            $localworld = array();
            // print_r($resdist[0]);//die;
            // print_r($resdist[1]);
            // print_r($resdist[2]);
            // print_r($resdist[3]);
            foreach ($resdist as $key => $value)
            {
                $strdata[$value['loclevel']][$value['period_Y']] = $strdata[$value['loclevel']][$value['period_Y']]+$value['result'];
            }

            foreach ($strdata as $key => $value)
            {


               $y1 =0;$y2=0;
               if(!isset($value[$periods[1]]))
               {
                  $y1= 0;
               }
               else
               {
                  $y1 =$value[$periods[1]];
               }
               if(!isset($value[$periods[0]]))
               {
                  $y2= 0;
               }
               else
               {
                  $y2 =$value[$periods[0]];
               }
                $growth= number_format((($y1-$y2)/$y2)*100,2);
                $sum = $y1+$y2;
                $s = $key.'****'.$growth.'****'.$sum;
                $sortarr[$key]['growth'] = $growth;
                $sortarr[$key]['sum'] = $sum;

                // print_r($s);die;
                //$localworld[$j] = $s;
                //array_push($localworld,$s);


            }


          uasort($sortarr, 'cmpgrowth');
          foreach ($sortarr as $key => $value) {
             $s = $key.'****'.$value['growth'].'****'.$value['sum'];
              array_push($localworld,$s);
          }
          // print_r($localworld);
          return $localworld;  //echo json_encode($localworld);

        }

}

function moneyFormatIndia($num)
   {
    // $num = 7502,03,20,335;
    //7502 / 0320 / 335
    $explrestunits = "" ;
    $cmtcnt =0;
    if(strlen($num)>3) {
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
    // return $restunits;
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
    //
    $firstrestunits = (substr($restunits, 0, -4));
     $firstrestunits = (int)$firstrestunits;
     $midrestunits = substr($restunits, strlen($restunits)-4);
   // print_r($firstrestunits.' / '.$midrestunits.' / '.$lastthree);die;
    $expunit = str_split($midrestunits, 2);
    //'1283688411.50'
    // $expunit = array_slice($expunit, -2);
    // return $expunit;
    // print_r($expunit);die;
    //$expunit = $midrestunits;
    for($i=0; $i<sizeof($expunit); $i++) {
      // if($cmtcnt == 3)
      // {
      //   continue;
      // }
    // creates each of the 2's group and adds a comma to the end
    if($i==0) {
    $explrestunits .= $expunit[$i].","; // if is first value , convert into integer
    } else {
    $explrestunits .= $expunit[$i].",";
    }
    $cmtcnt = $cmtcnt+1;
    }
    if($firstrestunits == 0)
    {
      $thecash =$explrestunits.$lastthree;
    }
    else
    {
      $thecash =$firstrestunits.','.$explrestunits.$lastthree;
    }
    } else {
    $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
  }
$login=Yii::$app->user->identity->id;
    $combine="";
    $year=$_REQUEST['year'];
    $category=explode("_",$_REQUEST['categs']);
    $relatedid=implode(",",$category);

    $menuids_l = explode("_",$_REQUEST['mnid']);
    $menuids = implode(",",$menuids_l);

    $query=$_REQUEST['id'];
    $relevel=$_REQUEST['level'];
 //       $part2="";
 //       if(count($menuids_l) > 2)
 //       {
 //           $part1="select title from bi_menus where id in (select parent_id from bi_menus where id IN ($menuids_l[0]))";
 //       }
 //       else
 //       {
 //           $part1="select title from bi_menus where id IN ($menuids)";
 //       }

 //  $respart=yii::$app->db->createCommand($part1)->queryAll();
 //  foreach($respart as $resp){
 //     $part2 .= $resp['title'].",";
 //  }
 // $part=trim($part2,",");
 //   print_r($part1);
 //  print_r($part);die;
 $ptype =5;




//fldcreaion






if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="C")
{
  $europe=0;
  $tabl_ids = $_REQUEST['tbl'];


      $sql='';
      $child = "loc".$_REQUEST['childlvl'];
      $parent = "loc".$_REQUEST['parentlvl'];
      $locid = $_REQUEST['id'];
      $period = $_REQUEST['year'];
      // $locationtbl = $locationmaster[$_REQUEST['level']];






        $periods = explode(",",$period);
        $pyyear = array();
        $perids = array();
        $perioddata =array();
         $groupbyvar = ',a.period_Y';

        if($_REQUEST['view'] == 2)
        {
            $jk=0;
            for($i=$periods[0];$i<=$periods[1];$i++)
             {
                    $pyyear[$jk] = "p".$i;
                    $perioddata[$jk] = $i;
                    $jk++;

             }
             $perids = $pyyear;
             $perids = implode(",",$perids);

         }
        else
         {
            $jk = 0;
            for($i=0;$i<count($periods);$i++)
            {
            $pyyear[$jk] = "p".$periods[$i];
            $perioddata[$jk] = $periods[$i];
            $jk++;

            }
            $perids = implode(",",$pyyear);
         }
         if(($_REQUEST['view'] == 0) && (count($periods) > 1))
         {
             $jk=0;
            for($i=$periods[0];$i<=$periods[1];$i++)
             {
                    $pyyear[$jk] = "p".$i;
                    $perioddata[$jk] = $i;
                    $jk++;

             }

             $perids = $pyyear;
             $perids = implode(",",$perids);
             $groupbyvar = '';
         }
        if($_REQUEST['view'] == 5)
        {
          $groupbyvar = '';
        }

 //$mainresultField = "ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) result";

          $filterchild = '';
         $range = '';
      if(isset($_REQUEST['combv']))
      {
        $s = "SELECT * FROM split_combine_view where refid='".$_REQUEST['combv']."'";
        $que = yii::$app->db->createCommand($s)->queryOne();
        $split_idc   =   $que['menu_id'];
        $view_optnc  =   $que['view_optn'];
             $label= $que['label'];
        // echo $split_ids." / / ".$view_optnc;exit();

           if($split_idc != 0)
           {

           }
           else
           {
             if($view_optnc == 3 || $view_optnc == 5)
             {
              //  $mainresultField = "COUNT(DISTINCT(fld632)) result";
                $retail=1;
             }
             else
             {
                //$mainresultField = "";

                $retail =0;
             }
           }


        $combgroup =" ";
      }
      else
      {
         $combgroup =" ";
      }



          if(isset($_REQUEST['id']))
            {
              $s1="a.".$parent." = ".$locid." and ";
           }else
           {
              $s1="";
            }

                     if($_REQUEST['id'] ==207 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql1 = "select a.country_id loclevel, c.location_name as location,sum(tot) as result,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 207 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
      if($_REQUEST['id'] ==155 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql1 = "select a.country_id loclevel,c.location_name as location,sum(tot) as result,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 155 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
      else if($_REQUEST['id'] ==91 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql1 = "select a.country_id loclevel,c.location_name as location,sum(tot) as result,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 91 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
       else if($_REQUEST['id'] ==212 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql1 = "select a.country_id loclevel,c.location_name as location,sum(tot) as result,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 212 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
        else if($_REQUEST['id'] ==192 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql1 = "select a.country_id loclevel,c.location_name as location,sum(tot) as result,a.period_y as period_Y  from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 192 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
       else if($_REQUEST['id'] ==192 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 192 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
      else if($_REQUEST['id'] ==155 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel, c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 155 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
        else if($_REQUEST['id'] ==212 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 212 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
     else if($_REQUEST['id'] ==91 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 91 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
      else if($_REQUEST['id'] ==207 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
          $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 207 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
          $europe =1;
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
      }
      else if($_REQUEST['id'] ==20730 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 20730 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==15561 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 15561 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
       else if($_REQUEST['id'] ==21245 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 21245 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==19216 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 19216 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
       else if($_REQUEST['id'] ==19269 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 19269 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==9115 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql1 = "select a.state_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 9115 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id";
           $europe =1;
            // print_r($sql);die;
      }
      else if($_REQUEST['id'] ==20730 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 9)
      {
             $sql1 = "select a.district_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.district_master c on a.district_id =c.refid where a.state_id = 20730 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.district_id";
               $europe =1;
      }
       else if($_REQUEST['id'] ==207762 && $_REQUEST['parentlvl'] == 9  && $_REQUEST['childlvl'] == 9)
      {
           $sql1 = "select a.district_id loclevel,c.location_name as location,sum(tot) as result ,a.period_y as period_Y from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.district_master c on a.district_id =c.refid where a.district_id = ".$_REQUEST['id']." and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.district_id";
             $europe =1;
      }



     if($europe==0)

      {
               if($_REQUEST['parentlvl']==21 && $_REQUEST['childlvl']==21)
            {
                  $passid="world_id";
                  $passid1="world_id";
                  $mastername="biweb.world_master";
                  $mastername1="biweb_pca.fifth_combo_district";

            }



            else if($_REQUEST['parentlvl']==21 && $_REQUEST['childlvl']==1)
            {
                  $passid="country_id";
                  $passid1="world_id";
                  $mastername="biweb.country_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                  //$year="pop2017";
            }

            else if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==5)
            {
                  $passid="country_id";
                  $passid1="country_id";
                  $mastername="biweb.country_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                  //$year="pop2017";
            }
          else if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==7)
            {
                  $passid="state_id";
                  $passid1="country_id";
                  $mastername="biweb.state_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                 // $year="pop2017";
            }

            else if($_REQUEST['parentlvl']==7 && $_REQUEST['childlvl']==7)
            {

            $passid="state_id";
            $passid1="state_id";
            $mastername="biweb.state_master";
            $mastername1="biweb_pca.fifth_combo_district";
            //$year="pop2017";
            $tblid1=$_REQUEST['id'];
            }
            else if($_REQUEST['parentlvl']==7 && $_REQUEST['childlvl']==9)
            {

            $passid="district_id";
            $passid1="state_id";
            $mastername="biweb.district_master";
            $mastername1="biweb_pca.fifth_combo_district";
            //$year="pop2017";
            }
                       // 9---9iso district // 12-12 iso city //12-15 city ward  9---10 taluks 10-10 iso taluk
                       //fifth_combo_city fifth_combo_district taluk_fifth_combo
            else if($_REQUEST['parentlvl']==9 && $_REQUEST['childlvl']==9)
            {
              $passid="district_id";
              $passid1="district_id";
              $mastername="biweb.district_master";
              $mastername1="biweb_pca.fifth_combo_district";
                 // $year="pop2017";
            }

             else if($_REQUEST['parentlvl']==9 && $_REQUEST['childlvl']==10)
            {
              $passid="taluk_id";
              $passid1="district_id";
              $mastername="biweb.taluk_master";
              $mastername1="biweb_pca.taluk_fifth_combo";
                //  $year="pop2017";
            }

            else if($_REQUEST['parentlvl']==10 && $_REQUEST['childlvl']==10)
            {

                    $passid="taluk_id";
                    $passid1="taluk_id";
                    $mastername="biweb.taluk_master";
                    $mastername1="biweb_pca.taluk_fifth_combo";
                   // $year="pop2017";

                  }

             else if($_REQUEST['parentlvl']==10 && $_REQUEST['childlvl']==14)
            {

                    $passid="village_id";
                    $passid1="taluk_id";
                    $mastername="biweb.village_master";
                       $sqlv="select state_id from biweb.taluk_master where refid = ".$_REQUEST['id']." and stat!='R'";
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                     //print_r($res[0]['state_id']);
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                    // $year="pop2017";
                  }
            else if($_REQUEST['parentlvl']==14 && $_REQUEST['childlvl']==14)
              {

                    $passid="village_id";
                    $passid1="village_id";
                    $mastername="biweb.village_master";
                      $sqlv="select state_id from biweb.village_master where refid = ".$_REQUEST['id']." and stat!='R'";
                      //print_r($sqlv);
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                    // $year="pop2017";
                  }
                   else if($_REQUEST['parentlvl']==13 && $_REQUEST['childlvl']==13)
                {

                    $passid="village_id";
                    $passid1="village_id";
                    $mastername="biweb.village_master";
                     $sqlv="select state_id from biweb.village_master where refid = ".$_REQUEST['id']." and stat!='R'";
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                     $year="pop2017";
                  }


               //    select  a.village_id locid , a.".$year." result ,b.location_name,b.center_coordinates from ".$mastername1." a JOIN biweb.village_master b ON a.village_id=b.refid  and
               // a.stat!='R' and a.".$passid."=".$fileid." group by locid"
           else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12  )
        {
           if($_REQUEST['id']==73)
          {
           $_REQUEST['id'] = 14878;
          }
         if($_REQUEST['id']== 676)
          {
           $_REQUEST['id'] = 13346;
          }


           if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }
          $passid="city_id";
             $passid1="city_id";
            $mastername="biweb.city_master";
            $mastername1="biweb_pca.fifth_combo_city";
               // $year="pop2017";
        // $tablname = 'biweb_sales.14878_sales';
        }

        else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15  )
        {


          if($_REQUEST['id']==73)
          {
           $_REQUEST['id']= 14878;
          }
         if($_REQUEST['id']== 676)
          {
            $_REQUEST['id'] = 13346;
          }
             if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }
         $passid="ward_id";
            $passid1="city_id";
            $mastername="biweb.ward_master";
            $mastername1="biweb_pca.fourth_combo_ward";
              //  $year="pop2017";
        // $tablname = 'biweb_sales.14878_sales';
        }


          else if($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] ==15  )
        {


          if($_REQUEST['id']==73)
          {
           $_REQUEST['id']= 14878;
          }
         if($_REQUEST['id']== 676)
          {
            $_REQUEST['id'] = 13346;
          }
             if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }
         $passid="ward_id";
            $passid1="ward_id";
            $mastername="biweb.ward_master";
            $mastername1="biweb_pca.fourth_combo_ward";
              //  $year="pop2017";
        // $tablname = 'biweb_sales.14878_sales';
        }
        $condarr1=array();
        $condarr2=array();
         $menu_submenu=array();
         $temp=array();
         $get_val=array();
        $filterchild=array();
        $filterchild1=array();
        $m3=array();
        $com=array();
        $val=array();
        $cat=array();
        $over=array();
        $coll=array();
        $grp1=array();
        $str='';
        $year1="";
        $year2="";
        $destname=array();
         //  $filterloc=array();
   $yrln= explode(",",$year);
     if($_REQUEST['view']==0 && count($yrln)==1)//single cul
     {
        $year="";
        $year= $yrln[0];

     }
     else if($_REQUEST['view']==0 && count($yrln)>1)//cont cul
     {
     $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
sort($yrln);

     }

   }
    else if($_REQUEST['view']==2 && count($yrln)>1)//cont time
     {
  $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
sort($yrln);

}
//print_r($yrln);
     }
   else if($_REQUEST['view']==3 && count($yrln)>1)//cont growth
     {
        $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
sort($yrln);
     }

}


          $array1 = array(
           1 =>"gender" ,//key=>value ,//val=>com
           2 => "age" ,
            3 =>"maritalstatus" ,
            4 => "religion" ,
            5 => "education" ,
            189 => "area" ,
         );

          $Age = array(
   '1' => 'age_5_9',
   '2' => 'age_10_14 ',
   '3' => 'age_15_19 ',
   '4' => 'age_20_24',
   '5' => 'age_25_29',
   '6' => 'age_30_34 ',
   '7' => 'age_35_39 ',
   '8' => 'age_40_44 ',
   '9' => 'age_45_49',
   '10' => 'age_50_54 ',
   '11' => 'age_55_59 ',
   '12' => 'age_60_64 ',
   '13' => 'age_65_69 ',
   '14' => 'age_70_74 ',
   '15' => 'age_75_79 ',
   '16' => 'age_80+ ',
   '17' => 'age_not_stated',
   '18' => 'age_0_4',

);


        $rt=$_REQUEST['tbl'];
      $menu_pop=explode(",",$rt);

        //echo $rt;
        //$rt=array();
       $st=$_REQUEST['tbldata'];
       $cat_incat=json_decode($st, true);

         $lk=count($menu_pop);



      foreach ($array1 as $key => $value)
       {
          array_push($com,$array1[$key]);
           array_push($val,$key);

           }


              foreach ($cat_incat as $key => $value)
                  {
                  $condarr = explode(',', $value);

                  $fldkeys = $condarr[0];
                   array_push($get_val,$fldkeys);
                 if($fldkeys==2)
                 {
                   array_shift($condarr);
                   array_push($condarr1,$condarr);
                 }
                 else
                 {
                   array_shift($condarr);
                   array_push($temp,$condarr);
                 }


                  array_push($over,$condarr);




                    }

                 //print_r($condarr1);
                 foreach ($condarr1 as $key => $value)
                 {
                  foreach ($value as $a)
                  {
                     //print_r($a);
                 array_push($condarr2, $a);
                  }

                 }
                //print_r($condarr2);
              for($i=0;$i<count($temp);$i++)
              {
              	 $menu_submenu[$get_val[$i]] = $temp[$i];
              }
             // print_r($menu_submenu);

              unset($menu_submenu[2]);
              //print_r($menu_submenu);
           for($i=0;$i<count($menu_pop);$i++)
           {

            // print_r($over[$i]);
            $str=implode(" ",$over[$i]);
            $str = preg_replace('#\s+#',',',trim($str));
            //echo $str;

           	  if(isset($_REQUEST['categs']))
                      {
                  $filterloc = $_REQUEST['categs'];
                  if($menu_pop[$i]!=2 && $menu_pop[$i]!="")
                  {
                    $filterchild[$i] = "a.".$array1[$menu_pop[$i]]." in (".$str.") AND ";
                   }

                 }



           }









						if(in_array(2, $menu_pop) && $lk==1  )
						{

						$grp="GROUP BY  a.".$passid."    order by result desc";
             $nb="AND ";
						}
						else if(in_array(2, $menu_pop) && $lk>1  )
						{

						$grp="GROUP BY  a.".$passid. "    order by result desc";
              $nb="AND ".implode(" ",$filterchild)."";
						}






           else
           {


              $grp="GROUP BY a.".$passid.  "     order by result desc  ";
                     $nb="AND ".implode(" ",$filterchild)."";





               }
if($_REQUEST['view']==0 && count($yrln)>1   ) // continuous cumulative

{

	$filterchild1=[];
    $filterchild=[];
	if(in_array(2, $menu_pop) && count($menu_pop)>=1)
		{

		     for($i=0;$i<count($yrln);$i++)
			{
			for($j=0;$j<count($condarr2);$j++)
			{

			$filterchild1[$i][$j]="sum(a.".$Age[$condarr2[$j]]."+((a.".$Age[$condarr2[$j]]."*a.pop".$yrln[$i].")/100))"."  +";

			}
		   }

		   foreach ($filterchild1 as $array) {
           $filterchild = array_merge($filterchild , $array);
             }

            //print_r($filterchild);

			$lastEl = array_values(array_slice($filterchild, -1))[0];
			$text = str_replace('  +', ' result ',  $lastEl);

			array_push($filterchild,$text);

			$log= implode(" ",$filterchild);



		}



 else
 {
            for($i=0;$i<count($yrln);$i++)
          {

     //        print_r($yrln[$i]);
     //     die;
          if($i==(count($yrln)-1))
          {
          $log1[$i]= "round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a.pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a.pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[$i].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 ))) result ";

          }
          else
          {
          $log1[$i]= "round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a.pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a.pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[0].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 )))   + ";

          }



           }
              $log= implode(" ",$log1);
          }


         // print_r($log);
         $sd[0]="SELECT a.".$passid." loclevel ,b.location_name location ,
           ".$log." ,".$yrln[0]."   period_Y
             FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid ".$nb."
               ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ";
           // print_r($sd[0]);
           // die;


           }

else if($_REQUEST['view']==5 && count($yrln)>1 )//mixed cumulative
{
	$filterchild1=[];
	$filterchild=[];
      if(in_array(2, $menu_pop)  && count($menu_pop)>=1)
		{

		     for($i=0;$i<count($yrln);$i++)
			{
			for($j=0;$j<count($condarr2);$j++)
			{

			$filterchild1[$i][$j]="sum(a.".$Age[$condarr2[$j]]."+((a.".$Age[$condarr2[$j]]."*a.pop".$yrln[$i].")/100))"."  +";

			}
		   }

		   foreach ($filterchild1 as $array) {
           $filterchild = array_merge($filterchild , $array);
             }

            // print_r($filterchild);die;

			$lastEl = array_values(array_slice($filterchild, -1))[0];
			$text = str_replace('  +', ' result ',  $lastEl);

			array_push($filterchild,$text);

			$log= implode(" ",$filterchild);

		}



  else
  {

    for($i=0;$i<count($yrln);$i++)
          {


          if($i==(count($yrln)-1))
          {
          $log1[$i]= "round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a.pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a.pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[$i].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 )))  result ";

          }
          else
          {
          $log1[$i]= "round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a.pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a.pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[$i].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 )))     + ";

          }



           }

              $log = implode(" ",$log1);


          }

 $sd[0]="SELECT a.".$passid." loclevel ,b.location_name location ,
            ".$log." ,".$yrln[0]."  period_Y
             FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid ".$nb."
               ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ";

}

 else if($_REQUEST['view']==0 && count($yrln)==1 )// single
{

	   if(in_array(2, $menu_pop) )
		           {

                    for($i=0;$i<count($condarr2);$i++)
                    {

                    array_push($filterchild1,"sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[0].")/100))"."  +");


                    }






                       $lastEl = array_values(array_slice($filterchild1, -1))[0];



                      $text = str_replace('  +', ' result ',  $lastEl);

                      array_push($filterchild1,$text);

                   $log= implode("  ",$filterchild1);





		           }
           else
           {

$log="round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[0].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[0].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[0].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[0].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[0].")/100 ))+sum(a.age_30_34+((a.age_30_34*a. pop".$yrln[0].")/100 ))+sum(a.age_35_39+((a.age_35_39*a. pop".$yrln[0].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[0].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[0].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[0].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[0].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[0].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[0].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[0].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[0].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[0].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[0].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[0].")/100 ))) result";

           }


     $sd[0]="SELECT a.".$passid." loclevel ,b.location_name location ,
            ".$log." ,".$yrln[0]."  period_Y
             FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid ".$nb."
               ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ";
               // print_r($sd[0]);die;

}







                   else
                   {

							$lastKey3 = end(array_keys($yrln));
					if(in_array(2, $menu_pop))
		{
              $filterchild1=[];$filterchild=[];
		     for($i=0;$i<count($yrln);$i++)
			{
			for($j=0;$j<count($condarr2);$j++)
			{

			$filterchild1[$i][$j]="sum(a.".$Age[$condarr2[$j]]."+((a.".$Age[$condarr2[$j]]."*a.pop".$yrln[$i].")/100))"."  +";

			}
		   }

		    foreach ($filterchild1 as $ay) {

            $lastEl1 = array_values(array_slice($ay, -1))[0];
            $text = str_replace('  +', ' result ',  $lastEl1);

            array_push($ay,$text);
            $rm=implode(" ",$ay);

           $log1[] = $rm;


             }
         //print_r($log1);

			$log= implode(" ",$log1);

		}

		else
	    {
							for($i=0;$i<count($yrln);$i++)
							{


							$log1[$i]="round(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a. pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a. pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[$i].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 ))) result ";

							}

							//$log= implode(" ",$log1);

							}

                   for($i=0;$i<count($yrln);$i++)
              {

                    $sd[$i]="(SELECT a.".$passid." loclevel ,b.location_name location ,".$log1[$i].",".$yrln[$i]."  period_Y
							FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid ".$nb."
							( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp.")  union ";
            }
  $lastEl2 = array_values(array_slice($sd, -1))[0];
      $text = str_replace('  union', '  ',  $lastEl2);

      array_push($sd,$text);


                }
                $sql1=implode(" ",$sd);
              }

   // print_r($sql1);die;


      $res=yii::$app->db2->createCommand($sql1)->queryAll();


      $rcnt = count($res);

      if(count($res) == 0)
      {
        echo "data not available";
      }
      $tablestr="";


      if($comb==0) {
      $title2 = "Values";
      } else {
      $title2 = "Count";
      }
      $postivecnt = 0;
      $negativecnt = 0;
      if(count($perioddata)> 1)
      {
        $firstperiod= 0;
        $lastperiod=0;

         if(!isset($_REQUEST['filter']))
         {

          if($_REQUEST['view'] == 1 || $_REQUEST['view'] ==2)
          {
                         $price = array();
            foreach ($res as $key => $row)
            {
                $price[$key] = $row['result'];
            }
            array_multisort($price, SORT_DESC, $res);
          }
          if($_REQUEST['view'] == 3)
              {
                $firstperiod = $perioddata[0];
                $lastperiod=$perioddata[(count($perioddata)-1)];
              }

            $l=0;
            $r=0;
            $locationlevels =array();
            $locationname =array();

           //arsort($res);
            foreach($res as $key=>$value)
            {


            $timelinedata[$value['loclevel']][$value['period_Y']]= $value;
            $locationlevels[$l++]= $value['loclevel'];
            $locationname[$r++]=$value['location'];
            if($value['result'] < 0)
                {
                     $negativecnt++;
                }
                else
                {
                      $postivecnt++;
                }

            }





            $locationlevels = array_unique($locationlevels);
            $locationlevels = array_values($locationlevels);
            $locationname = array_unique($locationname);
            $locationname = array_values($locationname);
        $columspan = 2+(int)(count($perioddata));
            $tablestr.="<table id='example19'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";


                 $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."'>".$part." (Rs.)</th></tr>
            <tr>";

           // echo $tablestr;die;
            // $tablestr .="<th>&nbsp;</th>";
            $tablestr .="<th>Location</th>";
              if(($_REQUEST['view'] == 0) && (count($periods) > 1)) //checking cummaltive more than a year continues
              {
                   $tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
              }
              else if(($_REQUEST['view'] == 5) && (count($periods) > 1)) //checking cummaltive more than a year for multiple
              {
                   $tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
              }
              else
              {
                    for($h=0;$h<count($perioddata);$h++)
                    {
                      $tablestr .="<th>".$perioddata[$h]."</th>";
                    }
                    if($_REQUEST['view'] == 3)
                    {
                      $tablestr.="<th>Growth</th>";
                    }
                    else
                    {
                      $tablestr.="<th>Total for Select Period</th>";
                    }
              }
           // if($retail==1){
           //    $tablestr .="<th>Retailers</th>";
           // }

            $tablestr .="</tr>
            </thead> <tbody>";
            $firstval = 0;
            $lasval = 0;
            // print_r($_REQUEST['level']);
            //     die;
            for($k=0;$k<count($locationlevels);$k++)
            {
            $tablestr .= "<tr id='".$locationlevels[$k]."' level='".$_REQUEST['level']."'>";
            // print_r($tablestr);
            // die;
            $totalsumperiod = 0;
            $firstval =0;
            $lastval =0;
            $tablestr .= "<td>".$locationname[$k]."</td>";
            for ($f=0;$f<count($perioddata);$f++)
            {
               if(($_REQUEST['view'] == 0) && (count($periods) > 1)){
                if($f==1)
                {
                  break;
                }
               }
               else   if(($_REQUEST['view'] == 5) && (count($periods) > 1))
               {
                if($f==1)
                {
                  break;
                }
               }
              else if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
              {
                  $tablestr .= "<td align = 'right'>".$timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']."</td>";
              }
              else
              {
                  // print_r($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']);

                  $amountIND = round($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'],2);//'1000003.400050'; '283688411.50';//
                $amt = explode(".",$amountIND);
                $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
               // print_r($amountIND); die;
                if(isset($amt[1]))
                {
                  $amountIND = $amountIND.".".$amt[1];
                }
                 $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                 // $tablestr .= "<td align = 'right'>".$amountIND."</td>";
                 // $tablestr .= "<td align = 'right'>".number_format( $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'], 2 )."</td>";
              }

              if($_REQUEST['view'] == 3)
              {
                  if($perioddata[$f] == $firstperiod)
                  {
                        $firstval= $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'];
                  }
                  if($perioddata[$f] == $lastperiod)
                  {
                         $lastval= $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'];
                  }
              }
              else
              {      //$totalsumperiod = 0;

                   $totalsumperiod = $totalsumperiod + floatval($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']);
              }



            }
            if($_REQUEST['view'] == 3)
            {
              $growthrate = (($lastval-$firstval)/$firstval)*100;
              $tablestr.="<td  align = 'right'>".number_format($growthrate,2)."%</td>";
              //$totalsumperiod = 0;

            }
            // else if(($_REQUEST['view'] == 0) && (count($periods) > 1)){}
            //   else if(($_REQUEST['view'] == 5) && (count($periods) > 1)){}
            else
            {
                // die;
               $amountIND = round($totalsumperiod,2);//'1000003.400050'; '283688411.50';//
                $amt = explode(".",$amountIND);
                $amountIND = moneyFormatIndia( $amt[0] );
              // $tablestr.="<td  align = 'right'>".number_format($totalsumperiod)."</td>";
               $tablestr.="<td  align = 'right'>".$amountIND."</td>";
              $totalsumperiod = 0;

            }
          //   if($retail==1){
          // $tablestr .= "<td>".$retailers[$k]."</td>";
          //   }
            $tablestr .= "</tr>";

            }
            $tempres = json_encode($timelinedata);
            $tablestr .="</tbody></table>";
             // $tempres = json_encode($res);
              // $tablestr.="<script>tablebck = $tempres</script>";
             $tablestr.="<script>splitot =$tempres; tablebck = JSON.stringify(splitot);</script>";
         }
         else
         {
              $tablestr .="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
              $tablestr .='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
                $tablestr .="<tbody>";

              if (count($res) > 0)
              {
                // print_r($res[0]['loclevel']);
                // die;
                 for($k=0;$k<count($res);$k++)
                {
                  $tablestr .="<tr id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                  $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$res[$k]['loclevel']."'></td> <td> ".$res[$k]['location']."</td>";
                  $tablestr .= "</tr>";
                }
              }
             $tablestr .="</tbody></table>";
         }
      }
      else
      {
          $contribut_tot = 0;
          foreach ($res as $item) {
             // print_r($item[]);die;
            $contribut_tot += $item['result'];
            if($item['result'] < 0)
              {
                   $negativecnt++;
              }
              else
              {
                    $postivecnt++;
              }
            // print_r($contribut_tot);
            // die;
          }
        if(!isset($_REQUEST['filter']))
        {
         // [locid] => 1 [center_coordinates] => 12.579656, 92.799125 [location_name] => Andaman & Nicobar Islands [period] => 2018 [result] => 394835.98860731645 )

             foreach($res as $key=>$value)
            {
            $timelinedata[$value['loclevel']][$value['period_Y']]= $value;
            }
            $tablestr.="<table id='example19'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
            $tablestr .="<thead><tr>";//<tr><th colspan='2' >Detailed Report</th></tr>
            // $tablestr .="<th>&nbsp;</th>";
            $countingi=0;
            for($i=0;$i<count($res);$i++)
            {
               foreach($res[$i] as $key=>$value)
                {
                  // echo $key;
                  if($countingi==0){
                    // echo $key; die;
                  if($key == 'loclevel')
                  {
                   // .ucfirst($key).
                    //$tablestr .="<th>".ucfirst($key)."</th>";
                    $tablestr .="<th>Location</th>";
                    $tablestr .="<th align = 'center'>".$part." (Rs.)</th>";
                    $tablestr .="<th align = 'center'>Cumultv Share</th>";
                    $tablestr .="<th align = 'center'>Contrbtn Share(%)</th>";


                  }

                }
                $countingi++;
              }
              // die;
            }




            $tablestr .="</tr>
            </thead> <tbody>";
            // echo $tablestr;die;
     // print_r($tablestr);
     //  die;
            $contribut_tot = 0;
            foreach ($res as $item) {
            $contribut_tot += $item['result'];
            }

            if (count($res) > 0)
            {
              $Cumultv_share = 0;
              // print_r($res[0]['loclevel']);
              // die;
               for($k=0;$k<count($res);$k++)
              {
                $tablestr .= "<tr class='details-control' id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                //$tablestr .= "<td  class='details-control' count='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>+</td>";
                $tablestr .= "<td>".$res[$k]['location']."</td>";
               if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
              {
                  $tablestr .= "<td align = 'right'>".$res[$k]['result']."</td>";
              }
              else
              {
                //1001,9,99,737.79
                // print_r($res[$k]['result']);
                  $amountIND = round($res[$k]['result'],2);//'1000003.400050'; '283688411.50';//
                $amt = explode(".",$amountIND);
                $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
               // print_r($amountIND); die;
                if(isset($amt[1]))
                {
                  $amountIND = $amountIND.".".$amt[1];
                }
                  $cont_share = ($res[$k]['result']/$contribut_tot)*100;
                        $Cumultv_share =number_format(($cont_share+$Cumultv_share),1);
                  $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                  //contribute share

                   $tablestr .= "<td align = 'right' class = 'cumultv_share'>".$Cumultv_share."</td>";
                   $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format($cont_share,1)."</td>";
                 // $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format(($res[$k]['result']/$contribut_tot)*100,2)."</td>";
               // $tablestr .= "<td align = 'right'>".number_format( $res[$k]['result'], 2 )."</td>";
              }


                $tablestr .= "</tr>";
              }
            }
             $jsenolocres = json_encode($timelinedata);
            $tablestr .="</tbody></table>";
             // $tempres = json_encode($res);
              // $tablestr.="<script>tablebck = $tempres</script>";
            $tablestr.="<script>tablebck =$jsenolocres;</script>";

        }
        else
        {
              $tablestr .="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
              $tablestr .='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
                $tablestr .="<tbody>";

              if (count($res) > 0)
              {
                 for($k=0;$k<count($res);$k++)
                {
                  $tablestr .="<tr id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                  $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$res[$k]['loclevel']."'></td> <td> ".$res[$k]['location']."</td>";
                  $tablestr .= "</tr>";
                }
              }
             $tablestr .="</tbody></table>";


        }
      }
        $postivecolor =array();
        $negativecolor = array();
        if($negativecnt > 0)
        {

          $negativecolor =  Gradient_svg("ff0000","ffcccc", $negativecnt);
          array_pop($negativecolor);
          $negativecolor= array_reverse($negativecolor);
        }
        if($postivecolor> 0)
        {
           $postivecolor =  Gradient_svg("004000","1aff1a", $postivecnt);
        }
        array_pop($postivecolor);
        $cls = array_merge($postivecolor,$negativecolor);

        // print_r($cls);die;

        array_push($final_resul_arry, $tablestr);
        //print_r($res);die;
        $grp = graphwrk($res,$view_optnc, $perioddata );
        array_push($final_resul_arry, $grp);
         //print_r($grp);die;
        $mapwrk = mapwrk($res,$retail,$periods);


      $mainlocation = $_REQUEST['parentlvl'];
      $selectedlocation = $_REQUEST['id'];
      $sublocation = $_REQUEST['childlvl'];

        if($mainlocation==$sublocation)
        {
            

      if($_REQUEST['parentlvl'] == '21')
      {
          $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

          $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";

            
      }
      else
      {

          $sql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;
          
          $res=yii::$app->db->createCommand($sql)->queryOne();
          // print_r($res);die;
          $yu=($res['master_table']=='country_master') ? 'refid as country_id' : 'country_id';

          $sql2="select ".$yu.",center_coordinates from ".$res['master_table']." where refid=".$selectedlocation;
          $res2=yii::$app->db->createCommand($sql2)->queryOne();
          // print_r($res2);die;


      // if($_REQUEST['parentlvl'] == '21')
      // {
      //     $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

      //     $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";

            
      
        if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
      {
            $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }
      else
      {
        $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }
          }

        }
        else
        {

          if($_REQUEST['parentlvl'] == '21')
      {
          $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

          $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";

            
      }
            // if($locid == '14878' && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
            // {
            //   $res['master_table'] = 'city_master';
            // }
            else
            {
               $sql="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
               // print_r($sql);die;
                $res=yii::$app->db->createCommand($sql)->queryOne();
            //}
               $prevsql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;

              $preres=yii::$app->db->createCommand($prevsql)->queryOne();

              $prevtbl=$preres['master_table'];
              $text = str_replace('master', 'id', $prevtbl);
              //print_r($text);
              if($res['master_table']=="world_master" )
              {
              $yt="refid";
              }else if($res['master_table']=="country_master" )
              {
              $yt ="refid" ;
              } else
              {
              $yt="country_id";
              }
                //                      if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==7)
                // {
                //           $sql2="select ".$yt." as country_id,center_coordinates from ".$res['master_table']." where country_id=".$selectedlocation; 
                // }
                // else
                // {
$sql2="select ".$yt." as country_id,center_coordinates from ".$res['master_table']."   where ".$text."=".$selectedlocation;
                //}
 
          $res2=yii::$app->db->createCommand($sql2)->queryOne();


      
        if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
      {
            $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }
      else
      {
        $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }
    }


              // $sql2="select * from ".$res['master_table']." where refid=".$selectedlocation;
              // // print_r($sql2);die;
              // $res2=yii::$app->db->createCommand($sql2)->queryOne();
       // print_r($sql2);die;
        }
      
//print_r($replicsvgfilen );die;

      $totsvg = file_get_contents($svgfilen);
      $svgstr = '';
      // print_r($mapwrk);//die;
    // print_r($replicsvgfilen);die;
      for($j=0;$j<count($mapwrk);$j++)
      {

              $splitx = explode("****",$mapwrk[$j]);

              if($splitx[0] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
              {
                $splitx[0] = 73;
              }
              $colorspl = explode('_',$cls[$j]);
              $clrgb = 'rgb('. $colorspl[0].', '. $colorspl[1].', '. $colorspl[2].')';
              $svgstr = '&lt;defs&gt;&lt;linearGradient id="solids'.$splitx[0].'" x1="0" y1="0" x2="0" y2="1"&gt;';
              $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$clrgb.';stop-opacity:1" /&gt;
          &lt;stop offset="100%" style="stop-color:'.$clrgb.';stop-opacity:1" /&gt;';
              $svgstr .= '&lt;/linearGradient &gt; &lt;/defs &gt;';
              
           
                $colorfinder = '~~~~~MARK'.$splitx[0].'~~~~~';
              
              // print_r($colorfinder);die;
              $totsvg1 = str_replace($colorfinder,$svgstr,$totsvg);
              $totsvg2 = str_replace("&lt;","<",$totsvg1);
              $totsvg = str_replace("&gt;",">",$totsvg2);

      }


    $totsvg = preg_replace('/\~\~\~\~\~([A-z])+([0-9]+)\~\~\~\~\~/m', '<defs>
    <linearGradient id="solids$2" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(255, 255, 255);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(255, 255, 255);stop-opacity:1"></linearGradient > </defs>', $totsvg);
    // print_r($svgfilen);
    // print_r($replicsvgfilen);die;
    $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
    fwrite($myfile, "\n". $totsvg);
    fclose($myfile);






        array_push($final_resul_arry, $mapwrk);
        array_push($final_resul_arry,count($perioddata));
        array_push($final_resul_arry,'');
             array_push($final_resul_arry,'');
           array_push($final_resul_arry,$label);//reading
                array_push($final_resul_arry,1);//sort order
        // print_r($mapwrk);die;

}





else if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="S")
{

  // $res=yii::$app->db->createCommand($sql)->queryAll();
  // $fldcondtions = $fldcondtions1;
  //  print_r($fldcondtions);die;



  if(isset($_REQUEST['combv']))
          {
              $combv=$_REQUEST['combv'];

              $s = "SELECT * FROM split_combine_view where refid='".$_REQUEST['combv']."'";
              $que = yii::$app->db->createCommand($s)->queryOne();
              $split_idc   =   $que['menu_id'];
              $view_optnc  =   $que['view_optn'];
              $splitgrp= " ,a.fld".$split_idc;


          }
          else
          {
             $splitgrp= "";
             $selectsplit= "";
          }

  // print_r($split_idc);
  //   die;


        $tabl_ids = ($split_idc != "") ?  $split_idc : $_REQUEST['tbl'];

        $tabl_ids = $_REQUEST['tbl'];

        // $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$tabl_ids." and stat !='R'";

         $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$split_idc." and stat !='R'";

        $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();
        $split_tble = $res1['table_name'] ;
      $titles=array();

      $fortitle="select name from biweb.".$split_tble." where refid in(".$_REQUEST['categs'].") and stat !='R'";
  $tt=yii::$app->db2->createCommand($fortitle)->queryAll();
  for($i=0;$i<count($tt);$i++)
  {
      $titles[$i] = $tt[$i]['name'];
  }


        $perids = array();
        $ptype =5;

       $locid = $_REQUEST['id'];
       $period = $_REQUEST['year'];



        if($_REQUEST['parentlvl']==21 && $_REQUEST['childlvl']==21)
            {
                  $passid="world_id";
                  $passid1="world_id";
                  $mastername="biweb.world_master";
                  $mastername1="biweb_pca.fifth_combo_district";

            }



            else if($_REQUEST['parentlvl']==21 && $_REQUEST['childlvl']==1)
            {
                  $passid="country_id";
                  $passid1="world_id";
                  $mastername="biweb.country_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                  //$year="pop2017";
            }

            else if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==5)
            {
                  $passid="country_id";
                  $passid1="country_id";
                  $mastername="biweb.country_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                  //$year="pop2017";
            }
          else if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==7)
            {
                  $passid="state_id";
                  $passid1="country_id";
                  $mastername="biweb.state_master";
                  $mastername1="biweb_pca.fifth_combo_district";
                 // $year="pop2017";
            }

            else if($_REQUEST['parentlvl']==7 && $_REQUEST['childlvl']==7)
            {

            $passid="state_id";
            $passid1="state_id";
            $mastername="biweb.state_master";
            $mastername1="biweb_pca.fifth_combo_district";
            //$year="pop2017";
            $tblid1=$_REQUEST['id'];
            }
            else if($_REQUEST['parentlvl']==7 && $_REQUEST['childlvl']==9)
            {

            $passid="district_id";
            $passid1="state_id";
            $mastername="biweb.district_master";
            $mastername1="biweb_pca.fifth_combo_district";
            //$year="pop2017";
            }
                       // 9---9iso district // 12-12 iso city //12-15 city ward  9---10 taluks 10-10 iso taluk
                       //fifth_combo_city fifth_combo_district taluk_fifth_combo
            else if($_REQUEST['parentlvl']==9 && $_REQUEST['childlvl']==9)
            {
              $passid="district_id";
              $passid1="district_id";
              $mastername="biweb.district_master";
              $mastername1="biweb_pca.fifth_combo_district";
                 // $year="pop2017";
            }

             else if($_REQUEST['parentlvl']==9 && $_REQUEST['childlvl']==10)
            {
              $passid="taluk_id";
              $passid1="district_id";
              $mastername="biweb.taluk_master";
              $mastername1="biweb_pca.taluk_fifth_combo";
                //  $year="pop2017";
            }

            else if($_REQUEST['parentlvl']==10 && $_REQUEST['childlvl']==10)
            {

                    $passid="taluk_id";
                    $passid1="taluk_id";
                    $mastername="biweb.taluk_master";
                    $mastername1="biweb_pca.taluk_fifth_combo";
                   // $year="pop2017";

                  }

             else if($_REQUEST['parentlvl']==10 && $_REQUEST['childlvl']==14)
            {

                    $passid="village_id";
                    $passid1="taluk_id";
                    $mastername="biweb.village_master";
                       $sqlv="select state_id from biweb.taluk_master where refid = ".$_REQUEST['id']." and stat!='R'";
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                     //print_r($res[0]['state_id']);
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                    // $year="pop2017";
                  }
            else if($_REQUEST['parentlvl']==14 && $_REQUEST['childlvl']==14)
              {

                    $passid="village_id";
                    $passid1="village_id";
                    $mastername="biweb.village_master";
                      $sqlv="select state_id from biweb.village_master where refid = ".$_REQUEST['id']." and stat!='R'";
                      //print_r($sqlv);
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                    // $year="pop2017";
                  }
                   else if($_REQUEST['parentlvl']==13 && $_REQUEST['childlvl']==13)
                {

                    $passid="village_id";
                    $passid1="village_id";
                    $mastername="biweb.village_master";
                     $sqlv="select state_id from biweb.village_master where refid = ".$_REQUEST['id']." and stat!='R'";
                     $res1=yii::$app->db2->createCommand($sqlv)->queryAll();
                    $mastername1="biweb_pca.village_gender_".$res1[0]['state_id'];
                     $year="pop2017";
                  }


               //    select  a.village_id locid , a.".$year." result ,b.location_name,b.center_coordinates from ".$mastername1." a JOIN biweb.village_master b ON a.village_id=b.refid  and
               // a.stat!='R' and a.".$passid."=".$fileid." group by locid"
           else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12  )
        {
           if($_REQUEST['id']==73)
          {
           $_REQUEST['id'] = 14878;
          }
         if($_REQUEST['id']== 676)
          {
           $_REQUEST['id'] = 13346;
          }
                if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }

          $passid="city_id";
             $passid1="city_id";
            $mastername="biweb.city_master";
            $mastername1="biweb_pca.fifth_combo_city";

        }

        else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15  )
        {


          if($_REQUEST['id']==73)
          {
           $_REQUEST['id']= 14878;
          }
         if($_REQUEST['id']== 676)
          {
            $_REQUEST['id'] = 13346;
          }
               if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }

         $passid="ward_id";
            $passid1="city_id";
            $mastername="biweb.ward_master";
            $mastername1="biweb_pca.fourth_combo_ward";

        }

         else if($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] ==15  )
        {


          if($_REQUEST['id']==73)
          {
           $_REQUEST['id']= 14878;
          }
         if($_REQUEST['id']== 676)
          {
            $_REQUEST['id'] = 13346;
          }

             if($_REQUEST['id']== 25)
          {
           $_REQUEST['id'] = 13623;
          }
            $passid="ward_id";
            $passid1="ward_id";
            $mastername="biweb.ward_master";
            $mastername1="biweb_pca.fourth_combo_ward";

        }// problem
         $menu_submenu=array();
         $temp=array();$temp1=array();$get_val=array();$filterchild1=array();
        $filterchild=array(); $filterchild2=array();$bul=array();
        $m3=array();$com=array();$val=array(); $cat=array();
        $over=array(); $coll=array();$grp1=array();$val2=array();$val3=array();$val4=array();
        $grp2=array();$value1=array();$m4=array();$m5=array();$val5=array();
        $destname=array();$condarr1=array();$condarr2=array();$val6=array();
        $str='';
        $year1="";
        $year2="";
        $st="";

   $yrln= explode(",",$year);
     if($_REQUEST['view']==0 && count($yrln)==1)//single cul
     {
        $year="";
        $year= $yrln[0];

     }
     else if($_REQUEST['view']==0 && count($yrln)>1)//cont cul
     {
     $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
     sort($yrln);

     }

   }
    else if($_REQUEST['view']==2 && count($yrln)>1)//cont time
     {
  $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
      sort($yrln);

}
//print_r($yrln);
     }
   else if($_REQUEST['view']==3 && count($yrln)>1)//cont growth
     {
        $diff=$yrln[1]-$yrln[0];

    if($yrln[1]!=$yrln[0]+1)
    {
      for($i=0;$i<$diff-1;$i++)
      {

       array_push($yrln,$yrln[$i]+1);
      }
sort($yrln);
     }

}


          $array1 = array(
           1 =>"gender" ,
           2 => "age" ,
            3 =>"maritalstatus" ,
            4 => "religion" ,
            5 => "education" ,
            189 => "area" ,
         );
          $Age = array(
   '1' => 'age_5_9',
   '2' => 'age_10_14 ',
   '3' => 'age_15_19 ',
   '4' => 'age_20_24',
   '5' => 'age_25_29',
   '6' => 'age_30_34 ',
   '7' => 'age_35_39 ',
   '8' => 'age_40_44 ',
   '9' => 'age_45_49',
   '10' => 'age_50_54 ',
   '11' => 'age_55_59 ',
   '12' => 'age_60_64 ',
   '13' => 'age_65_69 ',
   '14' => 'age_70_74 ',
   '15' => 'age_75_79 ',
   '16' => 'age_80 ',
   '17' => 'age_not_stated',
   '18' => 'age_0_4',

);


          $temp=[];
          foreach ($Age as $key => $value)
          {
          	array_push($temp1,$key);
          }

        $rt=$_REQUEST['tbl'];
      $menu_pop=explode(",",$rt);

        //echo $rt;
        //$rt=array();
       $st=$_REQUEST['tbldata'];
       $cat_incat=json_decode($st, true);

         $lk=count($menu_pop);



      foreach ($array1 as $key => $value)
       {
          array_push($com,$array1[$key]);
           array_push($val,$key);//key

           }


             foreach ($cat_incat as $key => $value)
                  {
                  $condarr = explode(',', $value);

                  $fldkeys = $condarr[0];
                   array_push($get_val,$fldkeys);

                   // print_r($condarr);

                 if($fldkeys==2)
                 {
                   array_shift($condarr);
                   array_push($condarr1,$condarr);
                 }
                 else
                 {
                   array_shift($condarr);
                   array_push($temp,$condarr);
                 }
                 //print_r($temp);

                  array_push($over,$condarr);




                    }

                 // print_r($get_val);print_r($temp);
                  $val3  = array_combine($get_val, $temp);

               //  print_r($val3);
                   foreach ($val3 as $key => $value) {
                    $s=implode(" ",$value);
                    $u = str_replace(" ", ",", $s);
                   // print_r($u);

                    array_push($val5,$u);
                    array_push($val4, $key);
                   }
                    //print_r($val5);

                   $val6  = array_combine($val4, $val5);

                 foreach ($condarr1 as $key => $value)
                 {
                  foreach ($value as $a)
                  {
                     //print_r($a);
                 array_push($condarr2, $a);
                  }

                 }

               // print_r($condarr);
              for($i=0;$i<count($temp);$i++)
              {
                 $menu_submenu[$get_val[$i]] = $temp[$i];
              }
              //print_r($menu_submenu);

              unset($menu_submenu[2]);



           for($i=0;$i<count($menu_pop);$i++)
           {

            // print_r($over[$i]);
            $str=implode(" ",$over[$i]);
            $str = preg_replace('#\s+#',',',trim($str));
            //echo $str;

              if(isset($_REQUEST['categs']))
                      {
                  $filterloc = $_REQUEST['categs'];

                  //print_r($filterloc)


                 if($menu_pop[$i]!=2 && $menu_pop[$i]!="")
                  {
                    $filterchild[$i] = "a.".$array1[$menu_pop[$i]]." in(".$str.") AND ";
                   }





                 }



               }




if(in_array(2, $menu_pop))
 {
             foreach ($val6 as $key => $value) {
                 if($key==$split_idc)
                 {
                 	$a=$value;
                 }
                 }

		array_push($grp1,"a.".strtolower($split_tble));


		if($split_tble=='Age')
		{
			foreach ($grp1 as $key => $value)
			{

			if (($key = array_search('a.age', $grp1)) !== false) {
			unset($grp1[$key]);
			}
			}
	         $grp="GROUP BY  a.".$passid. "    ";



         }



		else
		{

		 $grp="GROUP BY  a.".$passid.", " .implode(" ",$grp1). " ";
		}


		$nb="AND ";


   }

 else
  {

  	  foreach ($val6 as $key => $value) {
                 if($key==$split_idc)
                 {
                 	$a=explode(" ,",$value);

                 }
                  }
                $pk=implode(",",$a);
                   //print_r(implode(",",$a));die;
	 array_push($grp1,"a.".strtolower($split_tble));
 //print_r($grp1);die;
	if($split_tble=='Age')
	{
      	if (($key = array_search('a.age', $grp1)) !== false)
      	{
      	unset($grp1[$key]);

      	$grp="GROUP BY  a.".$passid. "  ";





      }

      }



	else
	{
	$grp="GROUP BY  a.".$passid.", " .implode(" ",$grp1). "   order by result desc";
	}

	$nb="AND ".implode(" ",$filterchild)."";
}



      if($ptype == 5)
      {

    $period = $_REQUEST['year'];
    $periods = explode(",",$period);
    $pyyear = array();

    $perioddata =array();
    // $pyyear[0] = $periods[0];
    if($_REQUEST['view'] == 2)
    {
        $jk=0;
        for($i=$periods[0];$i<=$periods[1];$i++)
         {
                $pyyear[$jk] = "p".$i;
                $perioddata[$jk] = $i;
                $jk++;

         }
         $perids = $pyyear;
         $perids = implode(",",$perids);
         //$partiony =implode(",",$partiony);
     }
    else if($_REQUEST['view'] == 0 && count($periods) > 1)
       {
          $jk=0;
          for($i=$periods[0];$i<=$periods[1];$i++)
          {
            $pyyear[$jk] = "p".$i;
            $perioddata[$jk] = $i;
            $jk++;

          }
          $perids = $pyyear;
          $perids = implode(",",$perids);
       }
     else
     {
        $jk = 0;
        for($i=0;$i<count($periods);$i++)
        {
        $pyyear[$jk] = "p".$periods[$i];
        $perioddata[$jk] = $periods[$i];
        $jk++;

        }
        $perids = implode(",",$pyyear);
     }
         // $retail = 0;


      }



if(count($yrln)==1)
{



			if($split_tble == 'Age' )
			{




			if(in_array(2, $menu_pop) && count($menu_pop)>=1 )


			{

			for($i=0;$i<count($condarr2);$i++)
			{
	                 $ty=$Age[$condarr2[$i]];
	                 $ty=$Age[$condarr2[$i]];
			           $rt=$yrln[0];
			                 $st=$ty.$rt;

			array_push($filterchild2,"ROUND(sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[0].")/100)),0)"." as '$st'  ");
			 array_push($m3,$condarr2[$i]);
			array_push($destname, $st);



			}
						for($i=0;$i<count($m3);$i++)
						{
						array_push($value1,$Age[$m3[$i]]);
						//$value=$value1[$i];

						}

                           $sd[0]=" (SELECT b.location_name location,  a.".$passid." loclevel ,
							".implode(" , ",$filterchild2)."    ,
 							b.center_coordinates center FROM ".$mastername1."  a join ".$mastername." b on a.".$passid."=b.refid   ".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ) ";

			}
			else

			{
				for($i=0;$i<count($temp1);$i++)
			{
	                 $ty=$Age[$temp1[$i]];

			           $rt=$yrln[0];
			                 $st=$ty.$rt;

			array_push($filterchild2,"ROUND(sum(a.".$Age[$temp1[$i]]."+((a.".$Age[$temp1[$i]]."*a.pop".$yrln[0].")/100)),0)"." as '$st'  ");
			    array_push($m3,$condarr2[$i]);
			array_push($destname, $st);




			}

               for($i=0;$i<count($m3);$i++)
						{
						array_push($value1,$Age[$m3[$i]]);
						//$value=$value1[$i];

						}

                           $sd[0]=" (SELECT b.location_name location,  a.".$passid." loclevel ,
							".implode(" , ",$filterchild2)."    ,
 							b.center_coordinates center FROM ".$mastername1."  a join ".$mastername." b on a.".$passid."=b.refid   ".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ) ";

			}

			}



			else
			{


				if(in_array(2, $menu_pop) && count($menu_pop)>=1 )


			    {
			    		for($i=0;$i<count($condarr2);$i++)
			     {

			array_push($filterchild2,"ROUND(sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[0].")/100)),0)"." +  ");


			      }

			$lastEl22 = array_values(array_slice($filterchild2, -1))[0];
					$text = str_replace(' + ', ' result  ',  $lastEl22);

					array_push($filterchild2,$text);

             $sd[0]="SELECT b.location_name location, a.".$passid." loclevel,c.name as  title , c.refid as split_id ,".implode(" ",$filterchild2).",".$yrln[0]."  period_Y  ,b.center_coordinates center FROM
			".$mastername1." a join ".$mastername." b  on a.".$passid."=b.refid
			join biweb.".$split_tble." c on c.refid= a.".strtolower($split_tble)."
			".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp."   order by result  ";





				}
                 else
                 {
               $log=" ROUND(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[0].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[0].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[0].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[0].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[0].")/100 ))+sum(a.age_30_34+((a.age_30_34*a. pop".$yrln[0].")/100 ))+sum(a.age_35_39+((a.age_35_39*a. pop".$yrln[0].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[0].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[0].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[0].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[0].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[0].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[0].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[0].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[0].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[0].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[0].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[0].")/100 )),0) result ";


               $sd[0]="SELECT b.location_name location, a.".$passid." loclevel,c.name as  title , c.refid as split_id ,".$log.",".$yrln[0]."  period_Y  ,b.center_coordinates center FROM
			".$mastername1." a join ".$mastername." b  on a.".$passid."=b.refid
			join biweb.".$split_tble." c on c.refid= a.".strtolower($split_tble)."
			".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ";

              }



			}





}
else
{
	if($split_tble == 'Age' )
	{

		if(in_array(2, $menu_pop) && count($menu_pop)>=1 )


		{

			               for($j=0;$j<count($yrln);$j++)
							{
							for($i=0;$i<count($condarr2);$i++)
							{
							$ty=$Age[$condarr2[$i]];
							$rt=$yrln[$j];
							$st=$ty.$rt;
							array_push($destname, $st);
							array_push($filterchild2,"ROUND(sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[$j].")/100)),0)"."   as   '$st' ");
							array_push($bul,$yrln[$j]);
							array_push($m3,$condarr2[$i]);

							}


							}


							for($i=0;$i<count($m3);$i++)
							{

							array_push($value1,$Age[$m3[$i]]);
							   $value=$value1[$i];

							}





							$sd[0]=" (SELECT b.location_name location,  a.".$passid." loclevel ,
							".implode(" , ",$filterchild2)."    ,
							b.center_coordinates center FROM ".$mastername1."  a join ".$mastername." b on a.".$passid."=b.refid   ".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ) ";

		}
		else
		{
           for($j=0;$j<count($yrln);$j++)
							{
							for($i=0;$i<count($temp1);$i++)
							{
							$ty=$Age[$temp1[$i]];
							$rt=$yrln[$j];
							$st=$ty.$rt;
							array_push($destname, $st);
							array_push($filterchild2,"ROUND(sum(a.".$Age[$temp1[$i]]."+((a.".$Age[$temp1[$i]]."*a.pop".$yrln[$j].")/100)),0)"."   as   '$st' ");
							array_push($bul,$yrln[$j]);
							array_push($m3,$temp1[$i]);

							}


							}

							$sd[0]=" (SELECT b.location_name location,  a.".$passid." loclevel ,
							".implode(" , ",$filterchild2)."    ,
							b.center_coordinates center FROM ".$mastername1."  a join ".$mastername." b on a.".$passid."=b.refid   ".$nb." ( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp." ) ";


		}
	}
else
	{
		$filterchild2=[];$filterchild1=[];
				function array_combine_($keys, $values)
				{
				$result = array();
				foreach ($keys as $i => $k) {
				$result[$k][] = $values[$i];
				}
				array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
				return    $result;
				}
		$filterchild2=[];$filterchild1=[];
	   if(in_array(2, $menu_pop) && count($menu_pop)>=1 )
	   {
                  for($j=0;$j<count($yrln);$j++)
							{
							for($i=0;$i<count($condarr2);$i++)
							{
							$ty=$Age[$condarr2[$i]];
							$rt=$yrln[$j];
							$st=$ty.$rt;
							array_push($destname, $st);

							if($i==count($condarr2)-1)
							{
							array_push($filterchild2,"ROUND(sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[$j].")/100)),0)"."   result ");
							}
							else
							{
								array_push($filterchild2,"ROUND(sum(a.".$Age[$condarr2[$i]]."+((a.".$Age[$condarr2[$i]]."*a.pop".$yrln[$j].")/100)),0)"."  + ");
							}

							array_push($bul,$yrln[$j]);
							array_push($m3,$condarr2[$i]);

							}


							}

							 $m4=array_combine_($bul,$filterchild2 );
							// print_r($m4);

                             foreach ($m4 as $key => $value) {
                              array_push($filterchild1, $value);
                          }

                             foreach ($filterchild1 as $key1 => $value1) {
                             	  $a=implode(" ",$value1);

                             	  array_push($m5, $a);
                             }


                             	for($i=0;$i<count($yrln)-1;$i++)
                             	{



					 $sd[$i]="(SELECT b.location_name location, a.".$passid." loclevel ,c.name as  title , c.refid as split_id ,".$m5[$i].",
					".$yrln[$i]."  period_Y ,b.center_coordinates center
					FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid
					join biweb.".$split_tble." c on c.refid= a.".strtolower($split_tble)."
					".$nb."
					( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp.")  union";



					} 	$las1 = array_values(array_slice($sd, -1))[0];

					$text = str_replace('  union', '  ',  $las1);

					array_push($sd,$text);//problem




	   }
       else
       {

	               	for($i=0;$i<count($yrln);$i++)
					{


					$log1[$i]="ROUND(sum(a.age_5_9+((a.age_5_9*a.pop".$yrln[$i].")/100 )) +sum(a.age_10_14+((a.age_10_14*a.pop".$yrln[$i].")/100 ))+sum(a.age_15_19+((a.age_15_19*a.pop".$yrln[$i].")/100 ))+sum(a.age_20_24+((a.age_20_24*a.pop".$yrln[$i].")/100 ))+sum(a.age_25_29+((a.age_25_29*a.pop".$yrln[$i].")/100 ))+sum(a.age_30_34+((a.age_30_34*a. pop".$yrln[$i].")/100 ))+sum(a.age_35_39+((a.age_35_39*a. pop".$yrln[$i].")/100 ))+sum(a.age_40_44+((a.age_40_44*a.pop".$yrln[$i].")/100 ))+sum(a.age_45_49+((a.age_45_49*a.pop".$yrln[$i].")/100 ))+sum(a.age_50_54+((a.age_50_54*a.pop".$yrln[$i].")/100 ))+sum(a.age_55_59+((a.age_55_59*a.pop".$yrln[$i].")/100 ))+sum(a.age_60_64+((a.age_60_64*a.pop".$yrln[$i].")/100 ))+sum(a.age_65_69+((a.age_65_69*a.pop".$yrln[$i].")/100 ))+sum(a.age_70_74+((a.age_70_74*a.pop".$yrln[$i].")/100 ))+sum(a.age_75_79+((a.age_75_79*a.pop".$yrln[$i].")/100 ))+sum(a.age_80+((a.age_80*a.pop".$yrln[$i].")/100 ))+sum(a.age_not_stated+((a.age_not_stated*a.pop".$yrln[$i].")/100 ))+sum(a.age_0_4+((a.age_0_4*a.pop".$yrln[$i].")/100 )),0)result" ;


					 $sd[$i]="(SELECT b.location_name location, a.".$passid." loclevel ,c.name as  title , c.refid as split_id ,".$log1[$i].",
					".$yrln[$i]."  period_Y ,b.center_coordinates center
					FROM ".$mastername1." a JOIN ".$mastername." b  ON a.".$passid."=b.refid
					join biweb.".$split_tble." c on c.refid= a.".strtolower($split_tble)."
					".$nb."
					( a.stat != 'R') AND (a.".$passid1."=".$_REQUEST['id'].") ".$grp.")  union";



					}

					$las1 = array_values(array_slice($sd, -1))[0];

					$text = str_replace('  union', '  ',  $las1);

					array_push($sd,$text);

       }


	}

}


       $dest=array();  $loc=array();$loc1=array();
       $locId=array(); $center=array();$arr1=array();
        $arr2=array();$arr21=array();$arr3=array(); $arr4=array();
         $arr5=array();$arr6=array(); $arr7=array(); $first_names=array();
          $sing_pack=array();$old=array();$new=array();


            $sql="";
      $sql= implode(" ",$sd);
       // print_r($sql);die;
      $europe = 0;
      // print_r($relatedid);die;
      //Static query for other countries ...
      if($_REQUEST['id'] ==207 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql = "select c.location_name as location,a.country_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 207 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id,split_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
      if($_REQUEST['id'] ==155 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql = "select c.location_name as location,a.country_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 155 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id,split_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
      else if($_REQUEST['id'] ==91 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql = "select c.location_name as location,a.country_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 91 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id,split_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
       else if($_REQUEST['id'] ==212 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql = "select c.location_name as location,a.country_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 212 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id,split_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
        else if($_REQUEST['id'] ==192 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 5)
      {
          $sql = "select c.location_name as location,a.country_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.country_master c on a.country_id =c.refid where a.country_id = 192 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.country_id,split_id";
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
          $europe =1;
      }
       else if($_REQUEST['id'] ==192 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 192 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
      else if($_REQUEST['id'] ==155 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 155 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
        else if($_REQUEST['id'] ==212 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 212 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
     else if($_REQUEST['id'] ==91 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 91 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
            //  $res=yii::$app->db->createCommand($sql)->queryAll();
            // $rcnt = count($res);
            $europe =1;
      }
      else if($_REQUEST['id'] ==207 && $_REQUEST['parentlvl'] == 5  && $_REQUEST['childlvl'] == 7)
      {
          $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.country_id = 207 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
          $europe =1;
          //  $res=yii::$app->db->createCommand($sql)->queryAll();
          // $rcnt = count($res);
      }
      else if($_REQUEST['id'] ==20730 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 20730 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==15561 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 15561 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
       else if($_REQUEST['id'] ==21245 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 21245 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==19216 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 19216 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
       else if($_REQUEST['id'] ==19269 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 19269 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
        else if($_REQUEST['id'] ==9115 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 7)
      {
           $sql = "select c.location_name as location,a.state_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.state_master c on a.state_id =c.refid where a.state_id = 9115 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.state_id,split_id";
           $europe =1;
            // print_r($sql);die;
      }
      else if($_REQUEST['id'] ==20730 && $_REQUEST['parentlvl'] == 7  && $_REQUEST['childlvl'] == 9)
      {
             $sql = "select c.location_name as location,a.district_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.district_master c on a.district_id =c.refid where a.state_id = 20730 and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.district_id,split_id";
      }
       else if($_REQUEST['id'] ==207762 && $_REQUEST['parentlvl'] == 9  && $_REQUEST['childlvl'] == 9)
      {
           $sql = "select c.location_name as location,a.district_id loclevel,b.name as title,a.gender as split_id,sum(tot) as result ,a.period_y as period_Y,c.center_coordinates as center from  biweb_pca.us_pop_new a join biweb.Gender b on b.refid = a.gender join biweb.district_master c on a.district_id =c.refid where a.district_id = ".$_REQUEST['id']." and a.stat = 'A' and a.period_y = 2015 and gender in (".$relatedid.") GROUP by a.district_id,split_id";
      }
     //Static query for other countries ... ends here
      $res=yii::$app->db2->createCommand($sql)->queryAll();
          $rcnt = count($res);


    // as query result taken in single row below array manipulation has been done to make result in correct array  which is supplies to map,chart,report

          if($europe == 0){

        if($split_tble == 'Age' )// array manipulation
            {



                if(in_array(2, $menu_pop))
                {

                		foreach($destname as $d )
                		{
                  		$a = array_column($res,$d );
                  		//  print_r($a);
                  		$first_names[]=$a;
                		}
                		//print_r($first_names);die;

                		foreach($first_names as $key => $value)
                		{

                    		foreach ($value as $key1 => $value1)
                    		{
                    		array_push($sing_pack, $value1);

                    		}
                		}
                		// print_r($sing_pack);die;

                		for($j=0;$j<count($res);$j++)
                		{

                  		array_push($loc,$res[$j]['location']);
                  		array_push($locId,$res[$j]['loclevel']);
                  		array_push($center,$res[$j]['center']);

                  		for($i=0;$i<count($destname);$i++)
                  		{



                  		array_push($dest,$res[$j][$destname[$i]]);
                  		unset($res[$j][$destname[$i]]);


                  		}

                		}






                		if ($_REQUEST['parentlvl'] == $_REQUEST['childlvl'] )
                		{

                				for($j=0;$j<count($sing_pack);$j++)
                				{
                				for($i=0;$i<count($loc);$i++)
                				{

                				array_push($arr5,$loc[$i]);


                				}


                				}



                				for($j=0;$j<count($sing_pack);$j++)
                				{
                				for($i=0;$i<count($locId);$i++)
                				{
                				array_push($arr7,$locId[$i]);
                				// $res[$j]['center']=$center[$j];


                				}

                				}


                				for($i=0;$i<count($yrln);$i++)
                				{
                				for($j=0;$j<count($loc);$j++)
                				{

                				array_push($arr1,$yrln[$i]);



                				}

                				}

                				for($i=0;$i<count($temp1);$i++)
                				{
                				array_push($arr21, $arr1);
                				}


                				foreach($arr21 as $key => $value  )
                				{

                				foreach ($value as $key1 => $value1) {


                				array_push($new, $value1);
                				}


                				}

                				// print_r($new);die;


                				for($i=0;$i<count($temp1);$i++)
                				{



                				array_push($arr3, $Age[$temp1[$i]]);
                				for($j=0;$j<count($sing_pack)/count($temp1);$j++)
                				{
                				array_push($arr2,$temp1[$i]);


                				}


                				}



                				for($i=0;$i<count($arr3);$i++)
                				{
                				for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                				{
                				array_push($arr6,$arr3[$i]);
                				//array


                				}

                				// $j=$j+$i;
                				}
                				for($j=0;$j<count($sing_pack);$j++)
                				{

                				for($i=0;$i<count($center);$i++)
                				{
                				array_push($arr4,$center[$i]);
                				//array


                				}
                				}



                				for($j=0;$j<count($sing_pack);$j++)
                				{
                				$res[$j]['location']=$arr5[$j];
                				$res[$j]['loclevel']=$arr7[$j];
                				$res[$j]['title']=$arr6[$j];
                				$res[$j]['split_id']=$arr2[$j];
                				$res[$j]['result']=$sing_pack[$j];
                				$res[$j]['period_Y']=$new[$j];


                				$res[$j]['center']=$arr4[$j];
                				}
                		}
                		else if ($_REQUEST['parentlvl'] == 21 &&  $_REQUEST['childlvl'] == 1)
                		{

                						for($j=0;$j<count($sing_pack);$j++)
                						{
                						for($i=0;$i<count($loc);$i++)
                						{

                						array_push($arr5,$loc[$i]);


                						}


                						}



                						for($j=0;$j<count($sing_pack);$j++)
                						{
                						for($i=0;$i<count($locId);$i++)
                						{
                						array_push($arr7,$locId[$i]);
                						// $res[$j]['center']=$center[$j];


                						}

                						}


                						for($i=0;$i<count($yrln);$i++)
                						{
                						for($j=0;$j<count($loc);$j++)
                						{

                						array_push($arr1,$yrln[$i]);



                						}

                						}

                						for($i=0;$i<count($temp1);$i++)
                						{
                						array_push($arr21, $arr1);
                						}


                						foreach($arr21 as $key => $value  )
                						{

                						foreach ($value as $key1 => $value1) {


                						array_push($new, $value1);
                						}


                						}

                						// print_r($new);die;


                						for($i=0;$i<count($temp1);$i++)
                						{



                						array_push($arr3, $Age[$temp1[$i]]);
                						for($j=0;$j<count($sing_pack)/count($temp1);$j++)
                						{
                						array_push($arr2,$temp1[$i]);


                						}


                						}



                						for($i=0;$i<count($arr3);$i++)
                						{
                						for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                						{
                						array_push($arr6,$arr3[$i]);
                						//array


                						}

                						// $j=$j+$i;
                						}
                						for($j=0;$j<count($sing_pack);$j++)
                						{

                						for($i=0;$i<count($center);$i++)
                						{
                						array_push($arr4,$center[$i]);
                						//array


                						}
                						}



                						for($j=0;$j<count($sing_pack);$j++)
                						{
                						$res[$j]['location']=$arr5[$j];
                						$res[$j]['loclevel']=$arr7[$j];
                						$res[$j]['title']=$arr6[$j];
                						$res[$j]['split_id']=$arr2[$j];
                						$res[$j]['result']=$sing_pack[$j];
                						$res[$j]['period_Y']=$new[$j];


                						$res[$j]['center']=$arr4[$j];
                						}
                		}



                		else if($_REQUEST['parentlvl'] != $_REQUEST['childlvl'] )
                		{


                					for($j=0;$j<count($sing_pack);$j++)
                					{
                  					for($i=0;$i<count($loc);$i++)
                  					{

                  				  	array_push($arr5,$loc[$i]);


                  					}


                					}



                					for($j=0;$j<count($sing_pack);$j++)
                					{
                  					for($i=0;$i<count($locId);$i++)
                  					{
                  				  	array_push($arr7,$locId[$i]);
                  					 // $res[$j]['center']=$center[$j];


                  					}

                					}


                					for($i=0;$i<count($yrln);$i++)
                					{
                  					for($j=0;$j<count($loc);$j++)
                  					{


                  					 array_push($arr1,$yrln[$i]);
                  					}

                					}

                					for($i=0;$i<count($condarr2);$i++)
                					{
                					 array_push($arr21, $arr1);
                					}


                					foreach($arr21 as $key => $value  )
                					{

                    					foreach ($value as $key1 => $value1) {


                    					array_push($new, $value1);
                    					}


                					}

                					// print_r($arr1);
                					// print_r($arr21);
                					// die;
                					for($i=0;$i<count($condarr2);$i++)
                					{

                    					//print_r($Age[$condarr[$i]]);


                    					array_push($arr3, $Age[$condarr2[$i]]);
                    					for($j=0;$j<count($sing_pack)/count($condarr2);$j++)
                    					{
                    					array_push($arr2,$condarr2[$i]);


                    					}


                					}

                					//print_r($arr3);

                					for($i=0;$i<count($arr3);$i++)
                					{
                  					for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                  					{
                  					array_push($arr6,$arr3[$i]);
                  					//array


                  					}

                  					// $j=$j+$i;
                					}
                					for($j=0;$j<count($sing_pack);$j++)
                					{

                    					for($i=0;$i<count($center);$i++)
                    					{
                    					array_push($arr4,$center[$i]);
                    					//array


                    					}
                					}



                					for($j=0;$j<count($sing_pack);$j++)
                					{
                    					$res[$j]['location']=$arr5[$j];
                    					$res[$j]['loclevel']=$arr7[$j];
                    					$res[$j]['title']=$arr6[$j];
                    					$res[$j]['split_id']=$arr2[$j];
                    					$res[$j]['result']=$sing_pack[$j];
                    					$res[$j]['period_Y']=$new[$j];


                    					$res[$j]['center']=$arr4[$j];
                					}
                		      //print_r($arr1);

                		}



                  		// print_r($sing_pack);
                  		// print_r($new);



                }
                else
                {



                		foreach($destname as $d )
                		{
                		$a = array_column($res,$d );
                		//  print_r($a);
                		$first_names[]=$a;
                		}
                		//print_r($first_names);die;

                		foreach($first_names as $key => $value)
                		{

                		foreach ($value as $key1 => $value1)
                		{
                		array_push($sing_pack, $value1);

                		}
                		}
                		// print_r($sing_pack);die;

                		for($j=0;$j<count($res);$j++)
                		{

                		array_push($loc,$res[$j]['location']);
                		array_push($locId,$res[$j]['loclevel']);
                		array_push($center,$res[$j]['center']);

                		for($i=0;$i<count($destname);$i++)
                		{



                		array_push($dest,$res[$j][$destname[$i]]);
                		unset($res[$j][$destname[$i]]);


                		}

                		}

                		//print_r($dest);

                		$res=[];


                		if ($_REQUEST['parentlvl'] == $_REQUEST['childlvl'] )
                		{
                          for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($loc);$i++)
                		{

                		array_push($arr5,$loc[$i]);


                		}


                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($locId);$i++)
                		{
                		array_push($arr7,$locId[$i]);
                		// $res[$j]['center']=$center[$j];


                		}

                		}


                		for($i=0;$i<count($yrln);$i++)
                		{
                		for($j=0;$j<count($loc);$j++)
                		{

                		array_push($arr1,$yrln[$i]);



                		}

                		}

                		for($i=0;$i<count($temp1);$i++)
                		{
                		array_push($arr21, $arr1);
                		}


                		foreach($arr21 as $key => $value  )
                		{

                		foreach ($value as $key1 => $value1) {


                		array_push($new, $value1);
                		}


                		}

                		// print_r($new);die;


                		for($i=0;$i<count($temp1);$i++)
                		{



                		array_push($arr3, $Age[$temp1[$i]]);
                		for($j=0;$j<count($sing_pack)/count($temp1);$j++)
                		{
                		array_push($arr2,$temp1[$i]);


                		}


                		}



                		for($i=0;$i<count($arr3);$i++)
                		{
                		for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                		{
                		array_push($arr6,$arr3[$i]);
                		//array


                		}

                		// $j=$j+$i;
                		}
                		for($j=0;$j<count($sing_pack);$j++)
                		{

                		for($i=0;$i<count($center);$i++)
                		{
                		array_push($arr4,$center[$i]);
                		//array


                		}
                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		$res[$j]['location']=$arr5[$j];
                		$res[$j]['loclevel']=$arr7[$j];
                		$res[$j]['title']=$arr6[$j];
                		$res[$j]['split_id']=$arr2[$j];
                		$res[$j]['result']=$sing_pack[$j];
                		$res[$j]['period_Y']=$new[$j];


                		$res[$j]['center']=$arr4[$j];
                		}


                		}
                		else if  ($_REQUEST['parentlvl'] == 21 && $_REQUEST['childlvl'] ==1)
                		{
                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($loc);$i++)
                		{

                		array_push($arr5,$loc[$i]);


                		}


                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($locId);$i++)
                		{
                		array_push($arr7,$locId[$i]);
                		// $res[$j]['center']=$center[$j];


                		}

                		}


                		for($i=0;$i<count($yrln);$i++)
                		{
                		for($j=0;$j<count($loc);$j++)
                		{

                		array_push($arr1,$yrln[$i]);



                		}

                		}

                		for($i=0;$i<count($temp1);$i++)
                		{
                		array_push($arr21, $arr1);
                		}


                		foreach($arr21 as $key => $value  )
                		{

                		foreach ($value as $key1 => $value1) {


                		array_push($new, $value1);
                		}


                		}

                		// print_r($new);die;


                		for($i=0;$i<count($temp1);$i++)
                		{



                		array_push($arr3, $Age[$temp1[$i]]);
                		for($j=0;$j<count($sing_pack)/count($temp1);$j++)
                		{
                		array_push($arr2,$temp1[$i]);


                		}


                		}



                		for($i=0;$i<count($arr3);$i++)
                		{
                		for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                		{
                		array_push($arr6,$arr3[$i]);
                		//array


                		}

                		// $j=$j+$i;
                		}
                		for($j=0;$j<count($sing_pack);$j++)
                		{

                		for($i=0;$i<count($center);$i++)
                		{
                		array_push($arr4,$center[$i]);
                		//array


                		}
                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		$res[$j]['location']=$arr5[$j];
                		$res[$j]['loclevel']=$arr7[$j];
                		$res[$j]['title']=$arr6[$j];
                		$res[$j]['split_id']=$arr2[$j];
                		$res[$j]['result']=$sing_pack[$j];
                		$res[$j]['period_Y']=$new[$j];


                		$res[$j]['center']=$arr4[$j];
                		}
                		}



                		else if($_REQUEST['parentlvl'] != $_REQUEST['childlvl'] )
                		{


                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($loc);$i++)
                		{

                		array_push($arr5,$loc[$i]);


                		}


                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		for($i=0;$i<count($locId);$i++)
                		{
                		array_push($arr7,$locId[$i]);
                		// $res[$j]['center']=$center[$j];


                		}

                		}


                		for($i=0;$i<count($yrln);$i++)
                		{
                		for($j=0;$j<count($loc);$j++)
                		{

                		array_push($arr1,$yrln[$i]);



                		}

                		}

                		for($i=0;$i<count($temp1);$i++)
                		{
                		array_push($arr21, $arr1);
                		}


                		foreach($arr21 as $key => $value  )
                		{

                		foreach ($value as $key1 => $value1) {


                		array_push($new, $value1);
                		}


                		}

                		// print_r($new);die;


                		for($i=0;$i<count($temp1);$i++)
                		{



                		array_push($arr3, $Age[$temp1[$i]]);
                		for($j=0;$j<count($sing_pack)/count($temp1);$j++)
                		{
                		array_push($arr2,$temp1[$i]);


                		}


                		}



                		for($i=0;$i<count($arr3);$i++)
                		{
                		for($j=0;$j<count($sing_pack)/count($arr3);$j++)
                		{
                		array_push($arr6,$arr3[$i]);
                		//array


                		}

                		// $j=$j+$i;
                		}
                		for($j=0;$j<count($sing_pack);$j++)
                		{

                		for($i=0;$i<count($center);$i++)
                		{
                		array_push($arr4,$center[$i]);
                		//array


                		}
                		}



                		for($j=0;$j<count($sing_pack);$j++)
                		{
                		$res[$j]['location']=$arr5[$j];
                		$res[$j]['loclevel']=$arr7[$j];
                		$res[$j]['title']=$arr6[$j];
                		$res[$j]['split_id']=$arr2[$j];
                		$res[$j]['result']=$sing_pack[$j];
                		$res[$j]['period_Y']=$new[$j];


                		$res[$j]['center']=$arr4[$j];
                		}
                		//     print_r($new);
                		 // print_r($res);die;

                		}

                }

            }
          }





          $tablestr="";
          $timelinedata = array();
          $period = $_REQUEST['year'];
          $periods = explode(",",$period);
          if(count($periods) > 1)  //Timeseries
          {
              $firstperiod= 0;
              $lastperiod=0;
              if($_REQUEST['view'] == 3)
              {
                $firstperiod = $perioddata[0];
                $lastperiod=$perioddata[(count($perioddata)-1)];
              }





                if(!isset($_REQUEST['filter']))
                {
                  // ini_set(varname, newvalue)

                  $resarray = array();
                  $locations_ids = array();
                  $items_id = array();
                  $locationsnme = array();
                  $locres = array();
                  $itemdts = array();
                  foreach($res as $key=>$value)
                  {
                    // $locations_ids.push($value['loclevel']);
                    array_push($locations_ids,$value['loclevel']);
                    array_push($items_id,$value['split_id']);
                    array_push($itemdts,$value['split_id']."/".$value['title']);
                    $locationsnme[$value['loclevel']] = $value['location'];
                    $locres[$value['loclevel']][$value['period_Y']] = $locres[$value['loclevel']][$value['period_Y']] + $value['result'];
                    $value['result'] = number_format($value['result'],2);
                    $resarray[$value['loclevel']][$value['period_Y']][$value['split_id']] = $value;
                  }

                  $resarray = json_encode($resarray);
                  $locations_ids = array_unique($locations_ids);
                   $locations_ids = array_values($locations_ids);
                  $items_id = array_unique($items_id);
                  // print_r($resarray);die;
                  $allitemids =  implode(",",$items_id);
                  $itemdts = array_unique($itemdts);
                  $itemdts = array_values($itemdts);
                  $itemdts = json_encode($itemdts);

                  $l=0;
                  $r=0;


                  $columspan = 3+(int)(count($perioddata));
                  $tablestr.="<table id='example2'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                  $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."' >".$tabletitle[$_REQUEST['tbl']]." ".$part." (Rs.)</th></tr>
                  <tr>";
                  $tablestr .="<th>&nbsp;</th>";
                  $tablestr .="<th>Location</th>";

                   if($_REQUEST['view'] != 0 && $_REQUEST['view'] != 5)
                   {
                      for($h=0;$h<count($perioddata);$h++)
                      {
                      $tablestr .="<th>".$perioddata[$h]."</th>";
                      }
                      if($_REQUEST['view'] == 3)
                      {
                       $tablestr.="<th>Growth</th>";
                      }
                      else
                      {
                      $tablestr.="<th>Total for Select Period</th>";
                      }
                    }
                    else
                    {
                      // perioddata
                       //$tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
                      $tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
                    }
                   $tablestr .="</tr></thead> <tbody>";

                    if (count($res) > 0)
                    {


                      $total_result = 0;

                      for($j=0;$j<count($locations_ids);$j++)
                      {
                        $tablestr .= "<tr id='".$locations_ids[$j]."' level='".$_REQUEST['level']."'>";
                        $tablestr .= "<td  class='details-control' count='".$locations_ids[$j]."' splitids = '".$allitemids."' level='".$_REQUEST['level']."'></td>";
                        $tablestr .= "<td>".$locationsnme[$locations_ids[$j]]."</td>";
                        $totalsumperiod = 0;
                        for($k=0;$k<count($perioddata);$k++)
                        {
                          if( $locres[$locations_ids[$j]] != 0)
                          {
                            // $locres[$locations_ids[$j]][$perids[$k]]


                            if($perioddata[$k] == $firstperiod)
                            {
                            $firstval = $locres[$locations_ids[$j]][$perioddata[$k]];
                            }
                            if($perioddata[$k] == $lastperiod)
                            {
                            $lastval = $locres[$locations_ids[$j]][$perioddata[$k]];
                            }
                                if($_REQUEST['view'] != 0 && $_REQUEST['view'] != 5){

                              if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                              {
                                 $tablestr .= "<td align = 'right'>".number_format( $locres[$locations_ids[$j]][$perioddata[$k]], 0 )."</td>";
                              }
                              else
                              {
                                  $amountIND = round( $locres[$locations_ids[$j]][$perioddata[$k]],2);//'1000003.400050'; '283688411.50';//
                                  $amt = explode(".",$amountIND);
                                  $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                                  // print_r($amountIND); die;
                                  if(isset($amt[1]))
                                  {
                                    $amountIND = $amountIND.".".$amt[1];
                                  }
                                  $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                                   // $tablestr .= "<td align = 'right'>".number_format( $locres[$locations_ids[$j]][$perioddata[$k]], 2 )."</td>";
                              }



                            }
                            if($_REQUEST['view'] != 3){
                            $totalsumperiod = $totalsumperiod + floatval($locres[$locations_ids[$j]][$perioddata[$k]]);}


                          }

                        }
                        if($_REQUEST['view'] == 3)
                        {
                          $growthrate = (($lastval-$firstval)/$firstval)*100;
                          $tablestr.="<td  align = 'right'>".number_format($growthrate,2)."%</td>";
                        }
                        else
                        {


                            $amountIND = round($totalsumperiod,2);//'1000003.400050'; '283688411.50';//
                            $amt = explode(".",$amountIND);
                            $amountIND = moneyFormatIndia( $amt[0] );

                             $tablestr .= "<td align = 'right'>".$amountIND."</td>";
                            $totalsumperiod=0;
                        }

                        $tablestr .= "</tr>";
                      }


                    }



                   $tablestr .="</tbody></table>";
                   $tablestr.="<script>splititems = $resarray; splitarray = JSON.stringify(splititems); itemdetails = $itemdts;itemobj = JSON.stringify(itemdetails);</script>";
                }
                else
                {
                      $tablestr .="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                      $tablestr .='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
                      $tablestr .="<tbody>";

                      if (count($res) > 0)
                      {
                      for($k=0;$k<count($res);$k++)
                      {
                      $tablestr .="<tr id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                      $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$res[$k]['loclevel']."'></td> <td> ".$res[$k]['location']."</td>";
                      $tablestr .= "</tr>";
                      }
                      }
                      $tablestr .="</tbody></table>";
                }

          }
          else
          {

            $resarray = array();
            $locations_ids = array();
            $items_id = array();
            $locationsnme = array();
            $locres = array();
             $itemdts = array();
            foreach($res as $key=>$value)
                  {
                    // $locations_ids.push($value['loclevel']);
                    array_push($locations_ids,$value['loclevel']);
                     array_push($itemdts,$value['split_id']."/".$value['title']);
                    $locationsnme[$value['loclevel']] = $value['location'];
                    $locres[$value['loclevel']] = $locres[$value['loclevel']] + $value['result'];
                    // $value['result'] = number_format($value['result'],2);
                    // if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                    // {
                    //   $value['result'] = number_format($value['result'],0);
                    // }
                    // else
                    // {
                      $value['result'] = number_format($value['result'],2);
                    //}

                    $resarray[$value['period_Y']][$value['loclevel']][$value['split_id']] = $value;
                  }
                  // die;

                   // print_r($resarray);
                   // die;
                  $resarray = json_encode($resarray);
                  $locations_ids = array_unique($locations_ids);
                   $locations_ids = array_values($locations_ids);
                  $items_id = array_unique($items_id);
                  // print_r($items_id);die;
                    $itemdts = array_unique($itemdts);
                  $itemdts = array_values($itemdts);
                  $itemdts = json_encode($itemdts);


              if($comb==0) {
              $title2 = "Values";
              } else {
              $title2 = "Count";
              }
                  $contribut_tot = 0;
                foreach ($res as $item) {
                $contribut_tot += $item['result'];
                }
              if(!isset($_REQUEST['filter']))
              {
                $tablestr.="<table id='example2'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                $tablestr .="<thead><tr>";//<tr><th colspan='3' >Detailed Report</th></tr>
                $tablestr .="<th>&nbsp;</th>";
                $countingi=0;
                $titleval = '';

                for($i=0;$i<count($res);$i++)
                {
                  foreach($res[$i] as $key=>$value)
                  {
                  // echo $key;
                  if($countingi==0)
                  {
                  // echo $key; die;
                    if($key != 'loclevel')
                    {
                      $titleval= $part;
                      $tablestr .="<th>".ucfirst($key)."</th>";
                      if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                      {
                        $tablestr .="<th align = 'center'>".$part." Retailers (Nos.)</th>";
                      }
                      else
                      {
                          $tablestr .="<th align = 'center'>".$part." Population (Rs.)</th>";
                      }
                      $tablestr .="<th align = 'center'>Contrbtn Share(%)</th>";
                    }

                  }
                  $countingi++;
                  }
                  // die;
                }
                $tablestr .="</tr>
                </thead> <tbody>";
                // echo $tablestr;die;

                if (count($res) > 0)
                {

                  for($k=0;$k<count($perids);$k++)
                  {
                    $total_result = 0;
                      for($j=0;$j<count($locations_ids);$j++)
                      {
                        if( $locres[$locations_ids[$j]] != 0){
                          $tablestr .= "<tr id='".$locations_ids[$j]."' level='".$_REQUEST['level']."'>";
                          $tablestr .= "<td  class='details-control' count='".$locations_ids[$j]."' splitids = '' level='".$_REQUEST['level']."'></td>";
                          $tablestr .= "<td>".$locationsnme[$locations_ids[$j]]."</td>";

                           if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                              {
                                 $tablestr .= "<td align = 'right'>".number_format( $locres[$locations_ids[$j]], 0 )."</td>";

                              }
                              else
                              {

                                   $amountIND = round($locres[$locations_ids[$j]],2);//'1000003.400050'; '283688411.50';//
                                    $amt = explode(".",$amountIND);
                                    $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                                    // print_r($amountIND); die;
                                    if(isset($amt[1]))
                                    {
                                    $amountIND = $amountIND.".".$amt[1];
                                    }
                                       $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                                    $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format(($locres[$locations_ids[$j]]/$contribut_tot)*100,2)."</td>";
                                  //$tablestr .= "<td align = 'right'>".number_format( $locres[$locations_ids[$j]], 2 )."</td>";
                              }

                          $tablestr .= "</tr>";
                        }

                      }
                  }


                }
                $tablestr .="</tbody></table>";
                $tablestr.="<script>splititems = $resarray; splitarray = JSON.stringify(splititems); itemdetails = $itemdts;itemobj = JSON.stringify(itemdetails);</script>";
                // temdetails = $itemdts;itemobj = JSON.stringify(itemdetails);
                // localStorage.setItem('splitdts',JSON.stringify(splititems)); console.log(localStorage.getItem('splitdts'))
              }
              else
              {
                $tablestr .="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                $tablestr .='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
                $tablestr .="<tbody>";

                if (count($res) > 0)
                {
                for($k=0;$k<count($res);$k++)
                {
                $tablestr .="<tr id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$res[$k]['loclevel']."'></td> <td> ".$res[$k]['location']."</td>";
                $tablestr .= "</tr>";
                }
                }
                $tablestr .="</tbody></table>";


              }
          }
          // print_r($tablestr);die;
          // die;
    //         $category=explode("_",$_REQUEST['categs']);
    // $relatedid=implode(",",$category);
            array_push($final_resul_arry, $tablestr);
            //print_r($res);print_r($view_optnc);print_r($perioddata);print_r($relatedid);print_r($split_tble);
              $grp = graphwrk_split($res,$view_optnc, $perioddata,$relatedid,$split_tble);
// print_r($grp);die;
              if($_REQUEST['view'] == 0 || $_REQUEST['view'] == 5 || $_REQUEST['view'] == 1 || $_REQUEST['view'] == 2)
              {
                $colorarr = $grp[1];
                $grp = $grp[0];
              }
              array_push($final_resul_arry, $grp);
              $mapwrk = mapwrk_split($res,$retail,$periods,$view_optnc);
              // print_r($mapwrk);
              // print_r($colorarr);die;
              if($_REQUEST['view'] !=3)
              {
                if($_REQUEST['view'] == 0 || $_REQUEST['view'] == 5 || $_REQUEST['view'] == 1 || $_REQUEST['view'] == 2) //|| $_REQUEST['view'] == 1 || $_REQUEST['view'] == 2
                {
                $mapwrkk = array();
                foreach ($mapwrk as $key => $value) {


                  foreach ($value as $key1=> $value1) {

                    $value1['colr'] = $colorarr[$key1];
                    $mapwrkk[$key][$key1] = $value1;
                    // print_r($value1);//die;
                  }
                }
                $mapwrk = $mapwrkk;
                mapwrk_svg($mapwrk,$colorarr);
                }
              }
              // print_r($res);
              // print_r($mapwrk);die;
              array_push($final_resul_arry, $mapwrk);
              array_push($final_resul_arry,count($perioddata));
              array_push($final_resul_arry,'(Rs.)');
               array_push($final_resul_arry,json_encode($colorarr));
           

              if($_REQUEST['view'] == 0 || $_REQUEST['view'] == 5)
              {
                array_push($final_resul_arry,json_encode($colorarr));
              }
                 array_push($final_resul_arry,$label);//reading
                array_push($final_resul_arry,1);//sort order

}


function mapwrk_svg($mapwrk,$colorarr)
{
    // if($_REQUEST['childlvl'] == '7')
    // {
    //   print_r($mapwrk);die;
    // }
    // print_r($mapwrk);die;
    $filename = '';
    $replicfile = '';



      $mainlocation = $_REQUEST['parentlvl'];
      $selectedlocation = $_REQUEST['id'];
      $sublocation = $_REQUEST['childlvl'];
 
   
        if($mainlocation==$sublocation)
        {


                if($_REQUEST['parentlvl'] == '21')
                {
                  $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                  $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";


                }
                else
                {
          $sql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;
          
          $res=yii::$app->db->createCommand($sql)->queryOne();
          // print_r($res);die;
          $yu=($res['master_table']=='country_master') ? 'refid ' : 'country_id';




          $sql2="select ".$yu." as country_id,center_coordinates from ".$res['master_table']." where refid=".$selectedlocation;
          $res2=yii::$app->db->createCommand($sql2)->queryOne();
          // print_r($sql2);
          // die;
     

                if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
                {
                  $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                  $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
                }
                else
                {
                  $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                  $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
                }
               }

        }
        else
        {
            // if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
            // {
            //   $res['master_table'] = 'city_master';
            // }
          
                if($_REQUEST['parentlvl'] == '21')
                {
                $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";


                }
            else
            {
               $sql="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
                $res=yii::$app->db->createCommand($sql)->queryOne();
            

             
              if($res['master_table']=="world_master" )
              {
              $yt="refid";
              }else if($res['master_table']=="country_master" )
              {
              $yt ="refid " ;
              } else
              {
              $yt="country_id";
              }
               $prevsql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;

              $preres=yii::$app->db->createCommand($prevsql)->queryOne();

              $prevtbl=$preres['master_table'];
              $text = str_replace('master', 'id', $prevtbl);
                // {
   $sql2="select ".$yt." as country_id,center_coordinates from ".$res['master_table']."   where ".$text."=".$selectedlocation;
                // if($_REQUEST['parentlvl']==5 && $_REQUEST['childlvl']==7)
                // {
                //           $sql2="select ".$yt." as country_id,center_coordinates from ".$res['master_table']." where country_id=".$selectedlocation; 
                // }
                // else
                // {
                //            $sql2="select ".$yt." as country_id,center_coordinates from ".$res['master_table']." where refid=".$selectedlocation;
                // }
 
          $res2=yii::$app->db->createCommand($sql2)->queryOne();
         // print_r($sql2);die;
           
               //   $sql331="select ".$yt." from ".$res['master_table']."  where ".$yt." =".$selectedlocation;
               // $res331=yii::$app->db->createCommand($sql331)->queryOne();
             //   $rtt="select country_id from map_level where main_location =5 and sub_location =7 " ;	
             //   $rtr=yii::$app->db->createCommand($rtt)->queryOne();

                                     
             //                         //print_r($rtr['country_id']);die;
             // $sql33="select ".$yt." from ".$res['master_table']."  where ".$yt." =".$rtr['country_id'];
             //   $res33=yii::$app->db->createCommand($sql33)->queryOne();

             //  $sql2="select refid,location_name,".$yt." from ".$res['master_table']." where ".$yt."=".$res33[$yt];
             //  // print_r($sql33);die; 
             //  $res2=yii::$app->db->createCommand($sql2)->queryOne();



                 if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
                {
                $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
                }
                else
                {
                $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

                $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
                }
               }


        }
     // print_r($replicsvgfilen);die;
      
      // print_r($res2);die;



      // if($_REQUEST['parentlvl'] == '21')
      // {
      //   $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

      //   $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      
            
      // }
      // else if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
      // {
      //       $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

      //   $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/73---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      // }
      // else
      // {
      //   $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

      //   $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      // }

      

      // print_r($svgfilen);
        // print_r($replicsvgfilen);die;

    // $svgfilen = $_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl'].".svg";
    // $replicsvgfilen = $_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
    // print_r($replicsvgfilen);die;
    $totsvg = file_get_contents($svgfilen);
    //  print_r($svgfilen);//die;
    // print_r($replicsvgfilen);//die;
    // print_r($mapwrk);die;
    foreach ($mapwrk as $key => $value) {
      # code...
          $valuearr = '';
          // usort($value, function($a, $b) {
          // return $b['value'] - $a['value'];
          // });
          //12-805~~35-400~~98-1300~~18-300~~8-200~~198-813
        $valcnt = 0;
        $clnew = array();
        $array_order = array();
          foreach ($value as $key1 => $value1)
          {

            if($valcnt <=9)
            {
              $valuearr = $valuearr.''.$key1.'-'.$value1['value'].'~~';
              // $clnew.push(getsplitcolourchart($valcnt));
              // $clnew[$key1] = getsplitcolourchart($valcnt);
              // .push();

              array_push($array_order,$key1);
              array_push($clnew,getsplitcolourchart($valcnt));
              $valcnt++;
            }
            // print_r($value1);die;
          }
         $array_order = array_reverse($array_order);
         $clnew = array_reverse($clnew);
          // print_r($array_order);
          // print_r($clnew);
          // die;
          $totsvg = fillcolor_insvg($valuearr,$clnew,$array_order,$filename,$replicfile,$key,$totsvg,$colorarr);
          // print_r($totsvg);die;
          // echo http_build_query($value,'',', ');die;

    }

    // print_r($totsvg);die;
    //     $svgstr = '&lt;defs&gt;
    // &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';
       // $svgstr = '<defs>
       //    <linearGradient id="solids'.$1.'" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(0, 0, 0);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(0, 0, 0);stop-opacity:1">';



        // if($_REQUEST['childlvl'] == 7){
         // $pattern = '/\~\~\~\~\~MARK([0-9]+)\~\~\~\~\~/m';
         // $replacement = '';
    //         $svgstr = '&lt;defs&gt;
    // &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';
          $totsvg = preg_replace('/\~\~\~\~\~([A-z])+([0-9]+)\~\~\~\~\~/m', '<defs>
    <linearGradient id="solids$2" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(255, 255, 255);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(255, 255, 255);stop-opacity:1"/></linearGradient > </defs >', $totsvg);
          // $totsvg1 = str_replace("&lt;","<",$totsvg);
          //  $totsvg = str_replace("&gt;",">",$totsvg1);

        // print_r($totsvg);die;
        // }
          // print_r("expressio1n");die;
      // if($_REQUEST['id'] == '14878' && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
      //  {
      //     // print_r($replicsvgfilen);die;
      //    $replicsvgfilen =  str_replace("//","/",$replicsvgfilen);
      //    print_r($replicsvgfilen);die;
      //  }
          // print_r($totsvg);//die;
          //print_r($replicsvgfilen);die;
        $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");

        fwrite($myfile, "\n". $totsvg);
        fclose($myfile);

       
        // print_r($replicsvgfilen);
        // print_r($totsvg);die;
     // if($_REQUEST['childlvl'] == '7')
     // {
     //   print_r($totsvg);die;
     // }


    // echo preg_replace($pattern, $replacement, $string);
    // getsplitcolourchart
    // print_r($mapwrk);die;

        //   $pattern = '/\~\~\~\~\~MARK[0-9]+\~\~\~\~\~/g';
        //   $replacement = '';
        // $replicsvgfilen = $_REQUEST['id']."_".$_REQUEST['parentlvl']."_".$_REQUEST['childlvl']."_a.svg";
        // $content = file_get_contents($replicsvgfilen);
        // // print_r($content);die;
        // $content = preg_replace($pattern, $replacement, $content);
        // file_put_contents($replicsvgfilen, $content);


        // $pattern = '/\~\~\~\~\~MARK[0-9]+\~\~\~\~\~/g';
        // $replacement = '';
        // $replicsvgfilen = $_REQUEST['id']."_".$_REQUEST['parentlvl']."_".$_REQUEST['childlvl']."_a.svg";
        // $content = file_get_contents($replicsvgfilen);
        // // print_r($content);die;
        // $content = preg_replace($pattern, $replacement, $content);
        // if($content != ''){
        // print_r($content);die;

        // $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
        // fwrite($myfile,$content);
        // //print_r($myfile);
        // fclose($myfile);}
}



    function getsplitcolourhex($d)
    {
      switch ($d) {
      case 0: return '#F30C0C';
      case 1: return '#1B6807';
      case 2: return '#0000FF';
      case 3: return '#116CDF';
      case 4: return '#AC7507';
      case 5: return '#E2F00D';
      case 6: return '#4F540C';
      case 7: return '#540C0D';
      case 8: return '#0C544E';
      case 9: return '#650C75';

      // default: return 'rgb(183, 126, 223)';
      }
    }


// function fillcolor_insvg($values,$cc,$arord,$filename,$replicfile,$locid,$totsvg,$colorarr)
// {


//     // $values = $_GET['values']; //~~
//     //index2.php?values=12-805~~35-400~~98-1300~~18-300~~8-200~~198-1500~~121-1500~~91-100~~92-685~~15-500
//     // $msar = array(12=>"Tea", 35=>"Coffee", 98=>"Cool Drinks", 18=>"Biscuits", 8=>"Cholcalotes", 198=>"Wafers", 121=>"Ice Creams", 15=>"Puffs", 91=>"Bakery Items", 92=>"Snacks");
//     $values = rtrim($values,"~~ ");
//     $vals = explode("~~",$values);
//     // print_r($vals);die;
//     $catgry = count($vals);
//     // print_r($catgry);die;
//     foreach($vals as $val3) {
//     list($ids,$val) = explode("-",$val3);
//     $percnt[$ids] = $val;
//     }


//     foreach($percnt as $k1=>$val5) {
//     //echo $k1 . ' <<<==== ' . $val5 . "</br>";
//     $aaa[$k1] = sprintf('%0.1f', round(($val5*100 / array_sum($percnt))));
//     }

//     asort($aaa);

//     foreach($aaa as $bb=>$x) {
//     // echo $bb . ' ====>> ' . $x . "</br>";
//     $bbb[] = $bb;

//     }
//     // print_r($colorarr);
//     // print_r($bbb);die;
//     // $cc[0] = 'rgb(243, 12, 12)';//#F30C0C
//     // $cc[1] = 'rgb(27, 104, 7)';//#1B6807
//     // $cc[2] = 'rgb(0, 0, 255)';//#0000FF
//     // $cc[3] = 'rgb(17, 108, 223)';//#116CDF
//     // $cc[4] = 'rgb(172, 117, 7)';//#AC7507
//     // $cc[5] = 'rgb(226, 240, 13)';//#E2F00D
//     // $cc[6] = 'rgb(79, 84, 12)';//#4F540C
//     // $cc[7] = 'rgb(84, 12, 13)';//#540C0D
//     // $cc[8] = 'rgb(12, 84, 78)';//#0C544E
//     // $cc[9] = 'rgb(101, 12, 117 )';//#650C75
//     // $cc_hex[0] = '#F30C0C';
//     // $cc_hex[1] = '#1B6807';
//     // $cc_hex[2] = '#0000FF';
//     // $cc_hex[3] = '#116CDF';
//     // $cc_hex[4] = '#AC7507';
//     // $cc_hex[5] = '#E2F00D';
//     // $cc_hex[6] = '#4F540C';
//     // $cc_hex[7] = '#540C0D';
//     // $cc_hex[8] = '#0C544E';
//     // $cc_hex[9] = '#650C75';


//     // echo $catgry . "<pre>";
//     // print_r($aaa);
//     // print_r($bbb);
//     // print_r($msar);
//     // echo "</pre>";

//     // exit;

//     $colr = array();
//     $clrarry = '';
//     $svgstr = '&lt;defs&gt;
//     &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';


//     if($catgry==1) {

//     $p1 = $aaa[$bbb[0]];

//     //$cc[0] = 'rgb(243,12,12)'; //#CC3300
//     // $cc[1] = 'rgb(84,12,13)';//#001E99
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     //$cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#001E99';
//     // $cc_hex[2] = '#e2f00d';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);


//       $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//       &lt;stop offset="100%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;';

//     } elseif($catgry==2) {

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     // print_r($cc);die;
//     // $cc[0] = 'rgb(243,12,12)'; //#CC3300
//     // $cc[1] = 'rgb(84,12,13)';//#001E99
//     // // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;';
//     // print_r($svgstr);die;

//     } elseif($catgry==3) {

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];



//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     $cc[2]=$colorarr[$bbb[2]];
//     // $colr[$bbb[0]]='rgb(243,12,12)';
//     // $colr[$bbb[1]]='rgb(84,12,13)';
//     // $colr[$bbb[2]]='rgb(226,240,13)';

//     // $cc[0] = 'rgb(243,12,12)'; //#CC3300
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;';
//     // print_r($colr);die;
//     } elseif($catgry==4) {

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];

//       $cc[0] = $colorarr[$bbb[0]];
//       $cc[1]=$colorarr[$bbb[1]];
//       $cc[2]=$colorarr[$bbb[2]];
//       $cc[3]=$colorarr[$bbb[3]];


//     // $cc[0] = 'rgb(243,12,12)'; //#CC3300
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);







//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p3.'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p3.'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p4.'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;';

//     } elseif($catgry==5) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];



//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     $cc[2]=$colorarr[$bbb[2]];
//     $cc[3]=$colorarr[$bbb[3]];
//     $cc[4]=$colorarr[$bbb[4]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);






//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;';

//     }
//     elseif($catgry==6) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
//     $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];



//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     $cc[2]=$colorarr[$bbb[2]];
//     $cc[3]=$colorarr[$bbb[3]];
//     $cc[4]=$colorarr[$bbb[4]];
//     $cc[5]=$colorarr[$bbb[5]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc[5] = 'rgb(124,181,236)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     // $cc_hex[5]  ='#7cb5ec';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     // print_r($clrarry);die;
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;';
//     // print_r($svgstr);die;
//     }
//     elseif($catgry==7) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
//     $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
//     $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];


//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     $cc[2]=$colorarr[$bbb[2]];
//     $cc[3]=$colorarr[$bbb[3]];
//     $cc[4]=$colorarr[$bbb[4]];
//     $cc[5]=$colorarr[$bbb[5]];
//     $cc[6]=$colorarr[$bbb[6]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc[5] = 'rgb(124,181,236)';
//     // $cc[6] = 'rgb(172,117,7)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     // $cc_hex[5]  ='#7cb5ec';
//     // $cc_hex[6]  ='#ac7507';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;';
//     // print_r($svgstr);die;
//     }
//     elseif($catgry==8) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
//     $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
//     $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
//     $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];

//     $cc[0] = $colorarr[$bbb[0]];
//     $cc[1]=$colorarr[$bbb[1]];
//     $cc[2]=$colorarr[$bbb[2]];
//     $cc[3]=$colorarr[$bbb[3]];
//     $cc[4]=$colorarr[$bbb[4]];
//     $cc[5]=$colorarr[$bbb[5]];
//     $cc[6]=$colorarr[$bbb[6]];
//     $cc[7]=$colorarr[$bbb[7]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc[5] = 'rgb(124,181,236)';
//     // $cc[6] = 'rgb(172,117,7)';
//     // $cc[7] = 'rgb(27,104,7)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     // $cc_hex[5]  ='#7cb5ec';
//     // $cc_hex[6]  ='#ac7507';
//     // $cc_hex[7]  ='#1b6807';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);

//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;';
//     // print_r($colr);
//     // print_r($svgstr);die;
//     }
//     elseif($catgry==9) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
//     $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
//     $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
//     $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];
//     $p9 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]];


//         $cc[0] = $colorarr[$bbb[0]];
//         $cc[1]=$colorarr[$bbb[1]];
//         $cc[2]=$colorarr[$bbb[2]];
//         $cc[3]=$colorarr[$bbb[3]];
//         $cc[4]=$colorarr[$bbb[4]];
//         $cc[5]=$colorarr[$bbb[5]];
//         $cc[6]=$colorarr[$bbb[7]];
//         $cc[7]=$colorarr[$bbb[6]];
//         $cc[8]=$colorarr[$bbb[8]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc[5] = 'rgb(124,181,236)';
//     // $cc[6] = 'rgb(172,117,7)';
//     // $cc[7] = 'rgb(27,104,7)';
//     // $cc[8] = 'rgb(67,67,72)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     // $cc_hex[5]  ='#7cb5ec';
//     // $cc_hex[6]  ='#ac7507';
//     // $cc_hex[7]  ='#1b6807';
//     // $cc_hex[8]  ='#434348';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;\
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;';
//     // print_r($svgstr);die;
//     }
//     elseif($catgry==10) {
//     //echo "Yessssssssssss";

//     $p1 = $aaa[$bbb[0]];
//     $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
//     $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
//     $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
//     $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
//     $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
//     $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
//     $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];
//     $p9 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]];
//     $p10 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]]+$aaa[$bbb[9]];
//         // print_r($colorarr);
//         // print_r($bbb);die;
//        $cc[0] = $colorarr[$bbb[0]];
//         $cc[1]=$colorarr[$bbb[1]];
//         $cc[2]=$colorarr[$bbb[2]];
//         $cc[3]=$colorarr[$bbb[3]];
//         $cc[4]=$colorarr[$bbb[4]];
//         $cc[5]=$colorarr[$bbb[5]];
//         $cc[6]=$colorarr[$bbb[6]];
//         $cc[7]=$colorarr[$bbb[7]];
//         $cc[8]=$colorarr[$bbb[8]];
//         $cc[9]=$colorarr[$bbb[9]];
//     // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
//     // $cc[1] = 'rgb(84,12,13)';//#540c0d
//     // $cc[2] = 'rgb(226,240,13)';//#e2f00d
//     // $cc[3] = 'rgb(0,0,255)';
//     // $cc[4] = 'rgb(12,84,78)';
//     // $cc[5] = 'rgb(124,181,236)';
//     // $cc[6] = 'rgb(172,117,7)';
//     // $cc[7] = 'rgb(27,104,7)';
//     // $cc[8] = 'rgb(67,67,72)';
//     // $cc[9] = 'rgb(144,237,125)';
//     // $cc_hex[0] = '#f30c0c';
//     // $cc_hex[1] = '#540c0d';
//     // $cc_hex[2] = '#e2f00d';
//     // $cc_hex[3] = '#0000ff';
//     // $cc_hex[4]  ='#0c544e';
//     // $cc_hex[5]  ='#7cb5ec';
//     // $cc_hex[6]  ='#ac7507';
//     // $cc_hex[7]  ='#1b6807';
//     // $cc_hex[8]  ='#434348';
//     // $cc_hex[9]  ='#90ed7d';
//     asort($aaa);
//     // print_r($aaa);die;
//     $cls = 0;
//     foreach ($aaa as $key => $value) {
//     # code...
//     $colr[$key] = $cc_hex[$cls];
//     $cls++;
//     }
//     $clrarry = implode(",",$colr);
//     $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
//     &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[9].';stop-opacity:1" /&gt;
//     &lt;stop offset="'. $p10 .'%" style="stop-color:'.$cc[9].';stop-opacity:1" /&gt;';
//     // print_r($svgstr);die;
//     }
//     $svgstr .= '&lt;/linearGradient &gt; &lt;/defs &gt;';
//     // $svgstr = '<defs> <linearGradient id="solids" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /> <stop offset="1.0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /> <stop offset="1.0%" style="stop-color:rgb(84,12,13);stop-opacity:1" /> <stop offset="4%" style="stop-color:rgb(84,12,13);stop-opacity:1" /> <stop offset="4%" style="stop-color:rgb(50,50,50);stop-opacity:1" /> <stop offset="8%" style="stop-color:rgb(50,50,50);stop-opacity:1" /> <stop offset="8%" style="stop-color:rgb(0,0,255);stop-opacity:1" /> <stop offset="13%" style="stop-color:rgb(0,0,255);stop-opacity:1" /> <stop offset="13%" style="stop-color:rgb(12,84,78);stop-opacity:1" /> <stop offset="20%" style="stop-color:rgb(12,84,78);stop-opacity:1" /> <stop offset="20%" style="stop-color:rgb(124,181,236);stop-opacity:1" /> <stop offset="29%" style="stop-color:rgb(124,181,236);stop-opacity:1" /> <stop offset="29%" style="stop-color:rgb(172,117,7);stop-opacity:1" />\ <stop offset="40%" style="stop-color:rgb(172,117,7);stop-opacity:1" /> <stop offset="40%" style="stop-color:rgb(27,104,7);stop-opacity:1" /> <stop offset="58%" style="stop-color:rgb(27,104,7);stop-opacity:1" /> <stop offset="58%" style="stop-color:rgb(67,67,72);stop-opacity:1" /> <stop offset="79%" style="stop-color:rgb(67,67,72);stop-opacity:1" /> <stop offset="79%" style="stop-color:rgb(144,237,125);stop-opacity:1" /> <stop offset="100%" style="stop-color:rgb(144,237,125);stop-opacity:1" /></linearGradient > </defs >';
//     // print_r($svgstr);die;
//     // $locid
//      $colorfinder = '~~~~~MARK'.$locid.'~~~~~';
//      // ~~~~~MARK20730~~~~~
//      // print_r($colorfinder);die;
//      // if($locid == 56)
//      // {
//      //  // print_r($colorfinder);die;
//      // }
//     //  if($_REQUEST['childlvl'] == '7')
//     //  {
//     //  print_r($colorfinder);
//     // }
//      // print_r($svgstr);die;
//     $totsvg1 = str_replace($colorfinder,$svgstr,$totsvg);
//     $totsvg2 = str_replace("&lt;","<",$totsvg1);
//     $totsvg3 = str_replace("&gt;",">",$totsvg2);


//     return $totsvg3;

//     // $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
//     // fwrite($myfile, "\n". $totsvg3);
//     // fclose($myfile);

// }

function fillcolor_insvg($values,$cc,$arord,$filename,$replicfile,$locid,$totsvg,$colorarr)
{
    // print_r($cc);die;

    // $values = $_GET['values']; //~~
    //index2.php?values=12-805~~35-400~~98-1300~~18-300~~8-200~~198-1500~~121-1500~~91-100~~92-685~~15-500
    // $msar = array(12=>"Tea", 35=>"Coffee", 98=>"Cool Drinks", 18=>"Biscuits", 8=>"Cholcalotes", 198=>"Wafers", 121=>"Ice Creams", 15=>"Puffs", 91=>"Bakery Items", 92=>"Snacks");
    $values = rtrim($values,"~~ ");
    $vals = explode("~~",$values);
    // print_r($vals);die;
    $catgry = count($vals);
    // print_r($catgry);die;
    foreach($vals as $val3) {
    list($ids,$val) = explode("-",$val3);
    $percnt[$ids] = $val;
    }

    // print_r($percnt);//die;
    foreach($percnt as $k1=>$val5) {
    //echo $k1 . ' <<<==== ' . $val5 . "</br>";
    $aaa[$k1] = sprintf('%0.1f', round(($val5*100 / array_sum($percnt))));
    }

    asort($aaa);
    // print_r($aaa);die;
    foreach($aaa as $bb=>$x) {
    // echo $bb . ' ====>> ' . $x . "</br>";
    $bbb[] = $bb;

    }
    // print_r($colorarr);
    // print_r($bbb);die;
    // $cc[0] = 'rgb(243, 12, 12)';//#F30C0C
    // $cc[1] = 'rgb(27, 104, 7)';//#1B6807
    // $cc[2] = 'rgb(0, 0, 255)';//#0000FF
    // $cc[3] = 'rgb(17, 108, 223)';//#116CDF
    // $cc[4] = 'rgb(172, 117, 7)';//#AC7507
    // $cc[5] = 'rgb(226, 240, 13)';//#E2F00D
    // $cc[6] = 'rgb(79, 84, 12)';//#4F540C
    // $cc[7] = 'rgb(84, 12, 13)';//#540C0D
    // $cc[8] = 'rgb(12, 84, 78)';//#0C544E
    // $cc[9] = 'rgb(101, 12, 117 )';//#650C75
    // $cc_hex[0] = '#F30C0C';
    // $cc_hex[1] = '#1B6807';
    // $cc_hex[2] = '#0000FF';
    // $cc_hex[3] = '#116CDF';
    // $cc_hex[4] = '#AC7507';
    // $cc_hex[5] = '#E2F00D';
    // $cc_hex[6] = '#4F540C';
    // $cc_hex[7] = '#540C0D';
    // $cc_hex[8] = '#0C544E';
    // $cc_hex[9] = '#650C75';


    // echo $catgry . "<pre>";
    // print_r($aaa);
    // print_r($bbb);
    // print_r($msar);
    // echo "</pre>";

    // exit;
     
    $colr = array();
    $clrarry = '';
    
    if($locid == '14878' && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12)
     {  
          // $locid = '73';
          $svgstr = '&lt;defs&gt;
          &lt;linearGradient id="solids73" x1="0" y1="0" x2="0" y2="1"&gt;';
     }  
     else
     {
          $svgstr = '&lt;defs&gt;
          &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';
     }
     // print_r($svgstr);die;
    if($catgry==1) {

    $p1 = $aaa[$bbb[0]];

    //$cc[0] = 'rgb(243,12,12)'; //#CC3300
    // $cc[1] = 'rgb(84,12,13)';//#001E99
    // $cc[2] = 'rgb(226,240,13)';//#e2f00d
    //$cc_hex[0] = '#f30c0c';
    // $cc_hex[1] = '#001E99';
    // $cc_hex[2] = '#e2f00d';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
    # code...
    $colr[$key] = $cc_hex[$cls];
    $cls++;
    }
    $clrarry = implode(",",$colr);
    // print_r($cc);

      $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
      &lt;stop offset="100%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;';
      // print_r($svgstr);die;

    } elseif($catgry==2) 
    {

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];

        // $cc[0] = 'rgb(243,12,12)'; //#CC3300
        // $cc[1] = 'rgb(84,12,13)';//#001E99
        // // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;';
        // print_r($svgstr);die;

    } 
    elseif($catgry==3) 
    {

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];



        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        // $colr[$bbb[0]]='rgb(243,12,12)';
        // $colr[$bbb[1]]='rgb(84,12,13)';
        // $colr[$bbb[2]]='rgb(226,240,13)';

        // $cc[0] = 'rgb(243,12,12)'; //#CC3300
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;';
        // print_r($colr);die;
    } 
    elseif($catgry==4) 
    {

      $p1 = $aaa[$bbb[0]];
      $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
      $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
      $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];

        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        $cc[3]=$colorarr[$bbb[3]];


      // $cc[0] = 'rgb(243,12,12)'; //#CC3300
      // $cc[1] = 'rgb(84,12,13)';//#540c0d
      // $cc[2] = 'rgb(226,240,13)';//#e2f00d
      // $cc[3] = 'rgb(0,0,255)';
      // $cc_hex[0] = '#f30c0c';
      // $cc_hex[1] = '#540c0d';
      // $cc_hex[2] = '#e2f00d';
      // $cc_hex[3] = '#0000ff';
      asort($aaa);
      // print_r($aaa);die;
      $cls = 0;
      foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
      }
      $clrarry = implode(",",$colr);







      $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p2.'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p3.'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p3.'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
      &lt;stop offset="'.$p4.'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;';

    } 
    elseif($catgry==5) 
    {
        //echo "Yessssssssssss";

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
        $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
        $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];



        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        $cc[3]=$colorarr[$bbb[3]];
        $cc[4]=$colorarr[$bbb[4]];
        // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc[3] = 'rgb(0,0,255)';
        // $cc[4] = 'rgb(12,84,78)';
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        // $cc_hex[3] = '#0000ff';
        // $cc_hex[4]  ='#0c544e';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);



        // print_r($p1.' // '.$p2.' // '.$p3.' // '.$p4.' // '.$p5); die;


        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;';

    }
    elseif($catgry==6) 
    {
        //echo "Yessssssssssss";

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
        $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
        $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
        $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];



        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        $cc[3]=$colorarr[$bbb[3]];
        $cc[4]=$colorarr[$bbb[4]];
        $cc[5]=$colorarr[$bbb[5]];
        // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc[3] = 'rgb(0,0,255)';
        // $cc[4] = 'rgb(12,84,78)';
        // $cc[5] = 'rgb(124,181,236)';
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        // $cc_hex[3] = '#0000ff';
        // $cc_hex[4]  ='#0c544e';
        // $cc_hex[5]  ='#7cb5ec';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        // print_r($clrarry);die;
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;';
        // print_r($svgstr);die;
    }
    elseif($catgry==7) 
    {
        //echo "Yessssssssssss";

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
        $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
        $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
        $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
        $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];


        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        $cc[3]=$colorarr[$bbb[3]];
        $cc[4]=$colorarr[$bbb[4]];
        $cc[5]=$colorarr[$bbb[5]];
        $cc[6]=$colorarr[$bbb[6]];
        // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc[3] = 'rgb(0,0,255)';
        // $cc[4] = 'rgb(12,84,78)';
        // $cc[5] = 'rgb(124,181,236)';
        // $cc[6] = 'rgb(172,117,7)';
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        // $cc_hex[3] = '#0000ff';
        // $cc_hex[4]  ='#0c544e';
        // $cc_hex[5]  ='#7cb5ec';
        // $cc_hex[6]  ='#ac7507';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;';
        // print_r($svgstr);die;
    }
    elseif($catgry==8) 
    {

          $p1 = $aaa[$bbb[0]];
          $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
          $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
          $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
          $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
          $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
          $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
          $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];

          $cc[0] = $colorarr[$bbb[0]];
          $cc[1]=$colorarr[$bbb[1]];
          $cc[2]=$colorarr[$bbb[2]];
          $cc[3]=$colorarr[$bbb[3]];
          $cc[4]=$colorarr[$bbb[4]];
          $cc[5]=$colorarr[$bbb[5]];
          $cc[6]=$colorarr[$bbb[6]];
          $cc[7]=$colorarr[$bbb[7]];
          // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
          // $cc[1] = 'rgb(84,12,13)';//#540c0d
          // $cc[2] = 'rgb(226,240,13)';//#e2f00d
          // $cc[3] = 'rgb(0,0,255)';
          // $cc[4] = 'rgb(12,84,78)';
          // $cc[5] = 'rgb(124,181,236)';
          // $cc[6] = 'rgb(172,117,7)';
          // $cc[7] = 'rgb(27,104,7)';
          // $cc_hex[0] = '#f30c0c';
          // $cc_hex[1] = '#540c0d';
          // $cc_hex[2] = '#e2f00d';
          // $cc_hex[3] = '#0000ff';
          // $cc_hex[4]  ='#0c544e';
          // $cc_hex[5]  ='#7cb5ec';
          // $cc_hex[6]  ='#ac7507';
          // $cc_hex[7]  ='#1b6807';
          asort($aaa);
          // print_r($aaa);die;
          $cls = 0;
          foreach ($aaa as $key => $value) {
          # code...
          $colr[$key] = $cc_hex[$cls];
          $cls++;
          }
          $clrarry = implode(",",$colr);

          $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
          &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
          &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
          &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;';
          // print_r($colr);
          // print_r($svgstr);die;
    }
    elseif($catgry==9) 
    {
        //echo "Yessssssssssss";

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
        $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
        $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
        $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
        $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
        $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];
        $p9 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]];


            $cc[0] = $colorarr[$bbb[0]];
            $cc[1]=$colorarr[$bbb[1]];
            $cc[2]=$colorarr[$bbb[2]];
            $cc[3]=$colorarr[$bbb[3]];
            $cc[4]=$colorarr[$bbb[4]];
            $cc[5]=$colorarr[$bbb[5]];
            $cc[6]=$colorarr[$bbb[7]];
            $cc[7]=$colorarr[$bbb[6]];
            $cc[8]=$colorarr[$bbb[8]];
        // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc[3] = 'rgb(0,0,255)';
        // $cc[4] = 'rgb(12,84,78)';
        // $cc[5] = 'rgb(124,181,236)';
        // $cc[6] = 'rgb(172,117,7)';
        // $cc[7] = 'rgb(27,104,7)';
        // $cc[8] = 'rgb(67,67,72)';
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        // $cc_hex[3] = '#0000ff';
        // $cc_hex[4]  ='#0c544e';
        // $cc_hex[5]  ='#7cb5ec';
        // $cc_hex[6]  ='#ac7507';
        // $cc_hex[7]  ='#1b6807';
        // $cc_hex[8]  ='#434348';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;\
        &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;';
        // print_r($svgstr);die;
    }
    elseif($catgry==10) 
    {
        //echo "Yessssssssssss";

        $p1 = $aaa[$bbb[0]];
        $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
        $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
        $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
        $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
        $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];
        $p7 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]];
        $p8 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]];
        $p9 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]];
        $p10 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]]+$aaa[$bbb[6]]+$aaa[$bbb[7]]+$aaa[$bbb[8]]+$aaa[$bbb[9]];
            // print_r($colorarr);
            // print_r($bbb);die;
           $cc[0] = $colorarr[$bbb[0]];
            $cc[1]=$colorarr[$bbb[1]];
            $cc[2]=$colorarr[$bbb[2]];
            $cc[3]=$colorarr[$bbb[3]];
            $cc[4]=$colorarr[$bbb[4]];
            $cc[5]=$colorarr[$bbb[5]];
            $cc[6]=$colorarr[$bbb[6]];
            $cc[7]=$colorarr[$bbb[7]];
            $cc[8]=$colorarr[$bbb[8]];
            $cc[9]=$colorarr[$bbb[9]];
        // $cc[0] = 'rgb(243,12,12)'; //#f30c0c
        // $cc[1] = 'rgb(84,12,13)';//#540c0d
        // $cc[2] = 'rgb(226,240,13)';//#e2f00d
        // $cc[3] = 'rgb(0,0,255)';
        // $cc[4] = 'rgb(12,84,78)';
        // $cc[5] = 'rgb(124,181,236)';
        // $cc[6] = 'rgb(172,117,7)';
        // $cc[7] = 'rgb(27,104,7)';
        // $cc[8] = 'rgb(67,67,72)';
        // $cc[9] = 'rgb(144,237,125)';
        // $cc_hex[0] = '#f30c0c';
        // $cc_hex[1] = '#540c0d';
        // $cc_hex[2] = '#e2f00d';
        // $cc_hex[3] = '#0000ff';
        // $cc_hex[4]  ='#0c544e';
        // $cc_hex[5]  ='#7cb5ec';
        // $cc_hex[6]  ='#ac7507';
        // $cc_hex[7]  ='#1b6807';
        // $cc_hex[8]  ='#434348';
        // $cc_hex[9]  ='#90ed7d';
        asort($aaa);
        // print_r($aaa);die;
        $cls = 0;
        foreach ($aaa as $key => $value) {
        # code...
        $colr[$key] = $cc_hex[$cls];
        $cls++;
        }
        $clrarry = implode(",",$colr);
        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="'.$p1.'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[1].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p2 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[2].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p3 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[3].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p4 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[5].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p6 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[6].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p7 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[7].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[8].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:'.$cc[9].';stop-opacity:1" /&gt;
        &lt;stop offset="'. $p10 .'%" style="stop-color:'.$cc[9].';stop-opacity:1" /&gt;';
        // print_r($svgstr);die;
    }
    $svgstr .= '&lt;/linearGradient &gt; &lt;/defs &gt;';
    
      if($locid == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] == 12)
      {
        $colorfinder = '~~~~~MARK73~~~~~';
      }
      else
      {
        $colorfinder = '~~~~~MARK'.$locid.'~~~~~';
      }
     
    
    $totsvg1 = str_replace($colorfinder,$svgstr,$totsvg);
    $totsvg2 = str_replace("&lt;","<",$totsvg1);
    $totsvg3 = str_replace("&gt;",">",$totsvg2);

    // print_r($colorfinder);die;
    return $totsvg3;

    // $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
    // fwrite($myfile, "\n". $totsvg3);
    // fclose($myfile);

}


echo json_encode($final_resul_arry);
// echo $tablestr;



?>
