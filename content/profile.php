<div class="row">
	<br />
	<div id="sidebar" style="border-radius: 4px;background-color: #fff;border: 1px solid #ddd;width: 108%; height:357px;">
<br />
    <div class="row" style="margin-left: -9px;margin-top: -13px;">
        <div class="col-md-3">
            <img class="avatar" style="width: 165px; height:202px;margin-left: 20px;margin-top: 10px;" src="<?php echo MAIN_URL . "media/avatars/" . $_SESSION["user"]["avatar"];?>" alt="<?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];?>" />
        </div>
        <div class="col-md-9" style="margin-top: 9px;margin-left:30px">
            <h4><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];?></h4>
            <div class="text-muted"><i><?php echo $_SESSION["user"]["username"];?></i></div>
            <div><small>Created: <?php echo $_SESSION["user"]["created"];?></small></div>
        </div>
		<div style=" border-left-color:blue;border-left-style: solid;margin-left: 306px;">
		<div style="">
			<h4 style="display:inline"><span class="glyphicon glyphicon-user" ></span> Username: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["username"];?></h4>
				<br /><br />
			<h4 style="display:inline"><span class="glyphicon glyphicon-home" ></span> Address: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["address"];?></h4>
			<br /><br />
			<h4 style="display:inline"><span class="glyphicon glyphicon-earphone" ></span> Phone: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["phone"];?></h4>
				<br /><br />
			<h4 style="display:inline"><span class="glyphicon glyphicon-envelope" ></span> E-mail: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["email"];?></h4>
			<br /><br />
			<h4 style="display:inline"><span class="glyphicon glyphicon-lock" ></span> Job: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["job"];?></h4>
				<br /><br />
			<h4 style="display:inline;margin-left: -672px;"><span class="glyphicon glyphicon-star-empty" ></span> Interests: </h4>
				<h4 style="display:inline"><?php echo $_SESSION["user"]["interests"];?></h4>
			<br /><br />
		</div>
		<div style="margin-left: 382px;margin-top: -242px;border-left: 2px solid #ddd;">
		<h4 style="display:inline; margin-left:149px"><span class="glyphicon glyphicon-headphones" ></span> Music: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["music"];?></h4>
			<br /><br />
		<h4 style="display:inline; margin-left:149px"><span class="glyphicon glyphicon-lock" ></span> LastJob: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["lastjob"];?></h4>
			<br /><br />
		<h4 style="display:inline; margin-left:149px"><span class="glyphicon glyphicon-map-marker" ></span> Position: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["position"];?></h4>
			<br /><br />
		<h4 style="display:inline; margin-left:149px"><span class="glyphicon glyphicon-education" ></span> Education: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["education"];?></h4>
			<br /><br />
		<h4 style="display:inline; margin-left:149px"><span class="glyphicon glyphicon-earphone" ></span> Sport: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["sport"];?></h4>
			<br /><br />
		<h4 style="display:inline; margin-left:-149px"><span class="glyphicon glyphicon-film" ></span> Films: </h4>
            <h4 style="display:inline"><?php echo $_SESSION["user"]["films"];?></h4>
		</div>
    </div>
    <br />
	<hr style="margin-top: 63px;border-top: 2px solid #EEE;width: 1262px;margin-left: 9px;" />
</div>

</div>

<script>
    $(document).ready(function(){
        User.ReadWhatever(1);
    });
</script>