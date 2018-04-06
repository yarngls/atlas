var app  = angular.module('app',['ngRoute','urlService','funcoesServices','fullCalendar']);
	

app.config(['$routeProvider',function($routeProvider){

	$routeProvider.	
	when('/',{controller:'funcionarioController',templateUrl:"partials/home.html"}).
	when('/edit/:id',{controller:'funcionarioController',templateUrl:"partials/funcionario/funcionario.html"}).
	when('/folhapresenca/:id',{controller:'folhaPresencaController',templateUrl:"partials/funcionario/folha_presenca.html"}).
	when('/primavera',{controller:'primaveraController',templateUrl:"partials/primavera/primavera.html"}).
	when('/table',{controller:'horario_funcionarioController',templateUrl:"partials/horario/horario_funcionarios.html"}).
	otherwise({redirectTo:'/'});
	
}]);






