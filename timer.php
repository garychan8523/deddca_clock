<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<script>

function timer() {
    $("#time").load("time.php");
}

setInterval(timer, 500);

$(document).ready(function (){
    timer();
});

</script>

</head>

<body>
	<div id="time">Loading</time>
</body>

<?php

?>