<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $page_title; ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo trans('users_create_user'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo $message; ?>

                        <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'id' => 'form-create_user')); ?>
                        <div class="form-group">
                            <?php echo trans('users_firstname', 'first_name', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-10">
                                <?php echo form_input($first_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo trans('users_lastname', 'last_name', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-10">
                                <?php echo form_input($last_name); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo trans('users_email', 'email', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-10">
                                <?php echo form_input($email); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo trans('users_password', 'password', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-10">
                                <?php echo form_input($password); ?>
                                <div class="progress" style="margin:0">
                                    <div class="pwstrength_viewport_progress"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo trans('users_password_confirm', 'password_confirm', array('class' => 'col-sm-2 control-label')); ?>
                            <div class="col-sm-10">
                                <?php echo form_input($password_confirm); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="btn-group">
                                    <?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-flat', 'content' => trans('actions_submit'))); ?>
                                    <?php echo form_button(array('type' => 'reset', 'class' => 'btn btn-warning btn-flat', 'content' => trans('actions_reset'))); ?>
                                    <?php echo anchor('admin/users', trans('actions_cancel'), array('class' => 'btn btn-default btn-flat')); ?>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>