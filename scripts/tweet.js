var Tweet = {
    getDashboard: function(page) {
        var url = 'includes/receiver.php?req=get_dashboard';
        url += '&page=' + encodeURIComponent(page);

        $.getJSON(url, function(response){
            var ulSrc = "", i, pageSrc = "";
console.log(response);
            for (i = 0;i < response.tweets.length;i++) {
                ulSrc += "<li>";
                // Tweet
                ulSrc += "<div class=\"thumbnail\">";
                ulSrc += "<div class=\"caption-full\">";
                ulSrc += "<h4 class=\"pull-right\">";
                if (response.tweets[i].tours == "yes") {
                    ulSrc += "<a href=\"edit-tweet/" + response.tweets[i].tid + "\" class=\"glyphicon glyphicon-wrench\"></a>&nbsp;&nbsp;"
                }
                ulSrc += response.tweets[i].tcreated;
                ulSrc += "</h4>";
                ulSrc += "<h4>";
                ulSrc += "<a class=\"idk/" + response.tweets[i].uid + "\">" + (response.tweets[i].ufname || "") + " " + (response.tweets[i].ulname || "") +"</a>";
                ulSrc += "</h4>";
                ulSrc += "<p style=\"word-wrap: break-word\">" + (response.tweets[i].ttext || "") + "</p>";
                ulSrc += "<hr />";
                ulSrc += "<a href=\"javascript:Tweet.like(" + response.tweets[i].tid + ");\"><span class=\"glyphicon glyphicon-thumbs-up\"></span> Like</a>";
                ulSrc += "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"javascript:Tweet.showComments(" + response.tweets[i].tid + ");\"><span class=\"glyphicon glyphicon-comment\"></span> Comment</a>";
                // Likes
                if (response.tweets[i].luser === null) {
                    ulSrc += "<span class=\"pull-right\">Be first who like<span>";
                } else {
                    ulSrc += "<span class=\"pull-right\">" + response.tweets[i].luser + " liked this<span>";
                }
                // End Likes
                ulSrc += ", " + response.tweets[i].tcomments + " comments";
                
                ulSrc += "</div>";
                ulSrc += "</div>";
                
                // Komentari
				// style=\"border-radius: 4px;background-color: #fff;border: 1px solid #ddd;\"
                ulSrc += "<div class=\"well commentform\" id=\"commentform_" + response.tweets[i].tid + "\">";
                ulSrc += "<div class=\"row\" >";
                ulSrc += "<div class=\"col-md-10\" >";
                ulSrc += "<textarea class=\"form-control\" rows=\"1\"></textarea>";
                ulSrc += "</div>";
                ulSrc += "<div class=\"col-md-2\">";
                ulSrc += "<button class=\"btn btn-primary\" onclick=\"Tweet.comment(" + response.tweets[i].tid + ");\">Comment</button>";
                ulSrc += "</div>";
                ulSrc += "</div>";
                
                ulSrc += "<hr  style=\"border-top: 1px solid; width:798px;\"/>";
                ulSrc += "<div class=\"comments-list\"></div>";
                
                ulSrc += "</div>";
                ulSrc += "</li>";
            }
            
            $("#ulDashboard").html(ulSrc);
            
            var minPage = Math.max(1, page - 3);
            var maxPage = Math.min(response.pages, page + 3);
            for (var i = minPage;i <= maxPage;i++) {
                var btnType = i == page ? "btn-primary" : "btn-default";
                pageSrc += "<a class=\"btn " + btnType + "\" href=\"javascript:Tweet.getDashboard(" + i + ");\">" + i + "</a>";
            }
            
            $("#divPages").html(pageSrc);
        });
    },
    
    add: function() {
        var url = 'includes/receiver.php?req=add_tweet';
        url += '&text=' + encodeURIComponent($("#areaTweet").val());
        
        $.getJSON(url, function(response){
            alert(response.msg);
            $("#areaTweet").val("");
        });
    },
    
    getOne: function(tid) {
        var url = '../includes/receiver.php?req=get_tweet';
        url += '&tid=' + tid;

        $.getJSON(url, function(response){
            $("#areaTweet").val(response.tweet.ttext);
        });
    },
    
    update: function(tid) {
        var url = '../includes/receiver.php?req=update_tweet';
        url += '&tid=' + tid;
        url += '&text=' + encodeURIComponent($("#areaTweet").val());

        $.getJSON(url, function(response){
            alert(response.msg);
        });
    },
    
    like: function(tid) {
        var url = 'includes/receiver.php?req=like_tweet';
        url += '&tid=' + tid;

        $.getJSON(url, function(response){
        });
    },
    
    showComments: function(tid, autohide) {
        if ($("#commentform_" + tid).is(":hidden")) {
            $("#commentform_" + tid).fadeIn();
        } else {
            if (autohide !== false) {
                $("#commentform_" + tid).fadeOut();
            } 
        }
        
        var commentSrc = "", i;
        var url = 'includes/receiver.php?req=get_comments';
        url += '&tid=' + tid;

        $.getJSON(url, function(response){
            for (i = 0;i < response.comments.length;i++) {
                //commentSrc += "<hr  style=\"border-top: 1px solid; width:798px;\"/>";
                commentSrc += "<div class=\"row\" style=\"border-radius: 4px;background-color: #fff;border: 1px solid #ddd;\">";
                commentSrc += "<div class=\"col-md-12\">";
                commentSrc += "<label>" + response.comments[i].uuname + "</label>";
                commentSrc += "<span class=\"pull-right\">" + response.comments[i].ccreated + "</span>";
                commentSrc += "<p>" + response.comments[i].ctext + "</p>";
                commentSrc += "</div>";
                commentSrc += "</div>";
            }
            
            $("#commentform_" + tid + " .comments-list").html(commentSrc);
        });
    },
    
    comment: function(tid) {
        var url = 'includes/receiver.php?req=comment';
        url += '&tid=' + tid;
        url += '&text=' + encodeURIComponent($("#commentform_" + tid + " textarea").val());

        $.getJSON(url, function(response){
            $("#commentform_" + tid + " textarea").val("");
            Tweet.showComments(tid, false);
           // alert(response.msg);
        });
    }
}