<?php

	//require "../config/db_config.php";
	//require "../transportar_dados_morpho.php";
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		
		case 'GET':
			echo json_encode("vazio");
		break;
		default:
			echo json_decode(["erro"=>"404"]);	
		break;
	}

?>