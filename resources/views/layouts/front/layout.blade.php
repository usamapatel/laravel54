<!DOCTYPE html>
<!--
Template: Metronic Frontend Freebie - Responsive HTML Template Based On Twitter Bootstrap 3.3.4
Version: 1.0.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase Premium Metronic Admin Theme: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!-- BEGIN HEAD -->
	<head>
		@include('elements.front.stylesheets')
	</head>
	<!-- END HEAD -->
	
	<body class="page-header-fixed">
	<!-- Header BEGIN -->
		<header class="page-header">
			@include('elements.front.header')
		</header>
	<!-- Header END -->

		@yield('page-introduction')		
	
		<div class="page-content">
			@yield('page-content')
			<!-- BEGIN CONTACT SECTION -->
		    <section id="contact">
		        <!-- Footer -->
					@include('elements.front.footer')
		        <!-- End Footer Coypright -->
		    </section>
		    <!-- END CONTACT SECTION -->
		</div>
		<a href="#intro" class="go2top"><i class="fa fa-arrow-up"></i></a>
		@include('elements.front.javascripts')
	</body>
</html>