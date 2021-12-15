var cabchart;

$(document).ready(function(){
	
	//alert('dennis');
				

	var ctx = $('#DMSGCabAppRateChart').attr('id');
						
						
						
						var cabchart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4']
									,
						         datasets: [{
						            label: ['CAB Approval Rate'] ,
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



	$('#yearCabAppRate').change(function(){
			 var selectedyear = $(this).children("option:selected").val();
			  if (selectedyear != 'NoYearSelected'){

				  		//alert(selectedyear);
				  	$.ajax({
			 				url:'php/cabapprate.php',
			 				type:'post',
			 				data:{
			 					selectedyear:selectedyear
			 				},
		 					success:function(data){

		 						var data = JSON.parse(data);
		 						//console.log(data);


		 						var CAB = [];
								var CABHit = [];
								var CABHitRate =[];

								for ( var j in data ){
							
									CABHitRate.push(data[j].CABHitRate);
									CAB.push('Total CAB : ' + data[j].CAB);
									CABHit.push('1st Time Cab Approved : '+ data[j].CABHit);
								}

								/*console.log(CAB);
								console.log(CABHitRate);
								console.log(CABHit);*/

								 if (cabchart) {
									cabchart.destroy();
								}

								var ctx = $('#DMSGCabAppRateChart').attr('id');
						
						
						
							 cabchart = new Chart(ctx, {
							    type: 'bar',
							    data: {
							        labels: 
										['Q1', 'Q2', 'Q3', 'Q4']
										,
							         datasets: [{
							            label: 'CAB Approval Rate '+ selectedyear ,
							            data:CABHitRate,
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
		       									textMargin: -40,
												fontSize: 12,
											    render: function (args) {
												  
												  //console.log(QTotal[args.index]);
												  
											      //return  Math.round(args.value * 100) /100 + '%';
													return 'CAB Approval Hit Rate: '+(Math.round(CABHitRate[args.index]*100)/100)+'%\n'+ CAB[args.index] + '\n'+ CABHit[args.index] ;
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
											var mystring = [ CAB[tooltipItem[0].index]];
											
											mystring.push(CABHit[tooltipItem[0].index]);
											
											return   mystring ;
										},
						                label: function(tooltipItem, data) {
						                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

						                    if (label) {
						                        label += ': ';
						                    }
						                    label += (Math.round(tooltipItem.yLabel * 100) / 100)  ;
						                    return label;
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
								


		 					}
	 				});
			  }
	});	


});