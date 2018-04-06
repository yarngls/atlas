app.controller('homeController',function($scope,$location,$routeParams,$http,ModelUrl,funcoesApp,calendario){
	$scope.ola="12345";
	/*console.log("estamos no home.hmtl que por sua vez carega o homeController.js");
	
	$scope.nav='nav';
	var url=ModelUrl.gethomeUrl;
	var urlHorario=ModelUrl.gethorarioUrl;*/


	/*$scope.getAllfuncionario=function(){
		$http.get(url).success(function(data){
			$scope.funcionarios=data;
		}).error(function(response){
			console.log(response);
		});	
	}

	$scope.getAllfuncionario();*/

	
	
	/*$scope.create=function(){
		$http({
			method:"POST",
			url:url,
			data:$scope.funcionario,
		}).then(function(response){
			console.log(response.data);	
			$scope.getAllfuncionario();
			$("#myModalRegistarFuncionario").modal("hide");		
		});
	}*/

		
	/*$scope.get_funcionario=function(id){
		$scope.id_funcionario=id;
		$http.get('backend/home/home.php?id='+id).success(function(data){
			$scope.getFuncionario=data;
			$scope.getFuncionario;
		}).error(function(data,status){
			console.log(status);
		});
		$location.path('/list/funcionario');
	}*/



	/*$scope.gethorario = function(){
		$http.get(urlHorario).success(function(data,status,headers,config){
			$scope.horarios=data;
			console.log($scope.horarios);
		}).error(function(data,status,headers,config){
			switch(status){
				case '404':
					console.log('pag not a found');
				break;
				default:
					console.log(status);
				break;
			}
		});
	}

	$scope.gethorario();*/
	
});