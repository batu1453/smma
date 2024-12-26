<?php
$ip = $_SERVER['REMOTE_ADDR'];  // Kullanıcı IP'si
echo json_encode(array("ip" => $ip));
?>
