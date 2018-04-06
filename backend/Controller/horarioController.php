<?php

	//require_once "../config/db_config.php";
	
	require_once "../function_RH.php";
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		
		case 'GET':

			if(isset($_GET["id"])){
				$id = $_GET["id"];					
				$select_all=$db->query("SELECT *from horario where id_horario=(select id_horario from funcionarios where id_funcionario='$id');");

				$data = mysqli_fetch_assoc($select_all);

				echo json_encode($data);
			}else if(isset($_GET["idHorario"])){
				$idHorario = $_GET["idHorario"];
				$select_all=$db->query("SELECT *from horario where id_horario='$idHorario';");

				$data = mysqli_fetch_assoc($select_all);

				echo json_encode($data);
			}else{

				$select_all=$db->query("SELECT * FROM horario;");

				$horario = []; 

				while ($data = mysqli_fetch_assoc($select_all))
				{
					$horario[] =$data;
				}

				echo json_encode($horario);
			
			}
		break;
		case 'POST':
			$dados_horario= json_decode(file_get_contents("php://input"), true);
			$dias_semana= $dados_horario["dias_semana"];
			$horas=$dados_horario["horario"];
			$descricao=$horas["descricao"];
			$primeiro_perido=$horas["hora_entrada"].':'.$horas["minuto_entrada"].'-'.$horas["hora_saida_almoco"].':'.$horas["minuto_saida_almoco"];
			$segundo_perido=$horas["hora_entrada_almoco"].':'.$horas["minuto_entrada_almoco"].'-'.$horas["hora_saida_trabalho"].':'.$horas["minuto_saida_trabalho"];


			$segunda= $dias_semana["segunda"];
			if($segunda){
				$segunda=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$segunda='folga_horario';
			}

			$terca= $dias_semana["terca"];
			if($terca){
				$terca=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$terca='folga_horario';
			}

			$quarta= $dias_semana["quarta"];
			if($quarta){
				$quarta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$quarta='folga_horario';
			}

			$quinta= $dias_semana["quinta"];
			if($quinta){
				$quinta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$quinta='folga_horario';
			}

			$sexta= $dias_semana["sexta"];
			if($sexta){
				$sexta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$sexta='folga_horario';
			}

			$sabado= $dias_semana["sabado"];
			if($sabado){
				$sabado=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$sabado='folga_horario';
			}

			$domingo= $dias_semana["domingo"];
			if($domingo){
				$domingo=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$domingo='folga_horario';
			}
			$hora_entrada=$horas["hora_entrada"];
			$minuto_entrada=$horas["minuto_entrada"];
			$hora_saida_almoco=$horas["hora_saida_almoco"];
			$minuto_saida_almoco=$horas["minuto_saida_almoco"];

			$hora_entrada_almoco=$horas["hora_entrada_almoco"];
			$minuto_entrada_almoco=$horas["minuto_entrada_almoco"];
			$hora_saida_trabalho=$horas["hora_saida_trabalho"];
			$minuto_saida_trabalho=$horas["minuto_saida_trabalho"];
			$insert_employee=$db->query("INSERT into horario(descricao,segunda,terca,quarta,quinta,sexta,sabado,domingo,
															hora_entrada,minuto_entrada,hora_saida_almoco,minuto_saida_almoco,
															hora_entrada_almoco,minuto_entrada_almoco,hora_saida_trabalho,
															minuto_saida_trabalho)
									values('$descricao','$segunda','$terca','$quarta','$quinta','$sexta','$sabado','$domingo',
											'$hora_entrada','$minuto_entrada','$hora_saida_almoco','$minuto_saida_almoco',
															'$hora_entrada_almoco','$minuto_entrada_almoco','$hora_saida_trabalho',
															'$minuto_saida_trabalho');") 
									or die(mysqli_error($db));
			
			$id_horario=mysqli_insert_id($db);
			$horario["id_horario"] = $id_horario;
			echo json_encode($horario);	
		break;
		case 'PUT':
			$dados_horario= json_decode(file_get_contents("php://input"), true);
			$dias_semana= $dados_horario["dias_semana"];
			$horas=$dados_horario["horario"];
			$descricao=$horas["descricao"];
			$id_horario=$horas["id_horario"];

			$primeiro_perido=$horas["hora_entrada"].':'.$horas["minuto_entrada"].'-'.$horas["hora_saida_almoco"].':'.$horas["minuto_saida_almoco"];
			$segundo_perido=$horas["hora_entrada_almoco"].':'.$horas["minuto_entrada_almoco"].'-'.$horas["hora_saida_trabalho"].':'.$horas["minuto_saida_trabalho"];


			$segunda= $dias_semana["segunda"];
			if($segunda){
				$segunda=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$segunda='folga_horario';
			}

			$terca= $dias_semana["terca"];
			if($terca){
				$terca=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$terca='folga_horario';
			}

			$quarta= $dias_semana["quarta"];
			if($quarta){
				$quarta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$quarta='folga_horario';
			}

			$quinta= $dias_semana["quinta"];
			if($quinta){
				$quinta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$quinta='folga_horario';
			}

			$sexta= $dias_semana["sexta"];
			if($sexta){
				$sexta=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$sexta='folga_horario';
			}

			$sabado= $dias_semana["sabado"];
			if($sabado){
				$sabado=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$sabado='folga_horario';
			}

			$domingo= $dias_semana["domingo"];
			if($domingo){
				$domingo=$primeiro_perido.'as'.$segundo_perido;
			}else{
				$domingo='folga_horario';
			}
			$hora_entrada=$horas["hora_entrada"];
			$minuto_entrada=$horas["minuto_entrada"];
			$hora_saida_almoco=$horas["hora_saida_almoco"];
			$minuto_saida_almoco=$horas["minuto_saida_almoco"];

			$hora_entrada_almoco=$horas["hora_entrada_almoco"];
			$minuto_entrada_almoco=$horas["minuto_entrada_almoco"];
			$hora_saida_trabalho=$horas["hora_saida_trabalho"];
			$minuto_saida_trabalho=$horas["minuto_saida_trabalho"];

			$insert_employee=$db->query("UPDATE horario set descricao='$descricao',segunda='$segunda',
									 terca='$terca',quarta='$quarta',quinta='$quinta',sexta='$sexta',
									 sabado='$sabado',domingo='$domingo',hora_entrada='$hora_entrada',
									 minuto_entrada='$minuto_entrada',hora_saida_almoco='$hora_saida_almoco',
									 minuto_saida_almoco='$minuto_saida_almoco',hora_entrada_almoco='$hora_entrada_almoco',
									 minuto_entrada_almoco='$minuto_entrada_almoco',hora_saida_trabalho='$hora_saida_trabalho',
									 minuto_saida_trabalho='$minuto_saida_trabalho' where id_horario='$id_horario ';")
						 			or die(mysqli_error($db));
						 			
			$id_horario=mysqli_insert_id($db);
			$horario["id_horario"] = $id_horario;
			echo json_encode($horario);	
		break;
		default:
			echo json_decode(["erro"=>"404"]);	
		break;

		
	}

?>