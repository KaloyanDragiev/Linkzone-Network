<?php
include_once(dirname(__FILE__) . '/init.php');

switch ($_GET["req"]) {
    case "load_cookies":
        $user = new User();
        echo json_encode($user->load_cookies($_GET));
        break;
    case "login":
        $user = new User();
        echo json_encode($user->login($_GET));
        break;
    case "logout":
        $user = new User();
        echo json_encode($user->logout($_GET));
        break;
    case "register":
        $user = new User();
        echo json_encode($user->register($_GET));
        break;
    case "get_users":
        $user = new User();
        echo json_encode($user->get_users($_GET));
        break;
	case "get_whatever":
        $user = new User();
        echo json_encode($user->get_whatever($_GET));
        break;
    case "follow":
        $follow = new Follow();
        echo json_encode($follow->follow($_GET));
        break;
    case "unfollow":
        $follow = new Follow();
        echo json_encode($follow->unfollow($_GET));
        break;
    case "get_dashboard":
        $tweet = new Tweet();
        echo json_encode($tweet->get_dashboard($_GET));
        break;
    case "add_tweet":
        $tweet = new Tweet();
        echo json_encode($tweet->add_tweet($_GET));
        break;
    case "get_tweet":
        $tweet = new Tweet();
        echo json_encode($tweet->get_tweet($_GET));
        break;
    case "update_tweet":
        $tweet = new Tweet();
        echo json_encode($tweet->update_tweet($_GET));
        break;
    case "like_tweet":
        $tweet = new Tweet();
        echo json_encode($tweet->like_tweet($_GET));
        break;
    case "comment":
        $tweet = new Tweet();
        echo json_encode($tweet->comment($_GET));
        break;
    case "get_comments":
        $tweet = new Tweet();
        echo json_encode($tweet->get_comments($_GET));
        break;
}
?>