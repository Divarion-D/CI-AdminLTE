<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-balance-scale-right"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Licence</span>
                            <span class="info-box-number">Free</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">AdminLTE version</span>
                            <span class="info-box-number">3.1.0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number"><?php echo $count_users; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-user-shield"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Security groups</span>
                            <span class="info-box-number"><?php echo $count_groups; ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-md-6">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Disk use space</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="?php echo $disk_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $disk_usepercent; ?>%">
                                    <span><?php echo byte_format($disk_usespace, 2); ?>/<?php echo byte_format($disk_totalspace, 2); ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Memory usage</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?php echo $memory_usepercent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $memory_usepercent; ?>%">
                                    <span><?php echo byte_format($memory_usage, 2); ?></strong>/<?php echo byte_format($memory_peak_usage, 2); ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->