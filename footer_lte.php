
        </section>
            <!-- /.content HEADER -->
    </section>
        <!-- /.content FLUID-->


    </div> <!-- /div class="container" -->

    </div>
      <!-- /.content-wrapper -->
        <!-- Main Footer -->
<?php if(!$_REQUEST['Embedded']){ ?>
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
              Anything you want
            </div>
            <!-- Default to the left -->
            <strong>ALE &copy; 2019 <a href="#">Alejandro Landini powered</a>.</strong> All rights reserved.
            <!-- Add footer template above here -->
            <div class="clearfix"></div>
            <?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/footer-extras.php')){ include(dirname(__FILE__).'/hooks/footer-extras.php'); } ?>
            <script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
        </footer>
<?php } ?>
    <!-- /boody -->
    </body>
</html>