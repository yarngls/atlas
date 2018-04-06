app.controller('loginController',function($scope,$location,$routeParams,$http,calendario){
	$scope.login_error=undefined;
	$scope.dia_hoje = calendario.date;
	$scope.logon=function(user){
		
		$http({
			method:"PUT",
			data:user,
			url:'backend/login/login.php',
		}).then(function(response){
			var resp = response.data;		
			if(resp.total==1){
				$location.path('/home');

			}else{
				$location.path('/');
				$scope.login_error='login_error';	
				$scope.user.password='';			
			}
		});

	}

});