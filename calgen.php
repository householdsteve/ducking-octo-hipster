<!doctype html>
<html>
<head>
	<meta charset="utf-8">

	<title>Calendar generator</title>
  <style type="text/css" media="screen">
    .Saturday, .Sunday {
      display:none;
    }
    .week {
      margin-bottom:50px;
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
<div><strong><?=$key?></strong> <span><?=$item?></span></div>

<?php endforeach;?>

<?php 
  $weekcounter = 0;
for($w = 0; $w < $weeks; $w++){
  ?>
 <div class="week">
  <?php
  for($d = 0; $d < 7; $d++){
    $addaday = $start + (86400 * $d) + (604800 * $weekcounter);

    $dayclass = date('l',$addaday);
    $daydata = date('l M-d-Y',$addaday);
    ?>
    <div class="<?php echo $dayclass;?>">
      <?php
        echo $daydata;
      ?>
    </div>
    <?php
  }
  ?>
</div>
  <?php
  $weekcounter++;
}
?>


</body>
</html>
