<!doctype html>
<html>
<head>
	<meta charset="utf-8">

	<title>Calendar generator</title>
	<script type="text/javascript" charset="utf-8" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <style type="text/css">
  
  @font-face {
      font-family: "MuseoSans-100";
      font-style: normal;
      font-weight: normal;
      src: url("http://cdn2.yoox.biz/Os/fonts/style_159302.eot?#iefix") format("embedded-opentype"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.eot?#iefix") format("eot"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.woff") format("woff"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.ttf") format("truetype"), url("http://cdn2.yoox.biz/Os/fonts/style_159302.svg#MuseoSans-100") format("svg");
  }
  
  body {
    font-family:'MuseoSans-100';
    margin:20px 0 0 500px;
  }
  
    .Saturday, .Sunday {
      display:none;
    }
 body.h .week {
      margin-bottom:50px;
      
      width: 500px;
      margin:30px 100px 0 0;
      float:left;
    }
    
     body.h .days {
      width:20%;
      float:left;
    }
    
     body.h .days .line {
      width:1px;
      height:200px;
      background:black;
      margin:0 auto;
    }
     body.h .days.wide .line {
      width:3px;
      height:375px;
    }
    
     body.h .days .number,  body.h .days .month {
      width:100%;
      text-align:center;
      margin:15px 0 0 0;
      /*-webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);*/
    }
    
    .days .month {
      text-align:right;
    }
    
    .info { display:none;}
    body.h #holder {width:20000em; 
      margin:0 0 0 0; 
      
         } 
    

body.w .week {
  margin-bottom:50px;
  height: 500px;
  margin:30px 0 100px 0;
  width:500px;
}

body.w .days {
  height:20%;
  position:relative;
}

body.w .days .line {
  width:200px;
  height:30px;
  font-size:10px;
  letter-spacing:20px;
  /*background:black;*/
  margin:0 0 0 250px;
  position:relative;
  top:45%;
  text-transform:uppercase;
}
body.w .days.wide .line, body.w .week.month-created .days.Monday .line, body.w .week:first-child .days.Monday .line {
  width:450px;
  height:10px;
  margin-left:25px;
  background:black;
  color:#fff;
  padding:1px 0 0 0;
}

body.w .days .number,  body.w .days .month {
  height:100%;
  text-align:left;
  margin:15px 0 0 0;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  position:absolute;
  top:-12px;
  left:80px;
  font-size:30px;
}

  body.w .days.wide .number, body.w .week.month-created .days.Monday .number, body.w .week:first-child .days.Monday .number {
    left:-70px;
  }
   body.w .days .month {
     left:500px;
      top:20px;
      display:none;
      font-size:50px;
   } 
   
   body.w .days.wide .month, body.w .week:first-child .days.Monday .month {
     display:block;
   }
   
   body.w .week.month-created .days.Monday .month {
      display:block;
    }  

    
  </style>
  
  <script type="text/javascript" charset="utf-8">
    $(function(){
      $('.week').each(function(i,v){
        $(v).has('div.wide').addClass('month');
        $(v).next().removeClass('month');
        $(v).has('div.wide.Saturday,div.wide.Sunday').removeClass('month').next().addClass('month-created');
      });
      
      
    });
  </script>
</head>
<body class="w">
<?php
$start = mktime(0, 0, 0, 4, 15, 2013); // start monday
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
<div class="info">
  <div><strong><?=$key?></strong> <span><?=$item?></span></div>
</div>



<?php endforeach;?>
<div id="holder">
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
      <div class="line"><?php echo $dayclass;?></div>
      <div class="number"><?= date('j',$addaday)?></div>
      <div class="month"><?= date('M',$addaday)?></div>
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
