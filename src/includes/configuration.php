<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$config = array(
	'databaseServer' => 'localhost',
	'databaseUsername' => 'root',
	'databasePassword' => '',
	'databaseName' => 'forum',
	'logo' => 'images/logo.png',
	'defaultLanguageIndex' => 1,
	'defaultStyleIndex' => 0,
	'setUp' => TRUE, // When true admin users are created 
);

$languageToForumName = array(
	"ФМИ Форум",
	"FMI Forum",
);
?>
