<div style="height: 740px;width: 145%;background-color: hsla(213,102%,66%,0.3);margin-left: -246px;top: 24px;">
<h1 id="kur" style="color: rgb(8, 159, 239); font-size:5em; margin-left: 205px; font-family: Lucida Sans Typewriter;">Linkzone</h1>
<hr  style="border-color:#089FEF; margin-top:0px;"/>
    <div class="intro-header">
        <div class="container" style="margin-left: 360px;">
				<div class="intro-message" style="top: -11px; margin-left:-62px;">
					<h1 style="margin-left:-911px">Follow your dreams</h1>
					<h3 class="FirstText">Instant updates from your friends, industry experts, favorite</h3>
					<h3 class="FirstText">celebrities, and what's happending around the world.</h3>
					<hr class="intro-divider" style="margin-left:-86px">
				</div>
				<div style="margin-top: -589px;margin-left: 800px;">
						<h2 style="color: rgb(8, 159, 239);">Sign in</h2>
					  <div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
						    <input type="text" class="form-control" id="username" placeholder="Username">
					</div>
					<br />
					  <div class="input-group input-group-lg">
						  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
						  <input type="password" class="form-control" id="password" placeholder="Password">
					  </div>
					  <div class="col-md-6" style="margin-top: 7px;">
							<a style=" color:rgb(8, 159, 239)" href="<?php echo MAIN_URL;?>register">Create new account</a>
						</div>
					  <div class="col-md-6" style="margin-top: 7px;">
							<a href="<?php echo MAIN_URL;?>reset" class="pull-right" style="color: rgb(8, 159, 239);">Forgot password?</a>
						</div>
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <a href="javascript:User.login()" class="float" style="color:white">Login</a>
						</div>
					  </div>
				</div>
			</div>
        </div>
    </div>
       <p class="copyright text-muted small">Copyright &copy; Linkzone 2016. All Rights Reserved</p>
				
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
	$(document).ready(function(){
		User.loadCookies();
	});
	</script>