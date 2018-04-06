var funcoes = angular.module("funcoesServices",[]);

	funcoes.factory("funcoesApp",function () {
		
		var getContatos = function(c,d,operadora){

			if(operadora=='+'){
				return c+d;
				
			}else{
				return c*d;
			}
			
		}

		return{

			CgetContatos:getContatos

			};
	});