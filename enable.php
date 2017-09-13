<?php
setcookie("enable", "1", time()+(60*60*24*30), '/', ".{$_SERVER['HTTP_HOST']}");
header("Location: /"); 
