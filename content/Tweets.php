<?php

class Tweet
{
	public function get_stats($params = null)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
		$stats = $pdo->prepare('
			SELECT
				(
					SELECT
						COUNT(*)
					FROM
						tweets
					WHERE
						tweets_user=:user
				) AS tweets,
				(
					SELECT
						COUNT(*)
					FROM
						follows
					WHERE
						follows_follower=:user
				) AS following,
				(
					SELECT
						COUNT(*)
					FROM
						follows
					WHERE
						follows_user=:user
				) AS followers
		');
		
		$stats->execute(array(
			":user" => $_SESSION["user"]["id"]
		));
		$row_stats = $stats->fetch(PDO::FETCH_ASSOC);
		
		return $row_stats;
	}
	
    public function get_dashboard($params)
    {
        $pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
        
        $rst = $pdo->prepare('
            SELECT SQL_CALC_FOUND_ROWS
                tweets_id AS tid,
                tweets_text AS ttext,
                tweets_created AS tcreated,
                USR1.users_id AS uid,
                USR1.users_username AS uuname,
                USR1.users_fname AS ufname,
                USR1.users_lname AS ulname,
				IF(USR1.users_id=:follower,"yes","no") AS tours,
                GROUP_CONCAT(USR2.users_username) AS luser,
				COUNT(comments_id) AS tcomments
            FROM
                tweets
                LEFT JOIN follows ON follows_user=tweets_user
                LEFT JOIN users USR1 ON USR1.users_id=tweets_user
                LEFT JOIN likes ON likes_tweet=tweets_id
                LEFT JOIN users USR2 ON USR2.users_id=likes_user
				LEFT JOIN comments ON comments_tweet=tweets_id
            WHERE
                follows_follower=:follower
                AND tweets_active="yes"
                AND follows_active="yes"
            GROUP BY
                tweets_id
            ORDER BY
                tweets_created DESC
			LIMIT 
				20
			OFFSET
				' . (($params["page"] - 1) * 20) . '
        ');

        $rst->execute(array(
            ":follower" => $_SESSION["user"]["id"]
        ));
        $rows = $rst->fetchAll(PDO::FETCH_ASSOC);

		$rst_cter = $pdo->prepare("SELECT FOUND_ROWS() AS cter");
		$rst_cter->execute();
		$count_rows = $rst_cter->fetch(PDO::FETCH_ASSOC);
		$pages = ceil($count_rows["cter"] / 20);
        
        return array("tweets" => $rows, "pages" => $pages);
    }
    
    public function add_tweet($params)
    {
		preg_match("/(https?\:\/\/(www\.)?[\w|\-]+\.\w{2,4})([\w|\-|\/|\.|\#|\?|\=|\%]+)?/", $params["text"], $url_match);

		if (count($url_match) > 0) {
			$url = $url_match[0];
			$domain = $url_match[1];
			
			$webpage_src = file_get_contents($url);
			
			preg_match("/\<title\>(.+)\<\/title\>/", $webpage_src, $title_match);
			preg_match("/\<img[^>]+ src\=\"(.+)\"/U", $webpage_src, $image_match);
			
			
			/* '<img[^>]+src\s*=\s*["\']?([^"\' ]+\.jpg)[^>]*>' */
			$params["text"] .= "<br />";
			$params["text"] .= "<img src=\"" .  $image_match[1] . "\" style=\"width:400px; margin-top:10px;\"/>";
			$params["text"] .= "<h4>" . $title_match[1] . "</h4>";
			$params["text"] .= "<a href=\"" . $url . "\" target=\"_blank\" style=\"text-transform:uppercase; color:#999;\">" . $domain . "</a>";
		}

        $pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
        $rst = $pdo->prepare('
            INSERT INTO
                tweets
                (
                    tweets_user,
                    tweets_text,
                    tweets_active
                )
            VALUES
            (
                :user,
                :text,
                "yes"
            )
        ');
        
        $rst->execute(array(
            ":user" => $_SESSION["user"]["id"],
            ":text" => $params["text"]
        ));
        
        return array(
            "msg" => "Your comment was published!"
        );
    }
	
	public function get_tweet($params)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);

		$rst = $pdo->prepare('
			SELECT
				tweets_id AS tid,
				users_id AS uid,
				users_username AS uuname,
				tweets_text AS ttext,
				tweets_created AS tcreated
			FROM
				tweets
				LEFT JOIN users ON users_id=tweets_user
			WHERE
				tweets_id=:tid
				AND tweets_active="yes"
		');
		
		$rst->execute(array(
			":tid" => $params["tid"]
		));
		$row = $rst->fetch(PDO::FETCH_ASSOC);
		
		return array("tweet" => $row);
	}
	
	public function update_tweet($params)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
		$rst = $pdo->prepare('
			UPDATE
				tweets
			SET
				tweets_text=:ttext
			WHERE
				tweets_id=:tid
				AND tweets_user=:user
		');
		
		$rst->execute(array(
			":tid" => $params["tid"],
			":ttext" => $params["text"],
			":user" => $_SESSION["user"]["id"]
		));
		
        return array(
            "msg" => "Your tweet was updated!"
        );
	}
	
	public function like_tweet($params)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
		$rst_check = $pdo->prepare('
			SELECT
				COUNT(*) AS cnt
			FROM
				likes
			WHERE
				likes_tweet=:tid
				AND likes_user=:user
		');
		
		$rst_like = $pdo->prepare('
			INSERT INTO
				likes
				(
					likes_tweet,
					likes_user
				)
			VALUES
			(
				:tid,
				:user
			)
		');
		
		$rst_check->execute(array(
			":tid" => $params["tid"],
			":user" => $_SESSION["user"]["id"]
		));
		$row_check = $rst_check->fetch(PDO::FETCH_ASSOC);
		
		if ($row_check["cnt"] == 0) {
			$rst_like->execute(array(
				":tid" => $params["tid"],
				":user" => $_SESSION["user"]["id"]
			));
		}
		
		return array(
            "msg" => "Your comment was published!"
        );
	}
	
	public function comment($params)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
		$rst = $pdo->prepare('
			INSERT INTO
				comments
				(
					comments_tweet,
					comments_user,
					comments_text,
					comments_active
				)
			VALUES
			(
				:tweet,
				:user,
				:text,
				"yes"
			)
		');
		$rst->execute(array(
			":tweet" => $params["tid"],
			":user" => $_SESSION["user"]["id"],
			":text" => $params["text"]
		));
		
        return array(
            "msg" => "Your comment was published!"
        );
	}
	
	public function get_comments($params = null)
	{
		$pdo = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
		
		$rst = $pdo->prepare('
			SELECT
				comments_id AS cid,
				users_id AS uid,
				users_username AS uuname,
				comments_text AS ctext,
				comments_created AS ccreated
			FROM
				comments
				LEFT JOIN users ON users_id=comments_user
			WHERE
				comments_tweet=:tid
		');
		$rst->execute(array(
			":tid" => $params["tid"]
		));
		
		$rows = $rst->fetchAll(PDO::FETCH_ASSOC);
		
		return array("comments" => $rows);
	}
}