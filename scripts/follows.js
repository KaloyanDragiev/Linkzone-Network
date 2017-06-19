var Follows = {
    follow: function(id) {
        //console.log("follow " + id);
        
        var url = "includes/receiver.php?req=follow";
        url += "&userid=" + encodeURIComponent(id);
        
        $.getJSON(url, function(response) {
            alert(response.msg);
            User.readUsers(1);
        });
    },
    
    unfollow: function(id) {
        //console.log("unfollow " + id);
        
        var url = "includes/receiver.php?req=unfollow";
        url += "&followid=" + encodeURIComponent(id);
        
        $.getJSON(url, function(response) {
            alert(response.msg);
            User.readUsers(1);
        });
    }
}