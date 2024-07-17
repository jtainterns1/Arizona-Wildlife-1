
<?php

$server_ip = $_SERVER['SERVER_ADDR'];

$redirect_url = "http:/$server_ip/Home.html";
header("Location: $redirect_url");
exit();

?>