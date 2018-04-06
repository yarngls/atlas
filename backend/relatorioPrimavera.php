<?php
		require_once "../function_RH.php";
		function download($file,$label){

			$fullPath = $file;
           	if ($fd = @fopen($fullPath,"r")){
                   header("Content-type: application/octet-stream");
                   header("Content-Disposition: attachment; filename=\"$label\"");
                   while(!feof($fd)) 
                   {
                           $buffer = fread($fd, 2048);
                           echo $buffer;
                   }
                   fclose($fd);
                   exit;
          	}
		}

		function codFuncionario_Primavera($codigoCurrent){

			if(strlen($codigoCurrent)=='1'){
				return ' '.' '.' '.' '.' '.' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='2'){
				return ' '.' '.' '.' '.' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='3'){
				return ' '.' '.' '.' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='4'){
				return ' '.' '.' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='5'){
				return ' '.' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='6'){
				return ' '.' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='7'){
				return ' '.' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='8'){
				return ' '.' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='9'){
				return ' '.$codigoCurrent;
			}elseif(strlen($codigoCurrent)=='10'){
				return $codigoCurrent;
			}
			
		}

		function minuto_falta($minuto_acumulada){
			
			$minuto=ltrim($minuto_acumulada,'0');
			$mn=strval(ltrim($minuto,'0'));
			if(strlen($mn)==1){					
				if($minuto>0 && $minuto<5){
					$minuto=0;
					return  $minuto;
				}else{
					$minuto=6-1; //6 se refere a 60 minuto e 1 se refere a 10 minuto
					return $minuto;
				}			
			}else{						
				if($mn[0]<=5 && $mn[1]<5){				
					$minuto_aredeondado=strval($minuto);
					return  6-$minuto_aredeondado[0];				
				}else if($mn[0]<=5 && $mn[1]>5){
					$minuto=$minuto+10;
					$minuto_aredeondado=strval($minuto);
					return  6-$minuto_aredeondado[0];
				}else if($mn[0]==5 && $mn[1]>5){					
					return 6;// equivale a 60 minutos, ou seja, uma hora de trabalho;
				}else{
					return 'null';
				}				
			}
		}


		function converterMin_Hora($hora_falta,$minuto_falta){
			if($minuto_falta==0){
				return $hora_falta.'.0';
			}else if($minuto_falta!=0 && $minuto_falta!=6){
				$hora_falta=$hora_falta-1;
				return $hora_falta.'.'.$minuto_falta;
			}else{//entao minuto falta é = 6. Se verdade então o funcionario trabalhou 60 minuto e soma-se mais uma hora
				$hora_falta-1;
				return $hora_falta.'.0';
			}
		}

		function codhoraFalta_Primavera($hora_acumulada,$total_por_prencher,$minuto_acumulada){
			$hora_falta=$total_por_prencher-$hora_acumulada;			
			$minuto_falta=minuto_falta($minuto_acumulada);
			if(strlen($hora_falta)=='1'){
				$converterMin_Hora=converterMin_Hora($hora_falta,$minuto_falta);
				return '00000'.$converterMin_Hora;				
			}elseif(strlen($hora_falta)=='2'){
				$converterMin_Hora=converterMin_Hora($hora_falta,$minuto_falta);
				return '0000'.$converterMin_Hora;
			}elseif(strlen($hora_falta)=='3'){
				$converterMin_Hora=converterMin_Hora($hora_falta,$minuto_falta);
				return '000'.$converterMin_Hora;
			}elseif(strlen($hora_falta)=='4'){
				$converterMin_Hora=converterMin_Hora($hora_falta,$minuto_falta);
				return '00'.$converterMin_Hora;
			}elseif(strlen($hora_falta)=='5'){
				$converterMin_Hora=converterMin_Hora($hora_falta,$minuto_falta);
				return '0'.$converterMin_Hora;
			}else{
				return $hora_falta;
			}			
		}



		function escreverRelatorio($year_current,$month_current,$file,$filename,$criarFile,$db){
			$codigosFuncionarios 	= 	[]; 
			$total_dia_acumulada 	=	'--:--';
			$entrada_trabalho 		=	'--:--:--';
			$saida_almoco 			=	'--:--:--';
			$entrada_almoco 		=	'--:--:--';
			$sair_trabalho 			=	'--:--:--';
		
			$select_all_codigo=$db->query("SELECT codigo_funcionario FROM funcionarios;");

			while ($codigo = mysqli_fetch_assoc($select_all_codigo))
			{
				$codigosFuncionarios[] =$codigo;
			}
		
			for($i=0;$i<count($codigosFuncionarios);$i++){
				$codigoCurrent=$codigosFuncionarios[$i]["codigo_funcionario"];

				$total_dia_mes=compareMonthCurrent_for_MonthSearch($month_current,$year_current); // function_RH.php fornece funcao compareMonthCurrent_for_MonthSearch()

				for($d=1;$d<=$total_dia_mes;$d++){
				
					if($d<=9){
						$d='0'.$d;
					}
					$data=$year_current.'-'.$month_current.'-'.$d;
					$dataPrimavera=$d.$month_current.$year_current;
					$dia=diasemana($data);// funcao dia semana vem da pagina function.RH.php;
					
					$select_all=$db->query("SELECT * FROM piquagem_ponto where data_evento='$data' and codigo_funcionario='$codigoCurrent';");
					$entrada_trabalho 	=	'--:--:--';
					$saida_almoco 		=	'--:--:--';
					$entrada_almoco 	=	'--:--:--';
					$sair_trabalho 		=	'--:--:--';
					$total_dia_acumulada='--:--';
					while($dados_um_funcionario = mysqli_fetch_assoc($select_all)){

						if($dados_um_funcionario["tipo_evento"]=="ENTRADA NO TRABALHO"){
							$entrada_trabalho=$dados_um_funcionario["hora_evento"];
						}

						if($dados_um_funcionario["tipo_evento"]=="SAIDA ALMOÇO"){
							$saida_almoco=$dados_um_funcionario["hora_evento"];
						}

						if($dados_um_funcionario["tipo_evento"]=="ENTRADA DE ALMOÇO"){
							$entrada_almoco=$dados_um_funcionario["hora_evento"];
						}

						if($dados_um_funcionario["tipo_evento"]=="SAIDA  TRABALHO"){
							$sair_trabalho=$dados_um_funcionario["hora_evento"];
						}

					}
					$total_dia_acumulada=calculateHoursDay($entrada_trabalho,$saida_almoco,$entrada_almoco,$sair_trabalho);//function_RH.php fornece funcao calculateHoursDay
					$explode_total_dia_acumulada=explode(':',$total_dia_acumulada);

					$hora_acumulada=ltrim($explode_total_dia_acumulada[0],'0');
					$minuto_acumulada=ltrim($explode_total_dia_acumulada[1],'0');
					
					$query_total_horaDia=$db->query("SELECT hora_trab_diaria FROM funcionarios where codigo_funcionario='$codigoCurrent';");
					$total_horaDia=mysqli_fetch_array($query_total_horaDia);
					$total_por_prencher=$total_horaDia["hora_trab_diaria"];


					/*codigo cria horas faltas e hora extras*/

					if($hora_acumulada<$total_por_prencher){
						$codFuncionario_Primavera=codFuncionario_Primavera($codigoCurrent);
						$hora_falta=codhoraFalta_Primavera($hora_acumulada,$total_por_prencher,$minuto_acumulada);
						$falta='F'.$codFuncionario_Primavera.$dataPrimavera."F03".$hora_falta.'0'.'0000';
						$writeRelatorio=fwrite($criarFile,$falta."\r\n");
					}/*else if($hora_acumulada>$total_por_prencher){
					$hora_extra=$hora_acumulada-$total_por_prencher;
					$hora='H 1'.$dataPrimavera.$codigoCurrent;
					$writeRelatorio=fwrite($criarFile,$hora."\r\n");
					}else{
						$mais_opcao='?';
					}*/
					
					

				}
				$total_dia_acumulada	=	'--:--';
				$entrada_trabalho 		=	'--:--:--';
				$saida_almoco 			=	'--:--:--';
				$entrada_almoco 		=	'--:--:--';
				$sair_trabalho 			=	'--:--:--';
			}
			fclose($criarFile);
			download($filename,$file);
			return $codigosFuncionarios[0];						
			/*$starttime = microtime(true);
			$outputdata = $lines = '';*/	
		}

		/*este é para meu pc local*/
		function relatorio($year_current,$month_current){

			$db =connection();

			$ftp_server = "127.0.0.1"; // Nome ou IP do Servidor
			$login      = "gilson"; // Usuário
			$senha      = "5995330";   // Senha
			$conn_id = ftp_connect($ftp_server);

			
			if(!$conn_id){
				return "nao foi possivel conectar ao servidor de ftp dp site ".$ftp_server;
				exit;
			}else{
				$login_result = ftp_login($conn_id, $login, $senha);
				if(!$login_result){
				  return "erro ao efetuar login45";
				  exit;
				}else{
					$description_month_current=convertIndeceforMonth($month_current);
					$file="folhaPrimavera_".$description_month_current."_".$year_current.".txt";	
					$filename = 'ftp://gilson:5995330@127.0.0.1/'.$file;//meu computador
					$verificar_se_existe_fixeiro=@glob("C:/CISCO_CCNA/".$file,GLOB_BRACE);
					if(count($verificar_se_existe_fixeiro)==1){	
						unlink("C:/CISCO_CCNA/".$file);
						$criarFile=fopen($filename,'a') or die('Ficheiro não foi criado. verifica o caminho');//limpa ficheiro e escreve de novo						
						escreverRelatorio($year_current,$month_current,$file,$filename,$criarFile,$db);
						fclose($criarFile);
					}else{
						$criarFile=fopen($filename,'a') or die('Ficheiro não foi criado. verifica o caminho');//limpa ficheiro e escreve de novo						
						escreverRelatorio($year_current,$month_current,$file,$filename,$criarFile,$db);	
						fclose($criarFile);
					}
									
				}
			}
			
		}

		/*este é para o servidor de ANAS*/

		/*function relatorio($year_current,$month_current){

			$db =connection();

			
			$ftp_server = "10.73.34.28"; // Nome ou IP do Servidor
			$login      = "RelatorioPrimavera"; // Usuário
			$senha      = "5995330";   // Senha
			$conn_id = ftp_connect($ftp_server);
			
			if(!$conn_id){
				return "nao foi possivel conectar ao servidor de ftp dp site ".$ftp_server;
				exit;
			}else{
				$login_result = ftp_login($conn_id, $login, $senha);
				if(!$login_result){
				  return "erro ao efetuar login45";
				  exit;
				}else{
					$description_month_current=convertIndeceforMonth($month_current);
					$file="folhaPrimavera_".$description_month_current."_".$year_current.".txt";		
					$filename = 'ftp://RelatorioPrimavera:5995330@10.73.34.28/'.$file;					
					$verificar_se_existe_fixeiro=@glob("C:/xampp/htdocs/morphoRH/partials/relatoriosPrimavera/".$file,GLOB_BRACE);
					if(count($verificar_se_existe_fixeiro)==1){	
						unlink("C:/xampp/htdocs/morphoRH/partials/relatoriosPrimavera/".$file);
						$criarFile=fopen($filename,'a') or die('Ficheiro não foi criado. verifica o caminho');//limpa ficheiro e escreve de novo						
						escreverRelatorio($year_current,$month_current,$file,$filename,$criarFile,$db);
						fclose($criarFile);
					}else{
						$criarFile=fopen($filename,'a') or die('Ficheiro não foi criado. verifica o caminho');//limpa ficheiro e escreve de novo						
						escreverRelatorio($year_current,$month_current,$file,$filename,$criarFile,$db);	
						fclose($criarFile);
					}
									
				}
			}
			
		}*/
	
?>