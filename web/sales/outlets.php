<?php
//Secondary sales --Grid
// print_r(ini_get('memory_limit'));die;
error_reporting(0);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
//require(__DIR__ . '/../currency.php');
//echo "so sad";die;
$config = require(__DIR__ . '/../../config/web.php');

new yii\web\Application($config);
use yii\helpers\ArrayHelper;
$retilerschoice = array(2734,3074,2723,2604,2731,3083,2781,2724,2610,2729,2740,3604,2735,3086,3117,2611,2730,2722,3104);

if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['childlvl'] != 15)
{
     echo "data not available";die;
}
// {

// }
$colorstor = array();
$currency_conv = 'INR';
$final_resul_arry = array();



    $fldcondtions1= '';
        $newfldcondtion = json_decode($_REQUEST['tbldata']);
        $iterations = 1;
        foreach ($newfldcondtion as $key => $value)
        {
            $condarr = explode(',', $value);
            $fldkeys = $condarr[0];
            array_shift($condarr);
            // print_r($condarr);

            if(count($newfldcondtion) == 1){
            $fldcondtions1 = $fldcondtions1."fld".$fldkeys." IN (".implode(',', $condarr).")";
            }
            else
            {
              $fldcondtions1 = $fldcondtions1."fld".$fldkeys." IN (".implode(',', $condarr).") AND ";
            }
            // print_r($fldcondtions1);
            //$fldcondtions1 =

            // array_shift($a)

        }
      // print_r($fldcondtions1);die;





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
        case 5: return 'rgb(226, 240, 13)';
        case 6: return 'rgb(79, 84, 12)';
        case 7: return 'rgb(84, 12, 13)';
        case 8: return 'rgb(12, 84, 78)';
        case 9: return 'rgb(101, 12, 117)';

       // default: return 'rgb(183, 126, 223)';
    }
};
function cmp($a, $b) {
  //print_r($a["value"].' // '.$b["value"]);die;
        return $b["value"] - $a["value"];
}
function cmpgrowth($a, $b) {
  //print_r($a["value"].' // '.$b["value"]);die;
        return $b["growth"] - $a["growth"];
}
function moneyFormatIndia($num)
   {
    // $num =75020320335;
    $explrestunits = "" ;
    $cmtcnt =0;
    if(strlen($num)>3)
    {
      $lastthree = substr($num, strlen($num)-3, strlen($num));
      $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
      $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
      $firstrestunits = substr($restunits, 0, -4);
       $firstrestunits = (int)$firstrestunits;
       $midrestunits = substr($restunits, strlen($restunits)-4);
      $expunit = str_split($midrestunits, 2);

      for($i=0; $i<sizeof($expunit); $i++)
      {

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

    }
    else
    {
      $thecash = $num;
    }
   $thecash =  ltrim($thecash, '0');
    return $thecash; // writes the final format where $currency is the currency symbol.
  }
// echo "sdfsd"
//   if($locid == 676 && $_REQUEST['level'] >= 6)
//   {
//      echo "data not available";die;
//   }
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
        // print_r($b);die;
        // foreach ($bq as $key => $value) {
        // $b[$l]=array("name"=>$key,"data"=>$value);
        // $per=($dataarr[$k]/$sum)*100;
        // array_push($bc['color'],colorcount((int)$per));
        // $l++;
        // }

      }
      else if($view==3)
      {
        // return $res;die;
        // print_r($res);//die;
        $period = $perioddata;
        $newresarr = array();
        foreach ($res as $key => $value)
        {
          $newresarr[$value['locid']] = $value['location'];
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
            $dataarrgrwoth[$res[$k]['locid']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$s1;
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
    // $jsonc=json_encode($newcategrory);






    //coded by robin ends here






    // print_r($b);die;
    // print_r($titlearr);die;


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
    $format_header ='';
    $legendRem ='';
    if($view==0 || $view == 3)
    {
      $typechart="column";
      $format_header =" tooltip: {
      formatter: function() {
      return '<b>'+ this.x +
      '</b> - <b>'+ this.y +'</b>';
      }
      },";
      $legendRem = " legend: {
            enabled: false
        },";
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
     // yAxis: {
     //        labels: {
     //            formatter: function () {
     //                return '$' + this.axis.defaultLabelFormatter.call(this);
     //            }
     //        }
     //    },
// print_r($jk);die;
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
            text: ''
        },
    },
    $legendRem
    $format_header
    chart: {
        type: '$typechart'
    },
    title: {
        text: '$title2'
    },
    credits: {
           enabled: false
    },
     $retail

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

 localStorage.setItem('chartseries12', JSON.stringify(chartdupseries));
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
        // array_reverse($cls);
        // print_r($cls);die;
        // print_r($c;);die;


            // for($k=0;$k<count($namearr);$k++)
            // {
            //     $dataarr[$namearr[$k]]['per']= (($dataarr[$namearr[$k]][$period1[count($period1)-1]]-$dataarr[$namearr[$k]][$period1[0]])/$dataarr[$namearr[$k]][$period1[0]])*100;
            // }

            // $namearr3 =trim($namearr2,",");
            // $bc=array();
            // $bc['color']=array();$a=array();
            // for($k=0;$k<count($namearr);$k++)
            // {

            //  $a[$k]=array('y'=>(int)$dataarr[$namearr[$k]]['per'],'mydata'=>$dataarr1[$k],'color'=>colorcount((int)$dataarr[$namearr[$k]]['per']));


            //   array_push($bc['color'],colorcount((int)$dataarr[$namearr[$k]]['per']));

            // }
           $totalarr=array(array("name"=>$combine,"data"=>$a1));

           // print_r($totalarr);die;



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

    // print_r($totalarr);die;
      // $csk = $totalarr['data'];
      // usort($csk, function($a, $b) {
      //   if(isset($b['y']))
      //     return $b['y'] - $a['y'];
      //     });
      // print_r($csk);die;
    $json1=json_encode($totalarr);
    // print_r($json1);die;
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

    $resworld = $res;
    $view = $_REQUEST['view'];
    $sum=0;$locat=array(); $retailers=array();
    $localworld=array();
    $world=array();
    $worldcount=array();
    if($view==3)
    {
      // return "damn";
       for($v=0;$v<count($resworld);$v++)
        {
           if(!in_array($resworld[$v]['locid'], $world)){
            array_push($world,$resworld[$v]['locid']);
            array_push($locat,$resworld[$v]['location']);
             array_push($retailers,$resworld[$v]['retailer']);
          }
          $s1 =(($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6 ) ? (int)$resworld[$v]['retailer'] : (int)$resworld[$v]['result'];
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
              $locidarray[$resworld[$v]['locid']]['result'] = $locidarray[$resworld[$v]['locid']]['result']+$resworld[$v]['result'];
              $locidarray[$resworld[$v]['locid']]['retailer'] =  $locidarray[$resworld[$v]['locid']]['retailer']+$resworld[$v]['retailer'];

              $sum=$sum+$resworld[$v]['result'];
          }
          $i = 0;
          foreach ($locidarray as $key => $value)
          {
            # code...

          //for($i=0;$i<count($world);$i++)
                     $r1234=$key.'****'.$value['result'].'****'.$sum.'****'.$value['retailer'];//$retailers[$i];
                   // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$retailers[$i];
             // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$sumofrt[$world[$i]];
                  $localworld[$i]=$r1234;
                  $i++;


          }

          // for($v=0;$v<count($resworld);$v++)
          // {

          //     array_push($world,$resworld[$v]['locid']);

          //     array_push($worldcount,$resworld[$v]['result']);
          //     array_push($retailers,$resworld[$v]['retailer']);
          //     $sum=$sum+$resworld[$v]['result'];
          // }
          // // return $world;
          // for($i=0;$i<count($world);$i++)
          // {
          //           $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$retailers[$i];
          //    // $r1234=$world[$i].'****'.$worldcount[$i].'****'.$sum.'****'.$sumofrt[$world[$i]];
          //         $localworld[$i]=$r1234;


          // }
        }


      }
      // print_r($localworld);die;
      // echo json_encode($localworld);
      return $localworld;
}



// function aasort (&$array, $key) {
//     $sorter=array();
//     $ret=array();
//     reset($array);
//     foreach ($array as $ii => $va) {
//         $sorter[$ii]=$va[$key];
//     }
//     asort($sorter);
//     foreach ($sorter as $ii => $va) {
//         $ret[$ii]=$array[$ii];
//     }
//     $array=$ret;
// }
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
            // print_r($strdata);//die;
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
          // print_r($localworld);die;
          return $localworld;  //echo json_encode($localworld);

        }

}


$login=Yii::$app->user->identity->id;
    $combine="";
    $year=$_REQUEST['year'];
    $category=explode(",",$_REQUEST['categs']);
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

  // print_r($part1);die;
 $ptype =5;
      $levelparent = array(0=>'loc21',1=>'loc5',2=>'loc5',3=>'loc7',4=>'loc7',5=>'loc9',6=>'loc12',7=>'loc15');
       $levelchild = array(0=>'loc5',1=>'loc5',2=>'loc7',3=>'loc7',4=>'loc9',5=>'loc9',6=>'loc15',7=>'loc15');
       $locationmaster = array(0=>'country_master',1=>'country_master',2=>'state_master',3=>'state_master',4=>'district_master',5=>'district_master',6=>'ward_master',7=>'ward_master');

$tabletitle =  array(626=>'Category',627=>'Sub Category',628=>'MotherBrand',629=>'SKU',630=>'distrbtr',631=>'Brand',632=>'Retailer',639=>'Retailer Channel',640=>'Channel',641=>'Sub Channel',1073=>'Pack Size');


          // world_master
    if($_REQUEST['parentlvl'] == 21 && $_REQUEST['childlvl'] == 21)
       {
          $locationtbl = 'world_master';
       }
        else if($_REQUEST['parentlvl'] == 21 && $_REQUEST['childlvl'] == 1)
        {
         $locationtbl ='country_master';
        }
        else if($_REQUEST['parentlvl'] == 5 && $_REQUEST['childlvl'] == 5)
        {
         $locationtbl ='country_master';
        }
        else if($_REQUEST['parentlvl'] == 5 && $_REQUEST['childlvl'] == 7)
        {
         $locationtbl = $locationmaster[2];
        }
        else if($_REQUEST['parentlvl'] == 7 && $_REQUEST['childlvl'] == 7)
        {
         $locationtbl = $locationmaster[3];
        }

        else if($_REQUEST['parentlvl'] == 7 && $_REQUEST['childlvl'] == 9)
        {
         $locationtbl = $locationmaster[4];
        }
         else if($_REQUEST['parentlvl'] == 9 && $_REQUEST['childlvl'] == 9)
        {
         $locationtbl = 'district_master';
        }
         else if($_REQUEST['parentlvl'] == 9 && $_REQUEST['childlvl'] == 10)
        {
         $locationtbl = 'taluk_master';
        }
         else if($_REQUEST['parentlvl'] == 10 && $_REQUEST['childlvl'] == 10)
        {
         $locationtbl = 'taluk_master';
        }
        else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] == 12)
        {
          $locationtbl = 'city_master';
        }

        else if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] == 15)
        {
         $locationtbl = 'ward_master';
        }
        else if($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] == 15)
        {
          $locationtbl = 'ward_master';
        }













if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="C") //combine
{

  $tabl_ids = $_REQUEST['tbl'];


  $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$tabl_ids." and stat !='R'";
        $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();
         $split_tble = $res1['table_name'] ;
         // print_r($split_tble);die;

      $sql='';
      $child = "loc".$_REQUEST['childlvl'];
      $parent = "loc".$_REQUEST['parentlvl'];
      $locid = $_REQUEST['id'];
      $period = $_REQUEST['year'];

      // $locationtbl = $locationmaster[$_REQUEST['level']];
      $conddis = '';
         if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==12 && $locid == 73) //for current use ,,has to delete once issue solved with map
         {
            $child = 'loc9';
            $parent = 'loc9';
            $locationtbl = 'district_master';
            $conddis = ' and loc9 = '.$locid;

         }

          if($locid == 73 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
             {
                  // if($locid == 73)
                  // {
                  $locid='14878';
                  // }
                 $tablname = 'biweb_sales.14878_sales';
             }
             else if($locid == '14878' && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
             {
                   $tablname = 'biweb_sales.14878_sales';
             }
            else if($locid == 676 && $_REQUEST['parentlvl'] == 12)
              {
                $tablname = 'biweb_sales.13346_sales';
              }
             elseif($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] ==15)
             {
                $tablname = 'biweb_sales.14878_sales';
             }
             else
             {
                 $tablname = 'biweb_sales.hul_city_sales';
             }




        // if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15 )//&& $_REQUEST['childlvl'] == 15)//if($_REQUEST['level'] >= 6)
        // {
        //   if($locid == 73)
        //   {
        //     $locid='14878';
        //   }
        //   $tablname = 'biweb_sales.'.$locid.'_sales';//'biweb_sales.14878_sales';

        // }
        // if($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] ==15 )//&& $_REQUEST['childlvl'] == 15)//if($_REQUEST['level'] >= 6)
        // {
        //   if($locid == 73)
        //   {
        //     $locid='14878';
        //   }
        //   $tablname = 'biweb_sales.'.$locid.'_sales';//'biweb_sales.14878_sales';

        // }
        //  else
        // {
        //   $tablname = 'biweb_sales.hul_city_sales';
        // }
        // print

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

            $mainresultField = "ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) result";

          $filterchild = '';
         $range = '';
      if(isset($_REQUEST['combv']))
      {
        $s = "SELECT * FROM split_combine_view where refid='".$_REQUEST['combv']."'";
        $que = yii::$app->db->createCommand($s)->queryOne();
        $split_idc   =   $que['menu_id'];
        $view_optnc  =   $que['view_optn'];
        // echo $split_ids." / / ".$view_optnc;exit();

           if($split_idc != 0)
           {

           }
           else
           {
             if($view_optnc == 3 || $view_optnc == 5)
             {
                $mainresultField = "COUNT(DISTINCT(fld632)) result";
                $retail=1;
             }
             else
             {
                $mainresultField = "ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) result";

                $retail =0;
             }
           }


        $combgroup =" ";
      }
      else
      {
         $combgroup =" ";
      }
         if(isset($_REQUEST['type']))
         {
          if($_REQUEST['type'] == 'Rn')
          {
            $chidlvlfilter =$_REQUEST['chidlvlfilter'];
            $rangebtw = explode(",",$chidlvlfilter);
            // prin
            $range = 'Having ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) between '.$rangebtw[0].' and '.$rangebtw[1];
          }
          else if($_REQUEST['type'] == 'var')
            {
              if(isset($_REQUEST['chidlvlfilter']))
              {
                $relatedid = $_REQUEST['chidlvlfilter'];
              }
            }


         }
         else
         {
            if(isset($_REQUEST['chidlvlfilter']))
            {
              $filterloc = $_REQUEST['chidlvlfilter'];
              $filterchild = "a.".$child." in (".$filterloc.") AND";
            }
         }
         if($ptype == 5)
            {
               if(isset($_REQUEST['id'])){$s1="a.".$parent." = ".$locid." and ";}else{$s1="";}
              if(!isset($_REQUEST['filter']))
              {
                // $retail=0;
                if($_REQUEST['parentlvl'] == 12 )
                {

                  $sql = "select c.location_name as location,a.".$child." loclevel,c.refid as locid,b.name as title,".$mainresultField.",a.period_Y FROM ".$tablname." PARTITION (".$perids.") a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                  join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE a.".$child." != 0 ".$conddis." AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids."  IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0  GROUP BY loclevel ".$groupbyvar." ".$range." order by result desc";
                }
                 else if($_REQUEST['parentlvl'] == 15)
                {
                  $sql = "select c.location_name as location,a.".$child." loclevel,c.refid as locid,b.name as title,".$mainresultField.",a.period_Y FROM ".$tablname." PARTITION (".$perids.") a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                  join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE a.".$parent." = ".$locid." and a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids."  IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0  GROUP BY loclevel ".$groupbyvar." ".$range." order by result desc";//
                }
                else
                {
                  $tablname = 'biweb_sales.hul_city_sales';

                  $sql = "select c.location_name as location,a.".$child." loclevel,c.refid as locid,b.name as title,".$mainresultField.",a.period_Y FROM ".$tablname." PARTITION (".$perids.") a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                  join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE a.".$parent." = ".$locid." and a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0  GROUP BY loclevel ".$groupbyvar." ".$range." order by result desc";
                }
              }
              else
              {

                if($_REQUEST['level'] >= 6)
                {

                  $sql = "select distinct c.location_name as location,a.".$child." loclevel,c.refid as locid,count(a.fld632) as retail FROM ".$tablname." PARTITION (".$perids.") a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                 join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE $s1 a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids."  IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 order by location";//
                }
                else
                {

                  $tablname = 'biweb_sales.hul_city_sales';
                  $sql = "select distinct c.location_name as location,a.".$child." loclevel,c.refid as locid,count(a.fld632) as retail FROM ".$tablname." PARTITION (".$perids.") a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                  join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE $s1  a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 order by location";
                }
              }

            }


        if(isset($_REQUEST['type']))
        {
          if($_REQUEST['type'] == 'R')
          {
             $chidlvlfilter =$_REQUEST['chidlvlfilter'];
              $rankbtw = explode(",",$chidlvlfilter);
                $sql = "select location,loclevel, title,result,period_Y,count(a.fld632) as retail from (select location,loclevel, title,result,period_Y, CASE WHEN @l=result THEN @r ELSE @r:=@r+1 END as rank, @l:=result FROM (".$sql." order by result desc) totals, (SELECT @r:=0,@l:=NULL) rank) fin where fin.rank BETWEEN ".$rankbtw[0]." and ".$rankbtw[1];
          }
        }
          // echo $groupbyvar;die;
           // echo $sql;die;
      $res=yii::$app->db2->createCommand($sql)->queryAll();
      $rcnt = count($res);


      $tablestr="";

      // $final_resul_arry = array();
      // if($comb==0) {
      $title2 = "Values";
      // } else {
      // $title2 = "Count";
      // }

        $postivecolor =array();
        $negativecolor = array();
        $postivecnt = 0;
        $negativecnt = 0;
      if(count($perioddata)> 1)
      {
        $firstperiod= 0;
        $lastperiod=0;
         if(!isset($_REQUEST['filter']))
         {
          if($_REQUEST['view'] == 3)
              {
                $firstperiod = $perioddata[0];
                $lastperiod=$perioddata[(count($perioddata)-1)];
              }

            $l=0;
            $r=0;
            $locationlevels =array();
            $locationname =array();
            // $retailers=array();

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
                 //$retailers[$r++]=$value['retail'];
                 // array_push($retailers,$value['retail']);

            }
            $locationlevels = array_unique($locationlevels);
            $locationlevels = array_values($locationlevels);
            $locationname = array_unique($locationname);
            $locationname = array_values($locationname);

            $columspan = 2+(int)(count($perioddata));
            $tablestr.="<table id='example19'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
             if($retail==1){
              $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."'>".$tabletitle[$_REQUEST['tbl']]." Retailers nos.</th></tr>
            <tr>";
             }
             else
             {
                 $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."'>".$tabletitle[$_REQUEST['tbl']]."Values</th></tr>
            <tr>";
             }
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
            for($k=0;$k<count($locationlevels);$k++)
            {
            $tablestr .= "<tr id='".$locationlevels[$k]."' level='".$_REQUEST['level']."'>";

            $totalsumperiod = 0;
            $firstval =0;
            $lastval =0;
            $tablestr .= "<td>".$locationname[$k]."</td>";
            for ($f=0;$f<count($perioddata);$f++)
            {
                 if(($_REQUEST['view'] == 0) && (count($periods) > 1))
                 {
                  if($f==1)
                  {
                    break;
                  }
                 }
                 else   if(($_REQUEST['view'] == 5) && (count($periods) > 1)){
                  if($f==1)
                  {
                    break;
                  }
                 }
                if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                {
                    $tablestr .= "<td align = 'right'>".$timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']."</td>";
                }
                else
                {
                       $amountIND = round($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'],2);//'1000003.400050'; '283688411.50';//
                                  $amt = explode(".",$amountIND);
                                  $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                                  // print_r($amountIND); die;
                                  if(isset($amt[1]))
                                  {
                                    $amountIND = $amountIND.".".$amt[1];
                                  }
                                  $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                   // $tablestr .= "<td align = 'right'>".number_format( $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'], 2 )."</td>";
                //$tablestr .= "<td align = 'right'>".$amountIND."</td>";
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
                {

                     $totalsumperiod = $totalsumperiod + floatval($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']);
                }



              }
              if($_REQUEST['view'] == 3)
              {
                $growthrate = (($lastval-$firstval)/$firstval)*100;
                $tablestr.="<td  align = 'right'>".number_format($growthrate,2)."%</td>";
                //$totalsumperiod = 0;

              }
              else if(($_REQUEST['view'] == 0) && (count($periods) > 1)){}
                else if(($_REQUEST['view'] == 5) && (count($periods) > 1)){}
              else
              {
                  $amountIND = round($totalsumperiod,2);//'1000003.400050'; '283688411.50';//
                  $amt = explode(".",$amountIND);
                  $amountIND = moneyFormatIndia( $amt[0] );
                  // $tablestr .= "<td align = 'right'>".number_format(  $totalsumperiod, 2 )."</td>";
                  $tablestr .= "<td align = 'right' class = 'totalsum'>".$amountIND."</td>";


                $totalsumperiod = 0;

              }
            //   if($retail==1){
            // $tablestr .= "<td>".$retailers[$k]."</td>";
            //   }
              $tablestr .= "</tr>";

            }
              $tempres = json_encode($timelinedata);
            $tablestr .="</tbody></table>";

             // print_r($tempres);die;
              $tablestr.="<script>splitot =$tempres; tablebck = JSON.stringify(splitot);</script>";
              // tablebck = $tempres;
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
        if(!isset($_REQUEST['filter']))
        {
            foreach($res as $key=>$value)
            {
              $timelinedata[$value['loclevel']][$value['period_Y']]= $value;
              if($value['result'] < 0)
              {
                   $negativecnt++;
              }
              else
              {
                    $postivecnt++;
              }
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
                  if($key != 'loclevel')
                  {
                     $tablestr .="<th>".ucfirst($key)."</th>";
                    if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                    {
                      $tablestr .="<th align = 'center'>".$part." Retailers (Nos.)</th>";
                    }
                    else
                    {
                        // $tablestr .="<th align = 'center'>".$part." Sales (Rs.)</th>";
                          $tablestr .="<th align = 'center'> Values</th>";
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


            $contribut_tot = 0;
            foreach ($res as $item) {
            $contribut_tot += $item['result'];
            }


             // echo $tablestr;die;
             if (count($res) > 0)
              {
                for($k=0;$k<count($res);$k++)
                {
                  $tablestr .= "<tr class='details-control' id='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>";
                  //$tablestr .= "<td  class='details-control' count='".$res[$k]['loclevel']."' level='".$_REQUEST['level']."'>+</td>";
                  $tablestr .= "<td>".$res[$k]['location']."</td>";
                if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                {

                     $amountIND = round($res[$k]['result'],2);//'1000003.400050'; '283688411.50';//
                        $amt = explode(".",$amountIND);
                        $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                        // print_r($amountIND); die;
                        if(isset($amt[1]))
                        {
                         $amountIND = $amountIND.".".$amt[1];
                        }
                         $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                   $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format(($res[$k]['result']/$contribut_tot)*100,2)."</td>";
                   // $tablestr .= "<td align = 'right'>".$res[$k]['result']."</td>";
                }
                else
                {

                  $amountIND = 0;
                  // if($currency_conv !='INR')
                  // {     $from_Curr = 'INR';
                  //       $to_Curr = $currency_conv;
                  //       $amountIND = round($res[$k]['result'],2);
                  //       $converted_currency=currencyConverter($from_Curr, $to_Curr, $amountIND);
                  //       // echo  $amountIND .'/// '.$converted_currency;die;
                  // }
                 // else
                  //{
                        $amountIND = round($res[$k]['result'],2);//'1000003.400050'; '283688411.50';//
                        $amt = explode(".",$amountIND);
                        $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                        // print_r($amountIND); die;
                        if(isset($amt[1]))
                        {
                         $amountIND = $amountIND.".".$amt[1];
                        }
                 // }

                  // echo "Sdf";die;
                  //echo $amount.".".$amt[1];die;   number_format( $res[$k]['result'], 2 )
                  $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                   $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format(($res[$k]['result']/$contribut_tot)*100,2)."</td>";

                }


                  $tablestr .= "</tr>";
                }
              }
                $jsenolocres = json_encode($timelinedata);
              $tablestr .="</tbody></table>";
               // $tablestr.="<script>splitot =$jsenolocres; tablebck = JSON.stringify(splitot);</script>";
              $tablestr.="<script>tablebck =$jsenolocres;</script>";
              // tablebck = JSON.stringify($tempres

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
      $grp = graphwrk($res,$view_optnc, $perioddata );
      array_push($final_resul_arry, $grp);
      $mapwrk = mapwrk($res,$retail,$periods);


      $mainlocation = $_REQUEST['parentlvl'];
      $selectedlocation = $_REQUEST['id'];
      $sublocation = $_REQUEST['childlvl'];
      if($_REQUEST['parentlvl'] != '21')
      {
        if($mainlocation==$sublocation)
        {
          $sql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;
          
          $res=yii::$app->db->createCommand($sql)->queryOne();
          // print_r($res);die;
          $yu=($res['master_table']=='country_master') ? 'refid as country_id' : 'country_id';

          $sql2="select ".$yu.",center_coordinates from ".$res['master_table']." where refid=".$selectedlocation;
          $res2=yii::$app->db->createCommand($sql2)->queryOne();
          // print_r($res2);die;

        }
        else
        {
            if($locid == '14878' && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
            {
              $res['master_table'] = 'city_master';
            }
            else
            {
               $sql="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
                $res=yii::$app->db->createCommand($sql)->queryOne();
            }


             
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

              $sql2="select * from ".$res['master_table']." where refid=".$selectedlocation;
              $res2=yii::$app->db->createCommand($sql2)->queryOne();

        }
      }



      if($_REQUEST['parentlvl'] == '21')
      {
          $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

          $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";

            
      }
      else
      {
        $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }
      $totsvg = file_get_contents($svgfilen);
      $svgstr = '';
      for($j=0;$j<count($mapwrk);$j++)
      {

              $splitx = explode("****",$mapwrk[$j]);


              $colorspl = explode('_',$cls[$j]);
              $clrgb = 'rgb('. $colorspl[0].', '. $colorspl[1].', '. $colorspl[2].')';
              $svgstr = '&lt;defs&gt;&lt;linearGradient id="solids'.$splitx[0].'" x1="0" y1="0" x2="0" y2="1"&gt;';
              $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$clrgb.';stop-opacity:1" /&gt;
          &lt;stop offset="100%" style="stop-color:'.$clrgb.';stop-opacity:1" /&gt;';
              $svgstr .= '&lt;/linearGradient &gt; &lt;/defs &gt;';
              $colorfinder = '~~~~~MARK'.$splitx[0].'~~~~~';
              $totsvg1 = str_replace($colorfinder,$svgstr,$totsvg);
              $totsvg2 = str_replace("&lt;","<",$totsvg1);
              $totsvg = str_replace("&gt;",">",$totsvg2);

      }


    $totsvg = preg_replace('/\~\~\~\~\~([A-z])+([0-9]+)\~\~\~\~\~/m', '<defs>
    <linearGradient id="solids$2" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(255, 255, 255);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(255, 255, 255);stop-opacity:1"></linearGradient > </defs>', $totsvg);
    $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
    fwrite($myfile, "\n". $totsvg);
    fclose($myfile);


      









      array_push($final_resul_arry, $mapwrk);
      array_push($final_resul_arry,count($perioddata));
      array_push($final_resul_arry,'(Rs.)');//reading
      // array_push()

      //Graph

}
else if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="S") //split
{

  if(isset($_REQUEST['combv']))
          {
              $combv=$_REQUEST['combv'];

              $s = "SELECT * FROM split_combine_view where refid='".$_REQUEST['combv']."'";
              $que = yii::$app->db->createCommand($s)->queryOne();
              $split_idc   =   $que['menu_id'];
              $view_optnc  =   $que['view_optn'];
               $splitgrp= " ,a.fld".$split_idc;


              // print_r($splitgrp);die;

          }
          else
          {
             $splitgrp= "";
             $selectsplit= "";
          }




        $tabl_ids = ($split_idc != "") ?  $split_idc : $_REQUEST['tbl'];

        $tabl_ids1 = $_REQUEST['tbl'];




        $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$tabl_ids." and stat !='R'";
        $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();

        $split_tble = $res1['table_name'] ;

        $perids = array();
        $ptype =5;
        $levelparent = array(0=>'loc21',1=>'loc5',2=>'loc5',3=>'loc7',4=>'loc7',5=>'loc9',6=>'loc12',7=>'loc15');
        $levelchild = array(0=>'loc5',1=>'loc5',2=>'loc7',3=>'loc7',4=>'loc9',5=>'loc9',6=>'loc15',7=>'loc15');
        $locationmaster = array(0=>'country_master',1=>'country_master',2=>'state_master',3=>'state_master',4=>'district_master',5=>'district_master',6=>'ward_master',7=>'ward_master');

        // if($_REQUEST['parentlvl'] == 12 )//&& $_REQUEST['childlvl'] == 15)//if($_REQUEST['level'] >= 6)
        // {

        //          $tablname = 'biweb_sales.'.$locid.'_sales';//'biweb_sales.14878_sales';


        // }
        //  else
        // {
        //   $tablname = 'biweb_sales.hul_city_sales';
        // }


      $sql='';
       $child = "loc".$_REQUEST['childlvl'];//$levelchild[$_REQUEST['level']];
       $parent = "loc".$_REQUEST['parentlvl'];//$levelparent[$_REQUEST['level']];
       $locid = $_REQUEST['id'];

       
                 $tablname = 'biweb_mktgpot.hypermarket_details';
            

             // print_r($tablname);die;

       // if($_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15 )//&& $_REQUEST['childlvl'] == 15)//if($_REQUEST['level'] >= 6)
       //  {
       //    if($_REQUEST['id'] == 73)
       //    {
       //      $locid='14878';
       //    }
       //    $tablname = 'biweb_sales.'.$locid.'_sales';//'biweb_sales.14878_sales';

       //  }
       //  else if($_REQUEST['parentlvl'] == 15 && $_REQUEST['childlvl'] ==15 )
       //   {
       //      $sql_splittble = "select city_id from biweb.ward_master where refid =".$_REQUEST['id']." and stat !='R'";
       //      $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();
       //      // print_r($res1);die;
       //      $tablname = 'biweb_sales.'.$res1['city_id'].'_sales';
       //   }
       //   else
       //  {
       //    $tablname = 'biweb_sales.hul_city_sales';
       //  }
       //$period = $_REQUEST['year'];

        // print_r($tablname);die;

      // $locationtbl = $locationmaster[$_REQUEST['level']];
     //  $split_tble = 'catgry_master';
       // echo $_REQUEST['tbl'];die;

         $filterchild = '';
         $range = '';
         if(isset($_REQUEST['type']))
         {
          if($_REQUEST['type'] == 'Rn')
          {
            $chidlvlfilter =$_REQUEST['chidlvlfilter'];
            $rangebtw = explode(",",$chidlvlfilter);
            // prin
            $range = 'Having ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) between '.$rangebtw[0].' and '.$rangebtw[1];
          }
          else if($_REQUEST['type'] == 'var')
            {
              if(isset($_REQUEST['chidlvlfilter']))
              {
               //  $filtlc = $_REQUEST['chidlvlfilter'];
               // $filterloc = "a.fld".$_REQUEST['tbl']." IN (".$filtlc.") AND";

                $relatedid = $_REQUEST['chidlvlfilter'];
              }
            }
          else if($_REQUEST['type'] == '')
            {
              if(isset($_REQUEST['chidlvlfilter']))
            {
              $filterloc = $_REQUEST['chidlvlfilter'];
              $filterchild = "a.".$child." in (".$filterloc.") AND";
            }
            }

         }
         else
         {
            if(isset($_REQUEST['chidlvlfilter']))
            {
              $filterloc = $_REQUEST['chidlvlfilter'];
              $filterchild = "a.".$child." in (".$filterloc.") AND";
            }
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
              $retail = 0;
                $mainresultField = "COUNT((fld".$tabl_ids.")) result";
            
            if(count($periods)==1)
            {
             
                  $sql = "select c.location_name as location,a.".$child." loclevel,b.name as title,a.fld".$tabl_ids." as split_id,".$mainresultField.",".$period." as period_Y,c.center_coordinates as center FROM ".$tablname." a
                  join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                  join biweb.".$locationtbl." c on a.".$child." =c.refid
                  WHERE a.".$parent." = ".$locid." and  a.".$child." != 0 AND ".$filterchild."  a.fld".$tabl_ids1." IN (".$relatedid.")  GROUP BY loclevel ".$range.$splitgrp;//,a.rcategory";
                  // echo $sql;die;

                  // if($locationshow==2491)
               // {
                  $locationshow=$_REQUEST['combv'];
                  $s1 = "SELECT * FROM split_combine_view where refid='".$locationshow."'";
                  $que1 = yii::$app->db->createCommand($s1)->queryOne();
                  $split_idc1  =   $que1['menu_id'];
                  $view_optnc1  =   $que1['view_optn'];
                  $splitgrp1= " ,a.fld".$split_idc1;
                  $sql_splittble1 = "select table_name from biweb.menu_object_master where refid =".$split_idc1." and stat !='R'"; 
                  $res11=yii::$app->db2->createCommand($sql_splittble1)->queryOne();
                  $split_tble1 = $res11['table_name'] ;
                  $splitgrp1= " ,a.fld".$split_idc1;
              
               $sqllocation = "select  a.".$child." loclevel,b.name as title,a.address,a.lat,a.lng as lon,a.image_name,a.fld".$split_idc." as fld,d.name FROM ".$tablname." a 
                   left join biweb.".$split_tble1." b on b.refid = a.fld".$split_idc1."
                   join biweb.".$locationtbl." c on a.".$child." =c.refid
                   join biweb.supermarket_master as d on a.fld".$split_idc."=d.refid
                  WHERE a.".$parent." = ".$locid." and  a.".$child." != 0 AND ".$filterchild." ".$fldcondtions." a.lat !='' and a.lng != '' 
                   ";
                  
                  // print_r($sqllocation);die;

               // }
             
            }
            else //time series
            {
              // echo "timeseries";die;
              // echo $_REQUEST['view'] ;die;
              $condtions ='';
              if($_REQUEST['view'] == 2)
              {
                $condtions = "a.period_Y  BETWEEN ".$periods[0]." AND ".$periods[1];
              }
              // else if($_REQUEST['view'] == 5)
              // {
              //   $condtions = "a.period_Y  BETWEEN ".$periods[0]." AND ".$periods[1];
              // }
              else
              {
                $pdata = implode(",",$perioddata);//perioddata
                $condtions = "a.period_Y in(".$pdata.")";
              }
              foreach ($periods as &$value) {
              $value = "p".$value;
              }
              // print_r($periods);exit();
              $filterselect = '';
              if(isset($_REQUEST['filter']))
              {
                $filterselect = "c.location_name as location,b.name as title,a.".$child." loclevel";
              }
              else
              {
                  $filterselect = "c.location_name as location,a.".$child." loclevel,b.name as title,a.fld".$tabl_ids." as split_id,".$mainresultField.",a.period_Y";
              }
              // echo $filterselect;die;
              // echo $condtions;die;
              if(!isset($_REQUEST['filter']))
              {
                if(isset($_REQUEST['id'])){$s11="a.".$parent." = ".$locid." and ";}else{$s11="";}
                 if($_REQUEST['parentlvl'] == 12 ||  ($_REQUEST['parentlvl'] == 15 ))
                {


                   $sql = "select ".$filterselect.",concat(c.latitude,',',c.longitude) as center FROM ".$tablname." PARTITION (".$perids.") a
                    join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                    join biweb.".$locationtbl." c on a.".$child." =c.refid
                    WHERE a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY loclevel,a.period_Y $splitgrp ";


                }
                // elseif($_REQUEST['level'] > 6)
                // {

                //     $sql = "select ".$filterselect.",concat(c.latitude,',',c.longitude) as center FROM ".$tablname." PARTITION (".$perids.") a
                //     left join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                //     left join biweb.".$locationtbl." c on a.".$child." =c.refid
                //     WHERE a.".$parent." = ".$locid." and a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY loclevel,a.period_Y $splitgrp";//
                // }
                else
                {
                  $tablname = 'biweb_sales.hul_city_sales';


                    $sql = "select ".$filterselect.",c.center_coordinates as center FROM ".$tablname." PARTITION (".$perids.") a
                    join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                    join biweb.".$locationtbl." c on a.".$child." =c.refid
                    WHERE $s11  a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY loclevel,a.period_Y,a.fld".$tabl_ids.$splitgrp;//,a.rcategory";
                      // echo $sql;die;


                     // $sql = "select loc15 locid,fld626 split_id,ROUND(SUM(sub2_Q1+sub2_Q2+sub2_Q3+sub2_Q4),2) result,COUNT(DISTINCT(fld632)) shop,period_Y,retailer_code FROM hul_phase1.14878_sales WHERE loc12 = 14878 AND loc15 != 0 AND fld632 != 0 AND fld630 != 0 AND fld626 IN (1) AND fld627 != 0 AND fld628 != 0 AND fld629 != 0 AND fld631 != 0 AND fld639 != 0 AND fld640 != 0 AND fld641 != 0 AND fld1073 != 0 AND period_Y  BETWEEN 2015 AND 2016 GROUP BY locid,split_id,period_Y";


                }
              }
              else
              {
                if(isset($_REQUEST['id'])){$s11="a.".$parent." = ".$locid." and ";}else{$s11="";}
                 if($_REQUEST['level'] == 6)
                {


                   $sql = "select distinct".$filterselect." FROM ".$tablname." PARTITION (".$perids.") a
                    join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                    join biweb.".$locationtbl." c on a.".$child." =c.refid
                    WHERE a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY location";


                }
                elseif($_REQUEST['level'] > 6)
                {

                    $sql = "select distinct ".$filterselect." FROM ".$tablname." PARTITION (".$perids.") a
                    join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                    join biweb.".$locationtbl." c on a.".$child." =c.refid
                    WHERE a.".$parent." = ".$locid." and a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY location";//
                }
                else
                {
                  $tablname = 'biweb_sales.hul_city_sales';

                    $sql = "select distinct ".$filterselect." FROM ".$tablname." PARTITION (".$perids.") a
                    join biweb.".$split_tble." b on b.refid = a.fld".$tabl_ids."
                    join biweb.".$locationtbl." c on a.".$child." =c.refid
                    WHERE $s11 a.".$child." != 0 AND ".$filterchild." a.fld632 != 0 AND a.fld630 != 0 AND a.fld627 != 0 AND a.fld".$tabl_ids1." IN (".$relatedid.") AND a.fld628 != 0 AND a.fld629 != 0 AND a.fld631 != 0 AND a.fld639 != 0 AND a.fld640 != 0 AND a.fld641 != 0 AND a.fld1073 != 0 and ".$condtions."  GROUP BY location";//,a.fld626";//,a.rcategory";
                    // echo $sql;die;


                     // $sql = "select loc15 locid,fld626 split_id,ROUND(SUM(sub2_Q1+sub2_Q2+sub2_Q3+sub2_Q4),2) result,COUNT(DISTINCT(fld632)) shop,period_Y,retailer_code FROM hul_phase1.14878_sales WHERE loc12 = 14878 AND loc15 != 0 AND fld632 != 0 AND fld630 != 0 AND fld626 IN (1) AND fld627 != 0 AND fld628 != 0 AND fld629 != 0 AND fld631 != 0 AND fld639 != 0 AND fld640 != 0 AND fld641 != 0 AND fld1073 != 0 AND period_Y  BETWEEN 2015 AND 2016 GROUP BY locid,split_id,period_Y";


                }
              }

              // SELECT loc15 locid,fld626 split_id,ROUND(SUM(sub2_Q1+sub2_Q2+sub2_Q3+sub2_Q4),2) result,COUNT(DISTINCT(fld632)) shop,period_Y,retailer_code FROM hul_phase1.14878_sales WHERE loc12 = 14878 AND loc15 != 0 AND fld632 != 0 AND fld630 != 0 AND fld626 IN (1) AND fld627 != 0 AND fld628 != 0 AND fld629 != 0 AND fld631 != 0 AND fld639 != 0 AND fld640 != 0 AND fld641 != 0 AND fld1073 != 0 AND period_Y  BETWEEN 2015 AND 2016 GROUP BY locid,split_id,period_Y
            }
           // alter table hul_city_sales add index (loc5,fld632,fld630,fld627,fld626,fld628,fld629,fld631,fld639,fld640,fld641,fld1073)


      }
          // print_r($sql);die;
       
          $res=yii::$app->db2->createCommand($sql)->queryAll();
          $rcnt = count($res);
          if($rcnt == 0)
          {
             echo "data not available";die;
          }
          $locationres=yii::$app->db2->createCommand($sqllocation)->queryAll();
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
                   // print_r($resarray);die;
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
                  $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."' >".$tabletitle[$_REQUEST['tbl']]." Values</th></tr>
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
                      $tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
                    }
                   $tablestr .="</tr></thead> <tbody>";
                  // print_r($locres);die;
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

                                   $amountIND = round( $locres[$locations_ids[$j]][$perioddata[$k]],2);//'1000003.400050'; '283688411.50';//
                                  $amt = explode(".",$amountIND);
                                  $amountIND = moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                                  // print_r($amountIND); die;
                                  if(isset($amt[1]))
                                  {
                                    $amountIND = $amountIND.".".$amt[1];
                                  }
                                  $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";

                                 // $tablestr .= "<td align = 'right'>".number_format( $locres[$locations_ids[$j]][$perioddata[$k]], 0 )."</td>";
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
                          // $tablestr .= "<td align = 'right'>".number_format(  $totalsumperiod, 2 )."</td>";
                             $tablestr .= "<td align = 'right' class = 'totalsum'>".$amountIND."</td>";
                          //$tablestr .= "<td align = 'right'>".number_format(  $totalsumperiod, 2 )."</td>";
                          $totalsumperiod=0;
                        }

                        $tablestr .= "</tr>";
                      }


                    }


                     $jsenolocres = json_encode($locres);
                   $tablestr .="</tbody></table>";
                   $tablestr.="<script>splititems = $resarray; splitarray = JSON.stringify(splititems); itemdetails = $itemdts;itemobj = JSON.stringify(itemdetails);splitot =$jsenolocres; tablebck = JSON.stringify(splitot);</script>";
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
                    if (in_array($_REQUEST['combv'], $retilerschoice) && $_REQUEST['level'] >= 6)
                    {
                      $value['result'] = number_format($value['result'],0);
                    }
                    else
                    {
                      $value['result'] = number_format($value['result'],2);
                    }
                    $resarray[$value['period_Y']][$value['loclevel']][$value['split_id']] = $value;
                  }
                  // die;

                  // print_r($resarray);die;
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
             //contribut_tot

                $contribut_tot = 0;
              foreach ($res as $item) {
                 // print_r($item[]);die;
              $contribut_tot += $item['result'];
              }
              // print_r($contribut_tot);die;
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
                          $tablestr .="<th align = 'center'>".$part." Values (Rs.)</th>";
                            $tablestr .="<th align = 'center'>Contrbtn Share(%)</th>";
                      };
                    }

                  }
                  $countingi++;
                  }
                  // die;
                }
                $tablestr .="</tr>
                </thead> <tbody>";
                // echo $tablestr;die;
                // print_r($locres);die;
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

                                    //echo $amount.".".$amt[1];die;   number_format( $res[$k]['result'], 2 )
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
                $jsenolocres = json_encode($locres);
                // print_r($splitot);die;
                $tablestr.="<script>splititems = $resarray; splitarray = JSON.stringify(splititems); itemdetails = $itemdts;itemobj = JSON.stringify(itemdetails); splitot =$jsenolocres; tablebck = JSON.stringify(splitot);</script>";
                 // echo $tablestr;die;
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
              // print_r($tablestr); die;
              array_push($final_resul_arry, $tablestr);
              $grp = graphwrk_split($res,$view_optnc, $perioddata,$relatedid,$split_tble);
              // print_r($grp);die;
              $colorarr = $grp[1];
              $grp = $grp[0];
              // print_r($colorarr);die;
               // print_r($colorstor);die;
              // print_r($grp);die;
              // print_r(Yii::$app->session);die;
              // $session = Yii::$app->session;

              array_push($final_resul_arry, $grp);
              $mapwrk = mapwrk_split($res,$retail,$periods,$view_optnc);
              if($_REQUEST['view'] !=3){
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
              array_push($final_resul_arry, $mapwrk);
              array_push($final_resul_arry,count($perioddata));
              // array_push($final_resul_arry,'(Rs.)');
              array_push($final_resul_arry,json_encode($locationres));
              array_push($final_resul_arry,json_encode($colorarr));
              array_push($final_resul_arry,'(Rs.)');
              // array_push($final_resul_arry,json_encode($locationres));

}

function mapwrk_svg($mapwrk,$colorarr)
{
    
    $filename = '';
    $replicfile = '';
  


          $mainlocation = $_REQUEST['parentlvl'];
      $selectedlocation = $_REQUEST['id'];
      $sublocation = $_REQUEST['childlvl'];
      if($_REQUEST['parentlvl'] != '21')
      {
        if($mainlocation==$sublocation)
        {
          $sql="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;
          
          $res=yii::$app->db->createCommand($sql)->queryOne();
          // print_r($res);die;
          $yu=($res['master_table']=='country_master') ? 'refid as country_id' : 'country_id';

          $sql2="select ".$yu.",center_coordinates from ".$res['master_table']." where refid=".$selectedlocation;
          $res2=yii::$app->db->createCommand($sql2)->queryOne();
          // print_r($res2);die;

        }
        else
        {
            if($_REQUEST['id'] == 14878 && $_REQUEST['parentlvl'] == 12 && $_REQUEST['childlvl'] ==15)
            {
              $res['master_table'] = 'city_master';
            }
            else
            {
               $sql="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
                $res=yii::$app->db->createCommand($sql)->queryOne();
            }


             
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

              $sql2="select * from ".$res['master_table']." where refid=".$selectedlocation;
              // print_r($sql2);die;
              $res2=yii::$app->db->createCommand($sql2)->queryOne();

        }
      }



      if($_REQUEST['parentlvl'] == '21')
      {
        $svgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      
            
      }
      else
      {
        $svgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---f.svg";

        $replicsvgfilen = "SVG/".$res2['country_id']."/".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."/".$_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";
      }

      

    
    $totsvg = file_get_contents($svgfilen);
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
          // print_r($totsvg);//die;
          // echo http_build_query($value,'',', ');die;

    }


    //     $svgstr = '&lt;defs&gt;
    // &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';
 // $svgstr = '<defs>
 //    <linearGradient id="solids'.$1.'" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(0, 0, 0);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(0, 0, 0);stop-opacity:1">';



  
          $totsvg = preg_replace('/\~\~\~\~\~([A-z])+([0-9]+)\~\~\~\~\~/m', '<defs>
    <linearGradient id="solids$2" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(255, 255, 255);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(255, 255, 255);stop-opacity:1"/></linearGradient > </defs >', $totsvg);

        $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");

        fwrite($myfile, "\n". $totsvg);
        fclose($myfile);

       

}



echo json_encode($final_resul_arry);
// echo $final_resul_arry[1];


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


function fillcolor_insvg($values,$cc,$arord,$filename,$replicfile,$locid,$totsvg,$colorarr)
{


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

















 if( isset($_REQUEST['fileid'] ) )
{
       $r=array();

        $mastername = $_REQUEST['mastername'];
        $passid = $_REQUEST['passid'];
        $fileid = $_REQUEST['fileid'];
         $mainloc=$_REQUEST['mainloc'];
         $subloc=$_REQUEST['subloc'];

        $selectdata ="SELECT  location_name FROM `".$mastername."` where ".$passid."='".$fileid."' and stat!='R' ";
         $query = yii::$app->db->createCommand($selectdata)->queryAll();

         for($i=0;$i<count($query);$i++)
        {
                $r[$i]= $query[$i]['location_name'];

        }
 echo json_encode($r);




        // echo $selectdata;
        // die;
      // echo $selectdata;

     }













?>