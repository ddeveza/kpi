<?php

include '..\..\config\config.php';
include '..\..\phpfunction\date.php';

$year = intval($_POST['selectedyear']);

$lastyear = intval($year - 1);

$Digital = ['J750','TRILLIUM','KTS','TRD50','TRL'];
$MS = ['FLEX','FLX','CAT','QUARTET','T2000','T2K', 'SYNC','SZ','MPT','MAV'];


$Q1sql = "SELECT  *
			from projects 
			where 
			((Qualification_Start_Date) BETWEEN '$lastyear/12/03' AND '$year/03/02' ) 
		    AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		    AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type ='FT EQUAL')
		    AND (Project_Status ='Ongoing' or Project_Status ='Completed')
		    AND NOT(PRP_Date = '0000-00-00' OR PRP_Date is null)
		    AND NOT(CAB_Approved_Date ='0000-00-00' OR CAB_Approved_Date is null)";

$resultQ1 = mysqli_query($con , $Q1sql  ); 

$Q1MixTotalMqualCycleTime = 0;
$Q1MixCountProjects = 0;
$Q1DIGTotalMqualCycleTime = 0;
$Q1DIGCountProjects = 0;

while($row1=mysqli_fetch_array($resultQ1)){
	$Tester = $row1['tester'];
	$qualstartdate = $row1['Qualification_Start_Date'];
	$prpdate = $row1['PRP_Date'];
	$cabapprovedate = $row1['CAB_Approved_Date'];



	
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

			$Q1MixCountProjects++;
			$Q1MixTotalMqualCycleTime  += $MQUAL;
			
		}

		
	}

	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q1DIGCountProjects++;
			$Q1DIGTotalMqualCycleTime +=  $MQUAL;

			
		}

		
	}		


}


$Q2sql = "SELECT  *
			from projects 
			where 
			((Qualification_Start_Date) BETWEEN '$year/03/03' AND '$year/06/01' ) 
		    AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		    AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type ='FT EQUAL')
		    AND (Project_Status ='Ongoing' or Project_Status ='Completed')
		    AND NOT(PRP_Date = '0000-00-00' OR PRP_Date is null)
		    AND NOT(CAB_Approved_Date ='0000-00-00' OR CAB_Approved_Date is null)";

$resultQ2 = mysqli_query($con , $Q2sql  ); 

$Q2MixTotalMqualCycleTime = 0;
$Q2MixCountProjects = 0;
$Q2DIGTotalMqualCycleTime = 0;
$Q2DIGCountProjects = 0;

while($row2=mysqli_fetch_array($resultQ2)){
	$Tester = $row2['tester'];
	$qualstartdate = $row2['Qualification_Start_Date'];
	$prpdate = $row2['PRP_Date'];
	$cabapprovedate = $row2['CAB_Approved_Date'];



	
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

			$Q2MixCountProjects++;
			$Q2MixTotalMqualCycleTime  += $MQUAL;
			
		}

		
	}

	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q2DIGCountProjects++;
			$Q2DIGTotalMqualCycleTime +=  $MQUAL;

			
		}

		
	}		


}

$Q3sql = "SELECT  *
			from projects 
			where 
			((Qualification_Start_Date) BETWEEN '$year/06/02' AND '$year/09/01' )
		    AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		    AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type ='FT EQUAL')
		    AND (Project_Status ='Ongoing' or Project_Status ='Completed')
		    AND NOT(PRP_Date = '0000-00-00' OR PRP_Date is null)
		    AND NOT(CAB_Approved_Date ='0000-00-00' OR CAB_Approved_Date is null)";

$resultQ3 = mysqli_query($con , $Q3sql  ); 

$Q3MixTotalMqualCycleTime = 0;
$Q3MixCountProjects = 0;
$Q3DIGTotalMqualCycleTime = 0;
$Q3DIGCountProjects = 0;

while($row3=mysqli_fetch_array($resultQ3)){
	$Tester = $row3['tester'];
	$qualstartdate = $row3['Qualification_Start_Date'];
	$prpdate = $row3['PRP_Date'];
	$cabapprovedate = $row3['CAB_Approved_Date'];



	
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

			$Q3MixCountProjects++;
			$Q3MixTotalMqualCycleTime  += $MQUAL;
			
		}

		
	}

	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q3DIGCountProjects++;
			$Q3DIGTotalMqualCycleTime +=  $MQUAL;

			
		}

		
	}		


}



$Q4sql = "SELECT  *
			from projects 
			where 
			((Qualification_Start_Date) BETWEEN '$year/09/02' AND '$year/12/02' ) 
		    AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		    AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type ='FT EQUAL')
		    AND (Project_Status ='Ongoing' or Project_Status ='Completed')
		    AND NOT(PRP_Date = '0000-00-00' OR PRP_Date is null)
		    AND NOT(CAB_Approved_Date ='0000-00-00' OR CAB_Approved_Date is null)";

$resultQ4 = mysqli_query($con , $Q4sql  ); 

$Q4MixTotalMqualCycleTime = 0;
$Q4MixCountProjects = 0;
$Q4DIGTotalMqualCycleTime = 0;
$Q4DIGCountProjects = 0;

while($row4=mysqli_fetch_array($resultQ4)){
	$Tester = $row4['tester'];
	$qualstartdate = $row4['Qualification_Start_Date'];
	$prpdate = $row4['PRP_Date'];
	$cabapprovedate = $row4['CAB_Approved_Date'];



	
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

			$Q4MixCountProjects++;
			$Q4MixTotalMqualCycleTime  += $MQUAL;
			
		}

		
	}

	foreach ($Digital as $EachDigital){


		if(stripos( $Tester, $EachDigital) !== false){

			$Q4DIGCountProjects++;
			$Q4DIGTotalMqualCycleTime +=  $MQUAL;

			
		}

		
	}		


}

if ($Q1MixCountProjects==0){
	$Q1MixAve = 0;
}else{
	$Q1MixAve = ($Q1MixTotalMqualCycleTime/$Q1MixCountProjects);
}

if ($Q1DIGCountProjects==0){
	$Q1DIGAve = 0;
}else{
	$Q1DIGAve = ($Q1DIGTotalMqualCycleTime/$Q1DIGCountProjects);
}



if ($Q2MixCountProjects==0){
	$Q2MixAve = 0;
}else{
	$Q2MixAve = ($Q2MixTotalMqualCycleTime/$Q2MixCountProjects);
}

if ($Q2DIGCountProjects==0){
	$Q2DIGAve = 0;
}else{
	$Q2DIGAve = ($Q2DIGTotalMqualCycleTime/$Q2DIGCountProjects);
}


if ($Q3MixCountProjects==0){
	$Q3MixAve = 0;
}else{
	$Q3MixAve = ($Q3MixTotalMqualCycleTime/$Q3MixCountProjects);
}

if ($Q3DIGCountProjects==0){
	$Q3DIGAve = 0;
}else{
	$Q3DIGAve = ($Q3DIGTotalMqualCycleTime/$Q3DIGCountProjects);
}

if ($Q4MixCountProjects==0){
	$Q4MixAve = 0;
}else{
	$Q4MixAve = ($Q4MixTotalMqualCycleTime/$Q4MixCountProjects);
}

if ($Q4DIGCountProjects==0){
	$Q4DIGAve = 0;
}else{
	$Q4DIGAve = ($Q4DIGTotalMqualCycleTime/$Q4DIGCountProjects);
}


$data = [
			array('QCountMix'=>$Q1MixCountProjects,'QTotalMix'=>$Q1MixTotalMqualCycleTime,'QAveMix'=>$Q1MixAve,'QCountDIG'=>$Q1DIGCountProjects,'QTotalDIG'=>$Q1DIGTotalMqualCycleTime,'QAveDIG'=>$Q1DIGAve),
			array('QCountMix'=>$Q2MixCountProjects,'QTotalMix'=>$Q2MixTotalMqualCycleTime,'QAveMix'=>$Q2MixAve,'QCountDIG'=>$Q2DIGCountProjects,'QTotalDIG'=>$Q2DIGTotalMqualCycleTime,'QAveDIG'=>$Q2DIGAve),
			array('QCountMix'=>$Q3MixCountProjects,'QTotalMix'=>$Q3MixTotalMqualCycleTime,'QAveMix'=>$Q3MixAve,'QCountDIG'=>$Q3DIGCountProjects,'QTotalDIG'=>$Q3DIGTotalMqualCycleTime,'QAveDIG'=>$Q3DIGAve),
			array('QCountMix'=>$Q4MixCountProjects,'QTotalMix'=>$Q4MixTotalMqualCycleTime,'QAveMix'=>$Q4MixAve,'QCountDIG'=>$Q4DIGCountProjects,'QTotalDIG'=>$Q4DIGTotalMqualCycleTime,'QAveDIG'=>$Q4DIGAve)



	];

echo json_encode($data);


?>