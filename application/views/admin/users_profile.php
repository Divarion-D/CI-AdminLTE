<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
		<h1><?php echo $page_title; ?></h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">xxxx</h3>
					</div>
					<div class="box-body">
						<table class="table table-striped table-hover">
							<tbody>
								<?php foreach ($user_info as $user) : ?>
									<tr>
										<th><?php echo trans('users_ip_address'); ?></th>
										<td><?php echo $user->ip_address; ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_firstname'); ?></th>
										<td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_lastname'); ?></th>
										<td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_username'); ?></th>
										<td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_email'); ?></th>
										<td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_created_on'); ?></th>
										<td><?php echo date('d-m-Y', $user->created_on); ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_last_login'); ?></th>
										<td><?php echo (!empty($user->last_login)) ? date('d-m-Y', $user->last_login) : NULL; ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_status'); ?></th>
										<td><?php echo ($user->active) ? '<span class="label label-success">' . trans('users_active') . '</span>' : '<span class="label label-default">' . trans('users_inactive') . '</span>'; ?></td>
									</tr>
									<tr>
										<th><?php echo trans('users_groups'); ?></th>
										<td>
											<?php foreach ($user->groups as $group) : ?>
												<?php // Disabled temporary !!! 
												?>
												<?php //echo '<span class="label" style="background:'.$group->bgcolor.'">'.htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8').'</span>'; 
												?>
												<?php echo '<span class="label label-default">' . htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8') . '</span>'; ?>
											<?php endforeach ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">xxxx</h3>
					</div>
					<div class="box-body">


					</div>
				</div>
			</div>
		</div>
	</section>
</div>