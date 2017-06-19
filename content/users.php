<div class="row">
    <div class="col-md-3">
<?php
include_once(dirname(__FILE__) . '/sidebar.php');

?>
    </div>
	
    <div class="col-md-9" style="border-radius: 4px;background-color: #fff;border: 1px solid #ddd;">
			<form class="form-horizontal">
			<h1 style="font-size:40px;margin-top: 10px;">Search for users<h1>
		  <div class="form-group" >
			<div class="col-sm-10">
			  <input type="text" class="form-control" id="username" placeholder="Username" style="width:40%">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <a href="javascript:User.readUsers();" class="btn btn-primary" style="margin-top: -112px;margin-left: 151px;"><span class="glyphicon glyphicon-search" /></a>
			</div>
		  </div>
		</form>
		<hr style="margin-top: -15px;border-top: 1px solid black;"/>
        <ul id="ulUsers" style="font-size: 19px;"></ul>
        <br style="clear:both;" />
        <div class="row pull-right">
            <div class="col-md-12">
                <label style="font-size: 23px;">Page: </label>
                <div class="btn-group" role="group" id="divPages"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        User.readUsers(1);
    });
</script>