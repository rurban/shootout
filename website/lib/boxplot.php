<?php
// Copyright (c) Isaac Gouy 2010

// LIBRARIES ////////////////////////////////////////////////

require_once(LIB_PATH.'lib_whitelist.php');
require_once(LIB);
require_once(LIB_PATH.'lib_data.php');


// DATA LAYOUT ///////////////////////////////////////////////////


define('STATS_SIZE',8);
define('STAT_MIN',0);
define('STAT_XLOWER',1);
define('STAT_LOWER',2);
define('STAT_MEDIAN',3);
define('STAT_UPPER',4);
define('STAT_XUPPER',5);
define('STAT_MAX',6);
define('STATS_N',7);

// FUNCTIONS ///////////////////////////////////////////

function SelectedLangs($Langs, $Action, $Vars){
   $w = array(); $wd = array();
   foreach($Langs as $lang){
      $link = $lang[LANG_LINK];
      if (isset($Vars[$link])){ $w[$link] = 1; }
      if ($lang[LANG_SELECT]){ $wd[$link] = 1; }
   }
   if ($Action=='reset'||sizeof($w)<=0){ $w = $wd; }
   return $w;
}

function BoxplotData($FileName,$Tests,$Langs,$Incl,$Excl,$SLangs,$HasHeading=TRUE){

   return FullScores( $SLangs, FullRatios($FileName,$Tests,$Langs,$Incl,$Excl,$SLangs,$HasHeading) );
}

function FullRatios($FileName,$Tests,$Langs,$Incl,$Excl,$SLangs,$HasHeading=TRUE){
   $time_mins = array();
   foreach($Tests as $k => $v){ $time_mins[$k] = 360000.0; } // 100 hours
   $data = array();

   $lines = @file($FileName) or die ('Cannot open $FileName');
   if ($HasHeading){ unset($lines[0]); } // remove header line

   foreach($lines as $line) {
      $row = explode( ',', $line);
      $test = $row[DATA_TEST];
      $lang = $row[DATA_LANG];
      $key = $test.$lang.$row[DATA_ID];

      // accumulate all acceptable datarows, exclude duplicates

      if (isset($Incl[$test]) && isset($Incl[$lang]) && isset($Langs[$lang]) &&
                  !isset($Excl[$key])){

            settype($row[DATA_STATUS],'integer');
            settype($row[DATA_TIME],'double');
            $row_time = $row[DATA_TIME];

            if ($row[DATA_STATUS] == 0 && (
                  ($row_time > 0.0 && (!isset($data[$lang][$test]) ||
                     $row_time < $data[$lang][$test][DATA_TIME])))){

               $data[$lang][$test] = $row;

               if ($row_time < $time_mins[$test]){
                  $time_mins[$test] = $row_time;
               }
            }
      }
   }
   unset($lines);

   $ratios = array();
   foreach($data as $k => $test){
      if (sizeof($test)/sizeof($Tests) > 0.4){
         $s = array();
         foreach($test as $t => $row){
            // wait until now to filter so sizeof($test) is consistent with FullWeightedData
            if ($Tests[$t][TEST_WEIGHT]>0){
                  $s[] = $row[DATA_TIME]/$time_mins[$t];
            }
         }
         if (!empty($s)){ $ratios[$k] = $s; }
      }
   }

   return $ratios;
}


function FullScores($SLangs,$ratios){
  $score = array();
  foreach($ratios as $k => $s){
     $score[$k] = Percentiles($s);
  }
   uasort($score,'CompareMedian');

   $labels = array();
   $stats = array();
   $allowed = array();
   $count = 0; $max = 15;
   foreach($score as $k => $test){
      if (isset($SLangs[$k])){
         $labels[] = $k;
         $stats[] = $test;
         $allowed[$k] = 1;
         $count++;
      }
      if ($count == $max){ break; }
   }
   return array($score,$labels,$stats,$allowed);
}

function CompareMedian($a, $b){
   return $a[STAT_MEDIAN] < $b[STAT_MEDIAN] ? -1 : 1;
}


function Percentiles($a){
   sort($a);
   $n = sizeof($a);
   $mid = floor($n / 2);
   if ($n % 2 != 0){
      $median = $a[$mid];
      $lower = Median( array_slice($a,0,$mid+1) ); // include median in both quartiles
      $upper = Median( array_slice($a,$mid) );
   } else {
      $median = ($a[$mid-1] + $a[$mid]) / 2.0;
      $lower = Median( array_slice($a,0,$mid) );
      $upper = Median( array_slice($a,$mid) );
   }
   $maxwhisker = ($upper - $lower) * 1.5;
   $xlower = ($lower - $maxwhisker < $a[0]) ? $a[0]: $lower - $maxwhisker;
   $xupper = ($upper + $maxwhisker > $a[$n-1]) ? $a[$n-1] : $upper + $maxwhisker;

   return array($a[0],$xlower,$lower,$median,$upper,$xupper,$a[$n-1],$n);
}

function Median($a){
   $n = sizeof($a);
   $mid = floor($n / 2);
   return ($n % 2 != 0) ? $a[$mid] : ($a[$mid-1] + $a[$mid]) / 2.0;
}


// PAGE ////////////////////////////////////////////////

$Page = & new Template(LIB_PATH);
$Body = & new Template(LIB_PATH);
$PageId = 'boxplot';
$TemplateName = 'boxplot.tpl.php';


// GET_VARS ////////////////////////////////////////////////

list($Incl,$Excl) = WhiteListInEx();
$Tests = WhiteListUnique('test.csv',$Incl); // assume test.csv in name order
$Langs = WhiteListUnique('lang.csv',$Incl); // assume lang.csv in name order

$SLangs = SelectedLangs($Langs, $Action, $HTTP_GET_VARS);


// HEADER ////////////////////////////////////////////////

$mark = MarkTime();
$mark = $mark.' '.SITE_NAME;
$Title = 'Which programming languages are fastest?';

$bannerUrl = CORE_SITE;
$faqUrl = CORE_SITE.'help.php';


// DATA ////////////////////////////////////////////////

$Data = BoxplotData(DATA_PATH.'data.csv',$Tests,$Langs,$Incl,$Excl,$SLangs);

$timeUsed = 'Elapsed secs';
if (SITE_NAME == 'gp4' || SITE_NAME == 'debian'){
   $timeUsed = 'CPU secs';
}


// ABOUT ////////////////////////////////////////////////

$About = & new Template(ABOUT_PATH);
$AboutTemplateName = 'boxplot-about.tpl.php';
if (! file_exists(ABOUT_PATH.$AboutTemplateName)){ $AboutTemplateName = 'blank-about.tpl.php'; }


// META ////////////////////////////////////////////////

$metaRobots = '<meta name="robots" content="noindex,follow,noarchive" />';
$MetaKeywords = '<meta name="description" content="Which programming languages have the fastest benchmark programs ('.PLATFORM_NAME.') and how your favorite language compares." />';

if (SITE_NAME == 'gp4' || SITE_NAME == 'debian' || SITE_NAME == 'demo'){
   $metaRobots = '<meta name="robots" content="noindex,nofollow,noarchive" />';
}


// TEMPLATE VARS ////////////////////////////////////////////////

$Page->set('PageTitle', $Title.BAR.'Computer&nbsp;Language&nbsp;Benchmarks&nbsp;Game');
$Page->set('BannerTitle', BANNER_TITLE);
$Page->set('BannerUrl', $bannerUrl);
$Page->set('FaqTitle', FAQ_TITLE);
$Page->set('FaqUrl', $faqUrl);

$Body->set('Tests', $Tests);
$Body->set('Langs', $Langs);
$Body->set('Excl', $Excl);
$Body->set('Mark', $mark);
$Body->set('TimeUsed', $timeUsed);

$Body->set('Data', $Data );
$Body->set('Title', $Title);

$Body->set('About', $About->fetch($AboutTemplateName));

$Page->set('PageBody', $Body->fetch($TemplateName));
$Page->set('Robots', $metaRobots);
$Page->set('MetaKeywords', $MetaKeywords);
$Page->set('PageId', $PageId);

echo $Page->fetch('page.tpl.php');
?>
