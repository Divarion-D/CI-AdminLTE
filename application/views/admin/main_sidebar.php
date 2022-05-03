<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url('/'); ?>" class="brand-link">
        <img src="/upload/Logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
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
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            <?php echo trans('menu_dashboard'); ?>
                        </p>
                    </a>
                </li>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cogs"></i>
                        <p>
                            <?php echo trans('menu_seting'); ?>
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo site_url('admin/prefs_interfaces/admin'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?php echo trans('menu_interfaces'); ?></p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>