<?php 


include 'D:\xampp\htdocs\dmsg\config\config.php';
include '..\..\phpfunction\date.php';
$year1 = mysqli_real_escape_string($con,$_POST["selectedyear"] );
$year2 = $year1 - 1;

//For Q 1
//Look for all projects from Q1 started from Dec3, 2018 to Jan 30,2019
//Count projects for q1 through qual start date 
//count projects completed and cycle time is <= 30 days 
//compute Q1projectHit / Q1Totalproject * 100 



$year3 = intval($year1);
$den = $year3 - 1;

$Q1 = 0;
$Q2 = 0;
$Q3 = 0;
$Q4 = 0;




$Q2T;
$Q3T;
$Q4T;

$Q1sql = "SELECT * 
		  from projects 
		  where 
		  		((Qualification_Start_Date) BETWEEN '$den/12/03' AND '$year3/03/02' ) 
		  		AND (Release_Method = 'RapidRelease' OR Release_Method = 'FullPartRelease') 
		  		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
		  		AND (Project_Status ='Ongoing' or Project_Status ='Completed')";

$resultQ1 = mysqli_query($con , $Q1sql  ); 
$Q1T = mysqli_num_rows($resultQ1) ;  //total project for Q1 



while($row1=mysqli_fetch_array($resultQ1)){

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





 		if (($row1['PRP_Date'] != null AND $row1['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 			$Q1++;
 		}
}


$Q2sql = "SELECT * 
		  from projects 
		  where 
		 	 ((Qualification_Start_Date) BETWEEN '$year3/03/03' AND '$year3/06/01' ) 
		 	 AND (Release_Method = 'RapidRelease' or Release_Method = 'FullPartRelease') 
		  	 AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL')
		  	 AND (Project_Status ='Ongoing' or Project_Status ='Completed')";

$resultQ2 = mysqli_query($con , $Q2sql  ); 
$Q2T = mysqli_num_rows($resultQ2) ;//total project for q2

while($row2=mysqli_fetch_array($resultQ2)){
 			$qualstartdate = $row2['Qualification_Start_Date'];
			$prpdate = $row2['PRP_Date'];
			$cabapprovedate = $row2['CAB_Approved_Date'];



			$ProjectName = $row2['Device_ID'] ." (".$row2['Project_Type'].")";
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





 		if (($row2['PRP_Date'] != null AND $row2['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 			$Q2++;
 		}
}

$Q3sql = "SELECT * 
		  from projects 
		  where 
			  ((Qualification_Start_Date) BETWEEN '$year3/06/02' AND '$year3/09/01' ) 
			  AND (Release_Method = 'RapidRelease' or Release_Method = 'FullPartRelease') 
			  AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' )
			  AND (Project_Status ='Ongoing' or Project_Status ='Completed')";

$resultQ3 = mysqli_query($con , $Q3sql  ); 
$Q3T = mysqli_num_rows($resultQ3) ;//total project for q3

while($row3=mysqli_fetch_array($resultQ3)){
 			$qualstartdate = $row3['Qualification_Start_Date'];
			$prpdate = $row3['PRP_Date'];
			$cabapprovedate = $row3['CAB_Approved_Date'];



			$ProjectName = $row3['Device_ID'] ." (".$row3['Project_Type'].")";
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





 		if (($row3['PRP_Date'] != null AND $row3['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

 			$Q3++;
 		}
}

$Q4sql = "SELECT * 
		  from projects 
		  where 
		  	((Qualification_Start_Date) BETWEEN '$year3/09/02' AND '$year3/12/02' ) 
		  	AND (Release_Method = 'MQUAL' or Release_Method = 'FullPartRelease') 
			AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI')
			AND (Project_Status ='Ongoing' or Project_Status ='Completed')";
			
$resultQ4 = mysqli_query($con , $Q4sql  );
$Q4T = mysqli_num_rows($resultQ4) ; //total project for q4

while($row4=mysqli_fetch_array($resultQ4)){
 			$qualstartdate = $row4['Qualification_Start_Date'];
			$prpdate = $row4['PRP_Date'];
			$cabapprovedate = $row4['CAB_Approved_Date'];



			$ProjectName = $row4['Device_ID'] ." (".$row4['Project_Type'].")";
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





 		if (($row4['PRP_Date'] != null AND $row4['PRP_Date'] !='0000-00-00') and ($cabapprovedate != "0000-00-00" AND $cabapprovedate != NUll) and $MQUAL <= 30  ) {

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





//$Q1Object = (object) array('QT' => $Q1T , 'QH' => $Q1 , 'M' => $M1 );
//$Q2Object = (object) array('QT' => $Q2T , 'QH' => $Q2 , 'M' => $M2 );
//$Q3Object = (object) array('QT' => $Q3T , 'QH' => $Q3 , 'M' => $M3 );
//$Q4Object = (object) array('QT' => $Q4T , 'QH' => $Q4 , 'M' => $M4 );






$array = [  array('QT' => $Q1T , 'QH' => $Q1 , 'M' => $M1 ),
			array('QT' => $Q2T , 'QH' => $Q2 , 'M' => $M2 ), 
			array('QT' => $Q3T , 'QH' => $Q3 , 'M' => $M3),
			array('QT' => $Q4T , 'QH' => $Q4 , 'M' => $M4) ];
//$array1 = [ $Q1Object, $Q2Object , $Q3Object, $Q4Object];

echo json_encode($array);
///echo $date;
//echo strval($newformat2). strval($newformat2);

 ?>