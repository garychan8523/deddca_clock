<?php
date_default_timezone_set("Asia/Hong_Kong");

$date = date("H:i:s");
$date = str_split($date);

foreach ($date as $value) {
    echo '<span>' . $value . '</span>';
}


//echo date("H:i:s");
?>