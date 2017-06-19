<?php

class User
{
	public function load_cookies($params)
	{
		if ($params["cookie"] != "") {
			$cookie_arr = explode("=", $params["cookie"]);
		
			if ($cookie_arr[1] != "null") {
				$crypt = json_decode(base64_decode($cookie_arr[1]), true);
				$result = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, base64_decode(ENCRYPT_KEY), base64_decode($crypt["cr"]), MCRYPT_MODE_CFB, base64_decode($crypt["iv"]))), true);
			} else {
				$result = array();
			}
		} else {
			$result = "";
		}
		
		return $result;
	}
	
	public function login($params)
	{
		$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
		
		$rst = $pdo->prepare('
			SELECT
				users_id,
				COUNT(*) AS uexists
			FROM
				users
			WHERE
				users_username=:username
				AND users_password=MD5(:password)
				AND users_active="yes"
		');
		
		$rst->execute(array(
			":username" => $params["username"],
			":password" => $params["password"]
		));
		
		$row = $rst->fetch(PDO::FETCH_ASSOC);
		$result["exists"] = $row["uexists"];
		
		if ($row["uexists"] > 0) {
			$_SESSION["user"]["id"] = $row["users_id"];
			$this->load_user();
			
			if ($params["rememberme"] == "true") {
				$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB);
				$iv = mcrypt_create_iv($iv_size, MCRYPT_DEV_RANDOM);
				$text = json_encode(array(
					"un" => stripslashes($params["username"]),
					"pw" => stripslashes($params["password"])
				));
				$crypt = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, base64_decode(ENCRYPT_KEY), $text, MCRYPT_MODE_CFB, $iv));
				$result["cookie"] = base64_encode(json_encode(array("cr" => $crypt, "iv" => base64_encode($iv))));
			}
		}
		
		return $result;
	}
	
	public function load_user()
	{
		$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
		
		$rst = $pdo->prepare('
			SELECT
				users_type AS utype,
				users_username AS uuname,
				users_email AS uemail,
				users_fname AS ufname,
				users_lname AS ulname,
				users_city AS ucity,
				users_job AS ujob,
				users_lastjob AS ulastjob,
				users_position AS uposition,
				users_education AS ueducation,
				users_interests AS uinterests,
				users_sport AS usport,
				users_music AS umusic,
				users_films AS ufilms,
				users_address AS uaddress,
				users_phone AS uphone,
				users_avatar AS uavatar,
				users_created AS ucreated
			FROM
				users
			WHERE
				users_id=:uid
		');
		$rst->execute(array(
			":uid" => (int) $_SESSION["user"]["id"]
		));
		
		$row = $rst->fetch(PDO::FETCH_ASSOC);
		
		$_SESSION["user"]["type"] = $row["utype"];
		$_SESSION["user"]["username"] = $row["uuname"];
		$_SESSION["user"]["email"] = $row["uemail"];
		$_SESSION["user"]["fname"] = $row["ufname"];
		$_SESSION["user"]["lname"] = $row["ulname"];
		$_SESSION["user"]["city"] = $row["ucity"];
		$_SESSION["user"]["job"] = $row["ujob"];
		$_SESSION["user"]["lastjob"] = $row["ulastjob"];
		$_SESSION["user"]["position"] = $row["uposition"];
		$_SESSION["user"]["education"] = $row["ueducation"];
		$_SESSION["user"]["interests"] = $row["uinterests"];
		$_SESSION["user"]["sport"] = $row["usport"];
		$_SESSION["user"]["music"] = $row["umusic"];
		$_SESSION["user"]["films"] = $row["ufilms"];
		$_SESSION["user"]["address"] = $row["uaddress"];
		$_SESSION["user"]["phone"] = $row["uphone"];
		$_SESSION["user"]["avatar"] = $row["uavatar"];
		$_SESSION["user"]["created"] = $row["ucreated"];
		
		return true;
	}
	
	public function logout()
	{
		unset($_SESSION["user"]);
		
		return true;
	}
	
	public function register($params)
	{
		if (strlen($params["password1"]) < 6) {
			return array(
				"error" => 1,
				"msg" => "The password shall be at least 6 characters"
			);
		}
		
		if ($params["password1"] != $params["password2"]) {
			return array(
				"error" => 1,
				"msg" => "Please retype correctly your password"
			);
		}
		
		if (filter_var($params["email"], FILTER_VALIDATE_EMAIL) === false) {
			return array(
				"error" => 1,
				"msg" => "Please provide a valid email address"
			);
		}
		
		$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
		
		$rst_user_exists = $pdo->prepare('
			SELECT
				COUNT(*) AS uexists
			FROM
				users
			WHERE
				users_username=:username
		');
		$rst_user_exists->execute(array(
			":username" => $params["username"]
		));
		$row_user_exists = $rst_user_exists->fetch(PDO::FETCH_ASSOC);
		if ($row_user_exists["uexists"] > 0) {
			return array(
				"error" => 1,
				"msg" => "This username is already taken"
			);
		}
		
		$rst_email_exists = $pdo->prepare('
			SELECT
				COUNT(*) AS eexists
			FROM
				users
			WHERE
				users_email=:email
		');
		$rst_email_exists->execute(array(
			":email" => $params["email"]
		));
		$row_email_exists = $rst_email_exists->fetch(PDO::FETCH_ASSOC);
		if ($row_email_exists["eexists"] > 0) {
			return array(
				"error" => 1,
				"msg" => "This email is already used for registration"
			);
		}
		
		$rst_register = $pdo->prepare('
			INSERT INTO
				users
				(
					users_id,
					users_fname,
					users_lname,
					users_city,
					users_job,
					users_lastjob,
					users_position,
					users_education,
					users_interests,
					users_sport,
					users_music,
					users_films,
					users_username,
					users_password,
					users_email,
					users_address,
					users_phone,
					users_created,
					users_active
				)
			VALUES
			(
				null,
				:fname,
				:lname,
				:city,
				:job,
				:lastjob,
				:position,
				:education,
				:interests,
				:sport,
				:music,
				:films,
				:username,
				MD5(:password),
				:email,
				:address,
				:phone,
				NOW(),
				"yes"
			)
		');
		$rst_register->execute(array(
		    ":fname" => $params["fname"],
		    ":lname" => $params["lname"],
		    ":city" => $params["city"],
		    ":job" => $params["job"],
		    ":lastjob" => $params["lastjob"],
		    ":position" => $params["position"],
		    ":education" => $params["education"],
		    ":interests" => $params["interests"],
		    ":sport" => $params["sport"],
		    ":music" => $params["music"],
		    ":films" => $params["films"],
			":address" => $params["address"],
		    ":phone" => $params["phone"],
			":username" => $params["username"],
			":password" => $params["password1"],
			":email" => $params["email"]
		));
		
		return array(
			"error" => 0,
			"msg" => "You successfully registered"
		);
	}
	
	public function get_users($params)
	{
	
//return print_r($params, true);
		$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);

		$rst = $pdo->prepare('
			SELECT SQL_CALC_FOUND_ROWS
				users_id,
				users_username,
				users_fname,
				users_lname,
				users_city,
				users_job,
				users_lastjob,
				users_position,
				users_education,
				users_interests,
				users_sport,
				users_music,
				users_films,
				users_phone,
				users_address,
				users_avatar,
				users_email,
				(
					SELECT
						follows_id
					FROM
						follows
					WHERE
						follows_follower=:follower
						AND follows_user=users_id
				) AS follows_id
			FROM 
				users
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

		return array("users" => $rows, "pages" => $pages);
	}
	
	public function get_whatever($params)
	{
	
//return print_r($params, true);
		$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);

		$rst = $pdo->prepare('
			SELECT SQL_CALC_FOUND_ROWS
				users_id,
				users_username,
				users_fname,
				users_lname,
				users_city,
				users_job,
				users_lastjob,
				users_position,
				users_education,
				users_interests,
				users_sport,
				users_music,
				users_films,
				users_address,
				users_phone,
				users_avatar,
				users_email,
				(
					SELECT
						follows_id
					FROM
						follows
					WHERE
						follows_follower=:follower
						AND follows_user=users_id
				) AS follows_id
			FROM 
				users
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

		return array("users" => $rows, "pages" => $pages);
	}
	
	public function update($params)
	{
		$db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
		
		$rst = $db->prepare('
			UPDATE
				users
			SET
				users_username=:username,
				users_password=:password,
				users_email=:email
			WHERE	
				users_id=:id
		');
		
		$rst->execute(array(
			":username" => $params["username"],
			":password" => $params["password"],
			":email" => $params["email"],
			":id" => $params["id"]
		));
		
		return true;
	}	
		
	public function read($params)
	{
//return print_r($params, true);
		$where_array = array();

		if ($params["username"] != "") {
			$where_array[] = 'users_username="' . $params["username"] . '"';
		}
		if ($params["password"] != "") {
			$where_array[] = 'users_password LIKE "%' . $params["password"] . '%"';
		}
		if ($params["email"] != "") {
			$where_array[] = 'users_email="' . $params["email"] . '"';
		}
		if ($params["created"] != "") {
			$where_array[] = 'users_created LIKE "%' . $params["created"] . '%"';
		}

		$db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);

		$rst = $db->prepare('
			SELECT 
				* 
			FROM
				users
			WHERE
				' . implode(" OR ", $where_array) . '
			LIMIT 
				20
		');
		$rst->execute();
		
		$rows = $rst->fetchAll(PDO::FETCH_ASSOC);
		
		return $rows;
	}
	
	public function read_one($id)
	{
		$db = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=utf8", DB_USER, DB_PASSWORD);
		
		$rst = $db->prepare('
			SELECT 
				* 
			FROM
				users
			WHERE
				users_id=:id
		');
		$rst->execute(array(
			":id" => $id
		));
		
		$row = $rst->fetch(PDO::FETCH_ASSOC);
		
		return $row;
	}
}





