<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
        <p class="login-box-msg"><?php echo trans('auth_sign_session'); ?></p>
        <?php echo $message; ?>

        <?php echo form_open('auth/login'); ?>
        <div class="input-group mb-3">
            <?php echo form_input($identity, array('class' => 'form-control'));?>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <?php echo form_input($password);?>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <label for="remember">
                        <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?><?php echo trans('auth_remember_me'); ?>
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <?php echo form_submit('submit', trans('auth_login'), array('class' => 'btn btn-primary btn-block')); ?>
            </div>
            <!-- /.col -->
        </div>
        <?php echo form_close(); ?>
        <?php if ($auth_social_network == TRUE) : ?>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
            <!-- /.social-auth-links -->
        <?php endif; ?>
        <?php if ($forgot_password == TRUE) : ?>
            <?php echo anchor('#', trans('auth_forgot_password')); ?><br />
        <?php endif; ?>
        <?php if ($new_membership == TRUE) : ?>
            <?php echo anchor('#', trans('auth_new_member')); ?><br />
        <?php endif; ?>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->