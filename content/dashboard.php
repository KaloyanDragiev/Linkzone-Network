<div class="row">
    <div class="col-md-3">
<?php
include_once(dirname(__FILE__) . '/sidebar.php');
?>
    </div>
    <div class="col-md-9">
        <ul id="ulDashboard"></ul>
        <br style="clear:both;" />
        <div class="row pull-right">
            <div class="col-md-12" >
                <label>Page: </label>
                <div class="btn-group" role="group" id="divPages"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        Tweet.getDashboard(1);
    });
</script>