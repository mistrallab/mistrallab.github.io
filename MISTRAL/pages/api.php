<?php
/*	include 'ChromePhp.php';
	ini_set('display_errors',1)
	ChromePhp::log('Hello console!');
	ChromePhp::log($_SERVER);
	ChromePhp::warn('something went wrong!');*/
  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "localhost";
  $user = "root";
  $pass = "informatics";

  $databaseName = "tcga";
  $tableName = "brcaProteins";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  #include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  if(!$con)
{
	die('Could not connect',mysql_error());
}
echo 'Connected success'
  $dbs = mysql_select_db($databaseName, $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $id = "A14Y";
  $result = mysql_query("SELECT * FROM $tableName");          //query
  $array = mysql_fetch_row($result);                          //fetch result    
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($array);

?>
