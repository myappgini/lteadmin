
            
        </section>
            <!-- /.content FLUID-->

        </div>
        <!-- /.content-wrapper -->
            <!-- Main Footer -->
    <?php if(!$_REQUEST['Embedded']){ ?>
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                <?php echo $LTE_globals['footer-right-text']; ?>
                </div>
                <!-- Default to the left -->
                <?php echo $LTE_globals['footer-left-text']; ?>
                <!-- Add footer template above here -->
                <div class="clearfix"></div>
                <?php if(!defined('APPGINI_SETUP') && is_file(dirname(__FILE__) . '/hooks/footer-extras.php')){ include(dirname(__FILE__).'/hooks/footer-extras.php'); } ?>
            </footer>
            <?php 
        include "control_bar_lte.php";
    } ?>
        </div>
        <!-- /.wrapper -->
        <!-- /boody -->
        <script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/lightbox.min.js"></script>
    </body>
</html>