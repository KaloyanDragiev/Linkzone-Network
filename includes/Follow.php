<?php

class Follow
{
    public function follow($params)
    {
        $pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
        
        $rst = $pdo->prepare('
            INSERT INTO
                follows
                (
                    follows_follower,
                    follows_user,
                    follows_active
                )
            VALUES
            (
                :follower,
                :user,
                "yes"
            )
        ');
        
        $rst->execute(array(
            ":follower" => $_SESSION["user"]["id"],
            ":user" => $params["userid"]
        ));
        
        return array(
            "msg" => "You now successfuly follow that user"
        );
    }
    
    public function unfollow($params)
    {
        $pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
        
        $rst = $pdo->prepare('
            DELETE FROM
                follows
            WHERE
                follows_id=:follow_id
        ');
        $rst->execute(array(
            ":follow_id" => $params["followid"]
        ));

        return array(
            "msg" => "You now unfollow that user"
        );
    }
}