<?php
date_default_timezone_set("Asia/Hong_Kong");

$cookies_time = 30; //in day(s)
$cookies_time = 86400 * $cookies_time;

if(!isset($_COOKIE['deddca_theme']))
{
    setcookie('deddca_theme', 'light', time() + $cookies_time, "/");
}

?>

<html>

	<head>
		<meta charset="utf-8">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title>dedd.ca</title>
        <link rel="icon" href="assets/favicon.png" />
        <link href='http://fonts.googleapis.com/css?family=Work+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" title="light" href="css/style.css">
        <link rel="alternate stylesheet" title="dark" href="css/dark.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <script src="js/modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/lettering.js"></script>
	</head>

	<body onload="set_style_from_cookie();">
    <div class="color_light_btn" onclick="switch_style('light');return false;" name="theme" id="light"></div>
    <div class="color_dark_btn" onclick="switch_style('dark');return false;" name="theme" id="dark"></div>
    <div class='fullscreen_btn' ondblclick="toggleFull();" id='fullscreen-button'></div>

 <script>
     var now = new Date(<?php echo time() * 1000 ?>);
     //setInterval(updateTime, 1000);

     function addZero(i)
     {
     if (i < 10) {
         i = "0" + i;
     }
     return i;
 	}

     function localTime(){
         var time = document.getElementById('displayTime');
         var date = document.getElementById('displayDate');

         if(time && date){
            var timevalue = new Date().toLocaleTimeString('en-US', { hour12: false, hour: "numeric", minute: "numeric", second: "numeric"});
            timevalue = timevalue.split('');
            //alert('123');

            var output_time = '';
            for (i in timevalue) {
                output_time += '<span>' + timevalue[i] + '</span>';
            } 

         	var datevalue = now.toDateString();

             if(time.innerHTML != output_time)
                time.innerHTML = output_time;
             if(date.innerHTML != datevalue)
                date.innerHTML = datevalue;
         }
     } 
 </script>

<script>

function serverTime() {
    $("#displayTime").load("time.php");
    $("#displayDate").load("date.php");
}


$(document).ready(function (){
    //serverTime();                    //initialize from server
    localTime();                       //initialize from local

    //setInterval(serverTime, 500);    //use server time
    setInterval(localTime, 200);       //use local time

    document.getElementById('message-remind').style.display = 'block';  //display remind message
});

</script>

<div class="filter"></div>

<div class="content">
    <div id='displayTime' class="time">
        <div style="opacity: 0.3;">Loading</div>
    </div>

    <span id='displayDate' class='date'><br></span>

    <span id='message-remind'>Double click to toggle full screen</span>
</div>

<script>
var style_cookie_name = 'deddca_theme';
var style_cookie_duration = 30;
var style_domain = "deddca";

function set_style_from_cookie()
{
  var css_title = getCookie(style_cookie_name);
  if (css_title.length)
  {
    switch_style(css_title);
  }
}

function switch_style(css_title)
{
  var i, link_tag ;
  for (i = 0, link_tag = document.getElementsByTagName("link"); i < link_tag.length; i++ )
  {
    if ((link_tag[i].rel.indexOf("stylesheet") != -1) && link_tag[i].title)
    {
      link_tag[i].disabled = true ;
      if (link_tag[i].title == css_title)
      {
        link_tag[i].disabled = false ;
      }
    }
    setCookie('deddca_theme', css_title, 30);
    //set_cookie(style_cookie_name, css_title, style_cookie_duration, style_domain);
  }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function cancelFullScreen(el) {
            var requestMethod = el.cancelFullScreen||el.webkitCancelFullScreen||el.mozCancelFullScreen||el.exitFullscreen;
            if (requestMethod) { // cancel full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        function requestFullScreen(el) {
            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(el);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
            return false
        }

        function toggleFull() {
            var elem = document.documentElement; // Make the body go full screen.
            var isInFullScreen = (document.fullScreenElement && document.fullScreenElement !== null) ||  (document.mozFullScreen || document.webkitIsFullScreen);

            if (isInFullScreen) {
                cancelFullScreen(document);
            } else {
                requestFullScreen(elem);
            }
            return false;
        }
</script>

	</body>

</html>
