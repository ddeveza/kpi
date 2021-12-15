$('.kpi').attr('disabled',true);

var selectedyearkpi = '';
var clickkpi ='';

$(document).ready(function(){
	

	$('#ProjectTable').hide();

	$('select#yearproj').change(function(e){

		$('.kpi').attr('disabled',false);
		selectedyearkpi = $(this).children("option:selected").val();
		$('#ProjectTable').hide();
		
	});

		$('.kpi').on('click',function(event){
				
				clickkpi = $(this).attr('id');
				
				$.ajax({
			 				url:'php/kpiprojectlist.php',
			 				type:'post',
			 				data:{
			 					selectedyearkpi:selectedyearkpi,
			 					clickkpi:clickkpi
			 				},
			 				success:function(data){

			 					
			 					$('#ProjectTable').show();
								$('#ProjectTable').html(data,function(){


							});
			 					

			 				}
			 	});

	});

});