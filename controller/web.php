<?php
function webController($path, $request) {
	global $smarty, $dao, $error;
	list($reqPath, $queryString) = explode('?', $path);
	$pathParts = explode('/', substr($reqPath,1));
	list($action) = $pathParts;
	
	session_start();
	$authnStatus = checkAuthn(); 
	
	if(isLoggedIn()) {
		$smarty->assign("loggedIn", true);
		$smarty->assign("loginEmail", $_SESSION["loginEmail"]);
	} else {
		$smarty->assign("loggedIn", false);
	}
	// Can do this stuff whether or not they are logged in
	switch($action) {
			case 'main':
				$posts = $dao->getAllPosts();
				$smarty->assign("posts",$posts);
				$smarty->display('main.tpl');
				break;
			case '404':
				$smarty->display('404.tpl');
				break;
			case 'contact':
				$smarty->display("contact.tpl");
				break;
			case 'login':
				$smarty->display('header.tpl');
				$smarty->display('login.tpl');
				$smarty->display('footer.tpl');
				break;
			case 'login.do':
				if($_POST["loginDestination"])
					$destination = "../web". $_POST["loginDestination"];
				else
					$destination = "main";
				header("Location: $destination");
				break;
			case 'posts':
				$posts = $dao->getAllPosts();
				$smarty->assign("posts",$posts);
				$smarty->display("posts.tpl");
				break;
			case 'sketches':
				$pictures = $dao->getAllSketches();
				$smarty->assign("pictures",$pictures);
				$smarty->display('sketches.tpl');
				break;
			case 'finished_work':
				$pictures = $dao->getAllFinishedWorks();
				$smarty->assign("pictures",$pictures);
				$smarty->display('finished_works.tpl');
				break;
	}
	// Only if the user is logged in
	if( $authnStatus != AUTHN_FAILED) {
		
		switch($action) {
			case 'post':
				$smarty->display('post.tpl');
				break;
			case 'post.do':
				$title=$request["title"];
				$content=$request["content"];
				$dao->newPost($title,$content);
				header("Location: posts");
				break;
			case 'upload':
				$smarty->display('upload.tpl');
				break;
			case 'upload.do':
				$name = $request['name'];
				$description = $request['description'];
				$isSketch = $request['isSketch'];
				if(!isset($isSketch)) $isSketch = 0;
				
				// We know there will only be two files, a thumbnail and a full size image
				$fileNameFull =  $_FILES['image']['name'][0];
				$fileNameThumb =  $_FILES['image']['name'][1];
				
				$targetPath = "uploads/" . $fileNameFull;
				move_uploaded_file($_FILES['image']['tmp_name'][0], $targetPath);
				
				$targetPath = "uploads/" . $fileNameThumb;
				move_uploaded_file($_FILES['image']['tmp_name'][1], $targetPath);
				
				$dao->uploadPicture($name,$description, $fileNameFull, $fileNameThumb, $isSketch);
				if ($isSketch) header("Location: sketches");
				else header("Location: finished_work");
				break;
			case 'logout':
				session_destroy();
				header("Location: main");
				break;
		}
		// User failed authentication
	} else if($authnStatus == AUTHN_FAILED){
		$smarty->display("header.tpl");
		$smarty->assign("errMsg", "Login failed.");
		$smarty->display("login.tpl");
		$smarty->display("footer.tpl");
	
	}
}
?>