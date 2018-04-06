<?php

	//require "../config/db_config.php";
	require "../function_RH.php";
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		
		case 'GET':
			
			if(isset($_GET["id"]) && !isset($_GET["day_current"]) && $_GET["print_report"]=='false'){
				$id = $_GET["id"];	
				$month_current = $_GET["month_current"];	
				$year_current = $_GET["year_current"];	

				$arrayFuncionarios=calcular_hora_diaria($id,$month_current,$year_current);
				echo json_encode($arrayFuncionarios);
			
			}else if(isset($_GET["id"]) && !isset($_GET["day_current"]) && $_GET["print_report"]!='false'){

				
				

				$_SESSION['id'] 			=	$_GET["id"];
				$_SESSION['month_current']	=	$_GET["month_current"];
				$_SESSION['year_current'] 	= 	$_GET["year_current"];	
				include '../reports/reports.php';
				
			
				//echo json_encode($_SESSION['id']);
			}else{
				$ano = Date("Y");
				$mes = Date("m");
				$dia = Date("d");
				$data=["mes"=>$mes,"ano"=>$ano,"dia"=>$dia];
				echo json_encode($data);
			}
		break;

		case 'PUT':
			transportar_dados_morpho();
			///echo json_encode(["value"=>"actualizado com sucesso"]);
		break;

		default:
			echo json_decode(["erro"=>"404"]);	
		break;
	}

?>