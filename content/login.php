<br /><br /><br /><br /><br /><br /><br />

<div class="row" style="background-color: #fff;border: 1px solid #ddd;border-radius: 4px;height: 341px;">
	<h1 style="margin-left: 537px;margin-top: 14px;">Login</h1>
			<hr />
	<div class="col-md-6 col-md-offset-3">
		<form class="form-horizontal">
		  <div class="form-group">
			<label for="username" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="username" placeholder="Username">
			</div>
		  </div>
		  <div class="form-group">
			<label for="password" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" id="password" placeholder="Password">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <div class="checkbox">
				<label>
				  <input type="checkbox" id="rememberme"> Remember me
				</label>
			  </div>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <a href="javascript:User.login()" class="btn btn-primary">Sign in</a>
			</div>
		  </div>
		</form>
		<div class="row">
			<div class="col-md-6">
				<a href="<?php echo MAIN_URL;?>register">Create new account</a>
			</div>
			<div class="col-md-6">
				<a href="<?php echo MAIN_URL;?>reset" class="pull-right">Forgot password?</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		User.loadCookies();
	});
</script>