angular.module('urlService',[]).factory("ModelUrl",function() {

	

	_gethomeUrl				= 	'backend/Controller/homeController.php';
	_getfuncionarioUrl		= 	'backend/Controller/funcionarioController.php';
	_getfolha_presencaUrl	= 	'backend/Controller/folhaPresencaController.php';
	_gethorarioUrl			= 	'backend/Controller/horarioController.php';
	_getprimaveraUrl		= 	'backend/Controller/primaveraController.php';
	

	return {
		gethomeUrl 				: 	_gethomeUrl,
		getfuncionarioUrl 		: 	_getfuncionarioUrl,
		getfolha_presencaUrl 	: 	_getfolha_presencaUrl,
		gethorarioUrl 			: 	_gethorarioUrl,
		getprimaveraUrl 		: 	_getprimaveraUrl
	}

});

