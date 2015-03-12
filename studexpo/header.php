<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="img/icon/favicon-sutdexpo.png" type="image/x-icon">
	<link rel="icon" href="img/icon/favicon-sutdexpo.png" sizes="32x32">

	<title>StudExpo</title>

	<link rel="stylesheet" type="text/css" href="less/libs/jquery.fancybox.css"/>
	<link rel="stylesheet" type="text/css" href="less/styles.css"/>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<script src="js/libs/jquery.js?v=1.11.1"></script>
	<script src="js/libs/handlebars.min.js"></script>
	<script src="js/libs/bootstrap.min.js"></script>
	<script src="js/libs/underscore-min.js"></script>
	<script src="js/libs/idangerous.swiper.min.js"></script>
	<script src="js/libs/idangerous.swiper.scrollbar.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.0.0/isotope.pkgd.min.js"></script>
	<script src="js/libs/jquery.fancybox.min.js?v=2.1.5"></script>
	<script src="js/libs/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="js/libs/bootstrap-select.min.js"></script>
	<script src="js/libs/responsive-nav.js"></script>

	<!--Owl Carousel Lib-->
	<link rel="stylesheet" href="less/libs/owl.carousel.css">
	<link rel="stylesheet" href="less/libs/owl.theme.css">
	<script src="js/libs/owl.carousel.js"></script>
	
	<script src="js/main.js"></script>

	
</head>

<body>
	<header id="header" class="header">
		<nav class="navbar-top">
			<div class="container">
				<div class="btn-network network-header">
					<a href="" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="" target="_blank"><i class="fa fa-google-plus"></i></a>
					<a href="" target="_blank"><i class="fa fa-rss"></i></a>
				</div>
				<ul class="nav navbar-nav navbar-right pull-right">
					<li>
						<a href="modal-sign-in.php" class="fancyBoxTitle fancybox.ajax" ref="signin" title="Se connecter">
							<i class="fa fa-user"></i> Connexion
						</a>
					</li>
					<li>
						<a href="#" title="S'inscrire">
							<i class="fa fa-sign-in"></i> Inscription
						</a>
					</li>
				</ul>
			</div>
		</nav>
		<nav class="main-menu">
			<div class="container">
				<div class="logo">
					<a href="">
						<img class="nav-logo logo" src="img/Logo_Expo_Officiel.png" />
					</a>
				</div>
				<div class="nav-menu">
					<nav class="nav-collapse">
						<ul>
							<li><a href="">Le salon</a></li>
							<li><a href="">Exposer</a></li>
							<li><a href="">Visiter</a></li>
							<li><a href="">Concours</a></li>
							<li><a href="">Conférences</a></li>
							<li><a href="">Partenaires</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</nav>
	</header>

    <script>
      var navigation = responsiveNav(".nav-collapse", {
        animate: true,                    // Boolean: Use CSS3 transitions, true or false
        transition: 284,                  // Integer: Speed of the transition, in milliseconds
        label: "Menu",                    // String: Label for the navigation toggle
        insert: "after",                  // String: Insert the toggle before or after the navigation
        customToggle: "",                 // Selector: Specify the ID of a custom toggle
        closeOnNavClick: false,           // Boolean: Close the navigation when one of the links are clicked
        openPos: "relative",              // String: Position of the opened nav, relative or static
        navClass: "nav-collapse",         // String: Default CSS class. If changed, you need to edit the CSS too!
        navActiveClass: "js-nav-active",  // String: Class that is added to <html> element when nav is active
        jsClass: "js",                    // String: 'JS enabled' class which is added to <html> element
        init: function(){},               // Function: Init callback
        open: function(){},               // Function: Open callback
        close: function(){}               // Function: Close callback
      });
    </script>