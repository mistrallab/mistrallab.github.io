<?php include "includes/init.php"; ?><!doctype html>
<html lang="tr">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="title" content="<?php echo getPageTitle($page); ?>">
		<meta name="keywords" content="">
		<title><?php echo getPageTitle($page); ?></title>
		<link rel="shortcut icon" href="" type="image/png">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/main.css">
		
	</head>
	<body>
				<div class="container container-header">
 		        <div class="row">
				<div class="col-md-4 ">
            			<a href="people" target="_blank" title="NeTLAB">
                			<img class="img-responsive" src="<?php echo links("images/netlab_logo_dark.png"); ?>"; style="width:400px" ;>
           			</a>
				</div>
			<div class="col-md-8 col-xs-12 hidden-xs"; style= "position: absolute; left: 750px; top: 95px";>
                		<blockquote>
                   			 <p>Network Modelling Laboratory &nbsp; </p>
                   			 
               			 </blockquote>
            	</div>
			</div>
		</div>
		<div class="container container-nav">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-pills nav-justified">
						<li<?php if ($url[1] == "") echo ' class="active"'; ?>><a href="<?php echo links(""); ?>"><i class="fa fa-home"></i> Home</a></li>
						<li<?php if ($url[1] == "research") echo ' class="active"'; ?>><a href="<?php echo links("research"); ?>"><i class="fa fa-flask"></i> Research</a></li>
						<li<?php if ($url[1] == "publications") echo ' class="active"'; ?>><a href="<?php echo links("publications"); ?>"><i class="fa fa-book"></i> Publications</a></li>
						<li<?php if ($url[1] == "teaching") echo ' class="active"'; ?>><a href="<?php echo links("teaching"); ?>"><i class="fa fa-university"></i> Teaching</a></li>
						<li<?php if ($url[1] == "people") echo ' class="active"'; ?>><a href="<?php echo links("people"); ?>"><i class="fa fa-users"></i> People</a></li>
						<li<?php if ($url[1] == "news") echo ' class="active"'; ?>><a href="<?php echo links("news"); ?>"><i class="fa fa-rss-square"></i> News</a></li>
                                                <li<?php if ($url[1] == "contact") echo ' class="active"'; ?>><a href="<?php echo links("contact"); ?>"><i class="fa fa-envelope"></i> Contact</a></li>

					</ul>
				</div>
            </div>
        </div>
	


        <div class="container">
		    <?php include $page; ?>
		    <div class="row row-margin">
			    <div class="col-xs-offset-2 col-xs-4 col-md-offset-4 col-md-2">
				    <a href="http://ii.metu.edu.tr" target="_blank" title="Informatics Institute at Middle East Technical University">
				    	<img class="img-responsive" src="<?php echo links("images/ii_.png"); ?>"  ; style="width:75px">
				    </a>
			    </div>
			    <div class="col-md-2 col-xs-4">
				    <a href="http://www.metu.edu.tr" target="_blank" title="Middle East Technical University">
					    <img class="img-responsive" src="<?php echo links("images/metu.png"); ?>"; style="width:75px" >
				    </a>
			    </div>
		    </div>
	    </div>

	    <div class="footer">
		    <div class="container">
			    <p class="text-muted text-center"><i class="fa fa-copyright"></i> 2020, NeTLAB, Network Modeling Lab, <a href="http://ii.metu.edu.tr" target="_blank" title="Informatics Institute at Middle East Technical University">Informatics Institute</a>, <a href="http://www.metu.edu.tr" target="_blank" title="Middle East Technical University">Middle East Technical University</a>, prepared by <a href="http://www.gungorbudak.com" target="_blank" title="Gungor Budak and Melike Caglayan">Gungor Budak and Melike Caglayan</a>.</p>
		    </div>
	    </div>
		<script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>

	</body>
</html>
