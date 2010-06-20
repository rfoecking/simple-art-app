<?php
/**
 * Class for making access to the database easy!
 */
function dbConnect() {
	$host 		= DB_HOST;
	$user 		= DB_USER;
	$pass 		= DB_PASS;
	$db_name 	= DB_NAME;
	
	try {
	    $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $pass);
	} catch (PDOException $e) {
	    errorMessage("Database error: ". $e->getMessage());
	    die();
	}
	
	mysql_connect($host, $user, $pass);
	mysql_select_db($db_name);
	
	return $db;
}

/**
 * 
 * The class for accessing the database
 *	
 */
class DAO {
	private $db;
	
	function DAO() {
		$this->db = dbConnect();
	}
	/**
	 * Get all sketches in the database.
	 */
	function getAllSketches() {

		$stmt = $this->db->prepare(
			"select * from picture where sketch = 1"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Get all finished works in the database.
	 */
	function getAllFinishedWorks() {

		$stmt = $this->db->prepare(
			"select * from picture where sketch = 0"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Upload a picture.
	 */
	function uploadPicture($name, $description, $fileNameFull, $fileNameThumb, $isSketch) {
		$stmt = $this->db->prepare(
		"insert into picture (name, description, datetime, filename_full, filename_thumb, sketch)
			   VALUES (:name, :description, NOW(), :fileNameFull, :fileNameThumb, :isSketch)"
			   )or print_r("ERROR".$this->db->errorInfo()) &&die();
			   $stmt->bindValue(":name", $name);
			   $stmt->bindValue(":description", $description);
			   $stmt->bindValue(":fileNameFull", $fileNameFull);
			   $stmt->bindValue(":fileNameThumb", $fileNameThumb);
			   $stmt->bindValue(":isSketch", $isSketch);
			   $stmt->execute() or print_r($stmt->errorInfo());
	}
	/**
	 * Get all posts in the database.
	 */
	function getAllPosts() {
		$stmt = $this->db->prepare(
			"select * from post"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Create a new post.
	 */
	function newPost($title,$content) {
		$stmt = $this->db->prepare(
			"insert into post (title, content, user_id, time) values (:title, :content, 2, NOW())"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();
		
		$stmt->bindValue(":title", $title);
		$stmt->bindValue(":content", $content);
		
		$stmt->execute();
	}
	/**
	 * Check for a correcrt combination of username/pass.
	 * @param $username
	 * @param $pass
	 */
	function checkLogin($username, $pass) {
		$stmt = $this->db->prepare(
			"SELECT id
			 FROM user
			 WHERE username = :username AND password = SHA1(:pass)"
		) or print_r($this->db->errorInfo()) && die();
		$stmt->bindValue(':username', $username);
		$stmt->bindValue(':pass', $pass);
		
		$stmt->execute();
		
		if($result = $stmt->fetch(PDO::FETCH_ASSOC))
			return $result;
		else
			return false;
	}
}

?>