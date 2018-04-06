<?php

	//verifica se existe transactions.csv mas neste caso não foi verificado se existe ou nao
	//$verificar_se_existe_studyPhp retorna 1 caso exista e 0 em caso de não existir transactions.csv 

	//include "function_RH.php";

	//$verificar_se_existe_studyPhp=@glob('C:\Users\SILVA SANTOS\morpho\anas.csv',GLOB_BRACE);
	//$verificar_se_existe_studyPhp=@glob('C:\Users\Administrator\morpho\transactions.csv',GLOB_BRACE);
											

	$data_evento='';
	$delimitador = ',';
	$cerca = '"';
	$dataLinha='';

	$hostname 	=	'localhost';
	$username	=	'root';
	$password	=	'';
	$dbname   	=	'anas';// em caso de Anas seria 'anas' que o nome da base de dados

	$connection = mysqli_connect($hostname,$username,$password,$dbname) or die(mysql_error("erro de conexao"));
	

	function diasemana($data){

		$ano =  substr("$data", 0, 4);
		$mes =  substr("$data", 5, -3);
		$dia =  substr("$data", 8, 9);

		$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

		switch($diasemana) {
			case"0": $diasemana = "Domingo";       break;
			case"1": $diasemana = "Segunda-Feira"; break;
			case"2": $diasemana = "Terça-Feira";   break;
			case"3": $diasemana = "Quarta-Feira";  break;
			case"4": $diasemana = "Quinta-Feira";  break;
			case"5": $diasemana = "Sexta-Feira";   break;
			case"6": $diasemana = "Sabado";        break;
		}

		return $diasemana;
	}

	
	// Abrir arquivo para leitura
	$f = fopen('C:\morpho_server\transactions.csv', 'r');
	//$f = fopen('C:\Users\Administrator\morpho\transactions.csv', 'r');

	if ($f) {
		// Ler cabecalho do arquivo
	    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
	    // Enquanto nao terminar o arquivo
	
	    while (!feof($f)) {
	 
	        $linha = fgetcsv($f, 0, $delimitador, $cerca);
	      
	        $dados_evento=strval($linha[0]);		

	        $data_evento= $dados_evento[0].$dados_evento[1].$dados_evento[2].$dados_evento[3]."-".$dados_evento[4].$dados_evento[5]."-".$dados_evento[6].$dados_evento[7];
	       	$hora_evento=$dados_evento[8].$dados_evento[9].":".$dados_evento[10].$dados_evento[11].":".$dados_evento[12].$dados_evento[13];
	       	$codigo_funcionario=$linha[2];
	       	$nome_funcionario= $linha[3]. " " . $linha[4];
	        $tipo_evento = $linha[5];
	        $dia_semana=diasemana($data_evento);	

	        $verificar_dados = $connection->query("SELECT count(nome_funcionario) as total from piquagem_ponto
	        									   where nome_funcionario='$nome_funcionario' and data_evento='$data_evento' 
	        									   and tipo_evento='$tipo_evento';");


	        $resp_verificar_dados= mysqli_fetch_assoc($verificar_dados);
	        $i= $resp_verificar_dados["total"];

	        if($i==0){
	        	
		        	$select_cliente  = $connection->query("INSERT INTO piquagem_ponto(nome_funcionario,codigo_funcionario,dia_semana,
		       					 					   data_evento,hora_evento,tipo_evento)values('$nome_funcionario',
		       										   '$codigo_funcionario','$dia_semana','$data_evento','$hora_evento','$tipo_evento');");        		
	        	
	        }else{

	        	$verificar_hora_falso = $connection->query("SELECT count(nome_funcionario) as total from piquagem_ponto
	        									   where nome_funcionario='$nome_funcionario' and data_evento='$data_evento' 
	        									   and tipo_evento='$tipo_evento' and hora_evento='##:##:##';");

	        	$resp_verificar_hora=mysqli_fetch_assoc($verificar_hora_falso);
	        	$c= $resp_verificar_hora["total"];

	        	if($c==1){

	        		$delete_hora_falso = $connection->query("DELETE from piquagem_ponto
	        									   where nome_funcionario='$nome_funcionario' and data_evento='$data_evento' 
	        									   and tipo_evento='$tipo_evento' and hora_evento='##:##:##';");

        			$select_cliente  = $connection->query("INSERT INTO piquagem_ponto(nome_funcionario,codigo_funcionario,dia_semana,
	       					 					   data_evento,hora_evento,tipo_evento)values('$nome_funcionario',
	       										   '$codigo_funcionario','$dia_semana','$data_evento','$hora_evento','$tipo_evento');");      

	        	}else{
	        		$cont=0;
	        	}


	        }   
		        	
			
	        if (!$linha) {
	            continue;
	        }
	 
	        // Montar registro com valores indexados pelo cabecalho
	        //$registro = array_combine($cabecalho, $linha);
	 
	        // Obtendo o nome
	       // echo $registro['nome'].PHP_EOL;
	    }
	    fclose($f);
	}
	

?>