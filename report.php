<?php 
session_start();
if( $_SESSION['TEName'] === 'Ian Soliven' ) $home = '/dmsg/Ianhome.php';
else $home = '/dmsg/home.php';


?>



<!DOCTYPE html>
<html>
<head>
	<title>KPI Reports</title>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
	 <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	 

	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  		
		<script src="https://kit.fontawesome.com/b4a90c5c05.js" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>

	  	<script type="text/javascript" src='plugin/chartjs-plugin-annotation.js'></script>
	  	<!---Datatable Header---->
	  	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  		<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
</head>
<style>
	.wrapper {
    text-align: center;
}

.button {
    position: absolute;
    top: 50%;
}

</style>
<body>
	<div >
					<ul class="nav nav-tabs">
					  <li class="nav-item">
					    <a class="nav-link " href=<?php echo $home ?>>Home</a>
					  </li>
					  <li class="nav-item ">
					    <a class="nav-link " href="#" id='projdb'>KPI Projects</a>
					  </li>
					   <li class="nav-item">
					   <a class="nav-link " href='#' id='mqualHitRate'>MQUAL Hit Rate</a>
					    
					  </li>
					   <li class="nav-item">
					    <a class="nav-link " href="#"  id='mqualBacklog'>MQUAL Backlog</a>
					  </li>
					   <li class="nav-item">
					    <a class="nav-link " href="#" id='emcycletime'>EQUAL/MQUAL Cycle Time</a>
					  </li>
					   <li class="nav-item">
					    <a class="nav-link " href="#" id='cabapprate'>MQUAL CAB Approval Rate</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link " href="#" id='msvsdigrate'>Hit Rate Cycle Time (MS vs DIG)</a>
					  </li>
					   <li class="nav-item">
					    <a class="nav-link " href="#" id='avemsvsdig'>Average Cycle Time (MS vs DIG)</a>
					  </li>
					</ul>

		</div> 






<div id='DMSGKPIProjects'>
	
	 <div class="modal-body" style ='padding : 40px; padding-bottom : 80px'>
		<select id='yearproj' class='form-control' width='10'>
		<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
		<?php
				$select1 = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select1 = $select1 . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select1;
					
			?>

		</select>

		<nav class="navbar navbar-light bg-light">
 		 <form class="form-inline" >
		   
		    <div class='wrapper'>
		   <button class="btn btn-sm btn-outline-secondary kpi" type="button" id='allkpi' >All</button>
		    <button class="btn btn-sm btn-outline-secondary kpi" type="button" id='Q1kpi'>Q1</button>
		    <button class="btn btn-sm btn-outline-secondary kpi" type="button" id='Q2kpi'>Q2</button>
		    <button class="btn btn-sm btn-outline-secondary kpi" type="button" id='Q3kpi'>Q3</button>
		    <button class="btn btn-sm btn-outline-secondary kpi" type="button" id='Q4kpi'>Q4</button>
		</div>
		</nav>

	</div>

	<div id='ProjectTable'>
		
	</div>

</div>




<!-- MQUAL HIT RATE -->
<div id='DMSGMqualHitRate'>
	 <div class="modal-body" style ='padding : 40px; padding-bottom : 100px'>
		<select id='yeaMqualHit' class='form-control' width='10'>
		<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
		<?php
				$select1 = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select1 = $select1 . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select1;
					
			?>

		</select>


	</div>




		<div class="chart-container" style="position: relative; height:100vh; width:80vw ; left :5vw">
				<canvas id='MQUALHitRateCHart' ></canvas>
		</div>

</div>
<!-- MQUAL HIT RATE END-->


<!-- MQUAL BACKLOG -->
<div id='DMSGBacklog'>
		 <div class="modal-body" style ='padding : 40px; padding-bottom : 40px'>
			<select id='yearMqualBack' class='form-control' width='10'>
			<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
			<?php
				$select = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select = $select . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select;
					
			?>
			</select>

		</div>




		<div class="chart-container" style="position: relative; height:40vh; width:95vw ; left :0vw">
		<canvas id='DMSGBacklogChart' ></canvas>
		</div>

</div>

<!-- MQUAL BACKLOG END-->

<!-- MQUAL EQUAL CYCLE TIME -->

<div id='DMSGemcycletime'>
		
		 <div class="modal-body" style ='padding : 40px; padding-bottom : 20px'>
			<select id='yearemcycletime' class='form-control' width='10'>
			<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
			<?php
				$select = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select = $select . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select;
					
			?>
			</select>

		</div>
		<nav class="navbar navbar-light bg-light">
 		 <form class="form-inline" >
		   
		    <div class='wrapper'>
		   <button class="btn btn-sm btn-outline-secondary em" type="button" id='all' >All</button>
		    <button class="btn btn-sm btn-outline-secondary em" type="button" id='Q1'>Q1</button>
		    <button class="btn btn-sm btn-outline-secondary em" type="button" id='Q2'>Q2</button>
		    <button class="btn btn-sm btn-outline-secondary em" type="button" id='Q3'>Q3</button>
		    <button class="btn btn-sm btn-outline-secondary em" type="button" id='Q4'>Q4</button>
		</div>
		</nav>

		<div class="chart-container" style="position: relative; height:40vh; width:80vw ; left :5vw">
		<canvas id='emcycletimechart' ></canvas>
		</div>

</div>

<!-- MQUAL EQUAL CYCLE TIME END-->


<!-- Cab Approval Rate -->

<div id='DMSGCabAppRate'>
	 <div class="modal-body" style ='padding : 40px; padding-bottom : 100px'>
		<select id='yearCabAppRate' class='form-control' width='10'>
		<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
		<?php
				$select1 = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select1 = $select1 . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select1;
					
			?>

		</select>

	</div>




		<div class="chart-container" style="position: relative; height:100vh; width:80vw ; left :5vw">
				<canvas id='DMSGCabAppRateChart' ></canvas>
		</div>

</div>


<!-- Cab approval rate end -->


<div id='DMSGMSVSDIGHitRate'>
	 <div class="modal-body" style ='padding : 40px; padding-bottom : 100px'>
		<select id='yearMSVSDIGHit' class='form-control' width='10'>
		<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
		<?php
				$select1 = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select1 = $select1 . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select1;
					
			?>

		</select>

	</div>




		<div class="chart-container" style="position: relative; height:100vh; width:80vw ; left :5vw">
				<canvas id='MSVSDIGHitRateCHart' ></canvas>
		</div>

</div>



<div id='DMSGavemsvsdig'>
	 <div class="modal-body" style ='padding : 40px; padding-bottom : 100px'>
		<select id='yearavemsvsdig' class='form-control' width='10'>
		<option class='form-control' value= 'NoYearSelected' disabled selected>Select Year</option>
		<?php
				$select1 = '';
				$year = intval(date("Y"));
				for ($i = 2019 ; $i <= $year ; $i++){

					$select1 = $select1 . "<option class='form-control' value='$i' >$i</option>";


				}
				
				echo $select1;
					
			?>

		</select>

	</div>




		<div class="chart-container" style="position: relative; height:100vh; width:80vw ; left :5vw">
				<canvas id='DMSGavemsvsdigChart' ></canvas>
		</div>

</div>


<script type="text/javascript" src='js/projectable.js'>//KPI Project List </script>
<script type="text/javascript" src='js/mqualhitrate.js'>// MquahHitRate</script>
<script type="text/javascript" src='js/mqualbacklog.js'>// mqualbacklog</script>
<script type="text/javascript" src='js/equalmqualcycletime.js'>//equal/mqual cycle time</script>
<script type="text/javascript" src='js/cabapprovalrate.js'>//cabapprovalrate</script>
<script type="text/javascript" src='js/cycletimemsvsdig.js'>// Dig vs MS QUal Cycle Time</script> 
<script type="text/javascript" src='js/averagemsvsdig.js'></script>


<script>//Select Report
	$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();

	$(document).on('click',function(event){
		

		$('a').each(()=>{}).removeClass('active');
		$(event.target).closest('a').addClass('active');
		var active = $(event.target).closest('a').attr('id');

		if (active=='mqualBacklog'){
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();
			$('#DMSGBacklog').show();
		}
		else if(active=='mqualHitRate'){
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();
			$('#DMSGMqualHitRate').show();
		}
		else if(active=='emcycletime'){
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();
			
			$('#DMSGemcycletime').show();
		}else if (active=='cabapprate'){
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();

			$('#DMSGCabAppRate').show();
		}else if (active=='msvsdigrate'){
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();

			$('#DMSGMSVSDIGHitRate').show();
		}else if (active =='projdb'){
			
			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();

			$('#DMSGKPIProjects').show();
		}else if (active =='avemsvsdig'){

			$('#DMSGavemsvsdig,#DMSGKPIProjects,#DMSGMqualHitRate,#DMSGBacklog,#DMSGemcycletime,#DMSGCabAppRate,#DMSGMSVSDIGHitRate').each(()=>{}).hide();

			$('#DMSGavemsvsdig').show();
		}
	
	});


</script>



</body>
</html>