<?php defined('_JEXEC') or die('Restricted access');?>
<?php

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');
?>


<!DOCTYPE html>
<html xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
	<title>BIOFLU</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/jeremy.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/responsive_tek.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl?>/templates/<?php echo $this->template ?>/css/1366px.css">
	<jdoc:include type="head" />

	<script>
	(function(d, s, id){
	 var js, fjs = d.getElementsByTagName(s)[0];
	 if (d.getElementById(id)) {return;}
	 js = d.createElement(s); js.id = id;
	 js.src = "//connect.facebook.net/en_US/sdk.js";
	 fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
</head>
<body data-baseurl="<?= $this->baseurl; ?>">
	
<div class="main-container">
	<!-- <div class="container main-container"> -->
	<jdoc:include type="modules" name="position-3" style="none" />
	<div class="">
		<div class="col-md-12 pad-0 violator">
			<!-- <a href="http://www.unilab.com.ph/" target="_blank"> -->
			<div class="col-md-1 violator-link"></div>
				<img src="images/assets/violator.png" width="100%">
			<!-- </a> -->
		</div>
		<div class="mainMenu">
			<div class="nav-header">
				<div class="navbar-header">					
					<button aria-controls="navbar" data-target="#navbar" data-toggle="collapse" class="glyphicon glyphicon-menu-hamburger navbar-toggle" type="button">
						<span class="menu-text">Menu</span>
					</button>
					<div class="logo-text">
					<!-- <img src="images/assets/logo.png" height="70px"> -->
						<div class="logo-title">BIOFLU <span class="glyphicon glyphicon-plus plus-sign-mobile" style="display:none;"></span><span class="glyphicon glyphicon-plus plus-sign nfm-header" style="display:none;"></span><span class="nfm-red nfm-header" style="display:none;">NATIONAL FLU MONITOR</span><span class="nfm-red nfm-header-mobile" style="display:none;">NATL FLU MONITOR</span></div>
						<div class="logo-sub">The All&#8208;in&#8208;One Solution for Flu</div>
					</div>
					<div class="flumonitor_count">
						<ul>
							<li><d class="fred nfr_cnt"></d><br><d class="sub-text">Flu Reports</d></li>
							<li><d class="fred f-location"></d><br><d class="sub-text">Location</d></li>
							<li><d class="fred f-image"><img src="images/assets/nfm-icon.png" width="50px"></li>
						</ul>
					</div>
				</div>
				<div class="navi-heading">
					<div class="navbar-collapse pad-0 collapse" id="navbar">
						<div class="col-md-12 pad-0">
							<jdoc:include type="modules" name="position-1" style="none" />
			 
							<!-- <span class="search-bar searchbar-mob">
								<input class="search" type="text" name="txtsearch" placeholder="Search">
							</span> -->
						</div>
						
					</div>
				</div>
			</div>

		</div>
			
	</div>
	<div class="col-md-12 pad-0 main-wrapper">	
		<jdoc:include type="modules" name="position-2" style="none" />
		<!-- Article Container -->
		<div class="article-title"></div>
		<div class="art-banner"></div>
		<div class="col-md-12 pad-0">
			<div class="col-md-8 pad-0">
				<jdoc:include type="modules" name="position-4" style="none" />
			</div>
			<div class="col-md-4 pad-0">
				<jdoc:include type="modules" name="position-5" style="none" />
			</div>
		</div>
		<jdoc:include type="modules" name="position-6" style="none" />
	</div>
	<div class="footer-container">
		<ul>
			<li><img class="2flu" src="images/assets/2flu.png" height="60px"></li>
			<li><img class="unilablogo" src="images/assets/unilab-logo.png" height="45px"></li>
			<li><hr class="footer-line"></hr></li>
			<li><p class="footer-text">#ALLINONEBIOFLU</p></li>
			<li><p class="footer-text">#PAG2FLU</p></li>
			<li class="foot-capsule"><img  src="images/assets/footer-bioflu-capsule.png" height="60px"></li>
		</ul>
	</div>
</div>

</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
	$('.mainMenu .item-107').html('<input type="text" name="searchbar" class="searchbar" placeholder="SEARCH"><span class="search-icon glyphicon glyphicon-search form-control-feedback"></span>');

	$('.search-icon').click(function(){
		var search_query = $('.searchbar').val(); 
		window.location = 'search?query='+search_query;
	});

	$('.violator-link').click(function(){
		// window.location = 'http://www.unilab.com.ph/';
		window.open( 'http://www.unilab.com.ph/','_blank');
	});

	$('.searchbar').bind('keypress', function(e) {
		var code = e.keyCode || e.which;
		if(code == 13) { 
			var search_query = $('.searchbar').val(); 
			window.location = 'search?query='+search_query;
		}
	});

	$.ajax({
        type: 'post',
        url: 'modules/mod_flumonitor/controller.php?function=nfm_count',
        cache: false
    }).done(function(data){        
        var callback = JSON.parse(data);
        $('.f-report').html(callback.flu_reports);
        $('.f-location').html(callback.location);
        $('.nfr_cnt').html(callback.nfr_reports);
        $('.nfm_drugStores').html('');
        $('.nfm_drugStores').html(callback.drugStores);
    });

});
</script>