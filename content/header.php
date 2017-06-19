<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background:black">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
<?php
if ($_SESSION["user"]["id"] > 0):
?>
            <a class="navbar-brand" href="<?php MAIN_URL;?>dashboard"style="font-size: 23px;font-style: italic;">Linkzone</a>
<?php
else:
?>
            <a class="navbar-brand" href="<?php MAIN_URL;?>home"style="font-size: 23px;    font-style: italic;">Linkzone</a>
<?php
endif;
?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo MAIN_URL;?>users">Users</a>
                </li>
				<li>
                    <a href="<?php echo MAIN_URL;?>profile">Profile</a>
                </li>
            </ul>
			
			<img src="img/ltrain.png"  style="width: 48px;margin-left: 354px;">
			
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                <ul class="dropdown-menu">
				<li>
                        <a class="glyphicon glyphicon-user" href="http://linkzone.dragiev.net/profile"> Profile</a>
                </li>
<?php
if ($_SESSION["user"]["id"] > 0):
?>
                    <li class="divider"></li>
                    <li>
                        <a class="glyphicon glyphicon-off" href="javascript:User.logout();" style="margin-top: -8px;"> Logout</a>
                    </li>
<?php
else:
?>
					<hr />
                    <li>
                        <a class="glyphicon glyphicon-wrench" href="<?php echo MAIN_URL;?>login" style="margin-top: -21px;"> Login</a>
                    </li>
<?php
endif;
?>
                </ul>
              </li>
              <li>
                
              </li>
            </ul>
<?php
if ($_SESSION["user"]["id"] > 0):
?>
            <form class="navbar-form navbar-right">
                <a href="<?php echo MAIN_URL;?>tweet" class="btn btn-default">
                    <span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Post 
                </a>
            </form>
<?php
endif;
?>
        </div>
    </div>
</nav>