
var myChart;


$(document).ready(function(){
	
	//alert('dennis');

	var ctx = $('#MQUALHitRateCHart').attr('id');
						
						
						
						var myChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4']
									,
						         datasets: [{
						            label: 'MQUAL HIT RATE ' ,
						            data:[],
						            backgroundColor: [
						                'rgba(216, 27, 96, 0.6)',
						                'rgba(3, 169, 244, 0.6)',
						                'rgba(255, 152, 0, 0.6)',
						                'rgba(29, 233, 182, 0.6)'
						              
						            ],
						            borderColor: [
						                'rgba(216, 27, 96, 1)',
						                'rgba(3, 169, 244, 1)',
						                'rgba(255, 152, 0, 1)',
						                'rgba(29, 233, 182, 1)'
						           
						            ]
						           
						        }]

						    },
						    options: {
								
						    	
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
	

//alert('dennis');

$('#yeaMqualHit').change(function(){

	 var selectedyear = $(this).children("option:selected").val();
	 
	 if (selectedyear != 'NoYearSelected'){
	 			
	 			$.ajax({
	 				url:'php/mqualhit.php',
	 				type:'post',
	 				data:{
	 					selectedyear:selectedyear
	 				},
	 				success:function(data2){
	 					//var data = data2[0];
	 					var len = JSON.parse(data2)	 ;					
	 					
	 					//console.log(len);
	 					
	 					var QHit = [];
						var QTotal = [];
						var QCompleted30 =[];
						
						
						for ( var j in len ){
							
							QHit.push(len[j].M);
							QTotal.push('Total Projects: ' + len[j].QT);
							QCompleted30.push('Completed projects less than 30 days: '+ len[j].QH);
						}
	 					//console.log(QTotal);
						
						
			
						
						  if (myChart) {
							myChart.destroy();
						}
						
						
	 					var ctx = $('#MQUALHitRateCHart').attr('id');
						
						
						
						 myChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4']
									,
						         datasets: [{
						            label: 'MQUAL HIT RATE of '+ selectedyear ,
						            data:QHit,
						            backgroundColor: [
						                'rgba(216, 27, 96, 0.6)',
						                'rgba(3, 169, 244, 0.6)',
						                'rgba(255, 152, 0, 0.6)',
						                'rgba(29, 233, 182, 0.6)'
						              
						            ],
						            borderColor: [
						                'rgba(216, 27, 96, 1)',
						                'rgba(3, 169, 244, 1)',
						                'rgba(255, 152, 0, 1)',
						                'rgba(29, 233, 182, 1)'
						           
						            ]
						           
						        }]

						    
						      
							  },
						    options: {
								responsive : true,
								offset : true,
								plugins:{
									
									  labels: {
										  
        								fontColor:'#203E42',
       									textMargin: -60,
										fontSize: 12,
									    render: function (args) {
										  
										  //console.log(QTotal[args.index]);
										  
									      //return  Math.round(args.value * 100) /100 + '%';
											if (args.value != 0) {
												return 'MQUAL Cyle Time Hit Rate: '+(Math.round(QHit[args.index]*100)/100)+'%\n\n'+ QTotal[args.index] + '\n\n'+ QCompleted30[args.index] ;}
											
									    },
									    arc: false,
										fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
										 fontStyle: 'bold',
										  textShadow: true,
										  position: 'border'

									  },
										
										
									
								},
								 showAllTooltips: true,
						    	 tooltips: {
									
									enabled: true,
									
						            callbacks: {
										
										afterBody: function(tooltipItem, data){
											var mystring = [ QTotal[tooltipItem[0].index]];
											
											mystring.push(QCompleted30[tooltipItem[0].index]);
											
											return   mystring ;
										},
						                label: function(tooltipItem, data) {
						                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

						                    if (label) {
						                        label += ': ';
						                    }
						                    label += (Math.round(tooltipItem.yLabel * 100) / 100)  ;
						                    return label+' %';
						                }
						            }
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
						
						
						
	 				},
	 				error:function(data){
	 					//console.log(data);
	 					//alert('dennis');
	 				}

	 			});





	 			
	 }

});

});