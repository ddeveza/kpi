		$('.em').attr('disabled',true);
		$('#emcycletimechart').hide();
		var click='';
		var selectedyear='';
		var emchart;
	$(document).ready(function(){
		


		





		$('#yearemcycletime').change(function(){
			
			$('#emcycletimechart').hide();
			$('.em').attr('disabled',false);
			selectedyear = $(this).children("option:selected").val();

		
		});



			$('.em').on('click',function(event){
				event.preventDefault();
				click = $(this).attr('id');
				$('#emcycletimechart').show();
					$.ajax({
	 				url:'php/emcycletime.php',
	 				type:'post',
	 				data:{
	 					selectedyear:selectedyear,
	 					click:click
	 				},
	 				success:function(data){
	 					$('#emcycletimechart').show();
	 					var data = JSON.parse(data);
	 					var ProjectName1 = [];
	 					var EQUAL1 = [];
	 					var MQUAL1 = [];
	 					console.log(data);
	 					$.each(data,function(k,v){
	 						ProjectName1.push(v.ProjectName);
	 						EQUAL1.push(v.EQUAL);
	 						MQUAL1.push(v.MQUAL);

	 					});
	 							 if (emchart) {
									emchart.destroy();
								}
	 							var ctx = $('#emcycletimechart').attr('id');
	 													  
											 emchart = new Chart(ctx, {
																  type: 'bar',
																  data: {
																    labels: ProjectName1,
																    datasets: [
																   
																      {
																        label: 'MQUAL',
																        data: MQUAL1,
																        backgroundColor: 'rgba(216, 27, 96, 0.6)',
																      },
																      {
																        label: 'EQUAL',
																        data: EQUAL1,
																        backgroundColor: 'rgba(3, 169, 244, 0.6)',
																      }
																    ]
																  },
																  options: {
																  	tooltips:{

																  	},
																    plugins:{
																                  
																                    labels: {
																                    
																                     
																                  	  position: 'border',
																                  	  fontColor:'#203E42',
											       									   
																					  fontSize: 12,
																					   render:function(args){
																					   		if (args.value != 0) {
																					  		 	return args.value;
																					  		}
																					   }
																                    }
																                    
																                    
																                  
																                },
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
																          },
																          {
																            drawTime: "afterDatasetsDraw",
																            id: "xline",
																            type: "line",
																            mode: "horizontal",
																            scaleID: "y-axis-0",
																            value: -50,
																            borderColor: "red",
																            borderWidth: 4,
																             borderDash: [10,10],
																            label: {
																              backgroundColor: "red",
																              content: "EQUAL Target",
																              enabled: true

																            }
																          }
																        ]},
																   scales: {
																      xAxes: [{
																        stacked: true
																        
																      }],
																      yAxes: [{
																        stacked: true,
																        ticks: {
																          beginAtZero: true,
																          min: -300,
																          max: 100,
																          stepSize: 10
																        },
																        type: 'linear',
																      }]
																    }
																  }
																});



	 					
	 				}
	 			});





			});

	});