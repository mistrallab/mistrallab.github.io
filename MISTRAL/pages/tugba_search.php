<?php




	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'informatics';
	$dbname = 'tcga';
	$con = mysql_connect($dbhost, $dbuser, $dbpass);
   
   //Connect to MySQL Server
   mysql_connect($dbhost, $dbuser, $dbpass);

   
   	//Select Database
   	mysql_select_db($dbname) or die(mysql_error());

    /* tutorial_search is the name of database we've created */
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php

	include 'ChromePhp.php';
	ChromePhp::log('hello world');

   	$barcode = $_GET['barcode'];
	$diseaseType = $_GET['diseaseType'];
	$edgeInteractionType = $_GET['edgeInteractionType'];
	$proteins = $_GET['proteins'];
	$individualStructureType = $_GET['individualStructureType'];
	//scrore icin de ayarylama yapman lazım
   	// gets value sent over search form
     
  		$min_length = 3;
        $query = htmlspecialchars($barcode);
        $query = mysql_real_escape_string($barcode);
	//ChromePhp::log($queryString);
	$queryStr = "select p.BARCODE, p.PAGE_URL from Patients p WHERE ";
	//ChromePhp::log($queryStr);
	if($barcode!="")
	{
		$queryStr = $queryStr." p.BARCODE = '".$barcode."' and ";
	}
	//ChromePhp::log($queryStr);
	if($diseaseType!="")
	{
		$queryStr = $queryStr. " p.DISEASE_TYPE = '".$diseaseType."' and ";
	}
	$queryStr = $queryStr."EXISTS (select pi.PATIENT_ID from ProteinInteractions pi where p.BARCODE = pi.PATIENT_ID"; 
	if($proteins!="")
	{
		$queryStr = $queryStr. " and (pi.SOURCE = '".$proteins."' or pi.TARGET = '".$proteins."')";
	}
	if($edgeInteractionType!="")
	{
		$queryStr = $queryStr. " and pi.EDGE_STRUCTURE_TYPE = '".$edgeInteractionType."'";
	}
	$queryStr = $queryStr." and pi.PATIENT_ID IN (select ips.PATIENT_ID from IndividualProteinStructures ips where p.BARCODE = ips.PATIENT_ID";
	if($individualStructureType!="")
	{
		$queryStr = $queryStr. " and ips.STRUCTURE_TYPE = '".$individualStructureType."'";
	}
	if($proteins!="")
	{
		$queryStr = $queryStr. " and ips.PROTEIN = '".$proteins."'";
	}
	$queryStr = $queryStr. "))";
	ChromePhp::log($queryStr);
    $raw_results = mysql_query($queryStr) or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
            while($results = mysql_fetch_array($raw_results)){
				echo "<a href='".$results['PAGE_URL']."'>".$results['BARCODE']."</a><br/>";
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

?>
</body>
</html>
