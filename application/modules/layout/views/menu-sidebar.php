            <div id="sidebar" class="sidebar responsive ace-save-state sidebar-scroll sidebar-fixed">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

                <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success" onclick="location.href='<?php echo base_url()?>dashboard'" >
                            <i class="ace-icon fa fa-signal"></i>
                        </button>

                        <button class="btn btn-info" onclick="location.href='<?php echo base_url()?>koperasi'">
                            <i class="ace-icon fa fa-list-alt"></i>
                        </button>

                        <button class="btn btn-warning" onclick="location.href='<?php echo base_url()?>users'">
                            <i class="ace-icon fa fa-users"></i>
                        </button>

                        <button class="btn btn-danger" onclick="location.href='<?php echo base_url()?>system'">
                            <i class="ace-icon fa fa-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span>
                    </div>
                </div --><!-- /.sidebar-shortcuts -->
                <!-- Menu start -->
                <?php echo display_menu(); ?>
                <!-- menu End -->
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>
            </div><!-- sidebar -->

            <!-- Main container tag open -->
            <div class="main-content">
                <div class="main-content-inner">
