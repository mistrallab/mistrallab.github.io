<?php
	if(isset($_GET['name']))
	{
		$search = $_GET['name'];
	}
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
	//$deneme = "TCGA-A2-A04N-01";
	//$sql = 'SELECT * FROM brcaProteins where patientBarkode = "TCGA-A2-A04N-01"';
	$query = sprintf("SELECT proteins FROM brcaProteins where patientBarkode = '%s'",mysql_real_escape_string($search));
	$result = mysql_query($query,$con);
	#echo  $result;    
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$value = $row['proteins'];
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

