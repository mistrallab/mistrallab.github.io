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



    if ($_POST){
    $ara=$_POST["ara"];
    $sorgu=mysql_query("select * from ajax_example where name like '%$ara%'");
    if (empty($ara))
	{
    	echo 'Arama alanını boş bıraktın';
    }
	else
	{
    	if (mysql_num_rows($sorgu)>0){
    		while($kayit=mysql_fetch_array($sorgu)){
    			echo $kayit["name"].' '.$kayit["age"].' '.$kayit["sex"];
    			echo '<br/>';
    		}
    	}
		else
		{
    		echo 'Eşleşen Kayıt Yok.';
    	}
    }
    }
	else
	{
    	?>
		<form name="form1" action="example" method="post">
			Aranacak Kelime:<input type="text" name="ara"/>
							<input type="submit" name="gonder" value="Ara"/>
		</form>
    	<?php
    }
    ?>
