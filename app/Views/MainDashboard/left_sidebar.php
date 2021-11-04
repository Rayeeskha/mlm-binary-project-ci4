    <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?= base_url('MainDashboard/index'); ?>">
                                    <span class="fa fa-users"></span>&nbsp;Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('MainDashboard/new_registration'); ?>"><i class="fab fa-fw fa-wpforms"></i>New Registration</a>
                               
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-fw fa-inbox"></i>E-Pin</a>
                                
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#"><i class="fab fa-fw fa-wpforms"></i>Income</a>
                                
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i> DownLine </a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('MainDashboard/down_line_user_info'); ?>">Self Level</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="<?= base_url('MainDashboard/tree_downline'); ?>">Binary Tree Structure</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fas fa-fw fa-inbox"></i>Refer </a>
                                
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('MainDashboard/view_account'); ?>"><i class="fas fa-user"></i>Profile</a>
                                
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('MainDashboard/Logout'); ?>"><i class="fas fa-f fa-key"></i>Logout</a>
                               
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->