
var MyDigMixChart;

$(document).ready(function(){



	$('#yearMSVSDIGHit').change(function(){

			var selectedyear = $(this).children("option:selected").val();

			$.ajax({
	 				url:'php/cyclemixdig.php',
	 				type:'post',
	 				data:{
	 					selectedyear:selectedyear
	 				},
	 				success:function(data){

	 					var data = JSON.parse(data);
	 					//console.log(data);

	 					var MixSigResult = [];
	 					var MixSTotal = [];
	 					var MixHit = [];

	 					var DigResult = [];
	 					var DigTotal = [];
	 					var DigHit = [];

	 					$.each(data,function(k,v){
	 						
	 						MixSigResult.push(v.QMixResult);
	 						MixSTotal.push(v.QTMix);
	 						MixHit.push(v.QHMix);
	 						DigResult.push(v.QDigResult);
	 						DigTotal.push(v.QTDig);
	 						DigHit.push(v.QHDig);

	 					});

	 					//console.log(MixSigResult);
	 					//console.log(DigResult);

	 					 if (MyDigMixChart) MyDigMixChart.destroy();
						
	 					 var ctx = $('#MSVSDIGHitRateCHart').attr('id');
						
						
						
						MyDigMixChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4'],
						         datasets: [
						         	{
						         		label: 'DIG',
								        data: DigResult,
								        backgroundColor: 'rgba(3, 169, 244, 0.6)',
						         	},
						         	{
						         		label:'MS',
						         		data:MixSigResult,
						         		 backgroundColor: 'rgba(216, 27, 96, 0.6)'

						         	}
						         	
						         ]

						    },
						    options: {
								
						    	plugins:{
									
									  labels: {
										  
        								fontColor:'#203E42',
       									textMargin: -50,
										fontSize: 12,
									    render: function (args) {
										  
										  //console.log(args.dataset.label);
										  if (args.value !=0){
											  if (args.dataset.label=='DIG' ){
											  		return  args.label+' Digital Hit Rate: '+Math.round(args.value * 100) /100 + '%' +
											  				'\n\n Total MS Projects: '+ DigTotal[args.index] +
											  				'\n\n ToTal MS <= 30days: '+DigHit[args.index];
											  				
											  }else {
											  		return args.label+' MS Hit Rate: '+Math.round(args.value * 100) /100 + '%'+
											  				'\n\n Total MS Projects: '+ MixSTotal[args.index] +
											  				'\n\n ToTal MS <= 30days: '+MixHit[args.index];
											  }
											}
										  //console.log(i);
										  
									      //return  Math.round(args.value * 100) /100 + '%';
											
									    },
									    arc: false,
										fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
										 fontStyle: 'bold',
										  textShadow: true,
										  position: 'border'

									  },
										
										
									
								},
						    	 scales: {
						    	 	xAxes: [{
						    	 		barThickness: 170,
							            //barPercentage: 1
							        }],
								   yAxes: [{
								       ticks: {
								           min: 0,
								           max: 100,
								           callback: function(value) {
								               return value + "%"
								           }
								       },
								       scaleLabel: {
								           display: true,
								           labelString: "Percentage"
								       }
								   }]
								}
						    }
						   
						}); //end of chart

	 				}//end of success data
	 			}); //end of ajax


	});

	/*var ctx = $('#MSVSDIGHitRateCHart').attr('id');
						
						
						
						var myChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4'],
						         datasets: [
						         	{
						         		label: 'DIG',
								        data: [20,20,10,30],
								        backgroundColor: 'rgba(3, 169, 244, 0.6)',
						         	},
						         	{
						         		label:'MS',
						         		data:[10,20,30,40],
						         		 backgroundColor: 'rgba(216, 27, 96, 0.6)'

						         	}
						         	
						         ]

						    },
						    options: {
								
						    	plugins:{
									
									  labels: {
										  
        								fontColor:'#203E42',
       									textMargin: -40,
										fontSize: 12,
									    render: function (args) {
										  
										  //console.log(args.index);
										  
									      //return  Math.round(args.value * 100) /100 + '%';
											return args.value + '%' ;
									    },
									    arc: false,
										fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
										 fontStyle: 'bold',
										  textShadow: true,
										  position: 'border'

									  },
										
										
									
								},
						    	 scales: {
								   yAxes: [{
								       ticks: {
								           min: 0,
								           max: 100,
								           callback: function(value) {
								               return value + "%"
								           }
								       },
								       scaleLabel: {
								           display: true,
								           labelString: "Percentage"
								       }
								   }]
								}
						    }
						   
						});
	
*/


});