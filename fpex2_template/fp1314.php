<?php
//header("Content-Type: application/json; charset=UTF-8");
$str = file_get_contents('oferta1314.json');
echo json_encode($str);
?>