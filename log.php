<?php
//$logFile = "/home/mc/logs/latest.log"; // local path to log file
$logFile = "latest.log"; // local path to log file
$interval = 1000; //how often it checks the log file for changes, min 100
if($interval < 100)  $interval = 100;
function convertBash($kolor) 
{
    $zamien = array(
    '[0m' => '<span style="color:black">', // 0 black
    '[37m' => '<span style="color:black">', // 0 black
    '[32m' => '<span style="color:black">', // 0 black
    '[33m' => '<span style="color:black">', // 0 black
    '[21m' => '<span style="color:black">', // 0 black
    '[0;30;22m' => '<span style="color:black">', // 0 black
    '[0;34;22m' => '<span style="color:black">', //1 dark blue
        '[0;32;22m' => '<span style="color:black">', // 2 dark green
        '[0;36;22m' => '<span style="color:black">', //3 dark aqua
        '[0;31;22m' => '<span style="color:black">', // 4 dark red  
        '[0;35;22m' => '<span style="color:black">', //5 dark purple
        '[0;33;22m' => '<span style="color:black">', //6 gold
        '[0;37;22m' => '<span style="color:black">', // 7 gray
        '[0;30;1m' => '<span style="color:black">', //// 8 dark gray
        '[0;34;1m' => '<span style="color:black">', // 9 blue
    '[0;32;1m' => '<span style="color:black">', // 9 blue
    '[0;36;1m' => '<span style="color:black">', // 9 blue
    '[0;31;1m' => '<span style="color:black">', // 9 blue
    '[0;35;1m' => '<span style="color:black">', // 9 blue
    '[0;33;1m' => '<span style="color:black">', // 9 blue
    '[0;37;1m' => '<span style="color:black">', // 9 blue
    '[m>'   => '</span>',
    '[m<'   => '</span>',
        '[m'   => '</span>'
    );
    $kolor = str_replace(array_keys($zamien), $zamien, $kolor);
    return $kolor;
}
$kolor = convertBash(""); 
if(isset($_GET['getLog'])){
$text = file_get_contents($logFile);
echo convertBash($text);
}else{
include("clear.php");
?>

<div class="container">
  <div class="jumbotron">   
    <body>
    <div id="log">
  </body>
  </div>      
</div>
<html>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
  <script>
    setInterval(readLogFile, <?php echo $interval; ?>);
    window.onload = readLogFile; 
    var pathname = window.location.pathname;
    function readLogFile(){
      $.get(pathname, { getLog : "true" }, function(data) {
        data = data.replace(new RegExp("\n", "g"), "<br />");
            $("#log").html(data);
        });
    }
  </script>
</html>
<?php  } ?>

