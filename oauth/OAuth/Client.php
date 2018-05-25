<?php
$url="http://localhost/day13/Server.php";
header("Location: http://localhost/day13/Oauth.php?response_type=code&redirect_uri=$url");