<?php


include '..\..\config\config.php';
include '..\..\phpfunction\date.php';

$year = intval($_POST['selectedyear']);
$quarter = $_POST['click'];

//echo $year . ': ' . $quarter;



if ($quarter == 'all'){

$sql = "SELECT Device_ID , Project_Status, LEFT(Project_Type, 2) AS Project_Type , 
	(PRP_Date), 
	(Qualification_Start_Date) , 
	(CAB_Approved_Date) 
	from projects 
	where ((Qualification_Start_Date) BETWEEN '$year/01/01' AND '$year/12/31' ) 
	AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
	AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
	AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
	Order By Qualification_Start_Date Asc";




}else if ($quarter =='Q1'){


	$sql ="SELECT Device_ID , Project_Status, LEFT(Project_Type, 2) AS Project_Type , 
	(PRP_Date), 
	(Qualification_Start_Date) , 
	(CAB_Approved_Date) 
	from projects 
	where ((Qualification_Start_Date) BETWEEN '$year/01/01' AND '$year/03/31' ) 
	AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
	AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
	AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
	Order By Qualification_Start_Date Asc";




}else if ($quarter =='Q2'){

	$sql = "SELECT Device_ID , Project_Status, LEFT(Project_Type, 2) AS Project_Type , 
	(PRP_Date), 
	(Qualification_Start_Date) , 
	(CAB_Approved_Date) 
	from projects 
	where ((Qualification_Start_Date) BETWEEN '$year/04/01' AND '$year/06/30' ) 
	AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
	AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
	AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
	Order By Qualification_Start_Date Asc";



	
}else if ($quarter =='Q3'){
	$sql ="SELECT Device_ID , Project_Status, LEFT(Project_Type, 2) AS Project_Type , 
	(PRP_Date), 
	(Qualification_Start_Date) , 
	(CAB_Approved_Date) 
	from projects 
	where ((Qualification_Start_Date) BETWEEN '$year/07/01' AND '$year/09/30' ) 
	AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
	AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
	AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
	Order By Qualification_Start_Date Asc";
	


}else if ($quarter =='Q4'){

	$sql = "SELECT Device_ID , Project_Status, LEFT(Project_Type, 2) AS Project_Type , 
	(PRP_Date), 
	(Qualification_Start_Date) , 
	(CAB_Approved_Date) 
	from projects 
	where ((Qualification_Start_Date) BETWEEN '$year/10/01' AND '$year/12/31' ) 
	AND (Release_Method = 'FullPartRelease' OR Release_Method = 'RapidRelease' ) 
	AND (Project_Type = 'FT NPI' OR Project_Type = 'WS NPI'  OR Project_Type = 'FT EQUAL')
	AND (Project_Status = 'Ongoing' OR Project_Status = 'Completed')
	Order By Qualification_Start_Date Asc";
	
}
$result = mysqli_query($con , $sql  ); 




$data = array ();
while($row=mysqli_fetch_array($result)){

			$qualstartdate = $row['Qualification_Start_Date'];
			$prpdate = $row['PRP_Date'];
			$cabapprovedate = $row['CAB_Approved_Date'];



			$ProjectName = $row['Device_ID'] ." (".$row['Project_Type'].")";
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

			$data[] = array(
				'ProjectName' =>  $ProjectName,
				'EQUAL' => $EQUAL,
				'MQUAL' => $MQUAL,
				'Status'=> $row['Project_Status']
				
			);
	
}


/*echo '<pre>';
print_r($data);
echo '</pre>'
*/

echo json_encode($data);



?>