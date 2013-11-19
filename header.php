<!doctype HTML>
<!--[if IE 7]>    <html class="ie7 ie-lt-8 ie-lt-9 ie-lt-10" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 ie-lt-9 ie-lt-10" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9 ie-lt-10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>	
	<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	echo ", $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' - ' . sprintf( 'Page %s', max( $paged, $page ) );
	?></title>
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="resource-type" content="document" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en-us" />
	<meta name="author" content="Pablo Cazorla" />
	<meta name="contact" content="contact@pcazorla.com" />
	<meta name="copyright" content="Designed by Pablo Cazorla under licence Creative Commons - 2013." />
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>	
	<link href="<?php bloginfo('template_url'); ?>/style.min.php" rel="stylesheet" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
	
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_url'); ?>/js/html5-3.4-respond-1.1.0.min.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>	
</head>
<body>
	<noscript>
		<link href="<?php bloginfo('template_url'); ?>/css/noscript.css" rel="stylesheet" type="text/css" />
		<div class="noscript">Please, activate Javascript in your browser to enjoy this site</div>
	</noscript>
	<script>
		var server = '<?php echo $_SERVER[HTTP_HOST]; ?>',
			templateURL = '<?php bloginfo('template_url'); ?>',
			portfolioGrid = false;		
	</script>
&nbsp;
	<header class="box main">
		<div class="wrap clearfix">
			<a href="<?php bloginfo( 'url' ); ?>" class="logo">
				<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="Pablo Cazorla" title="Pablo Cazorla"/>
			</a>
			<a id="menu-launcher" href="">
				<span></span><span></span><span></span>
			</a>		
			<div id="side-act">
				<div id="side-act-content">
					<menu class="main">
						<?php  wp_nav_menu();?>
					</menu>
				</div>				
			</div>			
		</div>
	</header>