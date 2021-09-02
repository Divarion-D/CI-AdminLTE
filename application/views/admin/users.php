<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
									<h3 class="box-title"><?php echo anchor('admin/users_create', '<i class="fa fa-plus"></i> '. trans('users_create_user'), array('class' => 'btn btn-block btn-primary btn-flat')); ?></h3>
								</div>
								<div class="box-body">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th><?php echo trans('users_firstname');?></th>
												<th><?php echo trans('users_lastname');?></th>
												<th><?php echo trans('users_email');?></th>
												<th><?php echo trans('users_groups');?></th>
												<th><?php echo trans('users_status');?></th>
												<th><?php echo trans('users_action');?></th>
											</tr>
										</thead>
										<tbody>
<?php foreach ($users as $user):?>
											<tr>
												<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
												<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
												<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
												<td>
<?php

foreach ($user->groups as $group)
{

	// Disabled temporary !!!
	// echo anchor('admin/groups_edit/'.$group->id, '<span class="label" style="background:'.$group->bgcolor.';">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
	echo anchor('admin/groups_edit/'.$group->id, '<span class="label label-default">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>');
}

?>
												</td>
												<td><?php echo ($user->active) ? anchor('admin/users_deactivate/'.$user->id, '<span class="label label-success">'.trans('users_active').'</span>') : anchor('admin/users_activate/'. $user->id, '<span class="label label-default">'.trans('users_inactive').'</span>'); ?></td>
												<td>
													<?php echo anchor('admin/users_edit/'.$user->id, trans('actions_edit')); ?>
													<?php echo anchor('admin/users_profile/'.$user->id, trans('actions_see')); ?>
												</td>
											</tr>
<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
						 </div>
					</div>
				</section>
			</div>
