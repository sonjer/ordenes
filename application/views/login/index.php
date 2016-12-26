<div class="container">
    <div class="row">
    <div class="col-md-5 center-block-e">

<div class="login-page-header">
  <?php echo lang("ctn_178") ?><?php echo $this->settings->info->site_name ?>

</div>

<div class="login-page">



				<?php echo form_open(site_url("login/pro")) ?>
				<p class="sans-big-text"><?php echo lang("ctn_179") ?></p>
    			<div class="input-group">
      				<span class="input-group-addon">@</span>
      				<input type="text" name="email" class="form-control">
    			</div><br />

    			<p class="sans-big-text"><?php echo lang("ctn_180") ?></p>
    			<div class="input-group">
      				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
      				<input type="password" name="pass" class="form-control">
    			</div>
          <p class="decent-margin"><input type="submit" class="btn btn-warning form-control" value="<?php echo lang("ctn_184") ?>"></p>

          <hr>

    			<?php echo form_close() ?>

<?php if(!$this->settings->info->disable_social_login) : ?>
<p class="align-center decent-margin-top"><a href="<?php echo site_url("login/twitter_login") ?>"><img src="<?php echo base_url() ?>images/social/twitter.png"></a> <a href="<?php echo site_url("login/facebook_login") ?>"><img src="<?php echo base_url() ?>images/social/facebook.png" width="158"></a> <a href="<?php echo site_url("login/google_login") ?>"><img src="<?php echo base_url() ?>images/social/google.png" width="158"></a></p>
<?php endif; ?>

<p class="align-center decent-margin-top"><?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?></a></p>

</div>

</div>
</div>
</div>
