<!DOCTYPE html>
<?php if(!defined('PREPEND_PATH')) define('PREPEND_PATH', ''); ?>
<?php if(!defined('datalist_db_encoding')) define('datalist_db_encoding', 'UTF-8'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="<?php echo datalist_db_encoding; ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php echo $LTE_globals['app-title-prefix']; ?><?php echo (isset($x->TableTitle) ? $x->TableTitle : ''); ?></title>
		<link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>images/favicon.ico">

		<!-- LTE adding -->
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/dist/css/AdminLTE.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/dist/css/skins/_all-skins.css">
		<!-- /LTE adding -->
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/lightbox/css/lightbox.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/select2/select2.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/datepicker/css/datepicker.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/bootstrap-datetimepicker/bootstrap-datetimepicker.css" media="screen">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>hooks/mpi.css">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dynamic.css.php">
		<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>myCustom.css" mediad="screen">
		<!--[if lt IE 9]>
			<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->

		<!-- jQuery 3 -->
		<script src="LTE/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/fastclick/lib/fastclick.js"></script>
		<!-- <script src="<?php //echo PREPEND_PATH; ?>resources/jquery/js/jquery-1.12.4.min.js"></script> -->
		<script>var $j = jQuery.noConflict();</script>
		<script src="<?php echo PREPEND_PATH; ?>LTE/dist/js/adminlte.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>LTE/dist/js/appginiAdminlte.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/moment/moment-with-locales.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery.mark.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/scriptaculous.js?load=effects"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/select2/select2.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/jscookie/js.cookie.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/datepicker/js/datepicker.packed.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>resources/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>hooks/mpi.js"></script>
		<script src="<?php echo PREPEND_PATH; ?>common.js.php"></script>
		<script>getMpi({cmd:'u'},true,false);</script>      

		<?php if(isset($x->TableName) && is_file(dirname(__FILE__) . "/hooks/{$x->TableName}-tv.js")){ ?>
			<script src="<?php echo PREPEND_PATH; ?>hooks/<?php echo $x->TableName; ?>-tv.js"></script>
		<?php } ?>

	</head>
	<body class="hold-transition skin-black-light fixed sidebar-mini">
		<div  class="wrapper">
			<?php if(function_exists('handle_maintenance')) echo handle_maintenance(true); ?>

                        <?php
                        $memberInfo = getMemberInfo();
                        ?>

			
			<?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/header-extras.php')){ include(dirname(__FILE__).'/hooks/header-extras.php'); } ?>
			<?php if(class_exists('Notification')) echo Notification::placeholder(); ?>

			<?php if($_REQUEST['Embedded']){ ?>
				<!-- process notifications -->
				<div style="height: 65px; margin: 5px 0px -25px;">
					<?php if(function_exists('showNotifications')) echo showNotifications(); ?>
				</div>
				<?php return; ?>
			<?php } ?>
				
				<?php include('header_lte_main.php'); ?>
				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
					<!-- Content Header (Page header) -->
                      <section class="content-header">
						  
					  </section>
                	  <!-- /.content HEADER -->
						  <section class="content container-fluid">
							  
						  <?php 
							  $call = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
							  if(isset($_GET['loginFailed']) || isset($_GET['signIn']) || $call == "membership_passwordReset.php" || $call == "membership_signup.php"){
								
								?>
								<script>
									$j("body").removeClass();
									$j("body").addClass("skin-blue fixed layout-top-nav");
									$j(".sidebar-toggle").remove();
									$j(".logo").remove();
									$j(".navbar-custom-menu ul").prepend('<li><a href="index.php?signIn=1"><i class="fa fa-fw fa-caret-left"></i> Back to login</a></li>');
								</script>
								<?php
								
								return;}
							  ?>
							  <!-- Left side column. contains the logo and sidebar -->
							  <?php include ('header_lte_leftSideMenu.php') ?>
								<!-- process notifications -->
								<div style="height: 65px; margin: -25px 0 -25px;">
									<?php if(function_exists('showNotifications')) echo showNotifications(); ?>
								</div>
							  
