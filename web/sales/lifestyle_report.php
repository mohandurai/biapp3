<?php
error_reporting(0);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../../config/web.php');
new yii\web\Application($config); 
use yii\helpers\ArrayHelper;
setlocale(LC_MONETARY, 'en_IN');
ini_set('memory_limit', '1024M');

Class Lifecoloraction
{
   
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
      
            }
            return $GradientColors;
    }


    function getsplitcolourchart($d)
    {
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
           
         
        }
    }
   function cmp($a, $b)
   {
    
          return $b["value"] - $a["value"];
   }
   function cmpgrowth($a, $b) {
   
          return $b["growth"] - $a["growth"];
   }

   function colorcount($d)
   {
              
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
}
Class Lifegraphaction 
{
   function getsplitcolourchart($d)
    {
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
           
         
        }
    }
  function graphwrk($res, $view_optnc, $perioddata)
  {
  $combine = "";
  $view = $_REQUEST['view'];
  $relevel = $_REQUEST['level'];
  $rcnt = count($res);
  $titlearrgrowth = array();
  $titlearr = array();
  $titlearr2 = "";
  $dataarr = array();
  $dataarr1 = array();
  $lastarr = array();
  $lastarr1 = array();
  $retailers = array();
  $locationvalindex = array(); //added by robin
  if ($rcnt > 0)
    {
    $sum = 0;
    if ($view == 0 || $view == 5)
      {
      for ($k = 0; $k < count($res); $k++)
        {
        if ($res[$k]['location'] != '')
          {
          $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location']; //added by robin
          array_push($titlearr, $res[$k]['location']);
          $titlearr2.= '"' . $res[$k]['location'] . '",';
          array_push($dataarr, $res[$k]['result']);
          array_push($dataarr1, $res[$k]['loclevel']);
          array_push($retailers, $res[$k]['retail']); //}

          $sum = $sum + $res[$k]['result'];
          }
        }

      $titlearr3 = trim($titlearr2, ",");
      $bc = array();
      $bc['color'] = array();
      $a = array();
      for ($k = 0; $k < count($titlearr); $k++)
        {
        $s = (($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6) ? (int)$dataarr[$k] : (int)$dataarr[$k];
        $a[$k] = array(
          $titlearr[$k],
          'y' => $s,
          'mydata' => $dataarr1[$k]
        );
        $per = ($dataarr[$k] / $sum) * 100;
        $obj=new Lifecoloraction();
        array_push($bc['color'], $obj->colorcount((int)$per));
        }

      $v = (($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6) ? "Retailers" : $combine;
      $b = array(
        "showInLegend" => "false",
        "name" => $v,
        "data" => $a
      );
      }
      else
    if ($view == 1 || $view == 2)
      {
      $arr_new = array();
      $stand = array();
      $b = array();
      $bq = array();
      $sum = 0;
      for ($k = 0; $k < count($res); $k++)
        {
        if ($res[$k]['location'] != '')
          {
          $titlearr = $perioddata;
          if (!in_array($res[$k]['location'], $stand))
            {
            array_push($stand, $res[$k]['location']);
            $bq[$res[$k]['location']] = array();
            }

          $s = (($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6) ? (int)$res[$k]['result'] : (int)$res[$k]['result'];
          $arr_new[$res[$k]['loclevel']][$res[$k]['period_Y']] = $s;
          $arr_loc[$res[$k]['loclevel']] = $res[$k]['location'];
          array_push($bq[$res[$k]['location']], $s);
          }

        $sum = $sum + (int)$res[$k]['result'];
        }

      $l = 0;
      foreach($arr_loc as $key => $value)
        {

        // code...

        $arreset = array_values($arr_new[$key]);
        $b[$l] = array(
          "name" => $value,
          "data" => $arreset,
          "mydata" => $key
        );
        $l++;
        }
      }
      else
    if ($view == 3)
      {
      $period = $perioddata;
      $newresarr = array();
      foreach($res as $key => $value)
        {
        $newresarr[$value['locid']] = $value['location'];
        }

      for ($k = 0; $k < count($res); $k++)
        {
        if ($res[$k]['location'] != '' && !in_array($res[$k]['location'], $titlearr))
          {
          array_push($titlearr, $res[$k]['location']);
          $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location']; //added by robin
          }

        $titlearr2.= '"' . $res[$k]['location'] . '",';
        $s1 = (($view_optnc == 3 || $view_optnc == 5) && $_REQUEST['level'] >= 6) ? (int)$res[$k]['retail'] : (int)$res[$k]['result'];
        $dataarr[$res[$k]['location']][$res[$k]['period_Y']] = $dataarr[$res[$k]['period_Y']] + $s1;
        $dataarrgrwoth[$res[$k]['locid']][$res[$k]['period_Y']] = $dataarr[$res[$k]['period_Y']] + $s1;
        array_push($dataarr1, $res[$k]['loclevel']);
        }

      $arkey = 0;
      foreach($newresarr as $key => $value)
        {

        // code...

        $dataarrgrwoth[$key]['per'] = (($dataarrgrwoth[$key][$period[count($period) - 1]] - $dataarrgrwoth[$key][$period[0]]) / $dataarrgrwoth[$key][$period[0]]) * 100;
        $a1[$arkey] = array(
          'y' => $dataarrgrwoth[$key]['per'],
          'mydata' => $key
        );
        $arkey++;
        }

      $b = array(
        "name" => $combine,
        "data" => $a1
      );
      }
    }
    else
    {
    echo "Error !!!!";
    }

  // coded by robin for sorting bar

  if (($_REQUEST['view'] == 0) || ($_REQUEST['view'] == 3) || ($_REQUEST['view'] == 5)) //cummaltive || ($_REQUEST['view'] == 3 )
    {
    $sortarnew = array();
    $bdata = array();
    for ($re = 0; $re < count($b['data']); $re++)
      {
      $sortarnew[$b['data'][$re]['mydata']] = $sortarnew[$b['data'][$re]['mydata']] + $b['data'][$re]['y'];
      $bdata[$b['data'][$re]['mydata']] = $b['data'][$re];
      }

    asort($sortarnew, SORT_NUMERIC);
    $newcategrory = array();
    $newbdata = array();
    $tt = array_reverse($sortarnew, true);
    foreach($tt as $key => $value)
      {
      array_push($newcategrory, $locationvalindex[$key]);
      array_push($newbdata, $bdata[$key]);
      }

    $b['data'] = $newbdata;
    $titlearr = $newcategrory;
    }

  $jsonc = json_encode($titlearr);
  $jk1 = json_encode($b);
  if ($view < 1 || $view == 5)
    {
    $jk = "[$jk1]";
    $colorn = json_encode($bc['color']);
    $c = "colors:$colorn,";
    }
    else
  if ($view == 3)
    {
    $jk = "[$jk1]";
    $colorn = json_encode($bc['color']);
    $c = "colors:$colorn,";
    }
    else
    {
    $jk = "$jk1";
    $c = "";
    }

  if (count($titlearr) > 10)
    {
    $minmax = " min : 0,
                max : 9,";
    }
    else
  if (count($titlearr) > 5 && count($titlearr) < 10)
    {
    $minmax = " min : 0,
                max : " . count($titlearr) . ",";
    }
    else
    {
    $minmax = "";
    }

  if ($view == 0 || $view == 3)
    {
    $typechart = "column";
    }
    else
  if ($view == 1 || $view == 2)
    {
    $typechart = "line";
    }
    else
    {
    $typechart = "column";
    }

  $relevel = 1;
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
  return $response;
  }
  function graphwrk_split($res,$view_optnc, $perioddata,$relatedid,$split_tble,$boolsplitgroupby)
{
   $sql_splittable= "select refid,name from biweb.".$split_tble." where refid IN (".$relatedid.") and stat != 'R'";
   $split_res=yii::$app->db2->createCommand($sql_splittable)->queryAll();           
   $split_dts = json_encode($split_res);
   $rcnt = count($res);
   $cls =  '';
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
            
         if(!in_array($value['location'], $namearr))
             {
              $locationvalindex[$value['loclevel']] = $value['location'];
              array_push($namearr,$value['location']);
              
             }
            $split_name[$value['split_id']]=$value['title'];
            $trob[$value['split_id']][$value['loclevel']]['y'] =   $trob[$value['split_id']][$value['loclevel']]['y'] +$value['result'];
             $trob[$value['split_id']][$value['loclevel']]['mydata'] = $value['loclevel'];
           
       }

        $r=0;
          $obj=new Lifecoloraction();

        $colorarr=$obj->Gradient("004000","1aff1a", count($res));

        foreach ($split_name as $key => $value)
        {

           $dataval = array_values($trob[$key]);
            if($boolsplitgroupby==true)
            {

               
              array_push($totalarr,array('name'=>$value,'color'=> $colorarr[$r],'split_id'=>$key,'data'=>$dataval));
              $colorstor[$key] = $obj->colorcount($value);

            }
            else
            {
              array_push($totalarr,array('name'=>$value,'color'=>$this->getsplitcolourchart($r),'split_id'=>$key,'data'=>$dataval));
              $colorstor[$key] = $this->getsplitcolourchart($r);
            }
           
           $r++;
           if($r == 9)
           {
            $r=0;
           }
        }


    }

    else if($view==1 || $view==2)
    {
        $typechart="line";
        $stand=array();$b=array();$bq=array();$sum=0; $namearr=array();
        $totalarr=array();
        $splitindex = array();//Added by robin
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
        
         $l=0;
         $r=0;
          foreach ($trob as $key => $value) {
          
            $totalarr[$l]=array("name"=>$value['name'],"color"=>$this->getsplitcolourchart($r),"data"=>array_values($value['data']));
            $l++;
             $colorstor[$key] = $this->getsplitcolourchart($r);
             $r++;
             if($r == 9)
             {
              $r=0;
             }
          }
        


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
      
       for($k=0;$k<count($res);$k++) {  
        if($res[$k]['title'] != '' && !in_array($res[$k]['title'], $namearr)){
           array_push($namearr,$res[$k]['title']);
           $locationvalindex[$res[$k]['loclevel']] = $res[$k]['location'];
           $itemlvlindex[$res[$k]['split_id']] = $res[$k]['title'];

        }
          $namearr2 .= '"'.$res[$k]['title'].'",';
          $dataarr[$res[$k]['title']][$res[$k]['period_Y']]=$dataarr[$res[$k]['period_Y']]+$res[$k]['result'];
        $dataarrgrwoth[$res[$k]['split_id']][$res[$k]['period_Y']]=$dataarrgrwoth[$res[$k]['split_id']][$res[$k]['period_Y']]+$res[$k]['result'];
        
           array_push($dataarr1,$res[$k]['split_id']);
        } 
           
            $bc['color'] = array();
            $negativecnt = 0;
            $postivecnt = 0;
             foreach ($newresarr as $key => $value) {
            # code...
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
                $t = $this->colorcount((int)$dataarrgrwoth[$key]['per']);
                 array_push($bc['color'],$t);

                $arkey++; 
        }
        $postivecolor =array();
        $negativecolor = array();
        if($negativecnt > 0)
        {
            $negativecolor =  Gradient("ff0000","ffcccc", $negativecnt);
            array_pop($negativecolor);
            $negativecolor= array_reverse($negativecolor);
        }
        if($postivecolor> 0)
        {
          $postivecolor =  Gradient("004000","1aff1a", $postivecnt);
        }
        array_pop($postivecolor);
        $cls = array_merge($postivecolor,$negativecolor);
        $totalarr=array(array("name"=>$combine,"data"=>$a1));  
    }
        
    if($view==3){$colorn=json_encode($cls); $c=  "colors:$colorn,";}else{$c="";}
    if(($_REQUEST['view'] == 0 ) || ($_REQUEST['view'] == 3 ) || ($_REQUEST['view'] == 5 ))//cummaltive  || ($_REQUEST['view'] == 3 )
    {
      $bdata = array();
      for($f=0;$f<count($totalarr);$f++)
      {
        $bdatasp = $totalarr[$f]['data'];
        for($re=0;$re<count($bdatasp);$re++)
        {
          $sortarnew[$bdatasp[$re]['mydata']] = $sortarnew[$bdatasp[$re]['mydata']] +$bdatasp[$re]['y'];
          $bdata[$f][$bdatasp[$re]['mydata']] = $bdatasp[$re]; 
        }
      }
      asort($sortarnew, SORT_NUMERIC);
      $newcategrory = array();      
      $tt = array_reverse($sortarnew, true);
      $dummy = $totalarr;
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
          $tempt++;
          array_push($newbdata,$bdata[$f][$key]);

        }
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
                                                                  
                                                            statuscode1=UrlExists(baseurl+"/KML/"+this.mydata+"---"+requestlevel+".kml");
                                                               if(statuscode1 == true)
                                                               {
                                                                 map.eachLayer(function (layer) {
                                                                        map.removeLayer(layer);
                                                                        });
                                                                initial("KML/"+this.mydata+"---"+requestlevel+".kml",requestlevel,'');
                                                               }
                                                              else
                                                              {
                                                                alert("Data Not available");
                                                              }
                                                    
                                                  }
                                                  else
                                                  {
                                                       requestlevel1=requestlevel+1;
             
                                                       statuscode1=UrlExists(baseurl+"/KML/"+this.mydata+"---"+requestlevel1+".kml");
                                                     if(statuscode1 == true)
                                                       {
                                                         map.eachLayer(function (layer) {
                                                                        map.removeLayer(layer);
                                                                        });
                                                          initial("KML/"+this.mydata+"---"+requestlevel1+".kml",requestlevel1,this.mydata);
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
      $returarrya = array();
      array_push($returarrya, $response);
      array_push($returarrya, $colorstor);
      return $returarrya;
    } 
    else if ($view == 0 || $view == 5){
 
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
 

}
Class Lifemapaction 
{
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
            
           for($k=0;$k<count($world);$k++)
                  {
           
                      $worldcount[$k]=(($dataarr[$locat[$k]][$period[count($period)-1]]-$dataarr[$locat[$k]][$period[0]])/$dataarr[$locat[$k]][$period[0]])*100;
                  }

            natsort($worldcount);
            $worldcount = array_reverse($worldcount,true);
            $j=0;
            foreach ($worldcount as $key => $value) 
            {
           
              $r1234=$world[$key].'****'.$worldcount[$key].'****'.$sum.'****'.$worldcount[$key];
              $localworld[$j]=$r1234;
              $j++;
           
            }
         
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
              
                $r1234=$key.'****'.$value.'****'.$sumallretail.'****'.$sumofrt[$key];
                $localworld[$jj]=$r1234;
                $jj++;
             }

          }
          else
          {
            $locidarray = array();
            for($v=0;$v<count($resworld);$v++)
            {
                $locidarray[$resworld[$v]['loclevel']]['result'] = $locidarray[$resworld[$v]['loclevel']]['result']+$resworld[$v]['result'];
                $sum=$sum+$resworld[$v]['result'];
            }
            $i = 0;
            foreach ($locidarray as $key => $value) 
            {
              # code...
                       $r1234=$key.'****'.$value['result'].'****'.$sum.'****'.'0';//$retailers[$i];
                       $localworld[$i]=$r1234;
                       $i++;
            }

           
          }

         
        }
       
        return $localworld;
  }
  function mapwrk_split($res,$retail,$periods,$view_optnc)
  {
    $resdist = $res;
     if($_REQUEST['view'] != 3)
            {
             
              if($view_optnc == 3 || $view_optnc == 5)
              {
                $summ_array = array();
                $items =array();
                $centerloc = array();
                foreach ($resdist as $key => $value) 
                {
                 
                  $summ_array[$value['loclevel']][$value['split_id']] =  $summ_array[$value['loclevel']][$value['split_id']]+$value['result'];
                  $items[$value['split_id']] = $value['title'];
                  $centerloc[$value['loclevel']] = $value['center'];
                }
                array_unique($items);
                array_unique($centerloc);
                 foreach ($summ_array as $locid => $value) 
                 {
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
                    $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['name'] = $resdist[$v]['title'];
                    $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['value'] = $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['value']+$resdist[$v]['result'];
                    $world[$resdist[$v]['loclevel']][$resdist[$v]['split_id']]['center'] = $resdist[$v]['center'];


                } 
              }
              // 

              foreach ($world as $key => $value) { //Sorting descending order based on value 
                # code...
               
                uasort($value, 'cmp');
                
                 $newword[$key] = $value;
               
              }


              $world = $newword;
              
              return  $world;
            }
          else
          { 

              $localworld = array();
             
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
              }

            
            uasort($sortarr, 'cmpgrowth');
            foreach ($sortarr as $key => $value) {
               $s = $key.'****'.$value['growth'].'****'.$value['sum'];
                array_push($localworld,$s);
            }
            return $localworld; 

          }

  }
}
Class Lifemoneyaction 
{
    function moneyFormatIndia($num)
   {
   
    $explrestunits = "" ;
    $cmtcnt =0;
    if(strlen($num)>3) {
    $lastthree = substr($num, strlen($num)-3, strlen($num));
    $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
   
    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the 
    $firstrestunits = (substr($restunits, 0, -4));
    $firstrestunits = (int)$firstrestunits;
    $midrestunits = substr($restunits, strlen($restunits)-4);
    $expunit = str_split($midrestunits, 2);
    for($i=0; $i<sizeof($expunit); $i++) {
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

} 
Class Lifelocation
{
  
  public function findlocation($mainlocation,$sublocation)
  {
      if($mainlocation==$sublocation)
     {
      $sqlmaster="select refid,master_table from Geo_Hrchy_master where refid=".$mainlocation;  
      
     }
     elseif($mainlocation!=$sublocation)
     {
        $sqlmaster="select refid,master_table from Geo_Hrchy_master where refid=".$sublocation;
     }
     $res=yii::$app->db->createCommand($sqlmaster)->queryOne();
     return $res['master_table'];
  }
}
Class Liferesult extends Lifelocation
{
  public function tablebuild($finalres,$locid,$split_tble,$mastertbl,$menuids,$main,$sub,$year,$view,$filter,$perioddata,$splitgroupby,$perids)
  {
    
   if($splitgroupby != '2491')
    {
        $sqlmenuids = "select group_concat(name) as title,maintype from ".$split_tble." where refid in ($menuids) group by maintype_id ";
        $res=yii::$app->db->createCommand($sqlmenuids)->queryOne();

        $thtitle=(count(explode(",",$menuids)) <= 3) ? $res['title'] : $res['maintype'];

        $sqlmaster="select refid,master_table from Geo_Hrchy_master where refid=".$main;
        $masterres=yii::$app->db->createCommand($sqlmaster)->queryOne();
        $maplevel="select * from map_level where main_location=".$main." and sub_location=".$sub;
        $maplevelres=yii::$app->db->createCommand($maplevel)->queryOne();
        $sqllocation="select location_name from ".$masterres['master_table']." where refid=".$locid;
        $location=yii::$app->db->createCommand($sqllocation)->queryOne();

        $thlocation=$location['location_name'].' '.$maplevelres['label_toggle'];
     }
    else
    {
      $thtitle='';
      $thlocation='';

    }
     
    $tablestr="";
    $timelinedata = array();
    $periods = explode(",",$year);

    if(count($periods) > 1)  //Timeseries
      {  
          $firstperiod= 0;
          $lastperiod=0; 
          if($view == 3)
          {
            $firstperiod = $perioddata[0];
            $lastperiod=$perioddata[(count($perioddata)-1)];
          }
        
          if($filter==false)
          {
              
              $resarray = array();
              $locations_ids = array();
              $items_id = array();
              $locationsnme = array();
              $locres = array();
              $itemdts = array();
              $retilerschoice=array();

              foreach($finalres as $key=>$value) 
              {
               
                array_push($locations_ids,$value['loclevel']);
                array_push($items_id,$value['split_id']);
                array_push($itemdts,$value['split_id']."/".$value['title']);
                $locationsnme[$value['loclevel']] = $value['location'];
                $locres[$value['loclevel']][$value['period_Y']] = $locres[$value['loclevel']][$value['period_Y']] + $value['result'];
                $value['result'] = $value['result'];

                $resarray[$value['loclevel']][$value['period_Y']][$value['split_id']] = $value;
              }
              
             
              $resarray = json_encode($resarray);
              $locations_ids = array_unique($locations_ids);
              $locations_ids = array_values($locations_ids);
              $items_id = array_unique($items_id);
              $allitemids =  implode(",",$items_id);
              $itemdts = array_unique($itemdts);
              $itemdts = array_values($itemdts);
              $itemdts = json_encode($itemdts);

              $l=0;
              $r=0;
             

              $columspan = 3+(int)(count($perioddata));
              $tablestr.="<table id='example2'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
              $tablestr .="<thead><tr><th align = 'center' colspan='".$columspan."' >".$thtitle." - ".$firstperiod."-".$lastperiod."</th></tr>
              <tr>";
              $tablestr .="<th>&nbsp;</th>";
              $tablestr .="<th>".$thlocation."</th>";
               $tablestr .="<th>".$thtitle." (Nos)</th>";

               if($view != 0 && $view != 5)
               {
                  for($h=0;$h<count($perioddata);$h++)
                  {
                  $tablestr .="<th>".$perioddata[$h]."</th>";
                  }
                  if($view == 3)
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
                  $tablestr .="<th>Cummaltive (".implode(",",$perioddata).")</th>";
                }
               $tablestr .="</tr></thead> <tbody>";
             
                if (count($finalres) > 0) 
                {
               
                 
                  $total_result = 0;

                  for($j=0;$j<count($locations_ids);$j++)
                  {
                    $tablestr .= "<tr id='".$locations_ids[$j]."' level='".$level."'>";
                    $tablestr .= "<td  class='display nowrap details-control' locname='".$locationsnme[$locations_ids[$j]]."'  count='".$locations_ids[$j]."' splitids = '".$allitemids."' level='".$level."'></td>";
                    $tablestr .= "<td>".$locationsnme[$locations_ids[$j]]."</td>";
                    $totalsumperiod = 0;
                   // print_r($tablestr);die;
                    for($k=0;$k<count($perioddata);$k++)
                    {
                      if( $locres[$locations_ids[$j]] != 0)
                      {
                        if($perioddata[$k] == $firstperiod)
                        {
                        $firstval = $locres[$locations_ids[$j]][$perioddata[$k]];
                        }
                        if($perioddata[$k] == $lastperiod)
                        {
                        $lastval = $locres[$locations_ids[$j]][$perioddata[$k]];
                        }
                            if($view != 0 && $view != 5){

                          if (in_array($splitgroupby, $retilerschoice) && $level >= 6)      
                          {
                             $tablestr .= "<td align = 'right'>". $locres[$locations_ids[$j]][$perioddata[$k]]."</td>";
                          }
                          else
                          {
                               $tablestr .= "<td align = 'right'>". $locres[$locations_ids[$j]][$perioddata[$k]]."</td>";
                          }


                       
                        }
                        if($view != 3){
                        $totalsumperiod = $totalsumperiod + floatval($locres[$locations_ids[$j]][$perioddata[$k]]);}


                      }

                    }
                    if($view == 3)
                    {
                      $growthrate = (($lastval-$firstval)/$firstval)*100;
                      $tablestr.="<td  align = 'right'>".$growthrate."%</td>";
                    }
                    else
                    {
                      $tablestr .= "<td align = 'right'>".$totalsumperiod."</td>";
                      $totalsumperiod=0;
                    }

                    $tablestr .= "</tr>";
                  }


                }



               $tablestr .="</tbody></table>";
               $tablestr.="<script>splititems = $resarray; splitarray = JSON.stringify(splititems); itemdetails = $itemdts;itemobj = JSON.stringify(itemdetails);</script>";
              // print_r($tablestr);die;
            }
            else
            {
                  $tablestr .="<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
                  $tablestr .='<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
                  $tablestr .="<tbody>";

                  if (count($finalres) > 0) 
                  {
                  for($k=0;$k<count($finalres);$k++)
                  {
                  $tablestr .="<tr id='".$finalres[$k]['loclevel']."' level='".$level."'>";
                  $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$finalres[$k]['loclevel']."'></td> <td> ".$finalres[$k]['location']."</td>";
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
        $locationmap=array();
        $retilerschoice=array();
       
        foreach($finalres as $key=>$value) 
        {

          array_push($locations_ids,$value['loclevel']);
           array_push($itemdts,$value['split_id']."/".$value['title']);
          $locationsnme[$value['loclevel']] = $value['location'];

          $locres[$value['loclevel']] = $locres[$value['loclevel']] + $value['result'];
          // $value['result'] = number_format($value['result'],2);
         
            $value['result'] = $value['result'];
         
          $resarray[$value['period_Y']][$value['loclevel']][$value['split_id']] = $value;
          // print_r($value['period_Y']);
        }
       // print_r($finalres);die;
        $resarray = json_encode($resarray);
        $locations_ids = array_unique($locations_ids);
        $locations_ids = array_values($locations_ids);
        $items_id = array_unique($items_id);
        $itemdts = array_unique($itemdts);
        $itemdts = array_values($itemdts);
        $itemdts = json_encode($itemdts);
        $comb =0 ;

          if($comb==0) {
          $title2 = "Values";    
          } else {
          $title2 = "Count";
          }
           $contribut_tot = 0;
            foreach ($finalres as $item) {
            $contribut_tot += $item['result'];
            }
          if($filter==false)
          {
            $tablestr.="<table id='example2'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
            $tablestr .="<thead><tr>";//<tr><th colspan='3' >Detailed Report</th></tr>
            $tablestr .="<th>&nbsp;</th>";
            $countingi=0;
            $titleval = '';
            for($i=0;$i<count($finalres);$i++)
            {
              foreach($finalres[$i] as $key=>$value) 
              {
            
              if($countingi==0)
              {
             
                if($key != 'loclevel')
                { 
                  //$titleval= $part;
                  $tablestr .="<th>".$thlocation."</th>";
                
                      $tablestr .="<th align = 'center'>".$thtitle." (Nos.)</th>";
                
                   $tablestr .="<th align = 'center'>Contrbtn Share(%)</th>";
                }

              }
              $countingi++;
              }
             
            }
            $tablestr .="</tr>
            </thead> <tbody>";
            
            if (count($finalres) > 0) 
            {
           
              for($k=0;$k<count($perids);$k++)
              {
                $total_result = 0;
                  for($j=0;$j<count($locations_ids);$j++)
                  {
                    if( $locres[$locations_ids[$j]] != 0){
                      $tablestr .= "<tr id='".$locations_ids[$j]."' level='".$level."'>";
                      $tablestr .= "<td  class='display nowrap details-control' locname='".$locationsnme[$locations_ids[$j]]."' count='".$locations_ids[$j]."' splitids = '' level='".$level."'></td>";
                      $tablestr .= "<td>".$locationsnme[$locations_ids[$j]]."</td>";

                     


                                $amountIND = round($locres[$locations_ids[$j]],2);//'1000003.400050'; '283688411.50';//
                                $amt = explode(".",$amountIND);
                                $money=new Lifemoneyaction();
                                $amountIND = $money->moneyFormatIndia( $amt[0] ); //moneyFormatIndia IND_money_format
                               
                                if(isset($amt[1]))
                                {
                                $amountIND = $amountIND.".".$amt[1];
                                }
                               
                                   $tablestr .= "<td align = 'right' class = 'resultfield'>".$amountIND."</td>";
                                $tablestr .= "<td align = 'right' class = 'contrbute_share'>".number_format(($locres[$locations_ids[$j]]/$contribut_tot)*100,2)."</td>";
                             
                         

                      $tablestr .= "</tr>";
                    }
                     
                  }
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

            if (count($finalres) > 0) 
            {
            for($k=0;$k<count($finalres);$k++)
            {
            $tablestr .="<tr id='".$finalres[$k]['loclevel']."' level='".$level."'>";
            $tablestr .= "<td><input type='checkbox' name='filcheckbox' value='".$finalres[$k]['loclevel']."'></td> <td> ".$finalres[$k]['location']."</td>";
            $tablestr .= "</tr>";
            }
            }
            $tablestr .="</tbody></table>";


          }
      }
  return $tablestr;

 
     

  }

  function Combinetablebuild($res,$locid,$split_tble,$locationtbl,$menuids,$main,$sub,$year,$view,$filter,$perioddata,$level,$splitgroupby,$perids)
  {

    $sqlmenuids = "select group_concat(name) as title,maintype from ".$split_tble." where refid in ($menuids) group by maintype_id ";
    $result=yii::$app->db->createCommand($sqlmenuids)->queryOne();

    $thtitle=(count(explode(",",$menuids)) <= 3) ? $result['title'] : $result['maintype'];

    $sqlmaster="select refid,master_table from Geo_Hrchy_master where refid=".$main;
    $masterres=yii::$app->db->createCommand($sqlmaster)->queryOne();
    $maplevel="select * from map_level where main_location=".$main." and sub_location=".$sub;
    $maplevelres=yii::$app->db->createCommand($maplevel)->queryOne();
    $sqllocation="select location_name from ".$masterres['master_table']." where refid=".$locid;
    $location=yii::$app->db->createCommand($sqllocation)->queryOne();

    $thlocation=$location['location_name'].' '.$maplevelres['label_toggle'];
    $rcnt = count($res);
    $tablestr = "";
    if ($comb == 0)
         $title2 = "Values";
    else
        $title2 = "Count";
  
   if (count($perioddata) > 1)
   {
      $firstperiod = 0;
      $lastperiod = 0;
      if ($filter==false)
      {
          if ($view == 3)
            {
            $firstperiod = $perioddata[0];
            $lastperiod = $perioddata[(count($perioddata) - 1) ];
            }

          $l = 0;
          $r = 0;
          $locationlevels = array();
          $locationname = array();
          foreach($res as $key => $value)
            {
            $timelinedata[$value['loclevel']][$value['period_Y']] = $value;
            $locationlevels[$l++] = $value['loclevel'];
            $locationname[$r++] = $value['location'];
            }

          $locationlevels = array_unique($locationlevels);
          $locationlevels = array_values($locationlevels);
          $locationname = array_unique($locationname);
          $locationname = array_values($locationname);
          $columspan = 2 + (int)(count($perioddata)); 

          $tablestr.= "<table id='example19'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
          $tablestr.= "<thead><tr><th align = 'center' colspan='" . $columspan . "'>" . $thtitle . " (Nos.)</th></tr>
                  <tr>";
          $tablestr.= "<th>".$thlocation."</th>";
          if (($view == 0) && (count($periods) > 1)) //checking cummaltive more than a year continues
            {
            $tablestr.= "<th>Cummaltive (" . implode(",", $perioddata) . ")</th>";
            }
            else
          if (($view == 5) && (count($periods) > 1)) //checking cummaltive more than a year for multiple
            {
            $tablestr.= "<th>Cummaltive (" . implode(",", $perioddata) . ")</th>";
            }
            else
            {
            for ($h = 0; $h < count($perioddata); $h++)
              {
              $tablestr.= "<th>" . $perioddata[$h] . "</th>";
              }

            if ($view == 3)
              {
              $tablestr.= "<th>Growth</th>";
              }
              else
              {
              $tablestr.= "<th>Total for Select Period</th>";
              }
            }

          $tablestr.= "</tr>
                  </thead> <tbody>";
          $firstval = 0;
          $lasval = 0;
          for ($k = 0; $k < count($locationlevels); $k++)
            {
            $tablestr.= "<tr id='" . $locationlevels[$k] . "' level='" . $level . "'>";
            $totalsumperiod = 0;
            $firstval = 0;
            $lastval = 0;
            $tablestr.= "<td>" . $locationname[$k] . "</td>";
            for ($f = 0; $f < count($perioddata); $f++)
              {
              if (($view == 0) && (count($periods) > 1))
                {
                if ($f == 1)
                  {
                  break;
                  }
                }
                else
              if (($view == 5) && (count($periods) > 1))
                {
                if ($f == 1)
                  {
                  break;
                  }
                }

              $tablestr.= "<td align = 'right'>" . $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'] . "</td>";
              if ($view == 3)
                {
                if ($perioddata[$f] == $firstperiod)
                  {
                  $firstval = $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'];
                  }

                if ($perioddata[$f] == $lastperiod)
                  {
                  $lastval = $timelinedata[$locationlevels[$k]][$perioddata[$f]]['result'];
                  }
                }
                else
                {
                $totalsumperiod = $totalsumperiod + floatval($timelinedata[$locationlevels[$k]][$perioddata[$f]]['result']);
                }
              }
               $tablestr.= "</tr>";
            }

              $tempres = json_encode($timelinedata);
              $tablestr.= "<script>splitot =$tempres; tablebck = JSON.stringify(splitot);</script>";
              $tablestr.= "</tbody></table>";
      }
      else
      {
          $tablestr.= "<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
          $tablestr.= '<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
          $tablestr.= "<tbody>";
          if (count($res) > 0)
            {
            for ($k = 0; $k < count($res); $k++)
              {
              $tablestr.= "<tr id='" . $res[$k]['loclevel'] . "' level='" . $level . "'>";
              $tablestr.= "<td><input type='checkbox' name='filcheckbox' value='" . $res[$k]['loclevel'] . "'></td> <td> " . $res[$k]['location'] . "</td>";
              $tablestr.= "</tr>";
              }
            }

          $tablestr.= "</tbody></table>";
      }
   }
    else
    {
    foreach($res as $key => $value)
      {
      $timelinedata[$value['loclevel']][$value['period_Y']] = $value;
      }

    $contribut_tot = 0;
    foreach($res as $item)
      {
      $contribut_tot+= $item['result'];
      }

    if (($filter==false))
      {
      $tablestr.= "<table id='example19'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
      $tablestr.= "<thead><tr>"; //<tr><th colspan='2' >Detailed Report</th></tr>
      $countingi = 0;
      for ($i = 0; $i < count($res); $i++)
        {
        foreach($res[$i] as $key => $value)
          {

          // echo $key;

          if ($countingi == 0)
            {

            // echo $key; die;

            if ($key != 'loclevel')
              {
              $tablestr.= "<th>" .$thlocation . "</th>";
              $tablestr.= "<th align = 'center'>" . $thtitle . " (Nos.)</th>";
              $tablestr.= "<th align = 'center'>Contrbtn Share(%)</th>";
              }
            }

          $countingi++;
          }
        }

      $tablestr.= "</tr>
              </thead> <tbody>";
      if (count($res) > 0)
        {
           for ($k = 0; $k < count($res); $k++)
          {
          $tablestr.= "<tr class='details-control' id='" . $res[$k]['loclevel'] . "' level='" . $level . "'>";
          $tablestr.= "<td>" . $res[$k]['location'] . "</td>";
          if (in_array($splitgroupby, $retilerschoice) && $level >= 6)
            {
            $tablestr.= "<td align = 'right'>" . $res[$k]['result'] . "</td>";
            }
            else
            {
            if (strlen($res[$k]['result']) > 6)
              {
              $amountIND = round($res[$k]['result'], 2); //'1000003.400050'; '283688411.50';//
              $amt = explode(".", $amountIND);
              $amountIND = moneyFormatIndia($amt[0]); //moneyFormatIndia IND_money_format
              if (isset($amt[1]))
                {
                $amountIND = $amountIND . "." . $amt[1];
                }
              }
              else
              {
              $amountIND = money_format('%!i', $res[$k]['result']);
              }

            $tablestr.= "<td align = 'right' class = 'resultfield'>" . $amountIND . "</td>";
            $tablestr.= "<td align = 'right' class = 'contrbute_share'>" . number_format(($res[$k]['result'] / $contribut_tot) * 100, 2) . "</td>";
            }

          $tablestr.= "</tr>";
          }
        }

      $jsenolocres = json_encode($timelinedata);
      $tablestr.= "</tbody></table>";
      $tablestr.= "<script>tablebck =$jsenolocres;</script>";
      }
      else
      {
      $tablestr.= "<table id='example3'  class='table table-striped table-bordered' cellspacing='0' width='100%'>";
      $tablestr.= '<thead><tr><th><b><input type="checkbox" name="filcheckboxall" value="">Select All</b></th><th><b>Location</b></th></tr></thead>';
      $tablestr.= "<tbody>";
      if (count($res) > 0)
        {
        for ($k = 0; $k < count($res); $k++)
          {
          $tablestr.= "<tr id='" . $res[$k]['loclevel'] . "' level='" . $level . "'>";
          $tablestr.= "<td><input type='checkbox' name='filcheckbox' value='" . $res[$k]['loclevel'] . "'></td> <td> " . $res[$k]['location'] . "</td>";
          $tablestr.= "</tr>";
          }
        }

      $tablestr.= "</tbody></table>";
      }

   
    }
    
     

  return $tablestr;

 }
}
Class Svgimp extends Lifecoloraction
{
    function mapwrk_svg($mapwrk,$colorarr)
    {
      
      
      $filename = '';
      $replicfile = '';
      //$_REQUEST['id']=($_REQUEST['id']==73) ? 14878 : $_REQUEST['id']; 
      $svgfilen = $_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl'].".svg";
      $replicsvgfilen = $_REQUEST['id']."---".$_REQUEST['parentlvl']."---".$_REQUEST['childlvl']."---a.svg";

      $totsvg = file_get_contents($svgfilen);

      foreach ($mapwrk as $key => $value) {
        # code... 
          $valuearr = '';
          //12-805~~35-400~~98-1300~~18-300~~8-200~~198-813
          $valcnt = 0;
          $clnew = array();
          $array_order = array();
            foreach ($value as $key1 => $value1) 
            {

              if($valcnt <=9)
              {
                $valuearr = $valuearr.''.$key1.'-'.$value1['value'].'~~';
                array_push($array_order,$key1);
                array_push($clnew,$this->getsplitcolourchart($valcnt));
                $valcnt++;
              }
             
            }
           $array_order = array_reverse($array_order);
           $clnew = array_reverse($clnew);
            
            $totsvg = $this->fillcolor_insvg($valuearr,$clnew,$array_order,$filename,$replicfile,$key,$totsvg,$colorarr);
           
           

      }
      

            $totsvg = preg_replace('/\~\~\~\~\~([A-z])+([0-9]+)\~\~\~\~\~/m', '<defs>
      <linearGradient id="solids$2" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" style="stop-color:rgb(0, 0, 0);stop-opacity:1" /><stop offset="100%" style="stop-color:rgb(0, 0, 0);stop-opacity:1"></linearGradient > </defs >', $totsvg);
           
          $myfile = fopen($replicsvgfilen, "w") or die("Unable to open file!");
          
          fwrite($myfile, "\n". $totsvg);
          fclose($myfile);
         
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

    function fillcolor_insvg($values,$cc,$arord,$filename,$replicfile,$locid,$totsvg,$colorarr)
    {


     
      $values = rtrim($values,"~~ ");
      $vals = explode("~~",$values);
      $catgry = count($vals);
      foreach($vals as $val3) {
      list($ids,$val) = explode("-",$val3);
      $percnt[$ids] = $val;
      }


      foreach($percnt as $k1=>$val5) {
      //echo $k1 . ' <<<==== ' . $val5 . "</br>";
      $aaa[$k1] = sprintf('%0.1f', round(($val5*100 / array_sum($percnt))));
      }

      asort($aaa);

      foreach($aaa as $bb=>$x) {
      // echo $bb . ' ====>> ' . $x . "</br>";
      $bbb[] = $bb;

      }
      $colr = array();
      $clrarry = '';
      $svgstr = '&lt;defs&gt;
      &lt;linearGradient id="solids'.$locid.'" x1="0" y1="0" x2="0" y2="1"&gt;';


      if($catgry==1) {

      $p1 = $aaa[$bbb[0]];
      asort($aaa);
      $cls = 0;
      foreach ($aaa as $key => $value) {
      $colr[$key] = $cc_hex[$cls];
      $cls++;
      }
      $clrarry = implode(",",$colr);


        $svgstr .= '&lt;stop offset="0%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;
        &lt;stop offset="100%" style="stop-color:'.$cc[0].';stop-opacity:1" /&gt;';

      } elseif($catgry==2) {

      $p1 = $aaa[$bbb[0]];
      $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
      $cc[0] = $colorarr[$bbb[0]];
      $cc[1]=$colorarr[$bbb[1]];
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

      } elseif($catgry==3) {

      $p1 = $aaa[$bbb[0]];
      $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
      $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
      $cc[0] = $colorarr[$bbb[0]];
      $cc[1]=$colorarr[$bbb[1]];
      $cc[2]=$colorarr[$bbb[2]];
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
      } elseif($catgry==4) {

      $p1 = $aaa[$bbb[0]];
      $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
      $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
      $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];

        $cc[0] = $colorarr[$bbb[0]];
        $cc[1]=$colorarr[$bbb[1]];
        $cc[2]=$colorarr[$bbb[2]];
        $cc[3]=$colorarr[$bbb[3]];
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

      } elseif($catgry==5) {
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
      &lt;stop offset="'. $p5 .'%" style="stop-color:'.$cc[4].';stop-opacity:1" /&gt;';
      }
      elseif($catgry==6) {
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
      asort($aaa);
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
      elseif($catgry==7) {
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
      elseif($catgry==8) {
      //echo "Yessssssssssss";

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
      elseif($catgry==9) {
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
      elseif($catgry==10) {
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
       $colorfinder = '~~~~~MARK'.$locid.'~~~~~';
      $totsvg1 = str_replace($colorfinder,$svgstr,$totsvg);
      $totsvg2 = str_replace("&lt;","<",$totsvg1);
      $totsvg3 = str_replace("&gt;",">",$totsvg2);


      return $totsvg3;
    }

}
?>

<?php

//------------------------------------Common Variables -----------------------------------------//
        $login=Yii::$app->user->identity->id;
        $final_resul_arry = array();
        $combine="";
        $year=$_REQUEST['year'];
        $category=explode("_",$_REQUEST['categs']);
        $relatedid=implode(",",$category);

        $menuids_l = explode("_",$_REQUEST['mnid']);
        $menuids = implode(",",$menuids_l);
        $mulrelationid = explode("_",$_REQUEST['categs']);
        $multablid = explode("_",$_REQUEST['tbl']);
        $multablid = array_filter($multablid);
        $fldcondtionsArr = array();
        $iteration = 0;
        foreach ($multablid as $key => $value) {
          if($fldcondtionsArr[$value] != '')
          {
             $fldcondtionsArr[$value] = $fldcondtionsArr[$value].",".$mulrelationid[$iteration];
          }
          else
          {
             $fldcondtionsArr[$value] =$mulrelationid[$iteration];
          }
           
            $iteration++;
        }
        $fldcondtions ='';
        $iter = 1;
        foreach ($fldcondtionsArr as $key => $value) {
            if(count($fldcondtionsArr) == $iter)
            {
              $fldcondtions = $fldcondtions."fld".$key." IN (".$value.")";

            }
            else
            {
              $fldcondtions = $fldcondtions."fld".$key." IN (".$value.") AND ";
            }
            
            $iter++;
        }
        $query=$_REQUEST['id'];
        $relevel=$_REQUEST['level'];
//------------------------------------Common Variables -----------------------------------------//
// ------------------------------------Ajax Action------------------------------------ //
//-------------------------------------Combine Action Start -----------------------------------//

if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="C")
{
      $tabl_ids = $_REQUEST['tbl'];
      $child = "loc".$_REQUEST['childlvl'];
      $parent = "loc".$_REQUEST['parentlvl'];
      $locid = $_REQUEST['id'];
      $period = $_REQUEST['year'];
      $view=$_REQUEST['view'];
      $splitgroupby=$_REQUEST['combv'];
      $periods = explode(",",$period);
      $pyyear = array();
      $perids = array();
      $perioddata =array(); 
      $Lifelocation=new Lifelocation();
      $locationtbl=$Lifelocation->findlocation($_REQUEST['parentlvl'],$_REQUEST['childlvl']);  
      $sql='';     $groupbyvar = '';
      if($view == 2) //continous -- time series
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
       if(($view == 0) && (count($periods) > 1))  //single -- cumulative 
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
      if($view == 5)
      {
        $groupbyvar = '';
      }
       if(isset($_REQUEST['combv']))
      {

        $s = "SELECT * FROM split_combine_view where refid='".$_REQUEST['combv']."'";
        $que = yii::$app->db->createCommand($s)->queryOne();
        $split_idc   =   $que['menu_id'];
        $view_optnc  =   $que['view_optn'];   
                $label= $que['label'];   
        $combgroup =" ";
      }
      else
      {
         $combgroup =" ";
      }
        $tabl_ids = $_REQUEST['tbl'];
        $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$split_idc." and stat !='R'"; 
        $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();
        $split_tble = $res1['table_name'] ;

      $mainresultField = "count(*) result";
      $filterchild = '';
      $range = '';
     
      if(isset($_REQUEST['chidlvlfilter']))
      {
              $filterloc = $_REQUEST['chidlvlfilter'];
              $filterchild = "a.".$child." in (".$filterloc.") AND";
      }
      $tablname = 'biweb_mktgpot.area_life_style_indicator_final';
      
         if(isset($_REQUEST['id'])){$s1="a.".$parent." = ".$locid." and ";}else{$s1="";}
        if(!isset($_REQUEST['filter']))
        {
          $sql = "select c.location_name as location,a.".$child." loclevel,'' as title,".$mainresultField.",".$period." as period_Y FROM ".$tablname." a 
               left join biweb.".$locationtbl." c on a.".$child." =c.refid
            WHERE a.".$parent." = ".$locid." and a.".$child." != 0 ".$filterchild." AND ".$fldcondtions."  GROUP BY loclevel,a.".$child." ".$groupbyvar." ".$range."order by result desc";         
        }
      
     
      $res=yii::$app->db2->createCommand($sql)->queryAll();
      $filter=(isset($_REQUEST['filter'])) ?  true : false;
      $level=$_REQUEST['level'];
      $buildtable= new Liferesult();

       $buildtable=$buildtable->Combinetablebuild($res,$locid,$split_tble,$locationtbl,$value,$_REQUEST['parentlvl'],$_REQUEST['childlvl'],$_REQUEST['year'],$_REQUEST['view'],$filter,$perioddata,$level,$splitgroupby,$perids);

        array_push($final_resul_arry, $buildtable);
        $graph=new Lifegraphaction();
        $grp =$graph->graphwrk($res,$view_optnc, $perioddata );
        array_push($final_resul_arry, $grp);
        $mapaction=new Lifemapaction();       
        $mapwrk = $mapaction->mapwrk($res,$retail,$periods);
        array_push($final_resul_arry, $mapwrk);
        array_push($final_resul_arry,count($perioddata));
       array_push($final_resul_arry,'(Nos.)');
              array_push($final_resul_arry,'');//reading

   

       array_push($final_resul_arry,$label);//reading
        array_push($final_resul_arry,1);
      


     
}
//-------------------------------------Combine Action End -----------------------------------//

//-------------------------------------Split Action Start -----------------------------------//
if(isset($_REQUEST['chart']) && $_REQUEST['groupby'] =="S")
{
        $splitgrp= "";
        $selectsplit= "";
        if(isset($_REQUEST['combv']))
        {
             
             $locationshow=$_REQUEST['combv'];
             $_REQUEST['combv']=($_REQUEST['combv']==2491) ? 2493 : $_REQUEST['combv'];
             $splitgroupby=$_REQUEST['combv'];
             $s = "SELECT menu_id,view_optn,pair FROM split_combine_view where refid='".$_REQUEST['combv']."'";
             $que = yii::$app->db->createCommand($s)->queryOne();
             $split_idc   =   $que['menu_id'];
             $view_optnc  =   $que['view_optn'];
             $pair= $que['pair'];
             if( $locationshow== 2491) 
                $splitgrp="";
              else
             $splitgrp= " ,a.fld".$split_idc;
             // $address=($_REQUEST['combv'] == 2491) ? "a.address,a.latitude as lat,a.longitude as lon,a.image_name,a.fld".$pair." as fld,d.name," : '';//icon,popup address show
             // $join= ($_REQUEST['combv'] == 2491) ? "join biweb.hul_alsi_master as d on a.fld".$pair."=d.refid" : "" ;

        }
        else
        {
             $splitgrp= "";
             $selectsplit= "";
        }
       
        $tabl_ids = ($split_idc != "") ?  $split_idc : $_REQUEST['tbl'];
        $tabl_ids = $_REQUEST['tbl'];
        $sql_splittble = "select table_name from biweb.menu_object_master where refid =".$split_idc." and stat !='R'"; 
        $res1=yii::$app->db2->createCommand($sql_splittble)->queryOne();
        $split_tble = $res1['table_name'] ;

        $perids = array();       
        $tablname = 'biweb_mktgpot.area_life_style_indicator_final';        
        $sql='';
        $child = "loc".$_REQUEST['childlvl'];//$levelchild[$_REQUEST['level']];
        $parent = "loc".$_REQUEST['parentlvl'];//$levelparent[$_REQUEST['level']];

        $Lifelocation=new Lifelocation();
        $locationtbl=$Lifelocation->findlocation($_REQUEST['parentlvl'],$_REQUEST['childlvl']);
        $locid = $_REQUEST['id'];
        $filterchild = '';
        $range = '';
        $period = $_REQUEST['year'];
        $periods = explode(",",$period);
        $pyyear = array();       
        $perioddata =array();      
        if($_REQUEST['view'] == 2)  //continous -- time series
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
        else if($_REQUEST['view'] == 0 && count($periods) > 1) //single -- cumulative
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
       $mainresultField = 'count(*) result';
       $centercor = '';
       $centercor = ($_REQUEST['level'] >= 6) ? "concat(c.latitude,',',c.longitude) as center" : "c.center_coordinates as center";
      $sqlmenuids = "select group_concat(name) as title,maintype from ".$split_tble." where refid in ($value) group by maintype_id ";
      $resultmenu=yii::$app->db->createCommand($sqlmenuids)->queryOne();
      $namemenu=($locationshow == 2491) ? "'".$resultmenu['title']."'" : 'b.name';
      if(!isset($_REQUEST['type']))
      {
       if(count($periods)>=1 ) 
        {
        
              $sql = "select c.location_name as location,a.".$child." loclevel,".$address.$namemenu." as title,a.fld".$split_idc." as split_id,".$mainresultField.",'".$periods[0]."' as period_Y,".$centercor." FROM ".$tablname." a 
               join biweb.".$split_tble." b on b.refid = a.fld".$split_idc."
               join biweb.".$locationtbl." c on a.".$child." =c.refid
               join biweb.hul_alsi_master as d on a.fld".$split_idc."=d.refid
               WHERE a.".$parent." = ".$locid." and  a.".$child." != 0 AND ".$filterchild." ".$fldcondtions." AND b.stat = 'A'  GROUP BY loclevel ".$range." $splitgrp order by result desc";
               

           if($locationshow==2491)
           {
           
              $s1 = "SELECT * FROM split_combine_view where refid='".$locationshow."'";
              $que1 = yii::$app->db->createCommand($s1)->queryOne();
              $split_idc1  =   $que1['menu_id'];
              $view_optnc1  =   $que1['view_optn'];
              $splitgrp1= " ,a.fld".$split_idc1;
              $sql_splittble1 = "select table_name from biweb.menu_object_master where refid =".$split_idc1." and stat !='R'"; 
              $res11=yii::$app->db2->createCommand($sql_splittble1)->queryOne();
              $split_tble1 = $res11['table_name'] ;
              $splitgrp1= " ,a.fld".$split_idc1;
          
            $sqllocation = "select  ".$year." as period_Y , c.location_name as location,a.".$child." loclevel,b.name as title,d.maintype,a.address,a.latitude as lat,a.longitude as lon,a.image_name,a.fld".$split_idc1." as split_id,count(*) as result,a.fld".$split_idc." as fld,d.name FROM ".$tablname." a 
              left  join biweb.".$split_tble1." b on b.refid = a.fld".$split_idc1."
               join biweb.".$locationtbl." c on a.".$child." =c.refid
               join biweb.hul_alsi_master as d on a.fld".$split_idc."=d.refid
              WHERE a.".$parent." = ".$locid." and  a.".$child." != 0 AND ".$filterchild." ".$fldcondtions." AND a.latitude !='' and a.longitude != '' 
              --  AND b.stat = 'A' 
               GROUP BY loclevel ".$range." $splitgrp1;";
              
           // print_r($sqllocation);die;

           }
        }
        else //time series
        {
          $condtions ='';
          if($_REQUEST['view'] == 2)
          {
            $condtions = "a.period_Y  BETWEEN ".$periods[0]." AND ".$periods[1];
          }
          else
          {
            $pdata = implode(",",$perioddata);//perioddata
            $condtions = "a.period_Y in(".$pdata.")";
          }
          foreach ($periods as &$value) {
          $value = "p".$value;
          }
          $filterselect = '';
          $filterselect = "c.location_name as location,a.".$child." loclevel,b.name as title,a.fld".$split_idc." as split_id,".$mainresultField.",a.period_Y";
          if(isset($_REQUEST['id'])){$s11="a.".$parent." = ".$locid." and ";}else{$s11="";}

          $sql = "select ".$filterselect." FROM ".$tablname." a 
                 join biweb.".$split_tble." b on b.refid = a.fld".$split_idc." 
                 join biweb.".$locationtbl." c on a.".$child." =c.refid
                WHERE $s11  a.".$child." != 0 AND ".$filterchild." ".$fldcondtions."   AND ".$condtions."  GROUP BY loclevel,a.period_Y,a.fld".$split_idc;//,a.rcategory";
        }
      }
      else if(isset($_REQUEST['type']))
      {
          if($_REQUEST['type'] == 'Rn')
        {
          $chidlvlfilter =$_REQUEST['chidlvlfilter'];
          $rangebtw = explode(",",$chidlvlfilter);
          $range = 'Having ROUND(SUM(a.sub2_Q1+a.sub2_Q2+a.sub2_Q3+a.sub2_Q4),2) between '.$rangebtw[0].' and '.$rangebtw[1];
        }
        else if($_REQUEST['type'] == 'var')
          {
            if(isset($_REQUEST['chidlvlfilter']))
            {
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
        
       
          if(isset($_REQUEST['chidlvlfilter']))
          {
            $filterloc = $_REQUEST['chidlvlfilter'];
            $filterchild = "a.".$child." in (".$filterloc.") AND";
          }
        if($_REQUEST['type'] == 'R')
        {
           $chidlvlfilter =$_REQUEST['chidlvlfilter'];
            $rankbtw = explode(",",$chidlvlfilter);
              $sql = "select location,loclevel, title,result,period_Y from (select location,loclevel, title,result,period_Y, CASE WHEN @l=result THEN @r ELSE @r:=@r+1 END as rank, @l:=result FROM (".$sql." order by result desc) totals, (SELECT @r:=0,@l:=NULL) rank) fin where fin.rank BETWEEN ".$rankbtw[0]." and ".$rankbtw[1];
        }
      }
    
      $result=yii::$app->db2->createCommand($sql)->queryAll();
       if($locationshow==2491)
            $locationresult=yii::$app->db2->createCommand($sqllocation)->queryAll();
          //print_r($locationresult);die;

      $boolsplitgroupby=($locationshow == 2491) ? true : false ;

      $filter=(isset($_REQUEST['filter'])) ?  true : false;
      $level=$_REQUEST['level'];
      $tempstore=$split_tble;
      $tblsplit_tble= ($_REQUEST['combv'] == 2491) ? "hul_alsi_master" : $split_tble ;
      $buildtable= new Liferesult();
      if($locationshow==2491)
       {
         $buildtable=$buildtable->tablebuild($locationresult,$locid,$tblsplit_tble,$locationtbl,$value,$_REQUEST['parentlvl'],$_REQUEST['childlvl'],$_REQUEST['year'],$_REQUEST['view'],$filter,$perioddata,$level,$splitgroupby,$perids);
       }
       else
       {
              $buildtable=$buildtable->tablebuild($result,$locid,$tblsplit_tble,$locationtbl,$value,$_REQUEST['parentlvl'],$_REQUEST['childlvl'],$_REQUEST['year'],$_REQUEST['view'],$filter,$perioddata,$level,$splitgroupby,$perids);
       }



       array_push($final_resul_arry, $buildtable);
       $split_tble=$tempstore;
       $graph=new Lifegraphaction();
       $grpng = $graph->graphwrk_split($result,$view_optnc, $perioddata,$relatedid,$tblsplit_tble,$boolsplitgroupby);

    
       
       $colorarr = $grpng[1];
       $grp = $grpng[0];
       array_push($final_resul_arry, $grp);
       $mapaction=new Lifemapaction();       
       $mapwrk = $mapaction->mapwrk_split($result,$retail,$periods,$view_optnc);
       if($_REQUEST['view'] !=3)
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
        $sv=new Svgimp();
        $sv1=$sv->mapwrk_svg($mapwrk,$colorarr);
        }
        array_push($final_resul_arry, $mapwrk);
        array_push($final_resul_arry,count($perioddata));
       
        array_push($final_resul_arry,'(Nos.)');
        array_push($final_resul_arry,json_encode($colorarr));
         array_push($final_resul_arry,json_encode($result));
          array_push($final_resul_arry,json_encode($locationresult));   
}
//-------------------------------------Split Action End -----------------------------------//
echo json_encode($final_resul_arry);
?>
