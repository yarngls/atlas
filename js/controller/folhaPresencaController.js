
app.controller("folhaPresencaController",function($scope,$routeParams,$http,ModelUrl,calendario) {
	
	
		$scope.test = "testando";
		console.log("ok")
	
});



/*//$("#div_impremir_reports").hide();

	$scope.pesquisar={"ano":"2000","dia":"00","mes":"00"};
	$scope.searchDia=false;
	console.log("Estamos em partials/funcionario/folha_presenca.html por sua vez carega js/folhaPresencaController.js");
	
	$scope.id_funcionario=$routeParams.id;
	var url = ModelUrl.getfolha_presencaUrl;
	id=$scope.id_funcionario;
	console.log(url);	
	/*faz pesquisa do mes e ano atual e atribui atravz do metodo GET em backend/Controller/folhaPresencaController.php e o $scope.pesquisar recebe essa informacao*/
	/*$http.get(url).success(function(data,status){		
		$scope.pesquisar=data;// automaticamente $scope.pesquisar deixa de ser {"mes":"05","ano":"2016"} e passa a ser o mes e ano recebido do servidor
		$scope.search();
	}).error(function(data,config,status,headers){
		

	$scope.meses= calendario.indexes(null);
	$scope.dias= calendario.dias();
	

	$scope.search=function(searchDia){
		var pesquisar_horario=$scope.pesquisar;
		var year_current=pesquisar_horario.ano;
		var month_current=pesquisar_horario.mes;
		if($scope.searchDia==false){
			
			if(year_current=='2000' && month_current=='00'){
				year_current=pesquisar_horario.ano;
				month_current=pesquisar_horario.mes;
			}

			$http({
				url:url,
				method:"GET",
				params:{id:$scope.id_funcionario,"month_current":month_current,"year_current":year_current,"print_report":"false"}
			}).then(function(data,status){
				
				$scope.funcionario_pesq=data.data;				
			});
		}else{
			var day_current=pesquisar_horario.dia;
			$http({
				url:url,
				method:"GET",
				params:{id:$scope.id_funcionario,"month_current":month_current,"year_current":year_current,"day_current":day_current,"print_report":"false"}
			}).then(function(data,status){				
			
				$scope.funcionario_pesq=data.data;
				console.log($scope.funcionario_pesq);
				
			});
		}
		
	}
	$scope.actualizar="";
	$scope.msg="false";
	$scope.refresh=function(){
		$scope.actualizar="actualizando";
		
		$http({
			url:url,
			method:"PUT",
			params:{"refresh":"refresh"}
		}).then(function(data){
			
			switch(data.status){
				case 200:
					var pesquisar_horario=$scope.pesquisar;
					var year_current=pesquisar_horario.ano;
					var month_current=pesquisar_horario.mes;				
						
					if(year_current=='2000' && month_current=='00'){
						year_current=pesquisar_horario.ano;
						month_current=pesquisar_horario.mes;
					}
					$http({
						url:url,
						method:"GET",
						params:{id:$scope.id_funcionario,"month_current":month_current,"year_current":year_current,"print_report":"false"}
					}).then(function(data,status){	
						$scope.funcionario_pesq=data.data;				
						$scope.actualizar="actualizado";					
						$scope.msg="!actualizado com sucesso";					
					});
				break;
				case 500:
					$scope.actualizar="error";
					$scope.msg="500 Internal Server Error";
				break;
				case 404:
					$scope.actualizar="error";
					$scope.msg="404 Not Found";
				break;
				case 403:
					$scope.actualizar="error";
					$scope.msg="403 Forbidden";
				break;
				case 401:
					$scope.actualizar="error";
					$scope.msg="401 Unauthorized";
				break;
				case 400:
					$scope.actualizar="error";
					$scope.msg="400 Bad Request";
				break;
				default:
					console.log("eroo");
				break;
			}		
		});
		
	}

	$scope.search($scope.searchDia);


	$scope.print_report=function(){
		
		var pesquisar_horario=$scope.pesquisar;
		var year_current=pesquisar_horario.ano;
		var month_current=pesquisar_horario.mes;
		
		if(year_current=='2000' && month_current=='00'){
			year_current=pesquisar_horario.ano;
			month_current=pesquisar_horario.mes;			
		}
	

		window.open('backend/reports/relatorio_presenca.php?'+"id="+$scope.id_funcionario+"&year_current="+year_current+"&month_current="+month_current);
		
		$http({
			method:"GET",
			url:'backend/reports/reports.php',
			//params:{"print_report":"print_report",id:$scope.id_funcionario,"month_current":month_current,"year_current":year_current}
		}).then(function(data){
			
			$("#div_impremir_reports").html(data.data);
			console.log(data.data);
		});*/
