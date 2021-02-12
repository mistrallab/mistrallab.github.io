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
   	$query = $_GET['query'];
	$query2 = $_GET['query2'];
   	// gets value sent over search form
     
  	$min_length = 3;
  	// you can set minimum length of the query if you want
     
  	if(strlen($query) >= $min_length){ 
	// if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM ajax_example
            WHERE (`name` LIKE '%".$query."%') and (`sex` LIKE '%".$query2."%')") or die(mysql_error());
             
         
        if(mysql_num_rows($raw_results) > 0){ 
		// if one or more rows are returned do following
             
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p>
						<h3>".$results['name']."</h3>
						</h1>".$results['sex']."</h1>
						</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
