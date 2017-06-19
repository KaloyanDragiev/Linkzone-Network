<div class="row">
    <div class="col-md-3">
<?php
include_once(dirname(__FILE__) . '/sidebar.php');
?>
    </div>
    <div class="col-md-9">
        <h1>Compose New Comment</h1>
        <br />
        <form>
            <textarea class="form-control" rows="3" id="areaTweet" placeholder="What's on your mind?" ></textarea>
        </form>
        <br />
        <button class="btn btn-primary btn-lg pull-right" onclick="Tweet.add();">
            <span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Comment
        </button>
    </div>
</div>