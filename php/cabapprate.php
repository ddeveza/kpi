
<?php

	include '..\..\config\config.php';
	$year = mysqli_real_escape_string($con,$_POST["selectedyear"] );

	$year = intval($year);
	$prevyear = $year -1 ;
	
	$Q1 = 0;
	$Q2 = 0;
	$Q3 = 0;
	$Q4 = 0;



	$Q1sql="SELECT *
		  		from projects 
		 		where 
		  		((Qualification_Start_Date) BETWEEN '$prevyear/12/03' AND '$year/03/02' ) 
		  		AND (Release_Method = 'MQUAL' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL' )
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')
                AND NOT(CAB_Date = '0000-00-00')";

    $resultQ1 = mysqli_query($con , $Q1sql  ); 
    $Q1T = mysqli_num_rows($resultQ1) ;  //total project cab for Q1

    while($row1=mysqli_fetch_array($resultQ1)){
 		if ($row1['CAB_Approved_Date'] == $row1['CAB_Date'] ) {

 			$Q1++;
 		}
	}


	$Q2sql="SELECT *
		  		from projects 
		 		where 
		  		((Qualification_Start_Date) BETWEEN '$year/03/03' AND '$year/06/01' ) 
		  		AND (Release_Method = 'MQUAL' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL' )
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')
                AND NOT(CAB_Date = '0000-00-00')";

    $resultQ2 = mysqli_query($con , $Q2sql  ); 
    $Q2T = mysqli_num_rows($resultQ2) ;  //total project cab for Q2

    while($row1=mysqli_fetch_array($resultQ2)){
 		if ($row1['CAB_Approved_Date'] == $row1['CAB_Date'] ) {

 			$Q2++;
 		}
	}


	$Q3sql="SELECT *
		  		from projects 
		 		where 
		  		((Qualification_Start_Date) BETWEEN '$year/06/02' AND '$year/09/01' ) 
		  		AND (Release_Method = 'MQUAL' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL' )
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')
                AND NOT(CAB_Date = '0000-00-00')";

    $resultQ3 = mysqli_query($con , $Q3sql  ); 
    $Q3T = mysqli_num_rows($resultQ3) ;  //total project cab for Q3

    while($row1=mysqli_fetch_array($resultQ3)){
 		if ($row1['CAB_Approved_Date'] == $row1['CAB_Date'] ) {

 			$Q3++;
 		}
	}


	$Q4sql="SELECT *
		  		from projects 
		 		where 
		  		((Qualification_Start_Date) BETWEEN '$year/09/02' AND '$year/12/02' ) 
		  		AND (Release_Method = 'MQUAL' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL' )
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')
                AND NOT(CAB_Date = '0000-00-00')";

    $resultQ4 = mysqli_query($con , $Q4sql  ); 
    $Q4T = mysqli_num_rows($resultQ4) ;  //total project cab for Q4

    while($row1=mysqli_fetch_array($resultQ4)){
 		if ($row1['CAB_Approved_Date'] == $row1['CAB_Date'] ) {

 			$Q4++;
 		}
	}


	if ($Q1T == 0){
		$M1 = 0;	
	}else{

		$M1 = ($Q1/$Q1T)*100;
	}

	if ($Q2T == 0){
		$M2 = 0;	
	}else{

		$M2 = ($Q2/$Q2T)*100;
	}

	if ($Q3T == 0){
		$M3 = 0;	
	}else{

		$M3 = ($Q3/$Q3T)*100;
	}

	if ($Q4T == 0){
		$M4 = 0;	
	}else{

		$M4 = ($Q4/$Q4T)*100;
	}


	$data = array();

	$data[0] = $M1;
	$data[1] = $M2;
	$data[2] = $M3;
	$data[3] = $M4;

	$array = [  array('CAB' => $Q1T , 'CABHit' => $Q1 , 'CABHitRate' => $M1) ,
				array('CAB' => $Q2T , 'CABHit' => $Q2 , 'CABHitRate' => $M2 ), 
				array('CAB' => $Q3T , 'CABHit' => $Q3 , 'CABHitRate' => $M3),
				array('CAB' => $Q4T , 'CABHit' => $Q4 , 'CABHitRate' => $M4)];
	//$array1 = [ $Q1Object, $Q2Object , $Q3Object, $Q4Object];

	echo json_encode($array);

?>