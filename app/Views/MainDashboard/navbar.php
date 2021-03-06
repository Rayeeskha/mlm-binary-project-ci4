    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="#!">
                    <img src="<?= base_url('public/assets/images/mlm.png') ?>" style="width: 100px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                       <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if($userdata->profile): ?>
                                <img src="<?= base_url('public/uploads/user_image/'.$userdata->profile); ?>" alt="" class="user-avatar-md rounded-circle">
                                <?php else: ?>
                                    <img src="<?= base_url('public/assets/images/mlm.png') ?>" alt="" class="user-avatar-md rounded-circle">
                                <?php endif; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?= $userdata->name; ?> </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="<?= base_url('MainDashboard/view_account'); ?>"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="<?= base_url('MainDashboard/user_profile_settings'); ?>"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="<?= base_url('MainDashboard/Logout'); ?>"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->


        