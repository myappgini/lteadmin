<?php
$currDir = dirname(__FILE__);
include("{$currDir}/../defaultLang.php");
include("{$currDir}/../language.php");
include("{$currDir}/../lib.php");
?>
<!DOCTYPE html>
<?php if (!defined('PREPEND_PATH')) define('PREPEND_PATH', '../'); ?>
<?php if (!defined('datalist_db_encoding')) define('datalist_db_encoding', 'UTF-8'); ?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="<?php echo datalist_db_encoding; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ERROR 403</title>
    <link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>LTE/logo/favicon.ico">

    <!-- LTE adding -->
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>LTE/dist/css/skins/_all-skins.css">
    <!-- add rtl css if configured-->
    <?php if ($LTE_globals['app-dir-RTL-enable']) { ?>
        <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/rtl.css">
    <?php } ?>
    <!--[if lt IE 9]>
			<script src="<?php echo PREPEND_PATH; ?>resources/initializr/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<![endif]-->

    <!-- jQuery 3 -->
    <script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>LTE/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?php echo PREPEND_PATH; ?>LTE/dist/js/adminlte.js"></script>
    <script>
        var $j = jQuery.noConflict();
    </script>
    <script src="<?php echo PREPEND_PATH; ?>common.js.php"></script>

</head>

<body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">




    <div class="error-page">
        <h2 class="headline text-yellow ">403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow "></i> Oops! Something went wrong.</h3>

          <p>
            We will work on fixing that right away.
            Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
          </p>

        </div>
      </div>






        <h1 class="error-code text-center mb-2">403</h1>
        <h2 class="headline text-yellow ">403</h2>
        <div class="lockscreen-logo">
            <a href="../index.php"><b>Landini Admin</b>LTE</a>
        </div>
        <!-- User name -->
        <div class="lockscreen-name">John Doe</div>

        <!-- START LOCK SCREEN ITEM -->
        <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
                <img src="../../dist/img/user1-128x128.jpg" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->


        </div>
        <!-- /.lockscreen-item -->
        <div class="help-block text-center">
            Enter your password to retrieve your session
        </div>
        <div class="text-center">
            <a href="login.html">Or sign in as a different user</a>
        </div>
        <div class="lockscreen-footer text-center">
            Copyright &copy; 2014-2016 <b><a href="https://adminlte.io" class="text-black">Almsaeed Studio</a></b><br>
            All rights reserved
        </div>
    </div>
    <!-- /.center -->

</body>

</html>