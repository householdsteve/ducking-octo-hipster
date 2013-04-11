<!doctype html>
<html>
<head>
	<meta charset="utf-8">

	<title>Calendar generator</title>
  <style type="text/css">
  
  @font-face {
      font-family: "MuseoSans-100";
      font-style: normal;
      font-weight: normal;
      src: url("http://cdn2.yoox.biz/Os/fonts/style_159302.eot?#iefix") format("embedded-opentype"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.eot?#iefix") format("eot"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.woff") format("woff"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.ttf") format("truetype"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.svg#MuseoSans-100") format("svg");
  }
  
  body {
    font-family:'MuseoSans-100';
    width:20000em;
  }
  
    .Saturday, .Sunday {
      display:none;
    }
    .week {
      margin-bottom:50px;
      
      width: 500px;
      margin:30px 100px 0 0;
      float:left;
    }
    
    .days {
      width:20%;
      float:left;
    }
    
    .days .line {
      width:1px;
      height:200px;
      background:black;
      margin:0 auto;
    }
    .days.wide .line {
      width:3px;
      height:375px;
    }
    
    .days .number, .days .month {
      width:100%;
      text-align:center;
      margin:15px 0 0 0;
      /*-webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);*/
    }
    
    .days .month {
      text-align:right;
    }
    
    #info { display:none;}
    #holder {width:20000em; margin:300px 0 0 0; 
      
    }
    
  </style>
</head>
<body class="">
<?php
$start = mktime(0, 0, 0, 4, 1, 2013); // start monday
$end = mktime(0, 0, 0, 8, 5, 2013); // end monday
$timeInit = array();
$duration = $end - $start;
$days = ceil($duration / 86400);
$weeks = ceil($duration / 604800);
$workdays = $days - ($weeks * 2);

$timeInit['duration'] = $duration;
$timeInit['days'] = $days;
$timeInit['weeks'] = $weeks;
$timeInit['workdays'] = $workdays;

foreach($timeInit as $key => $item):?>
<div id="info">
  <div><strong><?=$key?></strong> <span><?=$item?></span></div>
</div>

<div id="holder">

<?php endforeach;?>

<?php 
  $weekcounter = 0;
  $lastmonth = "";
  $thismonth = "";
for($w = 0; $w < $weeks; $w++){
  $lastmonth = $thismonth;
  $thismonth = date('M', $start + (604800 * $w));
  ?>
 <div class="week<?php echo ($lastmonth != $thismonth ? ' month' : ''); ?>">
  <?php
  for($d = 0; $d < 7; $d++){
    $addaday = $start + (86400 * $d) + (604800 * $weekcounter);

    $dayclass = date('l',$addaday);
    $daydata = date('l M-d-Y',$addaday);
    ?>
    <div class="days <?php echo $dayclass;?><?php echo (date('j',$addaday) == 1 ? ' wide' : ''); ?>">
      <div class="line">&nbsp;</div>
      <div class="number"><?= date('j',$addaday)?></div>
      <?php if(date('j',$addaday) == 1 ):?><div class="month"><?= date('M',$addaday)?></div><?php endif; ?>
    </div>
    <?php
  }
  ?>
</div>
  <?php
  $weekcounter++;
}
?>
</div>

</body>
</html>
