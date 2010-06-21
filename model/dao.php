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
			"select * from picture where sketch = 1 order by id desc"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Get all finished works in the database.
	 */
	function getAllFinishedWorks() {

		$stmt = $this->db->prepare(
			"select * from picture where sketch = 0 order by id desc"
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Get a picture with the specified id.
	 * @param unknown_type $id
	 */
	function getPicture($id){
		$stmt = $this->db->prepare(
			"select name, description, filename_full, id, sketch from picture
			 where id = :id"
			 );
			 $stmt->bindValue(":id",$id);
			 $stmt->execute();
			 return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	/**
	 * Get the id of the picture before the current one.
	 * @param $id
	 */
	function getNext($id, $sketch){
		$stmt = $this->db->prepare("
		select max(id)
		from picture where id < :id AND sketch = :sketch"
		);
		$stmt->bindValue(":id",$id);
		$stmt->bindValue(":sketch",$sketch);
		$stmt->execute();
		$result =  $stmt->fetch(PDO::FETCH_ASSOC);
		return $this->getPicture($result["max(id)"]);
	}
	/**
	 * Get the id of the picture before the current one.
	 * @param $id
	 */
	function getPrevious($id,$sketch){
		$stmt = $this->db->prepare("
		select min(id)
		from picture where id > :id AND sketch = :sketch"
		);
		$stmt->bindValue(":id",$id);
		$stmt->bindValue(":sketch",$sketch);
		$stmt->execute();
		$result =  $stmt->fetch(PDO::FETCH_ASSOC);
		return $this->getPicture($result["min(id)"]);
	}
	
	function getNewestId($sketch){
		$stmt = $this->db->prepare(
		"SELECT id FROM picture WHERE sketch = :sketch ORDER BY id  DESC LIMIT 1");
		$stmt->bindValue(":sketch",$sketch);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result["id"];
	}
	function getOldestId($sketch){
		$stmt = $this->db->prepare(
		"SELECT id FROM picture WHERE id != 0 AND sketch = :sketch ORDER BY id ASC LIMIT 1");
		$stmt->bindValue(":sketch",$sketch);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result["id"];
	}
	/**
	 * Upload a picture and adds an update to the posts table about that 
	 * picture.
	 */
	function uploadPicture($name, $gallery, $newsfeed, $fileNameFull, $fileNameThumb, $isSketch) {
		$stmt = $this->db->prepare(
		"insert into picture (name, description, datetime, filename_full, filename_thumb, sketch)
			   VALUES (:name, :description, NOW(), :fileNameFull, :fileNameThumb, :isSketch)"
			   )or print_r("ERROR".$this->db->errorInfo()) &&die();
			   $stmt->bindValue(":name", $name);
			   $stmt->bindValue(":description", $gallery);
			   $stmt->bindValue(":fileNameFull", $fileNameFull);
			   $stmt->bindValue(":fileNameThumb", $fileNameThumb);
			   $stmt->bindValue(":isSketch", $isSketch);
			   $stmt->execute() or print_r($stmt->errorInfo());
			   
		$stmt = $this->db->prepare(
				"insert into post (title, content, user_id, datetime, picture, picture_id) 
				 values (:title, :content, 2, NOW(), 1, :pictureId)"
				 )or print_r($stmt->errorInfo()&&die());
				 $stmt->bindValue(":title", $name);
				 $stmt->bindValue(":content", $newsfeed);
				 $stmt->bindValue(":pictureId", $this->db->lastInsertId());
		$stmt->execute()or print_r($stmt->errorInfo()&&die());
				 
	}
	/**
	 * Get all posts in the database.
	 * TODO:  Figure out a better database design for this.
	 */
	function getAllPosts() {
		$stmt = $this->db->prepare(
			"select post.title, post.content, picture.filename_thumb,
			 picture.filename_full, post.picture, post.datetime, post.picture_id,
			 picture.sketch
			 from post
			 join picture
             on post.picture_id = picture.id
             order by post.datetime desc"	
		) or print_r("FUCK ERROR".$stmt.errorInfo()) &&die();

		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Create a new post.
	 */
	function newPost($title,$content) {
		$stmt = $this->db->prepare(
			"insert into post (title, content, user_id, datetime, picture, picture_id)
			 values (:title, :content, 2, NOW(), 0,0)"
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
