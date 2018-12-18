<?php

  $totsvg = file_get_contents("india3.svg");

  //$catgry = $_GET['catgry'];
  $values = $_GET['values']; //~~

//   $temp1= explode("~~",$values);
// print_r($temp1);die;
// foreach ($temp1 as $key => $value) {
//   # code...
//     $temp1= explode("-",$value);

// }
  // http://localhost/svgmaps_upgrade/example/index2.php?values=12-805~~35-400~~98-1300~~18-300~~8-200~~198-1500~~121-1500~~91-100~~92-685~~15-500
  $msar = array(12=>"Tea", 35=>"Coffee", 98=>"Cool Drinks", 18=>"Biscuits", 8=>"Cholcalotes", 198=>"Wafers", 121=>"Ice Creams", 15=>"Puffs", 91=>"Bakery Items", 92=>"Snacks");
// $msar[12] = 'tea';
// $msar[35] = 'Coffee';
// $msar[98] = 'Cool Drinks';
  $vals = explode("~~",$values);
  // print_r($vals);die;
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
      echo $bb . ' ====>> ' . $x . "</br>";
      $bbb[] = $bb;

  }

  // echo $catgry . "<pre>";
  // print_r($aaa);
  // print_r($bbb);
  // print_r($msar);
  // echo "</pre>";

 // exit;

  $colr = array();
  $clrarry = '';
  $svgstr = '&lt;defs&gt;
    &lt;linearGradient id="solids" x1="0" y1="0" x2="0" y2="1"&gt;';


  if($catgry==1) {

    $p1 = $aaa[$bbb[0]];

     $cc[0] = 'rgb(243,12,12)'; //#CC3300
    // $cc[1] = 'rgb(84,12,13)';//#001E99
    // $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc_hex[0] = '#f30c0c';
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


      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="100%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;';

  } elseif($catgry==2) {

    $p1 = $aaa[$bbb[0]];
    $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
    $cc[0] = 'rgb(243,12,12)'; //#CC3300
    $cc[1] = 'rgb(84,12,13)';//#001E99
    // $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
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
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p2.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;';

  } elseif($catgry==3) {

    $p1 = $aaa[$bbb[0]];
    $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
    $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
    // $colr[$bbb[0]]='rgb(243,12,12)';
    // $colr[$bbb[1]]='rgb(84,12,13)';
    // $colr[$bbb[2]]='rgb(226,240,13)';
   
    $cc[0] = 'rgb(243,12,12)'; //#CC3300
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(226,240,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(226,240,13);stop-opacity:1" /&gt;';
      // print_r($colr);die;
  } elseif($catgry==4) {

    $p1 = $aaa[$bbb[0]];
    $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
    $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
    $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];




    $cc[0] = 'rgb(243,12,12)'; //#CC3300
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);







      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p2.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p2.'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p3.'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p3.'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p4.'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;';

  } elseif($catgry==5) {
    //echo "Yessssssssssss";

    $p1 = $aaa[$bbb[0]];
    $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
    $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
    $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
    $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];


    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);






      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;';
  }
  elseif($catgry==6) {
    //echo "Yessssssssssss";

    $p1 = $aaa[$bbb[0]];
    $p2 = $aaa[$bbb[0]]+$aaa[$bbb[1]];
    $p3 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]];
    $p4 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]];
    $p5 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]];
    $p6 = $aaa[$bbb[0]]+$aaa[$bbb[1]]+$aaa[$bbb[2]]+$aaa[$bbb[3]]+$aaa[$bbb[4]]+$aaa[$bbb[5]];

    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc[5] = 'rgb(124,181,236)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    $cc_hex[5]  ='#7cb5ec';
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
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;';
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

    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc[5] = 'rgb(124,181,236)';
    $cc[6] = 'rgb(172,117,7)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    $cc_hex[5]  ='#7cb5ec';
    $cc_hex[6]  ='#ac7507';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;\
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;';
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

    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc[5] = 'rgb(124,181,236)';
    $cc[6] = 'rgb(172,117,7)';
    $cc[7] = 'rgb(27,104,7)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    $cc_hex[5]  ='#7cb5ec';
    $cc_hex[6]  ='#ac7507';
    $cc_hex[7]  ='#1b6807';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);

      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;\
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;';
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

    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc[5] = 'rgb(124,181,236)';
    $cc[6] = 'rgb(172,117,7)';
    $cc[7] = 'rgb(27,104,7)';
    $cc[8] = 'rgb(67,67,72)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    $cc_hex[5]  ='#7cb5ec';
    $cc_hex[6]  ='#ac7507';
    $cc_hex[7]  ='#1b6807';
    $cc_hex[8]  ='#434348';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;\
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:rgb(67,67,72);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:rgb(67,67,72);stop-opacity:1" /&gt;';
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

    $cc[0] = 'rgb(243,12,12)'; //#f30c0c
    $cc[1] = 'rgb(84,12,13)';//#540c0d
    $cc[2] = 'rgb(226,240,13)';//#e2f00d
    $cc[3] = 'rgb(0,0,255)';
    $cc[4] = 'rgb(12,84,78)';
    $cc[5] = 'rgb(124,181,236)';
    $cc[6] = 'rgb(172,117,7)';
    $cc[7] = 'rgb(27,104,7)';
    $cc[8] = 'rgb(67,67,72)';
     $cc[9] = 'rgb(144,237,125)';
    $cc_hex[0] = '#f30c0c';
    $cc_hex[1] = '#540c0d';
    $cc_hex[2] = '#e2f00d';
    $cc_hex[3] = '#0000ff';
    $cc_hex[4]  ='#0c544e';
    $cc_hex[5]  ='#7cb5ec';
    $cc_hex[6]  ='#ac7507';
    $cc_hex[7]  ='#1b6807';
    $cc_hex[8]  ='#434348';
     $cc_hex[9]  ='#90ed7d';
    asort($aaa);
    // print_r($aaa);die;
    $cls = 0;
    foreach ($aaa as $key => $value) {
      # code...
      $colr[$key] = $cc_hex[$cls];
      $cls++;
    }
     $clrarry = implode(",",$colr);
      $svgstr .= '&lt;stop offset="0%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(243,12,12);stop-opacity:1" /&gt;
      &lt;stop offset="'.$p1.'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(84,12,13);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p2 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(50,50,50);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p3 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(0,0,255);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p4 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(12,84,78);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p5 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(124,181,236);stop-opacity:1" /&gt;
      &lt;stop offset="'. $p6 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;\
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(172,117,7);stop-opacity:1" /&gt;
       &lt;stop offset="'. $p7 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:rgb(27,104,7);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p8 .'%" style="stop-color:rgb(67,67,72);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:rgb(67,67,72);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p9 .'%" style="stop-color:rgb(144,237,125);stop-opacity:1" /&gt;
        &lt;stop offset="'. $p10 .'%" style="stop-color:rgb(144,237,125);stop-opacity:1" /&gt;';
      // print_r($svgstr);die;
  }
    $svgstr .= '&lt;/linearGradient &gt; &lt;/defs &gt;';

    $totsvg1 = str_replace("~~~~~MARK~~~~~",$svgstr,$totsvg);
    $totsvg2 = str_replace("&lt;","<",$totsvg1);
    $totsvg3 = str_replace("&gt;",">",$totsvg2);

// print_r($totsvg3);die;
$myfile = fopen("india3a.svg", "w") or die("Unable to open file!");
fwrite($myfile, "\n". $totsvg3);
fclose($myfile);


//echo "</br>" . $svgstr . "</br>";
//exit;

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps API - Reachability</title>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link href="https://google-developers.appspot.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <style type="text/css">
      #map_canvas {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
      }

      #canvas {
        position: absolute;
        z-index: 1;
        top: 0;
        background-color: rgba(0,0,0,0.5);
      }

<script>

</script>


  </style>
  </head>
  <body>

    <div id="map_canvas"></div>
    <div id = 'legenddiv'>
    <div id="legend"><!-- Teafdg (12) 
        <canvas id="myCanvas" width="20" height="20"/> -->
    </div>

    <div id="legend1"><!-- Coffeedfg (35)
      <canvas id="myCanvas1" width="20" height="20"/>       -->
    </div>

    <div id="legend2"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend3"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend4"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend5"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend6"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend7"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend8"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>
    <div id="legend9"><!-- Cool Drinkdfgs (98)
      <canvas id="myCanvas2" width="20" height="20"/> -->
    </div>

    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWN1D6LyQlKiP63eBS3Mi4HZb8n1bBDlk&callback=myMap&amp;libraries=places&amp;sensor=false">
      </script>
    <script src="../dist/svgoverlay.js"></script>
    <script>
         var myStyle =
[


                        {stylers: [ {"visibility": "on" } ] },

                        {
                        featureType: "all",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },

                        {
                        featureType: "road",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },

                        {
                        featureType: "administrative",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
                        {
                        featureType: "poi",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },{
                        featureType: "water",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },{
                        featureType: "road",
                        elementType: "labels",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },


                        {
                          featureType: "road.highway",
                          elementType: "geometry",
                          stylers: [
                        { visibility: "off"
                        }]
                        },
                        {



                        featureType: 'poi.business',
                        stylers: [
                        {visibility: 'off'
                        }]

                        },

                        {
                        featureType: 'transit',
                        elementType: 'labels.icon',
                        stylers: [{visibility: 'off'}]
                        },
                        {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{visibility: 'off'}]
                        },
                        {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [
                        { visibility: "off" }
                        ]
                        },
];

var legend = document.getElementById('legend');


      var map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 4,
        center: new google.maps.LatLng(21.146633, 79.088860),
        // mapTypeId: google.maps.MapTypeId.ROADMAP
        mapTypeControlOptions: {
        //   mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.HYBRID]
        },
         mapTypeId: 'mystyle',
      });
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend1'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend2'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend3'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend4'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend5'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend6'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend7'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend8'));
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('legend9'));
        map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'Hide' }));
       // map.mapTypes.set('mystyle1', new google.maps.StyledMapType(myStyle1, { name: 'Map' }));
         directionsDisplay = new google.maps.DirectionsRenderer({
          draggable: true,
          map: map,
          panel: document.getElementById('right-panel')
        });
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.open('GET', 'india3a.svg', false);
      xmlhttp.send();


      var overlay = new SvgOverlay({
        content: xmlhttp.responseText,
        map: map
      });

      var svg = overlay.getSvg();

      svg.setAttribute('opacity', 1);
      console.log('overlay.getContainer()');
      tes = overlay.getContainer();
      
      
    </script>


<script>
colrs = '<?php echo json_encode($colr); ?>';
msar = '<?php echo json_encode($msar); ?>';
colrN = JSON.parse(colrs);//colrs.split(",");
msar = JSON.parse(msar);
console.log(colrN);
console.log(msar);
var  ij = 0;
for (var k in colrN){
 
    if (msar.hasOwnProperty(k)) {
        
          if(ij == 0)
          {
              res = $("body").find("#legend").html(msar[k]+' <canvas id="myCanvas" width="20" height="20"/>');
              var c = document.getElementById("myCanvas");
              var ctx = c.getContext("2d");
              ctx.fillStyle = colrN[k];
              ctx.fillRect(0, 0, 30, 30);
          }
          else
          {
              // alert(msar[k]);
              res = $("body").find("#legend"+ij).html(msar[k]+' <canvas id="myCanvas'+ij+'" width="20" height="20"/>');
              var c = document.getElementById("myCanvas"+ij);
              var ctx = c.getContext("2d");
              ctx.fillStyle = colrN[k];
              ctx.fillRect(0, 0, 30, 30);
          }
          ij++;
    }
}


// res = colrs.split(",");
// var c = document.getElementById("myCanvas");
// var ctx = c.getContext("2d");
// ctx.fillStyle = "#CC3300";
// ctx.fillRect(0, 0, 30, 30);

// var d = document.getElementById("myCanvas1");
// var ctx = d.getContext("2d");
// ctx.fillStyle = "#001E99";//#001E9A
// ctx.fillRect(0, 0, 30, 30);

// var d = document.getElementById("myCanvas2");
// var ctx = d.getContext("2d");
// ctx.fillStyle = "#e2f00d";//#e2f00d
// ctx.fillRect(0, 0, 30, 30);


</script>


 </body>
</html>

<script>
      
$("body").on("click", "path", function(){
  var contid = $(this).attr('id');
  alert(contid);
    if(contid=="IND") {
        alert("Yesssssssssssss"); 
        $("#map_canvas").hide();
    }
});

</script>
