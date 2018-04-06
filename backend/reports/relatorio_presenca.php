<?php
	/* Carrega a classe DOMPdf */
	require ("dompdf/dompdf_config.inc.php");
	require ("../function_RH.php");
	/* Cria a instância */
	$dompdf = new DOMPDF();

	/* Carrega seu HTML */

	$id = $_GET["id"];
	$year_current = $_GET["year_current"];
	$month_current = $_GET["month_current"];

	$db=connection();
	$pesquisa=$db->query("SELECT nome_funcionario,id_funcionario from funcionarios where id_funcionario='$id';");
	$nome_funcionario=mysqli_fetch_assoc($pesquisa);

	$mes=convertIndeceforMonth($month_current);

	$arrayFuncionarios=calcular_hora_diaria($id,$month_current,$year_current);
	$n=count($arrayFuncionarios)-2;// menos 2 (-2) porque o tamanho de array são total de dias + total acumulada das horas dias (total_dia) + total de hora mes deve ser preenchida(total_hora_mes);
									//se não por exemplo um mes tem 31 dias e o tamanho de array derá 33. então ao ppercorrer o arrat qundo chegamos o 32 vai da erro porque não existe registo de presença para dias 32 ou 33 que contem dados de total acumulada das horas dias (total_dia) e total de hora mes deve ser preenchida(total_hora_mes) respectivamente.
	$table='Relatório de Picagem de Ponto';
	$table.='<br>';
	$table.='Referente ao Mês:	<strong>'.$mes.' '.$year_current.'</strong>';
	$table.='<br>';
	$table.='Nome Funcionário:	<strong>'.$nome_funcionario['nome_funcionario'].'</strong>';
	$table.= '<table>
			<thead>
				<tr>
					<td>
						Data Registo
					</td>
					<td>
						Entrada Trabalho
					</td>
					<td>
						Saida Almoço
					</td>
					<td>
						Entrada Almoço
					</td>
					<td>
						Saida Trabalho
					</td>
					<td>
						Total Hora/Dia
					</td>
				</tr>
			</thead>';
			for($i=0;$i<$n;$i++){
				$arrayFuncionarios[$i]['diasemana'].
				$table.='<tbody>
					<tr>
					<td>'.
						$arrayFuncionarios[$i]['diasemana'].
					'</td>
					<td>'.
						$arrayFuncionarios[$i]['entrada_trabalho'].
					'</td>
					<td>'.
						$arrayFuncionarios[$i]['saida_almoco'].
					'</td>
					<td>'.
						$arrayFuncionarios[$i]['entrada_almoco'].
					'</td>
					<td>'.
						$arrayFuncionarios[$i]['sair_trabalho'].
					'</td>
					<td>'.
						$arrayFuncionarios[$i]['total_hora_dia'].
					'</td>
				</tr>
				</tbody>';
			}
			$table.= 
				'<br>
				<br>
				<br>
	    		<strong>Hora Prenchida: '. $arrayFuncionarios['total_hora_mes'].' Horas</strong>
	    		<br>
				<strong>Hora por Preencher: '. $arrayFuncionarios['total_dia'].' Horas</strong>';
 			
	$dompdf->load_html($table);

	/* Renderiza */
	$dompdf->render();

	/* Exibe */
	$dompdf->stream(
	    "saida.pdf", /* Nome do arquivo de saída */
	    array(
	        "Attachment" => false /* Para download, altere para true */
	    )
	);
?>


