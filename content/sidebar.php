<?php
$tweet_obj = new Tweet();
$stats = $tweet_obj->get_stats();
?>
<div id="sidebar" style="border-radius: 4px;background-color: #fff;border: 1px solid #ddd;width: 100%;">
<br />
    <div class="row" style="margin-left: -9px;margin-top: -13px;">
        <div class="col-md-3">
            <img class="avatar" src="<?php echo MAIN_URL . "media/avatars/" . $_SESSION["user"]["avatar"];?>" alt="<?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];?>" />
        </div>
        <div class="col-md-9">
            <h4><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"];?></h4>
            <div class="text-muted"><i><?php echo $_SESSION["user"]["username"];?></i></div>
            <div><small>Created <?php echo $_SESSION["user"]["created"];?></small></div>
        </div>
    </div>
    <br />
    <div class="row" style="margin-left: -5px;">
        <div class="col-md-4">
            <h6>
                <small class="text-muted">POSTS</small>
            </h6>
            <h3 id="h3Tweets"><?php echo $stats["tweets"];?></h3>
        </div>
        <div class="col-md-4">
            <h6>
                <small class="text-muted">FOLLOWING</small>
            </h6>
            <h3 id="h3Following"><?php echo $stats["following"];?></h3>
        </div>
        <div class="col-md-4">
            <h6>
                <small class="text-muted">FOLLOWERS</small>
            </h6>
            <h3 id="h3Followers"><?php echo $stats["followers"];?></h3>
        </div>
    </div>
</div>