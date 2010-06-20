<?php
/**
 * displays error message
 * @param unknown_type $msg
 * @return unknown_type
 */
function errorMessage($msg) {
		die($msg);
}


/**
 * returns an error code and error message
 * @param $errorCode
 * @param $errorMessage
 */
function errorResponseCode($errorCode, $errorMessage){
	return array(
			"errorCode" => $errorCode,
			"errorMessage" => $errorMessage
		);
}
/**
 * sends a jsonError
 * @param unknown_type $errorCode
 * @param unknown_type $errorMessage
 */
function jsonError($errorCode, $errorMessage){
	echo json_encode(errorResponseCode($errorCode,$errorMessage));
	die();
}

?>
