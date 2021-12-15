
var myChartBackLog;


$(document).ready(function(){
	
	//alert('dennis');
	
	
						
				

//alert('dennis');

$('#yearMqualBack').change(function(){

	 var selectedyear = $(this).children("option:selected").val();
	 
	 if (selectedyear != 'NoYearSelected'){
	 			
	 			$.ajax({
	 				url:'php/mqualback.php',
	 				type:'post',
	 				data:{
	 					selectedyear:selectedyear
	 				},
	 				success:function(data2){
	 					//console.log(data2);
	 					var data = JSON.parse(data2);
	 					console.log(data);
						
	 					var label1 = [];
	 					var value1 = [];
	 					var valueout1 = [];
	 					var backlog1 = []

	 					//label1[0] = data[0].label[0];
						
						var labels = data[0];
						var values = data[1];
						var valuesout = data[2];
						var backlogs = data[3];
						//console.log(data);
						for (var k in labels.label){
							label1.push(labels.label[k]);
						}

						for (var k in values.valuein){
							value1.push(values.valuein[k]);
						}

						for (var k in valuesout.valueout){
							valueout1.push(valuesout.valueout[k]);
						}

						
						for (var k in backlogs.backlog){
							backlog1.push(backlogs.backlog[k]);
						}
						//console.log(backlog1);

						  if (myChartBackLog) {
							myChartBackLog.destroy();
							}
						
						var ctx = $('#DMSGBacklogChart').attr('id');
						
						
						
						myChartBackLog = new Chart(ctx, {
						    type: 'bar',
						    data: {
								
						        labels: label1,
						         datasets: [

						     
						         {
						            label: 'QualIN' ,
						            backgroundColor: 'rgba(255, 152, 0, 1)',
						            borderColor:'rgba(255, 152, 0, 0.6)',
						            data:value1,
						           
						            
						           
						        },
						           

						        	{
						            label: 'QualOUT' ,
						            data:valueout1,
						             backgroundColor: 'rgba(58, 174, 89, 0.6)',
						             borderColor: 'rgba(58, 174, 89, 0.6)'

						            
						           
						        },

						        {
						            label: 'backlog',
						            data: backlog1,
						             backgroundColor: 'rgba(216, 27, 96, 0.1)',
						            borderColor: 'rgba(216, 27, 96, 1)',
						            type: 'line'

								}
								
						       ]


						    },

						    options: {
								responsive : true,
						    	plugins:{
									
									  labels: {
									    render: 'value',
										showZero : false,
										position: 'border',
										 fontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
										 textShadow: true,
										 fontStyle: 'bold',
										shadowBlur: 10,
										fontColor: function (args) {
											
											//console.log(args.dataset.label);
											
												if (args.dataset.label== 'QualIN') {
													return 'rgba(255, 152, 0, 10)';
												}else if (args.dataset.label == 'QualOUT'){
													return 'rgba(58, 174, 89, 10)';
												}else {
													return 'rgba(150, 40, 27, 1)';
												
												
											}
												
												
											
											
											//if 
											return 'blue';
										}
									}
								},
						    	 scales: {
								   yAxes: [{
								       ticks: {
								           min: 0,
								           max: 10
								          
								       },
								       scaleLabel: {
								           display: true,
								           
								       }
								   }],
								   xAxes:[{
								   	
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