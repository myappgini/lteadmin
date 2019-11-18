  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-stats-tab" data-toggle="tab"><i class="fa fa-plus"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" style="padding: 10px; border: 0; border-top: none; " >
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
      </div>
      <!-- /Home .tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">
        <h3 class="control-sidebar-heading">Stats Tab Content</h3>
      </div>
      <!-- /Stats .tab-pane -->
      <?php if(getLoggedAdmin()){ ?>
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="col-xs-6 text-center">
              <a href="<?php echo PREPEND_PATH; ?>LTE/jsonedit.php" class="btn btn-app" title="Open app anviroment options"><i class="fa fa-cogs"></i>&nbsp;App anviroment</a>
          </div>
        </div>
        <!-- /Settings .tab-pane -->
      <?php } ?>
      
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

