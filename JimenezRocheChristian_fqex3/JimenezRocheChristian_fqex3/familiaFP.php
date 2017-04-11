<?php
header("Content-Type: application/json; charset=UTF-8");
if (isset($_POST['codi'])) {
	$codi = $_POST['codi'];
	$json_file = file_get_contents('oferta1314.json');
	$jfo = json_decode($json_file);
	$arrayOfertas = $jfo->oferta1314;
	$result = array();
	foreach ($arrayOfertas as $objOferta) {
		if ($objOferta->Familia_cicle == $codi) {
			$result[] = $objOferta;
		}
	}
//	echo $result;
	echo '{"oferta1314":' . json_encode($result) . '}';
}
?>