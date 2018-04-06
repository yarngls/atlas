<?php

	require_once "../function_RH.php";
	//require_once "../transportar_dados_morpho.php";
	//require_once "../transportar_dados_morpho.php";
	$db=connection();

	$want = $_SERVER["REQUEST_METHOD"];

	switch ($want) {
		
		case 'GET':
			//transportar_dados_morpho();
			if(isset($_GET["id"])){
				//transportar_dados_morpho();
				$id = $_GET["id"];					
				$select_all=$db->query("SELECT * FROM funcionarios where id_funcionario='$id';");

				$data = mysqli_fetch_assoc($select_all);

				echo json_encode($data);
			}else{

				$select_all=$db->query("SELECT * FROM funcionarios;");

				$funcionarios = []; 

				while ($data = mysqli_fetch_assoc($select_all))
				{
					$funcionarios[] =$data;
				}

				echo json_encode($funcionarios);
			}
		break;
		case 'POST':
			$funcionario = json_decode(file_get_contents("php://input"), true);
			$nome_funcionario	= $funcionario['nome_funcionario'];
			$codigo_funcionario	= $funcionario['codigo_funcionario'];
			$funcao_funcionario	= $funcionario['funcao_funcionario'];
			$contato_funcionario= @$funcionario['contato_funcionario'];
			$email_funcionario	= @$funcionario['email_funcionario'];
			$hora_trab_diaria	= @$funcionario['hora_trab_diaria'];
			$id_horario			= @$funcionario['id_horario'];

			$insert_employee=$db->query("INSERT into funcionarios(nome_funcionario,codigo_funcionario,funcao_funcionario,
																  contato_funcionario,email_funcionario,hora_trab_diaria,
																  id_horario,foto)
								values('$nome_funcionario','$codigo_funcionario','$funcao_funcionario',
									   '$contato_funcionario','$email_funcionario','$hora_trab_diaria','$id_horario','perfil.jpg');") 
							or die(mysqli_error($db));
			$id_funcionario=mysqli_insert_id($db);
			$funcionario["id_funcionario"] = $id_funcionario;
			echo json_encode($funcionario);
		break;
		case 'PUT':			
			$funcionario= json_decode(file_get_contents("php://input"), true);
			$id_funcionario 	= $funcionario['id_funcionario'];
			$nome_funcionario	= $funcionario['nome_funcionario'];
			$codigo_funcionario	= $funcionario['codigo_funcionario'];
			$funcao_funcionario	= $funcionario['funcao_funcionario'];
			$contato_funcionario= @$funcionario['contato_funcionario'];
			$email_funcionario	= @$funcionario['email_funcionario'];
			$hora_trab_diaria	= @$funcionario['hora_trab_diaria'];
			$id_horario			= @$funcionario['id_horario'];

			$insert_employee=$db->query("UPDATE funcionarios set nome_funcionario='$nome_funcionario',codigo_funcionario='$codigo_funcionario',
										 funcao_funcionario='$funcao_funcionario',contato_funcionario='$contato_funcionario',
										 email_funcionario='$email_funcionario',hora_trab_diaria='$hora_trab_diaria',id_horario='$id_horario'
										 where id_funcionario='$id_funcionario ';")
							 			or die(mysqli_error($db));
			/*$id_funcionario=mysqli_insert_id($db);
			$funcionario["id_funcionario"] = $id_funcionario;*/
			echo json_encode("so la");
		break;		
		default:			
			echo json_decode(["erro"=>"404"]);	
		break;

		
	}

?>