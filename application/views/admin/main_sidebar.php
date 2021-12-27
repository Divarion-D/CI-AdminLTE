<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="/upload/Logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <?php if ($admin_prefs['user_panel'] == TRUE) : ?>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url('upload/avatar/m_001.png'); ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $user_login['firstname'] . $user_login['lastname']; ?></a>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($admin_prefs['sidebar_form'] == TRUE) : ?>
            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo site_url('/'); ?>" class="nav-link">
                        <i class="fa fa-home"></i>
                        <p>
                            <?php echo trans('menu_access_website'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-header"><?php echo trans('menu_main_navigation'); ?></li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo trans('menu_dashboard'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-header"><?php echo trans('menu_administration'); ?></li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/users'); ?>" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p>
                            <?php echo trans('menu_users'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/groups'); ?>" class="nav-link">
                        <i class="fas fa-lock"></i>
                        <p>
                            <?php echo trans('menu_security_groups'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cogs"></i>
                        <p>
                            <?php echo trans('menu_preferences'); ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('admin/prefs/interfaces/admin'); ?>" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo trans('menu_interfaces'); ?></p>
                            </a>
                        </li>
                    </ul>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/files'); ?>" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>
                            <?php echo trans('menu_files'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/database'); ?>" class="nav-link">
                        <i class="fa fa-file"></i>
                        <p>
                            <?php echo trans('menu_database_utility'); ?>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>