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
        <link rel="icon" href="/favicon.png" />
        <link href='http://fonts.googleapis.com/css?family=Work+Sans:400,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="reset.css">
		<link rel="stylesheet" title="light" href="style.css">
        <link rel="alternate stylesheet" title="dark" href="t_dark.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

        <script src="modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>

	<body onload="set_style_from_cookie();">

    <div class="color_light_btn" onclick="switch_style('light');return false;" name="theme" id="light"></div>
    <div class="color_dark_btn" onclick="switch_style('dark');return false;" name="theme" id="dark"></div>
    <div class='fullscreen_btn' onclick="toggleFull();" id='fullscreen-button'><i class='fa fa-expand'></i></div>

 <script>
     var now = new Date(<?php echo time() * 1000 ?>);

     setInterval(updateTime, 1000);

     function addZero(i)
     {
     if (i < 10) {
         i = "0" + i;
     }
     return i;
 	}

     function updateTime(){
         var nowMS = now.getTime();
         nowMS += 1000;
         now.setTime(nowMS);
         //var clock = document.getElementById('qwe');
         var date = document.getElementById('displayDate');
         if(date){
         	// var h = addZero(now.getHours());
         	// var m = addZero(now.getMinutes());
         	// var s = addZero(now.getSeconds());
         	var datevalue = now.toDateString();

             //clock.innerHTML = "<div class='time'>" + h + ":" + m + ":" + s + "</div>" + "<br>" + "<div class='date'>" + date + "</div>";	//adjust to suit
             date.innerHTML = datevalue ;
         }
     } 
 </script>

<script>

function timer() {
    $("#displayTime").load("time.php");
}

setInterval(timer, 500);

$(document).ready(function (){
    timer();
    $("#displayDate").load("date.php");
});

</script>

<div class="filter"></div>

<div class="tcontent">
    <span id='displayTime' class="time">
        <div style="opacity: 0.3;">Loading</div>
    </span>

    <span id='displayDate' class='date'><br></span>

</div>

<script>
// *** TO BE CUSTOMISED ***

var style_cookie_name = 'deddca_theme';
var style_cookie_duration = 30;
var style_domain = "deddca";

// *** END OF CUSTOMISABLE SECTION ***
// You do not need to customise anything below this line

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

            //$(".color_light_btn").toggle(1000);
            //$(".color_dark_btn").toggle(1000);

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
