var User = {
    loadCookies: function() {
        var url = "includes/receiver.php?req=load_cookies";
        url += "&cookie=" + document.cookie;

        $.getJSON(url, function(response) {
            $("#username").val(response.un);
            $("#password").val(response.pw);
        });
    },
    
    login: function() {
        var url = "includes/receiver.php?req=login";
        url += "&username=" + encodeURIComponent($("#username").val());
        url += "&password=" + encodeURIComponent($("#password").val());
        url += "&rememberme=" + encodeURIComponent($("#rememberme").is(":checked"));
        
        $.getJSON(url, function(response) {
//console.log(response);
            
            if (response.exists == "1") {
                alert("You successfully logged in");
                window.location = "dashboard";
            } else {
                alert("Invalid username or password");    
            }
            
            if (response.cookie != "") {
                document.cookie = "login=" + response.cookie + "; expires=Thu, 01 Jan 2017 00:00:00 UTC";
            }
        });
    },
    
    logout: function() {
        var url = "includes/receiver.php?req=logout";
        
        $.getJSON(url, function(response) {
            window.location = "home";
        });
    },
    
    register: function() {
        var url = "includes/receiver.php?req=register";
        url += "&job=" + encodeURIComponent($("#job").val());
        url += "&city=" + encodeURIComponent($("#city").val());
        url += "&lastjob=" + encodeURIComponent($("#lastjob").val());
        url += "&position=" + encodeURIComponent($("#position").val());
        url += "&interests=" + encodeURIComponent($("#interests").val());
        url += "&education=" + encodeURIComponent($("#education").val());
        url += "&sport=" + encodeURIComponent($("#sport").val());
        url += "&music=" + encodeURIComponent($("#music").val());
        url += "&films=" + encodeURIComponent($("#films").val());
        url += "&fname=" + encodeURIComponent($("#fname").val());
        url += "&lname=" + encodeURIComponent($("#lname").val());
		url += "&phone=" + encodeURIComponent($("#phone").val());
		url += "&address=" + encodeURIComponent($("#address").val());
        url += "&username=" + encodeURIComponent($("#username").val());
        url += "&password1=" + encodeURIComponent($("#password1").val());
        url += "&password2=" + encodeURIComponent($("#password2").val());
        url += "&email=" + encodeURIComponent($("#email").val());
        
        $.getJSON(url, function(response) {
            if (response.error == "1") {
                alert(response.msg);
            } else {
                alert(response.msg);
                setTimeout(function(){
                    document.location = "login"
                }, 5000);
            }
        });
    },

    readUsers: function (page) {
        var url = 'includes/receiver.php?req=get_users';
        url += '&page=' + encodeURIComponent(page);

        $.getJSON(url, function(response){
            var ulSrc = "", pageSrc = "";
            for (var i = 0;i < response.users.length;i++) {
                ulSrc += "<li>";
                ulSrc += "<div class=\"row\">";
                ulSrc += "<div class=\"col-md-3\">";
                ulSrc += "<img class=\"avatar\" src=\"media/avatars/" + response.users[i].users_avatar + "\" />";
                ulSrc += "</div>";
                ulSrc += "<div class=\"col-md-9\">";
                ulSrc += "<h4>" + (response.users[i].users_fname || "") + " " + (response.users[i].users_lname || "") + "</h4>";
                ulSrc += "<div class=\"text-muted\"><i>" + (response.users[i].users_username || "") + "</i></div>";
                ulSrc += "<div><a href=\"mailto:" + (response.users[i].users_email || "") + "\">" + (response.users[i].users_email || "") + "</a></div>";
                
                ulSrc += "<div><small><span class=\"glyphicon glyphicon-envelope\"></span>&nbsp;&nbsp;" + (response.users[i].users_address || "") + "</small></div>";
                ulSrc += "<div><small><span class=\"glyphicon glyphicon-phone-alt\"></span>&nbsp;&nbsp;" + (response.users[i].users_phone || "") + "</small></div>";
                if (response.users[i].follows_id > 0) {
                    ulSrc += "<button type=\"button\" class=\"btn btn-primary pull-right\" onclick=\"Follows.unfollow(" + response.users[i].follows_id + ");\">Unfollow</button>";
                } else {
                    ulSrc += "<button type=\"button\" class=\"btn btn-default pull-right\" onclick=\"Follows.follow(" + response.users[i].users_id + ")\">Follow</button>";
                }
                ulSrc += "</div>";
                ulSrc += "</div>";
                ulSrc += "</li>";
            }

            $("#ulUsers").html(ulSrc);
            
            var minPage = Math.max(1, page - 3);
            var maxPage = Math.min(response.pages, page + 3);
            for (var i = minPage;i <= maxPage;i++) {
                var btnType = i == page ? "btn-primary" : "btn-default";
                pageSrc += "<a class=\"btn " + btnType + "\" href=\"javascript:Users.readUsers(" + i + ");\">" + i + "</a>";
            }
            
            $("#divPages").html(pageSrc);
        });
    },
	
	ReadWhatever: function (page) {
        var url = 'includes/receiver.php?req=get_whatever';
        url += '&page=' + encodeURIComponent(page);

        $.getJSON(url, function(response){
            var ulSrc = "", pageSrc = "";
            for (var i = 0;i < response.users.length;i++) {
                ulSrc += "<li>";
                ulSrc += "<div class=\"row\">";
                ulSrc += "<div class=\"col-md-3\">";
                ulSrc += "<img class=\"avatar\" src=\"media/avatars/" + response.users[i].users_avatar + "\" />";
                ulSrc += "</div>";
                ulSrc += "<div class=\"col-md-9\">";
                ulSrc += "<h4>" + (response.users[i].users_fname || "") + " " + (response.users[i].users_lname || "") + "</h4>";
                ulSrc += "<div class=\"text-muted\"><i>" + (response.users[i].users_username || "") + "</i></div>";
                ulSrc += "<div><a href=\"mailto:" + (response.users[i].users_email || "") + "\">" + (response.users[i].users_email || "") + "</a></div>";
                
                ulSrc += "<div><small><span class=\"glyphicon glyphicon-envelope\"></span>&nbsp;&nbsp;" + (response.users[i].users_address || "") + "</small></div>";
                ulSrc += "<div><small><span class=\"glyphicon glyphicon-phone-alt\"></span>&nbsp;&nbsp;" + (response.users[i].users_phone || "") + "</small></div>";
                if (response.users[i].follows_id > 0) {
                    ulSrc += "<button type=\"button\" class=\"btn btn-primary pull-right\" onclick=\"Follows.unfollow(" + response.users[i].follows_id + ");\">Unfollow</button>";
                } else {
                    ulSrc += "<button type=\"button\" class=\"btn btn-default pull-right\" onclick=\"Follows.follow(" + response.users[i].users_id + ")\">Follow</button>";
                }
                ulSrc += "</div>";
                ulSrc += "</div>";
                ulSrc += "</li>";
            }

            $("#ulUsers").html(ulSrc);
            
            var minPage = Math.max(1, page - 3);
            var maxPage = Math.min(response.pages, page + 3);
            for (var i = minPage;i <= maxPage;i++) {
                var btnType = i == page ? "btn-primary" : "btn-default";
                pageSrc += "<a class=\"btn " + btnType + "\" href=\"javascript:Users.readUsers(" + i + ");\">" + i + "</a>";
            }
            
            $("#divPages").html(pageSrc);
        });
    }

}





/* readUsers: function () {
        var url = 'includes/receiver.php?req=get';
        url += '&username=' + encodeURIComponent($("#username").val());
        url += '&password=' + encodeURIComponent($("#password").val());
        url += '&email=' + encodeURIComponent($("#email").val());
        url += '&created=' + encodeURIComponent($("#created").val());
//console.log(url);
        $.getJSON(url, function(response){
            //console.log(response);
            
            var tbody = "";
            for (var i = 0;i < response.length;i++) {
                tbody += "<tr>";
                tbody += "<td>" + response[i].users_id + "</td>";
                tbody += "<td>" + response[i].users_username + "</td>";
                tbody += "<td>" + response[i].users_password + "</td>";
                tbody += "<td>" + response[i].users_email + "</td>";
                tbody += "<td>" + response[i].users_created + "</td>";
                tbody += "<td>";
                tbody += "<a href=\"update/" + response[i].users_id + "\">Edit</a>";
                tbody += "&nbsp;&nbsp;<a href=\"delete/" + response[i].users_id + "\">Delete</a>";
                tbody += "</td>";
                tbody += "</tr>";
            }
            
            $("#tblUsers tbody").html(tbody);
        });
    }*/