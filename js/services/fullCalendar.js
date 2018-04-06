var calendar = angular.module("fullCalendar",[]);

	calendar.factory("calendario",function(){


		var _indexes=function IndeceMonth(ind){
			var array_month =[ 
					{"ind":'01',"mes":"Janeiro"},
					{"ind":'02',"mes":"Fevereiro"},
					{"ind":'03',"mes":"Março"},
					{"ind":'04',"mes":"Abril"},
					{"ind":'05',"mes":"Maio"},
					{"ind":'06',"mes":"Junho"},
					{"ind":'07',"mes":"Julho"},
					{"ind":'08',"mes":"Agosto"},
					{"ind":'09',"mes":"Setembro"},
					{"ind":'10',"mes":"Outubro"},
					{"ind":'11',"mes":"Novembro"},
					{"ind":'12',"mes":"Dezembro"},
			];

			for (i=0;i<array_month.length;i++){
				if(array_month[i].ind==ind){

					return array_month[i].mes;
				}
				
			}
			return array_month;
		} 

		var _dias=function totalDias(){
			var array_day=[];

			for (i=1;i<=31;i++){
				var iConvert=i.toString();
				if(iConvert.length==1){
					iConvert='0'+iConvert;
				}
				var dia={"dia":iConvert};
				array_day.push(dia);
			}
			return array_day;
		} 	


		var dateToday = new Date();

		return {

			date 	: dateToday,
			indexes : _indexes,
			dias 	: _dias
		}
	});