<?php
	
	function connection(){
		
		$hostname 	=	'localhost';
		$username	=	'root';
		$password	=	'';
		$dbname   	=	'anas';// em caso de meu computador 
		//$dbname   	=	'anas';// em caso de servidor de primaveras de ANAS

		$connection = mysqli_connect($hostname,$username,$password,$dbname) or die(mysql_error("erro de conexao"));
	
		return $connection;

	}

	header("Content-Type: application/json");
	

	function convertIndeceforMonth($indece){

		$arrayindece=array(
						"01"	=>	"Janeiro",
						"02"	=>	"Fevereiro",
						"03"	=>	"Março",
						"04"	=>	"Abril",
						"05"	=>	"Maio",
						"06"	=>	"Junho",
						"07"	=>	"Julho",
						"08"	=>	"Agosto",
						"09"	=>	"Setembro",
						"10"	=>	"Outubro",
						"11"	=>	"Novembro",
						"12"	=>	"Dezembro"

					);


		foreach ($arrayindece as $key => $value) {
			
			if($indece==$key){
				return $value;
			}			
			
		}
		return false;
	}

	function convertMonthforIndece($month){

		$arraymonth=array(
						"01"	=>	"Janeiro",
						"02"	=>	"Fevereiro",
						"03"	=>	"Março",
						"04"	=>	"Abril",
						"05"	=>	"Maio",
						"06"	=>	"Junho",
						"07"	=>	"Julho",
						"08"	=>	"Agosto",
						"09"	=>	"Setembro",
						"10"	=>	"Outubro",
						"11"	=>	"Novembro",
						"12"	=>	"Dezembro"

					);


		foreach ($arraymonth as $key => $value) {
			
			if($month==$value){
				return $key;
			}			
			
		}
		return $month;
	}


	function convertDate($date){

		$dateExplode=explode("-", $date);

		$month=convertIndeceforMonth($dateExplode[1]);

		$dateImplode = $dateExplode[2]." ".$month." ".$dateExplode[0];
		return $dateImplode;
	}

	function returnDiaSemanaw(){
		$array_semana = array(
								"1"	=>	"Domingo",
								"2"	=>	"Segunda-Feira",
								"3"	=>	"Terça-Feira",
								"4"	=>	"Quarta-Feira",
								"5"	=>	"Quinta-Feira",
								"6"	=>	"Sexta-Feira",
								"7"	=>	"Sabado"
						);

		foreach ($array_semana as $key => $value) {
			if(date('w')==$key){
				return $value;
			}
			
		}
		
	}

	function returnDia(){
		$array_semana = array(
								"0"	=>	"domingo",
								"1"	=>	"segunda",
								"2"	=>	"terca",
								"3"	=>	"quarta",
								"4"	=>	"quinta",
								"5"	=>	"sexta",
								"6"	=>	"sabado"
						);

		foreach ($array_semana as $key => $value) {
			if(date('w')==$key){
				return $value;
			}
			
		}
		
	}

	/*function calcular_hora_saida($confirmar_hora_saida_intervalo){

		$array_horas=array(
							"0"=>"24",
							"1"=>"25",
							"2"=>"26",
							"3"=>"27",
							"4"=>"28",
							"5"=>"29",
							"6"=>"30",
							"7"=>"31"
						  );

		foreach ($array_horas as $key => $value) {
			if($confirmar_hora_saida_intervalo==$key){
				return $value;
			}
		}
	}*/

	
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

		function converHour($hour){

			$array_hous=array(
							"00"=>"24",
							"01"=>"25",
							"02"=>"26",
							"03"=>"27",
							"04"=>"28",
							"05"=>"29",
							"06"=>"30",
							"07"=>"31",
							"08"=>"32",
							"09"=>"33",							
							"10"=>"34",
							"11"=>"35",
							"12"=>"36"
							);
			foreach ($array_hous as $key => $value) {
				if($hour==$key){
					return $value;
				}
			}
		}

	function tipo_turno($dados){

		if(strstr($dados, 'as')){

			$array_periodos=explode('as', $dados);
			$primeiro_periodo=$array_periodos[0];
			$segundo_periodo=$array_periodos[1];

			$tempo_primeiro_periodo=explode('-',$primeiro_periodo);
			$tempo_segundo_periodo=explode('-',$segundo_periodo);
			$tempo_entrada_trabalho=$tempo_primeiro_periodo[0];
			$tempo_saida_intervalo=$tempo_primeiro_periodo[1];
			$array_hora_entrada_trabalho=explode(':', $tempo_entrada_trabalho);
			$array_hora_saida_intervalo=explode(':', $tempo_saida_intervalo);
			$tempo_entrada_intervalo=$tempo_segundo_periodo[0];
			$tempo_saida_trabalho=$tempo_segundo_periodo[1];
			$array_hora_entrada_intervalo=explode(':', $tempo_entrada_intervalo);
			$array_hora_saida_trabalho=explode(':', $tempo_saida_trabalho);



			$hora_entrada_trabalho=$array_hora_entrada_trabalho[0];
			$minuto_entrada_trabalho=$array_hora_entrada_trabalho[1];

			$hora_saida_intervalo=$array_hora_saida_intervalo[0];
			$minuto_saida_intervalo=$array_hora_saida_intervalo[1];

			$hora_entrada_intervalo=$array_hora_entrada_intervalo[0];
			$minuto_entrada_intervalo=$array_hora_entrada_intervalo[1];

			$hora_saida_trabalho=$array_hora_saida_trabalho[0];
			$minuto_saida_trabalho=$array_hora_saida_trabalho[1];
			$total_primeiro_turno =0;
			$total_segundo_turno  =0;

			if(ltrim($hora_saida_intervalo,'0')<ltrim($hora_entrada_trabalho,'0')){
				$hora_saida_intervalo=converHour($hora_saida_intervalo);
				$total_primeiro_turno =$hora_saida_intervalo-$hora_entrada_trabalho;
			}

			if(ltrim($hora_saida_trabalho,'0')<ltrim($hora_entrada_intervalo,'0')){
				$hora_saida_trabalho=converHour($hora_saida_trabalho);
				$total_segundo_turno =$hora_saida_trabalho-$hora_entrada_intervalo;
			}

			if(ltrim($hora_saida_intervalo,'0')>ltrim($hora_entrada_trabalho,'0')){				
				$total_primeiro_turno =$hora_saida_intervalo-$hora_entrada_trabalho;
			}

			if(ltrim($hora_saida_trabalho,'0')>ltrim($hora_entrada_intervalo,'0')){
				$total_segundo_turno =$hora_saida_trabalho-$hora_entrada_intervalo;
			}

			$tota_hora_diario=$total_primeiro_turno+$total_segundo_turno;

			//$hora_sa=$horas_primeiro_periodo[0];
			return $tota_hora_diario;

		}else if(strstr($dados,'------')){
			return 0;
			
		}else{
			
			$periodo_trabalho=explode('-',$dados);
			$tempo_entrada_trabalho=$periodo_trabalho[0];
			$tempo_saida_trabalho=$periodo_trabalho[1];
			$array_entrada_trabalho=explode(':', $tempo_entrada_trabalho);
			$array_saida_trabalho=explode(':', $tempo_saida_trabalho);

			$hora_entrada_trabalho=$array_entrada_trabalho[0];
			$minuto_entrada_trabalho=$array_entrada_trabalho[1];

			$hora_saida_trabalho=$array_saida_trabalho[0];
			$minuto_minuto_trabalho=$array_saida_trabalho[1];
			
			$tota_hora_dia=0;

			if(ltrim($hora_saida_trabalho,'0')<ltrim($hora_entrada_trabalho,'0')){
				$hora_saida_trabalho=converHour($hora_saida_trabalho);
				$tota_hora_dia=$hora_saida_trabalho-$hora_entrada_trabalho;
			}

			if(ltrim($hora_saida_trabalho,'0')>ltrim($hora_entrada_trabalho,'0')){
				
				$tota_hora_dia=$hora_saida_trabalho-$hora_entrada_trabalho;
			}

			return $tota_hora_dia;
			
		}
	}


	function dias_do_mes($mes,$ano){

		$numero = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
		return $numero;

	}

		function calendario_funcionario($nome_funcionario,$mes_hoje,$ano_hoje){

			$db=connection();
			$dias_trabalho=$db->query(" SELECT *from turnos_funcionarios where id_horario = (select a1.id_horario from funcionarios a1 where nome_funcionario='$nome_funcionario');");
			$result=mysqli_fetch_array($dias_trabalho);
			$contador=0;
			$array_hora_diaria=[];
			$hora='';
			if($result['segunda']!='------' || $result['segunda']!=''){				
				$hora=tipo_turno($result['segunda']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Segunda-Feira','hora'=>$hora);
			}

			if($result['terca']!='------' || $result['terca']!=''){				
				$hora=tipo_turno($result['terca']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Terça-Feira','hora'=>$hora);
			}

			if($result['quarta']!='------' || $result['quarta']!=''){				
				$hora=tipo_turno($result['quarta']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Quarta-Feira','hora'=>$hora);
			}

			if($result['quinta']!='------' || $result['quinta']!=''){	
				$hora=tipo_turno($result['quinta']);	
				if($hora==0){
					$contador++;
				}		
				$array_hora_diaria[]=array('dia'=>'Quinta-Feira','hora'=>$hora);
				
			}

			if($result['sexta']!='------' || $result['sexta']!=''){				
				$hora=tipo_turno($result['sexta']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Sexta-Feira','hora'=>$hora);
			}

			if($result['sabado']!='------' || $result['sabado']!=''){
				$hora=tipo_turno($result['sabado']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Sabado','hora'=>$hora);
				
			}

			if($result['domingo']!='------' || $result['domingo']!=''){
				$hora=tipo_turno($result['domingo']);
				if($hora==0){
					$contador++;
				}
				$array_hora_diaria[]=array('dia'=>'Domingo','hora'=>$hora);
			}


			$ind_mes=convertMonthforIndece($mes_hoje);			
			$total_dias_mes=dias_do_mes($ind_mes,$ano_hoje);		
			$soma_horas_diarias=0;
			$arrayH=[];

			$requisitos_funcionarios=$db->query("SELECT dias_folgas, hora_trab_diaria from funcionarios where nome_funcionario='$nome_funcionario';");
			$data=mysqli_fetch_array($requisitos_funcionarios);
			$dias_folgas=$data['dias_folgas'];
			$hora_trab_diaria =$data['hora_trab_diaria'];
			$total_hora_foga_mensal=0;
			$array_dias_folgas=[];

			if(strstr($dias_folgas,',')){
				$array_dias_folgas=explode(',', $dias_folgas);
			}else{
				$array_dias_folgas[0]=$dias_folgas;
			}

			for ($i=1; $i<=$total_dias_mes; $i++) { 
				
				if(strlen($i)=='1'){

					$i='0'.$i;
					$data=$ano_hoje.'-'.$ind_mes.'-'.$i;
					$diasemana=diasemana($data);
					
					for($c=0;$c<7;$c++){
						if($array_hora_diaria[$c]['dia']==$diasemana){
							$soma_horas_diarias=$soma_horas_diarias+$array_hora_diaria[$c]['hora'];
						}
							
					}

					for($d=0;$d<count($array_dias_folgas);$d++){
						if($array_dias_folgas[$d]==$diasemana){
							$total_hora_foga_mensal=$total_hora_foga_mensal+$hora_trab_diaria;
						}
					}					
					
				}else{
					
					
					$data=$ano_hoje.'-'.$ind_mes.'-'.$i;
					$diasemana=diasemana($data);
					
					for($c=0;$c<7;$c++){

						if($array_hora_diaria[$c]['dia']==$diasemana){
							$soma_horas_diarias=$soma_horas_diarias+$array_hora_diaria[$c]['hora'];
						}							

					}

					for($d=0;$d<count($array_dias_folgas);$d++){
						if($array_dias_folgas[$d]==$diasemana){
							$total_hora_foga_mensal=$total_hora_foga_mensal+$hora_trab_diaria;
						}
					}
					
				}
			}

			if($contador==0){
				$soma_horas_diarias=$soma_horas_diarias-$total_hora_foga_mensal;
			}
			return ([
					'total_hora_mensal'=>$soma_horas_diarias,
					'array_dias_folgas'=>$array_dias_folgas,
					'total_hora_foga_mensal'=>$total_hora_foga_mensal,
					'hora_diaria'=>$array_hora_diaria[0]['hora'],
					'contador'=>$contador
					]);
		}

		function convertediasDB($dia){
			$array_semana = array(
									"domingo"	=>	"Domingo",
									"segunda"	=>	"Segunda-Feira",
									"terca"		=>	"Terça-Feira",
									"quarta"	=>	"Quarta-Feira",
									"quinta"	=>	"Quinta-Feira",
									"sexta"		=>	"Sexta-Feira",
									"sabado"	=>	"Sabado"
							);

			foreach ($array_semana as $key => $value) {
				if($dia==$value){
					return $key;
				}
				
			}
			
		}

	/********************************************************
		inicio funcoes para calcular hora do dia do funcionario

	******************************************************/
	function compareMonthCurrent_for_MonthSearch($month_current,$year_current){
		$dateToday = Date('m');
		if($month_current==$dateToday){
			return Date("d");			
		}else{
			return dias_do_mes($month_current,$year_current);
		}
	}

	$arrayFuncionarios=[];

	$nome_funcionario 	=	'--:--:--';
	$id_funcionario 	=	'--:--:--';
	$entrada_trabalho 	=	'--:--:--';
	$saida_almoco 		=	'--:--:--';
	$entrada_almoco 	=	'--:--:--';
	$sair_trabalho 		=	'--:--:--';
	$data_registo 		=	'--:--:--';
	$data_evento 		=	'--:--:--';
	$diasemana 			=	'--:--:--';

	$total_hora_primeiro_periodo='--:--';
    $total_minuto_primeiro_periodo='--:--';
    $total_hora_segundo_periodo='--:--';
    $total_minuto_segundo_periodo='--:--';
    $total_hora_perido_unico='--:--';
	$total_minuto_perido_unico='--:--';

    $total_hora_dia='--:--';
    $total_minuto_dia='--:--';

	function calculateHoursDay($entrada_trabalho,$saida_almoco,$entrada_almoco,$sair_trabalho){

		$total_hora_primeiro_periodo='--:--';
	    $total_minuto_primeiro_periodo='--:--';
	    $total_hora_segundo_periodo='--:--';
	    $total_minuto_segundo_periodo='--:--';
	    $total_hora_perido_unico='--:--';
		$total_minuto_perido_unico='--:--';

	    $total_hora_dia='--:--';
	    $total_minuto_dia='--:--';

		$explode_entrada_trabalho=explode(':',$entrada_trabalho);
		$explode_saida_almoco=explode(':',$saida_almoco);
		$explode_entrada_almoco=explode(':',$entrada_almoco);
		$explode_sair_trabalho=explode(':',$sair_trabalho);

		$hora_entrada=ltrim($explode_entrada_trabalho[0],'0');
		$minuto_entrada=ltrim($explode_entrada_trabalho[1],'0');

		$hora_saida_intervalo=ltrim($explode_saida_almoco[0],'0');
		$minuto_saida_intervalo=ltrim($explode_saida_almoco[1],'0');

		$hora_entrada_intervalo=ltrim($explode_entrada_almoco[0],'0');
		$minuto_entrada_intervalo=ltrim($explode_entrada_almoco[1],'0');

		$hora_saida_trabalho=ltrim($explode_sair_trabalho[0],'0');
		$minuto_saida_trabalho=ltrim($explode_sair_trabalho[1],'0');


		/** inicio de calcular primeiro periodo**/
		if($hora_entrada!="--" && $hora_saida_intervalo!="--"){
        	
        	if($minuto_entrada>0){
        		$hora_entrada=$hora_entrada+1;
        		$minuto_entrada=60-$minuto_entrada;

        		$total_hora_primeiro_periodo=$hora_saida_intervalo-$hora_entrada;
        		$total_minuto_primeiro_periodo=$minuto_entrada+$minuto_saida_intervalo;

        		if($total_minuto_primeiro_periodo>=60){
        			$total_hora_primeiro_periodo=$total_hora_primeiro_periodo+1;
        			$total_minuto_primeiro_periodo=$total_minuto_primeiro_periodo-60;
        		}
        	}else if($minuto_entrada==0){
        		$total_hora_primeiro_periodo=$hora_saida_intervalo-$hora_entrada;
        		$total_minuto_primeiro_periodo=$minuto_saida_intervalo;
        	}else{
        		$total_hora_primeiro_periodo='--:--';
       			$total_minuto_primeiro_periodo='--:--';
        	}  
        }
        /** fim de calcular primeiro periodo**/


        /** inicio calcular segundo perido***/
        if($hora_entrada_intervalo!="--" && $hora_saida_trabalho!="--"){

        	if($minuto_entrada_intervalo>0){
        		$hora_entrada_intervalo=$hora_entrada_intervalo+1;
        		$minuto_entrada_intervalo=60-$minuto_entrada_intervalo;

        		$total_hora_segundo_periodo=$hora_saida_trabalho-$hora_entrada_intervalo;
        		$total_minuto_segundo_periodo=$minuto_entrada_intervalo+$minuto_saida_trabalho;

        		if($total_minuto_segundo_periodo>=60){
        			$total_hora_segundo_periodo=$total_hora_segundo_periodo+1;
        			$total_minuto_segundo_periodo=$total_minuto_segundo_periodo-60;
        		}
        	}else if($minuto_entrada_intervalo==0){
        		$total_hora_segundo_periodo=$hora_saida_trabalho-$hora_entrada_intervalo;
        		$total_minuto_segundo_periodo=$minuto_saida_trabalho;
        	}else{
        		$total_hora_segundo_periodo='--:--';
        		$total_minuto_segundo_periodo='--:--';
        	}
        }        
         /** fim calcular segundo perido***/

         /** inicio se o funcionario picou somente hora entrada e hora de saida de trabalho**/
       
        if($hora_entrada!="--" && $hora_saida_intervalo=="--" && $hora_entrada_intervalo=='--' && $hora_saida_trabalho!="--"){
        	
        	if($minuto_entrada>0){
        		$hora_entrada=$hora_entrada+1;
        		$minuto_entrada=60-$minuto_entrada;        		
	        	$total_hora_perido_unico=$hora_saida_trabalho-$hora_entrada;
	        	$total_minuto_perido_unico=$minuto_entrada+$minuto_saida_trabalho;
	        	if($total_minuto_perido_unico>=60){
	        		$total_hora_perido_unico=$total_hora_perido_unico+1;
	        		$total_minuto_perido_unico=$total_minuto_perido_unico-60;
	        	}
        	}else if($minuto_entrada==0){
        		$total_hora_perido_unico=$hora_saida_trabalho-$hora_entrada;
        		$total_minuto_perido_unico=$minuto_saida_trabalho;
        	}else{
        		$total_hora_perido_unico='--:--';
		    	$total_minuto_perido_unico='--:--';
        	}
        }   

         /** fim se o funcionario picou somente hora entrada e hora de saida de trabalho**/

         


        if($total_hora_primeiro_periodo!='--:--' && $total_hora_segundo_periodo!='--:--'){
        	$total_hora_dia= $total_hora_primeiro_periodo + $total_hora_segundo_periodo;
    		$total_minuto_dia=$total_minuto_primeiro_periodo + $total_minuto_segundo_periodo;

			if($total_minuto_dia>=60){
    			$total_hora_dia=$total_hora_dia+1;
    			$total_minuto_dia=$total_minuto_dia-60;
    		}
    		
        }else if($total_hora_primeiro_periodo!='--:--' && $total_hora_segundo_periodo=='--:--'){

        	$total_hora_dia=$total_hora_primeiro_periodo;
        	$total_minuto_dia=$total_minuto_primeiro_periodo;

        }else if($total_hora_primeiro_periodo=='--:--' && $total_hora_segundo_periodo!='--:--'){

        	$total_hora_dia=$total_hora_segundo_periodo;
        	$total_minuto_dia=$total_minuto_segundo_periodo;

        }else if($total_hora_perido_unico!='--:--' && $total_minuto_perido_unico!='--:--'){
        	$total_hora_dia=$total_hora_perido_unico;
        	$total_minuto_dia=$total_minuto_perido_unico;
        }else{
        	$total_hora_dia='--';
		    $total_minuto_dia='--';
        }

     	 return $total_hora_dia.':'.$total_minuto_dia;

     	 	$nome_funcionario 	=	'--:--:--';
			$id_funcionario 	=	'--:--:--';
			$entrada_trabalho 	=	'--:--:--';
			$saida_almoco 		=	'--:--:--';
			$entrada_almoco 	=	'--:--:--';
			$sair_trabalho 		=	'--:--:--';
			$data_registo 		=	'--:--:--';
			$data_evento 		=	'--:--:--';
			$diasemana 			=	'--:--:--';

			$total_hora_primeiro_periodo='--:--';
		    $total_minuto_primeiro_periodo='--:--';
		    $total_hora_segundo_periodo='--:--';
		    $total_minuto_segundo_periodo='--:--';
		    $total_hora_perido_unico='--:--';
		    $total_minuto_perido_unico='--:--';

		    $total_hora_dia='--:--';
		    $total_minuto_dia='--:--';
	}

	function total_hora_mes($array_horas){

		$total_hora_mensal=0;
		$total_minuto_mensal=0;
		for($i=0;$i<count($array_horas);$i++){
			$explode_horas_minutos=explode(':',$array_horas[$i]["total_hora_dia"]);
			$hora=ltrim($explode_horas_minutos[0],'0');
			$minuto=ltrim($explode_horas_minutos[1],'0');

			if($hora!='--' && $minuto!='--' && $hora>0){
				$total_hora_mensal=$total_hora_mensal+$hora;
				$total_minuto_mensal=$total_minuto_mensal+$minuto;
			}
			
		}

		if($total_minuto_mensal>60){
			$minuto_em_hora=round($total_minuto_mensal/60);
			$total_hora_mensal=$total_hora_mensal+$minuto_em_hora;
			$total_minuto_mensal=$total_minuto_mensal-($minuto_em_hora*60);
		}

		$total_mensal=$total_hora_mensal.':'.$total_minuto_mensal;
		return $total_mensal;
		
	}

	function hora_preencher($month_current,$year_current,$id){
		$total_preencher=0;
		$db=connection();
		$select_all=$db->query("SELECT hora_trab_diaria,id_horario from funcionarios where id_funcionario='$id';");
		$hora_diaria=mysqli_fetch_assoc($select_all);
		$hora=$hora_diaria['hora_trab_diaria'];
		$id_horario=$hora_diaria['id_horario'];



		$total_dia=dias_do_mes($month_current,$year_current);
		$arrayDias=[];
		for ($i=1;$i<=$total_dia;$i++){	
			if(strlen($i)=='1'){
				$i='0'.$i;
			}
			$data=$year_current.'-'.$month_current.'-'.$i;
			$dia_semana=diasemana($data);
			$dayBD=convertediasDB($dia_semana);
			$select_hora_trabalho=$db->query("SELECT {$dayBD} from horario where id_horario='$id_horario';");
			$horas=mysqli_fetch_assoc($select_hora_trabalho);
			$horas_funcionario=$horas[$dayBD];
			if($horas_funcionario!='folga_horario'){
				$total_preencher=$total_preencher+$hora;
			}

		}			

		return $total_preencher;

	}

	function DiasFaltas($entrada_trabalho,$saida_almoco,$entrada_almoco,$sair_trabalho){

		$total_hora_primeiro_periodo='--:--';
	    $total_minuto_primeiro_periodo='--:--';
	    $total_hora_segundo_periodo='--:--';
	    $total_minuto_segundo_periodo='--:--';

	    $total_hora_dia='--:--';
	    $total_minuto_dia='--:--';

		$explode_entrada_trabalho=explode(':',$entrada_trabalho);
		$explode_saida_almoco=explode(':',$saida_almoco);
		$explode_entrada_almoco=explode(':',$entrada_almoco);
		$explode_sair_trabalho=explode(':',$sair_trabalho);

		$hora_entrada=ltrim($explode_entrada_trabalho[0],'0');
		$minuto_entrada=ltrim($explode_entrada_trabalho[1],'0');

		$hora_saida_intervalo=ltrim($explode_saida_almoco[0],'0');
		$minuto_saida_intervalo=ltrim($explode_saida_almoco[1],'0');

		$hora_entrada_intervalo=ltrim($explode_entrada_almoco[0],'0');
		$minuto_entrada_intervalo=ltrim($explode_entrada_almoco[1],'0');

		$hora_saida_trabalho=ltrim($explode_sair_trabalho[0],'0');
		$minuto_saida_trabalho=ltrim($explode_sair_trabalho[1],'0');


		/** inicio de calcular primeiro periodo**/
		if($hora_entrada!="--" && $hora_saida_intervalo!="--"){
        	
        	if($minuto_entrada>0){
        		$hora_entrada=$hora_entrada+1;
        		$minuto_entrada=60-$minuto_entrada;

        		$total_hora_primeiro_periodo=$hora_saida_intervalo-$hora_entrada;
        		$total_minuto_primeiro_periodo=$minuto_entrada+$minuto_saida_intervalo;

        		if($total_minuto_primeiro_periodo>=60){
        			$total_hora_primeiro_periodo=$total_hora_primeiro_periodo+1;
        			$total_minuto_primeiro_periodo=$total_minuto_primeiro_periodo-60;
        		}
        	}else if($minuto_entrada==0){
        		$total_hora_primeiro_periodo=$hora_saida_intervalo-$hora_entrada;
        		$total_minuto_primeiro_periodo=$minuto_saida_intervalo;
        	}else{
        		$total_hora_primeiro_periodo='--';
       			$total_minuto_primeiro_periodo='--';
        	}  
        }
        /** fim de calcular primeiro periodo**/


        /** inicio calcular segundo perido***/
        if($hora_entrada_intervalo!="--" && $hora_saida_trabalho!="--"){

        	if($minuto_entrada_intervalo>0){
        		$hora_entrada_intervalo=$hora_entrada_intervalo+1;
        		$minuto_entrada_intervalo=60-$minuto_entrada_intervalo;

        		$total_hora_segundo_periodo=$hora_saida_trabalho-$hora_entrada_intervalo;
        		$total_minuto_segundo_periodo=$minuto_entrada_intervalo+$minuto_saida_trabalho;

        		if($total_minuto_segundo_periodo>=60){
        			$total_hora_segundo_periodo=$total_hora_segundo_periodo+1;
        			$total_minuto_segundo_periodo=$total_minuto_segundo_periodo-60;
        		}
        	}else if($minuto_entrada_intervalo==0){
        		$total_hora_segundo_periodo=$hora_saida_trabalho-$hora_entrada_intervalo;
        		$total_minuto_segundo_periodo=$minuto_saida_trabalho;
        	}else{
        		$total_hora_segundo_periodo='--';
        		$total_minuto_segundo_periodo='--';
        	}
        }        
         /** fim calcular segundo perido***/




        if($total_hora_primeiro_periodo!='--' && $total_hora_segundo_periodo!='--'){
        	$total_hora_dia= $total_hora_primeiro_periodo + $total_hora_segundo_periodo;
    		$total_minuto_dia=$total_minuto_primeiro_periodo + $total_minuto_segundo_periodo;

			if($total_minuto_dia>=60){
    			$total_hora_dia=$total_hora_dia+1;
    			$total_minuto_dia=$total_minuto_dia-60;
    		}
    		
        }else if($total_hora_primeiro_periodo!='--' && $total_hora_segundo_periodo=='--'){

        	$total_hora_dia=$total_hora_primeiro_periodo;
        	$total_minuto_dia=$total_minuto_primeiro_periodo;

        }else if($total_hora_primeiro_periodo=='--' && $total_hora_segundo_periodo!='--'){

        	$total_hora_dia=$total_hora_segundo_periodo;
        	$total_minuto_dia=$total_minuto_segundo_periodo;
        }else{
        	$total_hora_dia='--';
		    $total_minuto_dia='--';
        }

     	 return $total_hora_dia.':'.$total_minuto_dia;
     	 	
			$entrada_trabalho 	=	'--:--:--';
			$saida_almoco 		=	'--:--:--';
			$entrada_almoco 	=	'--:--:--';
			$sair_trabalho 		=	'--:--:--';
			

			$total_hora_primeiro_periodo='--:--';
		    $total_minuto_primeiro_periodo='--:--';
		    $total_hora_segundo_periodo='--:--';
		    $total_minuto_segundo_periodo='--:--';

		    $total_hora_dia='--:--';
		    $total_minuto_dia='--:--';
	}


	function calcular_hora_diaria($id,$month_current,$year_current){
		$db=connection();
		$total_dia_mes=compareMonthCurrent_for_MonthSearch($month_current,$year_current); // function_RH.php fornece funcao compareMonthCurrent_for_MonthSearch()
				
		$arrayFuncionarios=[];
		$nome_funcionario 	=	'--:--:--';
		$id_funcionario 	=	'--:--:--';
		$entrada_trabalho 	=	'--:--:--';
		$saida_almoco 		=	'--:--:--';
		$entrada_almoco 	=	'--:--:--';
		$sair_trabalho 		=	'--:--:--';
		$data_registo 		=	'--:--:--';
		$data_evento 		=	'--:--:--';
		$diasemana 			=	'--:--:--';

		$total_hora_primeiro_periodo='--:--';
	    $total_minuto_primeiro_periodo='--:--';
	    $total_hora_segundo_periodo='--:--';
	    $total_minuto_segundo_periodo='--:--';

	    $total_hora_dia='--:--';
	    $total_minuto_dia='--:--';
		

		for($i=1;$i<=$total_dia_mes;$i++){
			
			if($i<=9){
				$i='0'.$i;
			}

			$data=$year_current.'-'.$month_current.'-'.$i;
			$select_all=$db->query("SELECT * FROM piquagem_ponto where data_evento='$data' and codigo_funcionario= (SELECT codigo_funcionario from funcionarios where id_funcionario='$id');");
			
			
			$dia=diasemana($data);// funcao dia semana vem da pagina function.RH.php;
			$diasemana=$dia;

			while($dados_um_funcionario = mysqli_fetch_assoc($select_all)){

				$arrayData=[];	
				$id_funcionario=$dados_um_funcionario['codigo_funcionario'];
				$nome_funcionario=$dados_um_funcionario['nome_funcionario'];
				$data_evento=$dados_um_funcionario["data_evento"];
				

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

				$total_hora_dia=calculateHoursDay($entrada_trabalho,$saida_almoco,$entrada_almoco,$sair_trabalho);//function_RH.php fornece funcao calculateHoursDay
			}


			$arrayData["nome_funcionario"]=$nome_funcionario;
			$arrayData["id_funcionario"]=$id_funcionario;
			$arrayData["data_evento"]=$data_evento;
			$arrayData["entrada_trabalho"]=$entrada_trabalho;
			$arrayData["saida_almoco"]=$saida_almoco;
			$arrayData["entrada_almoco"]=$entrada_almoco;
			$arrayData["sair_trabalho"]=$sair_trabalho;
			$abreviatura_diasemana=(strlen($diasemana) >3 )? substr($diasemana,0,3).'...' : $diasemana;
			$arrayData["diasemana"]=$i.' '.$abreviatura_diasemana;
			$arrayData["total_hora_dia"]=$total_hora_dia;

			$arrayFuncionarios[]=$arrayData;

			$nome_funcionario 	=	'--:--:--';
			$$id_funcionario 	=	'--:--:--';
			$entrada_trabalho 	=	'--:--:--';
			$saida_almoco 		=	'--:--:--';
			$entrada_almoco 	=	'--:--:--';
			$sair_trabalho 		=	'--:--:--';
			$data_registo 		=	'--:--:--';
			$data_evento 		=	'--:--:--';
			$diasemana 			=	'--:--:--';

			$total_hora_primeiro_periodo='--:--';
		    $total_minuto_primeiro_periodo='--:--';
		    $total_hora_segundo_periodo='--:--';
		    $total_minuto_segundo_periodo='--:--';

		    $total_hora_dia='--:--';
		    $total_minuto_dia='--:--';
						
		}
		$total_hora_mes=total_hora_mes($arrayFuncionarios,$month_current,$year_current,$id);
		$arrayFuncionarios["total_hora_mes"]=$total_hora_mes;

		$total_hora_preencer=hora_preencher($month_current,$year_current,$id);
		$arrayFuncionarios["total_dia"]=$total_hora_preencer;
		
		return $arrayFuncionarios;
	}
	

	function transportar_dados_morpho(){

		//$verificar_se_existe_studyPhp=@glob('C:\Users\SILVA SANTOS\morpho\anas.csv',GLOB_BRACE);
		//$verificar_se_existe_studyPhp=@glob('C:\Users\Administrator\morpho\transactions.csv',GLOB_BRACE);
				
		$data_evento='';
		$delimitador = ',';
		$cerca = '"';
		$dataLinha='';

		$connection = connection();
		

		
		
		// Abrir arquivo para leitura
		//$f = fopen('C:\morpho_server\transactions.csv', 'r');//path servidor Primavera de Anas
		$f=fopen('C:\Users\SILVA SANTOS\morpho\transactions.csv','r');//path computador Gilson

		if ($f) {
			// Ler cabecalho do arquivo
		    $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
		    // Enquanto nao terminar o arquivo
		
		    while (!feof($f)) {
		 
		        $linha = fgetcsv($f, 0, $delimitador, $cerca);
		      	
		        $dados_evento=strval($linha[0]);
		        		
		        if($dados_evento!=''){

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
		        }
		 
		        // Montar registro com valores indexados pelo cabecalho
		       // $registro = array_combine($cabecalho, $linha);
		 
		        // Obtendo o nome
		       // echo $registro['nome'].PHP_EOL;
		    }
		    fclose($f);
		}
	}

?>	