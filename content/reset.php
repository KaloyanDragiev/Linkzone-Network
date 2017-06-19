<br /><br /><br /><br /><br /><br /><br />

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<form class="form-horizontal">
		  <div class="form-group">
			<label for="username" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="username" placeholder="Username">
			</div>
		  </div>
		  <div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="email" placeholder="Email">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <a href="javascript:User.reset()" class="btn btn-primary">Reset</a>
			</div>
		  </div>
		</form>
		<div class="row">
			<div class="col-md-6">
				<a href="<?php echo MAIN_URL;?>login">Login</a>
			</div>
			<div class="col-md-6">
				<a href="<?php echo MAIN_URL;?>register" class="pull-right">Register</a>
			</div>
		</div>
	</div>
</div>