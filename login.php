<?php if(!isset($Translation)){ @header('Location: index.php?signIn=1'); exit; } ?>
<?php if(MULTI_TENANTS) redirect(SaaS::loginUrl(), true); ?>
<?php include_once(__DIR__ . '/headerlogin.php'); ?>

<?php if(Request::val('loginFailed')) { ?>
	<div class="alert alert-danger"><?php echo $Translation['login failed']; ?></div>
<?php } ?>
<div class="row">
	<div class="col-sm-8 col-lg-5" id="login_splash">
		<!-- customized splash content here -->
	</div>
	<div class="col-sm-offset-3 col-lg-6">
		<div class="panel panel-success">


              <div class="panel-heading">
				<h1 class="panel-title"><p align="center">LDTCS GMT Fleet Maintenance System</p></h1>
				<div class="clearfix"></div>
			</div>

			<div class="panel-body">
				<?php if(sqlValue("SELECT COUNT(1) from `membership_groups` WHERE `allowSignup`=1")) { ?>
					<a class="btn btn-success btn-lg pull-right" href="membership_signup.php"><?php echo $Translation['sign up']; ?></a>
					<div class="clearfix"></div>
				<?php } ?>

				<form method="post" action="index.php">
					<div class="form-group">
						<label class="control-label" for="username"><img src="images/identifications.png" /><?php echo $Translation['username']; ?></label>
                        <input class="form-control" name="username" id="username" type="text" placeholder="<?php echo $Translation['username']; ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="password"><img src="images/locks.png" /><?php echo $Translation['password']; ?></label>
						<input class="form-control" name="password" id="password" type="password" placeholder="<?php echo $Translation['password']; ?>" required>
						
					</div>
					

					<div class="row">
						<div class="col-sm-offset-3 col-sm-6">
							<button name="signIn" type="submit" id="submit" value="signIn" class="btn btn-primary btn-lg btn-block"><?php echo $Translation['sign in']; ?></button>
						</div>
					</div>
				</form>
			</div>

			<?php if(is_array(getTableList()) && count(getTableList())) { /* if anon. users can see any tables ... */ ?>
				<div class="panel-footer">
					<?php echo $Translation['browse as guest']; ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<script>document.getElementById('username').focus();</script>
<?php include_once(__DIR__ . '/footer.php');
