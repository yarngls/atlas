app.controller("funcionarioController",function($scope,$location,$routeParams,$http,ModelUrl){
	$scope.test = "testando";
	console.log("ok");
	
	var mymap = L.map('mapid').setView([16.00, -24.00],10);
       
        
        var basemap = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 28,
            subdomains:['mt0','mt1','mt2','mt3']
        });
        basemap.addTo(mymap);
         console.log("ok");
        $.ajax({
            "type":"GET",
            "url":"server.php"
        }).success(function(response){
           for(i=0;i<response.length;i++){
                var marker = L.marker([14.917522, -23.524902],13).addTo(mymap);
                         
                var lat=response[i]["lat"];
                var longit=response[i]["longit"];
                var designacao=response[i]["designacao"];
                var obs=response[i]["obs"];
                var codigo=response[i]["codigo"];
                var marker = L.marker([lat,longit],13).addTo(mymap);
                L.marker([lat,longit]).addTo(mymap)
                
                .bindPopup(
                            'codigo -> ' + codigo +'<br>'+
                            'designacao -> ' + designacao +'<br>'+
                            'obs -> ' + obs +'<br>'+
                            'lat -> ' + lat +'<br>'+
                            'longit -> ' + longit +'<br>'
                        )
                .openPopup();
            }
        });

        var littleton = L.marker([15.0465,-23.6033]).bindPopup('This is Littleton, CO.'),
        denver    =     L.marker([15.1256,-23.5652]).bindPopup('This is Denver, CO.'),
        aurora    =     L.marker([15.0565,-23.574]).bindPopup('This is Aurora, CO.'),
        golden    =     L.marker([15.0578,-23.5737]).bindPopup('This is Golden, CO.');
        var cities = L.layerGroup([littleton, denver, aurora, golden]);
});

	/*console.log("atenção: estamos em partial/home.html aque carega funcionarioController.js./ ao clicarmos no foto perfil do funcionario automaticamente carega partials/funcionario/perfil.html tambem com o controller funcionarioController.js.");
	$scope.id_funcionario=$routeParams.id;

	url=ModelUrl.getfuncionarioUrl;
	urlHorario=ModelUrl.gethorarioUrl;

	/************* 
		executa assim que o foi carega funcionario.html
	*********/
	/*$scope.getFuncionario = function(){
		$http.get(url+'?id='+$routeParams.id).success(function(data,status,headers,config){
			$scope.funcionario=data;		
			$scope.estado='perfil';
			//console.log(data);
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

	$scope.getFuncionario();

	$scope.folhaPresenca = function(){
		$scope.estado='folhaPresenca';		
	}

	

	$scope.perfil=function(){
		$scope.estado='perfil';
	
	}

	$scope.horario=function(){
		$scope.estado='horario';
	}


	$scope.update=function(){
		$http({
			method:"PUT",
			url:url,
			data:$scope.funcionario,
		}).then(function(response){
			console.log(response.data);	
		});
	}



	$scope.gethorario = function(){
		$http.get(urlHorario).success(function(data,status,headers,config){
			$scope.horarios=data;
			//console.log($scope.horarios);
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

	$scope.gethorario();

	$scope.getAllfuncionario=function(){
		$http.get(url).success(function(data){
			$scope.funcionarios=data;
		}).error(function(response){
			console.log(response);
		});	
	}

	$scope.getAllfuncionario();

	$scope.create=function(){

		$http({
			method:"POST",
			url:url,
			data:$scope.funcionario,
		}).then(function(response){
			//console.log(response.data);	
			$scope.getAllfuncionario();
			$("#form_funcionario").trigger("reset");
			$("#myModalRegistarFuncionario").modal("hide");		
		});

	}

	$scope.cleanForm=function(){	
		$("#form_funcionario").trigger("reset");
	}*/