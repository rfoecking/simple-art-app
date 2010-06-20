<?php

function checkAuthn() {
	global $dao;
	if($_POST['doLogin']) {
		if($login = $dao->checkLogin($_POST['loginEmail'], $_POST['loginPass'])) {
			$_SESSION['loggedIn'] = true;
			$_SESSION['loginEmail'] = $_POST['loginEmail'];
			$_SESSION['loginId'] = $login['id'];
			return AUTHN_OK;
		} else
			return AUTHN_FAILED;
	} else
		return AUTHN_NOTLOGGEDIN;
}

function isLoggedIn() {
	return $_SESSION['loggedIn']? true: false;
}

?>