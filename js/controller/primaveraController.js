
app.controller("primaveraController",function($scope,$routeParams,$http,ModelUrl,calendario) {
	
	var url=ModelUrl.getprimaveraUrl;
	console.log("Estamos em partials/primavera/primavera.html por sua vez carega js/controller/primaveraController.js");
	console.log(url);

	$scope.pesquisar={"mes":"01","ano":"2016"};

	$scope.meses= calendario.indexes(null);

	$http.get(url).success(function(data,status){		
		$scope.pesquisar=data;// automaticamente $scope.pesquisar deixa de ser {"mes":"01","ano":"2016"} e passa a ser o mes e ano recebido do servidor
		console.log($scope.pesquisar);
	}).error(function(data,config,status,headers){
		console.log(data);
	});
	
	
	/* Este eh para servidor meu computador*/
	$scope.gerarFilePrimavera=function(){
		var dadosRelatorio=$scope.pesquisar;
		var year_current=dadosRelatorio.ano;
		var month_current=dadosRelatorio.mes;
		window.open("http://localhost/morphoRH/backend/Controller/primaveraController.php?"+
			"primavera=true&month_current="+month_current+"&year_current="+year_current);

	}

	/* Este eh para servidor ANAS*/
	/*$scope.gerarFilePrimavera=function(){
		var dadosRelatorio=$scope.pesquisar;
		var year_current=dadosRelatorio.ano;
		var month_current=dadosRelatorio.mes;
		window.open("http://localhost:9090/morphoRH/backend/Controller/primaveraController.php?"+
			"primavera=true&month_current="+month_current+"&year_current="+year_current);

	}*/



});