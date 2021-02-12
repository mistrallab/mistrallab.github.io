
<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'informatics';
	$con = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $con )
	{
		die('Could not connect: ' . mysql_error());
	}
	#echo 'Connected successfully';
	$databaseName = 'tcga';
	$tableName = 'brcaProteins';
	$dbs = mysql_select_db($databaseName, $con);
	$deneme = "TCGA-A2-A04N-01";
	//$sql = 'SELECT * FROM brcaProteins where patientBarkode = "TCGA-A2-A04N-01"';
	$query = sprintf("SELECT patientBarkode FROM brcaProteins where patientBarkode = '%s'",mysql_real_escape_string($deneme));
	$result = mysql_query($query,$con);
	#echo  $result;    
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$value = $row['patientBarkode'];
		echo $value;
		//echo "id".$value;
	}
	  //$array = mysql_fetch_row($result);                          //fetch result    
	  //--------------------------------------------------------------------------
	  // 3) echo result as json 
	  //--------------------------------------------------------------------------
	  //echo json_encode($array);
	//echo "Fethced data succesfully."

	//mysql_close($con);
?>

