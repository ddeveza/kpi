
var MyDigMixAveChart;

/*var ctx = $('#DMSGavemsvsdigChart').attr('id');
						
						
						
						MyDigMixAveChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4'],
						         datasets: [
						         	{
						         		label: 'DIG',
								        data: [1,2,3,4],
								        backgroundColor: 'rgba(3, 169, 244, 0.6)',
						         	},
						         	{
						         		label:'MS',
						         		data:[5,6,7,8],
						         		 backgroundColor: 'rgba(216, 27, 96, 0.6)'

						         	}
						         	
						         ]

						    },
						    options: {
									    annotation:{
									    annotations: [
									          {
									            drawTime: "afterDatasetsDraw",
									            id: "hline",
									            type: "line",
									            mode: "horizontal",
									            scaleID: "y-axis-0",
									            value: 30,
									            borderColor: "yellow",
									            borderWidth: 4,
									            borderDash: [10,10],
									            label: {
									              backgroundColor: "red",
									              content: "MQUAL Target",
									              enabled: true
									            }
									          }
									  
									        ]},
						    	plugins:{
									
									  labels: {
										  
        								fontColor:'#203E42',
       									textMargin: -40,
										fontSize: 12,
									    render: function (args) {
										  
										 	return args.value
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
									scales: {
									      
									      yAxes: [{
									        
									        ticks: {
									          beginAtZero: true,
									          min: 0,
									          max: 50,
									          stepSize: 2
									        },
									        type: 'linear',
									      }]
									    }
										
									
								}
						    });
						   */
					










$(document).ready(function(){

	$('#yearavemsvsdig').change(function(){

		var selectedyear = $(this).children("option:selected").val();

		$.ajax({
	 				url:'php/averagemixdig.php',
	 				type:'post',
	 				data:{
	 					selectedyear:selectedyear
	 				},
	 				success:function(data){

	 					var data = JSON.parse(data);

	 					
	 					var MixTotalCycleTime= [];
	 					var MixCountProjects = [];
	 					var MixAverage = [];
	 					var DigTotalCycleTime= [];
	 					var DigCountProjects = [];
	 					var DigAverage = [];

	 					$.each(data,function(k,v){
	 						
	 						 MixTotalCycleTime.push(v.QTotalMix);
		 					 MixCountProjects.push(v.QCountMix);
		 					 MixAverage.push(v.QAveMix);
		 					 DigTotalCycleTime.push(v.QTotalDIG);
		 					 DigCountProjects .push(v.QCountDIG);
		 					 DigAverage.push(v.QAveDIG);

		 					  if (MyDigMixAveChart) MyDigMixAveChart.destroy();

		 					 var ctx = $('#DMSGavemsvsdigChart').attr('id');
						
						
						
						MyDigMixAveChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: 
									['Q1', 'Q2', 'Q3', 'Q4'],
						         datasets: [
						         	{
						         		label: 'DIG',
								        data: DigAverage,
								        backgroundColor: 'rgba(3, 169, 244, 0.6)',
						         	},
						         	{
						         		label:'MS',
						         		data:MixAverage,
						         		 backgroundColor: 'rgba(216, 27, 96, 0.6)'

						         	}
						         	
						         ]

						    },
						    options: {
									    annotation:{
									    annotations: [
									          {
									            drawTime: "afterDatasetsDraw",
									            id: "hline",
									            type: "line",
									            mode: "horizontal",
									            scaleID: "y-axis-0",
									            value: 30,
									            borderColor: "yellow",
									            borderWidth: 4,
									            borderDash: [10,10],
									            label: {
									              backgroundColor: "red",
									              content: "MQUAL Target",
									              enabled: true
									            }
									          }
									  
									        ]},
						    	plugins:{
									
									  labels: {
										  
        								fontColor:'#203E42',
       									textMargin: -40,
										fontSize: 12,
									    render: function (args) {
										  if (args.value !=0){
										 	if (args.dataset.label=='DIG'){
										 		return 'Average Dig Cycle Time: '+Math.round(args.value * 100) /100;
										 	}else{
										 		return 'Average MS Cycle Time: '+Math.round(args.value * 100) /100;
										 	}
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
									scales: {
									     xAxes: [{
						    	 				barThickness: 170,
							            		//barPercentage: 1
							       		 }],
									      yAxes: [{
									        
									        ticks: {
									          beginAtZero: true,
									          min: 0,
									          max: 50,
									          stepSize: 2
									        },
									        type: 'linear',
									      }]
									    }
										
									
								}
						    });

	 					});


					}
				});
	});


});