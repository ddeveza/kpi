<?php

include 'D:\xampp\htdocs\dmsg\config\config.php';

$mqualIN   = array();
$mqualOUT  = array();
$mqualbacklog = array();
$year1 = mysqli_real_escape_string($con,$_POST["selectedyear"] );
//fetch data
//while row { for 1 to 52 { if i == row['a'] { $mqual[i] = row[b] }}}

$year = intval($year1);
$lastyear = intval($year - 1);


//***************************************GET QUANTITY IN**************************************************************************
$sql = "SELECT WEEK((projects.Qualification_Start_Date) ) workweek, COUNT(*) b from projects 
		where  
			(Release_Method = 'FullPartRelease' or Release_Method='MQUAL'  )
		AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL') 
		AND ((projects.Qualification_Start_Date) BETWEEN '$year/01/31' AND '$year/12/31') 
		AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed') 
		GROUP BY WEEK((projects.Qualification_Start_Date) )
		ORDER BY workweek  ASC";

$result = mysqli_query($con , $sql  ); 
while($row=mysqli_fetch_array($result)){
 		for ($i=1 ; $i<53 ; $i++){
 			if ($i== $row['workweek']){
 				
 				$QUALIN['valuein'][$i] = intval($row['b']);
 				break;
 				
 			}
 		}

}

$IN = array();

for ($i=1 ; $i<53 ; $i++){
 			if (empty($QUALIN['valuein'][$i])){
 				
 				$IN['valuein'][$i] = 0;
 			}else{
 				$IN['valuein'][$i] = intval($QUALIN['valuein'][$i]);
 			}
 }



$label = array();
for ($i=0 ; $i<52 ; $i++){

		$label['label'][$i] = 'W'.($i+1) ;

}



//************************END OF COUNTING QUANTITY IN*************************************************/


//************************Start OF COUNTING QUANTITY OUT*************************************************/

$sqlOut = "SELECT WEEK(CAB_Approved_Date) a , COUNT(*) b
		   from   projects 
		   where  Release_Method = 'FullPartRelease' 
		   AND 	  (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL') 
		   AND ((Qualification_Start_Date) BETWEEN '$year/01/31' AND '$year/12/31') 
		   AND (Project_Status = 'Ongoing' OR Project_Status=  'Completed')
           AND NOT(CAB_Approved_Date = '0000-00-00' or CAB_Approved_Date is NUll)
           GROUP BY a 
           ORDER BY a ASC";

$resultOut = mysqli_query($con , $sqlOut  );


while($row1=mysqli_fetch_array($resultOut)){
 		for ($i=1 ; $i<53 ; $i++){
 			if ($i==$row1['a']){
 				$mqualOut['ValueOut'][$i] = intval($row1['b']);
 				break;
 			}
 		}

}

$ValueOUT = array ();

for ($i=1 ; $i<53 ; $i++){
		if (empty($mqualOut['ValueOut'][$i])){
				$ValueOUT['valueout'][($i)] = 0;
		}else {
			
			$ValueOUT['valueout'][$i] = intval($mqualOut['ValueOut'][$i]) ;
		}
}







//************************END OF COUNTING QUANTITY OUT*************************************************/




//************************Start OF COUNTING Backlog*************************************************/



$backloglastyear = "SELECT COUNT(*) count
		   from   projects 
		   where  Release_Method = 'FullPartRelease' 
		   AND 	  (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI' OR Project_Type = 'FT EQUAL') 
		   AND ((Qualification_Start_Date) BETWEEN '$lastyear/01/31' AND '$lastyear/12/31') 
		   AND (Project_Status = 'Ongoing' OR Project_Status=  'Completed')
           AND (CAB_Approved_Date = '0000-00-00' or CAB_Approved_Date is NUll)";

$resultBacklog = mysqli_query($con , $backloglastyear  );


if(mysqli_num_rows($resultBacklog) > 0){

	$row = mysqli_fetch_array($resultBacklog);
	
	$TotalBackLastyear =  intval($row['count']);

}else{
	$TotalBackLastyear = 0;
}




$mqualbacklog['backlog'][1] = intval($TotalBackLastyear) + $IN['valuein'][1] - - $ValueOUT['valueout'][1] ;

for ($i=2 ; $i<53 ; $i++){
 	$mqualbacklog['backlog'][$i] = 	intval($mqualbacklog['backlog'][$i - 1] + 	$IN['valuein'][$i] - $ValueOUT['valueout'][$i]);
 }




//************************END OF COUNTING Backlog*************************************************/




// $array1 = [$label , $valueIN, $valueOUT ,$ValueBacklog];

$array1 = [$label , $IN, $ValueOUT ,$mqualbacklog];

echo json_encode($array1);

/*echo '<pre>';
print_r($array1);
echo '<pre>';*/

?>


