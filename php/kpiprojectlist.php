<?php
	
	include '..\..\config\config.php';
	include '..\..\phpfunction\date.php';
	
	$year = intval($_POST['selectedyearkpi']);
	$click = $_POST['clickkpi'];
	$lastyear = intval($year - 1);


	if($click=='allkpi'){

		$sql = "SELECT * 
				from projects 
				where (Qualification_Start_Date BETWEEN '$lastyear/12/03' AND '$year/12/02' )
				AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
				AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
				AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
				Order By Qualification_Start_Date Asc";

	}else if($click=='Q1kpi') {
		$sql = "SELECT * 
			from projects 
			where (Qualification_Start_Date BETWEEN '$lastyear/12/03' AND '$year/03/02' )
			AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
			AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
			AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
			Order By Qualification_Start_Date Asc";
	}else if($click=='Q2kpi') {
		$sql = "SELECT * 
			from projects 
			where ((Qualification_Start_Date) BETWEEN '$year/03/03' AND '$year/06/01' )
			AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
			AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
			AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
			Order By Qualification_Start_Date Asc";
	}else if($click=='Q3kpi') {
		$sql = "SELECT * 
			from projects 
			where ((Qualification_Start_Date) BETWEEN '$year/06/02' AND '$year/09/01' ) 
			AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
			AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
			AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
			Order By Qualification_Start_Date Asc";
	}else if($click=='Q4kpi') {
		$sql = "SELECT * 
			from projects 
			where((Qualification_Start_Date) BETWEEN '$year/09/02' AND '$year/12/02' ) 
			AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
			AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
			AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
			Order By Qualification_Start_Date Asc";
	}

	
	$result = mysqli_query($con , $sql  ); 
	

/*	echo '<pre>';
print_r(($rows));
echo '</pre>';*/

	

?>

<table id="kpiprojecttable" class="table table-bordered hover" widh='100%'>
	<thead>
		<tr>
			<td>Device</td>
			<td>Engineer</td>
			<td>Project Type</td>
			<td>Project Status</td>
			<td>PRP Date</td>
			<td>Project Start Date(QSD)</td>
			<td>Cab Approval Date</td>
			<td>MQUAL Cycle Time</td>
			<td>EQUAL Cycle Time</td>
		</tr>
	</thead>
	<tbody>
			<?php 

					while($row=mysqli_fetch_array($result)){
					$PRPDate = $row['PRP_Date'];
					$QSD =  $row['Qualification_Start_Date'];
					$CABDate = $row['CAB_Approved_Date'];

					if($PRPDate=='0000-00-00'){
						$PRPDate = Null;
					}
					if($QSD=='0000-00-00'){
						$QSD = Null;
					}
					if($CABDate=='0000-00-00'){
						$CABDate = Null;
					}
					
					
						$EQUAL = max (0, MinDate($PRPDate,$CABDate) - Day($QSD) );

						$MQUAL = max(0, Day($CABDate) -  MaxDate($PRPDate,$QSD));
					

					

				?>

				<tr style="background-color: <?php if ($PRPDate==null || $PRPDate==null || $PRPDate==null){ echo 'rgba(216, 27, 96, 0.6)'; }
					else {echo 'rgba(3, 169, 244, 0.6)';}

					?>;">
					<td><?php echo $row['Device_ID']?></td>
					<td><?php echo $row['OSPI_Test_Engineer'];?></td>
					<td><?php echo $row['Release_Method'].' '.$row['Project_Type']?></td>
					<td><?php echo $row['Project_Status']?></td>
					<td><?php echo $PRPDate?></td>
					<td><?php echo $QSD?></td>
					<td><?php echo $CABDate?></td>
					<td><?php echo $MQUAL?></td>
					<td><?php echo $EQUAL?></td>
					

				</tr>






				
			<?php } mysqli_close($con)?>






	</tbody>
	<tfoot>
		<tr>
			<td>Device</td>
			<td>Engineer</td>
			<td>Project Type</td>
			<td>Project Status</td>
			<td>PRP Date</td>
			<td>Qual Start Date</td>
			<td>Cab Approval Date</td>
			<td>MQUAL Cycle Time</td>
			<td>EQUAL Cycle Time</td>
		</tr>
	</tfoot>

</table>

<script type="text/javascript">
	var table = $('#kpiprojecttable').DataTable({
		 "order": [[ 5, 'asc' ]]
	});
</script>