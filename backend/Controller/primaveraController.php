<?php

	//require "../config/db_config.php";

	require_once "../function_RH.php";
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		
		case 'GET':

			if(isset($_GET["primavera"])){
				$month_current = $_GET["month_current"];	
				$year_current = $_GET["year_current"];
				require "../relatorioPrimavera.php";
				$relatorio = relatorio($year_current,$month_current);				
				echo json_encode($relatorio);
			}else{
				$ano = Date("Y");
				$mes = Date("m");				
				$data=["mes"=>$mes,"ano"=>$ano];
				echo json_encode($data);
			}
		break;
		
		default:
			echo json_decode(["erro"=>"404"]);	
		break;
		
	}

?>