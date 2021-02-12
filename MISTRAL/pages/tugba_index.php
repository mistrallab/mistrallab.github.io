<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <form action="tugba_search" method="GET">
        Barcode : <input id="barcode" type="text" name="barcode" />
		<br/>

        Disease Type: <select id = 'diseaseType' name="diseaseType">
			<option value = ""></option>
            <option value = "BRCA">BRCA</option>
            <option value = "GBM">GBM</option>
			<option value = "OV">OV</option>
         </select>
		<br/>	

        Edge Interaction Type: <select id = 'edgeInteractionType' name="edgeInteractionType">
			<option value = ""></option>
			<option value = "instruct_3d">instruct_3d</option> 
			<option value = "instruct_new">instruct_new</option> 
			<option value = "interactome3d_new">interactome3d_new</option> 
			<option value = "interactome_3d">interactome_3d</option> 
			<option value = "no_str">no_str</option> 
			<option value = "pdb_3d">pdb_3d</option> 
			<option value = "pdb_new">pdb_new</option> 
			<option value = "prism_3d">prism_3d</option> 
			<option value = "prism_new">prism_new</option>
         </select>
		<br/>	
		Protein Names : <input id="proteins" type="text" name="proteins" />
		<br/>	
        Individual Protein Interaction Type: <select id = 'individualStructureType' name="individualStructureType">
			<option value = ""></option>
            <option value = "with_str">Yes</option>
            <option value = "no_str">No</option>
         </select>
		<br/>	
		<input type="submit" value="Search" />
    </form>
</body>
</html>
