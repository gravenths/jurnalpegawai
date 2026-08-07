<?php
	session_start(); // Start or Resume Session
	
	require('config.php');
	
	//composer auto load libraries
	require ('vendor/autoload.php');

	//Error reporting for debugging during development
	$is_export_request = isset($_GET['format']) && in_array(strtolower($_GET['format']), array('pdf', 'excel', 'word', 'csv', 'print', 'json'));
	if(DEVELOPMENT_MODE == true && !$is_export_request){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL); 
	} 
	else {
		//errors will not be displayed on the pages but log to files
		error_reporting(E_ALL);
		ini_set('log_errors', 'On');
		ini_set('error_log', 'error.log');
		ini_set('display_errors','Off');
	}
	//
	if(!empty(DEFAULT_TIMEZONE)){
		date_default_timezone_set(DEFAULT_TIMEZONE);
	}
	
	// Application configurations Settings

	/**
     * Initialize Model Class From Model Dir
     * @return null
     */
	function autoloadModel($className) {
		$filename = MODELS_DIR . $className . ".php";
		if (is_readable($filename)) {
			require $filename;
		}
	}

	/**
     * Initialize Controller Classes From Controller Dir
     * @return null
     */
	function autoloadController($className) {
		$filename = CONTROLLERS_DIR . $className . ".php";
		if (is_readable($filename)) {
			require $filename;
		}
	}
	
	/**
     * Initialize Libraries Classes From Libs Dir
     * @return boolean
     */
	function autoloadLibrary($className) {
		$filename = LIBS_DIR . $className . ".php";
		if (is_readable($filename)) {
			require $filename;
		}
	}
	
	/**
     * Initialize Helper Classes From helper Dir
     * @return null
     */
	function autoloadHelper($className) {
		$filename = HELPERS_DIR . $className . ".php";
		if (is_readable($filename)) {
			require $filename;
		}
	}
	
	// Register Autoloaders
	spl_autoload_register("autoloadModel");
	spl_autoload_register("autoloadController");
	spl_autoload_register("autoloadLibrary");
	spl_autoload_register("autoloadHelper");
	
	
	
	//Initialize Global Functions Helpers
	require(HELPERS_DIR . 'Functions.php');

	$lang = new Lang;// Initialize language class and load default language phrases
	$csrf = new Csrf;// Initialize Csrf class and generate new application token
	$csrf_token = $csrf::$token; 
	

	// Application Core Files
	require(SYSTEM_DIR . 'BaseController.php');
	require(SYSTEM_DIR . 'SecureController.php');
	require(SYSTEM_DIR . 'BaseView.php');
	require(SYSTEM_DIR . 'Router.php');
	
	//display page with the exceptions
	function exception_handler($exception){
		$view = new BaseView();
		$view->render("errors/error_server.php", $exception, "info_layout.php");
		exit;
	}

	//Display application exception in a custom page
	set_exception_handler('exception_handler');

	// Only output the HTML page wrapper for normal (non-export) requests.
	// Export requests (PDF, Excel, Word, CSV, Print) send their own headers/content
	// and must not have any HTML prepended or appended to the response.
	if (!$is_export_request) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <title>Jurnal Aktivitas Pegawai</title>
  <link rel="stylesheet" href="css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="css/style.css" media="screen">
  <link rel="stylesheet" href="css/bootswatch.min.css">
  <link rel="stylesheet" href="css/jasny-bootstrap.min.css">
  <link rel="icon" type="image/png" href="assets/images/logo-sman8.png">
  <script type="text/javascript" async="" src="js/ga.js"></script>
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootswatch.js"></script>
</head>
<body>
<?php } ?>
<?php

	$page = new Router;
	$page->init(); // Bootstrap Page with the Current URL
	
	if (!$is_export_request) {
?>
</body>
</html>
<?php } ?>
