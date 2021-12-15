<?php


include '..\..\config\config.php';
include '..\..\phpfunction\date.php';

$year = intval($_POST['selectedyear']);

$lastyear = intval($year - 1);

$Digital = ['J750','TRILLIUM','KTS','TRD50','TRL'];
$MS = ['FLEX','FLX','CAT','QUARTET','T2000','T2K', 'SYNC','SZ','MPT','MAV'];

$Q1T= 0;
$Q2T = 0;
$Q3T = 0;
$Q4T = 0;

/*Q1**********************/

$Q1sql = "SELECT * 
		  from projects 
		  where 
		  		((Qualification_Start_Date) BETWEEN '$lastyear/12/03' AND '$year/03/02' ) 
		  		AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')";


$resultQ1 = mysqli_query($con , $Q1sql  ); 
$Q1TotalMix = 0;
$Q1HitMix = 0;
$Q1TotalDig = 0;
$Q1HitDig = 0;

$Q1T = mysqli_num_rows($resultQ1) ;
while($row1=mysqli_fetch_array($resultQ1)){

	$Tester = $row1['tester'];
	$qualstartdate = $row1['Qualification_Start_Date'];
	$prpdate = $row1['PRP_Date'];
	$cabapprovedate = $row1['CAB_Approved_Date'];



	$ProjectName = $row1['Device_ID'] ." (".$row1['Project_Type'].")";
	if ($prpdate=='0000-00-00' || $prpdate == Null) {
		$prpdate = date('Y-m-d');

		$EQUAL = -dateDiffInDays($qualstartdate,$prpdate); //get the difference between today - qual start date
		$MQUAL = 0; // 0 because no prp date yet so equal cycle time is increasing.

	}elseif ($qualstartdate=='0000-00-00' || $qualstartdate  == NUll){
		
		$EQUAL = 0; //0 because the project has not yet started
		$MQUAL = 0; //0 because the project has not yet started
	}
	else {
		$EQUAL = -max (0, MinDate($prpdate,$cabapprovedate) - Day($qualstartdate) );

		$MQUAL = max(0, Day($cabapprovedate) -  MaxDate($prpdate,$qualstartdate));
	}

	foreach ($MS as $EachMS){


		if(stripos( $Tester, $EachMS) !== false){

			$Q1TotalMix++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 					$Q1HitMix++;
 			}
		}

		
	}	


	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q1TotalDig++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 					$Q1HitDig++;
 			}
		}

		
	}	
}

/*END OF Q1**********************/


$Q2sql = "SELECT * 
		  from projects 
		  where 
		  		((Qualification_Start_Date) BETWEEN '$year/03/03' AND '$year/06/01' ) 
		  		AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')";


$resultQ2 = mysqli_query($con , $Q2sql  ); 
$Q2TotalMix = 0;
$Q2HitMix = 0;
$Q2TotalDig = 0;
$Q2HitDig = 0;
$Q2T = mysqli_num_rows($resultQ2) ;//total project for q2

while($row1=mysqli_fetch_array($resultQ2)){

	$Tester = $row1['tester'];
	$qualstartdate = $row1['Qualification_Start_Date'];
	$prpdate = $row1['PRP_Date'];
	$cabapprovedate = $row1['CAB_Approved_Date'];



	$ProjectName = $row1['Device_ID'] ." (".$row1['Project_Type'].")";
	if ($prpdate=='0000-00-00' || $prpdate == Null) {
		$prpdate = date('Y-m-d');

		$EQUAL = -dateDiffInDays($qualstartdate,$prpdate); //get the difference between today - qual start date
		$MQUAL = 0; // 0 because no prp date yet so equal cycle time is increasing.

	}elseif ($qualstartdate=='0000-00-00' || $qualstartdate  == NUll){
		
		$EQUAL = 0; //0 because the project has not yet started
		$MQUAL = 0; //0 because the project has not yet started
	}
	else {
		$EQUAL = -max (0, MinDate($prpdate,$cabapprovedate) - Day($qualstartdate) );

		$MQUAL = max(0, Day($cabapprovedate) -  MaxDate($prpdate,$qualstartdate));
	}

	foreach ($MS as $EachMS){


		if(stripos( $Tester, $EachMS) !== false){

			$Q2TotalMix++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ){

 					$Q2HitMix++;
 			}
		}

		
	}	


	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q2TotalDig++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ){

 					$Q2HitDig++;
 			}
		}

		
	}	
}





$Q3sql = "SELECT * 
		  from projects 
		  where 
		  		((Qualification_Start_Date) BETWEEN '$year/06/02' AND '$year/09/01' ) 
		  		AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')";


$resultQ3 = mysqli_query($con , $Q3sql  ); 
$Q3TotalMix = 0;
$Q3HitMix = 0;
$Q3TotalDig = 0;
$Q3HitDig = 0;

$Q3T = mysqli_num_rows($resultQ3) ;//total project for q3
while($row1=mysqli_fetch_array($resultQ3)){

	$Tester = $row1['tester'];
	$qualstartdate = $row1['Qualification_Start_Date'];
	$prpdate = $row1['PRP_Date'];
	$cabapprovedate = $row1['CAB_Approved_Date'];



	$ProjectName = $row1['Device_ID'] ." (".$row1['Project_Type'].")";
	if ($prpdate=='0000-00-00' || $prpdate == Null) {
		$prpdate = date('Y-m-d');

		$EQUAL = -dateDiffInDays($qualstartdate,$prpdate); //get the difference between today - qual start date
		$MQUAL = 0; // 0 because no prp date yet so equal cycle time is increasing.

	}elseif ($qualstartdate=='0000-00-00' || $qualstartdate  == NUll){
		
		$EQUAL = 0; //0 because the project has not yet started
		$MQUAL = 0; //0 because the project has not yet started
	}
	else {
		$EQUAL = -max (0, MinDate($prpdate,$cabapprovedate) - Day($qualstartdate) );

		$MQUAL = max(0, Day($cabapprovedate) -  MaxDate($prpdate,$qualstartdate));
	}

	foreach ($MS as $EachMS){


		if(stripos( $Tester, $EachMS) !== false){

			$Q3TotalMix++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 					$Q3HitMix++;
 			}
		}

		
	}	


	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q3TotalDig++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ){

 					$Q3HitDig++;
 			}
		}

		
	}	
}


$Q4sql = "SELECT * 
		  from projects 
		  where 
		  		((Qualification_Start_Date) BETWEEN '$year/09/02' AND '$year/12/02' ) 
		  		AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')";


$resultQ4 = mysqli_query($con , $Q4sql  ); 
$Q4TotalMix = 0;
$Q4HitMix = 0;
$Q4TotalDig = 0;
$Q4HitDig = 0;

$Q4T = mysqli_num_rows($resultQ4) ; //total project for q4
while($row1=mysqli_fetch_array($resultQ4)){

	$Tester = $row1['tester'];
	$qualstartdate = $row1['Qualification_Start_Date'];
	$prpdate = $row1['PRP_Date'];
	$cabapprovedate = $row1['CAB_Approved_Date'];



	$ProjectName = $row1['Device_ID'] ." (".$row1['Project_Type'].")";
	if ($prpdate=='0000-00-00' || $prpdate == Null) {
		$prpdate = date('Y-m-d');

		$EQUAL = -dateDiffInDays($qualstartdate,$prpdate); //get the difference between today - qual start date
		$MQUAL = 0; // 0 because no prp date yet so equal cycle time is increasing.

	}elseif ($qualstartdate=='0000-00-00' || $qualstartdate  == NUll){
		
		$EQUAL = 0; //0 because the project has not yet started
		$MQUAL = 0; //0 because the project has not yet started
	}
	else {
		$EQUAL = -max (0, MinDate($prpdate,$cabapprovedate) - Day($qualstartdate) );

		$MQUAL = max(0, Day($cabapprovedate) -  MaxDate($prpdate,$qualstartdate));
	}

	foreach ($MS as $EachMS){


		if(stripos( $Tester, $EachMS) !== false){

			$Q4TotalMix++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 					$Q4HitMix++;
 			}
		}

		
	}	


	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q4TotalDig++;

			if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ){

 					$Q4HitDig++;
 			}
		}

		
	}	
}






if ($Q1TotalMix==0){
	$Q1MixResult = 0;
}else{
	$Q1MixResult = ($Q1HitMix/$Q1TotalMix)*100;
}

if ($Q1TotalDig==0){
	$Q1DigResult = 0;
}else{
	$Q1DigResult = ($Q1HitDig/$Q1TotalDig)*100;
}

if ($Q2TotalMix==0){
	$Q2MixResult = 0;
}else{
	$Q2MixResult = ($Q2HitMix/$Q2TotalMix)*100;
}

if ($Q2TotalDig==0){
	$Q2DigResult = 0;
}else{
	$Q2DigResult = ($Q2HitDig/$Q2TotalDig)*100;
}


if ($Q3TotalMix==0){
	$Q3MixResult = 0;
}else{
	$Q3MixResult = ($Q3HitMix/$Q3TotalMix)*100;
}

if ($Q3TotalDig==0){
	$Q3DigResult = 0;
}else{
	$Q3DigResult = ($Q3HitDig/$Q3TotalDig)*100;
}

if ($Q4TotalMix==0){
	$Q4MixResult = 0;
}else{
	$Q4MixResult = ($Q4HitMix/$Q4TotalMix)*100;
}

if ($Q4TotalDig==0){
	$Q4DigResult = 0;
}else{
	$Q4DigResult = ($Q4HitDig/$Q4TotalDig)*100;
}



$data = [
			array ('QT' => $Q1T,'QTMix'=>$Q1TotalMix,'QHMix'=>$Q1HitMix,'QMixResult'=>$Q1MixResult,'QTDig'=>$Q1TotalDig,'QHDig'=>$Q1HitDig,'QDigResult'=>$Q1DigResult),
			array ('QT' => $Q2T,'QTMix'=>$Q2TotalMix,'QHMix'=>$Q2HitMix,'QMixResult'=>$Q2MixResult,'QTDig'=>$Q2TotalDig,'QHDig'=>$Q2HitDig,'QDigResult'=>$Q2DigResult),
			array ('QT' => $Q3T,'QTMix'=>$Q3TotalMix,'QHMix'=>$Q3HitMix,'QMixResult'=>$Q3MixResult,'QTDig'=>$Q3TotalDig,'QHDig'=>$Q3HitDig,'QDigResult'=>$Q3DigResult),
			array ('QT' => $Q4T,'QTMix'=>$Q4TotalMix,'QHMix'=>$Q4HitMix,'QMixResult'=>$Q4MixResult,'QTDig'=>$Q4TotalDig,'QHDig'=>$Q4HitDig,'QDigResult'=>$Q4DigResult)




		];

/*echo '<pre>';
print_r($data);
echo '</pre>';*/

echo json_encode($data);


?>