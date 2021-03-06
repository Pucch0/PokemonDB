<?php
	//echo "required!";
	function verify_user($username, $password){
		global $db;
	  //$pass_hash = md5($password)
		$query = "SELECT * FROM user WHERE password = :password and username = :username";
		//echo $username . "</br>";
		//echo $password . "</br>";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->bindValue(":password", $password);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		/*
		if(count($results) == 0){
			//no username and password exists
			return False;
		}
		else {
			return True;
		}
		*/
		return $results;
	}

	function get_users($username) {
		global $db;
		$query = "SELECT * FROM user WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;
	}

	function create_user($username, $email, $password) {
		global $db;
		$query = "INSERT INTO user VALUES (:username, :password, :email, NULL)";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->bindValue(":email", $email);
		$statement->bindValue(":password", $password);
		$success = $statement->execute();
		$statement->closeCursor();
		return $success;
	}

	function update_bio($username, $new_bio) {
		global $db;
		$query = "UPDATE user SET biography = :bio WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->bindValue(":bio", $new_bio);
		$statement->execute();
		$statement->closeCursor();
	}

	function delete_user($username) {
		global $db;
		$query = "DELETE FROM user WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->execute();
		$statement->closeCursor();
	}

	function add_friends($username1, $username2) {
		global $db;
		$query = "INSERT INTO friend VALUES (:user1, :user2)";
		$statement = $db->prepare($query);
		$statement->bindValue(":user1", $username1);
		$statement->bindValue(":user2", $username2);
		$success = $statement->execute();
		$statement->closeCursor();
		return $success;
	}

	function get_friends($username) {
		global $db;
		$query = "SELECT user2 FROM friend WHERE user1 = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(":username", $username);
		$statement->execute();
		$results = $statement->fetchAll();
		$statement->closeCursor();
		return $results;
	}
  function get_pokemons($username) {
    global $db;
    $query = "SELECT name FROM likes NATURAL JOIN Pokemon WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(":username", $username);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
  }
?>
