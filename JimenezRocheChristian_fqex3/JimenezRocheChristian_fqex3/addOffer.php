<?php

//echo '{"result":"ok"}';
//$data = json_decode(file_get_contents('php://input'), true);
//print_r($data);

//print_r($_POST['mydata']);
//print_r(json_decode($_POST["mydata"]));
if(isset($_POST["mydata"])) {
	header("Content-Type: application/json; charset=UTF-8");
	//echo $_POST["data"];
	$objNewOffer = json_decode($_POST["mydata"], false);
	//var_dump($objNewOffer);
	$json_file = file_get_contents('oferta1314.json');
	$jfo = json_decode($json_file);
	//var_dump($jfo);
	$jfo->oferta1314[] = $objNewOffer;
	//var_dump($jfo);
	if (file_put_contents('oferta1314.json',json_encode($jfo)) != false)
		echo '{"result":"ok"}';
	else
		echo '{"result":"fail"}';
}
else
	echo '{"result":"failPost"}';

?>