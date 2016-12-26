<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_199") ?> <?php echo $user->username ?></div>
    <div class="db-header-extra">
</div>
</div>

<div class="profile-area">
	<div class="profile-sidebar">
		<div class="profile-user">
		<table>
		<tr>
		<td width="95">
		<img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $user->avatar ?>">
		</td>
		<td valign="top">
			<h4><?php echo $user->username ?></h4><p class="user_level_display">
			<?php echo $this->common->getAccessLevel($user->user_level) ?></p>
		</td>
		</tr>
		</table>
		</div>
		<div class="profile-info">
		<table class="table-profile">
		<tr><td class="profile-info-label"><?php echo lang("ctn_201") ?></td><td class="profile-info-content"><?php echo $user->first_name ?> <?php echo $user->last_name ?></td></tr>
		<tr><td class="profile-info-label"><?php echo lang("ctn_202") ?></td><td class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->joined) ?></td></tr>
		<tr><td class="profile-info-label"><?php echo lang("ctn_203") ?></td><td class="profile-info-content"><?php echo date($this->settings->info->date_format, $user->online_timestamp) ?></td></tr>
		</table>
		</div>
		<div class="profile-info-p2">
		<h5>Mudulos de Acceso</h5>
		<p><?php echo nl2br($user->aboutme) ?></p>
		<?php if($groups->num_rows() > 0) : ?>
			<?php foreach($permisos->result() as $r) : ?>
				<label class="label label-default"><?php echo $r->modulo ?></label>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>
	</div>
	<div class="profile-main">
		<div class="profile-main-content">
		<h4 class="home-label">Centro de Costos del Usuario</h4>
		<table class="table table-striped table-bordered table-hover">
			<tr class="table-header">
				<th>Clave</th>
				<th>Descripcion</th>
			</tr>
			<?php foreach($groups->result() as $r) : ?>
			<tr>
				<td><?php echo $r->idCentroCostos ?></td>
				<td><?php echo $r->descripcion ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
</div>
